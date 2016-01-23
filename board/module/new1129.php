<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
$secdiv = secdiv(1,0,0);
?>
<div style='height:100px;background-color:#F5F5F3;text-align:center'><h2 style='margin-top:30px'>(new1129.php 78줄) <?=$sett[0]?></h2></div>
<div class='srmgat' style='width:<?=$srwtpx?>'>
<div style='height:30px;background-color:#FF4040'><div id='section_title'><script type='text/javascript'>/*<![CDATA[*/</script><?=$secdiv[0]?><script type='text/javascript'>/*]]>*/</script></div></div>
</div>
<?
include("module/_lftrgt.php");
?>

<div id='sub_bd'>&nbsp;</div>
<script type='text/javascript'>
//<![CDATA[
function sublist(sno,ths) {
<?=$secdiv[1]?>

var submt = "";
if(slist[sno]) {
var scnt = slist[sno].length -1;
for(var i=0;i <= scnt;i++) {
if('<?=$_GET['id']?>' == slist[sno][i][0]) submt += "<span onclick=\"rplace('<?=$index?>?id=" + slist[sno][i][0] + "')\" style='border-bottom:2px solid #FF6600;cursor:pointer'>" + slist[sno][i][1] + "</span>";
else if(slist[sno][i][0].substr(0,1) == '_') {if(slist[sno][i][0]=='_nw') slist[sno][i][2] = "nwopn(\"" +  slist[sno][i][2] + "\")";else if(slist[sno][i][0] !='_js') slist[sno][i][2] = "rplace(\"" + slist[sno][i][2] + "\")";submt += "<span onclick='" + slist[sno][i][2] + "' style='cursor:pointer'>" + slist[sno][i][1] + "</span>";}
else submt += "<span onclick=\"rplace('<?=$index?>?id=" + slist[sno][i][0] + "')\" style='cursor:pointer'>" + slist[sno][i][1] + "</span>";
if(i < scnt) submt += "<img src='icon/t.gif' class='secbd_btw' alt='' />";
}
}
if(submt == '') submt = "&nbsp;"
document.getElementById('sub_bd').innerHTML = submt;
}
setTimeout("sublist(<?=$section?>,document.getElementById('stt2'))",30);
//]]>
</script>
<?
} else {
include("module/_lftrgt.php");
?>

<div class='srmgat' style='width:<?=$srwtpx?>'>
<div id="footer">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div>
</div>
<?
}
?>