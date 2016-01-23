<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div style="width:<?=$srwtpx?>;margin:0 auto 0 auto;text-align:left;padding-top:<?=(int)$gheight?>px">
<div style="height:65px">
<img src="ttl.gif" style="cursor:pointer;float:left;margin-top:20px" onclick="rplace('<?=$index?>?section=1')" alt="" />
<form method="get" action="<?=$index?>" style="float:right;padding-top:25px"><input type="text" name="find" class="find_input" value="<?=$_GET["find"]?>" /> <input type="submit" value="FIND" class="find_submit" /></form>
</div>
<div style="clear:both;vertical-align:top;height:90px">
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li>&nbsp; &nbsp; </li><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div>
<div id="belowsect"><div> &nbsp; &nbsp;<?=$bhlct?></div></div>
</div></div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer"><div class="infooter" align="center">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div></div></div>
<?
}
?>