<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<table id="header" cellspacing="0" cellpadding="0" style="width:100%">
<tr><td class="outer" width="340px">
		<h1><a href="<?=$index?>">indication</a></h1>
		<p><a href="http://www.freecsstemplates.org/">Design by Free CSS Templates</a></p>
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

<div id="footer">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong> &nbsp;&nbsp;&bull;&nbsp;&nbsp;Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a> &nbsp;&nbsp;&bull;&nbsp;&nbsp;Icons by <a href="http://famfamfam.com/">FAMFAMFAM</a></p>
</div>
<?
}
?>