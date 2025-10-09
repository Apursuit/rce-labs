<?php
$flag = file_get_contents('/flag');
$flag = "# " . $flag;
system("echo '$flag' >> flag.php");