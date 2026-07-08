<?php
function sidebar_nav($data, $currentKey = null) {
    if (!function_exists('challenge_level_number')) {
        function challenge_level_number($key) {
            if (preg_match('/less-(\d+)/', $key, $matches)) {
                return (int) $matches[1];
            }
            if (preg_match('/(\d+)/', $key, $matches)) {
                return (int) $matches[1];
            }
            return 0;
        }
    }

    $groups = [
        '基础命令' => [],
        '绕过技巧' => [],
        '最终考察' => [],
    ];

    foreach ($data as $key => $info) {
        $num = challenge_level_number($key);
        $item = [
            'key' => $key,
            'title' => isset($info['title']) ? $info['title'] : $key,
            'num' => $num,
        ];

        if ($num >= 51) {
            $groups['最终考察'][] = $item;
        } elseif ($num >= 32) {
            $groups['绕过技巧'][] = $item;
        } else {
            $groups['基础命令'][] = $item;
        }
    }
?>
<aside class="sidebar">
    <a href="/" class="sidebar-brand">RCE-labs</a>
    <nav class="sidebar-nav" aria-label="关卡导航">
        <a href="/" class="sidebar-item<?= $currentKey === null ? ' active' : '' ?>">
            <span class="sidebar-label">首页</span>
        </a>
        <?php foreach ($groups as $groupName => $items): ?>
        <?php if (empty($items)) continue; ?>
        <div class="sidebar-group">
            <div class="sidebar-group-title"><?= htmlspecialchars($groupName) ?></div>
            <?php foreach ($items as $item):
                $isActive = ($item['key'] === $currentKey);
            ?>
            <a href="/<?= htmlspecialchars($item['key']) ?>/"
               class="sidebar-item<?= $isActive ? ' active' : '' ?>"
               title="<?= htmlspecialchars($item['title']) ?>">
                <span class="sidebar-num"><?= str_pad((string) $item['num'], 2, '0', STR_PAD_LEFT) ?></span>
                <span class="sidebar-label"><?= htmlspecialchars($item['title']) ?></span>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </nav>
    <a href="https://the0n3.top/pages/rce-labs/" target="_blank" rel="noreferrer" class="sidebar-writeup">Writeup</a>
    <button id="theme-toggle" class="sidebar-theme-btn" title="切换深色 / 浅色模式">
        <span class="theme-btn-icon"><span class="theme-icon moon"></span></span>
        <span class="theme-btn-label">深色模式</span>
        <span class="theme-btn-switch"><span class="theme-btn-knob"></span></span>
    </button>
</aside>
<?php
}
