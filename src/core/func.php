<?php
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