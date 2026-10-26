
<?php
$output = '';
$error = '';
$ip = '';

if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];

    // Intentionally vulnerable: command injection demonstration.
    // Run only in an isolated local CTF environment.
    $cmd = "ping -c 3 " . $ip;

    ob_start();
    system($cmd);
    $output = ob_get_clean();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Nexuora | Security Lab</title>
<style>
:root {
    color-scheme: dark;
    --bg: #090b12;
    --panel: #111521;
    --border: #252b3b;
    --muted: #8b94aa;
    --green: #75f5b2;
    --purple: #a78bfa;
    --text: #edf0f7;
}
* { box-sizing: border-box; }
body {
    margin: 0;
    background: radial-gradient(ellipse at 80% 0%, #21183c 0, transparent 38%), var(--bg);
    color: var(--text);
    font: 14px/1.6 Inter, system-ui, sans-serif;
}
.layout { display: flex; min-height: 100vh; }
.sidebar {
    width: 235px;
    flex-shrink: 0;
    padding: 28px 18px;
    background: #0c0f18;
    border-right: 1px solid var(--border);
}
.brand {
    font-size: 20px;
    font-weight: 800;
    margin: 0 0 42px 8px;
}
.logo {
    display: inline-grid;
    place-items: center;
    width: 35px;
    height: 35px;
    margin-right: 8px;
    background: var(--green);
    color: #09120e;
    border-radius: 11px;
}
.label {
    margin: 24px 10px 10px;
    color: #69738a;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 1.8px;
}
.nav {
    display: block;
    padding: 11px 12px;
    margin: 4px 0;
    border-radius: 9px;
    color: var(--muted);
    text-decoration: none;
}
.nav.active {
    background: #18251f;
    color: var(--green);
    border: 1px solid #294b3c;
}
main { flex: 1; min-width: 0; }
.topbar {
    min-height: 74px;
    padding: 18px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid var(--border);
}
.muted { color: var(--muted); }
.user {
    padding: 7px 12px;
    border: 1px solid var(--border);
    border-radius: 25px;
    white-space: nowrap;
}
.content { max-width: 1200px; padding: 32px; margin: auto; }
.eyebrow {
    color: var(--green);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
}
h1 { margin: 8px 0; font-size: clamp(28px, 4vw, 38px); letter-spacing: -1px; }
.hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 28px;
}
.badge, .tag {
    color: var(--green);
    background: #14251d;
    border: 1px solid #315643;
    border-radius: 20px;
    padding: 6px 10px;
    font-size: 11px;
    white-space: nowrap;
}
.grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}
.card {
    min-width: 0;
    padding: 21px;
    border: 1px solid var(--border);
    border-radius: 15px;
    background: linear-gradient(145deg, #141927, #10131e);
}
.card-title { color: var(--muted); font-size: 12px; }
.metric { margin-top: 12px; font-size: 25px; font-weight: 750; }
.metric-sub { color: var(--muted); font-size: 12px; }
.columns {
    display: grid;
    grid-template-columns: minmax(0, 1.1fr) minmax(0, .9fr);
    gap: 18px;
    margin-top: 20px;
}
h2 { margin: 0 0 5px; font-size: 17px; }
input {
    display: block;
    width: 100%;
    padding: 13px;
    margin: 10px 0 14px;
    color: var(--text);
    background: #090c12;
    border: 1px solid #30374a;
    border-radius: 9px;
    font: inherit;
}
input:focus { outline: 1px solid var(--purple); }
button {
    width: 100%;
    padding: 12px;
    color: #09130e;
    background: var(--green);
    border: 0;
    border-radius: 9px;
    font: inherit;
    font-weight: 800;
    cursor: pointer;
}
.console {
    min-height: 180px;
    max-height: 360px;
    overflow: auto;
    padding: 15px;
    margin-top: 14px;
    border: 1px solid var(--border);
    border-radius: 10px;
    background: #080b11;
    color: var(--green);
    font: 12px/1.8 ui-monospace, Consolas, monospace;
    white-space: pre-wrap;
    overflow-wrap: anywhere;
}
.tool-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
}
.tool-row:last-child { border-bottom: 0; }
footer { padding-top: 25px; color: #687188; font-size: 11px; }
@media (max-width: 850px) {
    .sidebar { width: 185px; }
    .grid { grid-template-columns: 1fr; }
    .columns { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
    .sidebar { display: none; }
    .content { padding: 22px 16px; }
    .topbar { padding: 16px; }
    .hero { align-items: flex-start; flex-direction: column; }
}
</style>
</head>
<body>
<div class="layout">
<aside class="sidebar">
    <div class="brand"><span class="logo">ϟ</span>Nexuora<span style="color:var(--green)">.</span></div>
    <div class="label">WORKSPACE</div>
    <a class="nav active" href="#">▦ &nbsp; Dashboard</a>
    <a class="nav" href="#scanner">⌕ &nbsp; Ping utility</a>
    <a class="nav" href="#environment">⌘ &nbsp; Lab environment</a>
    <div class="label">SYSTEM</div>
    <a class="nav" href="#console">◉ &nbsp; Activity console</a>
</aside>

<main>
<header class="topbar">
    <div class="muted">Workspace / <span style="color:var(--text)">Dashboard</span></div>
    <div class="user">◉ &nbsp; Local lab</div>
</header>

<div class="content">
    <section class="hero">
        <div>
            <div class="eyebrow">Security research platform</div>
            <h1>Welcome to your lab.</h1>
            <div class="muted">Web security testing environment</div>
        </div>
        <div class="badge">● &nbsp; Interface online</div>
    </section>

    <section class="grid">
        <div class="card">
            <div class="card-title">WEB SERVER</div>
            <div class="metric">Apache</div>
            <div class="metric-sub">PHP application</div>
        </div>
        <div class="card">
            <div class="card-title">DEPLOYMENT</div>
            <div class="metric">Docker</div>
            <div class="metric-sub">Containerized lab</div>
        </div>
        <div class="card">
            <div class="card-title">NETWORK</div>
            <div class="metric">evilnet</div>
            <div class="metric-sub">Compose bridge</div>
        </div>
    </section>

    <section class="columns">
        <div class="card" id="scanner">
            <h2>Ping utility</h2>
            <div class="muted">Network diagnostic interface</div>
            <form method="GET">
                <label for="ip">Target IP address</label>
                <input id="ip" name="ip"
                    placeholder="8.8.8.8"
                    value="<?= htmlspecialchars($ip, ENT_QUOTES, 'UTF-8') ?>">
                <button type="submit">Run diagnostic →</button>
            </form>
            <div class="muted" style="font-size:12px">
                Educational lab · Use only in your isolated environment.
            </div>
        </div>

        <div class="card" id="console">
            <h2>Activity console</h2>
            <div class="muted">Command output</div>
            <div class="console"><?php
                if ($ip !== '') {
                    echo htmlspecialchars(
                        "Target: " . $ip . "\n\n" . $output,
                        ENT_QUOTES,
                        'UTF-8'
                    );
                } else {
                    echo "[SYSTEM] Interface initialized\n[INFO] Awaiting target input...";
                }
            ?></div>
        </div>
    </section>

    <section class="card" id="environment" style="margin-top:20px">
        <h2>Lab components</h2>
        <div class="tool-row">
            <div><strong>PHP / Apache</strong><div class="muted">Web application</div></div>
            <span class="tag">Configured</span>
        </div>
        <div class="tool-row">
            <div><strong>Kali Linux</strong><div class="muted">Security testing container</div></div>
            <span class="tag">Configured</span>
        </div>
        <div class="tool-row">
            <div><strong>Docker bridge</strong><div class="muted">Internal service network</div></div>
            <span class="tag">Configured</span>
        </div>
    </section>

    <footer>Nexuora Security Lab · Local educational environment</footer>
</div>
</main>
</div>
</body>
</html>
