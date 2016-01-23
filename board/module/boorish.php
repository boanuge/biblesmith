<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<table id="header" cellspacing="0" cellpadding="0">
<tr><td class="outer" width="280px">
	<span class="h1"><a href="<?=$index?>">Boorish</a></span><br />
	By Free CSS Templates
</td>
<td class="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,1,40)?></ul><script type="text/javascript">/*]]>*/</script>
<div><img src="icon/t.gif" alt="" /></div>
</td></tr>
</table>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="btbg" style="width:<?=$srwtpx?>"></div>
<div id="footer" style="width:<?=$srwtpx?>">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong> All Rights Reserved. | Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</div>
<?
}
?>