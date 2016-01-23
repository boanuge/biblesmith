<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>

<table id="header"><tr><td id="logo">
	<span class="f38"><a href="<?=$index?>">Experience</a></span><span class="p">by Free Css Templates</span>
</td><td id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li style="width:20px">&nbsp;</li><?=secdiv(0,1,40)?></ul><script type="text/javascript">/*]]>*/</script>
</td></tr></table>
<?
include("module/_lftrgt.php");
?><div id="stC"><div id="stD"><?
} else {
?></div></div><?
include("module/_lftrgt.php");
?>

<div id="footer">
	<p>Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong> All Rights Reserved. &nbsp;&bull;&nbsp; Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</div>
<?
}
?>