$root = (Get-Location).Path
$out = Join-Path $root "project-files.txt"

$skip = @('vendor', 'node_modules', '.git', 'storage\framework', 'storage\logs', 'public\build', 'public\storage', 'bootstrap\cache')

$files = Get-ChildItem -Path $root -Recurse -File -Force | Where-Object {
    $rel = $_.FullName.Substring($root.Length + 1)
    $keep = $true
    foreach ($s in $skip) {
        if ($rel.StartsWith($s + '\')) { $keep = $false; break }
    }
    if ($_.Name -eq 'project-files.txt') { $keep = $false }
    if ($_.Extension -eq '.sqlite') { $keep = $false }
    $keep
}

$lines = $files | ForEach-Object {
    $_.FullName.Substring($root.Length + 1) + "  (" + $_.Length + " bytes)"
}

$lines | Sort-Object | Out-File -FilePath $out -Encoding utf8
Write-Host ("Wrote " + $out + " with " + $lines.Count + " files.")