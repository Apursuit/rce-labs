<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "Ciallo～(∠・ω< )⌒★"';
$cmd = "# " . $cmd;
system($cmd);