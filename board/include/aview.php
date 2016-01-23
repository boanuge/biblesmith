<?
ob_start();
session_start();
$dot = "../";
include("common.php");
echo "0";
if(false !== strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])) {
if($_POST['xx']) $_POST['id'] .= "/^".$_POST['xx'];
$fn = fopen($dxr.$_POST['id']."/no.dat","r");
$fb = fopen($dxr.$_POST['id']."/body.dat","r");
while(!feof($fn)){
$fno = fgets($fn);
if((int)substr($fno,0,6) == $_POST['dd']) {
$xxx = explode("\x1b",$fno);
if($xxx[8] <= $mbr_level || substr($xxx[0],9) == $mbr_no || $_COOKIE["scrt_".$_POST['dd'].$id] == md5($_POST['dd']."_".$sessid.$id)) echo fgets($fb);
break;
} else fgets($fb);
}
fclose($fn);
fclose($fb);
}
?>