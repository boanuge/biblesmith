<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<table id="header" cellspacing="0" cellpadding="0" class="srmgat" style="width:<?=$srwtpx?>">
<tr><td class="outer" width="340px">
	<span class="h1"><a href="<?=$index?>">Isometric</a></span>
	by Free Css Templates
</td>
<td class="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,1,40)?></ul><script type="text/javascript">/*]]>*/</script>
<div><img src="icon/t.gif" alt="" /></div>
</td></tr>
</table>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</div>
<?
}
?>