<?
$ida = '';
$ctaa = 0;
if($_GET['ct'] == 'aa') {
if($mbr_level != 9) {scrhref($dxpt."&amp;p=1",0,0);exit;}
else $ctaa = 1;
}
if($_GET['arrange'] && strpos($_GET['arrange'],'addfield_') !== false) $adfn = substr($_GET['arrange'],9);
else $adfn = 0;
if($_GET['arrange'] == '' || ($_GET['ct'] || $_GET['m'] || $_GET['date'])) {
$cook = str_replace(" ","`",substr(md5($id."_".$_GET['ct']."_".$_GET['m']."_".$_GET['date']."_".$_GET['c']."_".$_GET['search']."_".$_GET['keyword']."_".$_GET['arrange']."_"),0,10))."p";
$acook = $cook.$gp;
//if($_COOKIE[$acook]) setcookie($acook);
if($gp > 1) {
$cookp = $cook.($gp - 1);
$cookb = $cook.($gp - 2);
if($_COOKIE[$cookp] && (!$_COOKIE[$cookb] || $_COOKIE[$cookb] != $_COOKIE[$cookp])) {
$bcook = explode("_",$_COOKIE[$cookp]);
if($bcook[0]) {$idd = $id."/^".$bcook[0];$ida = $bcook[0];}
}}}
$dte = 0;
$edt = 0;
if($_GET['date']) {
$dren = strlen($_GET['date']);
if($dren < 6) {$qm = 1;$edt = 31536000;}
else $qm = substr($_GET['date'], 4, 2);
if($dren < 8) $qd = 1;
else if($dren == 8) {$qd = substr($_GET['date'], 6, 2);$edt = 86400;}
$dte = mktime(0, 0, 0, $qm, $qd, substr($_GET['date'], 0, 4));
if(!$edt) $edt = mktime(0, 0, 0, substr($_GET['date'], 4, 2), date("t",$dte), substr($_GET['date'], 0, 4)) + 86400;
else $edt += $dte;
}
function ckcmd($vno,$vlo) {
global $dte, $edt, $ctaa;
$return = 0;
if(!$ctaa && substr($vno,6,2) == 'aa') return $return;
if($vlo) $vlo = substr($vlo,0,10);
if(!$vno || !$_GET['ct'] || $_GET['ct'] == substr($vno,6,2)) {
if(!$vno || !$_GET['m'] || strpos($vno,$_GET['m']."\x1b") == 9) {
if(!$vlo || !$_GET['date'] || ($vlo >= $dte && $vlo < $edt)) {
$return = 1;
}}}
return $return;
}
function fkeyw($word) {
global $keyw;
$return = false;
for($i = 0;$keyw[$i];$i++) {
$return = stripos($word,$keyw[$i]);
if($return !== false && ($_GET['search'] != 'r' || $return > 24)) {} else break;
}
return $return;
}
$limit = $isnt + 1;
if($gp > 1 && !$_COOKIE[$cookp]) $slimit = ($gp-1)*$isnt;
$ii = 0;
if($_GET['c'] || $_GET['search'] == 'r' || $_GET['search'] == 'rip') $wnw = 1;
else if(!$_GET['arrange'] && !$_GET['keyword']) $wnw = 2;
if(($_GET['ct'] || $_GET['m'] || $_GET['date']) && $wnw) {
$flo = 0;
$i = 1;
$h = 1;
	if($_GET['date']) $fl = fopen($dxr.$idd."/list.dat","r");else $fl = 0;
	$fn = fopen($dxr.$idd."/no.dat","r");
	while(!feof($fn)) {
	if($fl) $flo = substr(fgets($fl),0,10);
	$fno = fgets($fn);
	if($fno == "" || $fno == "\n") {
	list($ida,$fn,$fl) = data6($ida,array($fn,$fl),0);
	$h = 1;
	if($ida == 'q') break;
	} else {
	if($wnw == 2 && $bcook && $ida == $bcook[0] && $h < $bcook[1]) {}
	else {
	if(ckcmd($fno,$flo)) {
	$o[$ii] = substr($fno,0,6);
	if($wnw == 2 && $slimit) $slimit--;else $ii++;
	}
	}
	if($wnw == 2 && $ii == $limit) {if($_GET['m']) $sum = "+";@setcookie($acook, $ida."_".$h);break;}
	$i++;
	$h++;
	}}
	if($fl) fclose($fl);
	fclose($fn);
if($bcook) $ida = $bcook[0];
}
$i = 1;
$h = 1;
$m = "";
if($_GET['c'] || $_GET['search'] == 'r' || $_GET['search'] == 'rip') {
$ii = 0;
	$fl = fopen($dxr.$idd."/rlist.dat","r");
	if($_GET['search']) $fb = fopen($dxr.$idd."/rbody.dat","r");else $fb = 0;
	while(!feof($fl)) {
	$uuu = fgets($fl);
	if($ii != $limit && ($uuu == "" || $uuu == "\n")) {
	list($ida,,,,$fl,$fb) = data6($ida,array(0,0,0,$fl,$fb),0);
	$h = 1;
	if($ida == 'q') break;
	} else {
	if($bcook && $ida == $bcook[0] && $h < $bcook[1]) {if($fb) fgets($fb);}
	else {
	if($fb) $yyy = fgets($fb);
	$uuo = substr($uuu,0,6);
	if(!$o || in_array($uuo,$o)) {
	if(!$m || !in_array($uuo,$m)) {
	if(($_GET['c'] && $_GET['c'] == (int)substr($uuu, 24, 5)) || ($_GET['search'] == 'r' && (fkeyw($yyy) > 24 || substr($uuu, 29, -1) == $_GET['keyword'])) || ($_GET['search'] == 'rip' && trim(substr($yyy,0,15)) == $_GET['keyword'])) {
	$m[$ii] = $uuo;
	if($slimit) $slimit--;else $ii++;
	}}
	}}
	if($ii == $limit) {$sum = "+";@setcookie($acook, $ida."_".$h);break;}
	$i++;
	$h++;
	}
	}
	fclose($fl);
	if($fb) fclose($fb);
	unset($o);
} else if($_GET['search'] == 'b' || $adfn) {
	$fb = fopen($dxr.$idd.$bodd,"r");
	$fn = fopen($dxr.$idd."/no.dat","r");
	while(!feof($fb)){
	$fbo = fgets($fb);
	if($ii != $limit && ($fbo == "" || $fbo == "\n")) {
	list($ida,$fn,,$fb) = data6($ida,array($fn,0,$fb),0);
	$h = 1;
	if($ida == 'q') break;
	} else {
	if($bcook && $ida == $bcook[0] && $h < $bcook[1]) {fgets($fn);}
	else {
	$fno = fgets($fn);
	if(ckcmd($fno,$flo)) {
	if($adfn) {
	$fbox = explode("\x1b",$fbo);
	$m[substr($fno,0,6)] = $fbox[$adfn];
	} else if(fkeyw($fbo) !== false) {
	$m[$ii] = $i;
	if($slimit) $slimit--;else $ii++;
	}
	}}
	if($ii == $limit) {$sum = "+";@setcookie($acook, $ida."_".$h);break;}
	$i++;
	$h++;
	}
	}
	fclose($fb);
	fclose($fn);
} else if($_GET['arrange']) {
if($_GET['date']) $ndlt = 1;
if($_GET['arrange'] == 'appr' || $_GET['arrange'] == 'oppo' || $_GET['arrange'] == 'point') $ndx = 2;
else if($_GET['arrange'] == 'view' || $_GET['arrange'] == 'rp') $ndx = 1;
else if($_GET['arrange'] == 'name' || $_GET['arrange'] == 'subject') $ndlt = 2;
else if($_GET['arrange'] == 'date' || $_GET['arrange'] == 'hot' || $_GET['date']) $ndlt = 1;
else {$ndlt = 0;$ndx = 0;}
if($_GET['arrange'] == 'hot') {
	$fr = fopen($dxr.$idd."/rlist.dat","r");
	while(!feof($fr)){
	$fro = fgets($fr);
	if($fro == "" || $fro == "\n") {
	list($ida,,,,$fr) = data6($ida,array(0,0,0,$fr),0);
	if($ida == 'q') break;
	} else {
	$frn = substr($fro,0,6);
	$frv = substr($fro,14,10);
	if(!$m[$frn] || $frv > $m[$frn]) $m[$frn] = $frv;
	}}
	fclose($fr);
if($bcook) $ida = $bcook[0];
}
	$fn = fopen($dxr.$idd."/no.dat","r");
	if($ndlt) $fl = fopen($dxr.$idd."/list.dat","r");
	while(!feof($fn)) {
	if($ndlt == 2) {$uuu = explode("\x1b",fgets($fl));$flo = $uuu[0];}
	else if($ndlt) $flo = substr(fgets($fl),0,10);
	$fno = fgets($fn);
	$i = substr($fno,0,6);
	if($ndx) {
	$uuu = explode("\x1b",$fno);
	if($ndx == 2) $uuu5 = explode('|',$uuu[5]);
	}
	if($fno == "" || $fno == "\n") {
	list($ida,$fn,$fl) = data6($ida,array($fn,$fl),0);
	if($ida == 'q') break;
	} else {
	if(ckcmd($fno,$flo)) {
	if($_GET['arrange'] == 'date' || ($_GET['arrange'] == 'hot' && !$m[$i])) $m[$i] = substr($flo,0,10);
	else if($_GET['arrange'] == 'no') $m[$i] = $i;
	else if($_GET['arrange'] == 'view') $m[$i] = $uuu[1];
	else if($_GET['arrange'] == 'rp') $m[$i] = $uuu[2];
	else if($_GET['arrange'] == 'point') $m[$i] = ($uuu5[1] > 0)? $uuu5[0]/$uuu5[1]:0;
	else if($_GET['arrange'] == 'appr') $m[$i] = $uuu5[0];
	else if($_GET['arrange'] == 'oppo') $m[$i] = $uuu5[1];
	else if($_GET['arrange'] == 'name') $m[$i] = substr($uuu[1], 0, 10);
	else if($_GET['arrange'] == 'subject') 	$m[$i] = substr($uuu[3], 0, 10);
	} else if($_GET['arrange'] == 'hot' && $m[$i]) unset($m[$i]);
	}}
	if($ndlt) fclose($fl);
	fclose($fn);
} else if($_GET['search']) {
	$fn = fopen($dxr.$idd."/no.dat","r");
	$fl = fopen($dxr.$idd."/list.dat","r");
	while(!feof($fl)) {
	$flo = fgets($fl);
	if($ii != $limit && ($flo == "" || $flo == "\n")) {
	list($ida,$fn,$fl) = data6($ida,array($fn,$fl),0);
	$h = 1;
	if($ida == 'q') break;
	} else {
	if($bcook && $ida == $bcook[0] && $h < $bcook[1]) {fgets($fn);}
	else {
	if($_GET['search'] == 'ip') $uuu[0] = $flo;
	else $uuu = explode("\x1b",$flo);
	if(trim($flo)) {
	$fno = fgets($fn);
	if(ckcmd($fno,$flo)) {
	if($_GET['search'] == 's') {
	if(fkeyw($uuu[3]) !== false) $m[$ii] = $i;
	} else if($_GET['search'] == 'n') {
	if($uuu[1] == $_GET['keyword']) $m[$ii] = $i;
	} else if($_GET['search'] == 't') {
	if(stristr(",".$uuu[6].",",",".$_GET['keyword'].",")) $m[$ii] = $i;
	} else if($_GET['search'] == 'ip') {
	if(trim(substr($uuu[0],10,15)) == $_GET['keyword']) $m[$ii] = $i;
	}}}
	if($m[$ii] == $i) if($slimit) $slimit--;else $ii++;
	}
	if($ii == $limit) {
	if($_GET['search'] == 't') {
	$fx = fopen($dxr.$id."/tag.dat", "r");
	while(!feof($fx) && $fxo = trim(fgets($fx))) {
	if(substr($fxo, 0, -8) == $_GET['keyword']) {
	$fcct = (int)substr($fxo,-4);
	break;
	}}
	fclose($fx);
  } else $sum = "+";@setcookie($acook, $ida."_".$h);break;
	}
	$i++;
	$h++;
	}}
	fclose($fl);
	fclose($fn);
}
if($wnw == 2) $m = $o;
if($_GET['c'] || $_GET['search'] == 'r' || $_GET['search'] == 'rip' || $wnw == 2) $wnw = 3;
if($_GET['arrange']) {if($m) $ii = count($m);else $ii = 0;}
$p = 0;
$n = $isnt;
if($ii > 1 && $m) {
if($wnw == 3) rsort($m, SORT_NUMERIC);
else if($_GET['arrange']) {
if($_GET['arrange'] == 'name' || $_GET['arrange'] == 'subject' || $_GET['arrange'] == 'hot'){
if($_GET['desc'] == 'asc') asort($m, SORT_REGULAR);
else arsort($m, SORT_REGULAR);
} else {
if($_GET['desc'] == 'asc') asort($m, SORT_NUMERIC);
else arsort($m, SORT_NUMERIC);
}
} else sort($m);
}
if($m && $_GET['arrange']) {
$i = $isnt;
$j = 1;
$jta = $isnt*($gp - 1);
$jtp = $jta + $isnt;
while(list($key,$val) = each($m)) {
if($j > $jta) {
$o[$i] = $key;
$i--;
if($j >= $jtp) break;
}
$j++;
}
}
if($bcook[0]) {$idd = $id."/^".$bcook[0];$ida = $bcook[0];}
else {$ida = "";$idd = $id;}
if($_GET['arrange']) $fct = $ii;
else $fct = $ii + $isnt*($gp -1);
if($fct > 0) {
$i = 1;
$tps = 0;
if($bcook) $ida = $bcook[0];
$fn = fopen($dxr.$idd."/no.dat","r");
$fl = fopen($dxr.$idd."/list.dat","r");
if($bodd) $fb = fopen($dxr.$idd.$bodd,"r");
while(!feof($fn) && $n > 0 && $tps < $isnt) {
$mms= fgets($fn);
if($mms == "" || $mms == "\n") {
	list($ida,$fn,$fl,$fb) = data6($ida,array($fn,$fl,$fb),0);
	if($ida == 'q') break;
} else if($_GET['arrange']) {
if($nn = array_search(substr($mms,0,6), $o)) {
$tps++;
	$fda[$nn] = $ida;
	$fdl[$nn] = fgets($fl);
	if($bodd) {$fbo = fgets($fb);$fdb[$nn] = strcut($fbo, $len);if($sss[54] && $wdth[7][0]) $faf[$nn] = substr($fbo,strpos($fbo,"\x1b"));}
	$fdn[$nn] = $mms;
	$fdu[substr($mms,0,6)] = 1;
} else {
fgets($fl);
if($bodd) fgets($fb);
}
} else {
if(($wnw == 3 && substr($mms,0,6) == $m[$p]) || ($wnw != 3 && $i == $m[$p])) {
	$fda[$n] = $ida;
	$fdl[$n] = fgets($fl);
	if($bodd) {$fbo = fgets($fb);$fdb[$n] = strcut($fbo, $len);if($sss[54] && $wdth[7][0]) $faf[$n] = substr($fbo,strpos($fbo,"\x1b"));}
	$fdn[$n] = $mms;
	$fdu[substr($mms,0,6)] = 1;
	$n--;
	$p++;
} else {
fgets($fl);
if($bodd) fgets($fb);
}
$i++;
}
}
fclose($fn);
fclose($fl);
if($bodd) fclose($fb);
}
$fno = 'a';
if(!$_GET['c'] && !$_GET['keyword']) {
	if(!$_GET['ct'] && !$_GET['m'] && $_GET['date'] && $dren < 7) {
	$fcct = 0;
	$fx = fopen($dxr.$id."/date.dat", "r");
	while(!feof($fx) && $fxo = trim(fgets($fx))) {
	if($dren == 6 && substr($fxo, 0, 6) == $_GET['date']) {
	$fcct = (int)substr($fxo, 6);
	$fno = '';
	break;
	} else if($dren == 4) {
	if(substr($fxo, 0, 4) == $_GET['date']) $fcct += (int)substr($fxo, 6);
	else if(substr($fxo, 0, 4) < $_GET['date']) break;
	}
	}
	fclose($fx);
	}
	if($_GET['ct'] && !$_GET['m'] && !$_GET['date']) {if($ctgn[$_GET['ct']] >= $fct) $fcct = $ctgn[$_GET['ct']];$fno = '';$sum = '';}
}
?>