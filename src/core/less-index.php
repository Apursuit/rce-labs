<?php
if (!defined('RCE_LABS_LEVEL_DIR')) {
    http_response_code(404);
    exit;
}

$levelDir   = RCE_LABS_LEVEL_DIR;
$currentDir = basename($levelDir);

include '/var/www/html/core/func.php';

ob_start();
include $levelDir . '/demo.php';
if (isset($pattern)) {
    check_filter_detail($pattern, $cmd);
}
$raw = ob_get_clean();

$pos = strpos($raw, '</code>');
if ($pos !== false) {
    $sourceHtml = substr($raw, 0, $pos + 7);
    $resultText = trim(substr($raw, $pos + 7));
    $resultText = str_replace(['<pre>', '</pre>'], '', $resultText);
} else {
    $sourceHtml = $raw;
    $resultText = '';
}

$data = json_decode(file_get_contents('/var/www/html/data.json'), true);
if (!is_array($data)) $data = [];

$currentTitle = isset($data[$currentDir]) ? $data[$currentDir]['title'] : $currentDir;
$currentDesc = isset($data[$currentDir]) ? $data[$currentDir]['description'] : '';
$currentCmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';
$currentLevel = challenge_level_label($currentDir);

include '/var/www/html/core/sidebar.php';
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($currentTitle) ?> - RCE-labs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
</head>
<body class="has-sidebar">
<?php sidebar_nav($data, $currentDir); ?>

<main class="main-content challenge-layout">
    <header class="challenge-header">
        <div class="challenge-meta">
            <span>Level <?= htmlspecialchars($currentLevel) ?></span>
            <span>RCE-labs</span>
        </div>
        <h1><?= htmlspecialchars($currentTitle) ?></h1>
        <p class="challenge-desc"><?= htmlspecialchars($currentDesc) ?></p>
    </header>

    <div class="challenge-body">
        <section class="challenge-panel">
            <div class="panel-title">Source</div>
            <div class="challenge-source"><?= $sourceHtml ?></div>
        </section>

        <?php if ($resultText !== ''): ?>
        <section class="challenge-panel">
            <div class="panel-title">Output</div>
            <div class="challenge-result"><?= $resultText ?></div>
        </section>
        <?php endif; ?>
    </div>

    <form method="get" class="cmd-form" autocomplete="off">
        <div class="cmd-input-wrapper">
            <span class="cmd-prompt">$</span>
            <input type="text" name="cmd" id="cmd-input"
                   class="cmd-input"
                   value="<?= htmlspecialchars($currentCmd) ?>"
                   placeholder="按 / 聚焦输入框，Enter 执行"
                   autofocus>
            <button type="button" class="cmd-clear" id="cmd-clear" title="清空输入">&times;</button>
            <button type="submit" class="cmd-submit">执行</button>
        </div>
    </form>
</main>

<script src="/app.js"></script>
</body>
</html>
