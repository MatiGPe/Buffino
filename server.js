const { exec } = require("child_process");

// Usar PHP para manejar solicitudes
exec("php -S 0.0.0.0:3000 -t .", (error, stdout, stderr) => {
    if (error) {
        console.error(`Error: ${error}`);
        return;
    }
    console.log(`stdout: ${stdout}`);
    console.error(`stderr: ${stderr}`);
});
