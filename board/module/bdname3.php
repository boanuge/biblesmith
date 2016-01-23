<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii][6] != $sgp) continue;
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 's' && $sect[$ii][1] != 'x') {
if($section == $ii)  $scn = " class='supsec'";
else $scn = '';
if($sect[$ii][1] == 3) $secdiv .= "<a href='{$sect[$ii][2]}'>{$sect[$ii][0]}</a><img src='icon/t.gif' class='sec_between' alt='' />";
else if($sect[$ii][1] == 7) $secdiv .= "<a href='#none' onclick='{$sect[$ii][2]}'>{$sect[$ii][0]}</a><img src='icon/t.gif' class='sec_between' alt='' />";
else if($sect[$ii][1] == 6) $secdiv .= "<a target='_blank' href='{$sect[$ii][2]}'>{$sect[$ii][0]}</a><img src='icon/t.gif' class='sec_between' alt='' />";
else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) $secdiv .= "<a{$scn} href='{$index}?id={$sect[$ii][2]}'>{$sect[$ii][0]}</a><img src='icon/t.gif' class='sec_between' alt='' />";
else $secdiv .= "<a{$scn} href='{$index}?section={$ii}'>{$sect[$ii][0]}</a><img src='icon/t.gif' class='sec_between' alt='' />";
}
}
?>
<div style='width:<?=$srwtpx?>;padding-top:<?=(int)$gheight/2?>px;margin:0 auto 0 auto' id='bdiv'>
<div style='height:70px;background-color:#FFFFFF'>
<img src='ttl.gif' style='cursor:pointer;margin-top:20px' onclick="rplace('<?=$index?>?section=1')" alt='' />
</div>
<div style='clear:both;height:50px'>
<div id="nav">
<div id="section">
<?=substr($secdiv,0,-51);?><form method='get' action='<?=$index?>'><input type='text' name='find' style='width:100px' value='<?=$_GET['find']?>' /> <input type='submit' value='search' class='search' style='width:45px' /> &nbsp; </form>
</div>
</div>
</div>
</div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div class='srmgat' style='width:<?=$srwtpx?>'>
<div id="footer">&nbsp;</div>
<div id="bottom">
Copyright 2009 <? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?>. All rights reserved.
</div>
</div>
<?
}
?>