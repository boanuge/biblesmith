<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
	<div id="logo">
		<h1><a href="<?=$index?>">The Fences  </a></h1>
		<p><em> template design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></em></p>
	</div>
<div class="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>
<div id="footer" class="srmgat" style="width:<?=$srwtpx?>">
		<p>Copyright (c) 2010 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. All rights reserved. Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
</div>
<?
}
?>