<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "<br>Ciallo～(∠・ω< )⌒★"';
$pattern = '/cat|tac|head|tail|more|less|nl|sort|uniq|dd|rev|od|xxd|hexdump|base32|base64|strings|grep|file|date|diff/';
if(!preg_match($pattern,$cmd)){
    system($cmd);
}
