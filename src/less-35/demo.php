<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "<br>Ciallo～(∠・ω< )⌒★"';
$cmd = "ls " . $cmd;
system($cmd);