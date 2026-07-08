<?php
$data = json_decode(file_get_contents('data.json'), true);
if (!is_array($data)) $data = [];

function challenge_level_number($key) {
    if (preg_match('/less-(\d+)/', $key, $matches)) {
        return (int) $matches[1];
    }
    if (preg_match('/(\d+)/', $key, $matches)) {
        return (int) $matches[1];
    }
    return 0;
}

uksort($data, function ($a, $b) {
    $numA = challenge_level_number($a);
    $numB = challenge_level_number($b);
    return $numA <=> $numB;
});

$groups = [
    '基础命令' => [],
    '绕过技巧' => [],
    '最终考察' => [],
];

foreach ($data as $key => $info) {
    $num = challenge_level_number($key);
    $item = [
        'key' => $key,
        'num' => $num,
        'title' => isset($info['title']) ? $info['title'] : $key,
        'description' => isset($info['description']) ? $info['description'] : '',
        'url' => isset($info['url']) ? $info['url'] : '/' . $key . '/',
    ];

    if ($num >= 51) {
        $groups['最终考察'][] = $item;
    } elseif ($num >= 32) {
        $groups['绕过技巧'][] = $item;
    } else {
        $groups['基础命令'][] = $item;
    }
}

include 'core/sidebar.php';
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>RCE-labs 命令执行</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body class="has-sidebar">
<?php sidebar_nav($data, null); ?>

<main class="main-content">
    <header class="home-header">
        <h1 class="home-title">RCE-labs</h1>
        <p class="home-subtitle">命令执行练习题目列表</p>
    </header>

    <div class="challenge-list" aria-label="题目列表">
        <?php foreach ($groups as $groupName => $items): ?>
            <?php if (empty($items)) continue; ?>
            <section class="challenge-section">
                <div class="challenge-section-header">
                    <h2><?= htmlspecialchars($groupName) ?></h2>
                    <span><?= count($items) ?> 题</span>
                </div>

                <div class="challenge-table">
                    <?php foreach ($items as $item): ?>
                        <a class="challenge-row" href="<?= htmlspecialchars($item['url']) ?>">
                            <span class="challenge-level">Level <?= str_pad((string) $item['num'], 2, '0', STR_PAD_LEFT) ?></span>
                            <span class="challenge-topic"><?= htmlspecialchars($item['title']) ?></span>
                            <span class="challenge-summary"><?= htmlspecialchars($item['description']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>

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

        var activeItem = document.querySelector('.sidebar-item.active');
        if (activeItem) {
            activeItem.scrollIntoView({ block: 'nearest', behavior: 'instant' });
        }
    })();
    </script>
</main>
</body>
</html>
