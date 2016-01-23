<?
function bdopn($mid,$rlmt,$wtdh) {
global $fsbs, $mbr_level, $index, $sett, $dxr;
$mss = $fsbs[$mid];
$rft = (int)substr($mss, 6, 6);
$mwth = explode("\x1b",$mss);
$ida = '';
$fl = fopen($dxr.$mid."/list.dat","r");
$fn = fopen($dxr.$mid."/no.dat","r");
if($mss[16] == 'd') $fb = fopen($dxr.$mid."/body.dat","r");else $fb = 0;
$ii = 0;
while($ii < $rlmt && $ii < $rft){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = explode("\x1b", fgets($fl));
if(substr($zzz,6,2) == 'aa') continue;
$flo[5] = str_replace("&","&amp;",$flo[5]);
if($fb) $flo[3] = strcut(fgets($fb), 128);
$zzz = explode("\x1b", $zzz);
$no = (int)substr($zzz[0], 0, 6);
$mn = substr($zzz[0], 9);
$ntime = date("H")*3600 + date("i")*60 + date("s");
$datt = substr($flo[0], 0, 10);
if($datt > 0) $datte = ($datt > $time - $ntime)? date("H:i",$datt):date("m-d",$datt);else $datte = '';
$wdtt = 0;
$url = '';

if($zzz[2] > 0 || $zzz[3] > 0 ||$zzz[4] > 0) {
$nrp = (int)($zzz[2] + $zzz[4] + $zzz[3]);
$rurl = "<div class='lnkrp'><a target='_blank' href='{$index}?id={$mid}&amp;comment={$no}'><img src='icon/rp.gif' alt='' border='0' /><span class='r8'>{$nrp}</span></a></div>";
$wdtt += $sett[28] + strlen($zzz[2])*6;
} else $rurl = '';
if($mwth[7][4] && $datt >= $sett[62]) {$rurl .= "<img src='icon/nw.gif' class='nL4' alt='' />";$wdtt += 16;}
if($mss[13] === 'a' || (int)$zzz[0][8] > $mbr_level || $mss[13] > $mbr_level) {
if($fb) $flo[3] = '[비밀글]';
	if($zzz[0][8] > $mbr_level) $flo[3] = "<img src='icon/lock.gif' alt='' border='0' /> ".$flo[3];
	else if($flo[5]) {
$url = "<a target='_blank' href='{$flo[5]}' class='lnk'>".$flo[3];
	}
}
if(!$url) $url = "<a href='{$index}?id={$mid}&amp;no={$no}' class='lnk'>".$flo[3];
?>
<div class='nobr' style='float:left;max-width:<?=($wtdh - $wdtt -10)?>px'><span class='f7 d7d' style=''><img src='icon/sg.gif' alt='' /> <?=$datte?></span>&nbsp;
<?=$url?></a></div><?=$rurl?>
<div class='fcler'></div>
<?
} else {
list($ida,$fn,$fl,$fb) = data6($ida,array($fn,$fl,$fb),array($mid,$mwth[6]));
if($ida == 'q') break;
$ii--;
}
$ii++;
}
fclose($fl);
fclose($fn);
if($fb) fclose($fb);
}
?>