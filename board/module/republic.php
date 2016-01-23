<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
	<div id="logo">
		<h1><a href="<?=$index?>">republic</a></h1>
		<h2>design by Free CSS Templates</h2>
	</div>
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
<form method="get" action="<?=$index?>" style="float:right;padding-top:18px"><input type="text" name="find" style="width:120px;border:0;padding:5px;height:10px;background-color:#E2E2E2" value="<?=$_GET["find"]?>" /> <input type="submit" value="GO" class="search" style="width:45px" /></form>
</div><div style="clear:both"></div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. Design by <A target="_blank" href="http://www.freecsstemplates.org/">Free CSS Templates</A>
</div>
<?
}
?>