<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="top">
<div class="container" style="width:<?=$srwtpx?>"> 
	<div class="header">
		<div class="left">
			<a href="<?=$index?>">Beautiful Day</a>
		</div>		
		<div class="right">
			<h2>Tristique porta</h2>
			<p>Fusce porta pede nec eros. Maecenas ipsum sem, interdum non, aliquam vitae, interdum nec, metus. Maecenas ornare lobortis risus.</p>
		</div>
	</div><div style="clear:both"></div>
	<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
<form method="get" action="<?=$index?>" style="float:right;padding-top:15px;padding-right:15px"><input type="text" name="find" style="width:100px;border:0;border-bottom:1px solid #445985;background-color:transparent" value="<?=$_GET["find"]?>" /> <input type="submit" value="search" class="search" style="width:45px" /></form>
</div><div style="clear:both"></div>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. Design by <a target="_blank" href="http://www.freecsstemplates.org/">Free CSS Templates</a>
</div>
</div>
<?
}
?>