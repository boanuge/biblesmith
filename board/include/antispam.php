<?
session_start();
$zr = opendir("../data");
while($zro = readdir($zr)) {
if($zro != '.' && $zro != '..' && $zro) {break;}
}
closedir($zr);
$tzt = preg_replace("/[^0-9]/","",md5($_GET['no'].session_id().$zro));
for($t=0;$tzt < 99999;$t++) $tzt += $tzt;
$tzt = strval(substr($tzt,-6));
$src = imagecreatefromgif('antispam.gif');
$im = imagecreatetruecolor(66, 19);
for($i = 0;$i < 6;$i++) {
$s = $i*11;
$p = $tzt[$i]*11;
imagecopymerge($im, $src, $s, 0, $p, 0, 11, 19, 100);
}
imagedestroy($src);
header('Content-Type: image/gif');
imagegif($im);
imagedestroy($im);
?> 