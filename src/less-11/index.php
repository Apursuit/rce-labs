<?php
include '/var/www/html/core/func.php';

ob_start();
include 'demo.php';
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

$currentDir = basename(__DIR__);
$data = json_decode(file_get_contents('/var/www/html/data.json'), true);
if (!is_array($data)) $data = [];

$currentTitle = isset($data[$currentDir]) ? $data[$currentDir]['title'] : $currentDir;
$currentDesc = isset($data[$currentDir]) ? $data[$currentDir]['description'] : '';
$currentCmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';
$currentLevel = 0;
if (preg_match('/less-(\d+)/', $currentDir, $matches)) {
    $currentLevel = (int) $matches[1];
}

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
            <span>Level <?= str_pad((string) $currentLevel, 2, '0', STR_PAD_LEFT) ?></span>
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
                   placeholder="输入命令，Enter 执行"
                   autofocus>
            <button type="button" class="cmd-clear" id="cmd-clear" title="清空输入">&times;</button>
            <button type="submit" class="cmd-submit">执行</button>
        </div>
    </form>
</main>

<script>
(function () {
    var toggleBtn = document.getElementById('theme-toggle');
    var body = document.body;

    function applyTheme(isDark) {
        var icon;
        var label;
        if (toggleBtn) {
            icon = toggleBtn.querySelector('.theme-icon');
            label = toggleBtn.querySelector('.theme-btn-label');
        }

        if (isDark) {
            body.classList.add('dark-theme');
            if (icon) { icon.classList.remove('moon'); icon.classList.add('sun'); }
            if (label) label.textContent = '浅色模式';
            localStorage.setItem('theme', 'dark');
        } else {
            body.classList.remove('dark-theme');
            if (icon) { icon.classList.remove('sun'); icon.classList.add('moon'); }
            if (label) label.textContent = '深色模式';
            localStorage.setItem('theme', 'light');
        }
    }

    var saved = localStorage.getItem('theme');
    var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    applyTheme(saved === 'dark' || (!saved && prefersDark));

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            applyTheme(!body.classList.contains('dark-theme'));
        });
    }

    document.addEventListener('keydown', function (e) {
        var input = document.getElementById('cmd-input');
        if (!input) return;
        var tag = document.activeElement ? document.activeElement.tagName : '';
        if (e.key === '/' && document.activeElement !== input && tag !== 'INPUT' && tag !== 'TEXTAREA') {
            e.preventDefault();
            input.focus();
            input.select();
        }
    });

    var cmdInput = document.getElementById('cmd-input');
    var cmdClear = document.getElementById('cmd-clear');
    if (cmdInput) {
        cmdInput.focus();
        var len = cmdInput.value.length;
        cmdInput.setSelectionRange(len, len);

        function toggleClear() {
            if (!cmdClear) return;
            if (cmdInput.value.length > 0) {
                cmdClear.classList.add('visible');
            } else {
                cmdClear.classList.remove('visible');
            }
        }

        cmdInput.addEventListener('input', toggleClear);
        toggleClear();
    }

    if (cmdClear) {
        cmdClear.addEventListener('click', function () {
            cmdInput.value = '';
            cmdInput.focus();
            cmdClear.classList.remove('visible');
        });
    }

    var activeItem = document.querySelector('.sidebar-item.active');
    if (activeItem) {
        activeItem.scrollIntoView({ block: 'nearest', behavior: 'instant' });
    }
})();
</script>
</body>
</html>
