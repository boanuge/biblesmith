<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
$onload .= "sectbc();\n";
?>
<div id="header">
	<h1 style="width:<?=$srwtpx?>"><a href="<?=$index?>">BoxedType</a></h1>
</div>
<div id="pages">
<div id="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,0,40)?></ul><script type="text/javascript">/*]]>*/</script>
<script type="text/javascript">
function sectbc() {
var sectx = $("section").getElementsByTagName("li");
var sectl = sectx.length;
var sectn = 0;
for(var i=0;i < sectl;i++) {
if(sectx[i].className && sectx[i].className.indexOf("supsec") != -1) {
sectm = (sectn % 5) + 1;
sectx[i].className = sectx[i].className.replace(/active/,"active" + sectm);
sectx[i].className = sectx[i].className + " page" + sectm;
sectn++;
}}}
</script>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. Designed by <a href="http://www.freecsstemplates.org/"><strong>Free CSS Templates</strong></a>
</div>
</div>
<?
}
?>