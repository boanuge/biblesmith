<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<fieldset style="width:<?=$srwtpx?>;padding-top:<?=(int)$gheight?>px" id="bdiv">
<div class="ttl">
<img src="ttl.gif" style="cursor:pointer;float:left;margin-top:48px" onclick="rplace('<?=$index?>?section=1')" alt="" />
<form class="srch" method="get" action="<?=$index?>"><input type="text" name="find" style="width:100px;border:0;" value="<?=$_GET["find"]?>" /> <input type="submit" value="search" class="search" style="width:45px" /> &nbsp; </form>
</div>
<div style="clear:both;vertical-align:top;height:63px">
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li>&nbsp; &nbsp; </li><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div>
<div id="belowsect"> &nbsp; &nbsp;<?=$bhlct?><img src="slide_2.png" style="display:none" alt="" /></div>
</div>
</fieldset>
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