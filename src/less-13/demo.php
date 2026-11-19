<?php
# /flag
highlight_file(__FILE__);
$cmd = $_GET['cmd'] ?? 'echo "Ciallo～(∠・ω< )⌒★"';
$pattern = '/cat|tac|head|tail|more|nl|less|sort|uniq|fold|expand|dd|rev|od/';
if(!preg_match($pattern,$cmd)){
    system($cmd);
}
