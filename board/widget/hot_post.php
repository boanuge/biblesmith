<?
$limit = 10; // 출력할 갯수
$rbdt = '';
$frot = 0;
$i = 0;
foreach($fsbs as $rbid => $rbset) {
if($rbset[16] != 'd' && !$rbset[53] && !$rbset[46] && ($i < $limit || filemtime($dxr.$rbid."/body.dat") > $frot)) {
$ida = '';
$frn = fopen($dxr.$rbid."/no.dat","r");
$frl = fopen($dxr.$rbid."/list.dat","r");
for($ii = 0;$ii < $limit;$ii++) {
$frlo = fgets($frl); 
$frno = fgets($frn);
if($frno == "" || $frno == "\n") {
$rdth = explode("\x1b",$rbset);
list($ida,$frn,$frl) = data6($ida,array($frn,$frl),array($rbid,$rdth[6]));
if($ida == 'q') break;
}
if(substr($frno,6,2) == 'aa') {$limit++;continue;}
$rbdt[substr($frlo, 0, 10)] = array($rbid,substr($frno,0,6),$frno[8].substr($frlo, 25));
$i++;
}
fclose($frn);
fclose($frl);
if($i >= $limit) {
krsort($rbdt);
$rbdt = array_slice($rbdt,0,$limit,TRUE);
$frot = key(array_slice($rbdt,-1,1,TRUE));
}}}
if(is_array($rbdt)) {
krsort($rbdt);
?>
<table cellspacing='0' cellpadding='0' class='head_all hslice' id='wg_arct'>
<tr class='title_tr'><td class='title_td'><div style='padding-left:8px' class='entry-title'><b>전체 최근글</b></div></td></tr>
<tr><td class='gtlst entry-content'>

<?
$i = 1;
while($i <= $limit && list($key,$value) = each($rbdt)) {
$frrn = explode("\x1b",$value[2]);
$frrn[3] = preg_replace("`<[^>]+>?`i", "",str_replace("\"","",str_replace("&","&amp;",$frrn[3])));

if($frrn[0] > $mbr_level) $gif = "icon/lock.gif";
else $gif = "icon/sg.gif";
?>
<div class='link'><img src='<?=$gif?>' alt='' />&nbsp;<a href='<?=$index?>?id=<?=urlencode($value[0])?>&amp;no=<?=(int)$value[1]?>' class='pvxy'><?=$frrn[3]?></a></div><div class='small'><?=date("m/d", $key)?> - <?=$frrn[1]?> [<?=$bdidnm[$value[0]]?>]</div>
<?
$i++;
}
?>

</td></tr></table>
<?
}
?>