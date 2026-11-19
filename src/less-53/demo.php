<?php
# /flag
# hints: /info.php
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? '';
$pattern = '/[a-zA-Z0-9]/';
if ($cmd !== '' && !preg_match($pattern, $cmd)) {
    system($cmd);
}
