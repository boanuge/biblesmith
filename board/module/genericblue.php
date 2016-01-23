<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<table id="header" cellspacing="0" cellpadding="0" style="padding-top:<?=$gheight?>px">
<tr><td id="outer" style="width:280px">
	<span><a href="<?=$index?>">GenericBlue</a></span><br />
	by Free CSS Templates
</td>
<td>
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li style="width:30px">&nbsp;</li><?=secdiv(0,1,40)?></ul><script type="text/javascript">/*]]>*/</script>
<div><img src="icon/t.gif" alt="" /></div>
</td></tr>
</table>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer" style="width:<?=$srwtpx?>;margin:0 auto 0 auto">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</div>
<?
}
?>