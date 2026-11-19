<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "Ciallo～(∠・ω< )⌒★"';
$pattern = '/cat|tac|head|tail|more|less|nl|sort|uniq|fold|expand|dd|rev|od|xxd|hexdump|base32|base64|strings|grep|file|date|diff|find|cp|mv|tee|ping|curl|echo|wget|nc|ncat|sed|\?|\*|\[|\]/';
if(!preg_match($pattern,$cmd)){
    system($cmd);
}
