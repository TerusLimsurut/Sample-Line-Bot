<?php
$file = 'Log_chat_2.txt';
$buffer = 'my new line here';

if (file_exists($file)) {
		$buffer = file_get_contents($file) . "\n" . $buffer;
		echo "Testing!";
}

$success = file_put_contents($file, $buffer);
echo fwrite($file,"Hello World. Testing!");
fclose($file);
?>