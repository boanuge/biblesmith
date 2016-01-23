<?
if($mbr_level == 9) {
if($_POST['exc'] == "modify_tag" || $_POST['exc'] == "modify_date") {
/** 태그/날짜 정리 시작**/
$i = 0;
$fag = array();
for($w6 = (int)$wdth[6];$w6 >= 0;$w6--) {
if($w6 > 0) $fl = fopen($dxr.$id."/^".$w6."/list.dat","r");
else $fl = fopen($dxr.$id."/list.dat","r");
while(!feof($fl)){
$flo = fgets($fl);
if($flo = trim($flo)) {
if($_POST['exc'] == "modify_tag") {
$flo = explode("\x1b",$flo);
if($flo[6]) {
$fxx = explode(",",$flo[6]);
for($ff = 0;$ffx = $fxx[$ff];$ff++) $fag[$ffx] = $fag[$ffx] + 1;
}
} else {
if($fxx = @date("Ym", substr($flo, 0, 10))) $fag[$fxx] = $fag[$fxx] + 1;
}
}
}
fclose($fl);
}
if($_POST['exc'] == "modify_tag") {
while($time - @filemtime($tgx."@@") < 3) {usleep(50000);$time = time();}
$jtg = fopen($tgx."@@","w");
$tg = fopen($tgx,"r");
while($tgo = fgets($tg)) {
$tggo = substr($tgo,0,-9);
if($fag[$tggo]) {if($fag[$tggo] > 9999) $fag[$tggo] = 9999;fputs($jtg,substr($tgo,0,-5).str_pad($fag[$tggo],4,0,STR_PAD_LEFT)."\n");$fag[$tggo] = 0;}
}
fclose($tg);
foreach($fag as $key => $value) {
if($value) {if($value > 9999) $value = 9999;fputs($jtg,$key."0000".str_pad($value,4,0,STR_PAD_LEFT)."\n");}
}
fclose($jtg);
copy($tgx."@@",$tgx);
unlink($tgx."@@");
} else {
$tg = fopen($tmx,"w");
krsort($fag);
foreach($fag as $key => $val) fputs($tg, $key.$val."\n");
fclose($tg);
}
/** 태그/날짜 정리 끝**/
} else if($_POST['exc'] == "modify_upload") {
/** 업로드파일 정리 시작**/
if(file_exists($tdu)) {
while($time - @filemtime($tdu."@@") < 3) {usleep(50000);$time = time();}
$jtdu = fopen($tdu."@@","w");
$fdu = fopen($tdu,"r");
$i = 0;
$fag = "";
while(!feof($fdu)){
$fduo = fgets($fdu);
if(trim($fduo)) {
if($time - (int)substr($fduo, 16, 10) > 18000) {
$fag[$i] = substr($fduo, 26, -13);
$i++;
$fduo = "";
}
}
fputs($jtdu,$fduo);
}
fclose($fdu);
fclose($jtdu);
if($fag[0]) copy($tdu."@@", $tdu);
unlink($tdu."@@");
if(filesize($tdu) < 1) unlink($tdu);
if($fag[0]) {
$i = 0;
$faag = "";
$fu = fopen($du,"r");
while(!feof($fu)){
$fuo = substr(fgets($fu),6,-13);
if(trim($fuo) && in_array($fuo, $fag)) {
$faag[$i] = $fuo;
$i++;
}
}
fclose($fu);
for($i = 0;trim($fag[$i]);$i++) {
$ufile = $ffldr.$fag[$i];
if($faag[0]) {
if(file_exists($ufile) && !in_array($fag[$i], $faag)) unlink($ufile);
} else @unlink($ufile);
}
}
}
$fdu = fopen($du,"r");
while($fdo = fgets($fdu)) if(trim($fdo)) $fag[] = str_replace("%","",urlencode(substr($fdo,6,-13)));
fclose($fdu);
$ufe = opendir($ffldr);
if($fag[0]) {
while($ufi = readdir($ufe)) {
if($ufi != '.' && $ufi != '..' && $ufi) {
if(strpos($ufi,'_s.') == false && !in_array($ufi,$fag)) $ufst[] = $ufi;
}}
closedir($ufe);
$fagg = '';
if($ufst[0]) {
$ufstc = count($ufst);
for($w6 = (int)$wdth[6] + 1;$w6 >= 1;$w6--) {
if($w6 > (int)$wdth[6]) $w7 = '';
else $w7 = "/^".$w6;
$fn = fopen($dxr.$id.$w7."/no.dat","r");
$fb = fopen($dxr.$id.$w7."/body.dat","r");
while(!feof($fn)) {
$fno = substr(fgets($fn),0,6);
$fdo = fgets($fb);
for($i = 0;$i < $ufstc;$i++) {
if(!$fagg[$ufst[$i]] && $ufst[$i] && strpos($fdo,$ufst[$i]) !== false) {$fagg[$ufst[$i]] = $fno;unset($ufst[$i]);}
}}
fclose($fn);
fclose($fb);
}
if($fagg && ($fgc = count($fagg))) {
$fu = fopen($dxr.$id."/upload_bk.dat","a");
foreach($fagg as $ufst => $fno) {
fputs($fu,$fno.$ufst."000000".str_pad($fgc,6,0,STR_PAD_LEFT)."\n");
$fgc--;
}
fclose($fu);
}
if($ufst) {
?>
아래 파일은 업로드한 게시물을 찾지 못했습니다.
<form name="dform" method="post" action="exe.php" onsubmit="obfsmt();return false">
<input type="hidden" name="id" value="<?=$uid?>" />
<input type="button" value="전체선택" onclick="selall(2)" />
<input type="button" value="선택반전" onclick="selall(1)" /><br />
<?
foreach($ufst as $delf) {echo "<input type='checkbox' name='delck[]' /><input type='text' name='delf[]' value='{$delf}' style='width:70%' /><br />";}
?>
<input type="submit" value="삭제" />
</form>
<script type="text/javascript">
var idelck = document.getElementsByName("delck[]");
var idelckc = idelck.length;
function selall(fn) {
for(var i=0;i < idelckc;i++) {
if(fn == 2) idelck[i].checked = true;
else idelck[i].checked = (idelck[i].checked)? false:true;
}}
function obfsmt() {
var idelf = document.getElementsByName("delf[]");
for(var i=0;i < idelckc;i++) {
if(idelck[i].checked == false) idelf[i].value = '';
}
document.dform.submit();
}
</script>
<?
}
}}
/** 업로드파일 정리 끝**/
} else if($_POST['exc'] == "modify_ct") {
/** 분류 정리시작 **/
$sct = '';
for($w6 = (int)$wdth[6];$w6 >= 0;$w6--) {
if($w6 > 0) $fn = fopen($dxr.$id."/^".$w6."/no.dat","r");
else $fn = fopen($dxr.$id."/no.dat","r");
while(!feof($fn)){
$fno = (int)substr(fgets($fn),6,2);
if($fno) $sct[$fno] = $sct[$fno] + 1;
}
fclose($fn);
}
if($sct != '') {
$ncct = "\x1b";
for($i = 1;trim($dct[$i]);$i++) {
if($sct[$i]) $dct[$i] = substr($dct[$i],0,-6).str_pad($sct[$i],6,0,STR_PAD_LEFT);
$ncct .= $dct[$i]."\x1b";
}
$ncct .= "\n";
ndc($ncct);
}
/** 분류 정리 끝 **/
} else if($_POST['exc'] == "modify_newrp") {
/** 최근덧글 정리시작 **/
$ffll = '';
$flll = '';
$fla = '';
for($w6 = (int)$wdth[6];$w6 >= 0;$w6--) {
if($w6 > 0) {
$fl = fopen($dxr.$id."/^".$w6."/rlist.dat","r");
$fn = fopen($dxr.$id."/^".$w6."/no.dat","r");
} else {
$fl = fopen($rl,"r");
$fn = fopen($dn,"r");
}
while($fno = fgets($fn)) {
$fn8 = substr($fno,8,1);
if($fn8) $fla[substr($fno,0,6)] = $fn8;
}
fclose($fn);
$fll = '';
for($i = 0;($flo = trim(fgets($fl)));$i++){
$fll[substr($flo,14,10)] = array(substr($flo,0,14).substr($flo,29),$w6,$i);
}
fclose($fl);
if($fll) {
krsort($fll);
$ii = 0;
foreach($fll as $key => $value) {
$flll[$key] = $value;
$ii++;
if($ii == 20 || $ii == $i) break;
}}}
if($flll) {
krsort($flll);
$ii = 0;
foreach($flll as $key => $value) {
list($v1,$v2,$v3) = $value;
$ffll[$v2][$v3] = str_pad($v1,34).$key;
$ii++;
if($ii == 20) break;
}}
$flll = '';
for($w6 = (int)$wdth[6];$w6 >= 0;$w6--) {
if($w6 > 0) $fb = fopen($dxr.$id."/^".$w6."/rbody.dat","r");
else $fb = fopen($dxr.$id."/rbody.dat","r");
for($i = 0;($fbo = fgets($fb));$i++) {
if($ffll[$w6][$i]) {
if(substr($fbo,25,1) == "\x1b") $fbo = "[비밀글]";
else if(substr($fbo,25,1) == "\x18") $fbo = strcut(substr($fbo,strpos($fbo,"\x1b") + 1),100);
else $fbo = strcut(substr($fbo,25),100);
$flb = substr($ffll[$w6][$i],0,6);
if($fla[$flb]) $fbo = "\x1b".$fla[$flb].$fbo;
$ffll[$w6][$i] .= $fbo;
}}
fclose($fb);
}
while($time - @filemtime($dxr.$id."/new_rp.dat@@") < 3) {usleep(50000);$time = time();}
$fm = fopen($dxr.$id."/new_rp.dat","w");
foreach($ffll as $key => $eky) {
foreach($eky as $yke => $value) {
fputs($fm,$value."\n");
}}
fclose($fm);
/** 최근덧글 정리 끝 **/
} else if($_POST['exc'] == "modify_rp") {
/** 덧글 정리시작 **/
for($w6 = (int)$wdth[6];$w6 >= 0;$w6--) {
$fla = '';
if($w6 > 0) {
$fl = fopen($dxr.$id."/^".$w6."/rlist.dat","r");
$don = $dxr.$id."/^".$w6."/no.dat";
} else {
$fl = fopen($dxr.$id."/rlist.dat","r");
$don = $dxr.$id."/no.dat";
}
while(!feof($fl)){
$flo = substr(fgets($fl),0,6);
if(trim($flo)) $fla[$flo] += 1;
}
fclose($fl);
while($time - @filemtime($don."@@") < 3) {usleep(50000);$time = time();}
$jdn = fopen($don."@@","w");
$fn = fopen($don,"r");
while(!feof($fn)){
	$zzz = fgets($fn);
	$zzo = substr($zzz, 0, 6);
	$crp = explode("\x1b", $zzz);
	if($fla[$zzo] != $crp[2]) $zzz = $crp[0]."\x1b".$crp[1]."\x1b".$fla[$zzo]."\x1b".$crp[3]."\x1b".$crp[4]."\x1b".$crp[5]."\x1b".$crp[6]."\x1b\n";
fputs($jdn,$zzz);
}
fclose($fn);
fclose($jdn);
if(filesize($don."@@")) copy($don."@@",$don);
unlink($don."@@");
}
/** 덧글 정리 끝 **/
} else if($_POST['exc'] == "modify_time") {
/* 시간순 재배치 시작 */
$aara = array();
$i = 1;
for($w6 = 1;$w6 <= (int)$wdth[6] + 1;$w6++) {
if($w6 > (int)$wdth[6]) $w7 = '';
else $w7 = "/^".$w6;
if($fl = @fopen($dxr.$id.$w7."/list.dat","r")) {
while(!feof($fl)){
$flt = substr(fgets($fl),0,10);
if((int)$flt) {
$aara[$i] = $flt;
$i++;
}}
fclose($fl);
}}
asort($aara);
$arpg = (int)(($i - 2)/$sett[7]);
$ilngt = $i - 1;
$arcut = 0;
$brpg = 1;
function numchang($gara,$fup,$fuf) {
$ufa = fopen($fuf[0],"a");
if($fuf[1]) $ufb = fopen($fuf[1],"a");
$upa = fopen($fup[0],"r");
if($fup[1]) $upb = fopen($fup[1],"r");
while(!feof($upa)) {
$upr = fgets($upa);
$pr6 = substr($upr,0,6);
if($gara[$pr6]) {
fputs($ufa,$gara[$pr6].substr($upr,6));
if($upb) fputs($ufb,fgets($upb));
} else if($upb) fgets($upb);
}
fclose($upa);
if($upb) fclose($upb);
fclose($ufa);
if($ufb) fclose($ufb);
}
function rhundred($arcut) {
global $sett, $dxr, $id, $wdth, $aara, $brpg, $arpg, $ilngt;
$eara = array_slice($aara,$arcut,$sett[7],true);
if($barc = count($eara)) {
arsort($eara);
if($arcut + $sett[7] < $ilngt) $e = $arcut + $sett[7];else $e = $ilngt;
$bara = array();$fara = array();
foreach($eara as $key => $val) {$bara[$key] = $e;$e--;}
$i = 1;$ii = 1;
$cara = array();
for($w6 = 1;$w6 <= (int)$wdth[6] + 1;$w6++) {
if($w6 > (int)$wdth[6]) $w7 = '';
else $w7 = "/^".$w6;
$dara = array();
if($fn = fopen($dxr.$id.$w7."/no.dat","r")) {
$fl = fopen($dxr.$id.$w7."/list.dat","r");
$fb = fopen($dxr.$id.$w7."/body.dat","r");
while(!feof($fn)){
$fno = fgets($fn);
if(trim($fno)) {
if($bara[$i]) {
$ffn = str_pad($bara[$i],6,0,STR_PAD_LEFT);
$cara[$bara[$i]] = array($ffn.substr($fno,6),fgets($fl),fgets($fb));
$dara[substr($fno,0,6)] = $ffn;
if($ii == $barc) break;
$ii++;
} else {
fgets($fl);fgets($fb);
}
$i++;
}}
fclose($fn);
fclose($fl);
fclose($fb);
numchang($dara,array($dxr.$id.$w7."/rlist.dat",$dxr.$id.$w7."/rbody.dat"),array($dxr.$id."/".$brpg."_rlist.dat",$dxr.$id."/".$brpg."_rbody.dat"));
$fara = array_merge($fara,$dara);
}}
krsort($cara);
$bfn = fopen($dxr.$id."/".$brpg."_no.dat","w");
$bfl = fopen($dxr.$id."/".$brpg."_list.dat","w");
$bfb = fopen($dxr.$id."/".$brpg."_body.dat","w");
foreach($cara as $ii => $value) {
fputs($bfn, $value[0]);
fputs($bfl, $value[1]);
fputs($bfb, $value[2]);
}
fclose($bfn);
fclose($bfl);
fclose($bfb);
numchang($fara,array($dxr.$id."/upload.dat",),array($dxr.$id."/0_upload.dat",));
numchang($fara,array($dxr.$id."/stb.dat",),array($dxr.$id."/0_stb.dat",));
numchang($fara,array($dxr.$id."/rtb.dat",),array($dxr.$id."/0_rtb.dat",));
numchang($fara,array($dxr.$id."/vote.dat",),array($dxr.$id."/0_vote.dat",));
numchang($fara,array($dxr.$id."/new_rp.dat",),array($dxr.$id."/0_new_rp.dat",));
}
$brpg++;
return $arcut;
}
while($arcut <= $ilngt) {$arcut = rhundred($arcut);$arcut += $sett[7];}
$dvd = $brpg -2;
$ncct = str_pad($id,10).str_pad($ilngt,6, 0, STR_PAD_LEFT).str_pad($ilngt,6, 0, STR_PAD_LEFT).substr($wdth[0], 22)."\x1b".$wdth[1]."\x1b".$wdth[2]."\x1b".$wdth[3]."\x1b".$wdth[4]."\x1b".$wdth[5]."\x1b".$dvd."\x1b".$wdth[7]."\x1b".$wdth[8]."\x1b".$wdth[9]."\x1b\n";
nds($ncct);
$fbn = fopen($dxr.$id."/bno.dat","w");
for($bb = 1;$bb < $brpg;$bb++) {
if(file_exists($dxr.$id."/".$bb."_no.dat")) {
if($bb == $brpg -1) $cc = "";
else {
$cc = "/^".$bb;
if(!file_exists($dxr.$id.$cc)) mkdir($dxr.$id.$cc, 0777);
fputs($fbn,str_pad($bb*$sett[7],6,0,STR_PAD_LEFT).str_pad($bb*$sett[7],6,0,STR_PAD_LEFT).str_pad($sett[7],6,0,STR_PAD_LEFT)."\n");
}
rename($dxr.$id."/".$bb."_no.dat",$dxr.$id.$cc."/no.dat");
rename($dxr.$id."/".$bb."_list.dat",$dxr.$id.$cc."/list.dat");
rename($dxr.$id."/".$bb."_body.dat",$dxr.$id.$cc."/body.dat");
if(file_exists($dxr.$id."/".$bb."_rlist.dat")) {
rename($dxr.$id."/".$bb."_rlist.dat",$dxr.$id.$cc."/rlist.dat");
rename($dxr.$id."/".$bb."_rbody.dat",$dxr.$id.$cc."/rbody.dat");
} else {
fclose(fopen($dxr.$id.$cc."/rlist.dat","w"));
fclose(fopen($dxr.$id.$cc."/rbody.dat","w"));
}}}

if(file_exists($dxr.$id."/0_upload.dat")) {
rename($dxr.$id."/0_upload.dat",$dxr.$id."/upload.dat");
rename($dxr.$id."/0_stb.dat",$dxr.$id."/stb.dat");
rename($dxr.$id."/0_rtb.dat",$dxr.$id."/rtb.dat");
rename($dxr.$id."/0_vote.dat",$dxr.$id."/vote.dat");
rename($dxr.$id."/0_new_rp.dat",$dxr.$id."/new_rp.dat");
}
fclose($fbn);
function RmDirR($dxx) {
if(@is_dir($dxx)) {
if($d = opendir($dxx)) {
while($entry = readdir($d)) {
if($entry != "." && $entry != "..") {
if(is_dir($dxx."/".$entry)) RmDirR($dxx."/".$entry);
else @unlink($dxx."/".$entry);
}}
closedir($d);
}
@rmdir($dxx);
}}
for($i = $brpg -1;file_exists($dxr.$id."/^".$i);$i++) RmDirR($dxr.$id."/^".$i);
/* 시간순 재배치 끝 */
} else if($_POST['selected']) {
function mmdd($nn, $num) {
	global $id10, $dxr, $dim, $sss, $fsbs, $time;
if(!$sss[22] && (int)$nn && !$sss[64] && !$sss[62]) {
if($_POST['moveto']) {
$ssm = $fsbs[$_POST['moveto']];
if(!$ssm[12] && !$ssm[64] && !$ssm[52]) $ssm = 2;
}
$nxm = $num;
foreach($nn as $key => $value) {
while($nxm){
$cnt = 0;
$file = '';
$key = (int)$key;
$file[0] = $dxr."_member_/list_".$key;
$file[1] = $dxr."_member_/rp_".$key;
$file[2] = $dxr."_member_/scrap_".$key;
if(@filesize($file[$nxm])) {
while($time - @filemtime($file[$nxm]."@@") < 3) {usleep(50000);$time = time();}
$jfnxm = fopen($file[$nxm]."@@","w");
$fd = fopen($file[$nxm],"r");
while(!feof($fd)) {
$fdo = fgets($fd);
if(substr($fdo, 0, 10) == $id10 && strpos($value,substr($fdo,10,6).":") !== false) {
if($_POST['moveto'] && $ssm == 2) $fdo = str_pad($_POST['moveto'],10).substr($fdo, 10);
else {
$fdo = "";
$cnt++;
}
}
fputs($jfnxm, $fdo);
}
fclose($fd);
fclose($jfnxm);
copy($file[$nxm]."@@",$file[$nxm]);
unlink($file[$nxm]."@@");
if($_POST['moveto'] == "" && $nxm < 3) {
chmbr($key, $nxm, -$cnt);
}}
if($num == 2 || $nxm == 3) break;
else $nxm = 3;
}}}}
if($_POST['exc'] == "notc_add" || $_POST['exc'] == "notc_dell"){
$ss4 = $wdth[4];
$ttt = explode(':',$_POST['selected']);
for($i = 0; (int)$ttt[$i]; $i++){
$tt = (int)$ttt[$i].'^';
if($_POST['exc'] == "notc_dell" ) $wdth[4] = str_replace($tt, '', $wdth[4]);
else if($_POST['exc'] == "notc_add" && strpos($wdth[4], $tt) === false) $wdth[4] .= $tt;
}
$ncct = $wdth[0]."\x1b".$wdth[1]."\x1b".$wdth[2]."\x1b".$wdth[3]."\x1b".$wdth[4]."\x1b".$wdth[5]."\x1b".$wdth[6]."\x1b".$wdth[7]."\x1b".$wdth[8]."\x1b".$wdth[9]."\x1b\n";
nds($ncct);
$fns = fopen($dxr.$id."/notice.dat","a+");
if($_POST['exc'] == "notc_add"){
$fn = fopen($dn,"r");
$fl = fopen($dl,"r");
while(!feof($fn) && $i >= 0){
$zzz = substr(fgets($fn), 0, 6);
if(trim($zzz)){
if(false !== strpos($_POST['selected'], $zzz.":")) {
if(strpos($ss4, (int)$zzz."^") === false) {
fputs($fns, $zzz.fgets($fl));
}
$i--;
} else fgets($fl);
}
}
fclose($fn);
fclose($fl);
fclose($fns);
} else {
$jnotice = fopen($dxr.$id."/notice.dat@@","w");
while(!feof($fns)) {
$fnso = fgets($fns);
if(strpos($_POST['selected'], substr($fnso,0,6).":") === false)  fputs($jnotice, $fnso);
}
fclose($fns);
fclose($jnotice);
copy($dxr.$id."/notice.dat@@",$dxr.$id."/notice.dat");
unlink($dxr.$id."/notice.dat@@");
}
} else if($_POST['exc'] == "delete_body") {
while($time - @filemtime($db."@@") < 3) {usleep(50000);$time = time();}
$jdb = fopen($db."@@","w");
$fb = fopen($db,"r");
$fn = fopen($dn,"r");
while(!feof($fn)){
$zzz = fgets($fn);
$yyy = fgets($fb);
if(trim($zzz)) {
if(false !== strpos($_POST['selected'], substr($zzz, 0, 6).":")) $yyy = " \n";
fputs($jdb,$yyy);
}}
fclose($fn);
fclose($fb);
fclose($jdb);
copy($db."@@",$db);
unlink($db."@@");
} else if($_POST['exc'] == "delete_lnk" || $_POST['exc'] == "delete_thumb" || $_POST['exc'] == "delete_tag" || $_POST['exc'] == "delete_ip" || $_POST['exc'] == "add_tag") {
while($time - @filemtime($dl."@@") < 3) {usleep(50000);$time = time();}
if($_POST['exc'] == "add_tag") {$_POST['addtag'] = str_replace(",,",",",preg_replace("`[\s]?,[\s]?`", ",",str_replace("\'","´",str_replace('\"','˝',$_POST['addtag'].","))));}
$jdl = fopen($dl."@@","w");
$fl = fopen($dl,"r");
$fn = fopen($dn,"r");
while(!feof($fn)){
$zzz = fgets($fn);
$xxx = fgets($fl);
if(trim($zzz)) {
$zn = substr($zzz, 0, 6);
if(false !== strpos($_POST['selected'], $zn.":")) {
$yyy = explode("\x1b",$xxx);
if($_POST['exc'] == "delete_thumb") {if(substr($yyy[4],0,7) != 'http://' && substr($yyy[4],-6,3) != '_s.') @unlink($dxr.$id."/files/".$yyy[4]);$yyy[4] = "";}
else if($_POST['exc'] == "delete_lnk") $yyy[5] = "";
else if($_POST['exc'] == "delete_tag") {if($yyy[6]) tgxedit($yyy[6],2,0);$yyy[6] = "";}
else if($_POST['exc'] == "add_tag") {
$adtt = ",".$_POST['addtag'];
if($yyy[6] && $yyy[6] != ",") {
foreach(explode(",",$_POST['addtag']) as $adt) {
$adt = ",".$adt.",";
if($adt) {
if(strpos(",".$yyy[6],$adt) !== false) $adtt = str_replace($adt,",",$adtt);
}}}
tgxedit($adtt,1,0);
if(substr($yyy[6],-1,1) == ",") $adtt = substr($adtt,1);
$yyy[6] .= $adtt;
}
else if($_POST['exc'] == "delete_ip") $yyy[0] = substr($yyy[0],0,10)."               ";
$xxx = $yyy[0]."\x1b".$yyy[1]."\x1b".$yyy[2]."\x1b".$yyy[3]."\x1b".$yyy[4]."\x1b".$yyy[5]."\x1b".$yyy[6]."\x1b\n";
}
}
fputs($jdl,$xxx);
}
fclose($fn);
fclose($fl);
fclose($jdl);
copy($dl."@@",$dl);
unlink($dl."@@");
} else if($_POST['exc'] == "delete_rp" || $_POST['exc'] == "delete_stb" || $_POST['exc'] == "delete_rtb" || $_POST['exc'] == "change" || $_POST['exc'] == "limit") {
while($time - @filemtime($dn."@@") < 3) {usleep(50000);$time = time();}
$jdn = fopen($dn."@@","w");
$fn = fopen($dn,"r");
while(!feof($fn)){
$zzz = fgets($fn);
if(trim($zzz)){
if(false !== strpos($_POST['selected'], substr($zzz, 0, 6).":") && trim($zzz)) {
if($_POST['exc'] == "change" && $_POST['changeto']) {
$nnct = (int)substr($zzz, 6, 2);
if($nnct) $nct[$nnct] = $nct[$nnct] + 1;
$ncng = $ncng + 1;
$zzz = substr($zzz, 0, 6).$_POST['changeto'].substr($zzz, 8);
} else if($_POST['exc'] == "limit") {
$zzz = substr($zzz,0,8).$_POST['perm_vw'].substr($zzz,9);
} else {
$zzz = explode("\x1b", trim($zzz));
if($_POST['exc']  == "delete_rp") $zzz[2] = 0;
else if($_POST['exc']  == "delete_stb") $zzz[3] = 0;
else if($_POST['exc']  == "delete_rtb") $zzz[4] = 0;
$zzz = $zzz[0]."\x1b".$zzz[1]."\x1b".$zzz[2]."\x1b".$zzz[3]."\x1b".$zzz[4]."\x1b".$zzz[5]."\x1b".$zzz[6]."\x1b\n";
}
}
}
fputs($jdn,$zzz);
}
fclose($fn);
fclose($jdn);
copy($dn."@@",$dn);
unlink($dn."@@");
if($_POST['exc'] != "change" && $_POST['exc'] != "limit") {
if($_POST['exc']  == "delete_stb") $rl = $dib_2;
else if($_POST['exc']  == "delete_rtb") $rl = $dib_3;
else if($_POST['exc']  == "delete_rp") {
$frd = "";
while($time - @filemtime($rb."@@") < 3) {usleep(50000);$time = time();}
$jrb = fopen($rb."@@","w");
$fb = fopen($rb, "r");
$newrp = '';
}
while($time - @filemtime($rl."@@") < 3) {usleep(50000);$time = time();}
$jrl = fopen($rl."@@","w");
$fr = fopen($rl,"r");
while(!feof($fr)){
$yyy = fgets($fr);
if(false !== strpos($_POST['selected'], substr($yyy, 0, 6).":")) {
if($_POST['exc']  == "delete_rp") {
$newrp .= substr($yyy, 0, 6).":";
if(($mro = substr($yyy, 24, 5)) && $mro != '00000') $frd[$mro] .= substr($yyy, 0, 6).":";
fgets($fb);
}
$yyy = "";
} else if($_POST['exc']  == "delete_rp") fputs($jrb, fgets($fb));
fputs($jrl,$yyy);
}
fclose($fr);
fclose($jrl);
copy($rl."@@",$rl);
unlink($rl."@@");
if($_POST['exc']  == "delete_rp") {
fclose($fb);
fclose($jrb);
copy($rb."@@",$rb);
unlink($rb."@@");
if($frd) mmdd($frd, 5);
newrp($newrp);
}
 } else if($_POST['exc'] == "change") {
 $nnct = "\x1b";
for($i = 1;trim($dct[$i]);$i++) {
$ii = str_pad($i, 2, 0, STR_PAD_LEFT);
 if($nct[$i]) {
 $ncct = $ctgn[$ii] - $nct[$i];
 if($ncct < 0) $ncct = 0;
 $dct[$i] = $ctg[$ii].str_pad($ncct,6,0,STR_PAD_LEFT);
}
 if($i == (int)$_POST['changeto']) {
 $ncct = $ctgn[$ii] + $ncng;
 $dct[$i] = $ctg[$ii].str_pad($ncct,6,0,STR_PAD_LEFT);
}
 $nnct .= $dct[$i]."\x1b";
 }
 $nnct .= "\n";
ndc($nnct);
 }
} else if($_POST['exc'] == "delete" || $_POST['moveto']) {
$cnx = substr_count($_POST['selected'], ':');
$nnx = $wdth[4];
$cxl = (int)substr($unx[0], 10, 6) + $cnx;
$frmf = ($wdth[7][33])? "icon/".$id."/":$dxr.$id."/files/";
$frmt = ($unx[7][33])? "icon/".$_POST['moveto']."/":$dxr.$_POST['moveto']."/files/";
if(!is_dir($frmt)) mkdir($frmt,0777);
$unx = $unx[5] + 1;
if($_POST['moveto']) {
$tpf = $dxr.$_SERVER['REMOTE_ADDR']."_5";
$tpp = $dxr.$_SERVER['REMOTE_ADDR']."_p";
}
while($time - @filemtime($dn."@@") < 3) {usleep(50000);$time = time();}
$jdn = fopen($dn."@@","w");
$fn = fopen($dn,"r");
while($time - @filemtime($dl."@@") < 3) {usleep(50000);$time = time();}
$jdl = fopen($dl."@@","w");
$fl = fopen($dl,"r");
while($time - @filemtime($db."@@") < 3) {usleep(50000);$time = time();}
$jdb = fopen($db."@@","w");
$fb = fopen($db,"r");
$nox = "";
if($_POST['moveto']) {
$jjdn = fopen($dn."@@@", "w");
$jjdl = fopen($dl."@@@", "w");
$jjdb = fopen($db."@@@", "w");
$ttn = "";
}
$frd = "";
while(!feof($fn)){
$zzz = fgets($fn);
$xxx = fgets($fl);
$yyy = fgets($fb);
if(trim($zzz)) {
$zn = substr($zzz, 0, 6);
if(false !== strpos($_POST['selected'], $zn.":")) {
$nnct = (int)substr($zzz, 6, 2);
if($nnct) $nct[$nnct] = $nct[$nnct] + 1;
$mro = substr($zzz, 9, strpos($zzz,"\x1b") - 9);
if($mro && $mro >= 1) $frd[$mro] .= $zn.":";
$xt4 = explode("\x1b",$xxx);
$xt4 = $xt4[4];
if($xt4 && substr($xt4, 0, 7) != 'http://' && file_exists($frmf.$xt4)) {
if($_POST['exc'] == 'copy') copy($frmf.$xt4, $frmt.$xt4);
else rename($frmf.$xt4, $frmt.$xt4);
}
if($_POST['exc'] != 'copy' && false !== strpos($nnx, (int)$zn."^")) {
$nox[$zn] = "1";
$nnx = explode((int)$zn."^", $nnx);
$nnx = $nnx[0].$nnx[1];
}
if($_POST['moveto']) {
$cxl = str_pad($cxl, 6, 0, STR_PAD_LEFT);
$ttn[$zn] = $cxl;
fputs($jjdn, $cxl.substr($zzz, 6));
fputs($jjdl, $xxx);
fputs($jjdb, str_replace($exe."?id=".$id,$exe."?id=".$_POST['moveto'],$yyy));
$cxl--;
}
if($_POST['exc'] != 'copy') {
$zzz = "";
$xxx = "";
$yyy = "";
}
}
}
fputs($jdn,$zzz);
fputs($jdl,$xxx);
fputs($jdb,$yyy);
}
fclose($fn);
fclose($fl);
fclose($fb);
fclose($jdn);
fclose($jdl);
fclose($jdb);
if($_POST['exc'] != 'copy') {
copy($dn."@@",$dn);
copy($dl."@@",$dl);
copy($db."@@",$db);
if($frd) mmdd($frd, 4);
}
unlink($dn."@@");
unlink($dl."@@");
unlink($db."@@");
$frp = "";
if($_POST['moveto']) {
while($time - @filemtime($dxr.$_POST['moveto']."/no.dat@@") < 3) {usleep(50000);$time = time();}
fclose(fopen($dxr.$_POST['moveto']."/no.dat@@","w"));
$fn = fopen($dxr.$_POST['moveto']."/no.dat","r");
while($time - @filemtime($dxr.$_POST['moveto']."/list.dat@@") < 3) {usleep(50000);$time = time();}
fclose(fopen($dxr.$_POST['moveto']."/list.dat@@","w"));
$fl = fopen($dxr.$_POST['moveto']."/list.dat","r");
while($time - @filemtime($dxr.$_POST['moveto']."/body.dat@@") < 3) {usleep(50000);$time = time();}
fclose(fopen($dxr.$_POST['moveto']."/body.dat@@","w"));
$fb = fopen($dxr.$_POST['moveto']."/body.dat","r");
while(!feof($fn)) {
fputs($jjdn, fgets($fn));
fputs($jjdl, fgets($fl));
fputs($jjdb, fgets($fb));
}
fclose($fn);
fclose($fl);
fclose($fb);
fclose($jjdn);
fclose($jjdl);
fclose($jjdb);
copy($dn."@@@",$dxr.$_POST['moveto']."/no.dat");
unlink($dxr.$_POST['moveto']."/no.dat@@");
copy($dl."@@@",$dxr.$_POST['moveto']."/list.dat");
unlink($dxr.$_POST['moveto']."/list.dat@@");
copy($db."@@@",$dxr.$_POST['moveto']."/body.dat");
unlink($dxr.$_POST['moveto']."/body.dat@@");
unlink($dn."@@@");
unlink($dl."@@@");
unlink($db."@@@");
}
if($nox) {
$fns = fopen($dxr.$id."/notice.dat","r");
$jnotice = fopen($dxr.$id."/notice.dat@@", "w");
while(!feof($fns)) {
$fnx = fgets($fns);
$fz = substr($fnx, 0, 6);
if($nox[$fz] == "1") $fnx = "";
fputs($jnotice,$fnx);
}
fclose($fns);
fclose($jnotice);
copy($dxr.$id."/notice.dat@@",$dxr.$id."/notice.dat");
unlink($dxr.$id."/notice.dat@@");
}

$iw = 1;
while($iw < 5) {
if($iw == 2) $rl = $dib_2;
else if($iw == 3) $rl = $dib_3;
else if($iw == 4) $rl = $du;

if($_POST['moveto']) {
$ttpp = fopen($tpp, "w");
}
if($iw == 1) {
while($time - @filemtime($rb."@@") < 3) {usleep(50000);$time = time();}
$jrb = fopen($rb."@@","w");
$fb = fopen($rb, "r");
if($_POST['moveto']) {
$ttbb = fopen($tpf,"w");
while($time - @filemtime($dxr.$_POST['moveto']."/new_rp.dat@@") < 3) {usleep(50000);$time = time();}
$jnew = fopen($dxr.$_POST['moveto']."/new_rp.dat@@","w");
$fm = fopen($dxr.$_POST['moveto']."/new_rp.dat","r");
$fmo = fgets($fm);
$fmoo = (int)substr($fmo, 6, 7);
$fi = 1;
}
}
while($time - @filemtime($rl."@@") < 3) {usleep(50000);$time = time();}
$jrl = fopen($rl."@@","w");
$fr = fopen($rl,"r");
while(!feof($fr)){
$yyy = fgets($fr);
if(trim($yyy)){
$yn = substr($yyy, 0, 6);
if(false !== strpos($_POST['selected'], $yn.":")) {
if($iw == 1) {
if($mro = $mro = substr($yyy, 24, 5) && $mro != '00000') $frp[$mro] .= $yn.":";
if($_POST['moveto']) {
$fbo = fgets($fb);
$newrp = str_pad($fmoo + $fi,7,0,STR_PAD_LEFT);
$jneww[$fi] = $ttn[$yn].$yyy[13].str_pad(substr($yyy,29,-1),20).substr($yyy,14,10).strcut(substr($fbo,25,-1),100)."\n";
fputs($ttpp,$ttn[$yn].$newrp.substr($yyy, 13));
fputs($ttbb, $fbo);
} else fgets($fb);
$fi++;
}
if($_POST['moveto'] && $iw != 1) {
if($iw == 4) $yyy = substr($yyy, 0, -7).str_pad($unx, 6, 0, STR_PAD_LEFT)."\n";
fputs($ttpp,$ttn[$yn].substr($yyy, 6));
}
if($iw == 4) {
$fil = str_replace("%","",urlencode(substr($yyy, 6, -13)));
if(file_exists($frmf.$fil)) {
if($_POST['moveto']) {
$unx++;
copy($frmf.$fil,$frmt.$fil);
}
if($_POST['exc'] != 'copy') {
unlink($frmf.$fil);
}}}
if($_POST['exc'] != 'copy') $yyy = "";
} else if($iw == 1) fputs($jrb,fgets($fb));
}
fputs($jrl,$yyy);
}
fclose($fr);
fclose($jrl);
if($_POST['exc'] != 'copy') copy($rl."@@",$rl);
unlink($rl."@@");
if($iw  == 1) {
if($_POST['exc'] != 'copy' && $frp) mmdd($frp, 5);
fclose($fb);
fclose($jrb);
if($_POST['exc'] != 'copy') copy($rb."@@",$rb);
unlink($rb."@@");
if($_POST['moveto']) {
while($time - @filemtime($dxr.$_POST['moveto']."/rbody.dat@@") < 3) {usleep(50000);$time = time();}
fclose(fopen($dxr.$_POST['moveto']."/rbody.dat@@","w"));
$mxtx = fopen($dxr.$_POST['moveto']."/rbody.dat", "r");
while(!feof($mxtx)) fputs($ttbb, fgets($mxtx));
fclose($mxtx);
fclose($ttbb);
copy($tpf,$dxr.$_POST['moveto']."/rbody.dat");
unlink($dxr.$_POST['moveto']."/rbody.dat@@");
unlink($tpf);
for($i = 1;$i < $fi;$i++) fputs($jnew,substr($jneww[$i],0,6).str_pad($fmoo + $fi - $i,7,0,STR_PAD_LEFT).substr($jneww[$i],6));
fputs($jnew,$fmo);
while($fmo = fgets($fm)) fputs($jnew,$fmo);
fclose($jnew);
fclose($fm);
copy($dxr.$_POST['moveto']."/new_rp.dat@@",$dxr.$_POST['moveto']."/new_rp.dat");
unlink($dxr.$_POST['moveto']."/new_rp.dat@@");
}
}
if($_POST['moveto']) {
if($iw == 1) $mtx = $dxr.$_POST['moveto']."/rlist.dat";
else if($iw == 2) $mtx = $dxr.$_POST['moveto']."/stb.dat";
else if($iw == 3) $mtx = $dxr.$_POST['moveto']."/rtb.dat";
else if($iw == 4) $mtx = $dxr.$_POST['moveto']."/upload.dat";
while($time - @filemtime($mtx."@@") < 3) {usleep(50000);$time = time();}
fclose(fopen($mtx."@@","w"));
$mxtx = fopen($mtx, "r");
while(!feof($mxtx)) fputs($ttpp, fgets($mxtx));
fclose($mxtx);
fclose($ttpp);
copy($tpp,$mtx);
unlink($mtx."@@");
unlink($tpp);
}
$iw++;
}

while($time - @filemtime($ds."@@") < 3) {usleep(50000);$time = time();}
$jds = fopen($ds."@@","w");
$fs = fopen($ds,"r");
while($time - @filemtime($dc."@@") < 3) {usleep(50000);$time = time();}
$jdc = fopen($dc."@@","w");
$fc = fopen($dc,"r");
while(!feof($fs) && $sss = trim(fgets($fs))){
$fco = fgets($fc);
if(trim(substr($sss, 0, 10)) == $id) {
$dct = explode("\x1b",$fco);
$fco = "\x1b";
$ss = explode("\x1b", $sss);
if($_POST['exc'] == 'copy') $cnt = (int)substr($sss, 16, 6);
else $cnt = (int)substr($sss, 16, 6) - $cnx;
$slta = (int)substr($ss[0],10,6);
while($_POST['exc'] != 'copy'  && !$sss[66] && false !== strpos($_POST['selected'], str_pad($slta,6,0,STR_PAD_LEFT).":")) $slta--;
$sss = substr($ss[0],0,10).str_pad($slta,6,0,STR_PAD_LEFT).str_pad($cnt, 6, 0, STR_PAD_LEFT).substr($ss[0], 22)."\x1b".$ss[1]."\x1b".$ss[2]."\x1b".$ss[3]."\x1b".$nnx."\x1b".$ss[5]."\x1b".$ss[6]."\x1b".$ss[7]."\x1b".$ss[8]."\x1b".$ss[9]."\x1b";
for($s = 1;trim($dct[$s]);$s++) {
if($nct[$s]) {
$ncct = (int)substr($dct[$s],-6) - $nct[$s];
if($ncct < 0) $ncct = 0;
$dct[$s] = substr($dct[$s],0,-6).str_pad($ncct,6,0,STR_PAD_LEFT);
}
$fco .= $dct[$s]."\x1b";
}
$fco .= "\n";
} else if(trim(substr($sss, 0, 10)) == $_POST['moveto']) {
$ss = explode("\x1b", $sss);
$cxl = (int)substr($ss[0], 10, 6) + $cnx;
$cxt = (int)substr($ss[0], 16, 6) + $cnx;
$unx--;
$sss = substr($ss[0], 0, 10).str_pad($cxl, 6, 0, STR_PAD_LEFT).str_pad($cxt, 6, 0, STR_PAD_LEFT).substr($ss[0], 22)."\x1b".$ss[1]."\x1b".$ss[2]."\x1b".$ss[3]."\x1b".$ss[4]."\x1b".$unx."\x1b".$ss[6]."\x1b".$ss[7]."\x1b".$ss[8]."\x1b".$ss[9]."\x1b";
}
fputs($jds,$sss."\n");
fputs($jdc,$fco);
}
fclose($fs);
fclose($jds);
copy($ds."@@",$ds);
unlink($ds."@@");
fclose($fc);
fclose($jdc);
if($_POST['exc'] != 'copy') copy($dc."@@",$dc);
unlink($dc."@@");
if($xn) {
$xn = substr($xn,2);
while($time - @filemtime($dxr.$id."/bno.dat@@") < 3) {usleep(50000);$time = time();}
$jbn = fopen($dxr.$id."/bno.dat@@","w");
$bn = fopen($dxr.$id."/bno.dat","r");
for($aa=1;$bno = fgets($bn);$aa++) {
if($aa == $xn) {
$n6 = substr($bno,6,6) -$cnx;
$n12 = substr($bno,12,6) -$cnx;
$bno = substr($bno,0,6).str_pad($n6,6,0,STR_PAD_LEFT).str_pad($n12,6,0,STR_PAD_LEFT).substr($bno,18);
} else if($aa > $xn) {
$n6 = substr($bno,6,6) -$cnx;
$bno = substr($bno,0,6).str_pad($n6,6,0,STR_PAD_LEFT).substr($bno,12);
}
fputs($jbn,$bno);
}
fclose($bn);
fclose($jbn);
if($_POST['exc'] != 'copy') copy($dxr.$id."/bno.dat@@",$dxr.$id."/bno.dat");
unlink($dxr.$id."/bno.dat@@");
}
newrp($_POST['selected']);
}
}
}
if($_POST['exc'] != "modify_upload" || !$ufst) scrhref($_POST['request'],1,0);
?>