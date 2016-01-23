<?
ob_start();
session_start();
header ("Content-Type: text/html; charset=UTF-8");
/*
 *  srboard 38.00 
 * -------------------------------
 * Developed By 사리 (sariputra3@naver.com)
 * License : GNU Public License (GPL)
 * Homepage : http://srboard.egloos.com
 */
include("include/common.php");
if($_GET['keyword']) $_GET['keyword'] = trim($_GET['keyword']);
?>

<?
//Do not treat mobile and desktop differently.
//Check ./include/common.php "else $ismobile = 0;"
$ismobile = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$sett[0]?></title>
<meta name="generator" content="srboard 38.00 " />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<? if($ismobile == 2) {?>
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=2.5, minimum-scale=0.5, width=device-width" />
<?
} if($sett[31]) {?>
<link rel="shortcut icon" type="image/x-icon" href="http://<?=$_SERVER['HTTP_HOST']?>/favicon.ico" />
<?}
if($_GET['count_add'] || $_GET['view']) include("include/referer.php");
function getmicrotime() 
{
    $msec = microtime(); 
    return substr($msec,19) + substr($msec,0,10);
}
function strcut($str, $len){
$str = trim($str);
if($len){
$str = str_replace("<br />"," ",$str);
$str = strip_tags($str);
if(strlen($str) > $len) {
$str = substr($str, 0, $len + 1);
$end = $len;
if(ord($str[$end -2]) < 224 && ord($str[$end]) > 126) {
while(($ond = ord($str[$end])) < 194 && ord($str[$end]) > 126) $end--;
$str = substr($str, 0, $end)."..";
} else $str .= "..";
}
$isa = strpos(substr($str,-8),"&");
if($isa) $str = substr($str,0,-8 + $isa);
$str = str_replace("\\", "＼", $str);
}
if($end = strpos($str,"\x1b")) $str = substr($str,0,$end);
return trim($str);
}
$time_start = getmicrotime();
function name($name, $mn, $target, $ico, $level, $url) {
global $sett,$sss;
if($sss[64]) $namee = '익명';
else {
$name = trim($name);
if($target == 1) $adtarget="_parent";
else $adtarget="_self";
$namee = '';
if($mn) {
if(file_exists("icon/m20_".$mn)) {
if($sett[44] == 2 || $sett[44] == 3) $is80 = 1;
if($sett[44] == 1 || $sett[44] == 3) $is60 = 1;
$umg = 'icon/m20_'.$mn;
$isumg = 1;
} else $umg = 'icon/noimg.gif';
if($ico) {
if($is60) $namee .= "<img src='{$umg}' onmouseover='imgview(this.src,9)' onmouseout='imgview(0)' class='icos' alt='' />";
else $namee .= "<img src='{$umg}' class='icos' alt='' />";
} else if(!$ico) $namee .= "<img src='icon/v".$level.".gif' class='mblv' alt='' />";
$m = 'mb';
}
$namee .= "<a href='#none' class='{$m}nick' onclick=\"wwname('".urlencode($name)."','{$mn}','{$adtarget}','{$url}','{$is80}')\">";
$namee .= ($_GET['search'] == 'n')? str_replace($_GET['keyword'], "<span class='keyword'>{$_GET['keyword']}</span>",$name):$name;
$namee .="</a>";
}
return $namee;
}
function tagcut($tag, $rkin) {
$glen = strpos($rkin,"<sr_".$tag.">");
if($glen !== false) {
$head = $glen + strlen($tag) + 5;
return substr($rkin, $head, strpos($rkin,"</sr_".$tag.">") - $head);
} else return '';
}
function inclvde($data) {
if(strpos($data,'<;>') !== false) $data = preg_replace("`<;>(.+)<!--/-->`sU","",$data);
$data = str_replace("<!--/-->","",$data);
if(strpos($data,'<#') !== false) {
$data = preg_replace("`<#[^#]+#>`","",$data);
$gtis = strpos($data,'<##');
if($gtis !== false) {
echo substr($data,0,$gtis);
$gtin = explode('<##',substr($data,$gtis));
$gtinc = count($gtin);
for($igt = 1;$igt < $gtinc;$igt++) {
$gtine = strpos($gtin[$igt],'##>');
$gtinf = substr($gtin[$igt],0,$gtine);
if($gtinf[0] == '#') $return[] = array(1,substr($gtinf,1,-1));
else $return[] = array(2,$gtinf);
$return[] = array(0,substr($gtin[$igt],$gtine + 3));
}} else $return[] = array(0,$data);
} else $return[] = array(0,$data);
return $return;
}
if($id && !$sss) {
scrhref('?',0,0);
exit;
}
if($slss[4]) $fz = $slss[4];
if($_COOKIE['cfsz']) $fz = $_COOKIE['cfsz'];
else if(!$fz) $fz = '9';
$faz = array('Gulim','Dotum','Batang','Gungsuh','Malgun Gothic','Arial','Tahoma','Verdana','Trebuchet MS','sans-serif');
$faze = ($wdth[8][0])? $faz[$wdth[8][0]]:$faz[0];
if($_GET['signup'] || $_POST['join'] || $_GET['mbr_info']) $mbrphp = 1;
if($id) {
if($csf = @fopen($dxr.$id."/set.dat","r")) {$csff[0] = trim(fgets($csf));$csff[1] = trim(fgets($csf));fclose($csf);}
if($_GET['comment'] && $csff[0]) $srk = $csff[0];
else $srk = ($slss[2])? $slss[2]:$wdth[2];
} else $srk = ($slss[2])? $slss[2]:$sett[1];
if($ismobile == 2) $srk = 'mobile';
if($id && $sss[29]) echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"[{$sett[0]}] - {$bdidnm[$id]}\" href=\"{$sett[14]}{$exe}?rss={$uid}\" />\n";
if($sect[$section][2]) echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"[{$sett[0]}] - {$sect[$section][0]} -\" href=\"{$sett[14]}{$exe}?rssfeed={$section}\" />\n";
$sectcss = "module/sectcss_".$section.".css";
if(!file_exists($sectcss) || !filesize($sectcss)) $sectcss = '';
?>
<link rel="alternate" type="application/rss+xml" title="[<?=$sett[0]?>] - 전체" href="<?=$sett[14]?><?=$exe?>?rssfeed=all" />
<style type='text/css'>
<? if($_GET['comment'] && !$_GET['scroll']) {?>
body {overflow:hidden; font-family:Gulim; font-size:9pt; margin:0}
<?} else {?>
body {font-family:Gulim; font-size:9pt; margin:0}
<?}?>
.bdo {font-size:<?=$fz?>pt; font-family:<?=$faze?>;}
</style>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<? if($sett[26]){?><link rel='stylesheet' type='text/css' href='module/<?=$sett[26]?>.css' />
<?} if(!$id && $sett[45]){?><link rel='stylesheet' type='text/css' href='widget/<?=$sett[45]?>.css' />
<?} if($sectcss){?><link rel='stylesheet' type='text/css' href='<?=$sectcss?>' />
<?}?>
<link rel='stylesheet' type='text/css' href='skin/<?=$srk?>/style.css' />
<!--[if IE]>
<style type='text/css'>
td, div {word-break:break-all; text-overflow:ellipsis}
</style>
<![endif]-->
<!--[if lte IE 6]>
<link rel='stylesheet' type='text/css' href='include/ie6.css' />
<![endif]-->
<?
if($sett[77]) {echo "\n<style type='text/css'>\n.nobr {white-space:normal}\n";if($bwr == 'chrome' && !$id) echo "#srgate div.ftlft, #srgate div.lnkrp, #srgate .nL4 {float:none; display:inline-block}\n";echo "</style>\n";}
if($sett[24]) echo "<link rel='stylesheet' type='text/css' href='{$sett[24]}' />\n";
if(file_exists('icon/style.css')) echo "<link rel='stylesheet' type='text/css' href='icon/style.css' />\n";
?>
<script type='text/javascript'>
var wopen = 1;
var setop = Array('<?=$isie?>','<?=$bwr?>',<?=$sett[5]?>,'<?=$sett[55]?>','<?=(($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?=(($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','<?=$uid?>',<?=(int)$sett[11]?>);

</script>
</head>
<?
if($_GET['comment']) {
?>
<body class='cbody' onclick="if(pxxx.wopen==2) pxxx.imgview(0);">
<?
} else if($aview) {
?>
<body class='bbody' onselectstart="return false" style="-moz-user-select:none">
<?
} else {
?>
<body class='bbody'>
<?
if($sett[2]) include($sett[2]);
}
?>
<span id='img' style='position:absolute'></span>
<div id='pview' style='display:none;padding:5px; line-height:130%;position:absolute'></div>
<script type="text/javascript" src="include/top.js"></script>
<script type='text/javascript'>
//<![CDATA[
function searchc(val) {
if(document.sform.keyword.value != '' && document.sform.keyword.value == '<?=$_GET['keyword']?>') location.href='?<?=$_SERVER['QUERY_STRING']?>'.replace(/&search=[a-z]/i,'&search=' + val).replace(/&p=[0-9]+/i,'&p=1');
}
function ckprohibit(ths) {
var prhbw = new Array(''<?
if($fp=@fopen($dxr."prohibit","r")){
while($fpo = trim(fgets($fp))) echo ",'{$fpo}'";
fclose($fp);
}
?>);
for(var i=prhbw.length -1;i > 0;i--) {
if(ths.indexOf(prhbw[i]) != -1) return prhbw[i];
}}
<? if($dxr && $_GET['block5']) {
if($sss[22] == 'a' || $sss[22] > $mbr_level) exit;
if($isie == 1) {?>
setTimeout("$('bdo-1').innerHTML = dialogArguments.ajaxx;img_resize();document.body.style.overflowX = 'hidden';document.body.style.background = '#FFFFFF';",500);
<?}}?>
//]]>
</script>
<?
if($dxr && $_GET['block5']) {echo "<div id='bdo-1' class='bdo block5' style='padding:20px 10px 10px 30px'></div></body></html>";exit;}
if($dxr && !$_GET['comment']) {
if($_GET['type'] && $sss[53]) $_GET['type'] = '';
if($_GET['type']) $type= $_GET['type'];
else $type = $sss[26];
$length = strlen($_GET['date']);
if($length < 4 || $length%2) $_GET['date'] = '';
if($type == 'k') {
$otype = 'k';
$mcnt = 1;
if($length > 6) $_GET['date'] = substr($_GET['date'],0,6);
else if($length == 4)  $_GET['date'] .= "01";
$fr = fopen($dxr.$id."/date.dat","r");
while(!feof($fr)){
if($fro = trim(fgets($fr))){
$ymdn = substr($fro, 0, 4)."년 ".substr($fro, 4, 2)."월 (".substr($fro, 6).")";
if(!$_GET['date'] && ($_GET['p'] == $mcnt || !$_GET['p'] && $mcnt == 1)) {$calp = $mcnt;$_GET['date'] = substr($fro,0,6);$isnt = substr($fro,6);$months .= "<option value='{$mcnt}' selected='selected'>$ymdn</option>";}
else if($_GET['date'] && substr($_GET['date'],0,6) == substr($fro,0,6)) {$calp = $mcnt;$isnt = substr($fro,6);$months .= "<option value='{$mcnt}' selected='selected'>$ymdn</option>";}
else $months .= "<option value='{$mcnt}'>$ymdn</option>";
$mcnt++;
}}
fclose($fr);
$_GET['p'] = 1;
$mcnt--;
}
if(!$sett[41] || $sett[41] == 1) $bhlct = '';
else {
$bhlct = "<a href='{$index}'>HOME</a>";
if($sett[41] != 2 && $sett[41] != 6 && $sett[41] != 7 && $grp[$sgp]) $bhlct .= " &gt; <a href='{$index}?group={$sgp}'>{$grp[$sgp][0]}</a>";
if($sett[41] != 3 && $sett[41] != 5 && $sett[41] != 7 && $section && (count($bfsb[$section]) > 1 || $sett[40])) $bhlct .= " &gt; <a href='{$index}?section={$section}'>{$sect[$section][0]}</a>";
if($sett[41] != 4 && $sett[41] != 5 && $sett[41] != 6) $bhlct .= " &gt; <a href='{$dxpt}&amp;p=1'>{$wdth[1]}</a>";
}
if($sett[26]) include('module/'.$sett[26].'.php');
if($ismobile == 2 || $sett[77] == 1) $srwdthx = '100%';
else $srwdthx = $srwdth.'px';
if($id && $sett[41]){?><div class='bd_name'><h2><? if($sss[29]){?><a target='_blank' href='<?=$exe?>?rss=<?=$uid?>'><img src='icon/rss.gif' alt='' border='0' /></a><?} else {?><img src='icon/norss.gif' alt='' border='0' /><?}?><a href='<?=$dxpt?>'><?=$bdidnm[$id]?></a></h2><div><?=$bhlct?></div></div><?}
if($_GET['signup'] || $_POST['join'] || $_GET['mbr_info'] || $_GET['find']) {?><div class='bd_name'><h2><img src='icon/sy.gif' alt='' /><? if($_GET['signup']) echo "주기도문 - The Lord’s Prayer";else if($_POST['join']) echo "회원가입";else if($_GET['mbr_info']) echo "회원정보";else echo "검색어 : ". $_GET['find'];?></h2><div></div></div><?}
else if(!$ismobile && (($sett[16][0] && !$id) || ($id && (($sett[16][2] && $_GET['no']) || ($sett[16][1] && !$_GET['no']))))) {if($sett[32]) @readfile($dxr."head");else include($dxr."head");}
}
if($mbrphp) {echo "<center>";include("include/mbr.php");echo "</center>";}
else {
$rt = "";
$rrt = "";
if($_GET['keyword']) $rt .= "&amp;search=".$_GET['search']."&amp;keyword=".urlencode($_GET['keyword']);
if($_GET['c']) $rrt .= "&amp;c=".$_GET['c'];
if($_GET['arrange']) $rrt .= "&amp;arrange=".$_GET['arrange']."&amp;desc=".$_GET['desc'];
if($_GET['m']) $rrt .= "&amp;m=".$_GET['m'];
if($type != 'k' && $_GET['date']) $rrt .= "&amp;date=".$_GET['date'];
$rt .= $rrt;
if($_GET['ct']) $rt .= "&amp;ct=".$_GET['ct'];
if($_GET['type']) $rt .= "&amp;type=".$_GET['type'];
if($_GET['xx']) $rt .= "&amp;xx=".$_GET['xx'];
$crt = preg_replace('`&amp;ct=[0-9]+`', '', $rt)."&amp;p=1";
if(!$_GET['comment']) {
$day = date("d",$time);
if($_COOKIE['visit'] != $day) {
setcookie("visit", $day, $time + 86400);
if($_SESSION['visit'] != $day) {
$_SESSION['visit'] = $day;
$countadd = $index."?count_add=".base64_encode(str_pad($_SERVER['REMOTE_ADDR'], 15).str_replace("&","&amp;",$_SERVER['QUERY_STRING'])."\x1b".$_SERVER['HTTP_REFERER']);
}}
?>
<iframe name="exe" style="display:none;width:0;height:0" src="<?=$countadd?>"></iframe>
<?
}
$sr = fopen("skin/".$srk."/skin.html","r");
while($sro = fgets($sr)) $srkn .= $sro;
fclose($sr);
$srkn = str_replace("<#index#>",$index,$srkn);
$srkn = str_replace("<#exe#>",$exe,$srkn);
$srkn = str_replace("<#bd_width#>",$srwdthx,$srkn);
$srkn = str_replace("<#bd_url#>",$sett[14],$srkn);
if($mbr_no >= 1) {
$srkn = str_replace('<#ismbr#>','',$srkn);
$srkn = str_replace('<#isxmbr#>','<;>',$srkn);
} else {
$srkn = str_replace('<#ismbr#>','<;>',$srkn);
$srkn = str_replace('<#isxmbr#>','',$srkn);
}
$skv = tagcut('top',$srkn);
$memb = "";
if($sett[62]) $sett[62] = $time - $sett[62]*21600;
else $sett[62] = 9999999999;
if($id) {
function uplist($uno) {
global $exe, $dxr, $id, $du, $uid, $wdth;
$drctry = ($wdth[7][33])? "icon/".$id."/":$dxr.$id."/files/";
$fu = fopen($du ,"r");
while(!feof($fu)) {
	$fuo = fgets($fu);
	if((int)substr($fuo, 0, 6) == $uno) {
		$nfile = substr($fuo, 6, -13);
		$mfile = $drctry.str_replace("%","",urlencode($nfile));
		$ufile = $exe."?id=".$uid."&amp;fno=".(int)substr($fuo, -7, 6);
		if(is_file($mfile)) {
		$sfile = filesize($mfile);
		$sfile = ($sfile >= 1048576)? sprintf("%.2f", ($sfile / 1048576))."mb":sprintf("%.2f", ($sfile / 1024))."kb";
		$sfile .= " : ".(int)substr($fuo, -13, 6)."회";
		$memx .= "<img src='icon/f.png' style='width:13px;height:13px;vertical-align:middle;margin-right:3px' alt='' /><a target='_blank' href='".$ufile."'>".$nfile." ( ".$sfile." )</a> &nbsp; ";
	}
}
}
fclose($fu);
if($memx) return "<div class='uplist'><b>첨부파일</b> : ".$memx."</div>";
}
$keyw = explode(" ",$_GET['keyword']);
$srkin = tagcut('id',$srkn);
$srkin = str_replace("<#idd#>",$id,$srkin);
$srkin = str_replace("<#id#>",$eid,$srkin);
$srkin = str_replace("<#eid#>",$uid,$srkin);
$srkin = str_replace("<#bd_name#>",$wdth[1],$srkin);
if(!$_GET['comment']) {
$skv .= tagcut('head',$srkin);
if($inclwt=inclvde($skv)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) include($inxv[1]);else echo $inxv[1];}
function nocopy($txt) {
global $aview, $noright;
if($aview && !$noright) {
if($aview < 3) $txt = "<div onselectstart='return false' style='-moz-user-select:none'>".$txt."</div>";
else {
if($aview == 4) $txt = "<iframe id='ifr_bdo' style='border:0' frameborder='0'></iframe>";
if($aview >= 5) $txt = "<div style='padding:120px 0px 100px 0;margin-right:20px'><div style='background:#000;color:#FFF;font-size:25px;line-height:40px;padding:25px'>본문은 팝업으로 뜹니다<br />IE에서만 보입니다.</div></div>";
}}
return $txt;
}
}
if($_GET['xx']) $xx = $_GET['xx'];
else $xx = 0;
if($slss[5]) $isnt= $slss[5];
if(($sss[26] === 'a'||$sss[63]||$sss[26] == 'g') && ($_GET['type'] == 'b'||$_GET['type'] == 'c'||$_GET['type'] == 'd')) $isnt = (int)($isnt/2);
if(!$_GET['comment']) {if($sett[32]) @readfile($dxr.$id."/head.dat");else include($dxr.$id."/head.dat");}
if($_POST['edit'] == "unlock") $_GET['no'] = $_POST['no'];
if(!$_GET['p']) $gp = 1;
else $gp = $_GET['p'];
if($sss[22] != 'a' && $sss[22] <= $mbr_level){
$timecut = ($sss[69] <= $mbr_level)? 0:$time - ($sett[71]*3600);
function ims($ctime,$imi) {
global $sss;
$smm = array($imi,$imi,$imi,$imi);
if($ctime == 2) {
if($sss[67] && $sss[67] != 2) $smm[0] = 0;
if($sss[67] && $sss[67] != 1) $smm[1] = 0;
if($sss[68] && $sss[68] != 2) $smm[0] = 0;
if($sss[68] && $sss[68] != 1) $smm[1] = 0;
}
return $smm;
}
function imn($mm,$ctime,$body,$nn,$xx) {
global $mbr_no,$mbr_level,$timecut,$sss,$sett;
if($sss[69] > $mbr_level && $ctime < $timecut) $ctime = 2;
if(!$mm) $imm = ims($ctime,3);
else if($mm == $mbr_no) $imm = ims($ctime,4);
else if($mbr_level == 9) $imm = array(4,4,4,4);
else $imm = ims($ctime,2);
if($body) {
if($imm[0] == 0 && $sett[72] < 2) $body = str_replace('<#is_edit#>','<;>',$body);
else $body = str_replace("<#jsedit#>","'edit',{$imm[0]},'{$nn}','{$xx}'",$body);
if($imm[1] == 0 && $sett[72] < 2) $body = str_replace('<#is_delete#>','<;>',$body);
else $body = str_replace("<#jsdelete#>","'delete',{$imm[1]},'{$nn}','{$xx}'",$body);
return $body;
} else return $imm;
}
function skword($kword) {
global $keyw;
for($k = 0;$keyw[$k];$k++) {$kword = str_replace($keyw[$k], "<span class='keyword'>{$keyw[$k]}</span>",$kword);}
return $kword;
}
$authority = array();
$authority[0] = "<div class='authority' id='authority_list' align='center'></div>";
if($sss[23] == 'a' || $sss[23] > $mbr_level) $authority[23] = 3;
if($mbr_level < $wdth[9][0] || $authority[23] || !$sss[60]) $srkin = str_replace('<#is_appr#>','<;>',$srkin);
if($mbr_level < $wdth[9][0] || $authority[23] || !$sss[61]) $srkin = str_replace('<#is_oppo#>','<;>',$srkin);
if($mbr_level < $wdth[9][0] || $authority[23] || $sss[49] != '2') $srkin = str_replace('<#is_accs#>','<;>',$srkin);
if($_GET['c'] || $_GET['m'] || $_GET['keyword'] || $_GET['date']) $cmkd = 2;
if($cmkd == 2 || $_GET['ct'] || $_GET['arrange'] || $sss[65]) $schphp = 1;
$ida = '';
if($_GET['no']) {
// 게시물 본문 출력
if($ismobile == 2) $sss[30] = 0;
include("include/view.php");
} else if($_GET['comment']) {
include("include/comment.php");
exit;
} else {
$sss[30] = 1;
?>
<script type='text/javascript'>document.title="[<?=$sett[0]?>] <?=$wdth[1]?>";</script>
<?
}
// 게시판 목록 시작
if(!$_GET['p']) $_GET['p'] = 1;
if($sss[30]){
if($type == 'k') {
if($_GET['type'] == 'a' || $_GET['c'] || $_GET['m'] || $_GET['keyword'] || $_GET['arrange'] || $_GET['no']) $type = 'a';
$_SERVER['QUERY_STRING'] = preg_replace("`&(amp;)?date=[0-9]+`i","",$_SERVER['QUERY_STRING']);
} else if($sss[26] == 'e') {
if($_GET['type'] == 'a' || $cmkd == 2 || $_GET['ct'] || $_GET['arrange']) {$type = 'a'; $isnt = $isnt*$sett[19];}
else if($_GET['no']) $type = 'a';
else $type = 'b';
}
if($type == 'c') $len = 320;
else if($type == 'b'||$type == 'd') $len = 0;
else $len = 256;
if($_GET['xx'] > 0) $idd = $id."/^".$_GET['xx'];
else $idd = $id;
if($ismobile != 2 && ($sss[28] == 1 || $sss[28] == 3) && ($type == 'a' || $type == 'g')) $sss[28] = 4;
if($sss[32] == 1 || $sss[32] == 3) $sss[32] = 4;
if($ismobile != 2 && ($sss[70] == 1 || $sss[70] == 3)) $sss[70] = 4;
if($sss[71] == 1 || $sss[71] == 3) $sss[71] = 4;
if($sss[72] == 1 || $sss[72] == 3) $sss[72] = 4;
if($sss[73] == 1 || $sss[73] == 3) $sss[73] = 4;
if($sss[73] != 4 && $_GET['search'] != 'b' && (!$sss[54] || !$wdth[7][0])) $bodd = "";
else $bodd = "/body.dat";
$uuu = "";
if($sss[64] && $_GET['m']) {scrhref($dxpt,0,'익명게시판에서는  회원검색이 안됩니다');exit;}
if($_GET['keyword']) $_GET['keyword'] = trim($_GET['keyword']);
if($schphp) {
if($type != 'g' && ($sett[10] == '1' || $sett[10] == '2')) $newwin = '" target="_blank" rel="';
if(!$_GET['arrange'] && $sss[65] && $cmkd != 2) $_GET['arrange'] = 'hot';
include("include/search.php");
} else {
if(!$_GET['xx']) {
$start = $isnt*($gp - 1);
if($fnt < $start) {
$ftt = $start - $fnt;
$ih = $start - $fnt;
if($wdth[6]) {
for($i = $wdth[6];$i > 0;$i--) {
$fnnt = substr($do[$i], 12, 6);
$ftt -= $fnnt;
if($ftt < 0) {
$ida = $i;
$start = $ih;
break;
} else $ih -= $fnnt;
}}
} else $ida = "";
if($ida > 0) $idd = $id."/^".$ida;
else $idd = $id;
} else {
$idd = $id."/^".$_GET['xx'];
$start = $isnt*($_GET['p'] - 1);
$fct = $fnt;
}
$end = $start + $isnt;
$n = $isnt;
if($type == 'a' && $wdth[4]) {
if(!$nscc) {
$nss = explode('^', $wdth[4]);
$nsc = count($nss) -1;
$nscc = $nsc;
}
if($_GET['p'] > 1) $start = $start - $nsc;
$end = $end - $nsc;
if($_GET['p'] == 1) {
$a = fopen($dxr.$id."/notice.dat","r");
for($aa=0;!feof($a);$aa++) $fns[$aa] = fgets($a);
fclose($a);
$ncc = 0;
while($ncc < $nsc && $fns[$ncc]) {
	$fdl[$n] = substr($fns[$ncc], 6);
	$fdn[$n] = substr($fns[$ncc], 0, 6);
	$fda[$n] = $ida;
	$n--;
	$ncc++;
}
}
}
$i = 0;
$fn = fopen($dxr.$idd."/no.dat","r");
$fl = fopen($dxr.$idd."/list.dat","r");
if($bodd) $fb = fopen($dxr.$idd.$bodd,"r");else $fb = 0;
while($i < $end) {
	$fno = fgets($fn);
if($n == 0) break;
if($fno == "" || $fno == "\n") {
list($ida,$fn,$fl,$fb) = data6($ida,array($fn,$fl,$fb),0);
if($ida == 'q') break;
} else {
if($i >= $start && $fno[6] != 'a') {
	$fda[$n] = $ida;
	$fdn[$n] = $fno;
	$fdl[$n] = fgets($fl);
	if($bodd) {$fbo = fgets($fb);$fdb[$n] = strcut($fbo, $len);if($sss[54] && $wdth[7][0]) $faf[$n] = substr($fbo,strpos($fbo,"\x1b"));}
	$fdu[substr($fno,0,6)] = 1;
	$n--;
	} else {
if($fno[6] == 'a') $end++;
fgets($fl);
if($bodd) fgets($fb);
}
$i++;
}
}
fclose($fn);
fclose($fl);
if($bodd) fclose($fb);
}}
$ida = '';
$fu = fopen($dxr.$id."/upload.dat","r");
while($fuo = substr(fgets($fu),0,6)) {if($fdu[$fuo] == 1) $fdu[$fuo] = 3;}
fclose($fu);
if($wdth[7][4]) {
	$fr = fopen($dxr.$id."/new_rp.dat","r");
	while(!feof($fr)){
	$fro = fgets($fr);
	$frn = substr($fro,0,6);
	if(trim($frn) && ($fdu[$frn] == 1 || $fdu[$frn] == 3)) {
	if(substr($fro,34,10) > $sett[62]) $fdu[$frn] += 1;
	}}
	fclose($fr);
}
// 게시판 목록 윗부분
if($fcct) $fct=$fcct;
if(!$sum) $sum=$fct;
else $fct--;
if($fno !== 'a') {
if($_GET['desc'] == 'asc') $fno = $isnt*($gp-1) + 1;
else $fno = $fct - $isnt*($gp-1);
if($nsc) $fno = $fno + $nsc;
}
$ctgs = "";
if($type != 'd') {
if($wdth[7][30]) {
if(!$sss[53]) {
$ctgs .= "<a href=\"#none\" title=\"목록\" class=\"aabcg\" onclick=\"this.blur();locato('type','a')\"><img src=\"icon/al.gif\" alt=\"목록형\" class=\"abcg\" /></a>
<a href=\"#none\" title=\"본문\"  class=\"aabcg\" onclick=\"this.blur();locato('type','b')\"><img src=\"icon/bl.gif\" alt=\"본문형\" class=\"abcg\" /></a>
<a href=\"#none\" title=\"요약\"  class=\"aabcg\" onclick=\"this.blur();locato('type','c')\"><img src=\"icon/cl.gif\" alt=\"요약형\" class=\"abcg\" /></a>
<a href=\"#none\" title=\"갤러리\"  class=\"aabcg\" onclick=\"this.blur();locato('type','g')\"><img src=\"icon/gl.gif\" alt=\"갤러리형\" class=\"abcg\" /></a>
<a href=\"#none\" title=\"달력\"  class=\"aabcg\" onclick=\"this.blur();locato('type','k')\"><img src=\"icon/kl.gif\" alt=\"달력형\" class=\"abcg\" /></a>";
}
if($ctg && $sss[27] == '1') {
$ctgs .= "\n<select id='ctt' class='t8' onchange=\"locato('ct',this.options[this.selectedIndex].value)\">";
$ctgs .= "	<option value='' class='t8'>분류</option>";
for($i = 1; $i <= $ctl; $i++){
$it = str_pad($i,2,0,STR_PAD_LEFT);
if($ctg[$it]) $ctgs .= "	<option value='{$it}' class='t8'>".preg_replace("`<[^>]+>`","",$ctg[$it])." ({$ctgn[$it]})</option>";
}
$ctgs .= "</select>";
}
if($sss[45] && $sss[47] && !$_GET['keyword'] && !$_GET['c']) {
function arraydsp($odr) {
if($_GET['arrange'] == $odr) {
if($_GET['desc'] == 'asc') return "style='background:#7df;'";
else return "style='background:#000;color:#fff'";
}}
$ctgs .= "\n<select class='t8' onchange='arrange(this.options[this.selectedIndex].value);'>
<option value='' class='t8'>정렬</option>
<option value='no' class='t8' ".arraydsp('no').">번호</option>
<option value='subject' class='t8' ".arraydsp('subject').">제목</option>
<option value='name' class='t8' ".arraydsp('name').">이름</option>
<option value='date' class='t8' ".arraydsp('date').">날짜</option>
<option value='view' class='t8' ".arraydsp('view').">조회</option>
<option value='rp' class='t8' ".arraydsp('rp').">덧글</option>";
if($sss[60]) $ctgs .= "\n<option value='appr' class='t8' ".arraydsp('appr').">추천</option>";
if($sss[61]) $ctgs .= "\n<option value='oppo' class='t8' ".arraydsp('oppo').">비추</option>";
if($wdth[7][5]) $ctgs .= "\n<option value='point' class='t8' ".arraydsp('point').">평점</option>";
$ctgs .= "\n<option value='hot' class='t8' ".arraydsp('hot').">활성</option>\n</select>";
}
}
if($sss[27] == '2' && $ctg) {
$ct_list = "<div class='ct_vtc'>";
foreach($ctg as $ii => $category) {
if($category) {
if($_GET['ct'] && $_GET['ct'] == $ii) $linK = 'slctd';
else $linK = '';
$ct_list .= "<input type='button' class='{$linK}' onclick='locato(\"ct\",\"{$ii}\")' value='".preg_replace("`<[^>]*>`","",$category)."' />";
}}
$ct_list .= "</div>";
}} else $wdth[7][30] = 0;
/* 목록공통 상단 시작 */
$wtdh = $srwdth - 6;
if($otype == 'k') $_GET['p'] = $calp;
if($type == 'k') {
include('include/list_calendar.php');
} else {
$sr_list = tagcut('list',$srkin);
$list_top = tagcut('list_top',$sr_list);
$list_top = str_replace("<#ct_list#>",$ct_list,$list_top);
if($wdth[7][30] == '1') $list_top = str_replace("<#icoselect#>",$ctgs,$list_top);
$srkiin = preg_replace("`<#[^#]+#>`","",$list_top);
$sr_cols = tagcut('list_head_cols',$sr_list);
if($sr_cols) {
function listr($xt) {
global $sss;
$s3859['no'] = $sss[38];
$s3859['name'] = $sss[39];
$s3859['date'] = $sss[40];
$s3859['visit'] = $sss[41];
$s3859['appr'] = $sss[42];
$s3859['oppo'] = $sss[59];
return $s3859[$xt];
}
$srcl = explode("<col ",$sr_cols);
for($i=0;$srcl[$i];$i++) {
if($srcp = strpos($srcl[$i],'px')) {
$srcw = substr($srcl[$i],7,$srcp - 7);
if($srcw < 200) {
if(substr($srcl[$i-1],-2) == '#>') $srclw[substr($srcl[$i-1],-6,4)] = $srcw;
else $wtdh -= $srcw;
}}
if($i > 0) {$ix = $i -1;if(substr($srcl[$ix],-2) == '#>') {if(strpos($srcl[$i],'<!--/-->') !== false) {$xtd = substr($srcl[$ix],strpos($srcl[$ix],'<#x_')+4,-2);if(listr($xtd)) {if(!$xtx) $xtx = $xtd;$xxt = $xtd;}}} else $xxt = '';}
}
} else $srclw = array('isct'=>0,'x_no'=>0,'name'=>0,'date'=>0,'isit'=>0,'appr'=>0,'oppo'=>0);
if($ctg && $sss[48]) {$isct = 1;$wtdh -= $srclw['isct'];} // 게시판에 설정된 분류이름이 있으면
else $sr_list = str_replace("<#isct#>","<;>",$sr_list);
$cols = $i - 7 + $sss[38] +$sss[39] +$sss[40] +$sss[41] +$sss[42] + $isct;
$sr_list = str_replace("<#cols#>",$cols,$sr_list);
if($type == 'b') $list_head = tagcut('list_head_b',$sr_list);
else if($type == 'c') $list_head = tagcut('list_head_c',$sr_list);
else if($type == 'g') $list_head = tagcut('list_head_g',$sr_list);
else if($type == 'd') {
$list_head = tagcut('list_head_d',$sr_list);
if($sss[24] != 'a' && $sss[24] <= $mbr_level) {
if($sett[82] < 3 || ($mbr_no && $sett[82] != 5)) $list_head = str_replace("<#isatspm#>","<;>",$list_head);
else {$list_head = str_replace("<#pno#>",$uzip,$list_head);}
$list_head = str_replace("<#yname#>",$uzname,$list_head);
$list_head = str_replace("<#ypass#>",$uzpass,$list_head);
$gwrt = "<input type='hidden' name='id' value='{$id}' />";
$gwrt .= "<input type='hidden' name='p' value='{$_POST['p']}{$_GET['p']}' />";
$gwrt .= "<input type='hidden' name='pno' value='{$uzip}' />";
$list_head = str_replace("<#gwrt#>",$gwrt,$list_head);
} else $list_head = str_replace("<#gwrt#>","<script type='text/javascript'>document.guest_.style.display='none';</script>",$list_head);
?>
<script type="text/javascript" src="include/guest.js"></script>
<?
}
if(!$list_head || $type === 'a'){
if($type !== 'a') {$type = 'a';if($_GET['type']) $_GET['type'] = 'a';}
if(!$sss[38]) $sr_list = str_replace('<#x_no#>','<;>',$sr_list);else $wtdh -= $srclw['x_no'];
if(!$sss[39]) $sr_list = str_replace('<#x_name#>','<;>',$sr_list);else $wtdh -= $srclw['name'];
if(!$sss[40]) $sr_list = str_replace('<#x_date#>','<;>',$sr_list);else $wtdh -= $srclw['date'];
if(!$sss[41]) $sr_list = str_replace('<#x_visit#>','<;>',$sr_list);else $wtdh -= $srclw['isit'];
if(!$sss[42]) $sr_list = str_replace('<#x_appr#>','<;>',$sr_list);else $wtdh -= $srclw['appr'];
if(!$sss[59]) $sr_list = str_replace('<#x_oppo#>','<;>',$sr_list);else $wtdh -= $srclw['oppo'];
$list_a = tagcut('list_head_a',$sr_list);
if($xtx) $list_a = str_replace('<#x_'.$xtx.'#><td','<td class="list_tf"',$list_a);
else $list_a = str_replace('<td  ','<td class="list_tf" ',$list_a);
if($xxt) $list_a = str_replace('<#x_'.$xxt.'#><td','<td class="list_th"',$list_a);
else $list_a = str_replace('<td  ','<td class="list_th" ',$list_a);
$sr_cols = tagcut('list_head_cols',$sr_list);
$list_head = $sr_cols.$list_a;
}
$srkiin .= $list_head;
if($newwin) {$rrt = $rt;$rt = $newwin;}
if($fct > 0){
$ii = 0;
$iii = 0;
if($type == 'c') $list_bodyy = tagcut('list_body_c',$sr_list);
else if($type == 'b') $list_bodyy = tagcut('list_body_b',$sr_list);
else if($type == 'g') $list_bodyy = tagcut('list_body_g',$sr_list);
else if($type == 'd') $list_bodyy = tagcut('list_body_d',$sr_list);
if(!$list_bodyy || $type === 'a') $list_bodyy = tagcut('list_body_a',$sr_list);
$mn = '';
for($i = $isnt; $i > 0; $i--) {
if($fdn[$i][9] != "\x1b") {
$mn[] = substr($fdn[$i],9,strpos($fdn[$i],"\x1b") - 9);
}
}
if(is_array($mn)) {
$fmm = array();
$fim = fopen($dim,"r");
while($fm = fgets($fim)) {
$fmo = (int)substr($fm,0,5);
if(in_array($fmo, $mn)) {
$fmm[$fmo] = explode("\x1b",$fm);
}
}
fclose($fim);
}
if($sss[54] && $wdth[7][0]) {
$addf = substr_count($list_bodyy,'<#addfield');
function addlist($return,$val) {
global $addf;
$val = explode("\x1b",$val);
for($d = 1;$d <= $addf;$d++) {
$return = str_replace("<#addfield_".$d."#>",$val[$d],$return);
}
return $return;
}}
for($i = $isnt; $i > 0; $i--) {
if(trim($fdn[$i])){
$zzz = explode("\x1b",$fdn[$i]);
$flo = explode("\x1b", $fdl[$i]);
$no6 = substr($zzz[0], 0, 6);
$ctn = substr($zzz[0], 6, 2);
$mn = substr($zzz[0], 9);
if($sss[64]) $flo[1] = '익명';
$name = $flo[1];
$list_body = str_replace("<#xx#>",$fda[$i],$list_bodyy);
$wdtt = 0;
if($mbr_level == 9) $list_body = str_replace("<#no_check#>","<input type='checkbox' name='cart' value='".$no6."' onclick='uchoice(this)' class='cart' /><input type='hidden' name='ixx' value='".$fda[$i]."' /> ",$list_body);
if($type === 'a'){if($flo[4]) {$list_body = str_replace("<#isimg#>","<img src='icon/img.gif' class='mL4 wh13' alt='' />",$list_body);$wdtt += 20;}
if($fdu[$no6] > 2) {$list_body = str_replace("<#isfile#>","<img src='icon/f.png' class='mL4 wh13' alt='' />",$list_body);$wdtt += 20;}}
$no = (int)$no6;
if($flo[3] == '') $flo[3] = ' …… ';
$re_depth = '';
$cmtlv = '';
$date = substr($flo[0], 0, 10);
$notx = 0;
if($sss[54] && $wdth[7][0]) $list_body = addlist($list_body,$faf[$i]);
if(false !== strpos($wdth[4], $no."^") && $nsc > 0 && $_GET['p'] == 1) {
$notx = ($ii > 0)? 1:2;
$list_body = str_replace("<#notice#>","notice",$list_body);
$list_body = str_replace("<#fnno#>","<b> 공지</b>",$list_body);
$list_body = str_replace("<#nHit#>","-",$list_body);
$list_body = str_replace("<#nAppr#>","-",$list_body);
$list_body = str_replace("<#nOppo#>","-",$list_body);
$ii--;
$nsc--;
$isntc = 1;
} else {
$isntc = 0;
if($_GET['no'] == $no) {
if($type == 'g') $name = "<u>".$name."</u>";
else $fnno = "<img src='icon/slct.gif' border='0' alt='' />";
} else if($fno === 'a') $fnno = $no;
else $fnno = $fno;
$list_body = str_replace("<#fnno#>",$fnno,$list_body);
$list_body = str_replace("<#nHit#>",(int)$zzz[1],$list_body);
if($type == 'd') $list_body = imn($mn,$date,$list_body,$no,$fda[$i]);
if($sss[60] || $sss[61] || $wdth[7][5]) {
$nvote = explode('|',$zzz[5]);
if($sss[60] || $wdth[7][5]) {
if($sss[60]) $ratng = (int)$nvote[0];
else $ratng = ($nvote[1])? sprintf("%.1f",$nvote[0]/$nvote[1]*2):0;
$list_body = str_replace("<#nAppr#>",$ratng,$list_body);
}
if($sss[61]) $list_body = str_replace("<#nOppo#>",(int)$nvote[1],$list_body);
if($wdth[8][1] && (($wdth[8][1] == 3  && substr($wdth[8],2) <= $nvote[0]) || ($wdth[8][1] == 4  && substr($wdth[8],2) <= $ratng) || ($wdth[8][1] == 5  && ($wdth[7][5] && substr($wdth[8],2) <=$nvote[1] || !$wdth[7][5] && substr($wdth[8],2) <=$nvote[0] + $nvote[1])))) $notxx = 2;
}
if($notxx == 2 || ($wdth[8][1] == 1 && substr($wdth[8],2) <= $zzz[1]) || ($wdth[8][1] == 2 && substr($wdth[8],2) <= $zzz[2]))  {$notxx = "<img src='icon/hot.gif' class='mL4' alt='' />";$wdtt += 25;} else $notxx = '';
if($wdth[7][4] && ($date >= $sett[62] || $fdu[$no6] == 2 || $fdu[$no6] == 4)) {$list_body = str_replace("<#isnew#>","<img src='icon/new.gif' class='mL4' alt='' />".$notxx,$list_body);$wdtt += 25;}
else if($notxx) $list_body = str_replace("<#isnew#>",$notxx,$list_body);
if($_GET['search'] == 's') $flo[3] = skword($flo[3]);
$islock = 0;
if((int)$zzz[0][8]) {
if($zzz[0][8] == 9) $islock = 1;
if($zzz[0][8] > $mbr_level && $_COOKIE["scrt_".$no.$id] != md5($no."_".$sessid.$id)) $secret = ($islock)? 2:1;
} else $secret = $authority[23];
if($islock) {if($type != 'g') $re_depth .= "<img src='icon/lock.gif' alt='' class='lock' />";else $flo[3] = "[잠김] ".$flo[3];}
if($secret == 2 || ($secret && $sss[73] != 4)) {
if($sss[28] == 4) {$memb .= "\npretxt[{$ii}] = \"[비밀글]\";";$pretxt = 1;}
else if($type != 'a') {$list_body = str_replace("<#memb#>","<div class='authority' id='pass{$id}_{$no}' align='center'>비밀글 입니다.</div>",$list_body);
if(!$mn) $onload .= "\nsetTimeout(\"ffpass('pass{$id}_{$no}','{$no}','{$fda[$i]}')\",50);";
}}}
if(!$isntc && ($zzz[2] > 0 || $zzz[3] > 0 ||($wdth[0][49] != '2' && $zzz[4] > 0))) {$nrp = (int)($zzz[2] + $zzz[3]);if($wdth[0][49] != '2') $nrp += (int)$zzz[4]; if($type === 'a') $wdtt += $sett[28] + strlen($nrp)*5;}
else {$list_body = str_replace("<#isnrp#>","<;>",$list_body);$nrp = 0;}
if(!$isntc) {
if($secret != 2 && $notx != 2 && $sss[28] == 4) $list_body = str_replace("<#oprvw#>","name=\"pv{$ii}\"",$list_body);
if(!$notx && !$secret && $nrp) {
if($sss[71] == 4) {
$cmtlv .= " target='_blank' href='?id={$eid}&amp;comment={$no}'";
if($sss[70] == 4) $cmtlv .= " onmouseover='imgview(this.href,5,0)'";
} else if($sss[70] == 4) {$list_body = str_replace("<#ispvrp#>","<a href='#none' onmouseover='imgview(\"?id={$eid}&amp;comment={$no}\",5,0)'>",$list_body);$cmtlv = 3;}
if($cmtlv && $cmtlv != 3) $list_body = str_replace("<#ispvrp#>","<a{$cmtlv}>",$list_body);
}
if(!$cmtlv) $list_body = str_replace("<#ispvrp#>","<a href='#none'>",$list_body);
$rsimg = 1;
$rissimg = 1;
if($secret == 2 || $sss[73] != 4) $fdb[$i] = "";
if($secret == 2 || $sss[72] != 4) {
if($type == 'g') {$list_body = str_replace("<#simg#>","icon/noimg.gif",$list_body);$rsimg = 0;}
else if($type == 'c') {$list_body = str_replace("<#issimg#>","<;>",$list_body);$rissimg = 0;}
$flo[4] = '';
}
if($secret && $secret != 2 && $flo[5]) {
	$list_body = str_replace("<#no_jslink#>","onclick=\"nwopn('{$flo[5]}')\"",$list_body);
	$list_body = str_replace("<#target#>","target='_blank'",$list_body);
	$list_body = str_replace("<#no_link#>",$flo[5],$list_body);
	$fdb[$i] .= "<div class='authority' align='center'>링크주소로 연결 됩니다</div>";
	if($sss[32] == 4) $list_body = str_replace("<#isnlink#>","<;>",$list_body);
}
else if($flo[5]) {$list_body = str_replace("<#rlink#>",$flo[5],$list_body);$wdtt += 22;}
if($flo[4]) {
if(substr($flo[4], 0, 5) != "http:") $flo[4] = $exe."?id=".$uid."&amp;file=".str_replace(" ","+",$flo[4]);
if($rsimg) $list_body = str_replace("<#simg#>",$flo[4],$list_body);
if($sss[28] == 4) $flo[4] = "<img src='{$flo[4]}' class='gthumb_100' alt='' />";
else $flo[4] = '';
} else if($type == 'g' && $rsimg) $list_body = str_replace("<#simg#>","icon/noimg.gif",$list_body);
else if($type == 'c' && $rissimg) $list_body = str_replace("<#issimg#>","<;>",$list_body);
if($sss[28] == 4 && $notx != 2 && !$pretxt) $memb .= "\npretxt[{$ii}] = \"".str_replace('"','\\"',$flo[4])."<div class='prsjt'>".str_replace('"','\\"',$flo[3])."<\/div><span class='n8'> by ".str_replace('"','\\"',$flo[1])."<\/span> <span class='r7'>[".(int)$nrp."]<\/span><br \/>".str_replace('"','\\"',$fdb[$i])."\";";
else $pretxt = 0;
$list_body = str_replace("<#no_jslink#>","onclick=\"rhref('{$index}?id={$eid}&amp;no={$no}&amp;p={$_GET['p']}{$rt}')\"",$list_body);
if($type == 'b') {
if(!$wdth[7][32] && $flo[6]) {
$tagg = explode(",",$flo[6]);
$tag = "<div class='tagg'><img src='icon/tag.gif' alt='' /> ";
for($j = 0; trim($tagg[$j]); $j++){
if($_GET['search'] == 't' && $_GET['keyword'] == $tagg[$j]) $tagg[$j] = "<span class='keyword'>{$tagg[$j]}</span>";
$tag .= "<a href='{$index}?id={$eid}&amp;search=t&amp;keyword=".urlencode($tagg[$j])."&amp;p=1'>{$tagg[$j]}</a>, ";
}
$tag = substr($tag, 0, -2)."</div>";
$list_body = str_replace("<#tag#>",$tag,$list_body);
}
$list_body = str_replace("<#nReply#>",(int)$zzz[2],$list_body);
$list_body = str_replace("<#nTrb_out#>",(int)$zzz[3],$list_body);
$list_body = str_replace("<#nTrb_in#>",(int)$zzz[4],$list_body);
$list_body = str_replace("<#uplist#>",uplist($no),$list_body);
} else if($type == 'd') {
if((!$mn || $sss[44] < 3) && ($mbr_level == 9 || ($sss[44] != 2 && $sss[44] != 9 && ($mbr_level || $sss[44] == 0 || $sss[44] == 7)))) $list_body = str_replace("<#ipr#>",trim(substr($flo[0], 10, 15)),$list_body);
else $list_body = str_replace('<#isipr#>','<;>',$list_body);
$list_body = str_replace('<#scrt#>',$zzz[0][8],$list_body);
}
}
if($flo[5] == '' || $secret == 2 || $sss[32] != 4) $list_body = str_replace("<#isnlink#>","<;>",$list_body);
if($aview == 6) {
if($isie == 1) $list_body = str_replace("<#no_link#>","#none\" onclick=\"aview('{$id}','{$no}','{$xx}')",$list_body);
else $list_body = str_replace("<#no_link#>","#none\" onclick=\"alert('IE에서만 보입니다')",$list_body);
} else $list_body = str_replace("<#no_link#>","{$index}?id={$eid}&amp;no={$no}&amp;p={$_GET['p']}{$rt}",$list_body);
if($zzz[6][0] > 0) {
for($r = $zzz[6][0];$r > 0; $r--) $re_depth = "&nbsp;&nbsp; ".$re_depth."re:";
$re_depth = "<span class='t8'>".$re_depth."</span> ";
}
if($isct && $ctg[$ctn]) {
$list_body = str_replace("<#ct_no#>","{$ctn}",$list_body);
$list_body = str_replace("<#ct_name#>","{$ctg[$ctn]}",$list_body);
} else $list_body = str_replace("<#isnct#>","<;>",$list_body);
$list_body = str_replace("<#subject#>",$flo[3],$list_body);
$list_body = str_replace("<#re_depth#>",$re_depth,$list_body);
$list_body = str_replace("<#no#>",$no,$list_body);
$list_body = str_replace("<#ii#>",$ii,$list_body);
if($mn) $hmpg = $fmm[$mn][10];else if($type == 'd' && $flo[5]) $hmpg = $flo[5];else $hmpg = '';
$list_body = str_replace("<#name#>",name($name, $mn, 0, 1, $fmm[$mn][2], $hmpg),$list_body);
$list_body = str_replace("<#tname#>",name($name, $mn, 0, 0, $fmm[$mn][2], $hmpg),$list_body);
if($type === 'a'){
if($date > 0) $list_body = str_replace("<#date#>",date("Y.m.d", $date),$list_body);
$list_body = str_replace("<#nrp#>",$nrp,$list_body);
$list_body = str_replace("<#cno#>",$iii %2,$list_body);
if($ismobile != 2 && !$sett[77]) {
$wdtt = $wtdh - $wdtt;
if($bwr == 'ie6') $list_body = str_replace("<#wtdh#>","width:expression((this.scrollWidth < {$wdtt})? '':'{$wdtt}px')",$list_body);
else $list_body = str_replace("<#wtdh#>","max-width:{$wdtt}px",$list_body);
}} else {
if($date > 0) $list_body = str_replace("<#date#>",date("Y.m.d H:i", $date),$list_body);
$list_body = str_replace("<#memb#>",nocopy($fdb[$i]),$list_body);
$list_body = str_replace("<#nrp#>",(int)$nrp,$list_body);
}
$srkiin .= $list_body;
$ii++;
$iii++;
}
if($fno !== 'a') {
if($_GET['desc'] == 'asc') $fno++;
else $fno--;
}
}
}
// 게시판 목록 아랫부분
$srkin = tagcut('list_tail',$sr_list);
if($type != 'g' && $type != 'b' && $type != 'd') $srkin = str_replace('<#gdb#>','<;>',$srkin);
else if($type == 'g') $srkin = str_replace('<#gdb#>','</td></tr>',$srkin);
else $srkin = str_replace('<#surl#>','?section='.$section,$srkin);
if($wdth[7][32] || $sss[26] == 'd') $srkin = str_replace('<#sss26#>','<;>',$srkin);
if($sss[26] == 'd' || $sss[24] === 'a' || ($sss[63] && $mbr_level != 9) || $sss[24] > $mbr_level) {
$srkin = str_replace('<#isrss#>','<;>',$srkin);
$srkin = str_replace('<#isnrss#>','<;>',$srkin);
} else if($sss[63]) $srkin = str_replace('<#isnrss#>','<;>',$srkin);
else $srkin = str_replace('<#isrss#>','<;>',$srkin);
if($wdth[7][30] == '2') $srkin = str_replace("<#icoselect#>",$ctgs,$srkin);
$srkiin .= $srkin;
if($inclwt=inclvde($srkiin)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) include($inxv[1]);else echo $inxv[1];}
}
?>
<table cellpadding='0px' cellspacing='0px' width='<?=$srwdthx?>'>
<?
if($sss[30]) {
if($_GET['keyword'] && $_GET['search'] != 'ip' && $_GET['search'] != 'rip') $onload .= "document.sform.keyword.value = '{$_GET['keyword']}';\ndocument.sform.search.value = '{$_GET['search']}';\n";
?>
<tr><td>
<?
// 목록번호 출력
if($newwin) $rt = $rrt;
$fct += (int)$nscc;
if($otype == 'k') $allp = $mcnt;
else $allp = (int)(($fct - 1)/ $isnt) + 1;
if($ismobile == 2) pagen('p',$allp,5,$sum);
else pagen('p',$allp,10,$sum);
?>
</td></tr>
<tr><td align="center">
<form method="get" name="sform" action="?"><input type="hidden" name="id" value="<?=$id?>" /><input type="hidden" name="ct" value="<?=$_GET['ct']?>" /><input type="hidden" name="p" value="1" />
<select name="search" onchange="searchc(this.options[this.selectedIndex].value)" class="sform"><option value="s">제목</option><option value="b">본문</option><option value="t">태그</option><option value="n">이름</option><option value="r">덧글</option></select>&nbsp;
<input type="text" name="keyword" class="sform" value="" />
<input type="submit" id="submit" value=" 검색 " class="srbt" /></form>
</td></tr>
<?
}
$rrt = str_replace('amp;','',$rt);
if($mbr_level == 9) {
?>
<tr><td align='right'>
<script type="text/javascript" src="include/admin.js"></script>
<form name='adselect' method='post' action='<?=$exe?>'>
<input type='hidden' name='selected' />
<input type='hidden' name='id' value='<?=$id?>' />
<input type='hidden' name='p' value='<?=$gp?>' />
<input type='hidden' name='xx' value='<?=$xx?>' />
<input type='hidden' name='request' value='<?=$_SERVER['REQUEST_URI']?>' />
<select name="perm_vw" onchange='choiced(1)' style='display:none;'><option value="">::권한변경</option><option value="0">모두허용</option><option value="r">rss출력제한</option><option value="1">레벨1</option><option value="2">레벨2</option><option value="3">레벨3</option><option value="4">레벨4</option><option value="5">레벨5</option><option value="6">레벨6</option><option value="7">레벨7</option><option value="8">레벨8</option><option value="9">관리자</option></select>
<select name='changeto' onchange='choiced(1)' style='display:none;'>
	<option value="">분류선택</option>
	<option value="00">::분류없음</option>
<?
for($i = 1; $i <= $ctl; $i++){
$i = str_pad($i, 2, 0, STR_PAD_LEFT);
?>
	<option value="<?=$i?>"><?=preg_replace('`<[^>]+>`','',$ctg[$i])?></option>
<?
}
?>
</select>
<select name='moveto' onchange='choiced(1)' style='display:none;'>
	<option value="">게시판선택</option>
<?
foreach($fsbs as $mid => $val) {
if($mid != $id) {
?>
	<option value="<?=$mid?>"><?=$mid?></option>
<?
}
}
?>
</select>
<div id='addtagdv' style='display:none;'><input type='text' name='addtag' value='' style='width:100px' /> <input type='button' onclick='choiced(1)' value='태그추가' class='srbt' /></div>
 <input type='button' onclick='choice()' value='전체선택' class='srbt' />
 <select name='exc' onchange="choiced(0)">
	<option value=""></option>
	<option value="change">분류 이동</option>
	<option value="move">게시판 이동</option>
	<option value="copy">게시판 복사</option>
	<option value="delete" style="background-color:#FCDBDB">게시물 삭제</option>
	<option value="delete_rp" style="background-color:#FCDBDB">덧글 삭제</option>
	<option value="delete_rtb" style="background-color:#FCDBDB">엮인글 삭제</option>
	<option value="delete_stb" style="background-color:#FCDBDB">엮은글 삭제</option>
	<option value="delete_body" style="background-color:#FCDBDB">본문 삭제</option>
<? if($_GET['ct']) {?>	<option value="deletect" style="background-color:#FCDBDB">범주글 모두 삭제</option><?}?>
	<option value="limit">읽기권한 변경</option>
<?
if($xx == 0){
?>
	<option value="notc_add">공지 등록</option>
	<option value="notc_dell">공지 제거</option>
<?
}
?>
	<option value="modify_rp" style="background-color:#EAFCE2">덧글수 정리</option>
	<option value="modify_newrp" style="background-color:#EAFCE2">최근덧글정리</option>
	<option value="modify_tag" style="background-color:#EAFCE2">태그 정리</option>
	<option value="modify_date" style="background-color:#EAFCE2">날짜 정리</option>
	<option value="modify_ct" style="background-color:#EAFCE2">분류 정리</option>
	<option value="modify_upload" style="background-color:#EAFCE2">업로드 정리</option>
	<option value="delete_thumb">썸네일 삭제</option>
	<option value="delete_lnk">링크 삭제</option>
	<option value="delete_tag">태그 삭제</option>
	<option value="delete_ip">본문IP 삭제</option>
	<option value="modify_time" style="background-color:#FCDBDB">게시물 재배치</option>
	<option value="add_tag" style="background-color:#FCDBDB">태그 추가</option>
</select></form></td></tr>
<?
}
?>
<tr><td>
<?
if(@filesize("skin/".$wdth[2]."/maker.txt")) {
?><div style='text-align:right' class='f8'>skin by <?=join('',file("skin/".$wdth[2]."/maker.txt"))?></div><?
}
?>
</td></tr>
<tr><td><iframe id='tag' src='' style='display:none;width:<?=$srwdthx?>;height:30px' frameborder='0'></iframe>
</td></tr>
</table>
<?
} else {
?><div class='authority' id='authority_list' align='center'></div><?
$onload .= "\nsetTimeout(\"$('authority_list').innerHTML=$('srlogin').innerHTML + '<br />목록보기 권한이 없습니다.<br />'\",100);";
}
?>
<script type='text/javascript'>
//<![CDATA[
function frite(reply) {
<?
if($sss[24] === 'a' || $sss[24] > $mbr_level) echo "alert('게시물 작성권한이 없습니다.');";
else {
if($_GET['ct']) $tmp = "&amp;ct=".$_GET['ct']; else $tmp = '';
?>
if(reply && '<?=$sss[54]?>' == '0' && '<?=$sss[55]?>' == '1') rhref('<?=$exe?>?id=<?=$eid?>&amp;depth=' + reply + '&amp;p=<?=$_GET['p']?><?=$tmp?>&amp;write=<?=$_GET['no']?>');
else if(!reply) rhref('<?=$exe?>?id=<?=$eid?>&amp;p=<?=$_GET['p']?><?=$tmp?>&amp;write=new');
<?}?>
}
<?
if($sss[63] && $sss[24] !== 'a' && $sss[24] <= $mbr_level){
?>
function rss(x) {
if(x == 1) location.href='<?=$exe?>?id=<?=$uid?>&read=1';
else popup('admin.php?rss=<?=$uid?>',480,200);
}
<?
}
?>
function arrange(xx) {
<?if($sss[47]){?>
var yy;
if(('<?=$_GET['keyword']?>' == '' && '<?=$_GET['c']?>' == '') || confirm('검색을 중단하고 항목별 정렬로 전환하시겠습니까')) {
if('<?=$_GET['arrange']?>' == xx && '<?=$_GET['desc']?>' == 'desc') yy = 'asc';
else yy = 'desc';
var x = location.search.slice(1).replace(/&keyword=[^&]*/gi,'').replace(/&search=[^&]*/gi,'').replace(/&arrange=[^&]*/gi,'').replace(/&desc=[^&]*/gi,'').replace(/&p=[^&]*/gi,'&p=1');
location.href='?' + x + '&desc=' + yy+ '&arrange=' + xx;
}
<?}?>
}

function vwrp(no) {
var comx = $('comment_' + no);
if(comx) {
if(comx.style.display == 'block') {
comx.style.display = 'none';
} else {
comx.contentWindow.location.replace('<?=$index?>?id=<?=$uid?><?=$rrt?>&comment=' + no);
comx.style.display = 'block';
}}}
if('<?=$_GET['p']?>' && '<?=$sss[30]?>' && $('ctt')) $('ctt').value='<?=$_GET['ct']?>';
if('<?=$xx?>' != '' && $('xxx')) $('xxx').value='<?=$xx?>';
if('<?=$_GET['date']?>' && $('mmm')) $('mmm').value='<?=$_GET['date']?>';
<?
if(!$wdth[7][32] && $_GET['search'] == 't' && $_GET['keyword'] && $_GET['p'] == '1') $onajax = "&tglus=".urlencode($_GET['keyword']);
$onload .= "\nsetTimeout('img_resize()',100);setTimeout('if(!isopo) img_resize()',1000);";
if($type=='d' && $_GET['rp']) $onload .= "\nvwrp('{$_GET['rp']}');";
?>
//]]>
</script>
<?
} else if(!file_exists($ds)) {
echo "<script type='text/javascript'>location.href='{$admin}';</script>";

} else {
?>
<table id='srgate' cellspacing='<?=$sett[39]?>px' cellpadding='0px' width='<?=$srwdthx?>' style='table-layout:fixed'>
<?
if(($_GET['find'] = trim($_GET['find']))) {
if($sett[10] == '1' || $sett[10] == '3') $linktarget = "target='_blank'";
if(!$_GET['p']) $_GET['p'] =1;
$np = $_GET['p'] + 1;
$acook = str_replace(" ","`",$_GET['find']."_p".$_GET['p']);
if($_GET['p'] > 1) {
$cookp = $_GET['p'] - 1;
$cookp = str_replace(" ","`",$_GET['find']."_p".$cookp);
$bcook = explode("_",$_COOKIE[$cookp]);
}
$bc0 = (int)$bcook[0];
$bc1 = (int)$bcook[1];
$bc2 = (int)$bcook[2];
$fndw = explode(" ",$_GET['find']);
function search($an, $bn, $cn, $bx, $erh) {
global $fsbs, $dxr, $mbr_level, $acook, $fndw;
$n = 0;
if(!trim($fndw[0])) return;
foreach($fsbs as $mid => $mss) {
$n++;
if($mid && $mss[12] !== 'a' && $mss[12] <= $mbr_level) {
if($n >= $an && $cn <= 20) {
$mwth = explode("\x1b",$mss);
if($bx) {$ida = $mwth[6] -$bx +1;$idb = "/^".$ida;}
if((!$idb || $ida > 0) && file_exists($dxr.$mid.$idb."/no.dat")) {
if(!$isb) $isb = 1;
$rft = (int)substr($mss, 6, 6);
$fl = fopen($dxr.$mid.$idb."/list.dat","r");
$fn = fopen($dxr.$mid.$idb."/no.dat","r");
$fb = fopen($dxr.$mid.$idb."/body.dat","r");
$i = 0;
while($i < $rft){
if($i >= $bn){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = fgets($fl);
$fbo = fgets($fb);
if((stristr($flo,$fndw[0]) && (!$fndw[1] || stristr($flo,$fndw[1])) && (!$fndw[2] || stristr($flo,$fndw[2]))) || (stristr($fbo,$fndw[0]) && (!$fndw[1] || stristr($fbo,$fndw[1])) && (!$fndw[2] || stristr($fbo,$fndw[2])))) {
if($cn < 20) $erh[$mid][$cn] = array((int)substr($zzz,0,6),$flo);
$cn++;
}
} else break;
} else {
fgets($fn);fgets($fl);fgets($fb);
}
$i++;
if($cn == 20) {$en=$n;$ei=$i;}
else if($cn > 20) break;
}
fclose($fl);
fclose($fn);
fclose($fb);
}
}
}
}
if($isb && $cn >= 20) {@setcookie($acook, $en."_".$ei."_".$bx);}
return array($cn,$i,$isb,$erh,$mbn);
}
?>
<tr><td style='line-height:140%;padding:10px;text-align:left'>
<?
$erh = array();
list($ii,$i,$isb,$erh,$mbn) = search($bc0, $bc1, 0, $bc2, $erh);
for($f=$bc2 + 1;$isb && $ii < 21;$f++) {
list($ii,$i,$isb,$erh,$mbn) = search(0, 0, $ii, $f, $erh);
}
while(list($key,$val) = @each($erh)) {
echo "<div style='margin:5px 0 5px 0px;border-bottom:2px solid #2A5EB2;'><a href='{$index}?id={$key}' style='color:#2A5EB2'><b>게시판 : {$bdidnm[$key]}</b></a></div>";
while(list($vo,$vns) = @each($val)) {
$flo = explode("\x1b",$vns[1]);
if(!stristr($flo[2],$_GET['find'])) {
echo "<span class='f7' style='color:#D7D7D7'><span style='font-size:6pt'>■</span> ".@date("m-d",substr($flo[0],0,10))."</span>&nbsp;<a href='{$index}?id={$key}&amp;no={$vns[0]}' {$linktarget}>[{$flo[1]}] {$flo[3]}</a><br />";
}
}
}
?>
</td></tr><tr><td>
<? 
pagen('p',$_GET['p'],10,(($isb && $ii > 20)? '+':''));
?>
</td></tr></table>
<?
} else if($_GET['member_login']) {
?>
<tr><td>
<div class='bd_name'><h2>회원로그인</h2><div><a href='http://mannam.cc/srboard/index.php?id=mPrayer'>HOME</a> &gt; <a href='<?=$index?>?member_login=1'>회원로그인</a></div></div>
<div class='c1png'> &nbsp; <a href='http://mannam.cc/srboard/index.php?id=mPrayer'><b>☞ 중보기도</b></a></div>
<?
include("include/login.php");
?>
</td></tr></table>
<?
} else {
// 전체 게시판 최근게시물
if($ismobile == 2) include("include/gate_mobile.php");
else if($sect[$section][1] != 3 && $sect[$section][1] != 6 && $sect[$section][1] != 7 && $sect[$section][1] != 's') {
$ida = '';
$nxs = 0;
$nwx = 0;
$tpn = 0;
$iii = 0;
include("include/gate.php");
if(trim($srkiin) == "</table>") include("include/login.php");
} else echo "</table>";
}
}
?>
<form method="post" action="<?=$exe?>" name="passe" style="display:none;position:absolute;top:100px;width:250px;text-align:center;z-index:11">
<input type="hidden" name="no" value="<?=$_GET['no']?>" />
<input type="hidden" name="pno" value="<?=$_GET['no']?>" />
<input type="hidden" name="p" value="<?=$_GET['p']?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="xx" value="<?=$xx?>" />
<input type='hidden' name='request' value='<?=$_SERVER['REQUEST_URI']?>' />
<input type='hidden' name='edit' value='<?=$_GET['edit']?>' />
<table class='pass' cellspacing='4px' cellpadding='4px' onmousedown="ry=document.passe;px=Array(x,ry.style.left);py=Array(y,ry.style.top);" onmouseup="ry='';px=0;py=0">
<tr><td style='width:200px'>비밀번호: <input type="password" onmousemove="ry='';px=0;py=0" name="pass" style="width:130px" value="<?=$uzpass?>" maxlength='10' /></td></tr>
<tr><td style='width:200px;text-align:center'><input type="button" value="취소" onclick="fpass()" class="srbt" style="width:70px" /> &nbsp; &nbsp; <input type="submit" name="editt" value="" class="srbt" style="width:70px" /></td></tr></table>
</form>
<form method="post" action="<?=$exe?>" name="mdrp" target="exe" style="display:none;position:absolute;top:100px;width:500px;text-align:center;z-index:10">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="xx" value="<?=$xx?>" />
<input type="hidden" name="cc" value="" />
<input type="hidden" name="ip" value="<?=md5($sessid)?>" />
<input type="hidden" name="request" value="<?=$_SERVER['REQUEST_URI']?>" />
<div id='mdrpdv'>
<div class='mdrp'>
<div class='mvpopup' onmousedown="ry=document.mdrp;px=Array(x,ry.style.left);py=Array(y,ry.style.top);" onmouseup="ry='';px=0;py=0">
<div style='float:left'><img src='icon/rp.gif' alt='' /> 덧글 수정</div><input type='button' onclick="rpmd()" value='X' /><div class='fcler'></div></div>
<div class='passup'>
<table cellspacing='6px' cellpadding='0px'>
<tr><td>비밀번호: <input type="password" name="pass" style="width:70px;margin-right:10px" value="<?=$uzpass?>" maxlength='10' />홈페이지: <input type="text" name="link" style="width:256px" value="" /></td></tr>
<tr><td><textarea name="content" rows="10" cols="25" style="width:450px;height:230px;font-size:9pt;overflow:auto"></textarea></td></tr>
<tr><td><textarea id='replace_a' rows="1" cols="1" style='width:40%;height:16px;overflow:hidden' onclick="if(this.value=='Find') this.value='';" ondblclick="this.value='';">Find</textarea>
<input type="button" value="replace" onclick="document.mdrp.content.value=document.mdrp.content.value.replace(new RegExp($('replace_a').value.replace(/([\(\)\{\}\[\]\.\?\+\*\|\^\$\\])/gi,'\\$1'),'gi'),$('replace_b').value);" class="srbt" style="width:10%" />
<textarea id='replace_b' rows="1" cols="1" style='width:40%;height:16px;overflow:hidden' onclick="if(this.value=='Replace') this.value='';" ondblclick="this.value='';">Replace</textarea></td></tr>
<tr><td><input type='checkbox' name='rsecrt' style='cursor:pointer' /> 비밀글 &nbsp; &nbsp; &nbsp; <input type="button" value="취소" onclick="rpmd()" class="srbt" style="width:70px" /> &nbsp; &nbsp; &nbsp; <input type="hidden" name="edit" value="" /><input type="button" value="덧글수정" onclick="prohsbmt(document.mdrp)" class="srbt" style="width:70px" /></td></tr></table>
</div><input type="button" class="rszdv" onmousedown="ry=document.mdrp.content;px=Array(x,ry.style.width,50);py=Array(y,ry.style.height,120)" onmouseup="ry='';px=0;py=0" /></div></div></form>
<?
$skv = '';
if($id) $skv = tagcut('listbottom',$srkn);
$skv .= tagcut('bottom',$srkn);
if($inclwt=inclvde($skv)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) include($inxv[1]);else echo $inxv[1];}
}
if($dxr) {
if(!$ismobile && (($sett[16][3] && !$id) || ($id && (($sett[16][5] && $_GET['no']) || ($sett[16][4] && !$_GET['no']))))) {if($sett[32]) @readfile($dxr."tail");else include($dxr."tail");}
if($sett[26]) include('module/'.$sett[26].'.php');
if($sett[3]) include($sett[3]);
}
?>
<script type='text/javascript'>
//<![CDATA[
<?=$memb?>

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
setTimeout('azax("<?=$exe?>?&check_memo=<?=$time?>&id=1&isvcnct=<?=$isvcnnct?>",9)',30000);
}
<? 
}
if($tpn || $nxs) {$sett60 = explode('|',$sett[60]);
if($tpn){?>
tpn = <?=$tpn?>;
tabchng = <?=$sett60[0]*1000?>;
<?} if($nxs) {?>
nwx = <?=$nwx?>;
newxchng = setInterval("newxrotate()", <?=$sett60[1]*1000?>);
<?}}?>

function resizeheight(w,h){
if(py[2]) {
w = w - parseInt(px[0]) + parseInt(px[1]);
h = h - parseInt(py[0]) + parseInt(py[1]);
if(w > 300 && h > 100) {
ry.style.width = w + 'px';
ry.style.height = h + 'px';
document.mdrp.style.width = w + px[2] + 'px';
document.mdrp.style.height = h + py[2] + 'px';
}} else {
w = w - parseInt(px[0]) + parseInt(px[1]);
h = h - parseInt(py[0]) + parseInt(py[1]);
ry.style.left = w + 'px';
ry.style.top = h + 'px';
}}
<? if($id && $aview) {?>
function emptyselect() {
var issel = '';
if(setop[0] == '2' && (issel = window.getSelection()) && issel.toString()) {issel.removeAllRanges();}
else if(setop[0] == '1' && (issel = document.selection.createRange()) && issel.htmlText) document.selection.empty();
document.oncontextmenu = new Function ('return false');
document.ondragstart = new Function ('return false');
document.onselectstart = new Function ('return false');
document.body.style.MozUserSelect = "none";
}
<?
$onload .= "\nsetInterval('emptyselect()',700);";
if($aview > 1) {?>
function keyctrl() {
alert('ctrlKey 금지');
return false;
}
var moux;
function mousedow(e) {
if((setop[0] == '1' && (event.button == 2 || moux != null)) || (setop[0] != '1' && e.which == 3)) {alert('우클릭 차단');moux=null;return false;}
else if(setop[0] == '1') moux = event.button;
}
setInterval('if(document.onmousedown == null){document.onmousedown = mousedow;}',300);
<?
if($isie == 1 || $bwr == 'chrome') echo "\ndocument.onmousedown = mousedow;\ndocument.onclick=function(){moux=null;};";
else echo "\ndocument.onclick = mousedow;";
if($aview >= 4) {
?>
function aview(idd,no,xx) {
if(idd) {
azax('include/aview.php?&id=' + idd + '&dd=' + no + '&xx=' + xx,'avax(ajax)');
}}
function avax(val) {
<? if($aview > 4) {if($isie == 1) echo "ajaxx=ajax.substr(1);popup('{$index}?block5=1',$('bd_main').offsetWidth,500,1);";} else {?>
var doc = $('ifr_bdo').contentWindow.document;
 		doc.open();
 		doc.write("<html>");
 		doc.write("<head>");
 		doc.write("<link rel='stylesheet' type='text/css' href='skin/<?=$srk?>/style.css' />");
 		doc.write("<style type='text/css'>body {overflow:hidden; font-size:<?=$fz?>pt; font-family:'<?=$faze?>'; margin:0;-moz-user-select:none}</style>");
 		doc.write("</head>");
 		doc.write("<body onload='img_resize()' class='bdo' oncontextmenu='return false' ondragstart='return false' onselectstart='return false'>");
 		doc.write(val.substr(1));
 		doc.write("<script type='text/javascript'>function img_resize() {var rszimg = document.getElementsByName('img580');if(rszimg) {for(i=rszimg.length -1; i >= 0; i--) {if(rszimg[i].width > <?=$sett[11]?>) rszimg[i].style.width = '<?=$sett[11]?>px';rszimg[i].style.cursor = 'pointer';}}setTimeout('resize()',100);}");
 		doc.write("function resize() {if(parent.location.href.indexOf('<?=$_SERVER['HTTP_HOST']?>') == -1) document.write();var ht=document.body.scrollHeight + \"px\";parent.$('ifr_bdo').style.height=ht;}<\/script>");
 		doc.write("</body>");
 		doc.write("</html>");
		doc.close();
$('ifr_bdo').style.width=$('ifr_bdo').parentNode.offsetWidth +"px";
<?}?>
}
<?
}}}
?>
function setup() {
imgview(0);
pview = $('pview');
sessno = <?=$sessno?>;
azax("<?=$exe?>?&onload=<?=$time?><?=$onajax?>&id=<?=($id)?$id:1?>&isvcnct=<?=$isvcnnct?>",9);
<?=$onload?>

<?
if($ismobile == 2) echo "if('{$_COOKIE['scrwdth']}' == '' || '{$_COOKIE['scrwdth']}' != window.screen.availWidth) document.cookie = 'scrwdth=' + window.screen.availWidth;";
if($_GET['ct'] && $_GET['deletect'] && $mbr_level == 9) echo "setTimeout(\"choice();document.adselect.exc.value = 'delete';choiced('delete_ct');\",100);";
?>
setTimeout("if($('curtain')) {if(setop[0] == '1') $('curtain').style.filter = 'alpha(opacity=50)';else $('curtain').style.opacity = '.50';$('curtain').style.height= document.documentElement.scrollHeight+'px';}",500);
}
setTimeout("setup()",100);
setTimeout("if(!sessno) setup()",300);
setTimeout("if(!sessno) setup()",800);
setTimeout("if(!sessno) setup()",1500);
function lochref(key,val) {
var url = "<?=$index?>?id=<?=$id?><?=$rrt?>&" + key + "=" + val;
location.href = url;
}
//]]>
</script>
<script type="text/javascript" src="include/bottom.js"></script>
<?
$time_end = getmicrotime();
$timee = $time_end - $time_start;
echo "<!--서버처리시간:: $timee -->";
if($ismobile == 3) {
?>
<div align="center">
<input type="button" class="msrbt" onclick="history.go(-1)" value="이전" />
<input type="button" class="msrbt" onclick="document.cookie='ckmobile=2';location.reload()" value="모바일버전" />
<input type="button" class="msrbt" onclick="location.href='<?=$index?>?member_login=<?=urlencode($_SERVER['REQUEST_URI'])?>'" value="<?=($mbr_level)? "로그아웃":"로그인";?>" />
</div>
<?
}
?>
<div id='srlogin'><? include("include/login.php");?></div>
<div id='curtain'></div>
</body>
</html>