@echo off
REM Ensure Node.js 22 is used before running npm dev
echo Switching to Node.js 22...
call nvm use 22 >nul 2>&1

REM Get nvm root path
if defined NVM_HOME (
    set "NVM_ROOT=%NVM_HOME%"
) else (
    set "NVM_ROOT=%APPDATA%\nvm"
)

REM Set Node.js 22 path
set "NODE_PATH=%NVM_ROOT%\v22.19.0"

REM Verify Node.js 22 exists and add to PATH
if exist "%NODE_PATH%\node.exe" (
    set "PATH=%NODE_PATH%;%PATH%"
    echo Using Node.js version:
    node --version
    echo.
    echo Starting Vite dev server...
    echo.
    call npx vite
) else (
    echo Error: Node.js 22.19.0 not found at %NODE_PATH%
    echo Please install Node.js 22 using: nvm install 22
    exit /b 1
)
