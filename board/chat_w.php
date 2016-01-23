<?
ob_start();
session_start();
/*
 * srchat 218.0 -srboard 대문위젯/좌우메뉴용
 * Developed By 사리 (sariputra3@naver.com)
 * License : GNU Public License (GPL)
 * Homepage : http://srboard.styx.kr/srboard/index.php?id=blog&ct=06
 */
$chat = "chat_w.php";
$chtdate = "chat/srchat_cht/"; //데이타파일 저장경로(권한777)
$chtlastgap = 10; // 단위는 초, 접속여부 판단하는 현재시간-마지막접속시간 간격
$chtemptgap = 180; // 단위는 초, 퇴장으로 판단하는, 자리비움 경과시간
$chticodir = "icon/emoticon"; // 이모티콘 저장된 경로
$chtmid = "icon/srchat.swf"; // 알림음 파일경로
$chtusrinout = 0; // 사용자 입출력상황 본문 출력 여부 (0: 출력 안 함, 1: 출력)
$chtchange = 1; // 사용자 닉네임변경 본문 출력 여부 (0: 출력 안 함, 1: 출력)
$chtaway = 1; // 자리비움하고 새로고침 했을 때, 자리비움상태 유지 여부 (0:해제,1:유지)
$chtread = 10; // 처음 접속했을 때, 읽어오는 본문의 갯수 (0 ~ 90)
$chtfnlen = 20; // 본문에 파일이름 길이
$time = time();
$cht_isadmin = 0;
$chthis = date("d.H:i:s",$time);
$exxt = array('_GET','_POST','_SESSION','_COOKIE','_FILES','_SERVER','sessid','isadmin');
for($i=0;$i < 8;$i++) if(isset($_GET[$exxt[$i]]) || isset($_POST[$exxt[$i]])) exit;
$chtip = str_pad(str_replace('.','',$_SERVER['REMOTE_ADDR']),12,'x'); /* ip로 사용자구분 할때 */
//$chtip = substr(session_id(),0,12); /* ip로 사용자구분 안할때 */
if($_SESSION['chtmobile']) $chtmbilew = "1";else $chtmbilew = "0";
if($_SESSION['srchatsr']) {
if(!$_SESSION['mk'] || $_COOKIE['mck'] != md5($_SESSION['mk'])) {$_SESSION['srchatsr'] = '';$delmip = 1;}
else {
list($level,$imgm) = $_SESSION['srchatsr'];
if($level == 9) {$cht_isadmin = 1;$chtmbilew .= "2";} //관리자구분
else $chtmbilew .= "1";
$chtnck = $_SESSION['m_nick'];
$chtnckk = $chtmbilew.$imgm."\x1a".$level."\x1a".$chtnck;
}}
if(!$chtnckk) {$chtismbr = $chtmbilew."0";if(!$_SESSION['chtnick']) $_SESSION['chtnick'] = "손님_".substr($chtip, 4, 4);$chtnck = $_SESSION['chtnick'];$chtnckk = $chtismbr.$chtnck;} 
$chtexit = ($_SERVER['HTTP_REFERER'] && false === strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))? '':'1';
function cht_vnmb($view) {
$ff = opendir($view);
while($fg = readdir($ff)) {
if($fg != '.' && $fg != '..') {$fff = $fg;break;}
}
closedir($ff);
return $fff;
}
function cht_mkroom($chtyd) {
mkdir($chtyd, 0777);
mkdir($chtyd."/_data", 0777);
mkdir($chtyd."/_gst", 0777);
mkdir($chtyd."/_ban", 0777);
mkdir($chtyd."/_upload", 0777);
mkdir($chtyd."/_gst/wt", 0777);
fclose(fopen($chtyd."/_bak","w"));
fclose(fopen($chtyd."/_gst/_guest","w"));
fclose(fopen($chtyd."/_gst/m_","w"));
fclose(fopen($chtyd."/_gst/gv","w"));
fclose(fopen($chtyd."/_gst/wt/00","w"));
$fpa = fopen($chtyd."/.htaccess","w");
fputs($fpa,"order deny,allow\ndeny from all");
fclose($fpa);
$ftb = fopen($chtyd."/_chtntb","w");
fputs($ftb, "2\n0\n80\n2\n0\n");
fclose($ftb);
$ftc = fopen($chtyd."/_chtntc","w");
fputs($ftc, "1\nGulim\n8\n1\nN\n1\n1\n30\n0\n0\n450px\n350px\nh\n330px\n120px\n256\n1\n0\n0\n0\n0\n0\n0\n1500\n1\n11\n2\n0\n0\n1\n1\n2\n3\n3000\n1\n1\n0\n30\n0\n");
fclose($ftc);
$fs = fopen($chtyd."/_fsum","w");fputs($fs,"0\n0");fclose($fs);
}
if(!$chtid) $chtid = ($_POST['chtid'])? $_POST['chtid'] : $_GET['chtid'];
if(($chtdata = cht_vnmb($chtdate)) && $chtid) {
$chtfid = $chtdate.$chtdata."/".$chtid."/";
if(!file_exists($chtfid)) $chtfid = '';
$chtxwd = $chtfid."_xword"; // 금지된 표현
//$chtxnk = $chtfid."_xnick"; // 금지닉네임
if($chtexit && file_exists($chtfid."_ban/".$chtip)) {
$chtexit = 'exit';
echo "<h1>접속차단되셨습니다</h1>";
} else if($chtfid) {
$chtdt = $chtfid."_data/";
$chtbk = $chtfid."_bak";
$ischtbk = (file_exists($chtbk))?1:0;
$chtgt = $chtfid."_gst/_guest";
$chtwt = $chtfid."_gst/wt/";
$chtgv = $chtfid."_gst/gv";
$chtmip = $chtfid."_gst/m_";
$chtqip = $chtfid."_gst/q_";
if($delmip) {@unlink($chtmip.$chtip);@unlink($chtqip.$chtip);}
$chtup = $chtfid."_upload/";
$dsm = $chtfid."_fsum";
$dwv = cht_vnmb($chtwt);
function chtrmfd($dirName,$n) {
$dirName = urldecode($dirName);
if(is_dir($dirName)) {
if(substr($dirName, -1) != "/") $dirName .= "/";
$d = opendir($dirName);
while($entry = readdir($d)) {
if($entry != "." && $entry != "..") {
if(is_dir($dirName.$entry)) chtrmfd($dirName.$entry,$n);
else @unlink($dirName.$entry);
}
}
closedir($d);
if($n) RmDir($dirName);
}
}
function writee($dwn,$mema) {
 global $ischtbk, $chtbk, $chtwt, $chtdt;
$ndwv = $dwn%90 + 1;
$ndwv = str_pad($ndwv, 2, '0', STR_PAD_LEFT);
@rename($chtwt.$dwn, $chtwt.$ndwv);
$fp = fopen($chtdt.$ndwv,"w");
fputs($fp,$mema);
fclose($fp);
if($ischtbk) {
$bk=fopen($chtbk,"a");
fputs($bk,$mema."\n");
fclose($bk);
}
return $ndwv;
}
function whisp($rno) {
 global $chtip, $chtdt;
$rnt = count($rno);
for($i = 0;$rno[$i];$i++) {
$rnn = str_pad($rno[$i],2,0,STR_PAD_LEFT);
if($fsz = @filesize($chtdt.$rnn)) {
$fp = fopen($chtdt.$rnn,"r");
$fpo = fread($fp,$fsz);
fclose($fp);
if(substr($fpo, 0, 2) == "\x1b\x1b") {
if(substr($fpo,2,12) == $chtip || substr($fpo,14,12) == $chtip)  $dtt .= substr($fpo,26)."\x18";
} else $dtt .= $fpo."\x18";
}
}
return $dtt;
}
function reaad($wtend,$red) {
 global $chtip;
$r = 0;
if($wtend > $red) {
for($i =$red + 1;$i <= $wtend;$i++) {$rno[$r] = $i;$r++;}
} else {
if($red < 90) {for($i = $red + 1;$i <= 90;$i++) {$rno[$r] = $i;$r++;}}
for($i = 1;$i <= $wtend;$i++) {$rno[$r] = $i;$r++;}
}
return whisp($rno);
}
function newtext($text) {
if($text) {
$text = stripslashes($text);
$text = preg_replace("`[\x1b\x18\x7f\t]`", "", $text);
$text = str_replace("<", "&lt;", $text);
$text = str_replace(">", "&gt;", $text);
}
return $text;
}
function guestt($hp,$gp) {
global $chtgt, $chtgv, $chtqip;
while(file_exists($chtgt."_tmp")) {usleep(5000);}
$fg = fopen($chtgt,"r");
$fmp = fopen($chtgt."_tmp","w");
while($fgo = fgets($fg)) {
if(substr($fgo,0,12) == $hp) {
if($gp > 1) {
if(file_exists($chtqip.$hp)) {$fgo = substr($fgo,0,13)."0".substr($fgo,14);unlink($chtqip.$hp);}
else {$fgo = substr($fgo,0,13)."1".substr($fgo,14);fclose(fopen($chtqip.$hp,"w"));}
fputs($fmp,$fgo);
}} else fputs($fmp,$fgo);
}
fclose($fg);
fclose($fmp);
copy($chtgt."_tmp",$chtgt);
@unlink($chtgt."_tmp");
fclose(fopen($chtgv,"w"));
}
if($_POST['tt']) {
// 1.내부데이타처리 시작
header ("Content-Type: text/html; charset=UTF-8");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
if($_POST['content'] && substr($_POST['content'],1) == "579a584") {
if($_POST['content'] == '7579a584') {
if($_SESSION['cht_out'] == $chtid) $_SESSION['cht_out'] = '';
} else if($_POST['content'] == "6579a584") {
guestt($chtip,3);
} else if($_POST['content'] == "8579a584" || $_POST['content'] == "9579a584") { // 퇴장할때 실행되는
if($_POST['content'] == "8579a584") $_SESSION['cht_out'] = $chtid;
if(substr($chtid,0,2) == '__') {
if($fg = @fopen($chtgt,'r')) {
if(trim(fgets($fg)) == '' || trim(fgets($fg)) == '') chtrmfd($chtfid,1);
fclose($fg);
} else chtrmfd($chtfid,1);}
if(!$chtaway || $time - @filemtime($chtqip.$chtip) > $chtemptgap) {
guestt($chtip,1);
if($chtusrinout) {
$dwv = writee($dwv,"\x1b".$chtnck.">>\x1b".$chthis."\x1b");
}
@unlink($chtmip.$chtip);@unlink($chtqip.$chtip);
}}
exit;
}
$mdd = 0;
if($_POST['neme']){
if(($_POST['tt'] != 'a' || !$chtaway) && file_exists($chtqip.$chtip)) {unlink($chtqip.$chtip);$mdd = 1;}
if(!$_SESSION['srchatsr'] && $chtnck != $_POST['neme']){ // 닉변경되었으면
if($_POST['neme'] = newtext($_POST['neme'])) {
$vv = 0;
if($fg = fopen($chtgt,"r")) {
while(!feof($fg)) {if(substr(fgets($fg),18,-1) == $_POST['neme']) {$vv = 1; break;}}
fclose($fg);
}
if(!$vv) {
if($_SESSION['chtnick'] && $chtchange) $dwv = writee($dwv,"\x1b".$chtnck."<>".$_POST['neme']."\x1b".$chthis."\x1b");
$chtnckk = $chtismbr.$_POST['neme'];
$_SESSION['chtnick'] = $_POST['neme'];
$mdd = 2;
}}}
if($mdd) {
fclose(fopen($chtgv,"w"));
$egv = $time;
}}
if($_POST['ff'] && $_POST['ff'] != $_SESSION['cht_sty4']) {$_SESSION['cht_sty4'] = $_POST['ff'];$mdd = 1;}
else if(!$_SESSION['cht_sty4']) $_SESSION['cht_sty4'] = '00';
if(file_exists($chtmip.$chtip)) {
$fnt = fopen($chtmip.$chtip,"r");
$dgx = fgets($fnt);
$red = (int)substr($dgx,0,2);
$dgx = substr($dgx,2,10);
fclose($fnt);
$egg = filemtime($chtmip.$chtip);
} else {$red = 1;$egg = 0;$dgx = 0;}
$meo = "";
if(!$egv) $egv = filemtime($chtgv);
if($_POST['tt'] == 'a' || $_POST['tt'] == 'x' || $mdd || $dgx < $egv) { // 방문자목록처리
$vv = 1;
$fg = fopen($chtgt,"a+");
while($fgo = fgets($fg)) {
$vv++;
$fgdo = substr($fgo,0,12);
if($fgdo == $chtip) {$is = 1;$meo .= $chtip.":".(($mdd == 2)? "0":$fgo[13]).$_SESSION['cht_sty4'].$chtnckk."\n";if(!$mdd && substr($fgo,16,-1) != $chtnckk) $mdd = 1;}
else if($time - @filemtime($chtmip.$fgdo) > $chtlastgap || ($fgo[13] == "1" && $time - @filemtime($chtqip.$fgdo) > $chtemptgap)) {@unlink($chtmip.$fgdo);@unlink($chtqip.$fgdo);$mdd = 1;$mout = substr($fgo,14,-1);}
else $meo .= $fgo;
}
fclose($fg);
if(!$is) $meo .= $chtip.":0".$_SESSION['cht_sty4'].$chtnckk."\n";
if($chtusrinout) {
if(!$is) $dwv = writee($dwv,"\x1b".$chtnck."<<\x1b".$chthis."\x1b");
if($mout) {if($wx1a = strrpos($mout,"\x1a")) $mout = substr($mout, $wx1a + 1);$dwv = writee($dwv,"\x1b".$mout.">>\x1b".$chthis."\x1b");} 
}
if($_POST['tt'] != 'x' || !$is || $mdd || $dgx < $egv) echo str_replace("\n","\x18",$meo);
if(!$is || $mdd) {
$fg = fopen($chtgt,"w");
fputs($fg,$meo);
fclose($fg);
if($egv != $time) fclose(fopen($chtgv,"w"));
}
}
if($chtnck && $_POST['content']){ // 새글처리
$_POST['content'] = newtext($_POST['content']);
if($_POST['content']) {
if(strpos($_POST['content'],'//whisper//') !== false) {
$wpcnt = explode('//whisper//',$_POST['content']);
$wpnk = substr($wpcnt[0],12);
$wwip = substr($wpcnt[0],0,12);
if($wpcnt[1] == '11chat') {
if($wpcnt[2]) {
if($wpcnt[2] == 'yy') {$dwv = writee($dwv,"\x1b\x1b".$chtip.$chtip."\x1b<span class='dv'>".$wpnk."</span>님을 호출하셨습니다.\x1b".$chthis."\x1b");$memo = "\x1b\x1b".$wwip.$wwip."\x1b<span  class='dv'>".$chtnck."</span>님이 호출하셨습니다.\x1b".$chthis."\x1b";}
else if($wpcnt[2] == 'xx') $memo = "\x1b\x1b".$wwip.$wwip."\x1b<span class='dv'>".$wpnk."</span>님의 1:1 대화신청을 <span class='dv'>".$chtnck."</span>님이 거절하셨습니다.\x1b".$chthis."\x1b";
else $memo = "\x1b\x1b".$wwip.$wwip."\x1b<span class='dv'>".$wpnk."</span>님의 1:1 대화신청을 <span class='dv'>".$chtnck."</span>님이 수락하셨습니다.<br /> <a target='_blank' href='".$chat."?chtid=".$wpcnt[2]."' onmousedown=\"cht_deltt(cht_this=this);cht_go('ssetiq')\"><b>여기를</b></a> 클릭하세요\x1b".$chthis."\x1b";
} else {
$dwv = writee($dwv,"\x1b\x1b".$chtip.$chtip."\x1b<span class='dv'>".$wpnk."</span>님에게 1:1 대화가 신청되었습니다.\x1b".$chthis."\x1b");
$chtyd = substr(md5($wwip),8,16);
$memo = "\x1b\x1b".$wwip.$wwip."\x1b<span  class='dv'>".$wpnk."</span>님에게 <span class='dv'>".$chtnck."</span>님이 1:1 대화를 신청하셨습니다.<br /> <a target='_blank' href='".$chat."?chtid=__".$chtyd."&amp;mkcht=1' onmousedown=\"cht_deltt(cht_this=this);cht_obj.value='".$chtip.$chtnck."//whisper//11chat//whisper//__".$chtyd."';cht_go('rpage');cht_go('ssetiq')\"><b>수락</b></a> 또는 <a onmousedown=\"cht_deltt(cht_this=this);cht_obj.value='".$chtip.$chtnck."//whisper//11chat//whisper//xx';cht_go('rpage');\"><b>거절</b></a>\x1b".$chthis."\x1b";
}} else $memo= "\x1b\x1b".$chtip.$wwip."\x1b<span class='dv'>".$wpnk."</span>님에게 <span class='dv'>".$chtnck."</span>님의 귓속말 &gt;<br />".$wpcnt[1]."\x1b".$chthis."\x1b";
} else {
if($_POST['content'][0] == '(' && $_POST['content'][2] == ')') {
$pcontent = $_POST['content'];
$head = '';
while($pcontent[0] == '(' && $pcontent[2] == ')') {
$biu = $pcontent[1];
if($biu == 'b' || $biu == 'i' || $biu == 'u') {$head .= "<{$biu}>";$pcontent = substr($pcontent,3);}
else break;
}
$_POST['content'] = $head.$pcontent.str_replace('<','</',$head);
}
$memo = $chtnckk."\x1b".$_POST['content']."\x1b".$chthis."\x1b".(int)$_POST['ff'];
}}}
if($memo) $dwv = writee($dwv,$memo);
$dww = (int)$dwv;
if($vv || $red != $dww || $time - $egg > 4){
$mnt = fopen($chtmip.$chtip,"w");
fputs($mnt,$dwv.$egv."\n".md5($_SERVER['HTTP_USER_AGENT']));
fclose($mnt);
}
$dwv = $dww;
echo "\x7f";
if($_POST['tt'] == 'a' || $red <> $dwv) { // 새글읽기
if($_POST['tt'] == 'a') $red = ($dwv > $chtread)? $dwv - $chtread:90 - $chtread + $dwv;
if($_POST['tt'] != 'a' || $chtread) echo  reaad($dwv,$red);
}
exit;
// 1.내부데이타처리 끝
}
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'iPhone') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'iPod') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'iPad')) $chtismobile = 3;
else if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'Android') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Windows CE') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'/CLDC-') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Nokia') || false !== strpos($_SERVER['HTTP_USER_AGENT'],';WV0') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'POLAR') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'Skyfire')) $chtismobile = 2;
else {
$chtismobile = 0;
if(substr($_SERVER['HTTP_USER_AGENT'],25,6) == 'MSIE 6') $chtisie6 = 3;
}
$chtiswin = (false !== strpos($_SERVER['HTTP_USER_AGENT'],'Windows'))? 1:0;
if($_POST['delf'] || $_GET['view'] || $_GET['down']){
// 2.업로드파일출력 시작
if($_POST['delf']) $gfile = $_POST['delf'];
else $gfile = ($_GET['view'])? $_GET['view']:$_GET['down'];
$filee = $chtup.str_replace("^","",str_replace("/","",$gfile));
if($_POST['delf']) {if($cht_isadmin && file_exists($filee)) {unlink($filee);$fmee = substr($filee,0,-4)."_s.jpg";if(file_exists($fmee)) unlink($fmee);echo "<script>alert('success');";if(!$_POST['frombk']) echo "location.replace('{$chat}?chtid={$chtid}&v=ban');";echo "</script>";}}
else {
$gfile = str_replace("^","%",$gfile);
if(strchr($_SERVER['HTTP_USER_AGENT'],"Firefox")) $gfile = urldecode($gfile);
if(file_exists($filee) && $chtnck){
if($_GET['view']) $ext = strtolower(substr($gfile,-4));
if($ext=='.jpg' || $ext=='.gif' || $ext=='.png' || $ext=='.bmp'){
header("Content-type:image/jpeg; charset=UTF-8");
header("Content-Disposition: inline; filename=$gfile");
} else {
header("Content-Type: applicaiton/octet-stream; charset=UTF-8");
header("Content-Disposition:attachment; filename=$gfile");
}
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filee));
readfile($filee);
} else {
if($_GET['view']) {
header("Content-type:image/png");
if($im = @imagecreate(100, 60)) {
imagecolorallocate($im,255,255,255);
$text_color = imagecolorallocate($im,0,0,0);
imagestring($im,5,15,20,"no image", $text_color);
imagepng($im);
imagedestroy($im);
}} else {
header ("Content-Type: text/html; charset=UTF-8");
echo "<h1>파일이 없습니다..</h1>";
}}}
exit;
// 2.업로드파일출력 끝
}
$isdid = 0;
// 3.외부출력 시작
if($ftb = @fopen($chtfid."_chtntb","r")) {
$chtuimg = (int)fgets($ftb);
$chtvban = (int)fgets($ftb);
$chtvimg = (int)fgets($ftb);
$chtufile = (int)fgets($ftb);
$chtpnck = (int)fgets($ftb);
fclose($ftb);
if($chtufile != 0 && ($chtufile == 2 || $_SESSION['srchatsr'])) $isdid = 1;
if($isdid && ($_POST['install'] == '1' || $_GET['v'] == 'ban' || $_FILES['file'])) {
if(file_exists($dsm) && $fd = fopen($dsm,"r")) {
$isdsm = (int)fgets($fd);
$isusm = (int)fgets($fd);
fclose($fd);
}}
} 
if($cht_isadmin) {
if($_POST['install'] == '1') {
// 3.4.관리자 로그인/로그아웃처리 시작
if($_POST['backup'] == 'reset') {
fclose(fopen($chtbk,"w"));
} else if($_POST['empty'] == 'empty') {
fclose(fopen($chtbk,"w"));
chtrmfd($chtfid."_data/",0);
chtrmfd($chtfid."_gst/",0);
fclose(fopen($chtfid."_gst/gv","w"));
chtrmfd($chtfid."_ban/",0);
chtrmfd($chtfid."_upload/",0);
$fs = fopen($dsm,"w");
fputs($fs,$isdsm."\n0");
fclose($fs);
fclose(fopen($chtfid."_gst/wt/00","w"));
} else if($_POST['upload_delete']) {
$fs = fopen($dsm,"w");fputs($fs,$isdsm."\n0");fclose($fs);
chtrmfd($chtup,0);
} else if($_POST['delcht']) {
chtrmfd($chtdate.$chtdata."/".$_POST['delcht'],1);
} else {
if(file_exists($chtfid."_ban/")) {
$ff = opendir($chtfid."_ban/");
while($fff = readdir($ff)) {
if($fff != '.' && $fff != '..') {if(!in_array($fff,$_POST[prhd])) unlink($chtfid."_ban/".$fff);
}}
closedir($ff);
}
$fph = fopen($chtxwd, "w");
$cnt = count($_POST['xword']);
for($i = 0; $i < $cnt; $i++) if($_POST['xword'][$i]) fputs($fph, $_POST['xword'][$i]."\n");
fclose($fph);
if($_POST['chtmaxupload']) {$fs = fopen($dsm,"w");fputs($fs,$_POST['chtmaxupload']."\n".$isusm);fclose($fs);}
else if($isusm) {$fs = fopen($dsm,"w");fputs($fs,"0\n".$isusm);fclose($fs);}
if($_POST['chtusebak'] == 'a') {if(!$ischtbk) fclose(fopen($chtbk,"w"));}
else @unlink($chtbk);
if($_POST['chtufile_']) {if(!file_exists($chtup)) mkdir($chtup,0777);}
else chtrmfd($chtup,1);
$ftc = fopen($chtfid."_chtntc","w");
fputs($ftc, $_POST['chtfbold_']."\n");
fputs($ftc, $_POST['chtfmly_']."\n");
fputs($ftc, $_POST['chtftsz_']."\n");
fputs($ftc, $_POST['chtimgmk_']."\n");
fputs($ftc, $_POST['chtunload_']."\n");
fputs($ftc, $_POST['chtuadmico_']."\n");
fputs($ftc, $_POST['chtuseico_']."\n");
fputs($ftc, $_POST['chtusealert_']."\n");
fputs($ftc, $_POST['chtnoticet_']."\n");
fputs($ftc, $_POST['chtnoticex_']."\n");
fputs($ftc, $_POST['chtwidth_']."\n");
fputs($ftc, $_POST['chtheight_']."\n");
fputs($ftc, $_POST['chthorizon_']."\n");
fputs($ftc, $_POST['cht_cntwh_']."\n");
fputs($ftc, $_POST['cht_usrwh_']."\n");
fputs($ftc, $_POST['chtemptybak_']."\n");
fputs($ftc, $_POST['chtmyself_']."\n");
fputs($ftc, $_POST['chtreload_']."\n");
fputs($ftc, $_POST['chtinterval_']."\n");
fputs($ftc, $_POST['chtcolorpk_']."\n");
fputs($ftc, $_POST['chtview_']."\n");
fputs($ftc, $_POST['chtimgmw_']."\n");
fputs($ftc, $_POST['chtmemberonly_']."\n");
fputs($ftc, $_POST['chtrefresh_']."\n");
fputs($ftc, $_POST['chtleave_']."\n");
fputs($ftc, $_POST['chtbakonly_']."\n");
fputs($ftc, $_POST['chtupdown_']."\n");
fputs($ftc, $_POST['chtlvico_']."\n");
fputs($ftc, $_POST['chtenter_']."\n");
fputs($ftc, $_POST['chtfitalic_']."\n");
fputs($ftc, $_POST['chtfunderline_']."\n");
fputs($ftc, $_POST['chtwrtpst_']."\n");
fputs($ftc, $_POST['chtusealert2_']."\n");
fputs($ftc, $_POST['chtrefresh2_']."\n");
fputs($ftc, $_POST['chturefresh_']."\n");
fputs($ftc, $_POST['chtfmobile_']."\n");
fputs($ftc, $_POST['chtncw_']."\n");
fputs($ftc, $_POST['chtcallt_']."\n");
fputs($ftc, $_POST['chtmemberonly2_']."\n");
fputs($ftc, $_POST['chtlimit_']."\n");
fputs($ftc, stripslashes($_POST['chtnoticed_']));
fclose($ftc);
$ftb = fopen($chtfid."_chtntb","w");
fputs($ftb, $_POST['chtuimg_']."\n");
fputs($ftb, $_POST['chtvban_']."\n");
fputs($ftb, $_POST['chtvimg_']."\n");
fputs($ftb, $_POST['chtufile_']."\n");
fputs($ftb, $_POST['chtpnck_']."\n");
fclose($ftb);
}
echo "<script type=\"text/javascript\">location.replace('{$chat}?chtid={$chtid}&v=ban&admin=1');</script>";
exit;
// 3.4.관리자 로그인/로그아웃처리 끝
} else if($_POST['ban'] && $_POST['ban'] != $chtip) {
$a = fopen($chtfid."_ban/".$_POST['ban'],"w");fputs($a,$time."\x1b".$_POST['nick']."\x1b".$chtnck);fclose($a);
if($chtvban) {
$memo = "\x1b<span>".$_POST['nick']."</span>님이 강퇴되셨습니다.\x1b".$chthis."\x1b";
writee($dwv,$memo);
}
guestt($_POST['ban'],0);
@unlink($chtmip.$_POST['ban']);
echo "<script type=\"text/javascript\">location.replace('{$chat}?chtid={$chtid}&v=ban');</script>";
exit;
}}
if($isdid && $_FILES['file']){
if($isdsm && $_FILES['file']['size'] > $isdsm*1048576) {unlink($_FILES['file']['tmp_name']);$alert = "parent.alert('upload_max_filesize : ".$isdsm."mb');";
} else if($_FILES['file']['size']) {
$alert = '';
$fme = preg_replace("`[%(){}\+\[\]]`","",str_replace(" ","_",$_FILES['file']['name']));
$ext = strtolower(substr($fme,-4));
if($isdsm) {
$fs = fopen($dsm,"w");
fputs($fs,$isdsm."\n");
$isusm += $_FILES['file']['size'];
if($isusm > $isdsm*1048576) {chtrmfd($chtup,0);fputs($fs,$_FILES['file']['size']);}
else fputs($fs,$isusm);
fclose($fs);
}
$dest = $chtup.str_replace("%","",urlencode($fme));
move_uploaded_file($_FILES['file']['tmp_name'], $dest);
$fmee = str_replace("%","^",urlencode($fme));
if(strlen($fme) > $chtfnlen) {
$str = substr($fme, 0, $chtfnlen + 1);
$end = $chtfnlen; 
if(ord($str[$end -2]) < 224 && ord($str[$end]) > 126) {
while(ord($str[$end]) < 194 && ord($str[$end]) > 126) $end--;
$str = substr($str, 0, $end)."~";
} else $str .= "~";
if(substr($fme,-4,1) == '.') $str .= substr($fme,-4);
$fme = $str;
}
if($ext=='.jpg' || $ext=='.gif' || $ext=='.png' || $ext=='.bmp'){
$memo = "<a  style='color:red' target='_blank' href='{$_SERVER['PHP_SELF']}?chtid={$chtid}&amp;view={$fmee}'>";
if($chtuimg) {
if(!$chtvimg) $chtvimg = 100;
if($ext !== '.bmp') {
list($width, $height) = @getimagesize($dest);
if($width > $chtvimg) {
$tname = substr($dest,0,-4)."_s.jpg";
$mxheight = $height*$chtvimg/$width;
$thumb  = @imagecreatetruecolor($chtvimg, $mxheight);
@imagefill($thumb, 0, 0, @imagecolorallocate($thumb, 255, 255, 255));
if($ext=='.jpg') $source = @imagecreatefromjpeg($dest);
else if($ext=='.gif') $source = @imagecreatefromgif($dest);
else if($ext=='.png') $source = @imagecreatefrompng($dest);
if(@imagecopyresampled($thumb, $source, 0, 0, 0, 0, $chtvimg, $mxheight, $width, $height)){
if(@imagejpeg($thumb,$tname,90)) {imagedestroy($thumb);$fmee = substr($fmee,0,-4)."_s.jpg";}
}}}
$memo .= "<img style='max-width:{$chtvimg}px' src='{$_SERVER['PHP_SELF']}?chtid={$chtid}&amp;view={$fmee}'  />";
}
$memo .= "{$fme}</a>";
} else $memo = "<a  style='color:#FF00AE' target='_blank' href='{$_SERVER['PHP_SELF']}?chtid={$chtid}&amp;down={$fmee}'>{$fme}</a>";
$memo= $chtnckk."\x1b".$memo."\x1b".$chthis."\x1b".$_SESSION['cht_sty4'];
writee($dwv,$memo);
}
?>
<script type="text/javascript"><?=$alert?>location.replace('<?=$chat?>?chtid=<?=$chtid?>&v=file');</script>
<?
exit;
}} else if($_GET['mkcht'] && $chtid == "__".substr(md5($chtip),8,16)) {cht_mkroom($chtdate.$chtdata."/".$chtid);echo "<script type='text/javascript'>location.replace('?chtid={$chtid}');</script>";exit;
} else if(!$cht_isadmin || substr($chtid,0,2) == '__') {echo "<fieldset style='padding:15px;text-align:center'>chat room does not exist</fieldset>";$chtexit = 'exit';}}
if($chtexit != 'exit') {
if($_POST['install'] && $cht_isadmin) {
if($_POST['install'] == 'install') {
if(file_exists($chtdate) || mkdir($chtdate)) {
$_POST['chtid'] = trim($_POST['chtid']);
if($_POST['chtid'] !=preg_replace("`[\`\!@#$%^&*\(\)\[\]\"'\.\?/,+=|~\{\}]`", "", $_POST['chtid'])) {
echo "<script type=\"text/javascript\">location.href='?';alert('대화방id에 특수문자 사용 못합니다');</script>";
exit;
}
if(!$chtdata) {
$chtdata = substr(md5($time),rand(5,20),10);
mkdir($chtdate.$chtdata, 0777);
}
$chtfid = $chtdate.$chtdata."/".urldecode($_POST['chtid']);
cht_mkroom($chtfid);
} else {echo "<script type=\"text/javascript\">opener.alert(\"FTP에서 srchat/chat 권한을 777로 주세요\");</script>";exit;}
} else if($_POST['install'] == 'uninstall') chtrmfd($chtfid,1);
echo "<script type=\"text/javascript\">opener.tout();opener.location.reload();location.replace('{$chat}?chtid={$chtid}&v=ban&admin=1');</script>";
exit;
}
if($_GET['js']) {
function vemotic($emofolder,$emor) {
global $chticodir;
if($ep = @opendir($chticodir.$emofolder)) {
while($epp = readdir($ep)) {
if($epp != '.' && $epp != '..') {
if(is_dir($chticodir.$emofolder.$epp)) $emor = vemotic($emofolder.$epp.'/',$emor);
else  $epps[] = $epp;
}}
closedir($ep);
if($epps) {
if($epps[1]) rsort($epps);
$emor .= ",Array('{$emofolder}'";
foreach($epps as $epp) {$emor .= ",'{$epp}'";}
$emor .= ")";
}}
return $emor;
}
?>
var cht_this;
var cht_imopn;
var cht_obj;
var cht_tid = 0;
var chttalert = 0;
var chtualert = 0;
var cht_eeo = 0;
var cht_nxthtml;
var dph = Array();
var chtunload = 'N';
var chtv100 = '0';
var chtuadmico = 0;
var chtaablkc = 0;
var chtip = '';
var chtisbk;
var chtbx = 0;
var xmlhttp;
var chtreload = 0;
var chtview = 0;
var chtimgmw = 0;
var chtrefresh = 1500;
var chtnextread;
var chtparam = '';
var chtismobile = 0;
var chtinterval = 0;
var chtwnext = 0;
var chtuimg = 0;
var chtupdown = '0';
var chtwrtpst = 0;
var chtmyself = 0;
var chtimgmk = 0;
var chtblk = 1;
var chttitle = '';
var chtctitle = '';
var chtcallt = 0;
var chtlvico = 0;
var cht_ico = Array(''<?=vemotic('/','');?>);

function dallar(key) {return document.getElementById(key);}
function cht_imgview(src) {
var img = dallar('cht_img');
if(src == 0 ||img.style.display == "block") {
img.innerHTML = "";
img.style.display = "none";
dallar('cht_gout').value = '0';
cht_imopn = '';
if(cht_nxthtml) {
cht_nxthtml.style.display = 'none';
cht_nxthtml = '';
}} else {
var srcu = (src.substr(0, 7) != 'http://')? chtsrchat + "&amp;view=" + src:src;
if(chtview == 2 || chtisbk == '1') window.open(srcu.replace(/amp;/g,''),'_blank');
else {
setTimeout("cht_imopn = 1",200);
img.style.display = "block";
var imgin = "<img onclick='cht_imgview(0)' src='" + srcu + "' alt=''";
if(chtimgmw > 0) imgin += " style='max-width:" + chtimgmw + "px'";
img.innerHTML = imgin + " />";
}}}
function chtnxg(thsx) {
var thsig = thsx.lastIndexOf('>');
if(thsig != -1) thsx = thsx.substr(thsig + 1);
return thsx.replace(/·/,'');
}

function chtwxa(thsx) {
var thxs = '';
var thxx = '';
var thtt = thsx.substr(1,1);
if(thsx.substr(0,1) == '1') thxx += "<img class='ht15' src='icon/mobile.gif' />";
if(thtt == '2' && chtuadmico == '1') thxx += "<img class='ht15' src='icon/srchat_adm.gif' />";
thsx = thsx.substr(2);
var thss = '';
var thsig = thsx.indexOf("\x1a");
if(thsig != -1) {
thss = thsx.substr(0,thsig);
thsx = thsx.substr(thsig + 1);
thsig = thsx.indexOf("\x1a");
if(thsig != -1) {
thxs = thsx.substr(0,thsig);
thsx = thsx.substr(thsig + 1);
if(thxs != '' && chtlvico == '1') thxx += "<img class='ht15' src='./icon/v" + thxs + ".gif' />";
}
if(thss != '' && chtimgmk == 1) thxx += "<img class='ht15' src='./icon/m20_" + thss + "' />";
}
thxx += thsx;
if(thtt == '0') thxx = "·" + thxx;
return Array(thxx,thsx,thtt);
}

function chtdelf(ths) {
var furl;
var fkl;
var f = ths.nextSibling;
if(f.href != '') {
furl = f.href;
fkl = furl.indexOf("down=") + 5;
if(fkl == 4) fkl = furl.indexOf("view=") + 5;
if(fkl == 4) {alert('failure');return false;}
fkl = furl.substr(fkl);
if(fkl.indexOf("&") != -1) fkl = fkl.substr(0,fkl.indexOf("&"));
} else {
var ff = String(f.onclick);
ff = ff.substr(ff.indexOf("view=") + 5);
fkl = ff.substr(0,ff.indexOf(')') - 1);
}
cht_kout('',fkl);
}
function cht_tico(f) {
if(f) {
if(f.indexOf("<<") != -1) f = "▶ <span class='dv'>" + f.replace(/<</g,"<\/span> 님이 입장하셨습니다.");
else if(f.indexOf(">>") != -1) f = "▶ <span class='dv'>" + f.replace(/>>/g,"<\/span> 님이 퇴장하셨습니다.");
else if(f.indexOf("<>") != -1) f = "▶ <span class='dv'>" + f.replace(/([^<]+)<>/g,"$1<\/span>  → <span class='dv'>") + "<\/span> (으)로 바꿨습니다.";
else {
if(f.indexOf("<a  style='color:red'") != -1) {
if(chtuimg == 2) f = f.replace(/<img .+view=([^']+)'[^>]+>/g,"");
if(chtview != 2 && !chtisbk) f = f.replace(/href='([^']+)'/g,"onclick='cht_imgview(\"$1\")'");
}
if(f.indexOf("http:") != -1 || f.indexOf("https:") != -1 || f.indexOf("ftp:") != -1) {
if(chtview == 2 || chtisbk == '1') f = f.replace(/(http|https|ftp):\/\/([^"'<>\r\n\s]+)/gi,"<a target='_blank' href='$1://$2'>$1://$2</a>");
else f = f.replace(/(http|https|ftp):\/\/([^"'<>\r\n\s]+)\.(jpg|gif|png|bmp|jpeg)/gi,"<a onclick='cht_imgview(this.innerHTML.replace(/amp;/g,\"\"))'>$1:\\$2.$3</a>").replace(/(http|https|ftp):\/\/([^"'<>\r\n\s]+)/gi,"<a target='_blank' href='$1://$2'>$1://$2</a>").replace(/:\\/gi,"://");
} else if(('<?=$cht_isadmin?>' == '1' || '<?=$cht_isadmin?>' == '2') && f.indexOf("<a  style='color:") != -1) f = f.replace(/<a  style='color:/gi,"<input type='button' value='삭제' class='cht_button' onclick='chtdelf(this)' style='margin-right:10px;height:18px' /><a style='color:");
else if(cht_ico.length > 0 && f.indexOf("▩") != -1 && f.indexOf(".") != -1) {
var g = f.split("▩");
var gl = g.length;
var fl = -1;
f = g[0];
for(var i=1;i < gl;i++) {
fl = g[i].indexOf(".");
if(fl != -1) {
var gfl = g[i].substr(0,fl).split(",");
if(gfl[1]) f += "<img src='<?=$chticodir?>" + cht_ico[gfl[0]][0] + cht_ico[gfl[0]][gfl[1]] + "' alt='' />";
f += g[i].substr(fl + 1);
} else f += "#" + g[i];
}}}}
return f;
}
var fbcolor = Array("#000000","#000000","#7d7d7d","#ff0000","#8c4835","#ff6c00","#ff9900","#ffef00","#a6cf00","#009e25","#1c4827","#00b0a2","#00ccff","#0095ff","#0075c8","#3a32c3","#7820b9","#ef007c");

function cht_fdnm(fdnm) {
var retunr;
var chtdda = dallar('cht_DD').getElementsByTagName('dt');
if(chtdda && chtdda.length > 0) {
for(var i = chtdda.length -1;i >= 0; i--) {
if(fdnm == chtnxg(chtdda[i].innerHTML)) {
retunr = chtdda[i];
break;
}}}
return retunr;
}
function ckt_whspr(ths) {
if(chtsrchat.indexOf("__") != -1) return false;
cht_ntm(ths.parentNode);
if(chtismobile > 0) var thh = ths.parentNode.nextSibling;
else var thh = ths.parentNode.previousSibling;
if(cht_nxthtml == thh) {
if(cht_imopn == '1') cht_imgview(0);
} else {
if(cht_imopn == '1') cht_imgview(0);
var thst = chtnxg(ths.innerHTML);
if(thst) {
if(dallar('cht_vstd').value.indexOf("," + thst + ",") != -1) {
thst = cht_fdnm(thst);
sth = String(thst.onclick).indexOf('"');
if(sth != -1) {sth = String(thst.onclick).substr(sth +1,12);
thh.innerHTML = cht_whspr(sth,thst,1);
if(chtismobile > 0) thh.style.margin = '0';
else thh.style.marginLeft = ths.scrollWidth + 10 +'px';
thh.style.display = 'block';
cht_nxthtml = thh;
}} else cht_in("<b>" + thst + "</b> 님이 자리에 없습니다.");}
}}
function cht_ntm(ths,ntm) {
if(ntm) {
var iscnnctd = chtnxg(ths.firstChild.innerHTML);
iscnnctd += (dallar('cht_vstd').value.indexOf("," + iscnnctd + ",") != -1)? '<\/b> :: 접속중':'<\/b> :: 부재중';
ths.style.background = '#E9FFE3';
dallar('cht_SS').innerHTML = '&nbsp;<b>' + iscnnctd + ' (' + ntm + ')';
dallar('cht_SS').style.background = '#EBF2FF';
} else {
dallar('cht_SS').innerHTML = '&nbsp;';
dallar('cht_SS').style.background = '';
ths.style.background = '';
}}
function cht_tosty(cont,cn,rnam) {
if(cont[3] && fbcolor[cont[3]]) cont[3] = " style='color:" + fbcolor[cont[3]] + ";'";
else cont[3] = "";
var chtwxaa = chtwxa(cont[0]);
cont[0] = chtwxaa[0];
cont[1] = cht_tico(cont[1]);
if(!chtisbk) {
var cont4 = '';
if(chtwxaa[1] == rnam || chtwxaa[1] == "·" + rnam) {cont[0] = "<b onclick='cht_away()'>" + cont[0];if(chtmyself == '1') cont4 = ' myself';}
else if(cn  == '1') cont[0] = "<b>" + cont[0];else cont[0] = "<b onclick='ckt_whspr(this)'>" + cont[0];
cont = "<div class='cx" + cont4 + "' " + cont[3] + " onmouseover=\"cht_ntm(this,'" + cont[2] + "')\" onmouseout=\"cht_ntm(this)\">" + cont[0] + "<\/b><b> &gt; <\/b>" + cont[1] + "<\/div>";
if(chtismobile > 0) return cont + "<div class='bx'><\/div>";
else return "<div class='bx'><\/div>" + cont;
} else return "<div class='cx' " + cont[3] + "><span class='cht8'>&nbsp;" + cont[2] + " <\/span>&nbsp; <b>" + cont[0] + " &gt; <\/b>" + cont[1] + "<\/div>";
}
function cht_save_pos() {
if(cht_obj.createTextRange) cht_obj.currentPos = document.selection.createRange().duplicate();
}
function cht_fbc(str) {
if(str.substr(0,1) === '0') str = str.substr(1);
return fbcolor[parseInt(str)];
}
function cht_fbcolr(nine) {
var thst = dallar('cht_color');
var xx = cht_fbc(thst.value);
if(xx) {
cht_obj.style.color = xx;
dallar('neme').style.color = xx;
thst.style.backgroundColor = xx;
if(nine !== 9) cht_obj.focus();
}}
function cht_aadd(vdd,vaa) {
if(dallar('cht_DD').style.height == vaa) {
dallar('cht_DD').style.height = vdd;
dallar('cht_AA').style.height = vaa;
} else {
dallar('cht_DD').style.height = vaa;
dallar('cht_AA').style.height = vdd;
}
if(chtupdown != '1') dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;
}
function cht_tag(fvalue) {
if(cht_obj.createTextRange && cht_obj.currentPos && !cht_obj.currentPos.text) cht_obj.currentPos.text = "▩" + fvalue + ".";
else if(cht_obj.selectionStart) cht_obj.value = cht_obj.value.substring(0, cht_obj.selectionStart) + "▩" + fvalue + "." + cht_obj.value.substring(cht_obj.selectionEnd);
else cht_obj.value = cht_obj.value + "▩" + fvalue + ".";
chtemtbk(dallar('cht_LL'));
cht_obj.focus();
}
function notixe(tht) {
if(tht) tht = 'none';
else tht = '';
var cht_ntctr = dallar('cht_AA').getElementsByTagName('div');
for(var i=cht_ntctr.length-1;i >= 0;i--) {if(cht_ntctr[i].className == 'cht_ntc') cht_ntctr[i].style.display = tht;}
}
function cht_toggle() {
var f = dallar('cht_fico');
if(f) {f.style.display = (f.style.display == 'block')? 'none':'block';}
}
function chtemtbk(emt) {
var tme = '1px';
if(emt.style.borderWidth == '1px') tme = '0px';
emt.style.borderWidth = tme;
emt.style.padding = (tme == '1px')? '0px':'1px';
if(emt.id == 'cht_LL') cht_toggle();
else {
if(emt.id == 'cht_MM') dallar('chcontent').style.fontWeight=(tme == '1px')? 'bold':'normal';
else if(emt.id == 'cht_PP') dallar('chcontent').style.fontStyle=(tme == '1px')? 'italic':'normal';
if(dallar('chtwtfm').style.display != 'none' && chtismobile != '1') cht_obj.focus();
}}
function cht_go(view) {
	clearTimeout(chtnextread);
	if(chtparam != '') {
	if(view == 'read') chtnextread = setTimeout("cht_go('read')", chtrefresh);
	else setTimeout("cht_go('" + view + "')",100);
	} else {
	var cht_ntime = new Date();
	var gtime = cht_ntime.getTime();
	var cht_etiq = Array("",";color:#BABABA' title='자리비움");
	var cht_ntv = dallar('cht_ntim').value.substr(10);
	var cht_ok = 9;
	var nam = dallar('neme').value.replace(/[&'"]/gi,"");
	if(view == 'rpage') {
	var contt = cht_obj.value;
	if(dallar('cht_fico').style.display == 'block') chtemtbk(dallar('cht_LL'));
	cht_obj.value ='';
	if(contt.substr(0,1) == ';') {
	cht_obj.focus();
	if(contt == ';ico'){if(dallar('cht_LL').title != 'disabled') chtemtbk(dallar('cht_LL'));return;}
	else if(contt == ';b'){if(dallar('cht_MM').title != 'disabled') chtemtbk(dallar('cht_MM'));return;}
	else if(contt == ';i'){if(dallar('cht_PP').title != 'disabled') chtemtbk(dallar('cht_PP'));return;}
	else if(contt == ';u'){if(dallar('cht_QQ').title != 'disabled') chtemtbk(dallar('cht_QQ'));return;}
	else if(contt == ';re'){if(dallar('cht_RR').title != 'disabled') {tout();location.reload();}return;}
	else if(contt == ';exit'){if(dallar('cht_OO').title != 'disabled') cht_leave();return;}
	else if(contt == ';bak'){if(dallar('chtbackup').innerHTML != 'false') {if(!window.open(chtsrchat + "&v=backup","_blank")) cht_in("<a target='_blank' href='" + chtsrchat + "&amp;v=backup'>전체대화<\/a>");}return;}
	else if(contt == ';admin'){if(dallar('chtadmin').innerHTML != 'false') {if(!window.open(chtsrchat + "&v=ban&admin=1","_blank")) cht_in("<a target='_blank' href='" + chtsrchat + "&amp;v=ban&amp;admin=1'>관리자기능<\/a>");}return;}
	else if(contt.substr(0,7) == ';color:') {var contt7 = contt.substr(7);if(dallar('cht_color').style.display == '' && contt7 < dallar('cht_color').options.length) {dallar('cht_color').value = dallar('cht_color').options[contt7].value;cht_fbcolr();}return;}
	}
		if(chtinterval > 0) {
	if(chtwnext > gtime) {cht_in('글쓰기 시간간격 '+ chtinterval + '초/' + ((chtwnext - gtime)/1000) + '초 남았습니다');cht_obj.value = contt;cht_obj.focus();return false;}
		chtwnext = gtime + chtinterval*1000;
		}
		if(dallar('cht_pnam').value != nam) {
		if(nam.substr(0,1).replace(/[　\s]/g,"") != "") {
		if(dallar('cht_vstd').value.indexOf("," + nam + ",") != -1 || dallar('cht_vstd').value.indexOf(",·" + nam + ",") != -1) {
		cht_ok = 2;
		cht_in("중복된 '닉네임' 입니다");
		dallar('neme').value = dallar('cht_pnam').value;
		}} else {cht_ok = 2;cht_in("닉네임 첫글자가 공백입니다");}
		if(cht_ok == 9) dallar('cht_pnam').value = nam;
		}
		if(cht_ok == 9) {
		contt = contt.replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/`/g,"").replace(/%/g,"%25").replace(/&/g,"%26").replace(/\+/g,"%2B").replace(/\\/g,"＼");if(contt =='') return false;
		if(dph.length) {
		for(var i = 0; dph[i]; i++){
		if(dph[i] && contt.indexOf(dph[i]) != -1) {
		cht_ok = 2;
		cht_in("금지된 표현 '"+ dph[i] +"' (이)가 포함되어 있습니다.");
		break;
		}}}
		if(cht_ok == 9) {
		if(dallar('cht_prev').value != contt) {
		var fstyle = dallar('cht_color').value;
		if(dallar('psty').value != fstyle) dallar('psty').value = fstyle;
		if(dallar('cht_JJ').style.display != 'none') {
		var wnck = dallar('cht_wip').value.substr(12) + '//';
		if(contt == wnck) {chtipths();return;}
		cht_obj.value = wnck;
		cht_ok = contt.indexOf('//');
		if(cht_ok != -1) contt = contt.substr(cht_ok + 2);
		contt = dallar('cht_wip').value + '//whisper//' + contt; 
		} else {
		if(dallar('cht_MM').style.borderWidth == '1px') contt = "(b)" + contt;
		if(dallar('cht_PP').style.borderWidth == '1px') contt = "(i)" + contt;
		if(dallar('cht_QQ').style.borderWidth == '1px') contt = "(u)" + contt;
		}
		chtparam = chtsrchat + '&neme='+ nam +'&content='+ contt + '&tt=' + cht_ntv + '&ff=' + fstyle;
		cht_iscookie(fstyle);
		dallar('cht_prev').value = contt;
		dallar('cht_ptim').value = gtime;
		} else cht_in('중복된 내용입니다');
		}
		}
	} else if(view == 'out') {
		chtparam = chtsrchat + '&content=9579a584&tt=' + cht_ntv;
	} else if(view == 'exit') {
		chtparam = chtsrchat + '&content=8579a584&tt=' + cht_ntv;
	} else if(view == 'ssetiq') {
		chtparam = chtsrchat + '&content=6579a584&tt=' + cht_ntv;
	} else if(dallar('cht_gout').value != '9') {
		var xtval = (parseInt(dallar('cht_xtim').value) + 1)%10;
		dallar('cht_xtim').value = xtval;
		if(cht_ntv == 'a') chtparam = chtsrchat + '&tt=' + cht_ntv + '&neme=' + nam;
		else if(xtval == 0) chtparam = chtsrchat + '&tt=x';
		else chtparam = chtsrchat + '&tt=' + cht_ntv;
	  if(view == 'in') {chtparam += '&content=7579a584';view = 'read';}
	}
if(chtparam != '') {
if(window.ActiveXObject) {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}  else if(window.XMLHttpRequest) {
xmlhttp = new XMLHttpRequest();
}
xmlhttp.open("POST", chtparam, true);
xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
xmlhttp.onreadystatechange = function(){
if(xmlhttp.readyState=='4' && xmlhttp.status=='200') {
	var str = xmlhttp.responseText;
	if(str.indexOf("<h1>") != -1) {dallar('cht_AA').innerHTML=str;dallar('cht_gout').value = '9';return false;}
	else {
	var ts = '';
	var t = cht_ntime.getHours();
	var m = cht_ntime.getMinutes();
	var s = cht_ntime.getSeconds();
	ts += (t < 10)? "0"+t+":":t+":";
	ts += (m < 10)? "0"+m+":":m+":";
	ts += (s < 10)? "0"+s:s;
	dallar('cht_FF').innerHTML = ts;
		var vew = str.split("\x7f");
		if(vew.length > 0 && vew[0] != ''){
			var vews = vew[0].split("\x18");
			var sdd = vews.length - 1;
			var stra = '';var strt = '';
			var strr = '';var vew12 = '';var vew13 = Array();var cht_vstd = ",";
			for(var i = 0;i < sdd;i++) {
			vew12 = vews[i].substr(0,12);
			vew13 = chtwxa(vews[i].substr(16));
			strt = "<dl><dt style='color:" + cht_fbc(vews[i].substr(14,2)) + cht_etiq[vews[i].substr(13,1)] + "'";
			if(vew12 == chtip) strt += " onclick='cht_away()' id='chtddmyself'>*";
			else strt += " onclick='cht_whspr(\"" + vew12 + "\",this,0)'>";
			strt += vew13[0] + "<\/dt><dd><\/dd><\/dl>";
			if(vew13[2] == 2) stra = strt + stra;
			else if(vew13[2] == 1) stra += strt;
			else strr += strt;
			cht_vstd += vew13[1] + ",";
			}
			dallar('cht_DD').innerHTML = "<div class='dv'>" + stra + strr + "<\/div>";
			dallar('cht_EE').innerHTML = "참여자 (" + sdd + ")";
			dallar('cht_vstd').value = cht_vstd.replace(/·/g,'');
		}
		var strr = "";
		if(vew.length > 1 && vew[1] != ''){
			var aline = vew[1].split("\x18");
			if(chtupdown == '1') {
			for(var i = aline.length -1;i >= 0;i--){
			if(aline[i]) {
			var wnam = aline[i].split("\x1b");
			if(wnam[0]) strr += cht_tosty(wnam,0,nam);
			else {
			if(wnam[1].indexOf("<span  class='dv'>") != -1) chtparam = 'n';
			strr += "<div class='cht_ntc'>"+ cht_tico(wnam[1]) +"<\/div>";
			}}}} else {
			var alinength = aline.length -1;
			for(var i = 0;i < alinength;i++){
			if(aline[i]) {
			var wnam = aline[i].split("\x1b");
			if(wnam[0]) strr += cht_tosty(wnam,0,nam);
			else {
			if(wnam[1].indexOf("<span  class='dv'>") != -1) chtparam = 'n';
			strr += "<div class='cht_ntc'>"+ cht_tico(wnam[1]) +"<\/div>";
			}}}}
			if(chtbx > 500 || chtbx == 0) {dallar('cht_AA').innerHTML = strr;chtbx = 1;
			} else {
			chtbx++;
			var cdiv = document.createElement("div");
			cdiv.innerHTML = strr;
			cdiv.style.padding = 0;
			cdiv.style.margin = 0;
			if(chtupdown == '1') dallar('cht_AA').insertBefore(cdiv,dallar('cht_AA').firstChild);
			else dallar('cht_AA').appendChild(cdiv);
			}
			if(chtupdown == '1') dallar('cht_AA').scrollTop = 0;
			else setTimeout("dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;",50);
			if(strr != '' && cht_ntv != 'a' && chtualert != '5' && (chtparam == 'n' || (chttalert !== 0 && parseInt(gtime) - parseInt(dallar('cht_ptim').value) > chttalert))) {
			if(chtualert == '2' || chtualert == '3' || (chtualert == '4' && chtismobile == '1')) {chttitle=document.title;chtctitle=ts;chtaablkc=gtime;chtblk = 0;chtaablk();}
			if(chtualert == '0' || chtualert == '3' || (chtualert == '4' && chtismobile != '1'))  dallar('cht_SS').innerHTML = " &nbsp; <embed src='<?=$chtmid?>' wmode='opaque' allowscriptaccess='sameDomain' type='application/x-shockwave-flash' width='1px' height='1px'><\/embed>"; 
			}
			dallar('cht_ptim').value = gtime;
		}
	}
	dallar('cht_ntim').value = gtime;
	chtparam = '';
	chtnextread = setTimeout("cht_go('read')", chtrefresh);
	delete xmlhttp;
}}
xmlhttp.send(chtparam);
if(view == 'out') return view;
}
if(view == 'rpage') cht_obj.focus();
}}

function cht_away() {
var ths = (dallar('chtddmyself').title != '')? '자리비움을 해제했습니다':'자리비움을 설정했습니다';
cht_in(ths);
cht_go('ssetiq');
}
function cht_in(texxt) {
if(texxt) {
setTimeout("cht_eeo = 3",1000);
setTimeout("if(cht_eeo == 3) cht_eeo = 2",2000);
setTimeout("cht_in()",4000);
cht_eeo = 0;
dallar('cht_SS').innerHTML = "&nbsp;" + texxt;
dallar('cht_SS').style.background = '#EBF2FF';
} else if(cht_eeo == 2) {dallar('cht_SS').innerHTML = "&nbsp;";dallar('cht_SS').style.background = '';cht_eeo = 0;}
}
function cht_inn(texxt,vtm,vclass,vid) {
if(!vid) {vid = 'srchat_' + cht_tid;cht_tid++;}
var vdiv = document.createElement("div");
vdiv.innerHTML = texxt.replace(/#34;/g,'"').replace(/#39;/g,"'");
vdiv.id = vid;
if(vclass) vdiv.className = vclass;
if(chtupdown == '1') dallar('cht_AA').insertBefore(vdiv,dallar('cht_AA').firstChild);
else dallar('cht_AA').appendChild(vdiv);
if(vtm) setTimeout("cht_delt(dallar('" + vid + "'))",vtm);
if(chtupdown != '1') dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;
}
function cht_leave() {
chtemtbk(dallar('cht_OO'));cht_go('exit');dallar('cht_gout').value='9';dallar('cht_ban').contentWindow.chtenter(2);
}
function cht_gg() {
if(dallar('cht_OO').style.borderWidth != '1px') {
var ckk = new Date().getTime() - parseInt(dallar('cht_ntim').value);
if(ckk > 20000) {
if(chtreload == '1') {tout();location.reload();}
else if(chtreload == '2') dallar('cht_SS').innerHTML = "새로고침이 필요합니다. <input type='button' value='새로고침' class='cht_button' onclick='tout();location.reload();' />";
else if(confirm('새로고침이 필요합니다. 새로고침하시겠습니까')) {tout();location.reload();}
} else if(ckk > 10000) {
clearTimeout(chtnextread);
chtnextread = setTimeout("cht_go('read')", chtrefresh);
}}
setTimeout('cht_gg()', 3500);
}
function cht_emodr(n) {
var emdiv = dallar('cht_fico').getElementsByTagName('div');
if(emdiv.length > 1) {
n = parseInt(n) -1;
for(var m = emdiv.length - 1;m >= 0;m--) {
if(m == n) emdiv[m].style.display = '';
else emdiv[m].style.display = 'none';
}}}
function cht_setup() {
chtbx = 0;
cht_obj = dallar('chcontent');
cht_obj.value = '';
dallar('cht_AA').style.overflowX='hidden';
dallar('cht_ntim').value="0000000000a";
if(dallar('cht_OO').style.borderWidth != '1px') dallar('cht_gout').value='0';
dallar('cht_xtim').value='0';
if(cht_ico.length > 0) {
var femt = '';
var femtt = '';
var chtl = cht_ico.length;
for(var ii=1;ii < chtl;ii++) {
if(chtl > 2) {
femtt += "<input type='button' value=' " + cht_ico[ii][0].replace(/\//g,'') + "' class='cht_button' onclick='cht_emodr(" + ii + ")' /> ";
if(ii == 1) femt += "<div>";
else femt += "<div style='display:none'>";
}
for(var i=cht_ico[ii].length -1;i > 0;i--) {
femt += "<img src='<?=$chticodir?>" + cht_ico[ii][0] + cht_ico[ii][i] + "' alt='' onclick=\"cht_tag('" + ii + "," + i + "')\" />";
}
if(chtl > 0) femt += "<\/div>";
}
dallar('cht_fico').innerHTML = femtt + femt;
dallar('cht_fico').style.width = dallar('cht_fbdy').offsetWidth + 'px';
if(chtwrtpst == 1) setTimeout("dallar('cht_fico').style.paddingTop = (dallar('chtwtfm').offsetHeight + 30) + 'px';",100);
else {
dallar('cht_fico').style.visibility = 'hidden';
dallar('cht_fico').style.display = 'block';
setTimeout("dallar('cht_fico').style.paddingTop = (dallar('cht_HH').scrollHeight - dallar('cht_fico').scrollHeight + 70) + 'px';dallar('cht_fico').style.display = 'none';dallar('cht_fico').style.visibility = '';",100);
}}
cht_go('read');
setTimeout('cht_gg()',5000);
if(chtupdown != '1') setTimeout("dallar('cht_AA').scrollTop = dallar('cht_AA').scrollHeight;",1000);
setTimeout("if(dallar('cht_AA').firstChild) cht_ntm(dallar('cht_AA').firstChild)",50);
var chtstyle = cht_iscookie(0);
if(chtstyle != -1 && dallar('cht_color').style.display != 'none') {
dallar('cht_color').value = chtstyle;
setTimeout("cht_fbcolr(9)",50);
}}
function cht_iscookie(isc) {
var chtstyle = document.cookie.indexOf('cht_sty4=');
if(chtstyle != -1) chtstyle = document.cookie.substr(chtstyle + 9,2);
if(isc != 0) {if(isc != chtstyle) document.cookie = "cht_sty4 = " + isc;
} else return chtstyle;
}
function cht_deltt(ths) {
setTimeout("cht_delt(cht_this.parentNode)",500);
}
function cht_delt(ths) {
if(ths) ths.parentNode.removeChild(ths);
}
function cht_11chat(ip,thsi) {
if(dallar('cht_JJ').style.display != 'none') chtipths();
cht_obj.value= ip + thsi + "//whisper//11chat";
cht_go('rpage');
cht_in('"' + thsi + '"님에게 1:1 대화를 신청했습니다');
}
function chtipths(ip,thsi) {
if(ip && thsi) {
dallar('cht_wip').value = ip + thsi;
setTimeout("cht_obj.value = '" + thsi + "//'",200);
dallar('cht_JJ').style.display = '';
} else if(ip) {
if(dallar('cht_JJ').style.display != 'none') chtipths();
var ctime = new Date().getTime();
var dtime = ctime - parseInt(dallar('cht_callt').value);
if(chtcallt != 0 && dtime < chtcallt) cht_in('알림음 호출 시간간격 '+ (chtcallt/1000) + '초/' + (dtime/1000) + '초 남았습니다');
else {
dallar('cht_callt').value = ctime;
cht_obj.value = ip + '//whisper//11chat//whisper//yy';
cht_go('rpage');
}} else {
if(cht_obj.value.indexOf('//') != -1) cht_obj.value = '';
cht_delt(dallar(dallar('cht_wip').value.substr(0,12)));
dallar('cht_wip').value = '';
dallar('cht_JJ').style.display = 'none';
}
cht_obj.focus();
}
function cht_whspr(ip,ths,n) {
if(chtsrchat.indexOf("__") != -1) return '';
if(cht_nxthtml == ths.nextSibling) {
if(cht_imopn == '1') cht_imgview(0);
} else {
if(cht_imopn == '1') cht_imgview(0);
var thsi = chtnxg(ths.innerHTML);
var nxthtml = "<ul class='nxtht'";
if(chtismobile > 0) nxthtml += " style='position:static'";
nxthtml += "><li><a onclick=\"chtipths('" + ip + "','" + thsi + "')\"><span>&bull;<\/span> 귓속말</a><\/li><li><a onclick=\"cht_11chat('" + ip + "','" + thsi + "')\"><span>&bull;<\/span> 1:1 대화신청<\/a><\/li>";
if(chtualert != '5') nxthtml += "<li><a onclick=\"chtipths('" + ip + thsi + "','')\"><span>&bull;<\/span> 알림음 호출<\/a><\/li>";
if('<?=$cht_isadmin?>' == '1' || '<?=$cht_isadmin?>' == '2') nxthtml += "<li><a onclick=\"cht_kout('" + ip + "','" + thsi + "')\"><span>&bull;<\/span> 강퇴<\/a><\/li><li><a onclick=\"cht_obj.value='" + ip + "'\"><span>&bull;<\/span> " + ip + "<\/a><\/li><\/ul>";
setTimeout("cht_imopn = 1",100);
if(n === 1) return nxthtml;
else {
ths.nextSibling.innerHTML = nxthtml;
ths.nextSibling.style.display = 'block';
cht_nxthtml = ths.nextSibling;
if(dallar("cht_CC").onclick && parseInt(dallar("cht_DD").style.height) < parseInt(dallar("cht_AA").style.height)) eval(dallar("cht_CC").onclick.toString().substr(dallar("cht_CC").onclick.toString().indexOf("{")));
}}}
function cht_kout(xban, xnick) {
if('<?=$cht_isadmin?>' == '1' || '<?=$cht_isadmin?>' == '2'){
if(chtisbk) var chtlgnf = document.logox;
else var chtlgnf = dallar('cht_ban').contentWindow.document.logox;
if(xban) {
if(confirm(xnick + "님을 강퇴합니까?")) {
chtlgnf.ban.value = xban;
chtlgnf.nick.value = xnick;
}} else chtlgnf.delf.value = xnick;
chtlgnf.submit();
}}
function tout() {
dallar('cht_gout').value = '1';
}
function chtaablk() {
if(chtblk == 1 || new Date().getTime() -  chtaablkc > 10000) {
dallar('cht_AA').style.visibility = 'visible';
document.title = chttitle;
chtblk = 1;
} else {
dallar('cht_AA').style.visibility = (dallar('cht_AA').style.visibility == 'hidden')? 'visible':'hidden';
document.title = (document.title != chttitle)? chttitle:chtctitle;
setTimeout("chtaablk()",200);
}}
window.onbeforeunload = function(){if(!chtisbk && chtunload == 'Y') {if(dallar('cht_gout').value == '0'){if(cht_go('out')){dallar('cht_gout').value = '9';if(navigator.appName == 'Opera') alert('접속을 종료합니다');else return "---";}}}}
window.onunload = function(){window.onbeforeunload();}
document.onclick = function() {if(cht_imopn) cht_imgview(0);chtblk = 1;}
<?
exit;
}}
if($ftc = @fopen($chtfid."_chtntc","r")) {
$chtfbold = (int)fgets($ftc);
$chtfmly = trim(fgets($ftc));
$chtftsz = trim(fgets($ftc));
$chtimgmk = (int)fgets($ftc);
$chtunload = trim(fgets($ftc));
$chtuadmico = (int)fgets($ftc);
$chtuseico = (int)fgets($ftc);
$chtusealert = (int)fgets($ftc);
$chtnoticet = (int)fgets($ftc);
$chtnoticex = (int)fgets($ftc);
$chtwidth_ = trim(fgets($ftc));if(!$chtwidth) $chtwidth = $chtwidth_;
$chtheight_ = trim(fgets($ftc));if(!$chtheight) $chtheight = $chtheight_;
$chthorizon_ = trim(fgets($ftc));if(!$chthorizon) $chthorizon = $chthorizon_;
$cht_cntwh_ = trim(fgets($ftc));if(!$cht_cntwh) $cht_cntwh = $cht_cntwh_;
$cht_usrwh_ = trim(fgets($ftc));if(!$cht_usrwh) $cht_usrwh = $cht_usrwh_;
$chtemptybak = (int)fgets($ftc);
$chtmyself = (int)fgets($ftc);
$chtreload = (int)fgets($ftc);
$chtinterval = trim(fgets($ftc));
$chtcolorpk = (int)fgets($ftc);
$chtview = (int)fgets($ftc);
$chtimgmw = (int)fgets($ftc);
$chtmemberonly = (int)fgets($ftc);
$chtrefresh = (int)fgets($ftc);if(!$chtrefresh) $chtrefresh = 1500;
$chtleave = (int)fgets($ftc);
$chtbakonly = trim(fgets($ftc));
$chtupdown = (int)fgets($ftc);
$chtlvico = (int)fgets($ftc);
$chtenter = (int)fgets($ftc);
$chtfitalic = (int)fgets($ftc);
$chtfunderline = (int)fgets($ftc);
$chtwrtpst = (int)fgets($ftc);
$chtusealert2 = (int)fgets($ftc);
$chtrefresh2 = (int)fgets($ftc);
$chturefresh = (int)fgets($ftc);
$chtfmobile = (int)fgets($ftc);
$chtncw = (int)fgets($ftc);
$chtcallt = (int)fgets($ftc);
$chtmemberonly2 = (int)fgets($ftc);
$chtlimit = (int)fgets($ftc);
$chtnoticed = '';
while(!feof($ftc)) $chtnoticed .= fgets($ftc);
fclose($ftc);
if($chtismobile) $chtmemberonlyy = $chtmemberonly2;
else $chtmemberonlyy = $chtmemberonly;
if($chtismobile && $chtfmobile) $_SESSION['chtmobile'] = 1;
else unset($_SESSION['chtmobile']);
}
if($_GET['xbk']) {
if($chtemptybak > 0 && @filesize($chtbk) > $chtemptybak*1024) fclose(fopen($chtbk,"w"));
exit;
}
if(!$_SESSION['srchatsr'] && $_COOKIE['mck'] == md5($_SESSION['mk']) && $_SESSION['m_nick']) {
$gboard = $_SESSION[$_SESSION[$_COOKIE[md5($_COOKIE['mck']."\x1b".$_SESSION['mk'])]]];
if(!$chtimgmk) $imgm = '';
else if($gboard[1] && file_exists("./icon/m20_".$gboard[1])) $imgm = $gboard[1];
$_SESSION['srchatsr'] = array($gboard[2],$imgm);
$chtnck = $_SESSION['m_nick'];
}
if($chtexit != 'exit') {
if(!$chtwidth) $chtwidth = '450px';
if(!$chtheight) $chtheight = '350px';
if(!$chthorizon) $chthorizon = 'v';
if(!$cht_cntwh) $cht_cntwh = '83.9%';
if(!$cht_usrwh) $cht_usrwh = '16%';
if(strpos($_SERVER['PHP_SELF'],$chat) !== false) {
$ischat = 1;
header ("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="srchat 218.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel='stylesheet' type='text/css' href='module/_chat.css' />
<style type='text/css'>
#cht_fbdy #cht_AA div, #cht_fbdy #cht_DD dt {font-family:<?=$chtfmly?>;font-size:<?=$chtftsz?>pt}
input,select {font-size:9pt}
</style>
<?
}
if($_GET['v'] == "ban") {
if($chtemptybak > 0 && @filesize($chtbk) > $chtemptybak*1024) fclose(fopen($chtbk,"w"));
$chtxword = '';
if($ff = @fopen($chtxwd,"r")) {
while($fff = trim(fgets($ff))) {
$chtxword[] = $fff;
}
fclose($ff);
}
if($_GET['admin'] == 1) {
?>
<title>관리자 기능</title>
</head>
<body id="cht_fbdy" style="border:0;text-align:center">
<?
} else {
?>
<script type="text/javascript">
var chtntc;
function setup() {
<?
function roon() {
global $chtfid;
$g = 0;
if($fff = @opendir($chtfid."_gst")) {
while($ffg = readdir($fff)) {
if(substr($ffg,0,2) == 'm_' && $ffg != 'm_') $g++;
}}
closedir($fff);
return $g;
}
if(!$_SESSION['srchatsr'] && $chtmemberonlyy == 3) echo "parent.cht_delt(parent.dallar('cht_fbdy'));";
else if($chtlimit > 0 && !file_exists($chtmip.$chtip) && $chtlimit < roon()) echo "parent.dallar('cht_fbdy').innerHTML = '<p align=\'center\'>인원 제한 초과</p>';";
else {
$chtrefreshh = ($chtrefresh2 && $chtismobile)? $chtrefresh2:$chtrefresh;
?>
if(!parent.cht_obj) {
<? if(!$_SESSION['srchatsr'] && $chtmemberonlyy == 2) echo "parent.dallar('chtwtfm').style.display = 'none';\nparent.chtrefresh = ".($chtrefreshh*2).";\n"; else {$chtmemberonlyy = 0;echo "parent.chtrefresh = {$chtrefreshh};\n";}?>
parent.chtimgmk = <?=$chtimgmk?>;
parent.chtv100 = '<?=((strpos($_SERVER['HTTP_USER_AGENT'],'AppleWebKit') !== false)? '100%':'0')?>';
parent.chtreload = '<?=$chtreload?>';
parent.chtcallt = <?=$chtcallt*1000?>;
parent.chtlvico = '<?=$chtlvico?>';
<? if($chtinterval) echo "parent.chtinterval = {$chtinterval};\n";
if(!$chtuimg || ($chtuimg == 2 && $chtismobile)) echo "parent.chtuimg = 2;\n";
if($chtview || $chtismobile) echo "parent.chtview = 2;\n";
if($chtimgmw) {?> parent.chtimgmw = <?=$chtimgmw?>;
<?} if($chtmemberonlyy != 2 && ($chtuseico === 1 || ($chtuseico === 3 &&!$chtismobile) || ($chtuseico === 4 && $chtismobile))) {?>parent.dallar('cht_LL').style.display = '';
<?} else if(!$chtuseico) {?>parent.dallar('cht_LL').title = 'disabled';
<?} if($chtmemberonlyy != 2 && ($chtfbold === 1 || ($chtfbold === 3 &&!$chtismobile) || ($chtfbold === 4 && $chtismobile))) {?>parent.dallar('cht_MM').style.display = '';
<?} else if(!$chtfbold) {?>parent.dallar('cht_MM').title = 'disabled';
<?} if($chtmemberonlyy != 2 && ($chtfitalic === 1 || ($chtfitalic === 3 &&!$chtismobile) || ($chtfitalic === 4 && $chtismobile))) {?>parent.dallar('cht_PP').style.display = '';
<?} else if(!$chtfitalic) {?>parent.dallar('cht_PP').title = 'disabled';
<?} if($chtmemberonlyy != 2 && ($chtfunderline === 1 || ($chtfunderline === 3 &&!$chtismobile) || ($chtfunderline === 4 && $chtismobile))) {?>parent.dallar('cht_QQ').style.display = '';
<?} else if(!$chtfunderline) {?>parent.dallar('cht_QQ').title = 'disabled';
<?} if($chturefresh === 1 || ($chturefresh === 3 &&!$chtismobile) || ($chturefresh === 4 && $chtismobile)) {?>parent.dallar('cht_RR').style.display = '';
<?} else if(!$chturefresh) {?>parent.dallar('cht_RR').title = 'disabled';
<?} if($chtleave === 1 || ($chtleave === 3 &&!$chtismobile) || ($chtleave === 4 && $chtismobile)) {?>parent.dallar('cht_OO').style.display = '';
<?} else if(!$chtleave) {?>parent.dallar('cht_OO').title = 'disabled';
<?} if($chtreload > 2) { if($chtismobile) {?>parent.chtreload = '1';<?} else if($chtreload == 4) {?>parent.chtreload = '2';<?}} else {?>parent.chtreload = '<?=$chtreload?>';
<?} if($chtpnck == 2) {?>parent.dallar('neme').style.display = 'none';
<?} else if($chtpnck || $_SESSION['srchatsr']) {?>parent.dallar('neme').readOnly = 'readOnly';
<?}?>
parent.chtuadmico = '<?=$chtuadmico?>';
parent.chtmyself = '<?=$chtmyself?>';
parent.chtunload = '<?=(($chtunload == 'Y' || ($chtunload != 'T' && strpos($_SERVER['HTTP_REFERER'],$chat) !== false))? 'Y':'N')?>';
parent.chtip = '<?=$chtip?>';
parent.chtupdown = '<?=$chtupdown?>';
chtntc = document.getElementById('chtnoticed').value;
parent.chttalert = <?=$chtusealert*1000?>;
parent.chtualert = '<?=$chtusealert2?>';
setInterval("window.open('?chtid=<?=$chtid?>&xbk=1','chtdelbak')",300000);
setTimeout("parent.cht_setup()",500);
if("<?=$chtnoticet?>" != "0" && "<?=$chtnoticet?>" != "" && chtntc != "") {
var chtnts = chtntc.split("###");
var chtntsl = chtnts.length;
var chtnoticet = <?=$chtnoticet*1000?>;
var chtnoticel = chtntsl*chtnoticet;
var ii = 0;
for(var i=0;i < chtntsl;i++) {
ii = chtnoticet * (i + 1);
setTimeout("parent.cht_inn(\"" + chtnts[i] + "\",<?=$chtnoticex*1000?>)",ii);
setTimeout("setInterval(\"parent.cht_inn(\\\"" + chtnts[i] + "\\\",<?=$chtnoticex*1000?>)\"," + chtnoticel + ")",ii);
}}}
<?
if($chtxword) {
echo "parent.dph = Array(";
foreach($chtxword as $fpp) echo "'{$fpp}',";
echo "'');\n";
}
$iswrtpst = 0;
if($chtismobile) {
echo "parent.chtismobile = 1;\nparent.dallar('chtsbmt2').style.width='35px';\n";
if($chtupdown != 0) echo "parent.chtupdown = '1';\n";
if($chtwrtpst != 0) $iswrtpst = 1;
} else {
if($chtisie6) echo "parent.chtismobile = 2;\n";
if($chtupdown == 1) echo "parent.chtupdown = '1';\n";
if($chtwrtpst == 1) $iswrtpst = 1;
}
if($iswrtpst == 1) {
?>
parent.chtwrtpst = 1;
parent.dallar('chtwtfm').style.width = parent.dallar('cht_HH').offsetWidth + 'px';
var chtwtfmh = ('<?=$chtncw?>' == '1')? 26:47;
if('<?=$chtismobile?>' != '0') chtwtfmh += 5;
var cht_HHh = parent.dallar('cht_HH').offsetHeight;
parent.dallar('cht_HH').style.marginTop = chtwtfmh + 'px';
parent.dallar('chtwtfm').style.marginTop = (-chtwtfmh + -cht_HHh - 20) + 'px';
parent.dallar('chtwtfm').style.position = 'absolute';
parent.dallar('cht_HH').style.borderTop = '1px solid #CEDEFF';
<?
}
if($isdid && ($chtismobile != 3 || $chtiswin)) {
if($chtismobile) echo "parent.dallar('chtupload').innerHTML=\"<iframe src='\" + parent.chtsrchat + \"&amp;v=file' frameborder='0' style='width:55px'><\/iframe>\";\n";
else echo "parent.dallar('chtupload').innerHTML=\"<iframe src='\" + parent.chtsrchat + \"&amp;v=file' frameborder='0'><\/iframe>\";\n";
}
if($cht_isadmin) {
if($chtbakonly == '30')  echo "parent.dallar('chtadmin').style.display = 'none';\n";
} else echo "parent.dallar('chtadmin').innerHTML = 'false';\nparent.dallar('chtadmin').style.display = 'none';\n";
if($chtcolorpk != 4 && (!$chtcolorpk || ($chtcolorpk != '3' && $_SESSION['srchatsr']) || $cht_isadmin)) echo "parent.dallar('cht_color').style.display = 'inline';\n";
if($ischtbk && ($chtbakonly[0] == '1' || ($chtbakonly[0] == '2' && $_SESSION['srchatsr']) || $cht_isadmin)) {
if($chtbakonly[1] != '1') echo "parent.dallar('chtbackup').style.display = 'none';\n";
} else echo "parent.dallar('chtbackup').style.display = 'none';\nparent.dallar('chtbackup').innerHTML = 'false';\n";
}
if(($chtenter && substr($chtid,0,2) != '__') || ($chtleave && $_SESSION['cht_out'] == $chtid)) $chenter = 1;
else $chenter = 3;
?>
var chcontentw = ('<?=$chtncw?>' == '1')? 20 + parent.dallar('chtnecolor').offsetWidth:14;
if('<?=$chtismobile?>' != '0') chcontentw += 40;
parent.dallar('chcontent').style.width = parent.dallar('cht_HH').offsetWidth - chcontentw + 'px';
}
function chtenter(ths) {
if(ths == 3) setup();
else {
parent.dallar("cht_img").innerHTML = "<div class='chtenter' style='width:" + parent.dallar('cht_HH').scrollWidth + "px;height:" + (parent.dallar('cht_fbdy').scrollHeight - 2) + "px'><input type='button' value=' 채팅방 입장 ' onclick=\"dallar('cht_ban').contentWindow.chtopen(" + ths + ")\" \/><\/div>";
parent.dallar("cht_img").style.display = "block";parent.dallar("cht_img").style.zIndex = "1";
}}
function chtopen(ths) {
parent.cht_imgview(0);
if(ths == 2) {
parent.dallar('cht_OO').style.borderWidth='0px';
parent.dallar('cht_AA').innerHTML='';
parent.dallar('cht_ntim').value='0000000000a';
parent.cht_go('in');
} else setup();
}
</script>
</head>
<body id="cht_fbdy" style="border:0;overflow:hidden;text-align:center" onload="setTimeout('chtenter(<?=$chenter?>)',10)">
<textarea id="chtnoticed" cols="1" rows="1" style="display:none"><?=str_replace('"','#34;',str_replace("'","#39;",$chtnoticed))?></textarea>
<iframe name="chtdelbak" src="" frameborder="0" style="display:none"></iframe>
<?
}
if($cht_isadmin) {
?>
<form name='logox' style="margin:0 0 50px 0" method="post" action="<?=$chat?>">
<input type="hidden" name="chtid" value="<?=$chtid?>" />
<input type="hidden" name="ban" value="" />
<input type="hidden" name="nick" value="" />
<input type="hidden" name="delf" value="" />
<input type="hidden" name="delcht" value="" />
<?
if($_GET['admin'] == 1) {
if($chtfid) {
?>
<div class='cht_addv'>금지된 표현</div>
<? if($chtxword) {foreach($chtxword as $fpp) {?>
<input type="text" name="xword[]" class="cht_ipt" value="<?=$fpp?>" />&nbsp;
<?}}?>
<br /><input type="text" name="xword[]" class="cht_ipt" />
<div class='cht_addv'>접속차단된 IP</div>
<?
if(file_exists($chtfid."_ban/")) {
$ff = opendir($chtfid."_ban/");
while($fff = readdir($ff)) {
if($fff != '.' && $fff != '..') {
$a = fopen($chtfid."_ban/".$fff,"r");$aa = fgets($a);fclose($a);
if($aa) {$aa = explode("\x1b",$aa);$aa = "NAME : ".$aa[1]." , DATE : ".date("m-d H:i:s",$aa[0])." , BY : ".$aa[2];}
?>
<input type="text" name="prhd[]" class="cht_ipt" value="<?=$fff?>" onfocus="document.getElementById('prhdex').value = '<?=$aa?>'" />&nbsp;
<?
}}
closedir($ff);
}
?>
<br /><input type="text" id="prhdex" class="cht_ipt" style="width:300px" />
<div class='cht_addv'>높이,넓이,형태</div>
<br />전체 넓이 : <input type="text" name="chtwidth_" class="cht_ipt" style="width:40px" value="<?=$chtwidth?>" />
<br />전체 높이 : <input type="text" name="chtheight_" class="cht_ipt" style="width:40px" value="<?=$chtheight?>" />
<br /><label><input name="chthorizon_" type="radio" value="v" <? if($chthorizon == 'v') echo "checked=\"checked\"";?> /> 세로2단</label>&nbsp; <label><input name="chthorizon_" type="radio" value="h" <? if($chthorizon != 'v') echo "checked=\"checked\"";?> /> 가로2단</label>
<br /><span title="가로2단에서는 넓이, 세로2단에서는 높이">채팅본문 : </span><input type="text" name="cht_cntwh_" class="cht_ipt" style="width:40px" value="<?=$cht_cntwh?>" />
<br /><span title="가로2단에서는 넓이, 세로2단에서는 높이">참여자란 : </span><input type="text" name="cht_usrwh_" class="cht_ipt" style="width:40px" value="<?=$cht_usrwh?>" />
<div class='cht_addv'>공지</div>각각의 공지 사이의 구분자는 ### 입니다.<br />
<textarea name="chtnoticed_" cols="1" rows="5" style="width:80%;height:50px;font-size:9pt"><?=$chtnoticed?></textarea>
<br /><span title="이 시간마다 공지를 노출합니다">노출주기 : </span><input type="text" name="chtnoticet_" class="cht_ipt" style="width:40px" value="<?=$chtnoticet?>" />초
<br /><span title="노출된 공지를 이 시간 뒤에 지웁니다.">삭제시간 : </span><input type="text" name="chtnoticex_" class="cht_ipt" style="width:40px" value="<?=$chtnoticex?>" />초
<br /><span title="알림 표시하는 새글과 이전글의 시간간격 / 0으로 설정하면 시간간격 알림 사용 안 함">알림주기 : </span><input type="text" name="chtusealert_" class="cht_ipt" style="width:40px" value="<?=$chtusealert?>" />초
<br /><span>알림방법 : </span><select name="chtusealert2_" /><option value='0' <? if(!$chtusealert2) echo "selected='selected'";?>>소리</option><option value='2' <? if($chtusealert2 == '2') echo "selected='selected'";?>>깜박임</option><option value='3' <? if($chtusealert2 == '3') echo "selected='selected'";?>>소리+깜박임</option><option value='4' <? if($chtusealert2 == '4') echo "selected='selected'";?>>pc소리,mobile깜박임</option><option value='5' <? if($chtusealert2 == '5') echo "selected='selected'";?>>알림 사용 안 함</option></select>
<div class='cht_addv'>글꼴,크기</div>
<br />글꼴 :: <select name="chtfmly_">
<option value='Gulim' <? if($chtfmly == 'Gulim') echo "selected='selected'";?>>굴림</option>
<option value='Dotum' <? if($chtfmly == 'Dotum') echo "selected='selected'";?>>돋움</option>
<option value='Batang' <? if($chtfmly == 'Batang') echo "selected='selected'";?>>바탕</option>
<option value='Gungsuh' <? if($chtfmly == 'Gungsuh') echo "selected='selected'";?>>궁서</option>
<option value='Malgun Gothic' <? if($chtfmly == 'Malgun Gothic') echo "selected='selected'";?>>맑은고딕</option>
<option value='Arial' <? if($chtfmly == 'Arial') echo "selected='selected'";?>>Arial</option>
<option value='Tahoma' <? if($chtfmly == 'Tahoma') echo "selected='selected'";?>>Tahoma</option>
<option value='Verdana' <? if($chtfmly == 'Verdana') echo "selected='selected'";?>>Verdana</option>
<option value='Trebuchet MS' <? if($chtfmly == 'Trebuchet MS') echo "selected='selected'";?>>Trebuchet MS</option>
<option value='sans-serif' <? if($chtfmly == 'sans-serif') echo "selected='selected'";?>>sans-serif</option>
</select>
<br />크기 :: <select name="chtftsz_">
<option value='9' <? if($chtftsz == '9') echo "selected='selected'";?>>9pt</option>
<option value='8' <? if($chtftsz == '8') echo "selected='selected'";?>>8pt</option>
<option value='7' <? if($chtftsz == '7') echo "selected='selected'";?>>7pt</option>
<option value='10' <? if($chtftsz == '10') echo "selected='selected'";?>>10pt</option>
<option value='11' <? if($chtftsz == '11') echo "selected='selected'";?>>11pt</option>
<option value='12' <? if($chtftsz == '12') echo "selected='selected'";?>>12pt</option>
<option value='13' <? if($chtftsz == '13') echo "selected='selected'";?>>13pt</option>
<option value='15' <? if($chtftsz == '15') echo "selected='selected'";?>>15pt</option>
<option value='18' <? if($chtftsz == '18') echo "selected='selected'";?>>18pt</option>
</select>
<div class='cht_addv'>전체 대화방</div>
<?
if($ff = @opendir($chtdate.$chtdata)) {
while($fg = readdir($ff)) {
if($fg != '.' && $fg != '..') {
$g = 0;$gh = 0;
if($fff = @opendir($chtdate.$chtdata."/".$fg."/_gst")) {
while($ffg = readdir($fff)) {
if(substr($ffg,0,2) == 'm_' && $ffg != 'm_') {
$g++;
$gf = filemtime($chtdate.$chtdata."/".$fg."/_gst/".$ffg);
if($gf > $gh) $gh = $gf;
}}}
closedir($fff);
if(substr($fg,0,2) == '__' && ($g == 0 || $time - $gh > 60)) chtrmfd($chtdate.$chtdata."/".$fg,1);
else {$chwjs = $time - $gh;$chlwhd = '';if($chwjs > 86400) {$chlwhd .= sprintf("%d",($chwjs/86400))."일 ";$chwjs = $chwjs % 86400;}if($chwjs > 3600) {$chlwhd .= sprintf("%d",($chwjs/3600))."시간 ";$chwjs = $chwjs % 3600;}if($chwjs > 60) {$chlwhd .= sprintf("%d",($chwjs/60))."분 ";$chwjs = $chwjs % 60;}$chlwhd .= $chwjs."초";
echo "<input type='button' onclick=\"location.href='?chtid={$fg}'\" value='{$fg}' style='width:100px";
if(substr($fg,0,2) == '__') echo ";color:#FF0000";
echo "' /><input type='button' value='삭제' onclick=\"var dx=this.previousSibling.value;if(confirm('\'' + dx + '\' 대화방을 삭제합니까')) {document.logox.delcht.value=dx;submit();}\" style='margin-left:10px' /> <input type='text' value=\"".$g."명 / 최종접속: ".$chlwhd."전 / 생성시간: ".date("Y-m-d H:i:s",@filemtime($chtdate.$chtdata."/".$fg."/.htaccess"))."\" style='border:0;width:400px' /><br />";
}}}
closedir($ff);
}
?>
<div class='cht_addv'>이미지 설정</div><div style='width:300px;text-align:left;margin:0 auto'>
<div>첨부파일 이미지 처리 :: <select name="chtuimg_"><option value="0" <? if(!$chtuimg) echo "selected=\"selected\"";?>>텍스트 링크</option><option value="1" <? if($chtuimg == 1) echo "selected=\"selected\"";?>>썸네일 링크</option><option value="2" title="모바일에서는 텍스트 링크, PC에서는 썸네일 링크" <? if($chtuimg == 2) echo "selected=\"selected\"";?>>모바일에서 텍스트 링크</option></select></div>
<br />이미지 링크 처리 :: <label><input name="chtview_" type="radio" value="1" <? if($chtview) echo "checked=\"checked\"";?> /> 새창으로</label>&nbsp; <label><input name="chtview_" type="radio" value="0" <? if(!$chtview) echo "checked=\"checked\"";?> /> 레이어로</label>
<div>썸네일 최대 넓이 : <input type="text" name="chtvimg_" class="cht_ipt" style="width:50px" value="<?=$chtvimg?>" />px</div>
<div title="0이면 원본 넓이로">레이어 넓이 : <input type="text" name="chtimgmw_" class="cht_ipt" style="width:50px" value="<?=$chtimgmw?>" />px</div>
</div>
<div class='cht_addv'>기타 설정</div><div style='width:350px;text-align:left;margin:0 auto'>
<br /><label><input name="chtusebak" type="radio" value="a" <? if($ischtbk) echo "checked=\"checked\"";?> /> 내용백업 사용</label>&nbsp; <label><input name="chtusebak" type="radio" value="b" <? if(!$ischtbk) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label title="회원 닉네임앞에 이미지 마크 사용여부"><input name="chtimgmk_" type="radio" value="1" <? if($chtimgmk) echo "checked=\"checked\"";?> /> 이미지 마크</label>&nbsp; <label><input name="chtimgmk_" type="radio" value="0" <? if(!$chtimgmk) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label><input name="chtlvico_" type="radio" value="1" <? if($chtlvico) echo "checked=\"checked\"";?> /> 레벨아이콘 사용</label>&nbsp; <label><input name="chtlvico_" type="radio" value="0" <? if(!$chtlvico) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label title='srchat_adm.gif'><input name="chtuadmico_" type="radio" value="1" <? if($chtuadmico) echo "checked=\"checked\"";?> /> 관리자 아이콘 구분</label>&nbsp; <label><input name="chtuadmico_" type="radio" value="0" <? if(!$chtuadmico) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label><input name="chtenter_" type="radio" value="1" <? if($chtenter) echo "checked=\"checked\"";?> /> 버튼 클릭 입장</label>&nbsp; <label><input name="chtenter_" type="radio" value="0" <? if(!$chtenter) echo "checked=\"checked\"";?> /> 자동 입장</label>
<br /><label><input name="chtvban_" type="radio" value="1" <? if($chtvban) echo "checked=\"checked\"";?> /> 강퇴 본문 출력</label>&nbsp; <label><input name="chtvban_" type="radio" value="0" <? if(!$chtvban) echo "checked=\"checked\"";?> /> 출력 안 함</label>
<br /><label title="채팅 본문에 참여자 각각 자신의 글에서 닉네임 강조 사용 여부"><input name="chtmyself_" type="radio" value="1" <? if($chtmyself) echo "checked=\"checked\"";?> /> 본문 본인 강조</label>&nbsp; <label><input name="chtmyself_" type="radio" value="0" <? if(!$chtmyself) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label title="모바일 사용자 아이콘으로 구분 (mobile.gif)"><input name="chtfmobile_" type="radio" value="1" <? if($chtfmobile) echo "checked=\"checked\"";?> /> 모바일 사용자 구분</label>&nbsp; <label><input name="chtfmobile_" type="radio" value="0" <? if(!$chtfmobile) echo "checked=\"checked\"";?> /> 사용 안 함</label>
<br /><label title="닉네임과 색상과 글쓰기란을 한 줄로"><input name="chtncw_" type="radio" value="1" <? if($chtncw) echo "checked=\"checked\"";?> /> 닉네임 글쓰기 한줄로</label>&nbsp; <label><input name="chtncw_" type="radio" value="0" <? if(!$chtncw) echo "checked=\"checked\"";?> /> 두줄로</label>
<div>닉네임 :: <select name="chtpnck_"><option value="0" <? if(!$chtpnck) echo "selected=\"selected\"";?>>비회원 닉변경 가능</option><option value="1" <? if($chtpnck == 1) echo "selected=\"selected\"";?>>닉변경 불가능</option><option value="2" <? if($chtpnck == 2) echo "selected=\"selected\"";?>> &nbsp;- 닉네임란 숨김</option></select></div>
<div>첨부파일 :: <select name="chtufile_"><option value="2" <? if($chtufile == 2) echo "selected=\"selected\"";?>>비회원도 가능</option><option value="3" <? if($chtufile == 3) echo "selected=\"selected\"";?>>회원만 가능</option><option value="0" <? if(!$chtufile) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<fieldset><legend> 하단 아이콘 </legend><div title=" 이모티콘을 사용하려면, 
widgets/srchat/emoticon/ 경로에
 이미지파일이 들어 있어야 합니다.">이모티콘 :: <select name="chtuseico_"><option value="1" <? if($chtuseico == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <? if($chtuseico == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <? if($chtuseico == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <? if($chtuseico == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <? if($chtuseico == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div>굵게 :: <select name="chtfbold_"><option value="1" <? if($chtfbold == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <? if($chtfbold == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <? if($chtfbold == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <? if($chtfbold == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <? if($chtfbold == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div>기울게 :: <select name="chtfitalic_"><option value="1" <? if($chtfitalic == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <? if($chtfitalic == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <? if($chtfitalic == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <? if($chtfitalic == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <? if($chtfitalic == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div>밑줄 :: <select name="chtfunderline_"><option value="1" <? if($chtfunderline == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <? if($chtfunderline == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <? if($chtfunderline == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <? if($chtfunderline == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <? if($chtfunderline == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div>퇴장 :: <select name="chtleave_"><option value="1" <? if($chtleave == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <? if($chtleave == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <? if($chtleave == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <? if($chtleave == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <? if($chtleave == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div>새로고침 :: <select name="chturefresh_"><option value="1" <? if($chturefresh == 1) echo "selected=\"selected\"";?>>아이콘 보임</option><option value="3" <? if($chturefresh == 3) echo "selected=\"selected\"";?>> &nbsp;- PC만 보임</option><option value="4" <? if($chturefresh == 4) echo "selected=\"selected\"";?>> &nbsp;- 모바일만 보임</option><option value="2" <? if($chturefresh == 2) echo "selected=\"selected\"";?>>아이콘 숨김</option><option value="0" <? if($chturefresh == 0) echo "selected=\"selected\"";?>>사용 안 함</option></select></div></fieldset>
<div>회원전용 :: <select name="chtmemberonly_"><option value="3" <? if($chtmemberonly == 3) echo "selected=\"selected\"";?>>모두 회원만</option><option value="2" <? if($chtmemberonly == 2) echo "selected=\"selected\"";?>>쓰기는 회원만</option><option value="0" <? if($chtmemberonly == 0) echo "selected=\"selected\"";?>>비회원도</option></select>
- 모바일 :: <select name="chtmemberonly2_"><option value="3" <? if($chtmemberonly2 == 3) echo "selected=\"selected\"";?>>모두 회원만</option><option value="2" <? if($chtmemberonly2 == 2) echo "selected=\"selected\"";?>>쓰기는 회원만</option><option value="0" <? if($chtmemberonly2 == 0) echo "selected=\"selected\"";?>>비회원도</option></select></div>
<div>본문 색상선택 :: <select name="chtcolorpk_"><option value="4" <? if($chtcolorpk == 4) echo "selected=\"selected\"";?>>사용 안 함</option><option value="3" <? if($chtcolorpk == 3) echo "selected=\"selected\"";?>>관리자만</option><option value="2" <? if($chtcolorpk == 2) echo "selected=\"selected\"";?>>회원만</option><option value="0" <? if($chtcolorpk == 0) echo "selected=\"selected\"";?>>비회원도</option></select></div>
<div title="전체대화 보기 권한제한">전체대화 보기 :: <select name="chtbakonly_"><option value="31" <? if($chtbakonly == '31') echo "selected=\"selected\"";?>>관리자만</option><option value="30" <? if($chtbakonly == '30') echo "selected=\"selected\"";?>> &nbsp;- 링크 숨김</option><option value="21" <? if($chtbakonly == '21') echo "selected=\"selected\"";?>>회원만</option><option value="20" <? if($chtbakonly == '20') echo "selected=\"selected\"";?>> &nbsp;- 링크 숨김</option><option value="11" <? if($chtbakonly == '11') echo "selected=\"selected\"";?>>비회원도</option><option value="10" <? if($chtbakonly == '10') echo "selected=\"selected\"";?>> &nbsp;- 링크 숨김</option></select></div>
<div title=" 경로가 변경될 때, '다른 페이지를 탐색하시겠습니까'
 라고 뜨는 경고창 사용여부 설정,
 사용하면 접속종료 파악이 빨라집니다.">경로이동 경고창 :: <select name="chtunload_"><option value="Y" <? if($chtunload == 'Y') echo "selected=\"selected\"";?>>사용</option><option value="N" <? if($chtunload == 'N') echo "selected=\"selected\"";?>>새창에서만</option><option value="T" <? if($chtunload == 'T') echo "selected=\"selected\"";?>>사용 안 함</option></select></div>
<div title=" ajax 접속이 먹통이어서, 새로고침이 필요할 때">ajax 먹통일 때 :: <select name="chtreload_"><option value="0" <? if(!$chtreload) echo "selected=\"selected\"";?>>새로고침 확인창</option><option value="1" <? if($chtreload == 1) echo "selected=\"selected\"";?>>즉시 새로고침</option><option value="2" <? if($chtreload == 2) echo "selected=\"selected\"";?>>새로고침 안내문</option><option value="3" <? if($chtreload == 3) echo "selected=\"selected\"";?>>PC확인창, mobile 즉시 새로고침</option><option value="4" <? if($chtreload == 4) echo "selected=\"selected\"";?>>PC안내문, mobile 즉시 새로고침</option></select></div>
<div title=" 채팅 본문 출력하는 방향 : 아래로 또는 위로">본문 출력 방향 :: <select name="chtupdown_"><option value="0" <? if(!$chtupdown) echo "selected=\"selected\"";?>>위에서 아래로</option><option value="1" <? if($chtupdown == 1) echo "selected=\"selected\"";?>>아래에서 위로</option><option value="2" <? if($chtupdown == 2) echo "selected=\"selected\"";?>>모바일에서 위로</option></select></div>
<div title=" 채팅 글쓰는 란 위치">글쓰는 란 위치 :: <select name="chtwrtpst_"><option value="0" <? if(!$chtwrtpst) echo "selected=\"selected\"";?>>아래로</option><option value="1" <? if($chtwrtpst == 1) echo "selected=\"selected\"";?>>위로</option><option value="2" <? if($chtwrtpst == 2) echo "selected=\"selected\"";?>>모바일에서 위로</option></select></div>
<div title="입장 인원제한설정, 0으로 설정하면 제한 안 함">입장 인원제한 :: <input type="text" name="chtlimit_" class="cht_ipt" style="width:40px" value="<?=$chtlimit?>" />명</div>
<div title="글쓰기 시간 간격 제한설정, 0으로 설정하면 제한 안 함">글쓰기 시간간격 :: <input type="text" name="chtinterval_" class="cht_ipt" style="width:40px" value="<?=$chtinterval?>" />초</div>
<div title="알림음 호출 시간 간격 제한설정, 0으로 설정하면 제한 안 함">알림음 호출 시간간격 :: <input type="text" name="chtcallt_" class="cht_ipt" style="width:40px" value="<?=$chtcallt?>" />초</div>
<div title="백업파일용량이 이 값이 되면 백업파일을 비웁니다 / 0으로 설정하면 자동삭제 사용 안 함">백업파일 자동삭제 : <input type="text" name="chtemptybak_" class="cht_ipt" style="width:40px" value="<?=$chtemptybak?>" />kb</div>
<div title="첨부파일 누적용량이 이 값이 되면 모두 삭제 / 0으로 설정하면 총량제한 사용 안 함">첨부파일 총량제한 : <input type="text" name="chtmaxupload" class="cht_ipt" style="width:40px" value="<?=(int)$isdsm?>" />mb</div>
<div title="새글 확인하는 ajax 접속주기,디폴트는 1500(1.5초)">새글 확인주기 : <input type="text" name="chtrefresh_" class="cht_ipt" style="width:30px" value="<?=$chtrefresh?>" />/1000 초 - 모바일 : <input type="text" name="chtrefresh2_" class="cht_ipt" style="width:30px" value="<?=$chtrefresh2?>" />/1000 초</div>
</div><br /><br />
<input type="submit" value="입력" class="cht_button" style="width:75%;height:40px" /><br /><br />
<input type="button" onclick="if(confirm('채팅 백업파일을 비웁니까.')) {this.nextSibling.value='reset';submit();}" value="백업파일 비움" class="cht_button" style="width:120px" /><input type="hidden" name="backup" value="" />
<input type="button" onclick="if(confirm('첨부한 파일을 모두 삭제합니까.')) {this.nextSibling.value='delete';submit();}" value="첨부파일 모두삭제" class="cht_button" style="width:120px" /><input type="hidden" name="upload_delete" value="" />
<input type="button" onclick="if(confirm('채팅내용, 업로드파일, 백업파일을 비웁니까')) {this.nextSibling.value='empty';submit();}" value="채팅 비움" class="cht_button" style="width:120px" /><input type="hidden" name="empty" value="" />
<input type="button" onclick="if(confirm('<?=$chtid?> 대화방을 언인스톨하시겠습니까')) {this.nextSibling.value='uninstall';submit();}" value="uninstall" class="cht_button" style="width:120px" /><input type="hidden" name="install" value="1" />
<?} else if($chtid) {?>
<input type="button" onclick="if(confirm('<?=$chtid?> 대화방을 인스톨하시겠습니까')) {this.nextSibling.value='install';submit();}" value="install" class="cht_button" style="width:120px" /><input type="hidden" name="install" value="1" />
<?}}?>
</form>
<?}?>
</body></html>
<?
exit;
}
if(!$_SESSION['srchatsr'] && $chtmemberonlyy == 3) $chtfid = '';
if($chtfid) {
if($_GET['v'] == "file") {
if($isdid) {
?>
<title>upload</title>
<style type='text/css'>
html, body, form, input {overflow:hidden; margin:0; padding:0}
input {font-family:Tahoma; font-size:8pt}
.cht_button {background:url('icon/file.gif') no-repeat 0% 100%; border:0; float:left; padding-left:3px; height:16px; width:22px; cursor:pointer}
.cht_button2 {border:0; border:1px solid #828282; float:left; height:16px; width:30px; cursor:pointer}
.file {width:50px; height:20px; margin:0; opacity:0; position:absolute; top:0; left:0; z-index:2; cursor:pointer}
</style>
<!--[if IE]>
<style type='text/css'>
.file {filter:alpha(opacity=0); height:18px; width:30px}
</style>
<![endif]-->
</head>
<body>
<form name="chtupfm" enctype="multipart/form-data" action="<?=$chat?>" method="post">
<input type="hidden" name="chtid" value="<?=$chtid?>" />
<input type="button" value="" class="cht_button" /><input type="file" class="file" name="file" onchange="if(this.value) submit()" /><input type="submit" class="cht_button2" />
</form></body></html>
<?
exit;
}} else if($_GET['v'] == 'backup') {
if((!$cht_isadmin && $chtbakonly[0] == '3') || ($chtbakonly[0] == '2' && !$_SESSION['srchatsr'])) {echo "<script type='text/javascript'>alert('You don\'t have permission to access');</script>";exit;}
?>
<title>[저장된 기록]</title>
<style type='text/css'>
body,div,fieldset {font-size:9pt}
</style>
</head>
<body id="cht_fbdy" style="overflow:auto" onload="settup()">
<script type="text/javascript">
//<![CDATA[
var chtsrchat = '<?=$chat?>?chtid=<?=$chtid?>';
function settup() {
chtisbk = 1;
chtimgmk = <?=$chtimgmk?>;
var con = Array(""<?
$fp = fopen($chtbk, "r");
$memo = "";
while($memo = trim(fgets($fp))){
$memo = str_replace("</","<\/",str_replace("`","/",str_replace("\"","\\\"",$memo)));
$con = explode("\x1b", trim($memo));
if($con[4] && substr($memo, 0, 2) == "\x1b\x1b") {
if(substr($con[2],0,12) == $chtip || substr($con[2],12,12) == $chtip) {
$con[1] = $con[3];
$con[2] = $con[4];
}
}
if($con[1] != '') echo ",Array(\"{$con[0]}\",\"{$con[1]}\",\"{$con[2]}\",\"{$con[3]}\",\"{$con[4]}\",\"{$con[5]}\",\"{$con[6]}\",\"{$con[7]}\",\"{$con[8]}\")";
}
fclose($fp);
?>);
var cl = con.length -1;
if(cl > 0) {
var tcon = "<div class='cht_addv' style='margin:0'>&nbsp;</div>";
for(var i = 1;i <= cl;i++) {
if(con[i][0] != '') tcon += cht_tosty(con[i],1);
else tcon += "<div class='cht_ntc'>" + cht_tico(con[i][1]) + "</div>";
}
dallar('cht_AA').innerHTML = tcon;
}}
//]]>
</script>
<script type="text/javascript" src="<?=$chat?>?js=1"></script>
<fieldset id="cht_AA" style="width:50%;background:#FFFFFF;border:1px solid #828282;padding:5px;margin:0 auto;line-height:20px;text-align:left"></fieldset>
<div id="cht_img"></div><input type="hidden" id="cht_gout" value="0" />
<? if($cht_isadmin) {?>
<form name='logox' style="margin:0px" method="post" action="<?=$chat?>" target="exeframe">
<input type="hidden" name="chtid" value="<?=$chtid?>" />
<input type="hidden" name="delf" value="" />
<input type="hidden" name="frombk" value="1" />
</form>
<iframe name="exeframe" style="display:none"></iframe>
<?}?>
</body>
</html>
<?
exit;
}}
if($chtfid || $cht_isadmin) {
if($ischat) echo "\n<title>채팅</title>\n</head>\n<body>\n";
?>
<script type="text/javascript">
var chtsrchat = '<?=$chat?>?chtid=<?=$chtid?>';
</script>
<script type="text/javascript" src="<?=$chat?>?js=1"></script>
<fieldset id="cht_fbdy" style="width:<?=$chtwidth?>;padding:0;clear:both;margin:0 auto;background-color:#FFFFFF;text-align:left" onmouseover="chtblk = 1">
<?
$exxt = 0;
if($time - @filemtime($chtmip.$chtip) < 30 && $fnt = fopen($chtmip.$chtip,"r")) {
if(@fgets($fnt)) {
if($dgx = trim(@fgets($fnt))) {
if(md5($_SERVER['HTTP_USER_AGENT']) != $dgx) $exxt = 9;
}}
fclose($fnt);
}
if($exxt == 9) echo "<div style='text-align:center;font-size:10pt;font-weight:bold;padding:10px 0 10px 0'>double access denied</div>";
else {
if($chthorizon == 'h') {
$styaa = "width:{$cht_cntwh};height:100%;float:left";
$stydd = "width:{$cht_usrwh};height:100%;float:right;background:#FAFAFA;";
$cht_aadd = '';
} else {
$styaa = "width:{$chtwidth};height:{$cht_cntwh}";
$stydd = "height:{$cht_usrwh};border-bottom:1px solid #CEDEFF";
$cht_aadd = "onclick='cht_aadd(\"{$cht_cntwh}\",\"{$cht_usrwh}\")'";
}
?>
<div id="cht_img"></div>
<div id="cht_fico"></div>
<div id="cht_CC" <?=$cht_aadd?>><div id="cht_EE"></div><div id="cht_FF"></div></div>
<div id="cht_HH" style="height:<?=$chtheight?>">
<div id="cht_DD" style="<?=$stydd?>"></div>
<div id="cht_AA" style="<?=$styaa?>;font-family:<?=$chtfmly?>;font-size:<?=$chtftsz?>pt"></div>
</div>
<div id="cht_SS" style="font-size:9pt;font-family:Gulim">&nbsp;</div>
<form id="chtwtfm" onsubmit="cht_go('rpage');return false;" action=""><div id="chtnecolor">
<input type="text" id="neme" maxlength="10" value="<?=$chtnck?>" />
<select id="cht_color" title=";color:번호" onchange="cht_fbcolr()">
	<option value="00" style="background-color:#ffffff">색상</option>
	<option value="01" style="background-color:#000000">black</option>
	<option value="02" style="background-color:#7d7d7d">dimgray</option>
	<option value="03" style="background-color:#ff0000">red</option>
	<option value="04" style="background-color:#A52A2A">brown</option>
	<option value="05" style="background-color:#ff6c00">tomato</option>
	<option value="06" style="background-color:#ff9900">orange</option>
	<option value="07" style="background-color:#ffef00">yellow</option>
	<option value="08" style="background-color:#a6cf00">yellowgreen</option>
	<option value="09" style="background-color:#2E8B57">seagreen</option>
	<option value="10" style="background-color:#1c4827">darkgreen</option>
	<option value="11" style="background-color:#00b0a2">lightseagreen</option>
	<option value="12" style="background-color:#00ccff">deepskyblue</option>
	<option value="13" style="background-color:#0095ff">dodgerblue</option>
	<option value="14" style="background-color:#4682B4">steelblue</option>
	<option value="15" style="background-color:#0000CD">mediumblue</option>
	<option value="16" style="background-color:#9400D3">darkviolet</option>
	<option value="17" style="background-color:#FF1493">deeppink</option>
</select></div>
<input type="text" id="chcontent" onselect="cht_save_pos()" onclick="cht_save_pos()" maxlength="200" onfocus="this.style.imeMode='active'" onmouseover="this.focus()" />
<input type="submit" class="cht_button" id="chtsbmt2" /><div style="clear:both"></div></form>
<div id="cht_chkdiv">
<img src="icon/srchat_e.gif" id="cht_LL" alt=";ico" title=";ico" onclick="chtemtbk(this)" style="display:none" />
<img src="icon/srchat_b.gif" id="cht_MM" alt=";b" title=";b" onclick="chtemtbk(this)" style="display:none" /> 
<img src="icon/srchat_i.gif" id="cht_PP" alt=";i" title=";i" onclick="chtemtbk(this)" style="display:none" /> 
<img src="icon/srchat_u.gif" id="cht_QQ" alt=";u" title=";u" onclick="chtemtbk(this)" style="display:none" />
<img src="icon/srchat_x.gif" id="cht_OO" alt=";exit" title=";exit" onclick="cht_leave()" style="display:none" />
<img src="icon/srchat_r.gif" id="cht_RR" alt=";re" title=";re" onclick="dallar('cht_gout').value='9';location.reload()" style="display:none" />
<a target="_blank" id="chtbackup" href="<?=$chat?>?chtid=<?=$chtid?>&amp;v=backup"><img src="icon/srchat_k.gif" alt=";bak" title=";bak" /></a>
<a target="_blank" id="chtadmin" href="<?=$chat?>?chtid=<?=$chtid?>&amp;v=ban&amp;admin=1"><img src="icon/srchat_a.gif" alt="관리자" title=";admin" /></a>
<img src="icon/srchat_w.gif" id="cht_JJ" alt="귓속말" title="귓속말" onclick="chtipths()" style="display:none" />
</div>
<div id="chtupload"></div><div style="clear:both"></div>
<iframe id="cht_ban" src="<?=$chat?>?chtid=<?=$chtid?>&amp;v=ban" style="display:none" frameborder="0"></iframe>
<input type="hidden" id="cht_gout" value="0" /><input type="hidden" id="cht_ntim" value="a" /><input type="hidden" id="cht_vstd" value="" /><input type="hidden" id="cht_wip" value="" /><input type="hidden" id="cht_prev" value="" /><input type="hidden" id="psty" value="" /><input type="hidden" id="cht_pnam" value="<?=$chtnck?>" /><input type="hidden" id="cht_xtim" value="0" /><input type="hidden" id="cht_ptim" value="9999999999999" /><input type="hidden" id="cht_callt" value="0" />
</fieldset>
<?} if($ischat) {?>
</body>
</html>
<?}}}?>