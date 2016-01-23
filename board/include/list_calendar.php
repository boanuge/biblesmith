<?
if($id && $sss[22] !== 'a' && $sss[22] <= $mbr_level) {
$dd = array();
$dtype = ($sss[26] == 'd')?'d':'b';
$month = substr($_GET['date'], 4, 2);
$year = substr($_GET['date'], 0, 4);
$pxt = mktime(0, 0, 0, $month, 1, $year);
$med = date("t", $pxt);
$fem = date("w", $pxt);
for($i = $isnt; $i > 0; $i--) {
if(trim($fdn[$i])){
$zzz = explode("\x1b", $fdn[$i]);
$flo = explode("\x1b", $fdl[$i]);
$dd[(int)date("d",substr($flo[0],0,10))] .= "<li><a".(int)substr($zzz[0],0,6)."'>".str_replace("&","&amp;",$flo[3])."</a> <span class='f8'>by ".$flo[1]."</span> <span class='r7'>[".(int)($zzz[2] + $zzz[4] + $zzz[3])."]</span></li>";
}}
?>
<div id='calendar' style='width:<?=$srwdthx?>'>
<div class='caption'><div class='sum'>sum : <?=$sum?></div><select onchange='lochref("p",this.options[this.selectedIndex].value)'><?=$months?></select><div class='listtype'>
<? if($sss[29]) {?><img src='icon/rss.gif' alt='rss' class='abcg' onclick="nwopn('<?=$exe?>?rss=<?=$eid?>')" />
<?} if(!$sss[53]) {?>
<img src='icon/al.gif' alt='목록형' title='목록형' class='abcg' onclick="locato('type','a')" />
<img src='icon/bl.gif' alt='본문형' title='본문형' class='abcg' onclick="locato('type','b')" />
<img src='icon/cl.gif' alt='요약형' title='요약형' class='abcg' onclick="locato('type','c')" />
<img src='icon/gl.gif' alt='갤러리형' title='갤러리형' class='abcg' onclick="locato('type','g')" />
<img src='icon/kl.gif' alt='달력형' title='달력형' class='abcg' onclick="locato('type','k')" />
<?}?></div></div>
<table width='100%' cellspacing='1px' cellpadding='0'>
<tr><th><font color='#FF0000'>일</font></th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th>토</th></tr>
<tr class='thbtwn'><td colspan='7'></td></tr><tr>
<?
if($year == date("Y") && $month == date("m")) $tday = date("d");
for($i = 0; $i < $fem; $i++) echo "<td> </td>";
for($stt = 1; $stt <= $med; $stt++) {
$sst = ($stt + $fem) % 7;
if($sst == 1) $stc = "<font color='#FF0000'>{$stt}</font>";
else $stc = $stt;
if($tday == $stt) $stc = "<b><u>{$stc}</u></b>";
if($dd[$stt]) {echo "<td onmouseover='opencal(this)'><div class='day'>".$stc."</div><div class='cnt'>".substr_count($dd[$stt],'<li>')." posts</div><ul>";
if($aview == 6) echo preg_replace("/<a([^']+)'/","<img src='icon/sy.gif' alt='' /><a href='#none' onclick='aview(\"".$id."\",\"$1\",\"\")'",$dd[$stt]);
else echo str_replace("<a","<img src='icon/sy.gif' alt='' /><a href='".$index."?id=".$id.$rt."&amp;p=".$calp."&amp;no=",$dd[$stt]);
echo "</ul></td>";
} else echo "<td onmouseover='opencal()'><div class='day'>".$stc."</div></td>";
if($sst == 0 && $stt != $med) echo "</tr><tr>";
}
if($sst > 0) for($i = $sst; $i < 7; $i++) echo "<td onmouseover='opencal()'></td>";
?>

</tr>
</table>
<div class='buttcell' style='float:left'><a class='butt4' href='<?=$index?>?id=<?=$eid?>&amp;p=1' style='margin-left:0'><span>목록</span></a><a class='butt4' href='javascript:frite()'><span>새글</span></a></div>
<form method='get' name='sform' action='?' style='float:right'><input type='hidden' name='id' value='<?=$id?>' /><input type='hidden' name='type' value='a' /><input type='hidden' name='ct' value='<?=$_GET['ct']?>' /><input type='hidden' name='p' value='1' />
<select name='search' onchange="searchc(this.options[this.selectedIndex].value)"><option value="s">제목</option><option value="b">본문</option><option value="t">태그</option><option value="n">이름</option><option value="r">덧글</option><option value="ip">ip(본문)</option><option value="rip">ip(덧글)</option></select>&nbsp;
<input type='text' name='keyword' style='border:0;width:100px;height:19px;border-width:0 0 1px 0px;border-style:solid;' value='' />
<input type='submit' id='submit' value='검색' class='srbt' /></form><div class='fcler'></div>
</div>
<?
}
?>