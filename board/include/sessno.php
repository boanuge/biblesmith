<?
if($_POST['js']) {
header ("Content-Type: text/html; charset=UTF-8");
$zr = opendir("../data");
while($zro = readdir($zr)) {
if($zro != '.' && $zro != '..' && $zro) break;
}
closedir($zr);
}
$sess = (int)substr(preg_replace("`[^0-9]`","",md5($_SERVER['REMOTE_ADDR'].$zro)),0,3);
while($sess < 100) {
$sess = $sess*10;
}
if($_POST['js'] && strchr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])) echo $sess;
?>