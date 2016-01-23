<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
	<div id="logo">
		<h1><a href="<?=$index?>">Baseline</a></h1>
		<h2><a href="#">By Free CSS Templates</a></h2>
	</div>
	<div id="search">
		<form method="get" action="<?=$index?>" style="margin:0">
			<fieldset>
			<input id="searchinput" type="text" name="find" value="" />
			<input id="searchsubmit" type="submit" value="Search" />
			</fieldset>
		</form>
	</div>
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div><div style="clear:both"></div>
</div>
<?
echo "<div id=\"srboard\" style=\"width:{$srwtpx}\"><table id=\"srbtble\" cellpadding=\"0px\" cellspacing=\"0px\">\n<colgroup>";
if($stbL && $stbL >= 1) echo "<col width=\"{$stbL}px\" /><col width=\"{$sett[78]}px\" />";
if(!$sett[77]) {$paddng = "style=\"width:{$srwdth}px\"";echo "<col width=\"{$srwdth}px\" />";} else echo "<col width=\"*\" />";
if($stbR && $stbR >= 1) echo "<col width=\"{$sett[78]}px\" /><col width=\"{$stbR}px\" />";
echo "</colgroup>\n<tr>\n";
if($stbL && $stbL >= 1) {
?>
<td id="stbL" class="stbLR" style="width:<?=$stbL?>px" align="center">
<?
$bss = 1;
for($sb=1;$st_arr[$sb];$sb++) {
if(substr($st_arr[$sb],0,2) == "L:") {
?><div class="menu22<?=$bss%3?>"><?
include("module/".substr($st_arr[$sb],2).".ph_");
?></div><?
$bss++;
}}
?>
</td>
<td class="stbCC"></td>
<?
}
?>
<td id="stbC" <?=$paddng?> align="center">
<?
$topsection = 1;
} else {
?>
</td>
<?
if($stbR && $stbR >= 1) {
?>
<td class="stbCC"></td>
<td id="stbR" class="stbLR" style="width:<?=$stbR?>px" align="center">
<?
$bss = 1;
for($sb=1;$st_arr[$sb];$sb++) {
if(substr($st_arr[$sb],0,2) == "R:") {
?><div class="menu22<?=$bss%3?>"><?
include("module/".substr($st_arr[$sb],2).".ph_");
?></div><?
$bss++;
}}
?>
</td>
<?
}
if(($sett[58][0] && !$id) || ($id && (($sett[58][2] && $_GET["no"]) || ($sett[58][1] && !$_GET["no"])))) {
if(file_exists("widget/sectbtm_".$section)) {
echo "</tr>\n<tr>\n";
echo "<td colspan=\"{$srcol}\" id=\"stbBT\">\n";
include("widget/sectbtm_".$section);
echo "</td>";
}}
echo "</tr>\n</table>\n</div>\n";
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer">
	<p id="legal">Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All Rights Reserved | Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
	<p id="links"><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a> | <a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional"><abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a> | <a href="http://jigsaw.w3.org/css-validator/check/referer" title="This page validates as CSS"><abbr title="Cascading Style Sheets">CSS</abbr></a></p>
</div>
</div>
<?
}
?>