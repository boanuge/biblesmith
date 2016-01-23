<?
$index = "index.php";
$exe = "exe.php";
$admin = "admin.php";
$mblog = "member.php";
if(basename($_SERVER['PHP_SELF']) == $index) $self = 9;
else if(basename($_SERVER['PHP_SELF']) == $exe) $self = 2;
else if(basename($_SERVER['PHP_SELF']) == $admin) $self = 3;
if(false !== strpos($_SERVER['QUERY_STRING'],"(")) exit;
$zr = opendir($dot."data");
while($zro = readdir($zr)) {
if($zro != '.' && $zro != '..' && $zro) {$dxr = $dot."data/".$zro."/";break;}
}
closedir($zr);
if(@filesize($dxr."ban")) {
$ft = fopen($dxr."ban", "r");
while($fto = trim(fgets($ft))) {
if(false !== strpos($fto,'*')) {
$fto = str_replace(".","\.",str_replace("*","[0-9]+",$fto));
if(preg_replace("`$fto`","",$_SERVER['REMOTE_ADDR']) == '') $exit = 'ip';
} else if($fto == $_SERVER['REMOTE_ADDR']) $exit = 'ip';
if($exit == 'ip') break;
}
fclose($ft);
if($exit == 'ip') {echo "차단된 IP입니다";exit;}
}
$set = $dxr."setting.dat";
$dim = $dxr."member.dat";
$dmo = $dxr."memo.dat";
$time = time();
$today = mktime(0, 0, 0, date("m", $time), date("d", $time), date("Y", $time));
if(file_exists($set)) {$sett = explode("\x1b",fgets($st=fopen($set,"r")));fclose($st);}
else if($self == 9 && !$_GET['signup'] && !$_POST['join']) header("location:".$index."?signup=1");
if($sett[56]) {
$exxt = array('_GET','_POST','_FILES','_SERVER','_COOKIE','_SESSION','_REQUEST');
for($i=0;$i < 7;$i++) if(isset($_GET[$exxt[$i]]) || isset($_POST[$exxt[$i]])) exit;
}
if($sett[73] && ($self == 9 || $self == 2)) {include("include/underConstrunct.php");exit;}
if(substr($sett[14],0,11) == 'http://www.') $sett[14] = 'http://'.substr($sett[14],11);
if(substr($_SERVER['HTTP_REFERER'],0,11) == 'http://www.') $_SERVER['HTTP_REFERER'] = 'http://'.substr($_SERVER['HTTP_REFERER'],11);
if(substr($_SERVER['HTTP_HOST'],0,4) == 'www.') $_SERVER['HTTP_HOST'] = substr($_SERVER['HTTP_HOST'],4);
if($sett[14] && !strpos($sett[14],$_SERVER['HTTP_HOST'])) exit;
if(!$_SERVER['REQUEST_URI']) $_SERVER['REQUEST_URI'] = ($_SERVER['QUERY_STRING'])? $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']:$_SERVER['PHP_SELF'];
$sett59 = explode("\x18",$sett[59]);
function levelname($mlval) {
global $sett59;
if($sett59) {
for($i = count($sett59) -2;$i >= 0;$i--) {
if($mlval >= $sett59[$i][0]) {$val = substr($sett59[$i],1);break;}
}} else $val = "레벨 ".$mlval;
return $val;
}
$uzip = str_replace(".","",$_SERVER['REMOTE_ADDR']);
if($_COOKIE['mck'] == md5($_SESSION['mk'])) {
list($mbr_id, $mbr_no, $mbr_level) = $_SESSION[$_SESSION[$_COOKIE[md5($_COOKIE['mck']."\x1b".$_SESSION['mk'])]]];
$uzname = $_SESSION['m_nick'];
fclose(fopen($dxr."_member_/logged_".$mbr_no,"w"));
$jn = fopen($dxr."_member_/member_".$mbr_no,"r");
$jno = explode("\x1b", fgets($jn));
fclose($jn);
} else {
$uzname = $_SESSION['yname'];
$uzpass = $_SESSION['ypass'];
if($_COOKIE["at".str_pad($uzip,12,"x")] && $self != 3) header("location:{$admin}?{$_SERVER['REQUEST_URI']}");
list($mbr_id, $mbr_no, $mbr_level) = array('','',0);
}
$mbr_n5 = str_pad($mbr_no,5,0,STR_PAD_LEFT);
if($_REQUEST['slys']) {$slss = explode('|',$_REQUEST['slys']);if($slss[3]) $_GET['type'] = $slss[3];if($slss[7]) $sett[12] = $slss[7];}
$_SERVER['REQUEST_URI'] = str_replace("&","&amp;",$_SERVER['REQUEST_URI']);
$id =$_REQUEST['id'];
if(!$id && $self == 2) {if($_GET['rss']) $id = $_GET['rss'];
if($_REQUEST['tb']) {$trbk = explode("^",$_REQUEST['tb']);
$id = $trbk[0];
}}
$id = (string)$id;
$uid = (strpos($id,"%") !== false)? $id:urlencode($id);
if(($idp = strpos($id,'^'))) {
$id = substr($id, 0, $idp);
$_GET['xx'] = substr($id, $idp + 1);
}
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')) {$isie = 1;if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9')) $ie8 = 1;if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7') || $ie8 == 1) $eid = $id;else {$eid = $uid;$bwr = 'ie6';}}
else {
$isie = 2;
if($id) $eid = $uid;
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'AppleWebKit')) $bwr = 'chrome';
else if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'Opera')) $bwr = 'opera';
}
/*
//Do not treat mobile and desktop differently.
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'Android') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'iPhone') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'iPod') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Windows CE') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'/CLDC-') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Nokia') || false !== strpos($_SERVER['HTTP_USER_AGENT'],';WV0') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'POLAR') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Skyfire')) $ismobile = ($_COOKIE['ckmobile'] == 3)? 3:2;
else $ismobile = 0;
*/
$ismobile = 0;
$iswindows = (false !== strpos($_SERVER['HTTP_USER_AGENT'],'Windows'))? 1:0;
$sessid = session_id();
function scrhref($go,$prnt,$alert) {
$prnt = ($prnt)? 'parent.':'';
$script = ($alert)? $prnt.'alert("'.$alert.'");':'';
$script .= ($go)? $prnt."location.replace('".$go."'.replace(/amp;/g,''));":"";
echo "<script type='text/javascript'>/*<![CDATA[*/".$script."/*]]>*/</script>";
}
function data6($za,$ya,$yc) {
 global $wdth, $id, $dxr;
$yf = array("no","list","body","rlist","rbody");
$yd = (!$yc)? $id:$yc[0];
if(!(int)$za) $za = (!$yc)? $wdth[6]:$yc[1];
else $za--;
if($za >= 1 && file_exists($dxr.$yd."/^".$za."/no.dat")) {
for($i = 0;$i < 5;$i++) {if(gettype($ya[$i]) == 'resource') {fclose($ya[$i]);$ya[$i] = fopen($dxr.$yd."/^".$za."/".$yf[$i].".dat","r");}}
} else $za = 'q';
return array($za,$ya[0],$ya[1],$ya[2],$ya[3],$ya[4]);
}
if($self != 9 && !$dot) {
function chmbr($mbrn, $n, $val) {
global $dxr, $wdth;
$dmn = $dxr."_member_/member_".$mbrn;
if(file_exists($dmn)) {
if($n < 2 || $n > 5) $point = array((int)substr($wdth[7],10,5),(int)substr($wdth[7],15,5),(int)substr($wdth[7],20,5),(int)substr($wdth[7],25,5),(int)substr($wdth[9],1,5),(float)(substr($wdth[9],7,4)/100),substr($wdth[0],62,1));
$hn = fopen($dmn,"r");
$jno = explode("\x1b", fgets($hn));
fclose($hn);
if($n < 2) {
if($n == 0) {$jno[6] += $val*$point[0];if(!$point[6]) $jno[12] += $val;
} else if($n == 1) {$jno[7] += $val*$point[1];if(!$point[6]) $jno[13] += $val;
}} else {
if($n == 8) $val = $point[2];
else if($n == 9) $val = $point[3];
else if($n == 10) $val = $point[4];
else if($n == 11) {
if($wdth[9][6]) {if($wdth[9][6] == 3 || ($wdth[9][6] == 1 && $val > 0) || ($wdth[9][6] == 2 && $val < 0)) $val = $val*$point[5];}
else $val = 0;
}
if($val == 0) return;
}
$jno[$n] = (float)$jno[$n] + $val;
if($n < 2 && $jno[$n] < 0) $jno[$n] = 0;
$hn = fopen($dmn,"w");
fputs($hn,$jno[0]."\x1b".$jno[1]."\x1b".$jno[2]."\x1b".$jno[3]."\x1b".$jno[4]."\x1b".$jno[5]."\x1b".$jno[6]."\x1b".$jno[7]."\x1b".$jno[8]."\x1b".$jno[9]."\x1b".$jno[10]."\x1b".$jno[11]."\x1b".$jno[12]."\x1b".$jno[13]."\x1b");
fclose($hn);
}}}
function pagen($pg,$pend,$pcnt,$sum) {
global $self;
$expg = str_replace("amp;amp;","amp;",str_replace("&","&amp;",$_SERVER['QUERY_STRING']));
if(substr($expg,0,1) != "&") $expg = "&amp;".$expg;
if($pg == 'board' && strpos($expg,'&amp;open=') !== false) $expg = preg_replace("`&amp;open=[0-9]+`i","",$expg);
else {if(strpos($expg,'&amp;no=') !== false) $expg = preg_replace("`&amp;no=[0-9]+`i","",$expg);
if($self == 9 && strpos($expg,'&amp;cc=') !== false) $expg = preg_replace("`&amp;cc=[0-9]+`i","",$expg);}
$expg = preg_replace("`&amp;".$pg."=[0-9]+`i","",$expg)."&amp;".$pg;
$expg = substr($expg,5);
?>
<center class='pageno'><table cellpadding='0px' cellspacing='0px' align='center'><tr>
<?
$sg = (int)(($_GET[$pg] - 1)/ $pcnt)*$pcnt + 1;
$ge = ($pend > $sg + $pcnt)? $sg + $pcnt - 1:$pend;
if($sg >= $pcnt) echo "<td><a href='?{$expg}=1'>1</a></td><td><font>|</font></td><td><a href='?{$expg}=".($sg - 1)."'>. .</a></td><td><font>|</font></td>";
for($i = $sg; $i <= $ge;$i++) {
if($_GET[$pg] == $i) $g = "<span class='p_no'>{$i}</span>";else $g = $i;
echo "<td><a href='?{$expg}={$i}'>{$g}</a></td>";
if($i != $pend) echo "<td><font>|</font></td>";
}
if($pend > $ge) echo "<td><a href='?{$expg}=".($ge+1)."'>. .</a></td><td><font>|</font></td><td><a href='?{$expg}={$pend}'>{$pend}</a></td>";
if($sum === "+") echo "<td><font>&nbsp;</font></td><td><a href=\"#none\" onclick=\"locato('p','".($_GET[$pg] + 1)."');\">[계속검색]</a></td>";
?>
</tr></table></center>
<?
}
function encodee($val) {
global $bwr;
if($bwr) $val = urlencode($val);
return $val;
}
function notiff($ntfftnm,$ntffwe,$ntffuff,$ntffulst) {
global $dxr,$time;
$ntfftnmf = $dxr."_member_/notify_".$ntfftnm;
if(!file_exists($ntfftnmf) || !filesize($ntfftnmf)) {
if($ntffwe == 1) {
$ntffuf = fopen($ntfftnmf,"w");fputs($ntffuf,$ntffuff.$ntffulst."\n");fclose($ntffuf);
}} else {
while($time - @filemtime($ntfftnmf."@@") < 3) {usleep(50000);$time = time();}
$ntffjuf = fopen($ntfftnmf."@@","w");
$ntffuf = fopen($ntfftnmf,"r");
$ntffuexit = 1;
while($ntffufo = fgets($ntffuf)) {
if(substr($ntffufo,0,16) == $ntffuff) {$ntffuexit = 0;if($ntffwe == 1) break;}
else fputs($ntffjuf,$ntffufo);
}
if($ntffuexit && $ntffwe == 1) fputs($ntffjuf,$ntffuff.$ntffulst."\n");
fclose($ntffuf);
fclose($ntffjuf);
if(($ntffwe == 1 && $ntffuexit) || (!$ntffwe && !$ntffuexit)) copy($ntfftnmf."@@",$ntfftnmf);
unlink($ntfftnmf."@@");
}
}
$ds = $dxr."boards.dat";
$dc = $dxr."category.dat";
if($self == 9 || $self == 2) {
$grp = '';
$dxpt = $index."?id=".$eid;
$sessn = preg_replace("`[^0-9]`","",$sessid);
$docoo = "sr".substr(md5(substr($sessn,0,10) + substr($sessn,-8)),-10);
$dockie = md5(preg_replace("`[^a-z]`i","",$zro).$sett[14].preg_replace("`[^0-9]`","",$zro).$uzip.$sessn);
if($id) {$wtses = ($_REQUEST['no'])? $_REQUEST['no']:$_GET['rp'];$wtses = "w".substr(md5($wtses.$id.$dockie),-9);}
$srwdth = $sett[12];
$stbL = 0;
$stbR = 0;

if($dxr) {
$fsbs = array();
$bfsb = array();
$ctgo = array();
$fc = fopen($dc,"r");
$fs = fopen($ds,"r");
for($bs = 0;$bso = trim(fgets($fs));$bs++) {
$fco = fgets($fc);
$bid = trim(substr($bso, 0, 10));
if($bid == $id) {
	$sss = $bso;
	$fct = (int)substr($sss, 16, 6);
	$lst = substr($sss, 10, 6);
	$isnt = (int)substr($sss, 36, 2);
	if(!$isnt) $isnt = 10;
	$fz = (int)substr($sss,50,2);
	$wdth = explode("\x1b",$bso);
	$dct = explode("\x1b",$fco);
	for($i = 1;trim($dct[$i]);$i++) {
	$ii = str_pad($i, 2, 0, STR_PAD_LEFT);
	$ctg[$ii] = substr($dct[$i],0,-6);
	$ctgn[$ii] = (int)substr($dct[$i],-6);
	}
	$ctl = $i -1;
$wdth[6] = (int)$wdth[6];
if($wdth[6]) {
$a = fopen($dxr.$id."/bno.dat","r");
for($aa=1;!feof($a);$aa++) $do[$aa] = fgets($a);
fclose($a);
if($_REQUEST['xx']) $fnt = (int)substr($do[$_REQUEST['xx']],12,6);
else $fnt = $fct - substr($do[$wdth[6]], 6, 6);
} else $fnt = $fct;
if($self == 9) {
$aview = $wdth[7][2];
$noright = 0;
if($_GET['arrange'] && !$sss[47]) $_GET['arrange'] = '';
} else $idn = $bs + 1;
$section = substr($sss,57,2);
if($mbr_id && $mbr_id == $wdth[3]) $mbr_level = 9;
} else if($self == 2 && $_POST['moveto'] && $bid == $_POST['moveto']) $unx = explode("\x1b",$bso);
$ctgo[$bid] = $fco;
$bsof = substr($bso,75);
$bdidnm[$bid] = substr($bsof,0,strpos($bsof,"\x1b"));
$fsbs[$bid] = substr($bso,10);
}
fclose($fc);
fclose($fs);
if(@filesize($dxr."ban2")) {
$ft = fopen($dxr."ban2", "r");
while($fto = trim(fgets($ft))) {
if(false !== strpos($fto,'*')) {
$fto = str_replace(".","\.",str_replace("*","[0-9]+",$fto));
if(preg_replace("`$fto`","",$_SERVER['REMOTE_ADDR']) == '') $exitb = 'ip';
} else if($fto == $_SERVER['REMOTE_ADDR']) $exitb = 'ip';
if($exitb == 'ip') break;
}
fclose($ft);
if($exitb == 'ip') {$sss[24] = 9; $sss[25] = 9;}
}
if($self == 2) if($sss[64] && $_POST['name']) $_POST['name'] = '익명';
$id10 = str_pad($id,10);
$du = $dxr.$id."/upload.dat";
if(!file_exists($dxr."_member_/_bak_")) mkdir($dxr."_member_/_bak_", 0777);
} else if($self == 9) {$sett[1]='default';$sett[5]=24;$sett[11]=500;$sett[12]=700;$srwdth=700;}
if(file_exists($dxr."section.dat")) {
if($self == 9 || $_GET['write'] || $_POST['edit'] == "edit") {
if($fsg = @fopen($dxr."section_group.dat","r")) {
for($z = 1;$fsgo = trim(fgets($fsg));$z++) $grp[$z] = explode("\x1b",$fsgo);
fclose($fsg);
}}
if(!$sgp) $sgp = (int)$_GET['group'];
$fst = fopen($dxr."section.dat","r");
for($ii=1;$fsto = trim(fgets($fst));$ii++) {
$sect[$ii] = explode("\x1b",$fsto);
if($self == 9 && !$fsection && $sect[$ii][1] != 3 && $sect[$ii][1] != 6 && $sect[$ii][1] != 7 && $sect[$ii][1] != 's' && $sect[$ii][1] != '8' && (!$_GET['group'] || strpos($grp[$sgp][2],'^'.$ii.'^') !== false)) $fsection = $ii;
if($sect[$ii][2]) $bfsb[$ii] = explode("^",$sect[$ii][2]);
}
fclose($fst);
if($self == 9) {
if($_GET['group']) $section = $fsection;
else if(!$id && !$_GET['find'] && !$_GET['group']) {
if(($section = $_GET['section']) && (!$sect[$section] || $sect[$section][1] == 3 || $sect[$section][1] == 6 || $sect[$section][1] == 7 || $sect[$section][1] == 's')) $section = $fsection;
else if(!$sett[40] && !$_GET['signup'] && !$_GET['mbr_info'] && !$_POST['join'] && $sect[$section][2] && !strpos($sect[$section][2],'^')) header("location:?id=".$sect[$section][2]);
}
if(!$section) $section = $fsection;
}
$section = (int)$section;
if($ismobile == 2 && $_GET['section']) $section = $_GET['section'];
if($self == 9 || $_GET['write'] || $_POST['edit'] == "edit") {
if($fsta = @fopen($dxr."section_add.dat","r")) {
for($ii=1;$ii < $section;$ii++) fgets($fsta);
$sectgt = fgets($fsta);
fclose($fsta);
}}
if(!$_GET[group]) $sgp = $sect[$section][6];
if($grp && $grp[$sgp][1]) {
if($sett[26] != '') $sett[26] = $grp[$sgp][1];
if($mbr_no && strpos(",{$grp[$sgp][3]},",",{$mbr_no},") !== false) $mbr_level = 9;
}
if($slss[0] || $section == 'xx' || $sect[$section][1] == 'x') $sett[26] = '';
else if($slss[1]) $sett[26] = $slss[1];
if($mbr_no && strpos(",{$sect[$section][3]},",",{$mbr_no},") !== false) $mbr_level = 9;
else if($sect[$section][4] && (!$mbr_id || false === strpos($sect[$section][5],",".$mbr_no.","))) {
if($id) {$sss[23] = 9;$sss[24] = 9;$sss[25] = 9;$sss[28] = 0;}
if($self == 9) $sectadmin = 3;
}}}
if($ismobile == 2) {
$sett[26] = 'mobile';
if($_COOKIE['scrwdth']) $srwdth = $_COOKIE['scrwdth'];
$srwtpx = "100%";
} else {
if($sett[77] == 1) $srwtpx = $srwdth."%";
else $srwtpx = $srwdth."px";
}
$sessno = ($sett[34])? (int)substr(preg_replace("`[^0-9]`","",md5($_SERVER['REMOTE_ADDR'].$zro)),0,3):0;
?>