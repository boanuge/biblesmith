<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div id="header" class="srmgat" style="width:<?=$srwtpx?>">
	<h1><a href="<?=$index?>">Primitif</a></h1>
	<h2>by free css templates </h2>
</div>
<div id="nav" class="srmgat" style="width:<?=$srwtpx?>">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li>&nbsp; &nbsp; </li><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer" class="srmgat" style="width:<?=$srwtpx?>">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</div>
<div style="height:50px">&nbsp;</div>
<?
}
?>