# ============================================================
# fix-ckeditor-push.ps1
# Moves @push('scripts')...@endpush from AFTER </x-admin-layout>
# to BEFORE </x-admin-layout>, in the four CKEditor blades.
# Also normalises the trailing whitespace around the closing tag.
# ============================================================

$utf8NoBom = New-Object System.Text.UTF8Encoding $false
$root = (Get-Location).Path

$blades = @(
    "resources\views\admin\posts\create.blade.php",
    "resources\views\admin\posts\edit.blade.php",
    "resources\views\admin\pages\create.blade.php",
    "resources\views\admin\pages\edit.blade.php"
)

foreach ($rel in $blades) {
    $full = Join-Path $root $rel
    if (-not (Test-Path $full)) {
        Write-Host ("SKIP (not found): " + $rel)
        continue
    }

    $content = [System.IO.File]::ReadAllText($full)
    $original = $content

    # Backup once
    $bak = $full + ".pre-push-fix.bak"
    if (-not (Test-Path $bak)) {
        [System.IO.File]::WriteAllText($bak, $content, $utf8NoBom)
    }

    # Find the closing tag and the push block
    $closeTag = "</x-admin-layout>"
    $pushStart = "@push('scripts')"
    $pushEnd = "@endpush"

    $closeIdx = $content.IndexOf($closeTag)
    $pushStartIdx = $content.IndexOf($pushStart)
    $pushEndIdx = $content.LastIndexOf($pushEnd)

    if ($closeIdx -lt 0 -or $pushStartIdx -lt 0 -or $pushEndIdx -lt 0) {
        Write-Host ("SKIP (structure unexpected): " + $rel + " close=" + $closeIdx + " pushStart=" + $pushStartIdx + " pushEnd=" + $pushEndIdx)
        continue
    }

    # If push is already before close tag, nothing to do
    if ($pushStartIdx -lt $closeIdx) {
        Write-Host ("SKIP (push already inside): " + $rel)
        continue
    }

    # Extract the push block (from @push('scripts') through @endpush, inclusive)
    $pushBlockLength = ($pushEndIdx + $pushEnd.Length) - $pushStartIdx
    $pushBlock = $content.Substring($pushStartIdx, $pushBlockLength)

    # Remove push block from the tail (including trailing whitespace)
    $before = $content.Substring(0, $pushStartIdx).TrimEnd()
    # Rebuild: everything before push, ensuring close tag is last
    # Also strip trailing newlines/quotes around close tag
    # Extract content up to and including the close tag
    $contentBeforeClose = $content.Substring(0, $closeIdx + $closeTag.Length)

    # Whatever came between close tag and push start (whitespace) — discard
    # Rebuild: contentBeforeClose (with push inserted before the close tag)
    $contentBeforeCloseWithoutClose = $content.Substring(0, $closeIdx).TrimEnd()
    $newContent = $contentBeforeCloseWithoutClose + "`r`n`r`n    " + $pushBlock + "`r`n" + $closeTag + "`r`n"

    [System.IO.File]::WriteAllText($full, $newContent, $utf8NoBom)
    Write-Host ("Fixed: " + $rel + " (" + (Get-Item $full).Length + " bytes)")
}

Write-Host ""
Write-Host "Now run:"
Write-Host "  php artisan view:clear"
Write-Host "  php artisan optimize:clear"