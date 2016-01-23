<?
if(!$set) {
ob_start();
session_start();
header ("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$sett[0]?></title>
<meta name="generator" content="srboard" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<?
include("include/common.php");
$fsbs = array();
$bfsb = array();
$ctgo = array();
$fc = fopen($dc,"r");
$fs = fopen($ds,"r");
for($bs = 0;$bso = trim(fgets($fs));$bs++) {
$fco = fgets($fc);
$bid = trim(substr($bso, 0, 10));
$bsof = substr($bso,75);
$bdidnm[$bid] = substr($bsof,0,strpos($bsof,"\x1b"));
$fsbs[$bid] = substr($bso,10);
$ctgo[$bid] = $fco;
}
fclose($fc);
fclose($fs);
if(@filesize($dxr."section.dat")) {
if(@filesize($dxr."section_group.dat")) {
$fsg = fopen($dxr."section_group.dat","r");
for($z = 1;$fsgo = trim(fgets($fsg));$z++) $grp[$z] = explode("\x1b",$fsgo);
fclose($fsg);
}
$fst = fopen($dxr."section.dat","r");
for($ii=1;$fsto = trim(fgets($fst));$ii++) {
$sect[$ii] = explode("\x1b",$fsto);
if($sect[$ii][2]) $bfsb[$ii] = explode("^",$sect[$ii][2]);
if(!$section) {
if($sect[$ii][1] == 3 && false !== strpos($_SERVER['REQUEST_URI'],$sect[$ii][2])) $section = $ii;
else {for($b = 0;$bfsb[$ii][$b];$b++) {if(($ex = strchr($bfsb[$ii][$b],'>')) && strpos($_SERVER['REQUEST_URI'],substr($ex,1)) !== false) {$section = $ii;break;}}}
}}
fclose($fst);
$fsta = fopen($dxr."section_add.dat","r");
for($ii=1;$ii < $section;$ii++) fgets($fsta);
$sectgt = fgets($fsta);
fclose($fsta);
if(@filesize($dxr."section_group.dat")) {
$i = 1;
$fsg = fopen($dxr."section_group.dat","r");
while($fsgo = trim(fgets($fsg))) {
$grp[$i] = explode("\x1b",$fsgo);
$i++;
}
fclose($fsg);
$sgp = $sect[$section][6];
if($grp[$sgp][1]) $sett[26] = $grp[$sgp][1];
}
}
?>
<style type='text/css'>
body {font-family:Gulim; font-size:9pt; margin:0}
</style>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<? if($sett[26]){?><link rel='stylesheet' type='text/css' href='module/<?=$sett[26]?>.css' />
<?} if($sett[45]){?><link rel='stylesheet' type='text/css' href='widget/<?=$sett[45]?>.css' />
<?} if($sett[48]){?><link rel='stylesheet' type='text/css' href='skin/<?=$sett[48]?>/style.css' />
<?} if($sett[24]){?><link rel='stylesheet' type='text/css' href='<?=$sett[24]?>' />
<?}?>
<script type='text/javascript'>
//<![CDATA[
var wopen = 1;
var setop = Array('<?=$isie?>','<?=$bwr?>',<?=$sett[5]?>,'<?=$sett[55]?>','<?=(($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?=(($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','<?=$uid?>',525);
function setup() {
pview = $('pview');
sessno = <?=$sessno?>;
azax("<?=$exe?>?&onload=<?=$time?>&id=1",9);
}
<?
if($mbr_level) {
?>
function checkmemo(val) {
var mdiv = $('check_memo');
var iscmm = 1;
if(!mdiv) {mdiv = $('img');iscmm = 2;}
if(val == 'new_memo') {
<?
if($sett[52] > 1 && $sett[57] != 'a' && $sett[57] <= $mbr_level) {
?>
var alertt = "";
if(iscmm == 1 && ('<?=$sett[52]?>' == '2' || '<?=$sett[52]?>' == '3' || '<?=$sett[52]?>' == '5' || '<?=$sett[52]?>' == '6')) alertt += "<a name='is_memo' onclick=\"read('get');this.parentNode.innerHTML='';\"><b>[쪽지가 도착했습니다]</b></a><br />";
if('<?=$sett[52]?>' == '3' || '<?=$sett[52]?>' == '4' || '<?=$sett[52]?>' == '6') alertt += "<embed src='icon/memo' type='application/x-mplayer2' autostart='true' loop='0' style='width:1px;height:1px' />";
if(parseInt('<?=$sett[52]?>') >= 4) read('get');
mdiv.innerHTML = alertt;
location.replace =(location.href + '#is_memo');
mdiv.parentNode.style.display = 'block';
<?}?>
} else if(iscmm == 1 && mdiv.innerHTML != '') mdiv.innerHTML = '';
setTimeout('azax("<?=$exe?>?&check_memo=<?=$time?>&id=1",9)',30000);
}
<?
}
?>
//]]>
</script>
</head>
<body class='bbody' onload='setup()'>
<span id='img' style='display:none;width:0;z-index:9'></span>
<div id='pview' style='display:none;padding:5px; line-height:130%;z-index:8'></div>
<script type="text/javascript" src="include/top.js"></script>
<?
$set = '';
}
$srwpm = 0;
if($section && ($stb = @fopen($dxr."section_arr.dat","r"))) {
for($sb=1;$sb < $section;$sb++) fgets($stb);
$stbo = explode("@@",trim(fgets($stb)));
if($id) $stbo = $stbo[1];
else {
if($mbrphp) $stbo = str_replace(":chat","",$stbo[0]);
else $stbo = $stbo[0];
}
$st_arr = explode("@",$stbo);
fclose($stb);
$stbL =  ($id)? $sett[69]:$sett[67];
$stbR =  ($id)? $sett[70]:$sett[68];
$srcol = 1;
$sett78 = ($id)? $sett[78]:(($sett[39] > $sett[78])? 0:$sett[78] - $sett[39]);
if($stbL && strpos($stbo,"@L:") !== false) {$srcol += 2;if(!$sett[77]) {$srwdth -= (int)$stbL;$srwdth -= $sett78;}} else $stbL = 0;
if($stbR && strpos($stbo,"@R:") !== false) {$srcol += 2;if(!$sett[77]) {$srwdth -= (int)$stbR;$srwdth -= $sett78;}} else $stbR = 0;
}
function secdiv($ishrz,$asc,$scmg) {
global $sect, $section, $bfsb, $bdidnm, $index, $sgp, $bwr;

if($ishrz == 1) {
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii][6] != $sgp) continue;
else if(!$fstii) $fstii = $ii;
if($section == $ii) $scn = 2;
else if($scn) $scn--;
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 'x') {
$sccn = ($scn)? '2':'';
$scnn = ($scn == 2)? 'stt2':'stt1';
if($fstii != $ii) $secdiv .= "<img src='icon/t.gif' class='sect_btw{$sccn}' alt='' />";
if($sect[$ii][1] == 3) $secdiv .= "\r\n<div class='{$scnn}' onclick=\"rplace('{$sect[$ii][2]}')\"";
else if($sect[$ii][1] == 7) $secdiv .= "\r\n<div class='{$scnn}' onclick=\"".str_replace('"','\'',$sect[$ii][2])."\"";
else if($sect[$ii][1] == 6) $secdiv .= "\r\n<div class='{$scnn}' onclick=\"nwopn('{$sect[$ii][2]}')\"";
else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) $secdiv .= "\r\n<div class='{$scnn}' onclick=\"rplace('{$index}?id={$sect[$ii][2]}')\"";
else if($sect[$ii][1] == 's') $secdiv .= "\r\n<div class='{$scnn}'";
else $secdiv .= "\r\n<div class='{$scnn}' onclick=\"rplace('{$index}?section={$ii}')\"";
$ssid = ($scn == 2)? " id='stt2'":"";
$secdiv .= " onmouseover='sublist({$ii},this)'{$ssid}>{$sect[$ii][0]}</div>";
}
}
$secdiv2 = "var slist = Array(''";
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii]) $secdiv2 .= ",";
if($sect[$ii][6] != $sgp) {$secdiv2 .= "''";continue;}
if($bfsb[$ii]) {
$arry = '';
$ccfsb = count($bfsb[$ii]) -1;
for($i=0;$i <= $ccfsb;$i++) {
if(strpos($bfsb[$ii][$i],'>')) {
$bfsd = explode('>',$bfsb[$ii][$i]);
$arry .= "Array('_".$bfsd[2]."','".$bfsd[0]."','".$bfsd[1]."'),";
} else if($bfsb[$ii][$i] !='>') $arry .= "Array('".encodee($bfsb[$ii][$i])."','".$bdidnm[$bfsb[$ii][$i]]."'),";
}
$secdiv2 .= "Array(".substr($arry,0,-1).")";
} else $secdiv2 .= "''";
}
$secdiv2 .= ");";
return array($secdiv,$secdiv2);
} else {
if($scmg) $secdiv .= "<li class='supsec'><img src='icon/t.gif' alt='' style='width:{$scmg}px' /></li>";
if($bwr == 'ie6') $iesix = "onmouseover='this.className=\"iesix\"' onmouseleave='this.className=\"\"'";
else  $iesix = "";
for($ii=(($asc==1)? count($sect):1);$sect[$ii];$ii=(($asc==1)? $ii-1:$ii+1)) {
if($sect[$ii][6] != $sgp) continue;
if($ii == 1) $active = " first";
else $active = "";
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 'x') {
if($sect[$ii][1] == 3) $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></li>";
else if($sect[$ii][1] == 7) $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='#none' onclick='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></li>";
else if($sect[$ii][1] == 6) $secdiv .= "<li class='supsec{$active}'><a class='trigger' target='_blank' href='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></li>";
else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='{$index}?id={$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></li>";
else {
if($section == $ii) $active .= " active";
$ccfsb = count($bfsb[$ii]) -1;
if($sect[$ii][1] == 's') $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='#none'><span>{$sect[$ii][0]}</span></a>";
else $secdiv .= "<li class='supsec{$active}'><a class='trigger' href='{$index}?section={$ii}'><span>{$sect[$ii][0]}</span></a>";
if($ccfsb >= 0) {
$secdiv .= "<ul>";
for($i=0;$i <= $ccfsb;$i++) {
if(strpos($bfsb[$ii][$i],'>')) {
$bfsd = explode('>',$bfsb[$ii][$i]);
if($bfsd[2]=='nw') $bfsd[1] .= "' target='_blank";
else if($bfsd[2]=='js') $bfsd[1] = "#none' onclick='".$bfsd[1];
$secdiv .= "<li {$iesix}><a href='{$bfsd[1]}'>{$bfsd[0]}</a></li>";
} else if($bfsb[$ii][$i] !='>') $secdiv .= "<li {$iesix}><a href='{$index}?id=".encodee($bfsb[$ii][$i])."'>{$bdidnm[$bfsb[$ii][$i]]}</a></li>";
}
$secdiv .= "</ul></li>";
} else $secdiv .= "</li>";
}
if($ishrz == 3) $secdiv .= "<li class='supsec'><img src='icon/t.gif' alt='' /></li>";
}
}
return $secdiv;
}}
?>
<script type='text/javascript'>
//<![CDATA[
function mouxe(that) {
if(that.style.backgroundColor) {
that.style.backgroundColor = '';
that.style.borderColor= '#C7C7C7';
} else {
that.style.backgroundColor = '#FFFAD9';
that.style.borderColor = '#FF6633';
}
}
function resize_n(AA) {
if(AA = $('resizhgt_' + AA)) {
if(parseInt(AA.style.height) > 150) {
AA.style.height = '150px';
} else {
AA.style.height = AA.scrollHeight +'px';
}}}
function togge(n1,n2) {
if($('resizhgt_' + n2) && $('resizhgt_' + n2).style.display != 'none') {
$('resizhgt_' + n1).style.display='block';
if(n1 != '6' && n1 != '8' && n1 != '9') $('resizhgt_' + n1).style.height='150px';
$('resizhgt_' + n2).style.display='none';
$('head_' + n1).className='menu_title menuon';
$('head_' + n2).className='menu_title menuoff';
}}
//]]>
</script>

