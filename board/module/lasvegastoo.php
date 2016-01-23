<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<img src="icon/t.gif" alt="" style="height:<?=(int)$gheight?>px" />
<table cellpadding="0px" cellspacing="0px" class="srmgat" style="width:<?=$srwtpx?>">
<tr>
<?
if($stbL && $stbL >= 1) {
?>
<td style="width:<?=$stbL?>px">
<div class="header">
	<h1><a href="<?=$index?>">Las Vegas Too</a></h1>
	<h2><a href="http://www.freecsstemplates.org/">by Free Css Templates </a></h2>
</div>
</td>
<td style="width:<?=$sett[78]?>px"></td>
<?
}
?>
<td id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li>&nbsp; &nbsp; </li><?=secdiv(0,1,40)?></ul><script type="text/javascript">/*]]>*/</script>
</td>
<?
if($stbR && $stbR >= 1) {
?>
<td style="width:<?=$sett[78]?>px"></td>
<td style="width:<?=$stbR?>px">
<div class="header">
	<h1><a href="<?=$index?>">Las Vegas Too</a></h1>
	<h2><a href="http://www.freecsstemplates.org/">by Free Css Templates </a></h2>
</div>
</td>
<?
}
?>
</tr></table>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer" style="width:<?=$srwtpx?>;margin:0 auto 100px auto">
Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>
</div>
</div>
<?
}
?>
