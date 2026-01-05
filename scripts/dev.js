#!/usr/bin/env node

/**
 * Dev script wrapper that ensures Node.js 22+ is used
 */

const { execSync } = require("child_process");
const { spawn } = require("child_process");
const os = require("os");
const path = require("path");

function getNodeVersion() {
    try {
        const version = execSync("node --version", {
            encoding: "utf-8",
        }).trim();
        const match = version.match(/^v(\d+)\./);
        return match ? parseInt(match[1], 10) : 0;
    } catch (error) {
        return 0;
    }
}

function switchToNode22() {
    const platform = os.platform();

    if (platform === "win32") {
        // On Windows, use nvm to switch
        try {
            console.log("Switching to Node.js 22...");
            execSync("nvm use 22", { stdio: "inherit" });

            // Get nvm path and update process.env.PATH
            const nvmRoot =
                process.env.NVM_HOME || path.join(process.env.APPDATA, "nvm");
            const nodePath = path.join(nvmRoot, "v22.19.0");

            if (require("fs").existsSync(path.join(nodePath, "node.exe"))) {
                process.env.PATH = `${nodePath};${process.env.PATH}`;
                console.log(
                    `Using Node.js: ${execSync("node --version", {
                        encoding: "utf-8",
                    }).trim()}`
                );
                return true;
            }
        } catch (error) {
            console.error("Failed to switch to Node.js 22:", error.message);
            return false;
        }
    }

    return false;
}

const nodeVersion = getNodeVersion();

if (nodeVersion < 20) {
    console.error(
        `\n❌ Error: Node.js version ${nodeVersion} is not supported.`
    );
    console.error("Vite 7 requires Node.js 20.19+ or 22.12+");
    console.error("\nPlease run: nvm use 22\n");

    if (os.platform() === "win32") {
        const switched = switchToNode22();
        if (!switched) {
            process.exit(1);
        }
    } else {
        process.exit(1);
    }
} else if (nodeVersion === 20 && getNodeVersion() < 19) {
    console.error(`\n❌ Error: Node.js version ${nodeVersion} is too old.`);
    console.error("Vite 7 requires Node.js 20.19+ or 22.12+");
    process.exit(1);
}

// Spawn vite process
const vite = spawn("npx", ["vite"], {
    stdio: "inherit",
    shell: true,
    env: process.env,
});

vite.on("close", (code) => {
    process.exit(code);
});
