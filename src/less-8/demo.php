<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "Ciallo～(∠・ω< )⌒★"';
$pattern = '/cat|tac|head|tail|more|less|nl/';
if(!preg_match($pattern,$cmd)){
    system($cmd);
}
