<?php
# 解析关卡编号，返回 [数字, 字母后缀]
function challenge_level_parts($key) {
    if (preg_match('/less-(\d+)([a-z]*)/i', $key, $matches)) {
        return [(int) $matches[1], strtolower($matches[2])];
    }
    if (preg_match('/(\d+)([a-z]*)/i', $key, $matches)) {
        return [(int) $matches[1], strtolower($matches[2])];
    }
    return [0, ''];
}

# 纯数字编号，用于分组阈值判断
function challenge_level_number($key) {
    $parts = challenge_level_parts($key);
    return $parts[0];
}

# 展示用标签，如 09、09a
function challenge_level_label($key) {
    $parts = challenge_level_parts($key);
    return str_pad((string) $parts[0], 2, '0', STR_PAD_LEFT) . $parts[1];
}

# 检查用户命中的规则并提示
function check_filter_detail($pattern, $cmd) {
    if (empty($pattern)) {
        return false;
    }

    if (@preg_match($pattern, '') === false) {
        return false;
    }

    if (preg_match($pattern, $cmd, $matches)) {
        echo '<div class="filter-hit">匹配过滤规则：' . htmlspecialchars($matches[0], ENT_QUOTES) . '</div>';
    }

    return false;
}
