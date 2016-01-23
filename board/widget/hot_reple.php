<?
$list_number = 10; // 출력할 갯수
$rbdt = '';
$frot = 0;
$i = 0;
foreach($fsbs as $rbid => $rbset) {
if($rbset[42] != '1' && ($i < $list_number || filemtime($dxr.$rbid."/new_rp.dat") > $frot)) {
$fr = fopen($dxr.$rbid."/new_rp.dat","r");
for($ii = 0;$ii < $list_number && $fro = trim(fgets($fr));$ii++) {
$rbdt[substr($fro, 34, 10)] = array($rbid,$fro,$rbset[16]);
$i++;
}
fclose($fr);
if($i >= $list_number) {
krsort($rbdt);
$rbdt = array_slice($rbdt,0,$list_number,TRUE);
$frot = key(array_slice($rbdt,-1,1,TRUE));
}}}
if(is_array($rbdt)) {
krsort($rbdt);
?>
<table cellspacing='0' cellpadding='0' class='head_all hslice' id='wg_arrp'>
<tr class='title_tr'><td class='title_td'><div style='padding-left:8px' class='entry-title'><b>전체 최근덧글</b></div></td></tr>
<tr><td class='gtlst entry-content'>

<?
$i = 1;
while($i <= $list_number && list($key,$value) = each($rbdt)) {
$frr = preg_replace("`<[^>]+>?`i", "",str_replace("\"","",str_replace("&","&amp;",substr($value[1], 44))));
if($frr[0] == "\x1b") $frr = "[비밀글]";
?>
<div class='link'><img src='icon/sg.gif' alt='' />&nbsp;<a href='<?=$index?>?id=<?=urlencode($value[0])?>&amp;<?=($value[2] == 'd')?'rp':'no';?>=<?=(int)substr($value[1],0,6)?>&amp;cc=<?=substr($value[1],6,7)?>' class='pvxy'><?=$frr?></a></div><div class='small'><?=date("m/d", $key)?> - <?=substr($value[1], 14, 20)?><?if($section) echo "[".$bdidnm[$value[0]]."]";?></div>
<?
$i++;
}
?>

</td></tr></table>
<?
}
?>