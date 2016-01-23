<?
if($_GET['memo'] == 'get') {
$bdc = "#FFE0A3";
$bgc = "#FFFAF0";
$tle = "받은";
} else if($_GET['memo'] == 'post') {
$bdc = "#A3FFD1";
$bgc = "#F5FFFA";
$tle = "보낸";
}
$dmo1 = $dxr."memo1.dat";
$dmo2 = $dxr."memo2.dat";
?>
<style type='text/css'>
* {font-size:9pt; font-family:Gulim; line-height:130%}
body {margin:0}
a {color:black}
a:link {text-decoration:none}
a:visited {text-decoration:none}
a:hover {text-decoration:underline}
input {height:15px}
.button {cursor:pointer; width:40px; border:1px solid black; background-color:#D7D7D7; padding:0}
#mailform input {width:210px}
.tname {border-bottom:1px solid <?=$bdc?>}
.mname {float:left; padding-left:12px; background:url('icon/sg.gif') no-repeat 0px 5px; font-family:verdana; font-size:8pt; color:#444}
.mname img {height:13px}
.mdate {float:right; padding-right:10px}
.mdate img {height:11px; vertical-align:middle}
.mmemo {border-bottom:3px solid <?=$bdc?>; padding:5px 0 5px 10px}
.mmemo textarea {width:98%; height:20em; border:0; overflow:auto}
.p_no {background-color:<?=$bdc?>; color:#000000; padding:6px 4px 6px 4px}
.mnew {background-color:#FF6633; color:#FFFFFF; padding:0px 2px 0 2px}
</style>
<script type='text/javascript'>
//<![CDATA[
function popup(url, wt, ht) {
var mleft = (screen.width - wt) / 2;
var mtop = (screen.height - ht) / 2;
if(window.showModelessDialog) {
var pten = (navigator.appVersion.indexOf('MSIE 6') != -1)? 10:0;
wt = wt + 7 + pten;
ht = ht + 27 + pten;
var win = window.showModelessDialog('<?=$admin?>?fram='+url, window,  'dialogWidth:'+ wt +'px;dialogHeight:'+ ht +'px; resizable:Yes; center:Yes; status:No; help: No; scroll:No; dialogtop:'+ mtop +'px; dialogleft:'+ mleft +'px;');
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
</script>
</head>
<?
$ie7h = ($isie == 1 && !$ie8)? 10:0;
$ie6w = ($bwr == 'ie6')? 10:0;
if($_POST['email'] && $_POST['title']) {
if($sett[8] != 'a' && $sett[8] <= $mbr_level) {
/** 새메일 처리 시작 **/
if($mbr_level == 9 && $_POST['all'] == "all") {
$maddr = "";
$fim = fopen($dim,"r");
while(!feof($fim)) {
$fmo = fgets($fim);
if(trim($fmo)) {
$list = explode("\x1b", $fmo);
$maddr[] = $list[3];
if(!$from && (int)substr($fmo, 0, 5) == $mbr_no) $from = $list[3];
}
}
fclose($fim);
foreach($maddr as $address) {
$mailsent = sendmail($address,$_SESSION['m_nick'],$from,$_POST['title'],$_POST['maam']);
}
} else if($_POST['no']) {
$fim = fopen($dim,"r");
while(!feof($fim)) {
$fmo = fgets($fim);
$n = (int)substr($fmo, 0, 5);
if($n == $_POST['no']) $di2 = explode("\x1b", $fmo);
if($mbr_no >= 1) {
if($n == $mbr_no) $di3 = explode("\x1b", $fmo);
}
if($di2 && (!$mbr_no || $di3)) break;
}
fclose($fim);
if(!$mbr_no) {
$di3[1] = ($_POST['from'])? $_POST['from']:$_SERVER['REMOTE_ADDR'];
$di3[3] = $_POST['replyto'];
}
$mailsent = sendmail($di2[3],$di3[1],$di3[3],$_POST['title'],$_POST['maam']);
}
if($mailsent) {
?>
<body class='popupbk' onload="setTimeout('self.opener = self;window.close();', 500)" style='cursor:pointer;margin-top:60px;'><div style='font-size:40px;text-align:center'>발송완료</div>
<?
} else if($_POST['all'] != "all"){
?>
<body class='popupbk'>
<div style="text-align:center;padding:10px">
메일발송실패::<input type='button' onclick="location.href='mailto:<?=$di2[3]?>'" class="srbt" value='아웃룩 메일링크' style='width:100px;height:20px' />
<textarea style='width:100%;height:200px;overflow:auto'>제목:<?=$_POST['title']?>

내용:

<?=$_POST['maam']?></textarea>
<input type='button' onclick="self.opener = self;window.close();" class="srbt" value='창닫기' style='width:100px;height:20px' />
</div>
<?
}} else scrhref(0,0,'권한이 없습니다');
/** 새메일 처리 끝 **/
} if($_GET['send'] == 'mail') {
/** 메일보내기 출력 시작 **/
if($sett[8] != 'a' && $sett[8] <= $mbr_level) {
if($sett[15]) {
if($_GET['no'] == 'all') {
	$_GET['to'] = "회원전체";
	$all = "all";
}
?>
<script type='text/javascript'>/*<![CDATA[*/document.title='메일보내기';function onloaded() {var hh=document.getElementsByTagName('textarea')[0];hh.style.height=parent.window.document.documentElement.clientHeight-parseInt(document.getElementById('whtt').value)-<?=(int)$ie7h?>+'px';hh.style.width=parent.window.document.documentElement.clientWidth-50-<?=(int)$ie6w?>+'px';};function checking(ths) {if(ths.title.value == '') alert('제목이 비었습니다');else if('<?=(int)$mbr_no?>' == '0' && (ths.replyto.value == '' || ths.replyto.value.split(/[\x00-\x2D]/g).length > 1 || ths.replyto.value.replace(/^[0-9a-z_\.]+@([0-9a-z_]+\.[0-9a-z_\.]+)$/,'') != '')) alert('회신 주소가 잘못되었습니다');else ths.submit();}/*]]>*/</script>
<body class='popupbk' onresize='if(top.length == 0) onloaded()'>
<form enctype='multipart/form-data' id='mailform' method='post' action='<?=$exe?>' onsubmit='checking(this);return false'>
<input type='hidden' name='no' value='<?=$_GET['no']?>' />
받는사람: <input type='text' name='to' value='<?=$_GET['to']?>' /><br />
<?
if(!$mbr_id) {echo "보내는이: <input type='text' name='from' value='' /><br />
회신주소: <input type='text' name='replyto' value='' /><br />";
$theight = 100;
} else $theight = 135;
?>
<input type='hidden' name='email' value='<?=$_GET['send']?>' />
<input type='hidden' name='all' value='<?=$all?>' />
메일제목: <input type='text' name='title' value='' /><br />
<textarea name='maam' style='width:270px;height:<?=$theight?>px;overflow:auto;margin:5px 0 5px 0'></textarea><br />
첨부파일: <input type='file' name='attachment' style='margin-bottom:8px' />
<center><input type='submit' value='메일보내기' style="background:url('icon/b3.png') 50% 50%;width:100px;height:27px" /></center>
<input type='hidden' id='whtt' value='<?=(274-$theight)?>' />
</form>
<?
} else {
$fim = fopen($dim,"r");
while(!feof($fim)) {
$fmo = fgets($fim);
if($mbr_level==9 && $_GET['no'] == 'all' || (int)substr($fmo, 0, 5) == $_GET['no']) {
$mailto = explode("\x1b", $fmo);
if($_GET['no'] == 'all' && $mailto[3]) $mailt .= $mailto[3].";";
else break;
}
}
fclose($fim);
if($_GET['no'] == 'all') echo "<script type='text/javascript'>/*<![CDATA[*/location.href='mailto:{$mailt}';setTimeout('self.close()', 500);/*]]>*/</script>";
else echo "<script type='text/javascript'>/*<![CDATA[*/location.href='mailto:{$mailto[3]}';setTimeout('self.close()', 500);/*]]>*/</script>";
}} else scrhref(0,0,'권한이 없습니다');
/** 메일보내기 출력 끝 **/
} else if($_GET['send'] == 'memo') {
if($sett[57] != 'a' && $sett[57] <= $mbr_level) {
/** 쪽지보내기 출력 시작 **/
?>
<script type='text/javascript'>/*<![CDATA[*/document.title='쪽지보내기';function onloaded() {var hh=document.getElementsByTagName('textarea')[0];hh.style.height=parent.window.document.documentElement.clientHeight-parseInt(document.getElementById('whtt').value)-<?=(int)$ie7h?>+'px';hh.style.width=parent.window.document.documentElement.clientWidth-50-<?=(int)$ie6w?>+'px';}/*]]>*/</script>
<body class='popupbk' onresize='if(top.length == 0) onloaded()'>
<form method='post' action='<?=$exe?>'>
<input type='hidden' name='no' value='<?=$_GET['no']?>' />
<?
if(!$mbr_id) {echo "보내는이: <input type='text' name='from' value='' /><br />";
$theight = 160;
} else $theight = 180;
?>
받는사람: <input type='text' value='<?=$_GET['to']?>' readonly='readonly' />
<?
if($mbr_level == 9 && $_GET['to'] == "all") echo "[전체쪽지]";
?>
<br /><textarea name='meem' style='width:270px;height:<?=$theight?>px;overflow:auto;margin:5px 0 8px 0'><?=$_GET['text']?></textarea>
<center><input type='submit' value='쪽지보내기' style="background:url('icon/b3.png') 50% 50%;width:100px;height:27px" /></center>
<input type='hidden' id='whtt' value='<?=(274-$theight)?>' />
</form>
<?
/** 쪽지보내기 출력 끝 **/
} else scrhref(0,0,'권한이 없습니다');
} else if($_POST['meem']) {
if($sett[57] != 'a' && $sett[57] <= $mbr_level) {
/** 새쪽지 처리 시작 **/
$content = stripslashes($_POST['meem']);
$content = str_replace("<", "&lt;", $content);
$content = preg_replace("`[\r]*[\n]`", "<br />", $content)."\n";
$jmo = fopen($dmo,"a");
if($_POST['no'] == "all") {if($mbr_level == 9) {
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(trim($xxx)) {
$ptno = substr($xxx, 0, 5);
$xxx = substr($xxx, 53);
$receiver = substr($xxx,0,strpos($xxx,"\x1b"));
$str = "010".$ptno."00000".$time."\x1b".$_SESSION['m_nick']."(전체쪽지)\x1b".$receiver."\x1b".$content;
fputs($jmo, $str);
chmbr((int)$ptno,5,1);
}}
fclose($fim);
}} else if($_POST['no']) {
chmbr($_POST['no'],5,1);
$ptno = str_pad($_POST['no'],5,0,STR_PAD_LEFT);
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if($ptno == substr($xxx, 0, 5)) {
$xxx = substr($xxx,53);
$receiver = substr($xxx,0,strpos($xxx,"\x1b"));
break;
}}
fclose($fim);
if($mbr_id == '') $str = "010".$ptno."00000".$time."\x1b".$_POST['from']."(비회원)\x1b".$receiver."\x1b".$content;
else {
chmbr($mbr_no,4,1);
$str = "011".$ptno.$mbr_n5.$time."\x1b".$_SESSION['m_nick']."(회원)\x1b".$receiver."\x1b".$content;
}
fputs($jmo, $str);
}
fclose($jmo);
if(@filesize($dmo1) > 2048000) {
while($time - @filemtime($dmo."@@") < 3) {usleep(50000);$time = time();}
fclose(fopen($dmo."@@","w"));
$fmo1 = fopen($dmo1,"r");
for($i = 0;!feof($fmo1);$i++) {
$memos[$i] = fgets($fmo1);
}
fclose($fmo1);
while($time - @filemtime($dmo2."@@") < 3) {usleep(50000);$time = time();}
$jdmo = fopen($dmo2."@@","w");
for($i = count($memos) -1;$i >= 0;$i--) {
if($memos[$i]) fputs($jdmo,$memos[$i]);
}
fclose($jdmo);
copy($dmo2."@@",$dmo2);
unlink($dmo2."@@");
unlink($dmo."@@");
}
?>
<body class='popupbk' onload="setTimeout('self.opener = self;window.close();', 500)" style='cursor:pointer;margin-top:60px;'><div style='font-size:40px;text-align:center'>발송완료</div>
<?
/** 새쪽지 처리 끝 **/
} else scrhref(0,0,'권한이 없습니다');
} else if($_GET['memo']) {
if($sett[57] != 'a' && $sett[57] <= $mbr_level) {
function ememo($eno) {
global $dxr;
	if($emb = @fopen($dxr."_member_/member_".$eno,"r")) {
	$emv = explode("\x1b",fgets($emb));
	fclose($emb);
	$ema = array($emv[4],$emv[5]);
	} else $ema = array(0,0);
return $ema;
}
$mnt = ememo($mbr_no,3);
$ii = 0;
$cnt = 10;
$mem = array();
$memm = array();
$gp = ($_GET['p'])? $_GET['p']:1;
if($_GET['memo'] == 'get' || $_GET['memo'] == 'post') {
if($_GET['memo'] == 'post') $eme = array();
if($gp == 1) {
	if($_GET['memo'] == 'get') {
	while($time - @filemtime($dmo."@@") < 3) {usleep(50000);$time = time();}
	$jdmo = fopen($dmo."@@","w");
	}
$fim = fopen($dmo,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(($_GET['memo'] == 'get' && substr($xxx,1,1) == '1' && substr($xxx,3,5) == $mbr_n5) || ($_GET['memo'] == 'post' && substr($xxx,2,1) == '1' && substr($xxx,8,5) == $mbr_n5)) {
$memm[$ii] = $xxx;
$ii++;
} else if($_GET['memo'] == 'get') fputs($jdmo, $xxx);
}
fclose($fim);
if($_GET['memo'] == 'get') {
	fclose($jdmo);
	copy($dmo."@@", $dmo);
	$ia = $ii;
	if($ia > 0) {
	$jdmo1 = fopen($dmo1,"a");
	for($i = 0;$i < $ii;$i++) {fputs($jdmo1,"1".substr($memm[$i],1));}
	fclose($jdmo1);
	}
	unlink($dmo."@@");
}
for($i = $ii -1;$i >= 0;$i--) {
if($memm[$i]) $mem[] = $memm[$i];
}
} else {
$fim = fopen($dmo1,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if(($_GET['memo'] == 'get' && substr($xxx,1,1) == '1' && substr($xxx,3,5) == $mbr_n5) || ($_GET['memo'] == 'post' && substr($xxx,2,1) == '1' && substr($xxx,8,5) == $mbr_n5)) {
$memm[$ii] = $xxx;
$ii++;
}}
fclose($fim);
$stt = $ii - (($gp - 2)*$cnt);
$ett = $stt - $cnt;
for($i = $ii -1;$i >= 0;$i--) {
if($i < $stt && $i >= $ett) $mem[] = $memm[$i];
}
$me1 = count($mem);
$eet = ($ett < 0)? $ett:1;
if($stt <= $cnt && ($fim2 = @fopen($dmo2,"r"))) {
while(!feof($fim2)) {
$xxx = fgets($fim2);
if(($_GET['memo'] == 'get' && substr($xxx,1,1) == '1' && substr($xxx,3,5) == $mbr_n5) || ($_GET['memo'] == 'post' && substr($xxx,2,1) == '1' && substr($xxx,8,5) == $mbr_n5)) {
if($eet < 0) $eet++;
else if($eet == 0) break;
if($stt < 0) $stt++;
else $mem[] = $xxx;
$ii++;
}}
fclose($fim2);
}
}
?>
<table border='0px' cellspacing='0px' cellpadding='5px' width='100%'>
<tr><td style='text-align:right;border-bottom:3px solid <?=$bdc?>'><input type='button' value='받은 쪽지 (<?=$mnt[1]?>)' onclick="location.href='?memo=get'" class='button' style='width:100px' /> <input type='button' value='보낸 쪽지 (<?=$mnt[0]?>)' onclick="location.href='?memo=post'" class='button' style='width:100px' /></td></tr>
<?
if($ii > 0) {
if($gp == 1) $mee = ($_GET['memo'] == 'get')? '1':'';
$i = 0;
foreach($mem as $meme) {
$er = explode("\x1b", $meme);
if($_GET['memo'] == 'get') $who = "From : ";
else $who = "To : ";
if(substr($er[0], 0, 1) == '0') $who = "<span class='mnew'>new</span> ".$who;
if($_GET['memo'] == 'get') {
$sender = (int)substr($er[0],8,5);
if($sender) {
$wfo = urlencode(substr($er[1],0,strpos($er[1],"(")));
$who .= "<img src='icon/user_blue.gif' alt='' /> <a href='#none' onclick=\"send('memo','{$sender}','".$wfo."')\" title='답장보내기'>".$er[1]."</a>";
} else $who .= "<img src='icon/user_red.gif' alt='' /> ".$er[1];
} else $who .= "<img src='icon/user_blue.gif' alt='' /> <a href='#none' onclick=\"send('memo',".(int)substr($er[0],3,5).",'".urlencode($er[2])."')\" title='쪽지보내기'>".$er[2]."(회원)</a>";
if($gp > 1) $mee = ($i < $me1)? '1':'2';
$mmm = str_replace("<br />","\r\n",$er[3]);
if(($mmn = str_replace("</a>","",$mmm)) != $mmm) $mmm = preg_replace("`<a[^>]+>`","",$mmn);
?>
<tr style='background-color:<?=$bgc?>'><td class='tname'><div class='mname'><?=$who?></div><div class='mdate'><font class='f7'>(<?=date("Y-m-d H:i:s",substr($er[0],13))?>)</font> &nbsp;<a href='#none' onclick="dell('<?=substr($er[0],3)?>','<?=$mee?>');"><img src='icon/x.gif' alt='' border='0' /></a></div></td></tr>
<tr><td class='mmemo'><textarea cols='1' rows='1' readonly='readonly'><?=$mmm?></textarea></td></tr>
<?
$i++;
}
} else if($gp == 1) {$_GET['p'] = 1;
$message = ($_GET['memo'] == 'get')? "새로 받은 쪽지가 없습니다.":"확인 안된 보낸 쪽지가 없습니다.";
?>
<tr><td style='text-align:center;background-color:<?=$bgc?>'><?=$message?></td></tr>
<?
}
$ii = $cnt;
$ii += ($_GET['memo'] == 'get')? $mnt[1]:$mnt[0];
$mp = (int)(($ii - 1) / $cnt) + 1;
?>
<tr><td>
<?
if($message && $mp > 1) echo "<script type='text/javascript'>/*<![CDATA[*/setTimeout(\"location.href='?memo={$_GET['memo']}&p=2'\",1000);/*]]>*/</script>";
pagen('p',$mp,5,0);
?>
</td></tr></table>
<script type='text/javascript'>
//<![CDATA[
function dell(a,b) {location.href="?memo=" + a + "&from=<?=$_GET['memo']?>&p=<?=$gp?>&mee=" + b;}
function texta() {
var textar = document.getElementsByTagName('textarea');
for(var i = textar.length -1;i >= 0;i--) {if("<?=$isie?>" !== "1") textar[i].style.height = '1em';textar[i].style.height = textar[i].scrollHeight + 'px';}
}
window.onload = function() {
parent.document.title='<?=$tle?> 쪽지함';
if(document.getElementsByTagName('textarea').length > 0) texta();
}
//]]>
</script>
</body></html>
<?
} else if($_GET['memo']) {
$dom = $dxr."memo".$_GET['mee'].".dat";
if($fim = @fopen($dom,"r")) {
while($time - @filemtime($dom."@@") < 3) {usleep(50000);$time = time();}
$jdmo1 = fopen($dom."@@","w");
while(!feof($fim)) {
$xxx = fgets($fim);
if(!$okk && substr($xxx,3,20) == $_GET['memo']) {
if($_GET['from'] == 'get' && substr($xxx,3,5) == $mbr_n5) {
chmbr($mbr_no,5,-1);
$xxx = "10".substr($xxx,2);
} else if($_GET['from'] == 'post' && substr($xxx,8,5) == $mbr_n5) {
chmbr($mbr_no,4,-1);
$xxx = substr($xxx,0,2)."0".substr($xxx,3);
} else {
$okk = 2;
break;
}
if($okk != 2) {
$okk = 1;
if(substr($xxx, 1, 2) == '00') $xxx = '';
}}
fputs($jdmo1,$xxx);
}
fclose($fim);
fclose($jdmo1);
if($okk != 2) copy($dom."@@", $dom);
unlink($dom."@@");
}
scrhref('?memo='.$_GET['from'].'&p='.$_GET['p'],0,0);
}}}
?>