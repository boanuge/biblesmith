<?
$rctid = ''; //게시판 id
if($rctid && $bdidnm[$rctid]) {
$ida = '';
$ofn = fopen($dxr.$rctid."/no.dat","r");
$ofl = fopen($dxr.$rctid."/list.dat","r");
while(!feof($ofn)){
$ofnn = fgets($ofn);
if($ofnn == "" || $ofnn == "\n") {
$mwth = explode("\x1b",$fsbs[$rctid]);
list($ida,$ofn,$ofl) = data6($ida,array($ofn,$ofl),array($mid,$mwth[6]));
if($ida == 'q') break;
} else {
$oflo = explode("\x1b",fgets($ofl));
if($oflo[4]) {
if(substr($ofnn,6,2) == 'aa') continue;
$ofno = (int)substr($ofnn,0,6);
$nrp = explode("\x1b", $ofnn);
if($nrp[2] > 0 || $nrp[3] > 0 ||$nrp[4] > 0) $nrp = " <span class='r7'>[".(int)($nrp[2] + $nrp[4] + $nrp[3])."]</span>";
else $nrp = "";
$oflo[3] = str_replace("&","&amp;",$oflo[3]);
if(substr($oflo[4], 0, 5) != "http:") {
$ofu = fopen($dxr.$rctid."/upload.dat","r");
while(!feof($ofu)) {
$ofuv = fgets($ofu);
if((int)substr($ofuv,0,6) == $ofno) {
if($ext = substr($ofuv,-17,4)) {
$ext = strtolower($ext);
if($ext == '.jpg' || $ext == '.gif' || $ext == '.png' || $ext == '.bmp') {
$oflo[4] = $exe."?id=".urlencode($rctid)."&amp;file=".substr($ofuv,6,-13);
break;
}}}}
fclose($ofu);
}
?>
<table cellspacing='0' cellpadding='0' class='head_all'>
<tr class='title_tr'><td class='title_td'> &nbsp; <?=$bdidnm[$rctid]?>&nbsp; |&nbsp; <span class='small'>[<?=date("m/d", substr($oflo[0],0,10))?>]</span> <a href='?id=<?=$rctid?>&amp;no=<?=$ofno?>'><?=$oflo[3]?><?=$nrp?></a> <span class='small'>by <?=$oflo[1]?></span></td></tr>
<tr><td class='gtlst'>
<a href='<?=$index?>?id=<?=$rctid?>&amp;no=<?=$ofno?>'><img src='<?=$oflo[4]?>' style='width:400px;border:4px solid #F1F1F1' alt='' /></a>
</td></tr></table>
<?
break;
}}}
fclose($ofn);
fclose($ofl);
}
?>
