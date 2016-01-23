<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div style="width:<?=$srwtpx?>;margin:0 auto 0 auto;text-align:left;padding-top:<?=(int)$gheight?>px">
<div style="height:65px">
<img src="ttl.gif" style="cursor:pointer;float:left;margin-top:20px" onclick="rplace('<?=$index?>?section=1')" alt="" />
<form method="get" action="<?=$index?>" style="float:right;padding-top:38px"><input type="text" name="find" style="width:100px;border:0;border-bottom:1px solid #445985" value="<?=$_GET["find"]?>" /> <input type="submit" value="search" class="search" style="width:45px" /> &nbsp; </form>
</div>
<div style="clear:both;vertical-align:top;height:73px">
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li>&nbsp; &nbsp; </li><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div>
<div style="width:100%"><div id="belowsect"> &nbsp; &nbsp;<?=$bhlct?></div></div>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer">&nbsp;</div>
<div id="bottom">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div>
</div>
<?
}
?>