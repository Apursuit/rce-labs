<?php
# flag.php
@include"flag.php";
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "<br>Ciallo～(∠・ω< )⌒★"';
$pattern = '/cat|tac|head|tail|more|less|nl|sort|uniq|od|xxd|hexdump|base32|base64|strings|grep|file|find|cp/';
if(!preg_match($pattern,$cmd)){
    system($cmd);
}
