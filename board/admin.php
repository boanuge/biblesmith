<?
ob_start();
session_start();
include("include/common.php");
$tp = $dxr.$_SERVER['REMOTE_ADDR'];
$cook = "at".str_pad($uzip,12,"x");
if(!$mbr_level) {
if($_COOKIE[$cook]) {
$fat = fopen($dxr."_member_/autologin","r");
while(!feof($fat)) {
$xxx = fgets($fat);
if(substr($xxx,29,32) == $_COOKIE[$cook]) {
$xxx = explode("\x1b",substr($xxx,61,-1));
$_POST['username_3'] = $xxx[0];
$_POST['password_3'] = $xxx[1];
$_POST['autologin'] = 1;
$_SERVER['HTTP_REFERER'] = $_SERVER['HTTP_HOST'];
if(!$_POST['from']) $_POST['from'] = (false !== strpos($_SERVER['QUERY_STRING'],".") || false !== strpos($_SERVER['QUERY_STRING'],"/") || false !== strpos($_SERVER['QUERY_STRING'],"?"))? $_SERVER['QUERY_STRING']:$_SERVER['REQUEST_URI'];
$autologged = 1;
break;
}}
fclose($fat);
}}
function ssckdxl() {
$ustt = md5($_COOKIE['mck']."\x1b".$_SESSION['mk']);
unset($_SESSION['m_nick']);
unset($_SESSION[$_SESSION[$_COOKIE[$ustt]]]);
unset($_SESSION[$_COOKIE[$ustt]]);
unset($_SESSION['mk']);
foreach($_COOKIE as $key => $value) {if($key[0] != 'v' && $key != 'PHPSESSID') setcookie($key,'');}
}
if($mbr_level) {
if($_POST['logout']) {
if(file_exists($dxr."_member_/autologin")) {
while($time - @filemtime($dxr."_member_/autologin@@") < 3) {usleep(50000);$time = time();}
$jdat = fopen($dxr."_member_/autologin@@","w");
$ltime = $time - 864000;
$fat = fopen($dxr."_member_/autologin","r");
while(!feof($fat)) {
$xxx = fgets($fat);
if((int)substr($xxx,14,5) == $mbr_no || substr($xxx,19,10) < $ltime) $xxx = '';
fputs($jdat, $xxx);
}
fclose($fat);
fclose($jdat);
copy($dxr."_member_/autologin@@", $dxr."_member_/autologin");
unlink($dxr."_member_/autologin@@");
}
unlink($dxr."_member_/logged_".$mbr_no);
ssckdxl();
scrhref($_POST['from'],0,0);exit;
} else if($_GET['id'] && $_GET['scrap']) {
if($_GET['xx']) $idd = $_GET['id']."/^".$_GET['xx'];
else $idd = $_GET['id'];
$dl = $dxr.$idd."/list.dat";
$dn = $dxr.$idd."/no.dat";
$fn = fopen($dn,"r");
$fl = fopen($dl,"r");
while(!feof($fn)) {
$fno = fgets($fn);
if((int)substr($fno, 0, 6) == $_GET['scrap']) {
$str = explode("\x1b", fgets($fl));
break;
} else fgets($fl);
}
fclose($fn);
fclose($fl);
$end = str_pad($_GET['id'],10).str_pad($_GET['scrap'],6,0,STR_PAD_LEFT);
$str = $end.substr($str[0],0,10).$str[3]."\n";
$file = $dxr."_member_/scrap_".$mbr_no;
$fm = fopen($tp,"w");
$fp = fopen($file,"a+");
fputs($fm, $str);
while(!feof($fp) && $stop == "") {
$fpo = fgets($fp);
if(substr($fpo, 0, 16) == $end) $stop = "1";
fputs($fm, $fpo);
}
fclose($fp);
fclose($fm);
if($stop == "") {
copy($tp,$file);
}
unlink($tp);
header("location:".$mblog."?mno=".$mbr_no."&view=scrap");
} else if($_GET['dell_scrap']) {
$file = $dxr."_member_/scrap_".$mbr_no;
$fm = fopen($tp,"w");
$fp = fopen($file,"a+");
$i = 1;
while(!feof($fp)) {
$fpo = fgets($fp);
if($_GET['dell_scrap'] == $i) $fpo = "";
fputs($fm, $fpo);
$i++;
}
fclose($fp);
fclose($fm);
copy($tp,$file);
unlink($tp);
header("location:?scrap=".$mbr_no);
} else if($_POST['gtm']) {
$file = $dxr."section.dat";
while($time - @filemtime($file."@@") < 3) {usleep(50000);$time = time();}
$jfi = fopen($file."@@","w");
if($rfi = @fopen($file,"r")) {
$i = 1;
while($rfio = fgets($rfi)) {
if($i == $_POST['gtm']) {
$rfoo = explode("\x1b",$rfio);
if($_POST['group'] && $mbr_level == 9) {
$rfio = $rfoo[0]."\x1b".$rfoo[1]."\x1b".$rfoo[2]."\x1b".$_POST['group'][0]."\x1b".$_POST['group'][1]."\x1b,";
for($g = 2;$_POST['group'][$g];$g++) $rfio .= $_POST['group'][$g].",";
} else if($_POST['inout'] == '2') {
$rfio = $rfoo[0]."\x1b".$rfoo[1]."\x1b".$rfoo[2]."\x1b".$rfoo[3]."\x1b".$rfoo[4]."\x1b".str_replace(",".$mbr_no.",",",",$rfoo[5]);
} else if($_POST['inout'] == '1') {
$rfio = $rfoo[0]."\x1b".$rfoo[1]."\x1b".$rfoo[2]."\x1b".$rfoo[3]."\x1b".$rfoo[4]."\x1b".$rfoo[5].$mbr_no.",";
}
$rfio .= "\x1b".$rfoo[6]."\x1b\n";
}
fputs($jfi,$rfio);
$i++;
}
fclose($rfi);
}
fclose($jfi);
copy($file."@@",$file);
unlink($file."@@");
if($_POST['inout']) echo "location.reload()";
else scrhref('?sect_group='.$_POST['gtm'],0,0);
exit;
}
if($mbr_level == 9) {
// 관리자기능
function modify_set($sett) {
global $set;
$fp = fopen($set,"w");
fputs($fp, $sett[0]."\x1b".$sett[1]."\x1b".$sett[2]."\x1b".$sett[3]."\x1b".$sett[4]."\x1b".$sett[5]."\x1b".$sett[6]."\x1b".$sett[7]."\x1b".$sett[8]."\x1b".$sett[9]."\x1b".$sett[10]."\x1b".$sett[11]."\x1b".$sett[12]."\x1b".$sett[13]."\x1b".$sett[14]."\x1b".$sett[15]."\x1b".$sett[16]."\x1b".$sett[17]."\x1b".$sett[18]."\x1b".$sett[19]."\x1b".$sett[20]."\x1b".$sett[21]."\x1b".$sett[22]."\x1b".$sett[23]."\x1b".$sett[24]."\x1b".$sett[25]."\x1b".$sett[26]."\x1b".$sett[27]."\x1b".$sett[28]."\x1b".$sett[29]."\x1b".$sett[30]."\x1b".$sett[31]."\x1b".$sett[32]."\x1b".$sett[33]."\x1b".$sett[34]."\x1b".$sett[35]."\x1b".$sett[36]."\x1b".$sett[37]."\x1b".$sett[38]."\x1b".$sett[39]."\x1b".$sett[40]."\x1b".$sett[41]."\x1b".$sett[42]."\x1b".$sett[43]."\x1b".$sett[44]."\x1b".$sett[45]."\x1b".$sett[46]."\x1b".$sett[47]."\x1b".$sett[48]."\x1b".$sett[49]."\x1b".$sett[50]."\x1b".$sett[51]."\x1b".$sett[52]."\x1b".$sett[53]."\x1b".$sett[54]."\x1b".$sett[55]."\x1b".$sett[56]."\x1b".$sett[57]."\x1b".$sett[58]."\x1b".$sett[59]."\x1b".$sett[60]."\x1b".$sett[61]."\x1b".$sett[62]."\x1b".$sett[63]."\x1b".$sett[64]."\x1b".$sett[65]."\x1b".$sett[66]."\x1b".$sett[67]."\x1b".$sett[68]."\x1b".$sett[69]."\x1b".$sett[70]."\x1b".$sett[71]."\x1b".$sett[72]."\x1b".$sett[73]."\x1b".$sett[74]."\x1b".$sett[75]."\x1b".$sett[76]."\x1b".$sett[77]."\x1b".$sett[78]."\x1b".$sett[79]."\x1b".$sett[80]."\x1b".$sett[81]."\x1b".$sett[82]."\x1b".$sett[83]."\x1b".$sett[84]."\x1b".$sett[85]."\x1b".$sett[86]."\x1b".$sett[87]."\x1b".$sett[88]."\x1b");
fclose($fp);
}
function fchr($value) {
$value = str_replace("%2F","/",urlencode($value));
return $value;
}
function RmDirR($dzr) {
if(@is_dir($dzr)) {
if($d = opendir($dzr)) {
while($entry = readdir($d)) {
if($entry != "." && $entry != "..") {
if(is_dir($dzr."/".$entry)) RmDirR($dzr."/".$entry);
else @unlink($dzr."/".$entry);
}
}
closedir($d);
}
@rmdir($dzr);
}}
if($_GET['renewcache']) {
if($_GET['renewcache'] == 'all') {
RmDirR($dxr."_member_/_bak_");
mkdir($dxr."_member_/_bak_",0777);
scrhref('?',0,0);
} else {
@unlink($dxr."_member_/_bak_/gatebk1_".$_GET['renewcache'].".dat");
@unlink($dxr."_member_/_bak_/gatebk2_".$_GET['renewcache'].".dat");
echo "<script type='text/javascript'>/*<![CDATA[*/parent.setup();/*]]>*/</script>";
}
exit;
}
if($_POST['arr'] || $_GET['sect_arr'] || $_GET['section']) {
$sxvtm['10days_graph'] = "10일간_방문자수";
$sxvtm['all_menu'] = "전체메뉴";
$sxvtm['hot_post'] = "전체최근글";
$sxvtm['hot_reple'] = "전체최근덧글";
$sxvtm['all_search'] = "전체검색";
$sxvtm['all_section'] = "전체섹션";
$sxvtm['blog_profile'] = "블로그프로필";
$sxvtm['calendar'] = "달력";
$sxvtm['category'] = "카테고리";
$sxvtm['counter'] = "카운터";
$sxvtm['gagalive'] = "gagalive채팅";
$sxvtm['member_login'] = "회원로그인";
$sxvtm['member_rank'] = "회원랭킹";
$sxvtm['order_by_hit'] = "조회순덧글순";
$sxvtm['realtime_visitor'] = "실시간_방문자";
$sxvtm['recent_rp'] = "최근덧글";
$sxvtm['sect_boards'] = "섹션게시판";
$sxvtm['sect_recent'] = "섹션최근글";
$sxvtm['tag'] = "태그";
$sxvtm['trackback'] = "트랙백";
$sxvtm['menu_plus'] = "추가메뉴";
$sxvtm['research'] = "설문조사";
$sxvtm['bd_thumb'] = "게시판썸네일";
$sxvtm['bd_list'] = "게시판최근글";
$sxvtm['by_hot'] = "전체인기순";
$sxvtm['by_hot1'] = "섹션조회덧글순";
$sxvtm['by_hot2'] = "전체조회덧글순";
$sxvtm['clock'] = "시계";
$sxvtm['member_on'] = "접속중인 회원";
$sxvtm['nconnect'] = "접속자수";

$smod = opendir("module");
while($smodd = readdir($smod)) {
$smo = substr($smodd,0,-4);
$sxt = substr($smodd,-4);
if($sxt == '.ph_') {if(!$sxvtm[$smo]) $sxvtm[$smo] = $smo;}
else if($sxt == '.php' && $smodd[0] != '_') $secto[] = $smo;
else if($sxt == '.css' && $smodd[0] == '_') $stcss[] = substr($smo,1);
}
closedir($smod);
@sort($secto);
if($_POST['arr']) {
$mtvxs = array_flip($sxvtm);
$stccs = '';
while($time - @filemtime($dxr."section_arr.dat@@") < 3) {usleep(50000);$time = time();}
$smt = fopen($dxr."section_arr.dat@@","w");
$sm = fopen($dxr."section_arr.dat","r");
for($ii=1;(!feof($sm) || $ii <= $_POST['arr']);$ii++) {
$smo = fgets($sm);
if($ii == $_POST['arr']) {
$sm2 = explode("@@",trim($smo));
$smo = '';
for($i = 0;$_POST['subs'][$i];$i++) {
$smn = substr($_POST['subs'][$i],2);
if($stcss && in_array($smn,$stcss)) $stccs .= "@import url('_".$smn.".css'); /* @@ */\n";
$smo .= "@".substr($_POST['subs'][$i],0,2).$mtvxs[$smn];
}
if($_POST['geb']) $smo = $smo."@@".$smo."@\n";
else $smo = ($_POST['gob'] == 1)? $sm2[0]."@@".$smo."@\n":$smo."@@".$sm2[1]."\n";
$stcssf = "module/sectcss_".$ii.".css";
if($stccs || file_exists($stcssf)) {
if($stss = @fopen($stcssf,"r")) {
while($stsso = fgets($stss)) {
if(substr($stsso,-11) != "; /* @@ */\n") $stccs .= $stsso;
}
fclose($stss);
}
if($stccs) {
$stss = fopen($stcssf,"w");
fputs($stss,$stccs);
fclose($stss);
} else unlink($stcssf);
}
} else if($ii < $_POST['arr'] && trim($smo) == '') $smo = "\n";
fputs($smt,$smo);
}
fclose($sm);
fclose($smt);
copy($dxr."section_arr.dat@@",$dxr."section_arr.dat");
unlink($dxr."section_arr.dat@@");
scrhref('?sect_arr='.$_POST['arr'].'&amp;gob='.$_POST['gob'],0,0);exit;
}}
if($_POST['bdcopy'] && $_POST['ffilex'] == 'copy') {
$copyto = substr($_POST['bdcopy'],0,7)."_bk";
if(!file_exists($dxr.$copyto)) {
$fs = fopen($ds,"a+");
$fc = fopen($dc,"a+");
while(!feof($fs)){
$fso = fgets($fs);
$fco = fgets($fc);
if(trim(substr($fso, 0, 10)) == $_POST['bdcopy']) {
fputs($fs,str_pad($copyto,10).substr($fso,10));
fputs($fc,$fco);
break;
}}
fclose($fs);
fclose($fc);
$_POST['ffilew'] = $dxr.$copyto;
$_POST['ffiles'] = $dxr.$_POST['bdcopy'];
}}
if($_GET['bd_uninstall'] == $mbr_id) {
if($mbr_id && $mbr_level == 9) {
RmDirR(".");
ssckdxl();
echo "<h1>srboard 언인스톨 되었습니다.</h1>";
exit;
}} else if($_POST['mode'] == "new" && $_POST['id'] && $_POST['nam']) {
if($_POST['id'] != "_member_"){
if($_POST['pt'] == 'r') {
if($_POST['pr'] == '0') $_POST['pr'] = '1';
if($_POST['pw'] == '0') $_POST['pw'] = '9';
}
$sss = str_pad(substr($_POST['id'],0,10), 10)."000000000000".$_POST['pl'].$_POST['pr'].$_POST['pw'].$_POST['pc'].$_POST['pt']."01111110615111109210101090001001000000000001111\x1b".$_POST['nam']."\x1bdefault\x1b\x1b\x1b\x1b\x1b000".$_POST['qo']."1000".$_POST['qt']."1+0005+0005-0000+0000".$_POST['re']."00\x1b01100\x1b0+00010010\x1b\n";
$fs = fopen($ds,"a");
fputs($fs,$sss);
fclose($fs);
$fc = fopen($dc,"a");
fputs($fc,"\x1b\n");
fclose($fc);
mkdir($dxr.$_POST['id'], 0777);
mkdir($dxr.$_POST['id']."/files", 0777);
fclose(fopen($dxr.$_POST['id']."/body.dat","w"));
fclose(fopen($dxr.$_POST['id']."/list.dat","w"));
fclose(fopen($dxr.$_POST['id']."/no.dat","w"));
fclose(fopen($dxr.$_POST['id']."/rbody.dat","w"));
fclose(fopen($dxr.$_POST['id']."/rlist.dat","w"));
fclose(fopen($dxr.$_POST['id']."/new_rp.dat","w"));
fclose(fopen($dxr.$_POST['id']."/upload.dat","w"));
fclose(fopen($dxr.$_POST['id']."/stb.dat","w"));
fclose(fopen($dxr.$_POST['id']."/rtb.dat","w"));
fclose(fopen($dxr.$_POST['id']."/bno.dat","w"));
fclose(fopen($dxr.$_POST['id']."/rss.dat","w"));
fclose(fopen($dxr.$_POST['id']."/tag.dat","w"));
fclose(fopen($dxr.$_POST['id']."/vote.dat","w"));
fclose(fopen($dxr.$_POST['id']."/head.dat","w"));
fclose(fopen($dxr.$_POST['id']."/date.dat","w"));
fclose(fopen($dxr.$_POST['id']."/notice.dat","w"));
}
scrhref($_POST['from'],0,0);exit;
} else if($_POST['mode'] && $_POST['mode'] != "new") {
function lrs_member($mdm,$mdn) {
global $dxr,$time;
$mbrdr = $dxr."_member_/";
$rnm = opendir($mbrdr);
while($rnmo = readdir($rnm)) {
if($rnmo[0] == "l" || $rnmo[0] == "r" || $rnmo[0] == "s") {
if(@filesize($mbrdr.$rnmo)) {
while($time - @filemtime($mbrdr.$rnmo."@@") < 3) {usleep(50000);$time = time();}
$nmt = fopen($mbrdr.$rnmo."@@","w");
$nm = fopen($mbrdr.$rnmo,"r");
while($nmo = fgets($nm)) {
if(substr($nmo,0,10) == $mdm) {
if(!$mdn) $nmo = '';
else $nmo = $mdn.substr($nmo,10);
if(!$onk) $onk = 1;
}
fputs($nmt,$nmo);
}
fclose($nm);
fclose($nmt);
if($onk) copy($mbrdr.$rnmo."@@",$mbrdr.$rnmo);
unlink($mbrdr.$rnmo."@@");
}
}
}
closedir($rnm);
}
function aacnt($vv,$ud,$vu) {
global $dxr;
	$vi = 0;
	$vh = 0;
	$vw = 1;
	if($vu) $vn = @fopen($dxr.$ud."/^1/no.dat","r");
	else $vn = fopen($dxr.$ud."/no.dat","r");
	while($vn) {
	$vno = fgets($vn);
	if(trim($vno) == '') {
	fclose($vn);
	$vbb[$vw][1] = str_pad($vi,6,0,STR_PAD_LEFT);
	$vbb[$vw][2] = str_pad($vh,6,0,STR_PAD_LEFT);
	if($vw <= $vu) {
	$vw++;
	if($vw <= $vu && file_exists($dxr.$ud."/^".$vw."/no.dat")) $vn = fopen($dxr.$ud."/^".$vw."/no.dat","r");
	else {$vn = fopen($dxr.$ud."/no.dat","r");$vw = $vu + 1;}
	$vh = 0;
	} else break;
	} else {
	if(!$vv || substr($vno,6,2) != 'aa') {
	if($vh == 0) $vbb[$vw][0] = substr($vno,0,6);
	$vi++;
	$vh++;
	}}}
if($vu) {
$vbn = fopen($dxr.$ud."/bno.dat","w");
for($va=1;$va <= $vu;$va++) {
if($vbb[$va]) {
fputs($vbn,$vbb[$va][0].$vbb[$va][1].$vbb[$va][2]."\n");
}}
fclose($vbn);
}
$vbb[$vw][2] = count($vbb) -1;
if($vbb[$vw][2] < 0) $vbb[$vw][2] = 0;
if(!$vbb[$vw][0]) {if($vbb[$vu][0]) $vbb[$vw][0] = $vbb[$vu][0];else $vbb[$vw][0] = '000000';}
return $vbb[$vw];
}
while($time - @filemtime($ds."@@") < 3) {usleep(50000);$time = time();}
copy($ds, substr($ds,0,-3)."bak");
$jds = fopen($ds."@@","w");
$fs = fopen($ds,"r");
$ii = 0;
$i = 0;
while(!feof($fs)) {
$sss = fgets($fs);
$mdm = substr($sss, 0, 10);
if($mdt = trim($mdm)) {
$i = $ii - $_POST['order'][0];
if($_POST['mode'] == 'dell' && $mdt == $_POST['id']) {
$ss = explode("\x1b", $sss);
if($ss[7][33] == '1') RmDirR('icon/'.$_POST['idd'][$i]);
lrs_member($mdm,'');
RmDirR($dxr.$mdt);
scrhref('?dtm='.($ii + 1),0,0);
$sss = "";
} else if($_POST['mode'] == 'modi' && $i > -1 && $_POST['id'][$i] && $mdt == $_POST['idd'][$i]) {
$rset = fopen($dxr.$_POST['idd'][$i]."/set.dat","w");
fputs($rset,substr($_POST['rdt'][$i],2)."\n".substr($_POST['rdt'][$i],0,2));
fclose($rset);
$ss = explode("\x1b", $sss);
if($mdt != $_POST['id'][$i]) {
rename($dxr.$mdt,$dxr.$_POST['id'][$i]);
if($ss[7][33] == '1') rename('icon/'.$mdt,'icon/'.$_POST['id'][$i]);
lrs_member($mdm,str_pad($_POST['id'][$i],10));
}
$lastnoo = (substr($_POST['lastcnt'][$i],0,6) == substr($_POST['lastcnt'][$i],12,6))? substr($ss[0],10,6):substr($_POST['lastcnt'][$i],0,6);
$cntt = (substr($_POST['lastcnt'][$i],6,6) == substr($_POST['lastcnt'][$i],18,6))? substr($ss[0],16,6):substr($_POST['lastcnt'][$i],6,6);
if((int)$ss[7][33] != $_POST['tct7'][$i][33]) {
$icnf = 'icon/'.$_POST['id'][$i];
if($ss[7][33] == '1') rename($icnf,$dxr.$_POST['id'][$i].'/files');
else if($_POST['tct7'][$i][33] == '1') rename($dxr.$_POST['id'][$i].'/files',$icnf);
}
if($ss[0][66] != $_POST['tct0'][$i][44] || substr($_POST['lastcnt'][$i],24,1)) {
$aanct = aacnt($_POST['tct0'][$i][44],$_POST['id'][$i],$ss[6]);
$lastnoo = $aanct[0];
$cntt = $aanct[1];
$ss[6] = $aanct[2];
}
$sss = str_pad($_POST['id'][$i], 10).$lastnoo.$cntt.$_POST['tct0'][$i]."\x1b".$_POST['nam'][$i]."\x1b".$_POST['tct1'][$i]."\x1b".$_POST['tct2'][$i]."\x1b".$ss[4]."\x1b".$ss[5]."\x1b".$ss[6]."\x1b".$_POST['tct7'][$i]."\x1b".$_POST['tct8'][$i]."\x1b".$_POST['tct9'][$i]."\x1b\n";
}
fputs($jds,$sss);
}
$ii++;
}
fclose($fs);
fclose($jds);
copy($ds."@@",$ds);
unlink($ds."@@");
scrhref($_POST['from'],0,0);
exit;
} else if($_POST['titlee']) {
$thos = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')).'/';
$fp = fopen($set,"w");
$_POST['xm'] = trim($_POST['xm']);
if($_POST['xm'][0] == '|') $_POST['xm'] = substr($_POST['xm'],1);
if(substr($_POST['xm'],-1) == '|') $_POST['xm'] = substr($_POST['xm'],0,-1);
if(!$_POST['xm']) $_POST['xm'] = 'jpg|png|gif|zip|rar|7z|tgz|tar.gz|wma|mp3';
$str = stripslashes($_POST['titlee'])."\x1b".$_POST['a']."\x1b".$_POST['b']."\x1b".$_POST['c']."\x1b".$_POST['d']."\x1b".$_POST['e']."\x1b".$_POST['f']."\x1b".$_POST['g']."\x1b".$_POST['h']."\x1b".$_POST['i']."\x1b".$_POST['j']."\x1b".$_POST['k']."\x1b".$_POST['l']."\x1b".$_POST['m']."\x1b".$thos."\x1b".(int)$_POST['r']."\x1b".$_POST['xd'].$_POST['xe']."\x1b".$_POST['xh']."\x1b".$sett[18]."\x1b".$_POST['s']."\x1b".$sett[20]."\x1b".$_POST['u']."\x1b".$_POST['v']."\x1b".$_POST['w']."\x1b".$_POST['ww']."\x1b".$_POST['wv']."\x1b".$sett[26]."\x1b".$_POST['wa']."\x1b".$_POST['wb']."\x1b".$_POST['wc']."\x1b".$_POST['wd']."\x1b".$_POST['we']."\x1b".$_POST['wf']."\x1b".$_POST['wg']."\x1b".$sett[34]."\x1b".(int)$_POST['wj']."\x1b".(int)$_POST['wk']."\x1b".(int)$_POST['wl']."\x1b".$sett[38]."\x1b".(int)$_POST['wn']."\x1b".(int)$_POST['wo']."\x1b".(int)$_POST['wp']."\x1b".(int)$_POST['wq']."\x1b".str_pad($_POST['wr1'],4,0,STR_PAD_LEFT).str_pad($_POST['wr2'],4,0,STR_PAD_LEFT).str_pad($_POST['wr3'],3,0,STR_PAD_LEFT).(int)$_POST['wr4']."\x1b".$_POST['ws']."\x1b".$sett[45]."\x1b".(int)$_POST['wt']."\x1b".$sett[47]."\x1b".$_POST['wx']."\x1b".$_POST['wy']."\x1b".$_POST['wz']."\x1b".$_POST['xa']."\x1b".$sett[52]."\x1b".$sett[53]."\x1b".$_POST['xb']."\x1b".$_POST['xc']."\x1b".ini_get('register_globals')."\x1b".$sett[57]."\x1b".$sett[58]."\x1b".$sett[59]."\x1b".(int)$_POST['xia']."|".(int)$_POST['xib']."\x1b".(int)$sett[61]."\x1b".(int)$_POST['xk']."\x1b".(int)$sett[63]."\x1b".$_POST['xm']."\x1b".(int)$_POST['xn']."\x1b".(int)$_POST['xo']."\x1b".(int)$_POST['xp']."\x1b".(int)$_POST['xq']."\x1b".(int)$_POST['xr']."\x1b".(int)$_POST['xs']."\x1b".(int)$_POST['xt']."\x1b".(int)$_POST['xu']."\x1b".(int)$_POST['xv']."\x1b".$sett[74]."\x1b".(int)$_POST['va']."\x1b".(int)$_POST['vb']."\x1b".(int)$_POST['vc']."\x1b".(int)$_POST['vd']."\x1b".(int)$_POST['ve']."\x1b".(int)$_POST['vf']."\x1b".(int)$_POST['vg']."\x1b".(int)$_POST['wh']."\x1b".$sett[83]."\x1b".$_POST['vh']."\x1b".$_POST['vi']."\x1b".$_POST['vj']."\x1b".$_POST['vk']."\x1b".$_POST['vl']."\x1b";
fputs($fp, $str);
fclose($fp);
$fh = fopen($dxr."head","w");
fputs($fh, stripslashes($_POST['head']));
fclose($fh);
$ft = fopen($dxr."tail","w");
fputs($ft, stripslashes($_POST['tail']));
fclose($ft);
$ft = fopen($dxr."member_agreement","w");
fputs($ft, stripslashes($_POST['member_agreement']));
fclose($ft);
$ft = fopen($dxr."ban","w");
fputs($ft, str_replace("\r","",$_POST['ban']));
fclose($ft);
$ft = fopen($dxr."ban2","w");
fputs($ft, str_replace("\r","",$_POST['ban2']));
fclose($ft);
$ft = fopen($dxr."prohibit","w");
fputs($ft, str_replace("\r","",$_POST['prohibit']));
fclose($ft);
scrhref('?',0,0);exit;
} else if($_POST['ctm'] || $_GET['dtm']) {
while($time - @filemtime($dc."@@") < 3) {usleep(50000);$time = time();}
$jdc = fopen($dc."@@","w");
$fc = fopen($dc,"r");
$ii = 1;
while(!feof($fc)){
$str = fgets($fc);
if($ii == $_POST['ctm']) {
$stri = explode("\x1b",substr($str,1));
$strr = "\x1b";
$cnt = count($_POST['ct']);
for($i = 0; $i < $cnt; $i++) {
if($_POST['ct'][$i]) $strr .= $_POST['ct'][$i].str_pad($_POST['ctn'][$i],6,0,STR_PAD_LEFT)."\x1b";
else if(!$_POST['ctn'][$i] && $i < $cnt -2) $strr .= substr($stri[$i],-6)."\x1b";
}
$str = $strr."\n";
} else if($ii == $_GET['dtm']) $str = "";
fputs($jdc, $str);
$ii++;
}
fclose($fc);
fclose($jdc);
copy($dc."@@", $dc);
unlink($dc."@@");
if($_GET['dtm']) scrhref('?board=1',0,0);
else scrhref('?mst='.$_POST['ctm'],0,0);exit;
} else if($_POST['stm']) {
$stgt = array();
$file = $dxr."section.dat";
$filee = $dxr."section_add.dat";
$filer = $dxr."section_arr.dat";
$tste = fopen($file,"r");
for($i = 1;$tsto = trim(fgets($tste));$i++) {$tstx = explode("\x1b",$tsto);if($tstx[4]) {$tstae[$i] = "\x1b".$tstx[3]."\x1b".$tstx[4]."\x1b".$tstx[5];} else $tstae[$i] = "\x1b\x1b\x1b";}
fclose($tste);
$tsta = fopen($filee,"r");
for($i = 1;$tsto = fgets($tsta);$i++) $tstao[$i] = trim($tsto);
fclose($tsta);
$tstr = fopen($filer,"r");
for($i = 1;$tstro = fgets($tstr);$i++) $tstar[$i] = trim($tstro);
fclose($tstr);
$secc = count($_POST['sect']);
$st = fopen($file,"w");
$sta = fopen($filee,"w");
$str = fopen($filer,"w");
for($i =0;$i < $secc;$i++) {
if($_POST['sect'][$i]) {
$stgt[$_POST['sectgrp'][$i]] .= "^".($i+1);
if($_POST['sectlnk'][$i] == '8') {
$_POST['sectadd'][$i] = '';
$fs = fopen($ds,"r");
for($tstn = 0;$tstbd = trim(substr(@fgets($fs),0,10));$tstn++) $_POST['sectadd'][$i] .= $tstbd."^";
$_POST['sectadd'][$i] = substr($_POST['sectadd'][$i],0,-1);
fclose($fs);
$_POST['sectlnk'][$i] = '1';
$sec8 = $i + 2;
}
$tstna = $tstao[$_POST['sn'][$i]];
$ips = $i + 1;
if($ips != $_POST['sn'][$i] && file_exists("widget/sectbtm_".$_POST['sn'][$i])) {copy("widget/sectbtm_".$_POST['sn'][$i],"widget/sectbtm__".$ips);$changes[] = $ips;}
if(!$_POST['sectlnk'][$i]) $_POST['sectlnk'][$i] = '1';
fputs($st,$_POST['sect'][$i]."\x1b".$_POST['sectlnk'][$i]."\x1b".stripslashes($_POST['sectadd'][$i]).$tstae[$_POST['sn'][$i]]."\x1b".$_POST['sectgrp'][$i]."\x1b\n");
if($sec8 == $i + 2 || ($tstna == '' && $_POST['sectlnk'][$i] != '3' && $_POST['sectlnk'][$i] != '6' && $_POST['sectlnk'][$i] != '7' && $_POST['sectlnk'][$i] != 's')) {
if($_POST['sectadd'][$i] == '') $tstna = "<colgroup><col width='100%' /></colgroup><tr><td width='100%' valign='top'>&nbsp;</td></tr>";
else {
$tstbd = explode("^",$_POST['sectadd'][$i]);
$tstn = count($tstbd);
if($tstn == 1) $tstna = "<colgroup><col width='100%' /></colgroup><tr><td width='100%' valign='top'><#board#></td></tr>";
else {
$tstna = "<colgroup><col width='50%' /><col width='50%' /></colgroup>";
for($ii = 0;$ii <= $tstn;$ii++) {
if(!strpos($tstbd[$ii],'>')) {
if($tstbd[$ii] && $ii%2 == 0) $tstna .= "<tr><td width='50%' valign='top'><#board#></td>";
else if($tstbd[$ii] && $ii%2) $tstna .= "<td width='50%' valign='top'><#board#></td></tr>";
else if(!$tstbd[$ii] && $ii%2) $tstna .= "<td width='50%' valign='top'>&nbsp;</td></tr>";
}}}}}
fputs($sta,$tstna."\n");
fputs($str,$tstar[$_POST['sn'][$i]]."\n");
}
}
fclose($st);
fclose($sta);
fclose($str);
if($sett[26] != $_POST['sectmenu'] || $sett[45] != $_POST['wgcss']) {
$sett[26] = $_POST['sectmenu'];
$sett[45] = $_POST['wgcss'];
modify_set($sett);
}
for($i = 0;$changes[$i];$i++) rename("widget/sectbtm__".$changes[$i],"widget/sectbtm_".$changes[$i]);
$fg = fopen($dxr."section_group.dat","w");
$i = 0;
$lit = count($_POST['stgs']);
while($lit > $i) {
if($_POST['stgs'][$i]) fputs($fg,$_POST['stgs'][$i]."\x1b".$_POST['stgl'][$i]."\x1b".$stgt[($i + 1)]."^\x1b".$_POST['stga'][$i]."\x1b\n");
$i++;
}
fclose($fg);
scrhref('?section=1',0,0);exit;
} else if($_POST['ffiles'] && $_POST['ffilew'] && $_POST['ffilex'] != 'find') {
if($_POST['ffilew'] == 'compress') {
$gz = $dxr.date("Ymd_His").".tar.gz";
$owner = str_replace("<>", " ", $_POST['ffiles']);
system("tar cfzp $gz $owner --exclude=$gz");
} else if($_POST['ffilew'] == 'compressf') {
$gz = $dxr.date("Ymd_His").".tar.gz";
$owner = str_replace("<>", " ", $_POST['ffiles']);
system("tar cfzp $gz $owner --exclude=$gz --exclude=files/*");
} else if($_POST['ffilex'] == 'decompress') {
$gz = $_POST['ffiles'];
$owner = $_POST['ffilew'];
system("tar xfzp $gz -C $owner");
} else if($_POST['ffilew'] == 'delete') {
$owner = explode("<>",$_POST['ffiles']);
for($i = 0; $i < count($owner); $i++) {
if(is_file($owner[$i])) unlink($owner[$i]);
else RmDirR($owner[$i]);
}
} else if($_POST['ffilew'] == 'clear') {
$owner = explode("<>",$_POST['ffiles']);
for($i = 0; $i < count($owner); $i++) {
if(is_file($owner[$i])) {
fclose(fopen($owner[$i],"w"));
}
}
} else if($_POST['ffilew'] == '0777') {
function xhmod($path) {
$d = dir($path);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
@chmod($path."/".$entry, 0777);
if(is_dir($path."/".$entry)) xhmod($path."/".$entry);
}}
$d->close();
}
$owner = explode("<>",$_POST['ffiles']);
for($i = 0; $i < count($owner); $i++) {
@chmod($owner[$i], 0777);
if(is_dir($owner[$i])) xhmod($owner[$i]);
}
} else if($_POST['ffilex'] == 'rename' || $_POST['ffilex'] == 'copy') {
if(!file_exists($_POST['ffilew']) && (strpos($_POST['ffiles'],"<>") || (is_dir($_POST['ffiles']) && $_POST['ffilex'] == 'copy'))) {@mkdir($_POST['ffilew'], 0777);$mkd = 1;}
if(is_dir($_POST['ffilew'])) {
if(substr($_POST['ffilew'], -1) != '/') $_POST['ffilew'] = $_POST['ffilew'].'/';
$owner = explode("<>",$_POST['ffiles']);
$ownercnt = count($owner);
function dircopy($copyfs,$copyfw,$copybase) {
global $mkd;
if(!$mkd && $copybase) {$copyfw = $copyfw."/".$copybase;@mkdir($copyfw, 0777);}
$d = dir($copyfs);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
if(is_dir($copyfs."/".$entry)) {if(@mkdir($copyfw."/".$entry, 0777)) dircopy($copyfs."/".$entry,$copyfw."/".$entry,'');}
else @copy($copyfs."/".$entry, $copyfw."/".$entry);
}
}
$d->close();
}
for($i = 0; $i < $ownercnt; $i++) {
$base = basename($owner[$i]);
if(is_dir($owner[$i]) && $_POST['ffilex'] == 'copy') {
dircopy($owner[$i],$_POST['ffilew'],$base);
} else {
if($_POST['ffilex'] == 'copy') @copy($owner[$i], $_POST['ffilew'].$base);
else {
if($ownercnt == 1 && is_dir($owner[$i])) rename($owner[$i], $_POST['ffilew']);
else @rename($owner[$i], $_POST['ffilew'].$base);
}}}} else {
if($_POST['ffilex'] == 'copy') @copy($_POST['ffiles'], $_POST['ffilew']);
else if($_POST['ffilex'] == 'rename') @rename($_POST['ffiles'], $_POST['ffilew']);
}
}
if($_POST['bdcopy']) echo "<script type='text/javascript'>parent.location.reload();</script>";
else scrhref('?drct='.$_POST['ffilet'],0,0);
exit;
} else if($_POST['mkid']) {
$ft = fopen($dxr.$_POST['mkid']."/".$_POST['mknm'],"w");
fputs($ft,stripslashes($_POST['mktxt']));
fclose($ft);
} else if($_GET['deled']) {
RmDirR($_GET['deled']);
echo "<script type='text/javascript'>location.replace('?drct=".fchr(substr($_GET['deled'], 0, strrpos($_GET['deled'],'/')))."');</script>";
exit;
} else if($_GET['delef']) {
$xx = UnLink ($_GET['delef']);
if(!$xx) {
 chown($_GET['delef'], 99);
 UnLink ($_GET['delef']);
}
echo "<script type='text/javascript'>location.replace('?drct=".substr($_GET['delef'], 0, strrpos($_GET['delef'],'/'))."');</script>";exit;
} else if($_GET['delem']) {
fclose(fopen($_GET['delem'],"w"));
echo "<script type='text/javascript'>location.replace('?drct=".substr($_GET['delem'], 0, strrpos($_GET['delem'],'/'))."');</script>";exit;
} else if($_GET['mkdir']) {
mkdir($_GET['mkdir'], 0777);
echo "<script type='text/javascript'>location.replace('?drct=".substr($_GET['mkdir'], 0, strrpos($_GET['mkdir'],'/'))."');</script>";exit;
} else if($_POST['statisticn']) {
$countin = array("request","host","query");
for($i = 0;$i < 3;$i++) {
if($_POST['dlimit'][$i]) {
$ffile = $dxr."count_".$countin[$i].".dat";
if($fsp = @fopen($ffile,"r")) {
while($time - @filemtime($ffile."@@") < 3) {usleep(50000);$time = time();}
$stff = fopen($ffile."@@","w");
while($fspo = fgets($fsp)) {
if((int)substr($fspo,0,6) <= $_POST['dlimit'][$i]) $fspo = '';
fputs($stff,$fspo);
}
fclose($stff);
copy($ffile."@@", $ffile);
unlink($ffile."@@");
}}}
$sett[47] = $_POST['statisticn'];
modify_set($sett);
scrhref('?'.$_POST['from'],0,0);exit;
} else if($_POST['xg']) {
$sett[58] = $_POST['xg'];
modify_set($sett);
scrhref('?'.$_POST['from'],0,0);exit;
} else if($_POST['mblvby']) {
while($time - @filemtime($dim."@@") < 3) {usleep(50000);$time = time();}
$jdim = fopen($dim."@@","w");
$fim = fopen($dim,"r");
$xxx = '';
while(!feof($fim)) {
$xxx = fgets($fim);
$okk = explode("\x1b",trim($xxx));
if($okk[2] < $_POST['mblvby'][2]) {
$mbf = $dxr."_member_/member_".(int)substr($okk[0],0,5);
if($mbf = @fopen($mbf,"r")) {
$jno = explode("\x1b",fgets($mbf));
fclose($mbf);
if($_POST['mblvby'][0] == 1 && $_POST['mblvby'][1] <= (int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]) $okk2 = $_POST['mblvby'][2];
else if(($_POST['mblvby'][0] == 2 && $_POST['mblvby'][1] <= $jno[0]) || ($_POST['mblvby'][0] == 3 && $_POST['mblvby'][1] <= $jno[1]) || ($_POST['mblvby'][0] == 4 && $_POST['mblvby'][1] <= $jno[2])) $okk2 = $_POST['mblvby'][2];
else $okk2 = $okk[2];
$xxx = $okk[0]."\x1b".$okk[1]."\x1b".$okk2."\x1b".$okk[3]."\x1b".$okk[4]."\x1b".$okk[5]."\x1b".$okk[6]."\x1b".$okk[7]."\x1b".$okk[8]."\x1b".$okk[9]."\x1b".$okk[10]."\x1b".$okk[11]."\x1b".$okk[12]."\x1b".$okk[13]."\x1b".$okk[14]."\x1b".$okk[15]."\x1b\n";
}}
fputs($jdim, $xxx);
}
fclose($fim);
fclose($jdim);
copy($dim."@@", $dim);
unlink($dim."@@");
scrhref('?member=1',0,0);exit;
} else if($_POST['mpoint']) {
$sett[18] = $_POST['mpoint'][0];
$sett[20] = (int)$_POST['mpoint'][3].(int)$_POST['mpoint'][4].(int)$_POST['mpoint'][5].(int)$_POST['mpoint'][6].$_POST['mpoint'][7];
$sett[34] =  $_POST['wi'];
$sett[52] = $_POST['mpoint'][1];
$sett[53] = ((int)$_POST['mpoint'][2])? $_POST['mpoint'][2]:10;
$sett[57] = $_POST['xf'];
$sett[61] = $_POST['xj'];
$sett[63] = $_POST['xl'];
$sett[74] = $_POST['xw'];
$sett[83] = $_POST['wu'];
$sett[59] = '';
for($i = 0;$_POST['mbcname'][$i];$i++) {if($i < 9) {$sett[59] .= $_POST['mbclevel'][$i].$_POST['mbcname'][$i]."\x18";} else break;}
modify_set($sett);
scrhref('?'.$_POST['from'],0,0);exit;
} else if($_POST['uploadpath']) {
if($_POST['linkfile'] && $_POST['linkfile'] != 'http://') {
$rqurl = substr($_POST['linkfile'], 7);
$host = substr($rqurl,0,strpos($rqurl,'/'));
$dest = substr($rqurl,strrpos($rqurl,'/') + 1);
$fp = fsockopen($host, 80, $errno, $errstr, 30);
$tmp = fopen($_POST['uploadpath'].$dest,"w");
fputs($fp, "GET http://".$rqurl." HTTP/1.1\r\n");
fputs($fp, "Accept-Language: ko\r\n");
fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Accept-Encoding: gzip, deflate\r\n");
fputs($fp, "User-Agent: Mozilla/4.0\r\n");
fputs($fp, "Host: ".$host."\r\n");
fputs($fp, "Connection: close\r\n");
fputs($fp, "Cache-Control: no-cache\r\n");
fputs($fp, "\r\n\r\n");
while(!$ste) {$fpo = fread($fp, 4096);$ste = strpos($fpo,"\r\n\r\n");}
fputs($tmp,substr($fpo,$ste + 4));
while (!feof($fp)) {
$strr = fread($fp,4096);
if(feof($fp)) $strr = substr($strr,0,-7);
fputs($tmp,$strr);
}
fclose($fp);
fclose($tmp);
} else if(is_uploaded_file($_FILES['upfile']['tmp_name'])) {
$dest =stripslashes($_POST['uploadpath']) . basename($_FILES['upfile']['name']);
move_uploaded_file($_FILES['upfile']['tmp_name'], $dest);
} else {
$sett[38] = $_POST['dnsize'];
modify_set($sett);
}
scrhref('?drct='.fchr($_POST['uploadpath']),0,0);exit;
} else if($_POST['pvw'] && $_POST['pvw1']) {
$fpt = fopen($dxr."_member_/point_".$_POST['pvw'],"a");
fputs($fpt,$time."\x1b".(int)$_POST['pvw1']."\x1b".str_replace("\x1b","",$_POST['pvw2'])."\n");
fclose($fpt);
chmbr($_POST['pvw'], 3, $_POST['pvw1']);
?>
<script type='text/javascript'>location.replace('?pview=<?=$_POST['pvw']?>');</script>
<?
} else if($_POST['deletee'] == 'mailcheck') {
function mailtest($address) {
if(function_exists('mail')) $mailsent = mail($address, "mailtest", "mailtest", "MIME-Version: 1.0\r\nContent-type: text/plain; charset=UTF-8\r\nFrom: admin<{$address}>\r\nReply-To: {$address}\r\nX-Mailer: PHP/".phpversion());
return ($mailsent)? 1:0;
}
$sett[15] = mailtest($_POST['cemail']);
modify_set($sett);
scrhref('?',0,0);exit;
} else if($_GET['down']) {
$ext = strtolower(substr($_GET['down'],-4));
$name = strrchr($_GET['down'],'/');
if(!$name) $name = $_GET['down'];
else $name = substr($name,1);
$name = iconv("UTF-8","CP949//IGNORE",$name);
if(is_file($_GET['down'])) {
if($ext=='.jpg' || $ext=='.gif' || $ext=='.png') {
header("Content-type:image/jpeg");
} else {
header("Content-Type: applicaiton/octet-stream; charset=UTF-8");
}
header("Content-Disposition: filename=$name"); 
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($_GET['down']));
readfile($_GET['down']);
}
exit;
}
}
}
function login_failcnt($w) {
global $dxr,$sett,$time;
$ipt = str_pad($_SERVER['REMOTE_ADDR'],15);
$mtime = $time - 86400;
$fww = '';
$fwc = 0;
if($w == 1 && ($fw = @fopen($dxr."wrong_idpass2.dat","r"))) {
while(!feof($fw)) {
$fwo = fgets($fw);
if(substr($fwo,0,10) > $mtime) {
if(substr($fwo,10,15) == $ipt) $fwc = sprintf("%d",(substr($fwo,0,10) - $mtime)/60);
$fww .= $fwo;
} else $nfw = 1;
}
fclose($fw);
if($nfw) {
$fw = fopen($dxr."wrong_idpass2.dat","w");
fputs($fw,$fww);
fclose($fw);
}
if($fwc) {
$fwc = sprintf("%d",$fwc/60)."시간 ".($fwc%60)."분";
$goto = ($_POST['from'])? $_POST['from']:$index;
scrhref($goto,0,"반복된 실패로 차단되셨습니다. (남은 시간 : {$fwc})");
exit;
}
} else if($w == 2) {
if($fw = @fopen($dxr."wrong_idpass1.dat","r")) {
while(!feof($fw)) {
$fwo = fgets($fw);
if(substr($fwo,0,10) > $mtime) {
if(substr($fwo,10,15) == $ipt) {$fwc++;$fwi .= $fwo;}
else $fww .= $fwo;
} else $nfw = 1;
}
fclose($fw);
$fwc++;
if($fwc >= $sett[53]) {
$fw = fopen($dxr."wrong_idpass2.dat","a");
fputs($fw,$time.$ipt."\n");
fclose($fw);
$fwi = '';
}}
if($fwc < $sett[53]) $fww = $time.$ipt."\n".$fww;
$fw = fopen($dxr."wrong_idpass1.dat","w");
fputs($fw,$fwi.$fww);
fclose($fw);
}
return $fwc;
}
function addrcheck($addr) {
if(preg_match("`^[0-9a-z_\.]+@([0-9a-z_]+\.[0-9a-z_\.]+)$`i",$addr,$host)) {
if(($fp = @fsockopen($host[1], 80, $errno, $errstr, 30))) {
fclose($fp);
$retn = 1;
}}
return $retn;
}
function logincheck($name, $pass) {
 global $dim, $sett;
login_failcnt(1);
if($name && $pass) {
$name = str_pad($name,15);
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(substr($xxx,5,15) == $name) {
$isid = 1;
$okok = explode("\x1b", $xxx);
if(md5(substr($okok[6],0,10).$pass) != substr($okok[0],20)) {$okok = "";$isps = 1;}
break;
}
}
fclose($fim);
}
if($isid != 1 || $isps == 1) scrhref(0,0,"incorrect username or password (".login_failcnt(2)."/{$sett[53]})");
else return $okok;
}
$sess = (int)substr(preg_replace("`[^0-9]`","",md5($_SERVER['REMOTE_ADDR'].$zro)),0,3);
if($_POST['username_3'] && $_POST['password_3']) {
foreach($_POST as $key => $value) {
if(false !== strpos($value,"\x1b") || false !== strpos($value,"\n")) exit;
}
function convertbase($str) {
global $sess;
while($str) {
$str_1 .= chr(base_convert(substr($str,-2),18,10));
$str = substr($str,0,-2);
}
while($str_1) {
$str_2 .= chr(base_convert(substr($str_1,-2),34,10) - $sess);
$str_1 = substr($str_1,0,-2);
}
return $str_2;
}
$usrname = convertbase($_POST['username_3']);
$pssword = convertbase($_POST['password_3']);
if($_POST['nick'] && $_POST['email']) {
if(!$sett[61]) {
if($_SESSION['rgstr'] == md5($uzip) || $_SESSION[$_SESSION['eaddr']] = md5($_SERVER['REMOTE_ADDR'])) {
if(strlen($usrname) <= 15) {
$double = '';
$thos = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')).'/';
if($_POST['blog'] == 'http://') $_POST['blog'] = '';
if(!file_exists($dim)) {
$first_level = "9";
$dxr = "data/".substr(md5($usrname.$time),rand(1,16),rand(10,16))."/";
if(!mkdir($dxr, 0777)) {scrhref(0,0,'data폴더에 쓰기권한이 없습니다. data,icon,chat,module폴더의 권한을 777로 주세요.');exit;}
$fpa = fopen($dxr.".htaccess","w");
fputs($fpa,"RewriteEngine On\nRedirectMatch /(.*)$ http://www.yahoo.com");
fclose($fpa);
$fpa = fopen($dxr."section.dat","w");
fputs($fpa,"전체\x1b8\x1b\x1b\n");
fclose($fpa);
$fpa = fopen($dxr."section_add.dat","w");
fputs($fpa,"\n");
fclose($fpa);
fclose(fopen($dxr."section_arr.dat","w"));
fclose(fopen($dxr."section_group.dat","w"));
fclose(fopen($dxr."boards.dat","w"));
fclose(fopen($dxr."nothing","w"));
fclose(fopen($dxr."count_3d.dat","w"));
fclose(fopen($dxr."count.dat","w"));
fclose(fopen($dxr."count_all.dat","w"));
fclose(fopen($dxr."memo.dat","w"));
fclose(fopen($dxr."memo1.dat","w"));
$fp = fopen($dxr."setting.dat","w");
fputs($fp, "제목\x1bdefault\x1b\x1b\x1b2\x1b500\x1b0\x1b100\x1b0\x1b0\x1b3\x1b600\x1b940\x1b1\x1b".$thos."\x1b1\x1b5\x1b1\x1b1\x1b9\x1b0000\x1b30\x1bc\x1b100\x1b\x1b1\x1bdefault\x1b0\x1b24\x1b1\x1b1\x1b\x1b0\x1b300\x1b0\x1b15\x1b10\x1b0\x1b0\x1b10\x1b0\x1b1\x1b0\x1b01000100080\x1b\x1bdefault\x1b0\x1b1\x1bsrb_2\x1b0.2\x1b0.1\x1b9\x1b3\x1b10\x1b2\x1b350\x1b\x1b0\x1b100\x1b1준회원\x182정회원\x189관리자\x18\x1b5|5\x1b0\x1b0\x1b0\x1bjpg|png|gif|zip|rar|7z|tgz|tar.gz|wma|mp3\x1b30\x1b1\x1b240\x1b0\x1b240\x1b0\x1b24\x1b0\x1b0\x1b0\x1b5\x1b2\x1b0\x1b20\x1b1\x1b10\x1b1\x1b1\x1b1\x1b0\x1b0\x1b0\x1b0\x1b0\x1b");
fclose($fp);
fclose(fopen($dxr."head","w"));
fclose(fopen($dxr."tail","w"));
fclose(fopen($dxr."ban","w"));
fclose(fopen($dxr."ban2","w"));
fclose(fopen($dxr."prohibit","w"));
mkdir($dxr."_member_", 0777);
mkdir($dxr."_member_/_bak_", 0777);
fclose(fopen($dxr."attend.dat","w"));
fclose(fopen($dxr."category.dat","w"));
$fim = fopen($dxr."member.dat","w");
$str = "00001".str_pad($usrname, 15).md5($time.$pssword)."\x1b".$_POST['nick']."\x1b".$first_level."\x1b".$_POST['email']."\x1b".$_POST['postaddr'].",".$_POST['addrplus']."\x1b".$_POST['cellnumber'][0]."-".$_POST['cellnumber'][1]."-".$_POST['cellnumber'][2]."\x1b".$time.$_POST['birthday'][0].$_POST['birthday'][1].$_POST['birthday'][2]."\x1b".$_POST['addinfo']."\x1b".(int)$_POST['public_postaddr'].(int)$_POST['public_cellnumber'].(int)$_POST['public_birthday'].(int)$_POST['public_gender']."\x1b".$_POST['gender']."\x1b".$_POST['blog']."\x1ba\x1b0\x1b0\x1b0\x1b0\x1b0\x1b1\x1b\n";
fputs($fim, $str);
fclose($fim);
$no = 1;
} else if($sett[46] == 0 || $sett[46] == 2 || $_SESSION[preg_replace("`[^0-9a-z]`i","",$_POST['email'])] = md5($_SERVER['REMOTE_ADDR'])) {
$first_level = "1";
while($time - @filemtime($dim."@@") < 3) {usleep(50000);$time = time();}
$jdim = fopen($dim."@@","w");
$fim = fopen($dim,"r");
$strr = fgets($fim);
$no = (int)substr($strr, 0, 5) + 1;
$str = str_pad($no,5, 0, STR_PAD_LEFT).str_pad($usrname, 15).md5($time.$pssword)."\x1b".$_POST['nick']."\x1b".$first_level."\x1b".$_POST['email']."\x1b".$_POST['postaddr'].",".$_POST['addrplus']."\x1b".$_POST['cellnumber'][0]."-".$_POST['cellnumber'][1]."-".$_POST['cellnumber'][2]."\x1b".$time.$_POST['birthday'][0].$_POST['birthday'][1].$_POST['birthday'][2]."\x1b".$_POST['addinfo']."\x1b".(int)$_POST['public_postaddr'].(int)$_POST['public_cellnumber'].(int)$_POST['public_birthday'].(int)$_POST['public_gender']."\x1b".$_POST['gender']."\x1b".$_POST['blog']."\x1ba\x1b0\x1b0\x1b0\x1b0\x1b0\x1b1\x1b\n";
fputs($jdim, $str);
fputs($jdim, $strr);
while(!feof($fim)) {
$xxx = fgets($fim);
if(strpos($xxx, "\x1b".$_POST['nick']."\x1b") == 52) {
$double = "nick";
break;
} else if($usrname == trim(substr($xxx,5,15))) {
$double = "name";
break;
} else fputs($jdim, $xxx);
}
fclose($fim);
fclose($jdim);
if(!$double) {copy($dim."@@", $dim);$okok = explode("\x1b",$str);}
unlink($dim."@@");
if($wp = @fopen($dxr."welcome","r")) {
while(!feof($wp)) $wps .= fgets($wp);
fclose($wp);
if($wps) {
$wps = preg_replace("`[\r\n]`","",$wps);
$fim = fopen($dmo,"a");
fputs($fim, "010".str_pad($no,5,0,STR_PAD_LEFT)."00000".$time."\x1b관리자\x1b\x1b".$wps."\n");
fclose($fim);
$wps = 1;
}
}
} else $doble= 1;
if(!$doble) {
fclose(fopen($dxr."_member_/scrap_".$no,"w"));
fclose(fopen($dxr."_member_/diary_".$no,"w"));
fclose(fopen($dxr."_member_/list_".$no,"w"));
fclose(fopen($dxr."_member_/rp_".$no,"w"));
fclose(fopen($dxr."_member_/guest_".$no,"w"));
$fm=fopen($dxr."_member_/member_".$no,"w");
fputs($fm,"0\x1b0\x1b0\x1b100\x1b0\x1b".(int)$wps."\x1b0\x1b0\x1b0\x1b0\x1b0\x1b0\x1b");fclose($fm);
$fpt = fopen($dxr."_member_/point_".$no,"w");
fputs($fpt,$time."\x1b100\x1b회원가입환영\n");fclose($fpt);
}
else if($double == "name") scrhref('?',0,'아이디 중복 !!!');
else if($double == "nick") scrhref('?',0,'닉네임 중복 !!!');
} else scrhref('?',0,'아이디는 영문숫자15자 까지..');
}}} else if($mbr_level && $_POST['cnick'] && $_POST['cemail']) {
while($time - @filemtime($dim."@@") < 3) {usleep(50000);$time = time();}
$jdim = fopen($dim."@@","w");
$fim = fopen($dim,"r");
$xxx = '';
while(!feof($fim)) {
$xxx = fgets($fim);
if(trim(substr($xxx,5,15)) == $usrname && ($mbr_id == $usrname || $mbr_level == 9)) {
$okk = explode("\x1b", trim($xxx));
$pss = ($_POST['password2'])? md5(substr($okk[6],0,10).$_POST['password2']):substr($okk[0],20);
if($_POST['deletee'] == 'delete') {
$mrno = (int)substr($okk[0],0,5);
if($mbr_level == 9 || !$sett[63]) {
@unlink($dxr."_member_/scrap_".$mrno);
@unlink($dxr."_member_/diary_".$mrno);
@unlink($dxr."_member_/list_".$mrno);
@unlink($dxr."_member_/rp_".$mrno);
@unlink($dxr."_member_/point_".$mrno);
@unlink($dxr."_member_/member_".$mrno);
@unlink($dxr."_member_/guest_".$mrno);
@unlink($dxr."_member_/logged_".$mrno);
@unlink("icon/m02_".$mrno);
@unlink("icon/m80_".$mrno);
@unlink("icon/m20_".$mrno);
$xxx = substr($xxx,0,5)."\n";
} else if($mbr_no == $mrno) {
$fmo = fopen($dmo,"a");
fputs($fmo, "01100001".$mbr_n5.$time."\x1b".$_SESSION['m_nick']."\x1b\x1b회원탈퇴 신청합니다.<br />회원아이디 : ".$mbr_id."<br />회원번호 : ".$mbr_no."\n");
fclose($fmo);
chmbr($mbr_no,4,1);
chmbr(1,5,1);
}
} else if(isset($_POST['level']) && $mbr_level == 9) {
$xxx = substr($okk[0],0,20).$pss."\x1b".$_POST['cnick']."\x1b".$_POST['level']."\x1b".$_POST['cemail']."\x1b".$okk[4]."\x1b".$okk[5]."\x1b".$okk[6]."\x1b".$okk[7]."\x1b".(int)$okk[8]."\x1b".$okk[9]."\x1b".$okk[10]."\x1b".$okk[11]."\x1b".$okk[12]."\x1b".$okk[13]."\x1b".$okk[14]."\x1b".$okk[15]."\x1b\n";
} else if($mbr_level == 9 || $okk[3] == $_POST['cemail'] || ($sett[46] != 2 && $sett[46] != 3 && $_SESSION['rgstr'] == md5($uzip)) || $_SESSION[preg_replace("`[^0-9a-z]`i","",$_POST['cemail'])] = md5($_SERVER['REMOTE_ADDR'])) {
$xxx = substr($okk[0],0,20).$pss."\x1b".$_POST['cnick']."\x1b".$okk[2]."\x1b".$_POST['cemail']."\x1b".$_POST['postaddr'].",".$_POST['addrplus']."\x1b".$_POST['cellnumber'][0]."-".$_POST['cellnumber'][1]."-".$_POST['cellnumber'][2]."\x1b".substr($okk[6],0,10).$_POST['birthday'][0].$_POST['birthday'][1].$_POST['birthday'][2]."\x1b".$_POST['addinfo']."\x1b".(int)$_POST['public_postaddr'].(int)$_POST['public_cellnumber'].(int)$_POST['public_birthday'].(int)$_POST['public_gender']."\x1b".$_POST['gender']."\x1b".$_POST['blog']."\x1b".$_POST['mlog1']."\x1b".$_POST['mlog2']."\x1b".$_POST['mlog3']."\x1b".$_POST['mlog4']."\x1b".$_POST['mlog5']."\x1b\n";
}
}
fputs($jdim, $xxx);
}
fclose($fim);
fclose($jdim);
copy($dim."@@", $dim);
unlink($dim."@@");
if($mbr_id == $usrname) {
if($_POST['deletee'] == 'delete') {
if($mbr_level == 9 || !$sett[63]) {
ssckdxl();
} else scrhref(0,0,'관리자에게 탈퇴 신청했습니다.');
} else if($_POST['cnick'] != $_SESSION['m_nick']) $_SESSION['m_nick'] = $_POST['cnick'];
}
} else {
if(!$_POST['nick']) $okok = logincheck($usrname, $pssword);
if($okok[0]) {
if($_SESSION['mk']) {
ssckdxl();
}
$mbr_no = substr($okok[0], 0, 5);
$logged = $dxr."_member_/logged_".(int)$mbr_no;
if($sett[74] || !file_exists($logged) || $autologged || $time - filemtime($logged) > 60) {
if($_POST['autologin']) {
$cool5 = md5($cook.$_POST['password_3']);
setcookie($cook, $cool5, $time+864000);
while($time - @filemtime($dxr."_member_/autologin@@") < 3) {usleep(50000);$time = time();}
$jdat = fopen($dxr."_member_/autologin@@","w");
fputs($jdat, $cook.$mbr_no.$time.$cool5.$_POST['username_3']."\x1b".$_POST['password_3']."\n");
if(file_exists($dxr."_member_/autologin")) {
$ltime = $time - 864000;
$fat = fopen($dxr."_member_/autologin","r");
while(!feof($fat)) {
$xxx = fgets($fat);
if(substr($xxx,14,5) == $mbr_no || substr($xxx,19,10) < $ltime) $xxx = '';
fputs($jdat, $xxx);
}
fclose($fat);
}
fclose($jdat);
copy($dxr."_member_/autologin@@", $dxr."_member_/autologin");
unlink($dxr."_member_/autologin@@");
}
$mk = substr(md5($session_id),rand(1,25));
$_SESSION['mk'] = $mk;
$yid = md5($mk);
setcookie("mck", $yid);
$xid = md5($yid."\x1b".$mk);
$wid = "w".rand(1000,100000);
setcookie($xid, $wid);
$vid = "v".rand(10000,1000000);
$_SESSION[$wid] = $vid;
$mbr_no = (int)$mbr_no;
$_SESSION[$vid] = array($usrname,$mbr_no,$okok[2]);
$_SESSION['m_nick'] = $okok[1];
$vp = fopen($dxr."attend.dat","r");
$vt = fopen($tp,"w");
$tymd = date("Ymd");
$vpo = fgets($vp);
if(substr($vpo, 0, 8) == $tymd) {
if(false === strpos($vpo, "\x1b".$mbr_no."\x1b")) {
$vpo = trim($vpo).$mbr_no."\x1b\n";
$vok = 1;
} else $vok = 2;
fputs($vt, $vpo);
} else {
fputs($vt, $tymd."\x1b".$mbr_no."\x1b\n".$vpo);
$vok = 1;
}
while(!feof($vp)) {
fputs($vt, fgets($vp));
}
fclose($vp);
fclose($vt);
if($vok == 1) {
copy($tp, $dxr."attend.dat");
chmbr($mbr_no, 2, 1);
}
unlink($tp);
} else scrhref(0,0,'This is an ID that is already logged in');
}}
if($_POST['from']) scrhref($_POST['from'],0,0);
exit;
}
function sendckmail($mail) {
global $sett, $time;
$sesmail = preg_replace("`[^0-9a-z]`i","",$mail);
$sesvalue = md5(md5($sett[14]).$mail.$_SERVER['REMOTE_ADDR'].$time);
$_SESSION[$sesmail] = $sesvalue;
$_SESSION['eaddr'] = $sesmail;
$set14 = substr($sett[14],7);
$set14 = substr($set14,0,strpos($set14,"/"));
$mailcont = "<div style='font-family:\"Malgun Gothic\";font-size:11pt;border:1px solid #ddd;padding:10px;line-height:160%'><div style='background:#f6f6f6;border:1px solid #ddd;padding:4px;margin-bottom:20px'><div style='background:#fff;padding:5px'>안녕하세요 <span style='font-size:12pt;color:#FF6633'>\"{$sett[0]}\"</span> ({$set14}) 입니다.</div></div><div style='background:#000;width:400px;padding:10px 20px 10px 20px;color:#fff' >인증코드 : <input style='width: 280px' value='{$sesvalue}' onclick='this.select()'></div>인증코드 입력하는 부분에 넣어주세요<br />본 메일은 발송전용 메일입니다.</div>";
$mailsent = mail($mail, "=?UTF-8?B?".base64_encode("\"".$sett[0]."\" 회원인증 메일입니다.")."?=\n", $mailcont, "MIME-Version: 1.0\r\nContent-type: text/html; charset=UTF-8\r\nFrom:admin<admin@{$set14}>\r\nReply-To: admin@{$set14}\r\nX-Mailer: PHP/".phpversion());
if($mailsent) $output = "
메일을 발송했습니다.<br />
메일 내용에 있는 인증코드를 입력하세요.<br /><br />
<div class='mother'>
<div style='background:#F9F9F9; width:50px'>인증코드</div><div style='width:180px; background:#FFF'><input type='text' name='ckemailaddr' style='width:150px' onblur='thtck=this;ischeck(1,1)' /></div><div style='width:40px;border-right-width:1px;background:#D7D7D7'><input type='button' style='width:40px;background:#D7D7D7;cursor:pointer' value='입력' /></div></div>";
else $output = "<span style='color:red'>인증 메일이 발송되지 않았습니다.</span>";
return $output;
}
function authentication($emailaddr) {
global $dim;
if(trim($emailaddr) == $_SESSION[$_SESSION['eaddr']] && $_SESSION['eaddr'] == preg_replace("`[^0-9a-z]`i","",$_POST['email'])) {
if($_POST['fnumber']) {
$double = 2;
$jdim = fopen($dim."@@","w");
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(trim($xxx)) {
if($_POST['fnumber'] == substr($xxx,0,5)) {
$xxy = explode("\x1b",$xxx);
if($xxy[3] == $_POST['email']) {
$double = 1;
$psswrd = rand(100000,999999);
$xxx = substr($xxy[0],0,20).md5(substr($xxy[6],0,10).$psswrd).substr($xxx,52);
}}
fputs($jdim, $xxx);
}}
fclose($fim);
fclose($jdim);
if($double == 1) copy($dim."@@", $dim);
unlink($dim."@@");
if($double == 1) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>메일인증 확인</title>
<style type='text/css'>
body {overflow:hidden; font-size:9pt}
div.mother {border:1px solid #DDDDDD; padding:20px; width:334px; height:37px; background:#FFF}
div.mother div {float:left; border:1px solid #DDDDDD; border-right-width:0; padding:10px; height:15px}
div.first {width:95px}
</style></head>
<body>
<div style='position:absolute;top:20px;left:0;padding-left:17px'>
로그인해서, 비밀번호를 바꾸세요.<br /><br />
<div class='mother' style='width:323px;height:74px'>
<div class='first'>회원아이디</div><div class='second' style='border-right:1px solid #DDDDDD'><input type='text' class='txt' value='<?=trim(substr($xxy[0],5,15))?>' /></div>
<div class='first'>임시비밀번호</div><div class='second' style='border-right:1px solid #DDDDDD'><input type='text' class='txt' value='<?=$psswrd?>' /></div></div>
</div>
</body>
</html>
<?
}} else {
$_SESSION[$_SESSION['eaddr']] = md5($_SERVER['REMOTE_ADDR']);
$output = "<center><span style='color:black'>인증되었습니다.</span></center>";
}} else {$output = "<center><span style='color:red'>인증되지 않았습니다.</span></center>";if($_POST['fnumber']) echo $output;}
return $output;
}
if($_POST['bkcdid']) {
$mip = md5($_SERVER['REMOTE_ADDR']);
if(substr($_POST['bkcdid'],0,16) == substr($mip,0,16)) $value = explode(substr($mip,16),substr($_POST['bkcdid'],16));
$bkk = logincheck($value[1],$value[0]);
if($bkk[2] == '9' && $sett[37] && $_POST['bkcfolder'] == substr($dxr,5,-1)) {
$sndfldr = ($_POST['bkfrom'])? $_POST['bkfrom'].'/':$dxr;

echo "\xf7";
function dpfile($dpfl) {
global $sndfldr;
if(filesize($sndfldr.$dpfl) == 0) $dpv = '3';
else if($_POST['bkdpl'] == '2') $dpv = '1'.filesize($sndfldr.$dpfl).'|';
else if($_POST['bkdpl'] == '3') $dpv = '1'.filemtime($sndfldr.$dpfl).'|';
else $dpv = '1';
return $dpv.$dpfl;
}
if(!$_POST['bkfile']) {
function redr($bff,$accml) {
global $sndfldr;
$bf = opendir($sndfldr.$bff);
while($bfo = readdir($bf)) {
if($bfo != '.' && $bfo != '..') {
$dfo = $bff.$bfo;
if(is_file($sndfldr.$dfo)) $accml .= "\x1b".dpfile($dfo);
else {
echo "\x1b2".$dfo;
if($_POST['bksbdr']) $accml = redr($dfo.'/',$accml);
}}}
closedir($bf);
return $accml;
}
echo redr('','');
echo "\xf7";
} else {
if($fr = @fopen($sndfldr.$_POST['bkfile'],"r")) {
while(!feof($fr)) {echo fgets($fr);}
fclose($fr);
}}
echo "";
}
exit;
} else if($_POST['ckusername'] || $_POST['cknick'] || $_POST['ckemail'] || $_POST['ckemailaddr']) {
if(false !== strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])) {
header ("Content-Type: text/html; charset=UTF-8");
$_POST['cknick'] = urldecode($_POST['cknick']);
if($_POST['fndaddr']) login_failcnt(1);
if($_POST['ckemailaddr']) $rajax = authentication($_POST['ckemailaddr']);
else {
$okk = '';
$_POST['ckemail'] = urldecode($_POST['ckemail']);
if(!$_POST['ckemail'] || addrcheck($_POST['ckemail'])) {
if(!$_POST['ckusername'] || (strlen($_POST['ckusername']) <= 15 && preg_replace("`[0-9a-z_]`","",$_POST['ckusername']) == '')) {
if($fim = @fopen($dim,"r")) {
while(!feof($fim)) {
$xxx = trim(fgets($fim));
if($xxx) {
if($_POST['ckusername'] && trim(substr($xxx,5,15)) == $_POST['ckusername']) $okk = "아이디";
else if($_POST['cknick'] && strpos($xxx, "\x1b".$_POST['cknick']."\x1b") == 52) $okk = "닉네임";
else if($_POST['ckemail'] && strpos($xxx, "\x1b".$_POST['ckemail']."\x1b") > 54) {$okk = "이메일";if($_POST['fndaddr']) $fnumber = substr($xxx,0,5);}
if($okk) {
$rajax = "<span style='color:red'>이미 있는 {$okk}입니다.</span>";
break;
}}}
fclose($fim);
if($_POST['fndaddr']) {
if((int)$fnumber && $okk) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>인증코드 입력</title>
<style type='text/css'>
body {overflow:hidden; font-size:9pt}
div.mother {border:1px solid #DDDDDD; padding:20px; width:334px; height:37px; background:#FFF}
div.mother div {float:left; border:1px solid #DDDDDD; border-right-width:0; padding:10px; height:15px}
div.mother input {border:0; padding:0}
</style>
</head>
<body onload="if(eval(document.emafm.emailaddr)) document.emafm.emailaddr.focus();">
<script type='text/javascript'>
var thtck;
function ischeck() {
document.emafm.submit();
}
</script>
<form name='emafm' method='post' action='<?=$admin?>' style='position:absolute;top:20px;left:0;padding-left:17px' onsubmit="if(this.ckemailaddr.value=='') {alert('인증코드가 비었습니다.');return false;}">
<input type='hidden' name='email' value='<?=$_POST['ckemail']?>' /><input type='hidden' name='fnumber' value='<?=$fnumber?>' />
<?=sendckmail($_POST['ckemail'])?>
</form>
</body>
</html>
<?
exit;
} else {$rajax = "<script type='text/javascript'>alert('이메일주소가 정확하지 않습니다. (".login_failcnt(2)."/{$sett[53]})');location.replace('{$admin}?askaddr=1');</script>";}
} else if(!$okk) {
if(!$okk && $_POST['ckemail'] && ($sett[46] == $_POST['sett46'] || $sett[46] == 3)) $rajax .= sendckmail($_POST['ckemail']);
else $rajax .= "<span style='color:black'>사용 가능합니다.</span>";
}} else $rajax .= "<span style='color:black'>사용 가능합니다.</span>";} else $rajax .= "<span style='color:red'>아이디는 영문,숫자 15자 이내로.</span>";
} else $rajax .= "<span style='color:red'>사용할 수 없는 이메일입니다.</span>";
if($_POST['ckemail']) {
if(substr($rajax,19,5) == 'black') $_SESSION['rgstr'] = md5($uzip);
else if($_SESSION['rgstr']) $_SESSION['rgstr'] = '';
}
}
echo $rajax;
} exit;
} else if(isset($_POST['sign'])) {
if(false !== strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) && $mbr_no) {
$_POST['sign'] = str_replace("<?","",str_replace("?>","",stripslashes(urldecode($_POST['sign']))));
fputs($ss = fopen("icon/m02_".$mbr_no,"w"),$_POST['sign']);fclose($ss);
echo "success";
} exit;
} else {
if(count($_POST) > 0 && false === strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])) exit;
header ("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="srboard 38.00 " />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<? if($sett[31]) {?><link rel="shortcut icon" type="image/x-icon" href="http://<?=$_SERVER['HTTP_HOST']?>/favicon.ico" />
<?}?>
<style type='text/css'>
* {font-size:9pt; font-family:Gulim}
div.mother {border:1px solid #DDDDDD; padding:20px; width:334px; height:37px; background:#FFF}
div.mother div {float:left; border:1px solid #DDDDDD; border-right-width:0; padding:10px; height:15px}
div.first {background:#F9F9F9; width:50px}
div.second {width:180px; background:#FFF}
div.third {width:40px; border-right-width:1px; background:#D7D7D7}
input.txt {border:0; padding:0; width:150px}
input.sbmt {border:0; padding:0; width:40px; background:#D7D7D7; cursor:pointer}
</style>
<script type='text/javascript'>
//<![CDATA[
function $$(nae,n) {return document.getElementsByName(nae)[n];}
function $(nae) {return document.getElementById(nae);}
function nwopn(purl){
if(!window.open(purl,'_blank')) {
if(confirm('팝업이 차단되었습니다.페이지 이동하시겠습니까')) location.replace(purl);
}}
//]]>
</script>
<?
$sessnono = substr(preg_replace("`[^0-9]`","",$session_id),0,2);
if(strlen($sessnono) < 2) $sessnono = '99';
if($_GET['fram']) {
?>
<title>
<? 
if(false !== strpos($_SERVER['QUERY_STRING'], 'send=memo')) echo "쪽지 보내기";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'send=mail')) echo "메일 보내기";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'mst=')) echo "분류 편집";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'rss=')) echo "RSS 주소 편집";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'fm=')) echo "내용편집";
else if(false !== strpos($_SERVER['QUERY_STRING'], 'msect=')) echo "섹션 편집";
?></title><script type='text/javascript'>
//<![CDATA[
function resiz() {
$('frm').style.height = document.documentElement.clientHeight + 'px';
$('frm').style.width = document.documentElement.clientWidth + 'px';
var cwin = $('frm').contentWindow;
if(cwin){if(eval(cwin.onloaded)){cwin.onloaded();}}
}
window.onresize = function(){resiz();}
//]]>
</script>
</head>
<body onload="resiz()">
<iframe id="frm" src="<?=substr($_SERVER['QUERY_STRING'],5)?>" width="100%" height="100%" scrolling='auto'></iframe>
</body></html>
<?
exit;
}
if(($_POST['fmm'] || $_GET['fm'] || $_GET['fr']) && $mbr_level == 9) {
?>
<title>내용</title>
<style type='text/css'>
* {font-size:9pt; color:black; font-family:Gulimche}
body {background-color:#F0F0F0; margin:0; overflow:hidden}
.button {cursor:pointer; width:40px; border:1px solid black; background-color:#D7D7D7; padding:0}
</style>
<?
if($_POST['fmm']) {
if(isset($_POST['tex']) && !$_POST['replace_a']) {
@unlink($_POST['fmm']);
if($_POST['xfile'] != '1') {
$_POST['tex'] = str_replace("\r", "", str_replace("<//textarea>", "</textarea>", stripslashes($_POST['tex'])));
$fp = fopen($_POST['fmm'],"w");
fputs($fp, $_POST['tex']);
fclose($fp);
@chmod($_POST['fmm'],0777);
}
echo "<body onload=\"setTimeout('self.close()', 500)\" bgcolor='#F0F0F0'><div style='font-size:200px;text-align:center'>성공</div>";
} else if($_POST['replace_a']) {
function chslashes($val) {
$regula = array("\\d","\\D","\\f","\\n","\\r","\\s","\\S","\\t","\\v","\\w","\\W","\\p","\\x1b","\\x18");
$regulb = array("\d","\D","\f","\n","\r","\s","\S","\t","\v","\w","\W","\p","\x1b","\x18");
$val = str_replace("\\\\","\x1c",$val);
for($i = 0;$i < 14;$i++) $val = str_replace($regula[$i],$regulb[$i],$val);
$val = str_replace("\x1c","\\",$val);
return $val;
}
$_POST['replace_a'] = chslashes(stripslashes($_POST['replace_a']));
$_POST['replace_b'] = chslashes(str_replace("\r","",stripslashes($_POST['replace_b'])));
$replace_a = $_POST['replace_a'];
$osl = 0;
$osm = 0;
$osn = 0;
function changecontent($chfile) {
global $replace_a, $time, $osm;
while($time - @filemtime($chfile."@@") < 3) {usleep(50000);$time = time();}
$jms = fopen($chfile."@@","w");
$ms = fopen($chfile,"r");
while(!feof($ms)){
$mso = fgets($ms);
if($_POST['regular']) $msso = preg_replace("`{$replace_a}`i",$_POST['replace_b'],$mso);
else $msso = str_replace($replace_a,$_POST['replace_b'],$mso);
fputs($jms,$msso);
if($msso != $mso) $osm++;
}
fclose($ms);
fclose($jms);
copy($chfile."@@", $chfile);
unlink($chfile."@@");
return $osm;
}
if(file_exists($_POST['fmm'])) {
if(is_file($_POST['fmm'])) {$oso = $osm;$osm = changecontent($_POST['fmm']);$osn++;if($oso < $osm) $osl++;}
else {
function dirscan($dir) {
global $osl, $osm, $osn;
$fm = opendir($dir);
while($fmo = readdir($fm)) {
if(is_file($dir.$fmo)) {$fxt = strtolower(substr($fmo,-4));if($fxt[0] != '.' || $fxt[1] == 'b' || $fxt[1] == 'd' || $fxt[1] == 'p' || $fxt[1] == 't' || $fxt == '.htm') $oso = $osm;$osm = changecontent($dir.$fmo);$osn++;if($oso < $osm) $osl++;}
else if($fmo != '.' && $fmo != '..' && is_dir($dir.$fmo) && $fmo != 'files') list($osl,$osm,$osn) = dirscan($dir.$fmo.'/');
}
closedir($fm);
return array($osl,$osm,$osn);
}
if(substr($_POST['fmm'],-1) != '/') $_POST['fmm'] .= '/';
list($osl,$osm,$osn) = dirscan($_POST['fmm']);
}}
echo "<body bgcolor='#F0F0F0'><div style='font-size:50px;padding:35px 0 20px 30px'>검색한 파일 : {$osn}개<br />수정된 파일 : {$osl}개<br />교체된 횟수 : {$osm}개</div><center><a href='?fr={$_POST['fmm']}&a=".urlencode($_POST['replace_a'])."&b=".urlencode($_POST['replace_b'])."' style='color:#f63;font-size:40px;font-weight:bold;margin-bottom:10px'>계속</a></center>";
}
} else {
if($_GET['fm']) {
$filesize = @filesize($_GET['fm']);
if($filesize > 1048576) $_GET['fr'] = $_GET['fm'];
}
if(!$_GET['fr']) {
if($filesize > 0) {
$fp = fopen($_GET['fm'],"r");
$fpo = fread($fp, $filesize);
fclose($fp);
}
$fpo = str_replace('</textarea>', '<//textarea>',str_replace('&', '&amp;', $fpo));
if($_GET['euckr']) $fpo = iconv("CP949","UTF-8//IGNORE",$fpo);
?>
</head>
<body onload="onloaded()">
<form method='post' action='<?=$admin?>' style="margin:0 0 0 2px" onsubmit="if(getgm != this.fmm.value && !(confirm('이 경로로 저장하시겠습니까'))) return false;">
<input type='hidden' name='xfile' />
<input type='button' class='button' onclick="var nx=window.open('','_blank','width=600, height=600, resizable=yes, scrollbars=yes, status=none');nx.document.write($$('tex',0).value);" value="미리보기" style='width:60px' />
<? if($isie == 1) {?>&nbsp;&nbsp;<input type='button' class='button' onclick="var tex = $$('tex',0);tex.focus();tex.select();tex.createTextRange();execCommand('Copy')" value="복사" />
<?} else {?>&nbsp;&nbsp;<input type='button' class='button' onclick="var tex = $$('tex',0);tex.focus();tex.select()" value="전체선택" style="width:55px" /><?}?>
&nbsp;&nbsp;경로이름 : <input type='text' name='fmm' value='<?=$_GET['fm']?>' style='width:300px' />
&nbsp;<input type='submit' class='button' value="저장" />
&nbsp; <input type='button' class='button' onclick="self.close();" value="닫기" />
&nbsp; <input type='button' class='button' onclick="rexize(this)" value="창크게" />
&nbsp; <input type='button' class='button' onclick="cthrf()" value="이동" />
&nbsp; <input type='button' class='button' onclick="cthrf(8)" value="euc-kr" /><br />
<input type='button' class='button' onclick="findtxt()" value="검색" style='width:30px' />
<textarea id="replace_a" rows="1" cols="1" onclick="if(this.value=='Find_') this.value=''" style="width:27%;height:14px;overflow:hidden">Find_</textarea>
&nbsp;<input type='button' class='button' onclick="freplace()" value="검색교체" style='width:60px' />
&nbsp;<textarea id="replace_b" rows="1" cols="1" onclick="if(this.value=='Replace_') this.value=''" style="width:27%;height:14px;overflow:hidden">Replace_</textarea>
&nbsp;정규식 <input type='checkbox' id='regular' class='no' />
&nbsp;줄바꿈 <input type='checkbox' class='no' onclick='addline(this)' />
&nbsp;<input type='button' class='button' onclick="cfxfile()" value="파일삭제" style='width:60px' />
<div id="texx" style="overflow:auto;border:1px solid #d7d7d7"><textarea name="tex" rows="1" cols="1" onkeydown="texresiz(this)" style="width:100%;height:300px;overflow:hidden;line-height:15px;background:#FEFEFE url('icon/line_no.png') repeat-y;padding-left:22px;border:0">
<?=$fpo?>
</textarea></div>
</form>
<script type='text/javascript'>
//<![CDATA[
var getgm = '<?=$_GET['fm']?>';
function texresize() {
var txw = parent.window.document.documentElement.clientWidth - 10;
var txh = parent.window.document.documentElement.clientHeight - 55;
var teh = $$('tex',0).scrollHeight;
teh = (txh > teh)? txh:teh;
$$('tex',0).style.width=txw - 38 + 'px';
$('texx').style.width=txw + 'px';
$$('tex',0).style.height=teh + 'px';
$('texx').style.height=txh + 'px';
setTimeout("texresiz($$('tex',0))",20);
}
var texwidth;
function addline(ths) {
if(ths.checked) {
texwidth = $$('tex',0).style.width;
$$('tex',0).style.width="1000000000px";
$$('tex',0).style.overflowX="auto";
} else {
$$('tex',0).style.width=texwidth;
$$('tex',0).style.overflowX="hidden";
}}
function texresiz(ths) {
var th=parseInt(ths.style.height);
var nh=ths.scrollHeight<? if($bwr == 'chrome') echo "-4";?>;
if(th < nh) ths.style.height=th+13+'px';
parent.document.title = "내용편집 - " + parseInt((th - 7)/15) + "줄";
}
function rexize(that) {
var mw=window.screen.availWidth;
var mh=window.screen.availHeight;
if(navigator.appVersion.indexOf('MSIE') != -1) {
if(mw - parseInt(dialogWidth) > 10) {dialogWidth=mw +'px';dialogHeight=(mh-70) +'px';that.value='창작게';}else{dialogWidth='807px';dialogHeight='427px';dialogTop=(mh-427)/2;dialogLeft=(mw-807)/2;that.value='창크게';}
} else {
if(mw - window.innerWidth > 10){resizeTo(mw,mh);that.value='창작게';if(navigator.appVersion.indexOf('Chrome') == -1) moveTo(window.screen.width-mw,0);}else{resizeTo(815,516);that.value='창크게';if(navigator.appVersion.indexOf('Chrome') == -1) moveTo((mw-815)/2,(mh-516)/2);}
}
}
function cfxfile() {
if(confirm('이 파일을 삭제하시겠습니까')) {
$$('xfile',0).value='1';
document.getElementsByTagName('form')[0].submit();
}}
function cthrf(euc) {
var thre = $$('fmm',0).value;
var cthr = encodeURIComponent(thre);
if(euc && getgm == thre && "<?=urlencode($_GET['fm'])?>" != cthr) cthr = "<?=urlencode($_GET['fm'])?>";
var ctjr = '?fm=' + cthr.replace(/%2F/g,'/');
if(euc) ctjr += '&euckr=1';
$$('fmm',0).value = '<?=$_GET['fm']?>';
if('<?=$isie?>' == '1') opener = dialogArguments;
opener.popup(ctjr, 800, 400);
}
function freplace() {
var old = $('replace_a').value;
if($('regular').checked != true) old = old.replace(/([\(\)\{\}\[\]\.\?\+\*\|\^\$\\])/gi,"\\$1");
old = new RegExp(old,'gi');
var neo = $('replace_b').value;
$$('tex',0).value = $$('tex',0).value.replace(old,neo);
}
var iefn = 0;
function findtxt() {
var old = $('replace_a').value;
<? if($isie == 1) {?>
var tx=$$('tex',0).createTextRange();
for(var i=0;i <= iefn && (found=tx.findText(old)) != false; i++){tx.moveStart("character",old.length);tx.moveEnd("textedit");} if(found){tx.moveStart("character",-old.length);tx.findText(old);tx.select();tx.scrollIntoView();iefn++;} else {iefn = 0;alert("검색결과가 없습니다.");}
<?} else if($bwr != 'opera') {?>
document.createRange();window.find(old, true, false, true, false, true, false);
<?} else echo "alert('opera는 지원안됩니다.');";?>
}
function onloaded() {
setTimeout('texresize()',20);
parent.window.document.body.style.overflow='hidden';
}
top.document.title = '내용편집';
window.onresize = function(){onloaded();}
//]]>
</script>
<?
} else {
$a = ($_GET['a'])? $_GET['a']:'Find_';
$b = ($_GET['b'])? $_GET['b']:'Replace_';
?>
<center style='padding-top:30px'><span style='font-size:15pt;font-weight:bold'>검색교체</span><br /><br />
<form method='post' action='<?=$admin?>'>
<div style='width:380px;text-align:right'><label>정규식 <input type='checkbox' name='regular' class='no' /></label></div>
&nbsp;&nbsp;경로 : <input type='text' name='fmm' value='<?=$_GET['fr']?>' style='width:330px' /><br />
&nbsp;&nbsp;검색 : <textarea name="replace_a" rows="1" cols="1" onclick="if(this.value=='Find_') this.value=''" style="width:330px;height:14px;overflow:hidden"><?=$a?></textarea><br />
&nbsp;&nbsp;교체 : <textarea name="replace_b" rows="1" cols="1" onclick="if(this.value=='Replace_') this.value=''" style="width:330px;height:14px;overflow:hidden"><?=$b?></textarea><br /><br />
<input type='submit' class='button' value="검색교체" style='width:60px' />
&nbsp; &nbsp; <input type='button' class='button' onclick="self.close();" value="Close" />
</form></center>
<script type='text/javascript'>
top.document.title = '검색교체';
</script>
<?
}
}
} else if($_GET['askaddr']) {
?>
<title>메일주소 입력</title>
<style type='text/css'>
body {overflow:hidden}
</style></head>
<body onload="setTimeout('document.emafm.ckemail.focus()',100);">
<form name='emafm' method='post' action='<?=$admin?>' style='position:absolute;top:20px;left:0;padding-left:17px' onsubmit="if(this.ckemail.value=='') {alert('메일주소가 비었습니다.');return false;}"><input type='hidden' name='fndaddr' value='1' />
가입할때 등록한 메일 주소를 입력하세요<br /><br />
<div class='mother'>
<div class='first'>메일주소</div><div class='second'><input type='text' name='ckemail' class='txt' /></div><div class='third'><input type='submit' class='sbmt' value='입력' /></div></div>
</form>
</body>
</html>
<?
} else if($_GET['loading']) {
?><html><head></head><body style="background:url('icon/loading.gif') no-repeat 50% 50%;width:100%;height:100%;overflow:hidden">&nbsp;</body></html><?
} else {
if($mbr_id && $mbr_level) {
if($mbr_level >= 1){
?>
<style type='text/css'>
* {font-size:9pt; font-family:Gulim; line-height:130%}
body {margin:0}
a {color:black}
a:link {text-decoration:none}
a:visited {text-decoration:none}
a:hover {text-decoration:underline}
input {width:50px; height:15px; font-size:11px; border:0; margin:4px 0 0 0; padding:1px 0 1px 0; border-width:0px 0 1px 0px; border-style:solid; border-color:black; background-color:transparent}
.button {cursor:pointer; width:40px; border:1px solid black; background-color:#D7D7D7; padding:0}
.no {cursor:pointer; border:0; width:14px; height:14px; margin:0 0 3px 0; vertical-align:middle}
.mgn5 {width:15px; height:15px; margin-left:7px; margin-right:7px}
.f7 {font-family:tahoma,Gulim; font-size:7pt; color:#808080}
.f8, .f8 a:link, .f8 a:hover, .f8 a:visited, .f8 a:active{font-family:verdana,Gulim; font-size:11px; letter-spacing:-1px; color:#B9AFAB}
.b8 {font-size:11px; letter-spacing:-1px}
.section_title {margin:7px 0 0px 0px; float:left; padding:6px 15px 9px 15px; text-align:center; font-size:9pt; font-family:Gulim; color:#FAFFFF; cursor:pointer; font-weight:bold}
.section_title2 {margin:6px 0 0px 0px; float:left; padding:8px 15px 8px 15px; text-align:center; font-size:9pt; font-family:Gulim; color:#373737; cursor:pointer; font-weight:bold; background-color:#F7F7F7}
.section_title_between {margin-top:10px; border-style:solid; border-color:#0F408F #5185D8 #5185D8 #0F408F; border-width:1px; height:15px; float:left; width:1px}
.section_title_between2 {margin-top:10px; height:15px; float:left; width:3px}
.ttb {background-color:#F7F7F7; width:100%}
.bboder {border-style:solid; border-width:1px; border-color:#BDC6D6 #FFFFFF #FFFFFF #BDC6D6; background-color:#FFFFFF}
.cltr {background-color:#2A5EB2; height:35px}
.cltr td {text-align:center; color:#FAFFFF; font-weight:bold; border-top:1px solid #5289CC}
.cltb {width:100%; background-color:#F7F7F7}
.cltb td {text-align:center}
#sectcenter input {border:1px solid #A3C6FF; font-size:9pt; height:18px; width:30px}
#sectcenter input:hover {background-color:#D6E6FF}
span, select, textarea {vertical-align:middle}
#sectleft, #sectright {padding:5px;width:166px;border:1px solid #2A5EB2;background-color:#A3C6FF}
#sectleft .subs,  #sectright .subs {width:110px; cursor:pointer}
#sectcenter .out {border:1px solid #000000; text-align:center; width:20px; margin-left:5px; cursor:pointer}
#sectcenter .up,  input.uparrow {border:1px solid #000000; text-align:center; width:20px; margin-right:5px; cursor:pointer}
#sectcenter .blue a, #sectcenter .blue a:link, #sectcenter .blue a:hover {color:#2A5EB2; font-weight:bold}
#admtip,#admtip2 {height:25px;text-align:left;background-color:#E6FFA3;border:1px solid #5185D8;padding:10px 0 0 10px;margin:0 auto 0 auto;width:920px;position:fixed;bottom:10px}
#secxplain {background-color:#EAEAEA; text-align:left; padding:5px; width:380px}
#secxplain .red {color:#FF6633; font-weight:bold}
#secxplain .blue {font-size:11px; color:#0010ED}
#gatewidget div {float:left; width:137px; height:22px; text-align:left}
.graph .title {text-align:left;padding-left:10px; background:#2A5EB2; color:#FFF; height:30px}
.exsett {display:none}
.exsett h4 {background:#EAEAEA; font-size:9pt; padding:3px 0 3px 0; margin:0}
#graph_hour {width:100%}
#graph_hour td {width:39px}
#graph_browser {width:100%}
#graph_browser td {width:12.5%}
#graph_month {width:100%}
#graph_month div {float:left; width:30px; margin-right:1px}
.table {background-color:#EAEAEA; margin-top:10px}
.table td {background-color:#FFF}
.table .title {background:#909DB2; color:#FFF; height:30px}
.table td.title {width:100%}
.table div {background-color:#3A5E90; text-align:center; color:#FFF; padding-top:6px}
.table span.f7 {color:#FCFC00}
select.w30 {width:33px}
.linew {border-top:1px solid #D4D4D4;border-bottom:1px solid #FFFFFF}
tr.cnt td, td.cnt {font-family:tahoma; font-size:7pt; color:#C24636}
#mbclass {float:left; padding-left:5px}
#mbclass span img {cursor:pointer}
#mbclass span * {vertical-align:middle}
label {cursor:pointer}
.bdhdr {background-color:#EAEAEA;text-align:center}
.bdhdr td {font-size:12px}
.bdhdr span {font-size:11px}
td.cbox a {display:block}
td.cbox a:hover {border:1px solid #FF6633}
.p_no {color:#FF6633; font-weight:bold}
.pageno {font-family:Dotum; font-size:11px; color:#D6D6D6; text-align:center; letter-spacing:1px; color:#4B4B4B}
.pageno td font {display:block; padding:4px 0px 4px 0px; margin:1px}
.pageno td a {display:block; padding:4px 6px 4px 6px; margin:1px}
.pageno a:hover {border:1px solid #BABABA; text-decoration:none; margin:0}
</style>
<!--[if IE]>
<style type='text/css'>
td, div {word-break:break-all; text-overflow:ellipsis}
</style>
<![endif]-->
<script type='text/javascript'>
//<![CDATA[
function popup(url, wt, ht) {
var mleft = (screen.width - wt) / 2;
var mtop = (screen.height - ht) / 2;
if(window.showModelessDialog) {
var pten = (navigator.appVersion.indexOf('MSIE 6') != -1)? 10:0;
wt = wt + 7 + pten;
ht = ht + 27 + pten;
var win = window.showModelessDialog('?fram='+url, window,  'dialogWidth:'+ wt +'px;dialogHeight:'+ ht +'px; resizable:Yes; center:Yes; status:No; help: No; scroll:No; dialogtop:'+ mtop +'px; dialogleft:'+ mleft +'px;');
} else {
wt += 7;
ht += 26;
var win = window.open(url,'_blank','location=no,resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,width='+ wt +'px,height='+ ht +'px,left='+ mleft +'X,top='+ mtop +'Y');
}
win.focus();
}
function read(read) {
if(read == 'get'||read == 'post') popup('<?=$exe?>?memo='+read,400,300);
else popup(read,850,650);
}
function send(mm, no, to) {
popup('<?=$exe?>?send='+mm+'&no='+no+'&to='+to,310,250);
}
function chbase(str) {
var str_1 = '';
var str_2 = '';
for(var i=str.length -1;i >= 0;i--){
str_1 += (str.charCodeAt(i) + <?=$sess?>).toString(34);
}
for(var i=str_1.length -1;i >= 0;i--){
str_2 += (str_1.charCodeAt(i)).toString(18);
}
return str_2;
}
//]]>
</script>
<?
if(!$_GET['ectgt'] && !$_GET['sect_arr']) {?>
<title>회원정보</title>
</head>
<body>
<?
}
$dmo1 = $dxr."memo1.dat";
$dmo2 = $dxr."memo2.dat";
if($_GET['pointcal'] || $_GET['allpntcal'] || $_GET['allbakcal']) {
function calpoint($dir, $mpnt, $psq, $mno) {
$poit0 = (int)substr($psq[7],10,5);
$poit1 = (int)substr($psq[7],15,5);
$poit2 = (int)$psq[9][6];
$poit3 = (int)substr($psq[9],7,4);
$poit4 = (int)$psq[7][5];
$poit5 = (int)$psq[0][62];
$fpx = '';
$fp = fopen($dir."/no.dat","r");
while($fpo = trim(fgets($fp))) {if($fpo) {if(substr($fpo,6,2) == 'aa') $fpx[] = substr($fpo,0,6);
else if(($fpp = strpos($fpo,"\x1b")) > 9) {$fpp=substr($fpo,9,$fpp -9);if(!$mno || $mno == $fpp) {
$mpnt[$fpp][0] += 1;$mpnt[$fpp][6] += $poit0;if(!$poit5) $mpnt[$fpp][12] += 1;
if($poit2 && $poit3) {$fpe = explode("\x1b",$fpo);if($fpe[5]) {$fpf = explode("|",$fpe[5]);$fpg = 0;
if(!$poit4) {if($poit2 == 1) $fpg = $fpf[0];else if($poit2 == 2) $fpg = -$fpf[1];else $fpg = $fpf[0] - $fpf[1];}
else if($fpf[1]) $fpg = ($fpf[0]/$fpf[1] - 2.5)*$fpf[1];
if($fpg) $mpnt[$fpp][11] += $fpg*$poit3/100;
}}}}}}
fclose($fp);
$fp = fopen($dir."/rlist.dat","r");
while($fpo = trim(fgets($fp))) {if($fpo) {$fpp = (int)substr($fpo,24,5);if($fpp) {if(!$mno || $mno == $fpp) {if(!$fpx || !in_array(substr($fpo,0,6),$fpx)) {
$mpnt[$fpp][1] += 1;$mpnt[$fpp][7] += $poit1;if(!$poit5) $mpnt[$fpp][13] += 1;
}}}}}
fclose($fp);
return $mpnt;
}
function bkmbpt($dxr, $key, $mpnt, $mpny, $jmjn) {
if($mpny) $jno = $mpnt[$key];
else if(!$jmjn) {
$jno = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
if($jn = @fopen($dxr.'_member_/bak_'.$key,'r')) {
$jno = explode("\x1b",fgets($jn));fclose($jn);
unlink($dxr.'_member_/bak_'.$key);
}}
if($jn = @fopen($dxr.'_member_/member_'.$key,'r')) {
$jmo = explode("\x1b",fgets($jn));fclose($jn);
if($jmjn) $jno = $jmo;
}
$jno[3] = 0;
if($dp = @fopen($dxr.'_member_/point_'.$key,'r')) {
while($dpo = substr(fgets($dp),11)) {
$dpo = substr($dpo,0,strpos($dpo,"\x1b"));
if($dpo) $jno[3] += $dpo;
}
fclose($dp);
}
$jn = fopen($dxr.'_member_/member_'.$key,'w');
fputs($jn,$jno[0]."\x1b".$jno[1]."\x1b".$mpnt[$key][2]."\x1b".$jno[3]."\x1b".$mpnt[$key][4]."\x1b".$mpnt[$key][5]."\x1b".$jno[6]."\x1b".$jno[7]."\x1b".$jmo[8]."\x1b".$jmo[9]."\x1b".$jmo[10]."\x1b".$jno[11]."\x1b".$jno[12]."\x1b".$jno[13]."\x1b");
fclose($jn);
}
function dmatt() {
global $dmo,$dmo1,$dmo2,$dxr;
$dmtt = '';
if($dp = @fopen($dmo,"r")) {
while(!feof($dp)) {
$dpo = fgets($dp);
if(substr($dpo,1,1) == 1) $dmtt[(int)substr($dpo,3,5)][5] += 1;
if(substr($dpo,2,1) == 1) $dmtt[(int)substr($dpo,8,5)][4] += 1;
} fclose($dp);}
if($dp = @fopen($dmo1,"r")) {
while(!feof($dp)) {
$dpo = fgets($dp);
if(substr($dpo,1,1) == 1) $dmtt[(int)substr($dpo,3,5)][5] += 1;
if(substr($dpo,2,1) == 1) $dmtt[(int)substr($dpo,8,5)][4] += 1;
} fclose($dp);}
if($dp = @fopen($dmo2,"r")) {
while(!feof($dp)) {
$dpo = fgets($dp);
if(substr($dpo,1,1) == 1) $dmtt[(int)substr($dpo,3,5)][5] += 1;
if(substr($dpo,2,1) == 1) $dmtt[(int)substr($dpo,8,5)][4] += 1;
} fclose($dp);}
if($dp = @fopen($dxr."attend.dat","r")) {
while(!feof($dp)) {
$dpo = explode("\x1b",substr(trim(fgets($dp)),9,-1));
foreach($dpo as $dpp) {
$dmtt[$dpp][2] += 1;
}} fclose($dp);}
return $dmtt;
}
}
if($_POST['rsse'] || $_GET['rss']) {
$id = ($_POST['rsse'])? $_POST['rsse']:$_GET['rss'];
if($_POST['rsse']) {
while($time - @filemtime($dc."@@") < 3) {usleep(50000);$time = time();}
$jdc = fopen($dc."@@","w");
}
$fs = fopen($ds,"r");
$fc = fopen($dc,"r");
while(!feof($fs) && $sss = fgets($fs)){
$fco = fgets($fc);
if(trim(substr($sss, 0, 10)) == $id) {
$dct = explode("\x1b",substr($fco,1));
$wdth = explode("\x1b", $sss);
$limt_w = substr($sss, 24, 1);
if($mbr_level != 9 && (!$mbr_id || $mbr_id != $wdth[3])) {
$exit = 1;
break;
} else if($_POST['rsse']) {
$fco = "\x1b";
$cnt = count($_POST['rct']);
for($i = 0; $i < $cnt; $i++) {
if($_POST['rct'][$i]) $fco .= $_POST['rct'][$i].str_pad(substr($dct[$i],-6),6,0,STR_PAD_LEFT)."\x1b";
else if($i < $cnt -2 && $dct[$i]) $fco .= str_pad(substr($dct[$i],-6),6,0,STR_PAD_LEFT)."\x1b";
}
$fco = $fco."\n";
} else break;
}
if($_POST['rsse']) fputs($jdc, $fco);
}
fclose($fs);
fclose($fc);
if($_POST['rsse']) {
if($exit != 1) copy($dc."@@", $dc);
unlink($dc."@@");
}
if($exit != 1) {
if($_POST['rsse']) {
$fsr = fopen($dxr.$_POST['rsse']."/rss.dat","w");
for($i = 0; $i < $cnt; $i++) {
if($_POST['rssu'][$i]) fputs($fsr,(int)$_POST['rssb'][$i].$_POST['rssu'][$i]."\n");
else if($i < $cnt -2 && $dct[$i]) fputs($fsr,"\n");
}
fclose($fsr);
scrhref('?rss='.urlencode($_POST['rsse']),0,0);exit;
} else if($_GET['rss']) {
$file = @file($dxr.$_GET['rss']."/rss.dat");
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr' style='text-align:center'><td style='border-color:#5289CC;border-style:solid;border-width:1px 0 0px 1px;width:10%;'>번호</td><td style='border-top:1px solid #5289CC;border-style:solid;border-width:1px 0 0px 0px;width:55%;'>RSS 주소편집</td><td style='border-top:1px solid #5289CC;width:10%;' title='본문기록여부'>본문</td><td style='border-color:#5289CC;border-style:solid;border-width:1px 1px 0 0px;width:25%;'>분류이름</td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px'>
<table cellpadding='5px' cellspacing='0px' class='cltb'>
<form method='post' action='<?=$admin?>' style="margin:0">
<input type='hidden' name='rsse' value='<?=$_GET['rss']?>' />
<colgroup><col width='10%' /><col width='55%' /><col width='10%' /><col width='25%' /></colgroup>
<?
if($fr = @fopen($dxr.$_GET['rss']."/rss.dat","r")) {
$i = 0;
while(!feof($fr)) {
if(($fro = fgets($fr)) && trim($dct[$i])) {
?>
<tr><td><?=$i+1?></td><td><input type='text' name='rssu[]' value='<?=substr($fro,1)?>' style='width:100%' /></td><td><input type='checkbox' value='<?=substr($fro,0,1)?>' onclick='this.nextSibling.value=(this.checked)? 1:0;' style='border:0' <? if(substr($fro,0,1) == 1) echo "checked='checked'";?> /><input type='hidden' name='rssb[]' value='<?=substr($fro,0,1)?>' /></td><td><input type='text' name='rct[]' value='<?=substr($dct[$i],0,-6)?>' style='width:100%' /></td></tr>
<?
}
$i++;
}
fclose($fr);
}
?>
<tr><td>new</td><td><input type='text' name='rssu[]' value='' style='width:100%' /></td><td><input type='checkbox' name='rssb[]' value='0' onclick='this.value=(this.checked)? 1:0;' style='border:0'  /></td><td><input type='text' name='rct[]' value='' style='width:100%' /></td></tr>
<tr><td colspan='4'><input type='submit' class='button' value='입력' /> &nbsp; &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' /></td></tr>
</table>
</form>
</td></tr></table>
<script type='text/javascript'>document.title='RSS 주소편집';</script>
<?
}
}
exit;
} else if($_GET['pointcal']) {
if($_GET['pointcal'] == $mbr_no || $mbr_level == 9) {
$_GET['pointcal'] = (int)$_GET['pointcal'];
$mpnt = dmatt();
$fs = fopen($ds,"r");
while(!feof($fs)) {
$fso = fgets($fs);
$path = trim(substr($fso,0,10));
if($path) {
$wdth = explode("\x1b",$fso);
$mpnt = calpoint($dxr.$path, $mpnt, $wdth, $_GET['pointcal']);
while($wdth[6] > 0) {
$mpnt = calpoint($dxr.$path."/^".$wdth[6], $mpnt, $wdth, $_GET['pointcal']);
$wdth[6]--;
}
} else break;}
fclose($fs);
bkmbpt($dxr, $_GET['pointcal'], $mpnt, 1, 0);
if($_GET['request'] == 'mbr_info') scrhref($index.'?mbr_info=1'.(($_GET['pointcal'] != $mbr_no)? '&amp;mbr='.$_GET['pointcal']:''),0,0);
scrhref('?pview='.$_GET['pointcal'],0,0);
} exit;
} else if($_GET['pview']) {
if($_GET['pview'] == $mbr_no || $mbr_level == 9) {
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr'><td style='border-color:#5289CC;border-style:solid;border-width:1px 0 0px 1px;width:70px'>날짜</td><td style='border-color:#5289CC;border-style:solid;border-width:1px 0 0 0;width:70px'>포인트</td><td style='border-color:#5289CC;border-style:solid;border-width:1px 1px 0 0px;width:280px'>내역</td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px'>
<form method='post' action='<?=$admin?>' style="margin:0" onsubmit="if($$('pvw1',0).value == '') return false">
<input type='hidden' name='pvw' value='<?=$_GET['pview']?>' />
<table cellpadding='3px' cellspacing='0px' class='cltb'>
<colgroup><col width='70px' /><col width='70px' /><col width='280px' /></colgroup>
<?
$total = 0;
if($fpt = @fopen($dxr."_member_/point_".$_GET['pview'],"r")) {
while($fpto = fgets($fpt)) {
$cpt = explode("\x1b", trim($fpto));
$total += $cpt[1];
?>
<tr><td><?=date("y/m/d",$cpt[0])?></td><td><?=$cpt[1]?></td><td><?=$cpt[2]?></td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<?
}
fclose($fpt);
}
$jn = fopen($dxr.'_member_/member_'.$_GET['pview'],'r');
$jno = explode("\x1b",fgets($jn));fclose($jn);
?>
<tr><td>=</td><td><?=$jno[3]?></td><td></td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?=$jno[6]?></td><td style='text-align:left'>&lt;= 쓴글 (<?=$jno[0]?>개) 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?=$jno[7]?></td><td style='text-align:left'>&lt;= 덧글 (<?=$jno[1]?>개) 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?=$jno[8]?></td><td style='text-align:left'>&lt;= 다운로드 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?=$jno[9]?></td><td style='text-align:left'>&lt;= 읽은글 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?=$jno[10]?></td><td style='text-align:left'>&lt;= 추천한 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?=$jno[11]?></td><td style='text-align:left'>&lt;= 추천받은 포인트</td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>+</td><td><?=$jno[2]*$sett[18]?></td><td style='text-align:left'>&lt;= 출석수 <?=$jno[2]?> * 배점 <?=$sett[18]?></td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<tr><td>합계</td><td colspan='2' style='text-align:left'><?=(float)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]?></td></tr>
<tr><td colspan='3'><div class='linew'><img src='icon/t.gif' alt='' /></div></td></tr>
<?
if($mbr_level == 9) {
?>
<tr><td>new</td><td><input type='text' name='pvw1' style='width:100%' /></td><td><input type='text' name='pvw2' style='width:100%' /></td></tr>
<?
}
?>
<tr><td colspan='3'><? if($mbr_level == 9) {?><input type='submit' class='button' value='추가' /> &nbsp; &nbsp; <?}?><input type='button' class='button' value='재계산' onclick='location.href="?pointcal=<?=$_GET['pview']?>"' /> &nbsp; &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' /></td></tr>
<tr style='background-color:#D4D4D4'><td colspan='3'></td></tr>
</table></form></td></tr></table>
<script type='text/javascript'>top.document.title='포인트내역';</script>
</body>
</html>
<?
}
exit;
}
$fmo = fopen($dmo,"r");
while(!feof($fmo)) {
if(substr(fgets($fmo),3,5) == $mbr_n5) {
?><script type='text/javascript'>function rmemo() {if($('nmemo')) {$('nmemo').innerHTML="<br /><a href='#none' onclick=\"read('get')\"><b>[쪽지가 도착했습니다]</b></a><embed src='<?=$sett[14]?>icon/memo.wav' type='application/x-mplayer2' autostart='true' loop='0' style='width:1px;height:1px' />";$('nmemo').style.display='block';}} setTimeout('rmemo()', 500);</script><?
break;
}
}
fclose($fmo);
if($mbr_level == 9) {
if($_GET['ectgt'] || ($_POST['ectn'] && isset($_POST['ectg']))) {
include "include/gatedit.php";
exit;
} else if($_GET['allpntcal']) {
$mpnt = array();
$fs = fopen($ds,"r");
for($i = 1;$i < $_GET['allpntcal'];$i++) fgets($fs);
$fso = fgets($fs);
fclose($fs);
$path = trim(substr($fso,0,10));
if($path) {
$wdth = explode("\x1b",$fso);
$mpnt = calpoint($dxr.$path, $mpnt, $wdth, 0);
while($wdth[6] > 0) {
$mpnt = calpoint($dxr.$path."/^".$wdth[6], $mpnt, $wdth, 0);
$wdth[6]--;
}
if($mpnt) {
foreach($mpnt as $key => $value) {
$jno = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
if($jn = @fopen($dxr.'_member_/bak_'.$key,'r')) {
$jno = explode("\x1b",fgets($jn));fclose($jn);}
$jn = fopen($dxr.'_member_/bak_'.$key,'w');
$jno[0] += (int)$value[0];
$jno[1] += (int)$value[1];
$jno[6] += (int)$value[6];
$jno[7] += (int)$value[7];
$jno[11] += (float)$value[11];
$jno[12] += (float)$value[12];
$jno[13] += (float)$value[13];
fputs($jn,$jno[0]."\x1b".$jno[1]."\x1b".$jno[2]."\x1b".$jno[3]."\x1b".$jno[4]."\x1b".$jno[5]."\x1b".$jno[6]."\x1b".$jno[7]."\x1b".$jno[8]."\x1b".$jno[9]."\x1b".$jno[10]."\x1b".$jno[11]."\x1b".$jno[12]."\x1b".$jno[13]."\x1b");
fclose($jn);
}}
scrhref("?allpntcal=".($_GET['allpntcal'] + 1),0,0);
} else scrhref("?allbakcal=1",0,0);
exit;
} else if($_GET['allbakcal']) {
$mpnt = dmatt();
if($_GET['allbakcal'] == 1) {
$omb = opendir($dxr."_member_");
while($ombr = readdir($omb)) {
if(substr($ombr,0,7) == 'member_') {
$key = substr($ombr,7);
if(!file_exists($dxr."_member_/bak_".$key)) bkmbpt($dxr, $key, $mpnt, 0, 1);
}}
closedir($omb);
scrhref("?allbakcal=2",0,0);
} else {
$a = 0;
$omb = opendir($dxr."_member_");
while($ombr = readdir($omb)) {
if(substr($ombr,0,4) == "bak_") {
$key = substr($ombr,4);
if(!file_exists($dxr."_member_/member_".$key)) unlink($dxr."_member_/bak_".$key);
else {
if($a == 100) break;
$a++;
bkmbpt($dxr, $key, $mpnt, 0, 0);
}}}
closedir($omb);
if($a == 100) scrhref("?allbakcal=".($_GET['allbakcal'] + 1),0,0);
else scrhref("?member=1",0,0);
}
exit;
} else if($_GET['sect_arr']) {
include "include/section_arr.php";
exit;
} else if($_GET['sect_group']) {
$i = 1;
if($st = @fopen($dxr."section.dat","r")) {
while($sto = fgets($st)) {
if($i == $_GET['sect_group']) {
$stn = explode("\x1b",$sto);
$stnm = explode(",",$stn[5]);
break;
}
$i++;
}
fclose($st);
}
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr'><td style='border-color:#5289CC;border-style:solid;border-width:1px 1px 0px 1px;width:50px'>[<?=$stn[0]?>] 소모임 설정</td></td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px'>
<form method='post' action='<?=$admin?>' style="margin:0;">
<input type='hidden' name='gtm' value='<?=$_GET['sect_group']?>' />
<table cellpadding='3px' cellspacing='0px' class='cltb'>
<colgroup><col width='110px' /><col width='170px' /><colgroup>
<tr><td>소모임/섹션 관리자</td><td><input type='text' name='group[]' value='<?=$stn[3]?>' style='width:100%' title='회원번호입력' /></td></tr>
<tr><td>소모임 가입제한</td><td><select name='group[]'><option value='0'>사용안함</option><option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option><option value='9'>관리자만</option></select></td></tr>
<tr><td>소모임 가입회원</td><td>
<?
for($i = 1;$stnm[$i];$i++) {
?>
<input type='text' name='group[]' value='<?=$stnm[$i]?>' style='width:100%' /><br />
<?
}
?>
</td></tr>
<tr><td>소모임 신규회원</td><td><input type='text' name='group[]' value='' style='width:100%' title='회원번호입력' /></td></tr>
<tr><td colspan='2'><input type='submit' class='button' value='입력' /> &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' />
<fieldset style='margin-top:5px;text-align:left'><span style='color:#2A5EB2;font-weight:bold'>소모임/섹션 관리자 : </span><br />소모임 또는 섹션관리자의 회원번호를 입력.<br />두명 이상일 경우엔 쉼표(,)로 구분합니다.<br /><span style='color:#2A5EB2;font-weight:bold'>소모임 가입제한: </span><br />소모임 사용여부 또는 가입제한 회원레벨 설정<br /><span style='color:#2A5EB2;font-weight:bold'>소모임을 설정하면 : </span><br />소모임 가입회원을 제외한 회원과 비회원에게는<br />하위게시판의 접근이 차단됩니다.<br /><span style='color:#2A5EB2;font-weight:bold'>소모임을 설정하지 않으려면 :</span><br />가입제한 선택상자를 사용안함으로 설정하세요.</fieldset></td></tr>
</table>
</form></td></tr></table>
<script type='text/javascript'>top.document.title='소모임제한';$$('group[]',1).value='<?=(int)$stn[4]?>';</script>
</body>
</html>
<?
exit;
} else if($_GET['mst']) {
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr'><td style='border-color:#5289CC;border-style:solid;border-width:1px 0 0px 1px;width:50px'>분류</td><td style='border-color:#5289CC;border-style:solid;border-width:1px 1px 0 0px;width:200px'><div style='float:left;width:150px'>이름</div><div style='float:left'>갯수</div></td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px'>
<form method='post' action='<?=$admin?>' style="margin:0;">
<input type='hidden' name='ctm' value='<?=$_GET['mst']?>' />
<table cellpadding='3px' cellspacing='0px' class='cltb'>
<colgroup><col width='50px' /><col width='200px' /><colgroup>
<?
$dcfile = file($dc);
if($mst = $dcfile[$_GET['mst'] -1]) {
$ctc = explode("\x1b", trim($mst));
for($i = 1;trim($ctc[$i]);$i++) {
?>
<tr style='text-align:center'><td><?=$i?></td><td><input type='text' name='ct[]' value='<?=substr($ctc[$i],0,-6)?>' style='width:50%' /> <input type='text' name='ctn[]' value='<?=(int)substr($ctc[$i],-6)?>' style='width:20%' /></td></tr>
<?
}
}
?>
<tr><td>new</td><td><input type='text' name='ct[]' value='' style='width:50%' /> <input type='text' name='ctn[]' value='' style='width:20%' /></td></tr>
<tr><td colspan='2'><input type='submit' class='button' value='입력' /> &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' /></td></tr>
</table>
</form></td></tr></table>
<script type='text/javascript'>document.title='분류편집';</script>
</body>
</html>
<?
exit;
} else if($_POST['bkselect'] && $_POST['outurl'] && $_POST['outadid'] && $_POST['outadpss']) {
$_POST['outurl'] = substr($_POST['outurl'],7);
$_POST['outurl'] = substr($_POST['outurl'],0,strrpos($_POST['outurl'],'/')).'/admin.php';
$mip = md5($_SERVER['SERVER_ADDR']);
$dxf = $_POST['datato'];
if(!file_exists($dxf)) {mkdir($dxf,0777);$_POST['fkdpl'] = 1;}
if(substr($dxf,-1) != '/') $dxf .= '/';
$post_dt = "bkcdid=".substr($mip,0,16).trim($_POST['outadpss']).substr($mip,16).trim($_POST['outadid'])."&bkcfolder=".trim($_POST['pssfolder'])."&bkdpl=".$_POST['fkdpl'];
if(substr($_POST['datafrom'],-1) == '/') $_POST['datafrom'] = substr($_POST['datafrom'],0,-1);
if($_POST['bkselect'] != '3' && $_POST['datafrom']) $post_dt .= "&bkfrom=".$_POST['datafrom'];
if($_POST['bkselect'] != '2' && $_POST['fksbdr']) $post_dt .= "&bksbdr=".$_POST['fksbdr'];
function mkup($bkn) {
global $bklist;
if($bklist) {
if($bklist[$bkn]) bkup($bklist[$bkn],$bkn);
else return "완료되었습니다";
} else return "가져올 파일이 없습니다";
}
function bkup($bkfile,$bkn) {
global $dxf,$ds,$time,$post_dt,$bklist;
$post_data = $post_dt."&bkfile=".$bkfile;
$host = substr($_POST['outurl'], 0, strpos($_POST['outurl'], '/'));
$fp = fsockopen($host, 80, $errno, $errstr, 30);
fputs($fp, "POST http://".$_POST['outurl']." HTTP/1.1\r\n");
fputs($fp, "Accept-Language: ko\r\n");
fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Accept-Encoding: gzip, deflate\r\n");
fputs($fp, "User-Agent: Mozilla/4.0\r\n");
fputs($fp, "Host: ".$host."\r\n");
fputs($fp, "Content-Length: ".strlen($post_data)."\r\n");
fputs($fp, "Connection: close\r\n");
fputs($fp, "Cache-Control: no-cache\r\n");
fputs($fp, "\r\n");
fputs($fp, $post_data."\r\n");
fputs($fp, "\r\n\r\n");
while(!$ste) {$strr = fread($fp, 4096);$ste = strpos($strr,"\xf7");}
$strr = substr($strr,$ste + 1);
if($bkfile) {
$rff = fopen($dxf."_filelist.txt","a");
if($bklist === 'a') $fbk = fopen($dxf.$_POST['fileto'],"w");
else {$fbk = fopen($dxf.$bkfile,"w");fputs($rff,"생성한 파일 : {$bkfile}\n");}
fputs($fbk,$strr);
}
while(!feof($fp)) {
if(!$bkfile) $strr .= fread($fp, 4096);
else fputs($fbk,fread($fp, 4096));
}
fclose($fp);
if($bkfile) {fclose($fbk);} else {
if($ste = strpos($strr,"\xf7")) $strr = substr($strr,0,$ste);
$rff = fopen($dxf."_filelist.txt","w");fputs($rff,preg_replace("`\x1b[13]`","\n",str_replace("\x1b2","\ndir)",$strr)));fputs($rff,"\n\n-- 위는 저쪽에서 가져온 파일목록, 아래는 작업내역입니다.\n\n");
foreach(explode("\x1b",$strr) as $bkk) {if($bkk) {$bbg = substr($bkk,0,1);$bbh = substr($bkk,1);
if($bbg == '2') {if(!file_exists($dxf.$bbh)) {mkdir($dxf.$bbh, 0777);fputs($rff,"생성한 폴더 : {$bbh}\n");
}} else if($bbg == '3') {if(!file_exists($dxf.$bbh)) {fclose(fopen($dxf.$bbh,"w"));fputs($rff,"생성한 파일 : {$bbh}\n");
}} else if($_POST['fkdpl'] == '1') {$bklist[] = $bbh;
} else if($_POST['fkdpl'] == '3') {$bbk = substr($bkk,12);if(!file_exists($dxf.$bbk) || substr($bkk,2,10) > filemtime($dxf.$bbk)) {$bklist[] = $bbk;
}} else if($_POST['fkdpl'] == '2') {$bbk = explode("|",$bbh);if(!file_exists($dxf.$bbk[1]) || $bbk[0] != filesize($dxf.$bbk[1])) {$bklist[] = $bbk[1];
}} else if($_POST['fkdpl'] == '4') {if(!file_exists($dxf.$bbh)) {$bklist[] = $bbh;
}}}}}
fclose($rff);
$bkn++;
if($bklist === 'a') return "완료되었습니다";
else return mkup($bkn);
}
if($_POST['bkselect'] == '2' && $_POST['filefrom']) {$bklist = 'a';$result = bkup($_POST['filefrom'],-2);}
else $result = bkup(0,-1);
echo "<h2 style='text-align:center'><input type='button' value='내역보기' onclick='popup(\"?fm=".$dxf."_filelist.txt\", 800, 400)' /> &nbsp; ".$result."</h2>";
exit;
} else if($_GET['bkipt']) {
?>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr class='cltr'><td style='border-color:#5289CC;border-style:solid;border-width:1px' title='다른 주소의 srboard 게시판을 여기로 가져오기'>게시판 가져오기</td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#FFFFFF;padding:1px 1px 10px 1px'>
<form name='bkfm' method='post' target='exe' action='?' style='margin:0;padding-top:7px'><center>
가져오는 방식 선택 : <select name="bkselect" onchange='bkslct(this)'><option value="1">가져올 폴더 지정하기</option><option value="2">가져올 파일 지정하기</option><option value="3">data/암호폴더 가져오기</option></select><br />
중복파일처리 : <select name="fkdpl"><option value="1">모두 덮어쓰기</option><option value="2">크기 다르면  덮어쓰기</option><option value="3">날짜 다르면 덮어쓰기</option><option value="4">건너뛰기</option></select>
&nbsp; <label>하위폴더 포함 <input type="checkbox" onclick="$$('fksbdr',0).value=(this.checked)? '1':'0'"  class="no" checked="checked" /></lable><input type="hidden" name="fksbdr" value="1" />
<div id='bfrom'>데이타 가져올 경로 : <input type='text' name='datafrom' value='data/암호폴더/게시판아이디' style='width:220px' /></div>
<div id='ffrom' style='display:none'>가져올 파일의 이름 : <input type='text' name='filefrom' value='' style='width:220px' /></div>
<div>데이타 저장할 경로 : <input type='text' name='datato' value='<?=$dxr?>' style='width:220px' /></div>
<div id='efrom' style='display:none'>저장할 파일의 이름 : <input type='text' name='fileto' value='' style='width:220px' /></div>
<fieldset style="border:1px solid;padding:10px;width:80%;margin-top:5px"><legend align='center'>가져올 곳의 정보</legend>
주소 : <input type='text' name='outurl' value='http://~~/admin.php' style='width:250px' /><br />
관리자 아이디 : <input type='text' name='outadid' value='' style='width:200px' /><br />
관리자 암 &nbsp; 호 : <input type='password' name='outadpss' value='' style='width:200px' /><br />
암호폴더 이름 : <input type='text' name='pssfolder' value='' style='width:200px' title='가져올 곳 data폴더내부의 암호폴더 이름' /></fieldset><br />
<input type='button' class='button' onclick='bkipt()' value='입력' /> &nbsp; <input type='button' class='button' value='닫기' onclick='parent.close();' />
</center></form></td></tr></table>
<script type='text/javascript'>
function bkipt() {
var bks = document.bkfm.bkselect.value;
if((bks != '2' || document.bkfm.filefrom.value != '') && (bks == '3' || document.bkfm.datafrom.value != '') && document.bkfm.outurl.value != 'http://~~/admin.php' && document.bkfm.outurl.value != '' && document.bkfm.outadid.value != '' && document.bkfm.outadpss.value != '') {
$$("exe",0).style.display = "block";document.bkfm.submit();
} else alert('빈칸이 있습니다');
}
function bkslct(ths) {
if(ths.value == '2') {
$('ffrom').style.display = 'block';$('efrom').style.display = 'block';
} else {
$('ffrom').style.display = 'none';$('efrom').style.display = 'none';
$$('filefrom',0).value = '';$$('fileto',0).value = '';
}
if(ths.value == '1' || ths.value == '2') {
$('bfrom').style.display = 'block';
var dtfm = $$('datafrom',0).value;
if((!dtfm || dtfm == 'data/암호폴더/게시판아이디') && $$('pssfolder',0).value) $$('datafrom',0).value = 'data/' + $$('pssfolder',0).value + '/';
} else {
$('bfrom').style.display = 'none';$$('datafrom',0).value = '';}
}
top.document.title='게시판 가져오기';
</script>
<iframe name="exe" src="?loading=1" frameborder="0" style="width:100%;height:40px;display:none"></iframe>
</body>
</html>
<?
exit;
} else if($_GET['mkbdlist']) {
$mdd = "";
$odr = opendir($dxr);
while($entry = readdir($odr)) {
if($entry != "." && $entry != ".." && $entry != "_member_") {
if(is_dir($dxr.$entry) && @filesize($dxr.$entry."/no.dat")) {
 $dr = $dxr.$entry."/";
 $fn = fopen($dr."no.dat","r");
 $fbd = str_pad($entry,10).substr(fgets($fn),0,6);
 for($fnt =1;!feof($fn);$fnt++) {fgets($fn);}
if(@filesize($dr."bno.dat")) {
$fno = fopen($dr."bno.dat","r");
for($dvc = 0;$fnoo = fgets($fno);$dvc++) {$fnto = substr($fnoo,6,6);}
fclose($fno);} else {$dvc = 0;$fnto = 0;}
if(@filesize($dr."upload.dat")) {
$fuo = fopen($dr."upload.dat","r");
$fuoo = (int)substr(fgets($fuo),-7,6);
fclose($fuo);} else $fuoo = '';
if(@filesize($dr."notice.dat")) {
$fto = fopen($dr."notice.dat","r");
while($ftoo = fgets($fto)) {$fnco .= "^".(int)substr($ftoo,0,6);}
fclose($fto);} else $fnco = '';
$fbd .= str_pad($fnt + $fnto,6,0,STR_PAD_LEFT)."0000a01111110615111109210101090001001000000000001111\x1b".$entry."\x1bdefault\x1b\x1b".$fnco."\x1b".$fuoo."\x1b".$dvc."\x1b0000100001+0005+0005-0000+0000000\x1b01100\x1b0+00010010\x1b\n";
$mdd .= $fbd;
$fnt = 0;
$fbd= '';
}}}
closedir($odr);
$mblst = fopen(substr($ds,0,-3)."bak","w");
fputs($mblst,$mdd);
fclose($mblst);
scrhref('?board=1',0,0);exit;
} else {
if($_GET['board'] || (!$_GET['drct'] && !$_GET['member'] && !$_GET['section'] && !$_GET['statistics'])) {
$skinn = array();
$d = opendir("skin");
while($entry = readdir($d)) {
if(is_dir("skin/".$entry) && $entry !='.' && $entry !='..') $skinn[] = $entry;
}
closedir($d);
@sort($skinn);
$skinoption = '';
foreach($skinn as $entry) $skinoption .= "<option value='{$entry}'>{$entry}</option>";
}
function seltd($key,$value) {
return ($key == $value)? " selected='selected'":"";
}
function degree($value,$n) {
$key = array();
$key[$value] = "selected='selected'";
$lv = ($n > 2)? "level ":"";
$vz = ($n > 2)? "비회원도":"0";
$vt = ($n > 2)? "관리자만":"9";
if($n == 5) $degrea = " <option value='0' title='사용 안 함' {$key['0']}>사용안함</option>";
else $degrea = ($n == 3)? "":" <option value='0' title='비회원도 허용' {$key['0']}>{$vz}</option>";
for($g = 1;$g <= 8;$g++) {$degrea .= " <option value='{$g}' {$key[$g]}>{$lv}{$g}</option>";}
$degrea .= " <option value='9' title='관리자만' {$key['9']}>{$vt}</option>";
if($n == 1) $degrea = $degrea." <option value='a' title='모두금지' {$key['a']}>x</option>";
return $degrea;
}
include("include/manage.php");
}
}
?>
<div id='nmemo' style='display:none;'></div>
<?
} else {
ssckdxl();
scrhref($index,0,0);exit;
}
} else {
?>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<script type='text/javascript'>
var wopen = 1;
var setop = Array('<?=$isie?>','<?=$bwr?>',<?=$sett[5]?>,'<?=$sett[55]?>','<?=(($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?=(($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','',<?=(int)$sett[11]?>);
sessno = <?=$sessno?>;
setTimeout('document.getElementsByTagName("form")[0].from.value="<?=$index?>";azax("<?=$exe?>?&onload=<?=$time?>&id=1",9)',100);
</script>
</head>
<body>
<script type="text/javascript" src="include/top.js"></script>
<center style="margin:70px 0 70px 0">
<?
include("include/login.php");
}
?>
</center>
<?
}
}
?>
<iframe name='exe' style='display:none;width:1px;height:1px'></iframe>
</body>
</html>