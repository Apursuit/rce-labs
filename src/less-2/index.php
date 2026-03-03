<?php

# 包含功能函数
include'/var/www/html/core/func.php';

# 包含题目代码
include'demo.php';

# 调用过滤检查函数
if(isset($pattern)) {
check_filter_detail($pattern, $cmd);
}