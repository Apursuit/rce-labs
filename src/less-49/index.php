<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "<br>Ciallo～(∠・ω< )⌒★"';
# 放出 $
$pattern = '/cat|tac|head|tail|more|less|nl|sort|uniq|dd|rev|od|xxd|hexdump|base32|base64|strings|grep|file|date|diff|find|cp|mv|ping|curl|echo|wget|nc|ncat|sed|\x20|\x09|\x0a|\{|\}|\'|\"|\?|\*|\\\\/';
if(!preg_match($pattern,$cmd)){
system($cmd);
}