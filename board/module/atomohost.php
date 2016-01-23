<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="header">
	<div id="logo">
		<h1><a href="<?=$index?>">AtomoHost</a></h1>
		<h2><a href="http://www.freecsstemplates.org/">By Free CSS Templates</a></h2>
	</div>
	<div id="topmenu">
		<ul>
			<li><a href="<?=$index?>" id="topmenu1" accesskey="1" title="">Home</a></li>
			<li><a href="#" id="topmenu2" accesskey="2" title="">Contact</a></li>
			<li><a href="#" id="topmenu3" accesskey="3" title="">Sitemap</a></li>
		</ul>
	</div></div>
<div class="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer" align="center">
	<p id="legal">Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
	<p id="links"><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
</div>
</div>
<?
}
?>