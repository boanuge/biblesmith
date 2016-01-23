<? if(count($grp) > 1) {?>
<div id='sectiongroup'>
<div class='sctgrp' style='width:<?=$srwtpx?>'><div>
<? for($i = 1;$grp[$i];$i++) {?>
<a href='<?=$index?>?group=<?=$i?>'><?=$grp[$i][0]?></a><span> &nbsp; | &nbsp; </span>
<?}?>
<a href='<?=$index?>?member_login=<?=urlencode($_SERVER['REQUEST_URI'])?>'><? if($mbr_level) echo "로그아웃";else echo "로그인";?></a></div></div></div>
<?
$gheight = 24;
}
?>