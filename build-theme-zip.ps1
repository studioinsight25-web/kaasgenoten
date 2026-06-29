# WordPress-thema zip: platte structuur (style.css direct in zip-root).
# Werkt betrouwbaarder dan een geneste map op veel hostingpakketten.
$ErrorActionPreference = 'Stop'

$themeDir = Join-Path $PSScriptRoot 'de-kaasgenoten'
$styleCss = Join-Path $themeDir 'style.css'

if (-not (Test-Path $styleCss)) {
    Write-Error "style.css niet gevonden in $themeDir"
}

$destinations = @(
    (Join-Path $env:USERPROFILE 'Downloads\de-kaasgenoten.zip'),
    (Join-Path $PSScriptRoot 'de-kaasgenoten.zip')
)

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

function New-DkgFlatThemeZip([string]$zipPath, [string]$sourceDir) {
    if (Test-Path $zipPath) {
        Remove-Item $zipPath -Force
    }

    $zip = [System.IO.Compression.ZipFile]::Open($zipPath, [System.IO.Compression.ZipArchiveMode]::Create)
    try {
        # style.css als eerste entry (sommige hosts lezen zip sequentieel).
        $stylePath = Join-Path $sourceDir 'style.css'
        $styleEntry = $zip.CreateEntry('style.css', [System.IO.Compression.CompressionLevel]::Optimal)
        $styleStream = $styleEntry.Open()
        try {
            $styleBytes = [System.IO.File]::ReadAllBytes($stylePath)
            $styleStream.Write($styleBytes, 0, $styleBytes.Length)
        } finally {
            $styleStream.Close()
        }

        Get-ChildItem -Path $sourceDir -Recurse -File | Where-Object {
            $_.Name -ne 'style.css'
        } | ForEach-Object {
            $rel = $_.FullName.Substring($sourceDir.Length + 1).Replace('\', '/')
            $entry = $zip.CreateEntry($rel, [System.IO.Compression.CompressionLevel]::Optimal)
            $entryStream = $entry.Open()
            try {
                $fileStream = [System.IO.File]::OpenRead($_.FullName)
                try {
                    $fileStream.CopyTo($entryStream)
                } finally {
                    $fileStream.Close()
                }
            } finally {
                $entryStream.Close()
            }
        }
    } finally {
        $zip.Dispose()
    }
}

foreach ($dest in $destinations) {
    New-DkgFlatThemeZip -zipPath $dest -sourceDir $themeDir
}

$verify = [System.IO.Compression.ZipFile]::OpenRead($destinations[0])
$styleEntry = $verify.Entries | Where-Object { $_.FullName -eq 'style.css' }
$nestedFolder = $verify.Entries | Where-Object { $_.FullName -like 'de-kaasgenoten/*' }
$backslashes = @($verify.Entries | Where-Object { $_.FullName -match '\\' })
$verify.Dispose()

if (-not $styleEntry) {
    Write-Error 'Validatie mislukt: style.css ontbreekt in zip-root'
}
if ($nestedFolder.Count -gt 0) {
    Write-Error 'Validatie mislukt: geneste de-kaasgenoten/ map gevonden'
}
if ($backslashes.Count -gt 0) {
    Write-Error "Validatie mislukt: $($backslashes.Count) paden met backslash"
}

$size = (Get-Item $destinations[0]).Length
Write-Host "OK: $($destinations[0]) ($size bytes)"
Write-Host "OK: $($destinations[1]) ($size bytes)"
Write-Host 'Structuur: style.css + overige bestanden direct in zip-root (geen submap)'

# WordPress-validatie: Theme Name in style.css, verplichte bestanden, geen BOM.
$extractTemp = Join-Path $env:TEMP ('dkg-wp-check-' + [guid]::NewGuid().ToString())
New-Item -ItemType Directory -Path $extractTemp -Force | Out-Null
[System.IO.Compression.ZipFile]::ExtractToDirectory($destinations[0], $extractTemp)

$stylePath = Join-Path $extractTemp 'style.css'
$functionsPath = Join-Path $extractTemp 'functions.php'
$themeCssPath = Join-Path $extractTemp 'assets/css/theme.css'
$indexPath = Join-Path $extractTemp 'index.php'

$errors = @()
if (-not (Test-Path $stylePath)) { $errors += 'style.css ontbreekt na uitpakken' }
if (-not (Test-Path $functionsPath)) { $errors += 'functions.php ontbreekt' }
if (-not (Test-Path $themeCssPath)) { $errors += 'assets/css/theme.css ontbreekt' }
if (-not (Test-Path $indexPath)) { $errors += 'index.php ontbreekt' }

if (Test-Path $stylePath) {
    $styleContent = Get-Content -Path $stylePath -Raw -Encoding UTF8
    if ($styleContent -notmatch 'Theme Name:\s*.+') { $errors += 'Theme Name ontbreekt in style.css' }
    if ($styleContent -notmatch 'Text Domain:\s*de-kaasgenoten') { $errors += 'Text Domain ontbreekt of onjuist' }
    $bytes = [System.IO.File]::ReadAllBytes($stylePath)
    if ($bytes.Length -ge 3 -and $bytes[0] -eq 0xEF -and $bytes[1] -eq 0xBB -and $bytes[2] -eq 0xBF) {
        $errors += 'style.css bevat UTF-8 BOM (kan WordPress-problemen geven)'
    }
}

Remove-Item $extractTemp -Recurse -Force

if ($errors.Count -gt 0) {
    Write-Error ("WordPress-validatie mislukt:`n- " + ($errors -join "`n- "))
}

Write-Host 'WordPress-validatie: OK (style.css, Theme Name, functions.php, theme.css, index.php)'
