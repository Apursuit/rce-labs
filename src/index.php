<?php
require_once __DIR__ . '/core/func.php';

$data = json_decode(file_get_contents('data.json'), true);
if (!is_array($data)) $data = [];

uksort($data, function ($a, $b) {
    return challenge_level_parts($a) <=> challenge_level_parts($b);
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
        'label' => challenge_level_label($key),
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
                            <span class="challenge-level">Level <?= htmlspecialchars($item['label']) ?></span>
                            <span class="challenge-topic"><?= htmlspecialchars($item['title']) ?></span>
                            <span class="challenge-summary"><?= htmlspecialchars($item['description']) ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>

</main>

<script src="/app.js"></script>
</body>
</html>
