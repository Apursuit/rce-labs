<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "Ciallo～(∠・ω< )⌒★"';
$pattern = '/\x20/';
if(!preg_match($pattern,$cmd)){
system($cmd);
}