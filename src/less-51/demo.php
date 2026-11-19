<?php
# /flag
# hints: /info.php
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "Ciallo～(∠・ω< )⌒★"';
exec($cmd);