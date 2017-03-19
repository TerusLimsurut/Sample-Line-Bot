<?php
$file = fopen("Log_chat_2.txt","w");
echo fwrite($file,"Hello World. Testing!");
fclose($file);
?>