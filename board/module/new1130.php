<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div style="height:100px;background-color:#F5F5F3;text-align:center"><h2 style="margin-top:30px">(new1130.php 31줄) <?=$sett[0]?></h2></div>
<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
</div><div style="clear:both"></div>
<div style="height:1px;background-color:#FF4040"><img src="icon/t.gif" alt="" /></div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class="srmgat" style="width:<?=$srwtpx?>">
<div id="footer">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div>
</div>
<?
}
?>