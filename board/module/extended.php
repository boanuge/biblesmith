<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii][6] != $sgp) continue;
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 's' && $sect[$ii][1] != 'x') {
if($section == $ii)  $scn = " class='current_page_item'";
else $scn = '';
if($sect[$ii][1] == 3) $secdiv .= "<li><a href='{$sect[$ii][2]}'>{$sect[$ii][0]}</a></li>";
else if($sect[$ii][1] == 7) $secdiv .= "<li><a href='#none' onclick='{$sect[$ii][2]}'>{$sect[$ii][0]}</a></li>";
else if($sect[$ii][1] == 6) $secdiv .= "<li><a target='_blank' href='{$sect[$ii][2]}'>{$sect[$ii][0]}</a></li>";
else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) $secdiv .= "<li{$scn}><a href='{$index}?id={$sect[$ii][2]}'>{$sect[$ii][0]}</a></li>";
else $secdiv .= "<li{$scn}><a href='{$index}?section={$ii}'>{$sect[$ii][0]}</a></li>";
}
}
?>
<div class='srmgat' style='width:<?=$srwtpx?>'>
<div id="header">
	<div id="logo">
		<h1>Extended</h1>
		<p>By Free CSS Templates</p>
	</div>
	<div id="search">
		<form method='get' action='<?=$index?>'>
			<fieldset>
			<input id="s" type="text" name="find" value="<?=$_GET[find]?>" />
			<input id="x" type="submit" value="Search" />
			</fieldset>
		</form>
	</div>
</div>
<div id="section">
	<ul>
<?=$secdiv?>
	</ul>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class='srmgat' style='width:<?=$srwtpx?>'>
<div id="footer">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>
</div>
</div>
<?
}
?>