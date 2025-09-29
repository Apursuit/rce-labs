<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "<br>Ciallo～(∠・ω< )⌒★"';
$pattern = '/\x20|\x09|\x0a|\$|\{|\}/';
if(!preg_match($pattern,$cmd)){
system($cmd);
}