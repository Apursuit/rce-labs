<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "<br>Ciallo～(∠・ω< )⌒★"';
$pattern = '/cat|tac|head|tail|more|less|nl|sort|uniq|od|xxd|hexdump|base32|base64|strings|grep|file|find|ping|curl|echo|wget|nc|\x20|\x09|\x0a|\$|\{|\}|\'|\"/';
if(!preg_match($pattern,$cmd)){
system($cmd);
}