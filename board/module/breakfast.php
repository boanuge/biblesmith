<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<table id="header" cellspacing="0" cellpadding="0">
<tr><td class="outer" width="310px">
	<div class="h1"><a href="<?=$index?>">BreakFast</a></div>
	BY FREE CSS TEMPLATES
</td>
<td class="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,1,40)?></ul><script type="text/javascript">/*]]>*/</script>
<div style="clear:both"></div>
</td></tr>
<tr><td colspan="2">
<div id="banner"><img src="module/breakfast/img3.jpg" alt="" style="width:100%;height:250px" /></div>
</td></tr>
</table>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer">
	<p style="float:left">Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong> All Rights Reserved&nbsp;&nbsp;&bull;&nbsp;&nbsp;Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
	<p style="float:right"><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
</div>
</div>
<?
}
?>