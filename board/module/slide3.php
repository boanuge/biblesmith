<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div id="DB32">&nbsp;</div>
<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li>&nbsp; &nbsp; </li><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
<form method="get" action="<?=$index?>" style="float:right"><input type="text" name="find" style="width:100px;border:0;border-bottom:1px solid #445985;background-color:transparent" value="<?=$_GET["find"]?>" /> <input type="submit" value="search" class="search" style="width:45px" /></form>
</div></div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. Design by <a target="_blank" href="http://www.freecsstemplates.org/">Free CSS Templates</a>
</div>
<?
}
?>