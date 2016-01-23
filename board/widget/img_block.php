<?
$mid = "img3"; // 게시판 아이디
$rlmt = 7; // 이미지갯수 -홀수로-
$bwidth = 462; // 영역넓이
$bheight = 182; // 영역높이

$bcnt = ($rlmt -1) / 2;
$cwt = (($bwidth -2) / ($bcnt + 2)) - 8;
$cht = (($bheight -2) / 2) - 8;
$mss = $fsbs[$mid];
$ii = 0;
$totb = '';
$ffg = '';
$ida = '';
$fl = fopen($dxr.$mid."/list.dat","r");
$fn = fopen($dxr.$mid."/no.dat","r");
while(!feof($fn)){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = explode("\x1b", fgets($fl));
if(substr($zzz,6,2) == 'aa') continue;
if($flo[4] == '') continue;
if($mss[13] === 'a' || (int)$zzz[8] > $mbr_level || $mss[13] > $mbr_level) continue;
$ff[$ii] = array((int)substr($zzz,0,6),$flo[4]);
$zzz = explode("\x1b",$zzz);
$zzz = (int)($zzz[2] + $zzz[3] + $zzz[4]);
$totb .= "Array('{$flo[3]}','{$flo[1]}','{$zzz}'),";
$ii++;
} else {
$mwth = explode("\x1b",$mss);
list($ida,$fn,$fl) = data6($ida,array($fn,$fl),array($mid,$mwth[6]));
if($ida == 'q') break;
}
if($ii >= $rlmt) break;
}
fclose($fl);
fclose($fn);
if($rlmt > $ii) $rlmt = $ii;
if(substr($ff[0][1],0,7) != 'http://') {
$ffi = urldecode(substr($ff[0][1],0,-6));
$fu = fopen($dxr.$mid."/upload.dat","r");
while(!feof($fu)) {
$fuo = trim(fgets($fu));
$file = substr($fuo,6,-12);
if(strpos($file,$ffi) !== false && substr($file,0,-4) == $ffi) {
$ext = strtolower(substr($file,-4));
if($ext == '.jpg' || $ext == '.gif' || $ext == '.png') {
$ffg = "exe.php?id={$mid}&amp;file=".urlencode($file);
break;
}}}
fclose($fu);
if(!$ffg) $ffg = "exe.php?id={$mid}&amp;file=".$ff[0][1];
} else $ffg = $ff[0][1];
?>
<div class='img_block' style='width:<?=$bwidth -2?>px;height:<?=$bheight -2?>px'>
<a href='<?=$index?>?id=<?=$mid?>&amp;no=<?=$ff[0][0]?>' onmouseover="tot_b(0)" onmouseout="preview()"><img src='<?=$ffg?>' style='width:<?=$cwt*2 + 8?>px;height:<?=($cht*2 + 8)?>px' /></a>
<?
for($i = 1; $i < $rlmt; $i++) {
if(substr($ff[$i][1],0,7) != 'http://') $ff[$i][1] = "exe.php?id={$mid}&amp;file={$ff[$i][1]}";
?>
<a href='<?=$index?>?id=<?=$mid?>&amp;no=<?=$ff[$i][0]?>' onmouseover="tot_b(<?=$i?>)" onmouseout="preview()"><img src='<?=$ff[$i][1]?>' style='width:<?=$cwt?>px;height:<?=$cht?>px' /></a>
<?
}
?>
</div>
<script type='text/javascript'>
//<![CDATA[
function tot_b(v) {
var totb = Array(<?=substr($totb,0,-1)?>);
$("pview").style.width = '200px';
preview("<div class='prsjt'>" + totb[v][0] + "</div><span class='n8'>by " + totb[v][1] + "</span> <span class='r7'>[" + totb[v][2] + "]</span>","xx");
}
//]]>
</script>
