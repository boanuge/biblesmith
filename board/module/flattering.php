<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div style="width:<?=$srwtpx?>;margin:0 auto 0 auto;padding-top:<?=(int)$gheight+10?>px;font-size:2.5em;color:#FFFFFF;font-family:batang;font-weight:bold"><?=$sett[0]?></div>
<div id="nav" style="width:<?=$srwtpx?>;margin:20px auto 0 auto">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><li>&nbsp; &nbsp; </li><?=secdiv(0,0,0)?></ul><script type="text/javascript">/*]]>*/</script>
<form method="get" action="<?=$index?>" id="search"><input type="text" name="find" id="search_text" value="<?=$_GET["find"]?>" /> <input type="submit" value="Search" id="search-submit" /> &nbsp; </form>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
$floatright = ($srwdth > 800)? $srwdth-700:100;
?>
<div id="bottom-bg" style="width:<?=$srwtpx?>;margin:0 auto 0 auto"><div class="floatright"></div><div style="clear:both"></div></div>
<div id="footer" style="width:<?=$srwtpx?>;margin:0 auto 0 auto">
Copyright 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>
</div>
<?
}
?>