<!DOCTYPE html>
<html><body>
<h2>Ping Utility (v1.0)</h2>
<form method="GET">
    <label>Enter IP to ping:</label><br>
    <input type="text" name="ip" placeholder="8.8.8.8" value="<?= htmlspecialchars($_GET['ip'] ?? '') ?>">
    <button type="submit">Ping</button>
</form>

<?php
if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];
    // 💀 VULNERABLE: Direct user input into shell command
    $cmd = "ping -c 3 " . $ip;
    echo "<pre>";
    echo "Executing: $cmd\n\n";
    system($cmd);  // <-- RCE HERE
    echo "</pre>";
}
?>
</body></html>