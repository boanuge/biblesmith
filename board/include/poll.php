<?
ob_start();
session_start();
header ("Content-Type: text/html; charset=UTF-8");
if($_COOKIE['mck'] == md5($_SESSION['mk'])) $mbrmbr = $_SESSION[$_SESSION[$_COOKIE[md5($_COOKIE['mck']."\x1b".$_SESSION['mk'])]]];
$zr = opendir("../data");
while($zro = readdir($zr)) {
if($zro != '.' && $zro != '..') {$dxr = "../data/".$zro."/";break;}
}
closedir($zr);
$plla = $dxr."poll_1.dat"; //질문
$pllb = $dxr."poll_2.dat"; //답변
$pllc = $dxr."poll_3.dat"; //아이피
$plld = $dxr."poll_4.dat"; //마지막번호
$time = time();
if($mbrmbr[2] == '9' && $_POST['question']) {
if($fd = @fopen($plld,"r")) {
$pllno = fgets($fd);
fclose($fd);
} else $pllno = "0";
$fda = str_pad($pllno +1,5,0,STR_PAD_LEFT);
$fdw = @fopen($plld,"w");
fputs($fdw,$fda);
fclose($fdw);
$cnt = count($_POST['sublist']);
$str = $fda.$_POST['question'];
$strr = $fda;
for($i=0;$i < $cnt;$i++) {
if($_POST['sublist'][$i]) {
$str .= "\x1b".$_POST['sublist'][$i];
$strr .= "\x1b0";
}}
$str = stripslashes($str)."\x1b\n";
$strr = $strr."\x1b\n";
while($time - @filemtime($plla."@@") < 3) {usleep(50000);$time = time();}
$fta = fopen($plla."@@","w");
fputs($fta,$str);
if($fa = @fopen($plla,"r")) {
while(!feof($fa)) fputs($fta,fgets($fa));
fclose($fa);
}
fclose($fta);
copy($plla."@@",$plla);
unlink($plla."@@");
echo "<script type='text/javascript'>location.href='?no={$fda}';</script>";
} else if($mbrmbr[2] == '9' && $_GET['dellpoll']) {
while($time - @filemtime($plla."@@") < 3) {usleep(50000);$time = time();}
$fta = fopen($plla."@@","w");
if($fa = @fopen($plla,"r")) {
while(!feof($fa)) {$fao = fgets($fa);if(substr($fao,0,5) != $_GET['dellpoll']) fputs($fta,$fao);}
fclose($fa);
}
fclose($fta);
copy($plla."@@",$plla);
unlink($plla."@@");
while($time - @filemtime($pllb."@@") < 3) {usleep(50000);$time = time();}
$ftb = fopen($pllb."@@","w");
if($fb = @fopen($pllb,"r")) {
while(!feof($fb)) {$fbo = fgets($fb);if(substr($fbo,0,5) != $_GET['dellpoll']) fputs($ftb,$fbo);}
fclose($fb);
}
fclose($ftb);
copy($pllb."@@",$pllb);
unlink($pllb."@@");
while($time - @filemtime($pllc."@@") < 3) {usleep(50000);$time = time();}
$ftc = fopen($pllc."@@","w");
if($fc = @fopen($pllc,"r")) {
while(!feof($fc)) {$fco = fgets($fc);if(substr($fco,-6,5) != $_GET['dellpoll']) fputs($ftc,$fco);}
fclose($fc);
}
fclose($ftc);
copy($pllc."@@",$pllc);
unlink($pllc."@@");
echo "<script type='text/javascript'>location.href='?page=1';</script>";
} else if($_POST['vote']) {
$sett = explode("\x1b",fgets($st=fopen($dxr."setting.dat","r")));fclose($st);
$ydate = $time - $sett[29]*86400;
while($time - @filemtime($pllc."@@") < 3) {usleep(50000);$time = time();}
$mip = $_SERVER['REMOTE_ADDR'].$_POST['poll']."\n";
$ftc = fopen($pllc."@@","w");
fputs($ftc,$time.$mip);
$exit = 1;
if(($fc = @fopen($pllc,"r")) && filemtime($pllc) >= $ydate) {
while(!feof($fc)) {
$fco = fgets($fc);
if(substr($fco,0,10) > $ydate) {
if(substr($fco,10) != $mip) fputs($ftc,$fco);
else {$exit = 3;break;}
}}
fclose($fc);
}
fclose($ftc);
if($exit == 1) copy($pllc."@@",$pllc);
unlink($pllc."@@");
if($exit == 1) {
if($_POST['from'] == '1') echo "<script type='text/javascript'>location.href='?no={$_POST['poll']}';</script>";
else echo "popup('include/poll.php?no={$_POST['poll']}',640,480);";
} else {
if($_POST['from'] == '1') echo "<script type='text/javascript'>alert('이미 투표하셨습니다');location.href='?no={$_POST['poll']}';</script>";
else echo "alert('이미 투표하셨습니다');";
exit;
}}
if($_POST['question'] || $_POST['vote']) {
while($time - @filemtime($pllb."@@") < 3) {usleep(50000);$time = time();}
$ftb = fopen($pllb."@@","w");
if($_POST['question'] && $strr) fputs($ftb,$strr);
if($fb = @fopen($pllb,"r")) {
while(!feof($fb)) {
$fbbo = fgets($fb);
if(!$strr && $_POST['vote'] && $_POST['poll'] == substr($fbbo,0,5)) {
$strr = 1;
$fbb = explode("\x1b",$fbbo);
if(count($fbb) > $_POST['vote']) {
$fbb[$_POST['vote']]++;
$fbbo = substr($fbb[0],0,5).((int)substr($fbb[0],5) +1);
for($f=1;$fbb[$f] != "\n";$f++) $fbbo .= "\x1b".$fbb[$f];
$fbbo .= "\x1b\n";
}}
fputs($ftb,$fbbo);
}
fclose($fb);
}
fclose($ftb);
copy($pllb."@@",$pllb);
unlink($pllb."@@");
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="srboard" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<style type='text/css'>
* {font-family:Gulim; font-size:9pt}
input {vertical-align:middle}
span {font-weight:bold; margin-right:20px}
#subdiv, .submit {width:300px; padding-left:50px}
.submit input {cursor:pointer}
#subdiv input {width:275px}
#subdiv img {cursor:pointer; width:13px; vertical-align:middle; margin-left:5px}
div.box {border:1px solid #B4B4B4; border-color:#C4C4C4 #B4B4B4 #B4B4B4#C4C4C4; background:#D7D7D7; padding:0 1px 1px 0; margin-bottom:10px}
div.box div.boxx {border:1px solid #FFFFFF; border-color:#FFFFFF #EFEFEF #EFEFEF #FFFFFF; background:#FCFCFC}
div.graph {background:#2A5EB2; height:11px; margin-top:5px; color:#FFF; text-align:right; padding-top:1px; padding-right:6px; font-size:8pt}
div.box li {border-bottom:1px dashed #D7D7D7; padding:10px; margin-right:10px}
center {padding-top:5px; font-weight:bold; color:#004080}
h4 {padding-left:20px}
#pageno {padding-top:10px; height:15px; text-align:center;font-family:'Malgun Gothic',Gulim; font-size:10pt; line-height:18px}
#pageno a, #pageno a:link, #pageno a:visited {padding:3px 10px 3px 10px; color:#222; text-decoration:none}
#pageno a:hover {background-color:#EFEFEF}
#pageno b {color:#FF6633; font-size:11pt}
.srbt {background:#FEFEFE url('../icon/b1.gif'); border:0; border:1px solid; border-color:#D1D1D1 #BEBDBE #BEBDBE #D1D1D1; font-family:Gulim; font-size:9pt; padding:0px 10px 0 10px; height:20px; cursor:pointer}
</style>
<?
if($mbrmbr[2] == '9' && $_GET['make']) {
?>
<script type='text/javascript'> 
//<![CDATA[
function addsub() {
document.getElementById('subdiv').innerHTML = document.getElementById('subdiv').innerHTML + "<li><input type='text' name='sublist[]' /><img src='../icon/x.gif' alt='' title='삭제' onclick=\"document.getElementById('subdiv').removeChild(this.parentNode)\" /></li>";
}
parent.document.title = '새 설문조사 만들기';
//]]>
</script>
<title>새 설문조사 만들기</title>
</head>
<body align='center' style='background:#EFEFEF'>
<form method='post' action='?'>
<div style='width:350px;margin:50px auto'>
<div style='float:left;width:50px;text-align:center;padding-top:3px'>질문</div><div style='float:left;width:300px'><input type='text' name='question' style='width:300px' /></div><div class='fcler'></div>
<ol id='subdiv'>
<li><input type='text' name='sublist[]' /><img src='../icon/x.gif' alt='' title='삭제' onclick="document.getElementById('subdiv').removeChild(this.parentNode)" /></li>
<li><input type='text' name='sublist[]' /><img src='../icon/x.gif' alt='' title='삭제' onclick="document.getElementById('subdiv').removeChild(this.parentNode)" /></li>
<li><input type='text' name='sublist[]' /><img src='../icon/x.gif' alt='' title='삭제' onclick="document.getElementById('subdiv').removeChild(this.parentNode)" /></li>
</ol>
<div class='submit'>
<input type='submit' class='srbt' value='작성' style='float:left' />
<input type='button' class='srbt' value='선택항목추가' onclick='addsub()' style='float:right' />
<input type='button' class='srbt' value='설문목록' onclick='location.href="?page=1"' style='float:right' />
</div></div><div class='fcler'></div></div>
</form>
<?
} else {
if($fa = @fopen($plla,"r")) {
$percentage = 0;
$fb = fopen($pllb,"r");
?>
<script type='text/javascript'> 
function votepoll(mane) {
if(mane && document.getElementsByName(mane)) {
document.pvform.poll.value = mane.substr(4);
for(var i=document.getElementsByName(mane).length -1;i >= 0;i--) {
if(document.getElementsByName(mane)[i].checked == true) {
document.pvform.vote.value =document.getElementsByName(mane)[i].value;
document.pvform.submit();
}}}}
parent.document.title = '설문결과보기';
</script>
<title>설문결과보기</title>
</head>
<body>
<form name='pvform' method='post' action='?' style='margin:0'><input type='hidden' name='poll' /><input type='hidden' name='vote' /><input type='hidden' name='from' value='1' /></form>
<?
if($_GET['page']) {
$row =5;
$end = $_GET['page']*$row;
for($r = 0;($fao = fgets($fa));$r++) {
$fbo = fgets($fb);
if($r >= $end - $row && $r < $end && $fao &&  $fao != "\n") {
$faa = explode("\x1b",$fao);
$fbb = explode("\x1b",$fbo);
$plxo = substr($fbb[0],0,5);
$apoll = (int)substr($fbb[0],5);
?>
<div class='box'><div class='boxx'>
<h4><?=(int)substr($faa[0],0,5)?>. <?=substr($faa[0],5)?> (<?=$apoll?>)</h4>
<ol>
<?
for($i =1;$faa[$i +1];$i++) {
if($apoll) $percentage = sprintf("%.2f",$fbb[$i]*100/$apoll);
?>
<li><input type='radio' name='sub_<?=$plxo?>' value='<?=$i?>' /><?=$faa[$i]?> (<?=$fbb[$i]?>)<br /><div class='graph' style='width:<?=$percentage?>%'><?=$percentage?>%</div></li>
<?
}
?>
</ol>
<input type='button' class='srbt' value='투표' onclick='votepoll("sub_<?=$plxo?>")' style='margin-left:50px;margin-bottom:10px' />
<? if($mbrmbr[2] == '9'){?><input type='button' class='srbt' value='삭제' onclick='if(confirm("이 설문지를 삭제하시겠습니까")) location.href="?dellpoll=<?=$plxo?>"' style='margin-left:50px;margin-bottom:10px' /><?}?>
</div></div>
<?
	}}

if($r > $row) {
?>
<div id='pageno'>
<?
$allp = (int)(($r -1)/$row) + 1;
$stp = (int)(($_GET['page']-1)/5)*5 + 1;
$etp = $stp + 5;

if($stp > 5) echo "<a href='?page=".($stp -1)."''>-</a>";
for($s = $stp;$s < $etp;$s++) {
if($s <= $allp) {
$ii = $s;
if($_GET['page'] == $ii) $ii = "<b>{$ii}</b>";
echo "<a href='?page={$ii}'>{$ii}</a>";
}}
if($s <= $allp) echo "<a href='?page={$etp}''>-</a>";
?></div><?
}

} else if($_GET['no']) {
$pu = 0;
while($fbo = fgets($fb)) {
if(substr($fbo,0,5) == $_GET['no']) {
$faa = explode("\x1b",fgets($fa));
$fbb = explode("\x1b",$fbo);
$plxo = substr($fbb[0],0,5);
$apoll = (int)substr($fbb[0],5);
?>
<div class='box'><div class='boxx'>
<h4><?=(int)substr($faa[0],0,5)?>. <?=substr($faa[0],5)?> (<?=$apoll?>)</h4>
<ol>
<?
for($i =1;$faa[$i +1];$i++) {
if($apoll) $percentage = sprintf("%.2f",$fbb[$i]*100/$apoll);
?>
<li><input type='radio' name='sub_<?=$plxo?>' value='<?=$i?>' /><?=$faa[$i]?> (<?=$fbb[$i]?>)<br /><div class='graph' style='width:<?=$percentage?>%'><?=$percentage?>%</div></li>
<?
}
?>
</ol>
<input type='button' class='srbt' value='투표' onclick='votepoll("sub_<?=$plxo?>")' style='margin-left:50px;margin-bottom:10px' />
<? if($mbrmbr[2] == '9'){?><input type='button' class='srbt' value='삭제' onclick='if(confirm("이 설문지를 삭제하시겠습니까")) location.href="?dellpoll=<?=$plxo?>"' style='margin-left:50px;margin-bottom:10px' /><?}?>
</div></div>
<?
break;
} else fgets($fa);
$pu++;
}
if($pu > 1 || (!feof($fb) && fgets($fb) != "\n")) echo "<br /><input type='button' class='srbt' value='다른 설문조사' onclick='location.href=\"?page=1\"' />";
}
fclose($fa);
fclose($fb);
}}
?>
</body>
</html>