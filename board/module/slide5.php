<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div class="srmgat" style="width:<?=$srwtpx?>;padding-top:<?=(int)$gheight?>px">
<div style="height:65px">
<img src="ttl.gif" style="cursor:pointer;float:left;margin-top:20px" onclick="rplace('<?=$index?>?section=1')" alt="" />
</div>
<div style="clear:both;vertical-align:top;height:73px">
<div id="nav">
<div id="fleft">&nbsp;</div>
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
<form method="get" action="<?=$index?>" id="section_form"><input type="text" name="find" style="width:100px" value="<?=$_GET["find"]?>" /> <input type="submit" value="검색" class="search" style="width:34px" /></form>
</div>
<div style="padding:0 1px 0 1px"><div id="belowsect"><?=$bhlct?></div></div>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer"><div class="left" style="width:50%"></div><div class="right" style="width:50%"></div></div>
<div id="bottom">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div>
</div>
<?
}
?>