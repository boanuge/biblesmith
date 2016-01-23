<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
$rightwidth = ($sett[12] > 1035)? $sett[12] - 1020:20;
$secdiv = secdiv(1,0,0);
?>
<center style='padding-top:<?=(int)$gheight?>px'>
<div style='width:<?=$srwtpx?>;text-align:left'>
<div style='float:left'>
<img src='ttl.gif' style='cursor:pointer;padding-top:20px' onclick="rplace('<?=$index?>?section=1')" alt='' />
</div><div style="float:right; margin-top:23px">
<form method='get' action='<?=$index?>'><input type='text' name='find' class='find_input' value='<?=$_GET['find']?>' /> <input type='submit' value='FIND' class='find_submit' /></form>
</div><div style="clear:both"></div></div>
<center>
<table id='section_title' cellpadding='0px' cellspacing='0px' width='<?=$srwtpx?>'>
<tr><td>
<script type='text/javascript'>/*<![CDATA[*/</script><?=$secdiv[0]?><script type='text/javascript'>/*]]>*/</script>
</td></tr>
</table>
<table id='section_bd' cellpadding='0px' cellspacing='0px' width='<?=$srwtpx?>'>
<tr><td><div class='w100'><div id="sub_bd">&nbsp;</div></div></td></tr>
</table></center>
<script type='text/javascript'>
//<![CDATA[
var sublong = new Array();
function sublist(sno,ths) {
if(document.getElementById('sub_bd')) {
document.getElementById('sub_bd').style.paddingLeft = '0px';
<?=$secdiv[1]?>

var submt = "";
if(slist[sno] && slist[sno][0] && slist[sno][0][1] != '') {
var scnt = slist[sno].length -1;
for(var i=0;i <= scnt;i++) {
if('<?=$_GET['id']?>' == slist[sno][i][0]) submt += "<span onclick=\"rplace('<?=$index?>?id=" + slist[sno][i][0] + "&p=1')\" style='border-bottom:2px solid #00D6D9'>" + slist[sno][i][1] + "</span>";
else if(slist[sno][i][0].substr(0,1) == '_') {if(slist[sno][i][0]=='_nw') slist[sno][i][2] = "nwopn(\"" +  slist[sno][i][2] + "\")";else if(slist[sno][i][0] !='_js') slist[sno][i][2] = "rplace(\"" + slist[sno][i][2] + "\")";submt += "<span onclick='" + slist[sno][i][2] + "' style='cursor:pointer'>" + slist[sno][i][1] + "</span>";}
else submt += "<span onclick=\"rplace('<?=$index?>?id=" + slist[sno][i][0] + "&p=1')\" style='cursor:pointer'>" + slist[sno][i][1] + "</span>";
if(i < scnt) submt += "<img src='icon/t.gif' class='secbd_btw' alt='' />";
}
}
if(submt == '') submt = "&nbsp;"
document.getElementById('sub_bd').innerHTML = submt;
if(submt != '&nbsp;') valignn(sno,ths);
}}
function valignn(sno,ths) {
if(ths) {
var xx = 0;
if(sno == 1) xx = 10;
else {
var slength = 0;
var smg = 3;
for(var d=0;document.getElementById('section_title').getElementsByTagName('div')[d] != ths;d++) slength += document.getElementById('section_title').getElementsByTagName('div')[d].offsetWidth + smg;
slength += parseInt((ths.offsetWidth + smg)/2);
var tlength = 0;
var tmg = 15;
var ofw = 0;
var tleng = document.getElementById('sub_bd').childNodes.length - 1;
for(var d=0;d < tleng;d++) tlength += document.getElementById('sub_bd').childNodes[d].offsetWidth + tmg;
tlength += document.getElementById('sub_bd').childNodes[d].offsetWidth;
if(slength + (tlength/2) > <?=$sett[12]?>) xx = <?=$sett[12]?> - tlength -15;
else xx = slength - (tlength/2);
}
if(xx < 10) xx = 10;
document.getElementById('sub_bd').style.paddingLeft = xx + 'px';
}}
setTimeout("sublist(<?=$section?>,document.getElementById('stt2'))",30);
//]]>
</script>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer"><div class="infooter" align="center">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div></div></div>
</center>
<?
}
?>