<?php

session_start();
$str = 'abcdefghigqwertt123';
$biankuang = imagecreatetruecolor(100, 25); //出现个黑色底板
$color = imagecolorallocate($biankuang, rand(0, 255), rand(0, 255), rand(0, 255)); //底板为蓝色
$color_zi = imagecolorallocate($biankuang, rand(0, 255), rand(0, 255), rand(0, 255)); //文字颜色
$color_line = imagecolorallocate($biankuang, rand(0, 255), rand(0, 255), rand(0, 255)); //线条颜色
$color_dian = imagecolorallocate($biankuang, rand(0, 255), rand(0, 255), rand(0, 255));
imagefilledrectangle($biankuang, 0, 0, 100, 25, $color);
$chang = strlen($str); //计算字符串长度
$tmp = '';
for ($i = 0; $i < 4; $i++) {
	$shuju = rand(0, $chang - 1);
	// imagettftext($biankuang, 7, 0, 37+70*$i, 43, $color_zi, './font/msyhbd.ttf ', $str[$shuju]);//改变字体	，
	imagechar($biankuang, 7, 20 + 20 * $i, 8, $str[$shuju], $color_zi); //字体大小只能为1-5  //加入
	$tmp .= $str[$shuju];
}
for ($i = 0; $i < 5; $i++) {
	imageline($biankuang, rand(0, 100), rand(0, 25), rand(0, 170), rand(0, 25), $color_line); //加入5条线条
}
for ($i = 0; $i <= 100; $i++) {
	imagesetpixel($biankuang, rand(0, 100), rand(0, 25), $color_dian);
}
$_SESSION['code'] = strtoupper($tmp);
header('content-type:image/png');
imagepng($biankuang);
?>
