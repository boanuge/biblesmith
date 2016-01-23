<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<table id="header" cellspacing="0" cellpadding="0" class="srmgat" style="width:<?=$srwtpx?>">
<tr><td class="logo" width="340px">
		<h1><span><a href="<?=$index?>">Red</a></span><a href="<?=$index?>">Planet</a></h1>
		<h2>By Free CSS Templates</h2>
</td>
<td id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,1,0)?></ul><script type="text/javascript">/*]]>*/</script>
<div><img src="icon/t.gif" alt="" /></div>
</td></tr>
<tr><td colspan="2" style="background: #FFFFFF">
<div id="splash"><a href="<?=$index?>"><img src="module/redplanet/img4.jpg" alt="" width="100%" height="140px" style="border:0" /></a></div>
</td></tr>
</table>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>
<div id="bottom-bg" class="srmgat" style="width:<?=$srwtpx?>"><div class="floatright"></div><div style="clear:both"></div></div>
<center id="footer">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</center>
</div>
<?
}
?>