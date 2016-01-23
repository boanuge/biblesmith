<?
$nok = (false !== strpos($wdth[4], $_POST['no']."^"))? 1:0;
while($time - @filemtime($dl."@@") < 3) {usleep(50000);$time = time();}
$jdl = fopen($dl."@@","w");
$fl = fopen($dl,"r");
while($time - @filemtime($db."@@") < 3) {usleep(50000);$time = time();}
$jdb = fopen($db."@@","w");
$fb = fopen($db,"r");
while($time - @filemtime($dn."@@") < 3) {usleep(50000);$time = time();}
$jdn = fopen($dn."@@","w");
$fn = fopen($dn,"r");
while(!feof($fn)){
$zzz = fgets($fn);
if($no6 == substr($zzz, 0, 6)) {
$xxx = fgets($fl);
$xxex = explode("\x1b",$xxx);
$yyy = fgets($fb);
$xdate = substr($xxex[0], 0, 10);
$zzex = explode("\x1b", trim($zzz));
$mo = substr($zzex[0], 9);
$mct = substr($zzex[0], 6, 2);
if(($mo && $mo == $mbr_no) || (!$mo && $_POST['pass'] && $xxex[2] == $_POST['pass']) || $mbr_level == "9") $psscked = 2;
if($psscked == 2 && (!$timecut || substr($xxex[0],0,10) >= $timecut)) {
$mrcnt = 1;
if($_POST['mode'] == "edit" && $_POST['wcontent']) {
@unlink($saved);
$_POST['subject'] = str_replace("<", "&lt;", stripslashes(trim($_POST['subject'])));
$yyy = stripslashes($_POST['wcontent']);
$rssu = 'a';
$rsctnt = strchr($yyy,'<img');
while($rsctnt && $rssu == 'a') {
$rsctntt = substr($rsctnt, 0, strpos($rsctnt,'>'));
preg_match("`<img [^<>\r\n]+(http://[^\"'<>\r\n\s]+)`i", $rsctntt, $rssu);
if($rssu && strpos($rssu[1],$_SERVER['HTTP_HOST']) !== false && strpos($rssu[1],'icon/emoticon') !== false) $rssu = 'a';
$rsctnt = strchr(substr($rsctnt, 4),'<img');
}
if($rssu[1]) {
$urrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?id=".$eid."&amp;file=";
if(strpos($rssu[1], $urrl) === false) $urrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?id=".$uid."&amp;file=";
if(strpos($rssu[1], $urrl) !== false) {
$thumb = substr($rssu[1], strlen($urrl));
if($thumb) $spic = thumb($thumb);
} else $spic = str_replace("&","&amp;",str_replace("amp;","",$rssu[1]));
}
$yyy = mcontent($yyy);
$yyy = nl2br($yyy);
$yyy = preg_replace("`[\r\n]`", "", $yyy)."\n";
if($_POST['wf_link6']) {if(!$wdth[7][32]) $tag6 = tgxedit($_POST['wf_link6'],1,$xxex[6]);else $tag6 = ",";}
if(substr($_POST['wf_link5'],0,4) != 'http' && substr($_POST['wf_link5'],0,6) != 'magnet') $_POST['wf_link5'] = '';
$xxx = substr($xxex[0], 0, 25)."\x1b".$xxex[1]."\x1b".$xxex[2]."\x1b".$_POST['subject']."\x1b".$spic."\x1b".$_POST['wf_link5']."\x1b".$tag6."\x1b\n";
if($_POST['tb_url']) {
$tbis = sendtb($_POST['tb_url'], $_POST['tb_link'], $_POST['subject'], $yyy, $_POST['no']);
if($tbis) $zzex[3] = $zzex[3] + 1;
}
if(!$_POST['ct']) $_POST['ct'] = "00";
if(!$_POST['perm_vw']) $_POST['perm_vw'] = "0";
if((int)$zzex[2] < 1) $zzex[2] = $_POST['perm_rp'];
if((int)$zzex[4] < 1) $zzex[4] = $_POST['perm_tb'];
if($_POST['perm_rpmail'] == 'Email Address') $_POST['perm_rpmail'] = '0';
if((int)$zzex[6][0] > 0) $_POST['perm_re'] = $zzex[6][0];
$zzz = substr($zzex[0], 0, 6).str_pad($_POST['ct'], 2, 0, STR_PAD_LEFT).$_POST['perm_vw'].$mo."\x1b".$zzex[1]."\x1b".$zzex[2]."\x1b".$zzex[3]."\x1b".$zzex[4]."\x1b".$zzex[5]."\x1b".str_pad($_POST['perm_re'],1,0).$_POST['perm_rpmail']."\x1b\n";
if($sss[26] != 'd' && !$sss[64] && $mo) mmd($mo, 0, "2", $id10.str_pad($_POST['no'],6, 0, STR_PAD_LEFT).$xdate, $_POST['subject']);
if($_POST['notice'] && ! $nok) $noticx = substr($zzz, 0, 6).$xxx;
		} else if($_POST['edit'] == "delete") {
$crp = $zzex[2];
if($crp) {
if($mo) notiff($mo,0,$id10.$no6,0);
if($crp > 1) notifxz($no6,$crp);
}
if($sss[66]) $zzz = substr($zzz,0,6).'aa'.substr($zzz,8);
else {
if($xxex[6]) tgxedit($xxex[6],2,0);
$xxx = "";
$yyy = "";
$zzz = "";
}
if($sss[26] != 'd' && $mo) mmd($mo, 0, "0", $id10.str_pad($_POST['no'],6, 0, STR_PAD_LEFT).$xdate, "");
		}
	} else {
	$mrcnt = 0;
	if($psscked != 2) $psscked = "비밀번호가 틀립니다. (".wpass(2)."/10)";
	else $psscked = "시간초과로 변경금지되었습니다.";
	scrhref($dxpt."&amp;no=".$_POST['no']."&amp;p=".$_POST['p'],0,$psscked);
	break;
	}
fputs($jdl,$xxx);
fputs($jdb,$yyy);
	} else {
fputs($jdl,fgets($fl));
fputs($jdb,fgets($fb));
	}
fputs($jdn,$zzz);
}
fclose($fl);
fclose($fb);
fclose($fn);
fclose($jdl);
fclose($jdb);
fclose($jdn);
if($mrcnt == 1) {
copy($dl."@@",$dl);
copy($db."@@",$db);
copy($dn."@@",$dn);
rename($dn."@@",$dn."_bk");
} else unlink($dn."@@");
unlink($dl."@@");
unlink($db."@@");
if($mrcnt == 1) {
if($_POST['notice'] != $nok || ($nok && $_POST['edit'] == "delete")) {
$fns = fopen($dxr.$id."/notice.dat","a+");
if($_POST['notice'] && !$nok && $_POST['mode'] == "edit") {
$wdth[4] = $wdth[4].$_POST['no']."^";
fputs($fns, $noticx);
fclose($fns);
} else if((!$_POST['notice'] && $nok) || $_POST['edit'] == "delete") {
$nss8 = explode($_POST['no']."^", $wdth[4]);
$wdth[4] = $nss8[0].$nss8[1];
$jnotice = fopen($dxr.$id."/notice.dat@@","w");
while(!feof($fns)) {
$fnso = fgets($fns);
if(substr($fnso, 0, 6) != $no6) fputs($jnotice, $fnso);
}
fclose($fns);
fclose($jnotice);
copy($dxr.$id."/notice.dat@@",$dxr.$id."/notice.dat");
unlink($dxr.$id."/notice.dat@@");
}
}
if($_POST['edit'] == "delete") {
$fct--;
if($lst == $_POST['no'] && !$sss[66]) $lst--;
}
$ncct = substr($wdth[0],0,10).str_pad($lst,6, 0, STR_PAD_LEFT).str_pad($fct,6, 0, STR_PAD_LEFT).substr($wdth[0], 22)."\x1b".$wdth[1]."\x1b".$wdth[2]."\x1b".$wdth[3]."\x1b".$wdth[4]."\x1b".$wdth[5]."\x1b".$wdth[6]."\x1b".$wdth[7]."\x1b".$wdth[8]."\x1b".$wdth[9]."\x1b\n";
nds($ncct);
$ncct = "\x1b";
if($_POST['edit'] == "delete" || $_POST['ct'] != $mct) {
$ctgn[str_pad($mct, 2, 0, STR_PAD_LEFT)]--;
if($_POST['edit'] != "delete" && $_POST['ct'] != $mct) $ctgn[str_pad($_POST['ct'], 2, 0, STR_PAD_LEFT)]++;
}
if($_POST['cts']) {
for($s = 0;isset($_POST['cts'][$s]);$s++) {
$mii = str_pad($s + 1, 2, 0, STR_PAD_LEFT);
if($_POST['cts'][$s]) {$ncct .= $_POST['cts'][$s].str_pad($ctgn[$mii],6,0,STR_PAD_LEFT)."\x1b";}
}
} else if($ctg) {foreach($ctg as $mii => $category) {$ncct .= $category.str_pad($ctgn[$mii],6,0,STR_PAD_LEFT)."\x1b";}}
$ncct .= "\n";
ndc($ncct);
if($_POST['edit'] == "delete") {
if($crp > 0) {
newrp(str_pad($_POST['no'],6, 0, STR_PAD_LEFT).":");
if(!$sss[66]) {
while($time - @filemtime($rl."@@") < 3) {usleep(50000);$time = time();}
$jrl = fopen($rl."@@","w");
while($time - @filemtime($rb."@@") < 3) {usleep(50000);$time = time();}
$jrb = fopen($rb."@@","w");
}
$frl = fopen($rl,"r");
$frb = fopen($rb,"r");
while(!feof($frl)){
	$frlo = fgets($frl);
	if($crp == 0) {
	if(!$sss[66]) {
	fputs($jrl, $frlo);
	fputs($jrb, fgets($frb));
	}} else if(substr($frlo, 0, 6) != $no6) {
	if(!$sss[66]) {
	fputs($jrl, $frlo);
	fputs($jrb, fgets($frb));
	}} else {
	$crp--;
	fgets($frb);
	if($mno = (int)substr($frlo, 24, 5)) mmd($mno, 1, "0", $id10.$_POST['no'].substr($frlo, 14, 10), "");
	}
}
fclose($frl);
fclose($frb);
if(!$sss[66]) {
fclose($jrl);
fclose($jrb);
copy($rl."@@",$rl);
unlink($rl."@@");
copy($rb."@@",$rb);
unlink($rb."@@");
}}
if(!$sss[66]) {
while($time - @filemtime($du."@@") < 3) {usleep(50000);$time = time();}
$jdu = fopen($du."@@","w");
$fu = fopen($du,"r");
while(!feof($fu)){
	$fuo = fgets($fu);
	if(substr($fuo, 0, 6) == $no6) {
	$funo = str_replace("%","",urlencode(substr($fuo, 6, -13)));
	@unlink($ffldr.$funo);
	$ext = strtolower(substr($funo,-3));
	if($ext=='jpg' || $ext=='gif' || $ext=='png') @unlink($ffldr.substr($funo,0,-4)."_s.jpg");
	$fuo = "";
	}
	fputs($jdu, $fuo);
}
fclose($fu);
fclose($jdu);
copy($du."@@",$du);
unlink($du."@@");
}
if($xn) {
$xn = substr($xn,2);
while($time - @filemtime($dxr.$id."/bno.dat@@") < 3) {usleep(50000);$time = time();}
$jbn = fopen($dxr.$id."/bno.dat@@","w");
$bn = fopen($dxr.$id."/bno.dat","r");
for($aa=1;$bno = fgets($bn);$aa++) {
if($aa == $xn) {
$n6 = substr($bno,6,6) -1;
$n12 = substr($bno,12,6) -1;
$bno = substr($bno,0,6).str_pad($n6,6,0,STR_PAD_LEFT).str_pad($n12,6,0,STR_PAD_LEFT).substr($bno,18);
} else if($aa > $xn) {
$n6 = substr($bno,6,6) -1;
$bno = substr($bno,0,6).str_pad($n6,6,0,STR_PAD_LEFT).substr($bno,12);
}
fputs($jbn,$bno);
}
fclose($bn);
fclose($jbn);
copy($dxr.$id."/bno.dat@@",$dxr.$id."/bno.dat");
unlink($dxr.$id."/bno.dat@@");
}
}
}
if($_POST['mode'] == "edit") {
if($sss[26] != 'd') scrhref($dxpt."&amp;no=".$_POST['no']."&amp;p=".$_POST['p'],0,0);
else scrhref($dxpt."&amp;rp=".$_POST['no']."&amp;p=".$_POST['p'],0,0);
} else {
xdate($xdate, 0, '');
scrhref($dxpt."&amp;p=1",0,0);
}
?>