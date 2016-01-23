<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div style="width:<?=$srwtpx?>;margin:0 auto 0 auto" id="bdiv">
<div style="background-color:#000">
<img src="ttl.gif" style="cursor:pointer;margin:40px 0 10px 5px" onclick="rplace('<?=$index?>?section=1')" alt="" />
</div>
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li>&nbsp; &nbsp; </li><?=substr(secdiv(3,0,0),0,-55)?></ul><script type="text/javascript">/*]]>*/</script>
<form method="get" action="<?=$index?>"><input type="text" name="find" class="text" style="width:100px" value="<?=$_GET["find"]?>" /> <input type="submit" value="search" class="search" style="width:45px" /> &nbsp; </form>
<div style="clear:both"></div></div></div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="bottom" class="srmgat" style="width:<?=$srwtpx?>">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div>
<?
}
?>