<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<table id="header" cellspacing="0" cellpadding="0">
<tr><td class="outer" width="310px">
	<span class="h1"><a href="<?=$index?>">CityLights</a></span>
	by Free Css Templates
</td>
<td class="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,1,0)?></ul><script type="text/javascript">/*]]>*/</script>
<div style="clear:both"><img src="icon/t.gif" alt="" /></div>
</td></tr>
<tr><td colspan="2">
<div id="banner"><img src="module/citylights/img03.gif" alt="" style="width:100%;height:250px" /></div>
</td></tr>
</table>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong> All Rights Reserved&nbsp;&nbsp;&bull;&nbsp;&nbsp;Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</div>
<?
}
?>