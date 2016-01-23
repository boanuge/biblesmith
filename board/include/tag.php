<?
ob_start();
session_start();
$dot = "../";
include("common.php");
$tgx = $dxr.$id."/tag.dat";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$sett[0]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<link rel='stylesheet' type='text/css' href='srboard.css' />
<style type='text/css'>
body {background-color:#F7F7F7; margin:7px; overflow:hidden; font-size:9pt; font-family:Gulim}
input {font-size:12px}
.menutg .fav4 {font-size:26px; line-height:28px}
.menutg .fav3 {font-size:22px; line-height:24px}
.menutg .fav2 {font-size:18px; line-height:21px}
.menutg .fav1 {font-size:15px; line-height:18px}
.menutg .fav0 {font-size:12px; line-height:16px}
.pageno a:link, .pageno a:visited, .pageno a:hover, .pageno a:active {color:#4B4B4B}
</style>
</head>
<body onload="enload()" ondblclick="parent.opeclo('tag')" class='menutg'>
<div style='padding:5px 0px 10px 5px'><input type="button" value="인기순" class="srbt" onclick="rplace('?id=<?=$eid?>&amp;order=1&amp;tag=1')" />
<input type="button" value="빈도순" class="srbt" onclick="rplace('?id=<?=$eid?>&amp;order=2&amp;tag=1')" />
<input type="button" value="시간순" class="srbt" onclick="rplace('?id=<?=$eid?>&amp;order=<?=$_GET['order']?>&amp;tag=1')" /></div>
<?
$i = 1;
$sg = ($_GET['tag'] - 1)*$sett[23] + 1;
$eg = $sg + $sett[23];
$tg = fopen($tgx, "r");
if($_GET['order']) {
while($tgo = trim(fgets($tg))){
if($_GET['order'] == 1) $tgn = (int)substr($tgo,-8,4);
if($_GET['order'] == 2) $tgn = (int)substr($tgo,-4);
$tgall[$tgo] = $tgn;
}
fclose($tg);
if(count($tgall)) {
arsort($tgall);
while(list($tgo,$val) = each($tgall)) {
if($i >= $sg && $i < $eg) {
$tmg = (int)substr($tgo,-8,4);
$fav = (int)($tmg/$sett[21]);
if($fav > 4) $fav = 4;
$tgm = substr($tgo,0,-8);
if($tgm) {
?>
<a href='#none' onclick='tago(this)'><span onmouseover='tgtt(this,<?=(int)substr($tgo,-4)?>,<?=$tmg?>)' class='fav<?=$fav?>'><?=$tgm?></span></a>, 
<?}}
$i++;
}}
} else {
while($tgo = trim(fgets($tg))){
if($i >= $sg && $i < $eg) {
$tmg = (int)substr($tgo,-8,4);
$fav = (int)($tmg/$sett[21]);
if($fav > 4) $fav = 4;
$tgm = substr($tgo,0,-8);
if($tgm) {
?>
<a href='#none' onclick='tago(this)'><span onmouseover='tgtt(this,<?=(int)substr($tgo,-4)?>,<?=$tmg?>)' class='fav<?=$fav?>'><?=$tgm?></span></a>, 
<?}}
$i++;
}
fclose($tg);
}
$allp = (int)(($i - 2)/$sett[23]) + 1;
if($i - 1 > $sett[23]) pagen('tag',$allp,5,0);
?>
<script type='text/javascript'>
//<![CDATA[
function tago(ths) {
var fom = parent.document.sform;
if(fom) {
fom.search.value = 't';
fom.p.value = '1';
fom.keyword.value = ths.firstChild.innerHTML;
parent.$('submit').click();
}}
function tgtt(ths,a,b) {
ths.title = "\r\n  ( " + a + " ) 개의 글, ( " + b + " ) 번 검색되었습니다.  \r\n";
}
function rplace(purl){
location.replace(purl.replace("amp;",""));
}
function enload() {
if(parent) {if(parent.$('tag')) {
var theight = <? if($bwr == 'chrome') echo "document.body";else echo "document.documentElement";?>.scrollHeight;
parent.$('tag').style.height = theight + 'px';
}}}
//]]>
</script>
</body>
</html>