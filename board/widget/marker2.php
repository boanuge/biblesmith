<?
ob_start();
session_start();
if($_POST['markr'] && $_SESSION['m_nick']) {
$time = time();
$mkfile = "marker2.dat";
while($time - @filemtime($mkfile."@@") < 3) {usleep(50000);$time = time();}
$jdmk = fopen($mkfile."@@","w");
$_POST['markr'] = stripslashes(urldecode($_POST['markr']));

$_POST['markr'] = preg_replace("`[^'\"=]http://([^\"'<>\r\n\s]+)`i", "<a target=\"_blank\" href=\"http://$1\">http://$1</a>", str_replace("\x1b","",str_replace("\n","",str_replace("\r","",str_replace("'","\"",$_POST['markr'])))));
fputs($jdmk,time().$_POST['markr']."\n");
if($dmk = @fopen($mkfile,"r")) {
while(!feof($dmk)) fputs($jdmk,fgets($dmk));
fclose($dmk);
}
fclose($jdmk);
copy($mkfile."@@",$mkfile);
@unlink($mkfile."@@");
} else if($_GET['page']) {
$mkfile = "marker2.dat";
if(file_exists($mkfile)) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="srboard" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<title>전광판 목록</title>
<style type='text/css'>
div {font-family:'Malgun Gothic',Gulim; font-size:10pt; line-height:18px}
#pageno {height:15px; text-align:center}
#pageno a, #pageno a:link, #pageno a:visited {padding:3px 10px 3px 10px; color:#222; text-decoration:none}
#pageno a:hover {background-color:#FFF}
#pageno b {color:#FF6633; font-size:11pt}
</style>
</head>
<body>
<div style='border:3px solid #FAFAFA;background-color:#B8B8B8;padding:1px'>
<div style='border:#FFFFFF solid;border-width:2px 1px 1px 2px;padding:10px;background-color:#F8F8F8'>
<?
$cnt = 15;
$i = 0;
$end = $_GET['page']*$cnt;
$start = $end - $cnt;
$dmk = fopen($mkfile,"r");
while($dmko = fgets($dmk)) {
if($i >= $start && $i < $end) {
echo "<b>[".date("m-d",substr($dmko,0,10))."]</b> ".substr($dmko,10),"<br />";
}
$i++;
}
fclose($dmk);
if($i > $cnt) {
?>
<hr style='border:0;background-color:#D9D9D9;height:3px' />
<div id='pageno'>
<?
$allp = (int)(($i -1)/$cnt) + 1;
$stp = (int)(($_GET['page']-1)/5)*5 + 1;
$etp = $stp + 5;

if($stp > 5) echo "<a href='?page=".($stp -1)."''>-</a>";
for($s = $stp;$s < $etp;$s++) {
if($s <= $allp) {
$ii = $s;
if($_GET['page'] == $ii) $ii = "<b>{$ii}</b>";
echo "<a href='?page={$ii}'>{$ii}</a>";
}}
if($s <= $allp) echo "<a href='?page={$etp}''>-</a>";
?></div><?
}
?>
</div></div>
</body>
</html>
<?
}
} else {
?>
<table id='marker_tbl' cellpadding='0' cellspacing='1px'>
<tr><td class='mkcell'>
<div id='marker' style='height:12px;overflow:hidden' onmouseover='clearTimeout(changemk)' onmouseout='changemk = setTimeout("chmarker()",1000)'><div style='line-height:20px;margin-top:20px'><?
$mkfile = "widget/marker2.dat";
$dmk = fopen($mkfile,"r");
for($kk = -1;$kk <= 10 && ($dmko = trim(fgets($dmk)));$kk++) {
echo "<b>[".date("m-d",substr($dmko,0,10))."]</b> ".substr($dmko,10)."<br />";
}
fclose($dmk);
$kk = $kk*20;
?></div></div></div>
<input type='button' value='목록' onclick='popup("widget/marker2.php?page=1",600,360)' class='srbt' style='float:right;width:50px' />
<? if($mbr_level==9){?>
<input type='button' class='srbt' onclick='$("wmark").style.display=($("wmark").style.display=="block")?"none":"block";' style='float:right;width:50px' value='쓰기' />
<table id='wmark' style='display:none;padding:2% 2% 0 2%;width:100%;clear:both'><tr><td width='100%'><input type='text' id='markr' style='width:100%' onkeydown="setTimeout('if(ekc ==13) mrkwrt()',10)" /></td><td width='55px'><input type='button' value='쓰기' onclick='mrkwrt()' class='srbt' style='width:50px;margin-left:5px' /></td></tr></table>
<?}?><div class='fcler'></div>
</td></tr></table>
<script type='text/javascript'>
/*<![CDATA[*/
var changemk;
var n = 4;
function chmarker(nn) {
if(nn) n = 4;
var m = 0;
nn = n*-1;
if(n >= <?=$kk?>) {n = 4;m = 4000;}
else {n = n+10;m = ((n % 20) != 14)? 50:4000;}
$('marker').firstChild.style.marginTop = nn + "px";
changemk = setTimeout("chmarker()",m);
}
function mrkwrt() {
var nkfval = $('markr').value;
$('markr').value = '';
$('marker').firstChild.innerHTML = nkfval + "<br />" + $('marker').firstChild.innerHTML;
clearTimeout(changemk);
chmarker(1);
$('wmark').style.display="none";
startax("widget/marker2.php?&markr=" + encodeURIComponent(nkfval));
}
function wmk_open() {
var wmrt = $('wmark');
var mrkr = $('markr');
if(wmrt.style.display=='block') wmrt.style.display = 'none';
else {wmrt.style.display = 'block';//mrkr.style.width = mrkr.parentNode.scrollWidth +'px';
alert(mrkr.parentNode.scrollWidth);
}}
setTimeout("chmarker(1)",50);
/*]]>*/
</script>
<?

}
?>
