# PowerShell script to update CSS paths in all PHP files
$phpFiles = Get-ChildItem -Path "*.php" -Recurse

foreach ($file in $phpFiles) {
    $content = Get-Content -Path $file.FullName -Raw
    
    # Update CSS paths
    $content = $content -replace 'href="poppins.css"', 'href="assets/css/poppins.css"'
    $content = $content -replace 'href="montserrat.css"', 'href="assets/css/montserrat.css"'
    $content = $content -replace 'href="main.css"', 'href="assets/css/main.css"'
    
    # Only update script.js references that are not inline scripts
    $content = $content -replace 'src="script.js"', 'src="assets/js/script.js"'
    
    # Save the updated content back to the file
    Set-Content -Path $file.FullName -Value $content
    
    Write-Host "Updated file: $($file.Name)"
}

Write-Host "All files updated successfully." 