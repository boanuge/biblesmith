<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<table id="header" cellspacing="0" cellpadding="0">
<tr><td class="logo">
		<h1><a href="<?=$index?>">Newfangled</a></h1>
		<h2><a href="http://www.freecsstemplates.org/">By Free CSS Templates</a></h2>
</td>
<td class="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,1,0)?></ul><script type="text/javascript">/*]]>*/</script>
<div><img src="icon/t.gif" alt="" /></div>
</td></tr></table>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer" class="srmgat" style="width:<?=$srwtpx?>">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
	<p id="links"><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
</div>
<?
}
?>