# Ensure Node.js 22 is used for Vite 7
# This script ensures the correct Node.js version is used before running npm run dev

Write-Host "Switching to Node.js 22..." -ForegroundColor Cyan
nvm use 22 | Out-Null

# Get the Node.js path from nvm
$nvmRoot = if ($env:NVM_HOME) { $env:NVM_HOME } else { "$env:APPDATA\nvm" }
$nodePath = "$nvmRoot\v22.19.0"

if (Test-Path "$nodePath\node.exe") {
    # Prepend Node.js 22 to PATH to ensure it's used
    $env:Path = "$nodePath;$env:Path"
    Write-Host "Using Node.js version: $(node --version)" -ForegroundColor Green
    Write-Host "Starting Vite dev server...`n" -ForegroundColor Cyan
    npm run dev
} else {
    Write-Host "Error: Node.js 22.19.0 not found at $nodePath" -ForegroundColor Red
    Write-Host "Please install Node.js 22 using: nvm install 22" -ForegroundColor Yellow
    exit 1
}
