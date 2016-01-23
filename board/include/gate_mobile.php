<tr><td>
<?
if($grp){
?>
<select class="mbeslt" id="sectgpslt" onchange="location.href='<?=$index?>?group=' + this.options[this.selectedIndex].value">
<?
for($i = 1;$grp[$i];$i++) {
?>
<option value="<?=$i?>"><?=$grp[$i][0]?></option>
<?
}
?>
</select><input type="button" class="mbebut" value=" " onclick="location.href='<?=$index?>?group=' + $('sectgpslt').value;" />
<?
}
if($_GET['group']) {
?>
<ul class="mbeul">
<?
for($ii=1;$sect[$ii];$ii++) {
if(strpos($grp[$sgp][2],'^'.$ii.'^') !== false) {
if($sect[$ii][1] == 3) echo "<li><a href='{$sect[$ii][2]}'>{$sect[$ii][0]}</a></li>";
else if($sect[$ii][1] == 7) echo "<li><a href='javascript:;' onclick='{$sect[$ii][2]}'>{$sect[$ii][0]}</a></li>";
else if($sect[$ii][1] == 6) echo "<li><a target='_blank' href='{$sect[$ii][2]}'>{$sect[$ii][0]}</a></li>";
else if($sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) echo "<li><a href='{$index}?id={$sect[$ii][2]}'>{$sect[$ii][0]}</a></li>";
else echo "<li><a href='{$index}?section={$ii}'>{$sect[$ii][0]}</a></li>";
}}
?>
</ul>
<?
} else {
?>
<select class="mbeslt" id="sectslt" onchange="sectgo(this.options[this.selectedIndex].value);">
<?
for($i = 1;$sect[$i];$i++) {
if($sect[$i][6] == $sgp) {
if($section == $i) $selected = "selected='selected'"; else $selected = '';
if($sect[$i][1] == 3 || $sect[$i][1] == 6 || $sect[$i][1] == 7) $val = $sect[$i][1].",".$sect[$i][2];
else $val = $sect[$i][1].",".$i;
?>
<option value="<?=$val?>" <?=$selected?>><?=$sect[$i][0]?></option>
<?
}}
?>
</select><input type="button" class="mbebut" value=" " onclick="sectgo($('sectslt').value);" />
<div class="menu_title"><div><?=$sect[$section][0]?></div></div>
<?
if($bfsb[$section]) {
?><ul class="mbeul"><?
for($ii=0;$bfsb[$section][$ii];$ii++) {
if(strpos($bfsb[$section][$ii],'>')) {
$bfsd = explode('>',$bfsb[$section][$ii]);
if($bfsd[2]=='nw') $bfsd[1] .= "' target='_blank";
else if($bfsd[2]=='js') $bfsd[1] = "#none' onclick='".$bfsd[1];
echo "<li><a href='{$bfsd[1]}'>{$bfsd[0]}</a></li>";
} else if($bfsb[$section][$ii] != '>') echo "<li><a href='{$index}?id=".encodee($bfsb[$section][$ii])."'>{$bdidnm[$bfsb[$section][$ii]]}</a></li>";
}
?>
</ul>
<?
$limitsrp = 7;
$limitrrp = 7;
include("module/sect_recent.ph_");
include("module/recent_rp.ph_");
?>
</td></tr></table>
<?
} else {
?>
</td></tr></table>
<table cellspacing='<?=$sett[39]?>px' cellpadding='0px' width='<?=$srwdthx?>' style='table-layout:fixed'>
<?
if($inclwt=inclvde($sectgt)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) include($inxv[1]);else echo $inxv[1];}
?>
</table>
<?
}}
$onload .= "if($('sectgpslt')) $('sectgpslt').value = '{$sgp}';\n";
?>
<script type="text/javascript">
function sectgo(sab) {
sab = sab.split(",");
if(sab[0] == 3) location.href = sab[1];
else if(sab[0] == 7) eval(sab[1]);
else if(sab[0] == 6) window.open(sab[1],'_blank');
else location.href = '<?=$index?>?section=' + sab[1];
}
</script>