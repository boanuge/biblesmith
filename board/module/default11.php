<?
if(!$topsection) {
include("module/_top.php");
include("module/_head.php");
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii][6] != $sgp) continue;
else if(!$fstii) $fstii = $ii;
if($section == $ii) $scn = 2;
else if($scn) $scn--;
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 'x') {
$sccn = ($scn)? '2':'';
$scnn = ($scn == 2)? 'stt2':'stt1';
if($fstii != $ii) $secdiv .= "<img src='icon/t.gif' class='sect_btw{$sccn}' alt='' />";
 if($sect[$ii][1] == 3) {
$secdiv .= "\r\n<div class='{$scnn}' onclick=\"location.href='{$sect[$ii][2]}'\"";
} else if($sect[$ii][1] == 7) {
$secdiv .= "\r\n<div class='{$scnn}' onclick=\"".str_replace('"','\'',$sect[$ii][2])."\"";
} else if($sect[$ii][1] == 6) {
$secdiv .= "\r\n<div class='{$scnn}' onclick=\"var nw=window.open();nw.location.href='{$sect[$ii][2]}'\"";
} else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) {
$secdiv .= "\r\n<div class='{$scnn}' onclick=\"location.href='{$index}?id={$sect[$ii][2]}{$ptslys}'\"";
} else if($sect[$ii][1] == 's') {
$secdiv .= "\r\n<div class='{$scnn}'";
} else {
$secdiv .= "\r\n<div class='{$scnn}' onclick=\"location.href='{$index}?section={$ii}{$ptslys}'\"";
}
$ssid = ($scn == 2)? " id='stt2'":"";
$secdiv .= " onmouseover='sublist({$ii},this)'{$ssid}>{$sect[$ii][0]}</div>";
}
}
$rightwidth = ($sett[12] > 1035)? $sett[12] - 1020:20;
?>
<center style='padding-top:<?=(int)$gheight?>px'>
<div style='width:<?=$sett[12]?>px;text-align:left'>
<div style='float:left'>
<img src='ttl.gif' style='cursor:pointer;padding-top:20px' onclick="location.href='<?=$index?>?section=1<?=$ptslys?>'" alt='' />
</div><div style="float:right; margin-top:23px">
<form method='get' action='<?=$index?>'><input type='hidden' name='slys' value='<?=$slys?>' /><input type='text' name='find' class='find_input' value='<?=$_GET['find']?>' /> <input type='submit' value='FIND' class='find_submit' /></form>
</div><div style="clear:both"></div></div>
<center>
<table id='section_title' cellpadding='0px' cellspacing='0px' width='<?=$sett[12]?>px'>
<tr><td>
<script type='text/javascript'>/*<![CDATA[*/</script><?=$secdiv?><script type='text/javascript'>/*]]>*/</script>
</td></tr>
</table>
<table id='section_bd' cellpadding='0px' cellspacing='0px' width='<?=$sett[12]?>px'>
<tr><td><div class='w100'><div id="sub_bd">&nbsp;</div></div></td></tr>
</table></center>
<script type='text/javascript'>
//<![CDATA[
var sublong = new Array();
function sublist(sno,ths) {
if(document.getElementById('sub_bd')) {
document.getElementById('sub_bd').style.paddingLeft = '0px';
var slist = Array(''<?
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii]) echo ",";
if($sect[$ii][6] != $sgp) {echo "''";continue;}
if($bfsb[$ii]) {
$arry = '';
$ccfsb = count($bfsb[$ii]) -1;
for($i=0;$i <= $ccfsb;$i++) {
if(strpos($bfsb[$ii][$i],'>')) {
$bfsd = explode('>',$bfsb[$ii][$i]);
$arry .= "Array('_".$bfsd[2]."','".$bfsd[0]."','".$bfsd[1]."'),";
} else $arry .= "Array('".encodee($bfsb[$ii][$i])."','".$bdidnm[$bfsb[$ii][$i]]."'),";
}
echo "Array(".substr($arry,0,-1).")";
} else echo "''";
}
?>);
var submt = "";
if(slist[sno] && slist[sno][0] && slist[sno][0][1] != '') {
var scnt = slist[sno].length -1;
for(var i=0;i <= scnt;i++) {
if('<?=$_GET['id']?>' == slist[sno][i][0]) submt += "<span onclick=\"location.href='<?=$index?>?id=" + slist[sno][i][0] + "<?=$ptslys?>&p=1'\" style='border-bottom:2px solid #00D6D9'>" + slist[sno][i][1] + "</span>";
else if(slist[sno][i][0].substr(0,1) == '_') {if(slist[sno][i][0]=='_nw') slist[sno][i][2] = "window.open(\"" +  slist[sno][i][2] + "\",\"_blank\")";else if(slist[sno][i][0] !='_js') slist[sno][i][2] = "location.href=\"" + slist[sno][i][2] + "\"";submt += "<span onclick='" + slist[sno][i][2] + "' style='cursor:pointer'>" + slist[sno][i][1] + "</span>";}
else submt += "<span onclick=\"location.href='<?=$index?>?id=" + slist[sno][i][0] + "<?=$ptslys?>&p=1'\" style='cursor:pointer'>" + slist[sno][i][1] + "</span>";
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
<div style='width:<?=$sett[12]?>px;margin-top:10px;text-align:left'>
<?

include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>
<div id="footer"><div class="infooter" align="center">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div></div></div>
</center>
<?
}
?>