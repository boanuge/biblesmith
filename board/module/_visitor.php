<?
ob_start();
session_start();
header ("Content-Type: text/html; charset=UTF-8");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
if($_POST['mn'] >= 1) {
$vp = $_SESSION['m_nick'];
$vp = "m".str_pad($_POST['mn'],5).$vp;
} else $vp = preg_replace("`\.[0-9]+\.[0-9]+\.`",".***.***.",$_SERVER['REMOTE_ADDR']);
$time = time();
$fvv = '';
$meo = '';
$gu = "visitor.dat";
if(@filesize($gu)) {
$fg = fopen($gu,"a+");
while($fgo = fgets($fg)) {
$fgdo = trim(substr($fgo,10));
if(!$is && $fgdo == $vp) {$is = 1;$fvv .= $time.$fgdo."\n";$meo .= $fgdo."\x1b";}
else if($time - substr($fgo,0,10) < 10) {$fvv .= $fgo;$meo .= $fgdo."\x1b";}
}
fclose($fg);
}
if(!$is) {$fvv .= $time.$vp."\n";$meo .= $vp."\x1b";}
$fgg = fopen($gu,"w");
fputs($fgg,$fvv);
fclose($fgg);
echo $meo;
?>