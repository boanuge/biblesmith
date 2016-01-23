<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
$beclwidth = ($sett[12] > 980)? $sett[12]-960:20;
?>
<div id="header" style="width:<?=$srwtpx?>;padding-top:<?=(int)$gheight?>px">
<div id="nav" style="margin-right:<?=$beclwidth?>px">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div>
</div>
<div id="logo" style="width:<?=$srwtpx?>">
	<h1><a href="<?=$index?>">Flourish</a></h1>
	<p>Designed By Free CSS Templates</p>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong> All Rights Reserved. &nbsp;&bull;&nbsp; Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</div>
<?
}
?>