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
        echo "过滤内容：" . $matches[0]; # 返回命中的规则
    }

    return false;
}