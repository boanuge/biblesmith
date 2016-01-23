<?
if(!$topsection) {
$sb = "width:{$srwtpx}";
$sb .= ($sett[77] && $sett[88])? ";min-width:{$sett[88]}px":"";
echo "<div id='srboard' style='{$sb}'>\n<table id='srbtble' cellpadding='0px' cellspacing='0px'>\n<colgroup>";
if($stbL && $stbL >= 1) echo "<col width='{$stbL}px' /><col width='{$sett78}px' />";
if(!$sett[77]) {$srwdth -= (int)$srpdg;$paddng = "style='width:{$srwdth}px'";echo "<col width='{$srwdth}px' />";} else echo "<col width='100%' />";
if($stbR && $stbR >= 1) echo "<col width='{$sett78}px' /><col width='{$stbR}px' />";
echo "</colgroup>\n<tr>\n";
if($stbL && $stbL >= 1) {
echo "<td id='stbL' class='stbLR' style='width:{$stbL}px' align='center'>\n";
for($sb=1;$st_arr[$sb];$sb++) {
if(substr($st_arr[$sb],0,2) == "L:") include("module/".substr($st_arr[$sb],2).".ph_");
}
echo "\n</td>\n<td class='stbCC'></td>\n";
}

echo "<td id='stbC' {$paddng} align='center'>\n";
$topsection = 1;

} else {

echo "\n</td>\n";

if($stbR && $stbR >= 1) {
echo "<td class='stbCC'></td>\n<td id='stbR' class='stbLR' style='width:{$stbR}px' align='center'>\n";
for($sb=1;$st_arr[$sb];$sb++) {
if(substr($st_arr[$sb],0,2) == "R:") include("module/".substr($st_arr[$sb],2).".ph_");
}
echo "</td>\n";
}

if(($sett[58][0] && !$id) || ($id && (($sett[58][2] && $_GET['no']) || ($sett[58][1] && !$_GET['no'])))) {
if(file_exists("widget/sectbtm_".$section)) {
echo "</tr>\n<tr>\n";
echo "<td colspan='{$srcol}' id='stbBT'>\n";
include("widget/sectbtm_".$section);
echo "</td>";
}}
echo "</tr>\n</table>\n</div>\n";
}
?>