<?
ob_start();
session_start();
header ("Content-Type: text/html; charset=UTF-8");
$writable_level = 0; //달력메모 쓰기 가능한 회원레벨 (0 이면 비회원도 가능)
$editable_level = 9; //달력메모 수정 가능한 회원레벨 (0 이면 비회원도 가능)

$thsmnth = date("Ym");
$mnth = ($_REQUEST['date'])? substr($_REQUEST['date'],0,6):$thsmnth;
if($_POST['ajax']) $widget = ".";
else $widget = "widget/";
$dd = array();
$mm = array();
if(isset($_POST['value'])) {
if($_COOKIE['mck'] == md5($_SESSION['mk'])) {
list($mbr_id, $mbr_no, $mbr_level) = $_SESSION[$_SESSION[$_COOKIE[md5($_COOKIE['mck']."\x1b".$_SESSION['mk'])]]];
} else $mbr_level = 0;
if($writable_level <= $mbr_level && (trim($_POST['value']) || $editable_level <= $mbr_level)) {
$time = time();
$www = 1;
while($time - @filemtime($widget."/calendar_memo.dat@@") < 3) {usleep(50000);$time = time();}
$jdu = fopen($widget."/calendar_memo.dat@@","w");
$value = preg_replace("`[\r]*[\n]`","∼",preg_replace("`[\r]*[\n]---[\r]*[\n]`","∥",stripslashes(urldecode($_POST['value']))));
if($editable_level > $mbr_level) $value = str_replace("<","&lt;",$value);
else {
if(strpos($value,">")) {
$vhtml = explode("<",$value);
$value = '';
for($i = 0;$i < count($vhtml); $i++) {
if($vhtml[$i]) {
if($vhtml[$i][0] != "/") {$vend = strpos($vhtml[$i],">");$value .= "<".strtolower(substr($vhtml[$i],0,$vend)).substr($vhtml[$i],$vend);}
else $value .= "<".strtolower($vhtml[$i]);
}}}}
$mday = (int)($_POST['date'].str_pad($_POST['day'],2,0,STR_PAD_LEFT));
if($value) $plus = $mday.$mbr_level.$value."\n";
else $plus = '';
if($fu = @fopen($widget."/calendar_memo.dat","r")) {
while(!feof($fu)){
	$fuo = fgets($fu);
	$mth = substr($fuo,0,6);
	if($mth == $mnth) $dd[(int)substr($fuo,6,2)] = substr($fuo,8);
	$mm[$mth]++;
	if(!$writed && substr($fuo,0,8) <= $mday) {
	if(substr($fuo,0,8) == $mday) {
	if($mbr_level >= $editable_level && $mbr_level >= $fuo[8]) $fuo = $plus;
	else {$fuo = trim($fuo)."∥".substr($plus,9);$plus = $fuo;}
	} else $fuo = $plus.$fuo;
	$writed = 1;
	}
	fputs($jdu,$fuo);
}
fclose($fu);
}
$dd[$_POST['day']] = substr($plus,8);
if(!$writed) fputs($jdu,$plus);
fclose($jdu);
copy($widget."/calendar_memo.dat@@",$widget."/calendar_memo.dat");
unlink($widget."/calendar_memo.dat@@");
}}
if(!$www && ($fr = @fopen($widget."/calendar_memo.dat","r"))) {
while($fro = trim(fgets($fr))){
$mth = substr($fro,0,6);
if($mth == $mnth) $dd[(int)substr($fro,6,2)] = substr($fro,8);
$mm[$mth]++;
}
fclose($fr);
}
if(!$_POST['ajax']) {
?>
<div class='tab_top'><div class='tab_head theado' style='float:left'><div class='first'><a href='#none'>메모</a></div></div><div style='float:right;padding-top:7px'><select id='calmemosel' onchange="calmm(this.options[this.selectedIndex].value);">
<?
foreach($mm as $ym => $cnt) echo "<option value='{$ym}'>".substr($ym,0,4)."/".substr($ym,4)." ({$cnt})</option>";
?>
</select></div>
<script type='text/javascript'>
//<![CDATA[
function calmm(m,n) {
if(m) {
if(m == 1) {
m = $('mnth').value + "&day=" + n + "&value=" + encodeURIComponent($('img').getElementsByTagName('textarea')[0].value);
imgview(0);
} else $('calmemosel').value = m;
azax("widget/calendar_memo.php?&date=" + m,"$('calmemodv').innerHTML=ajax");
}}
function calmv(tht,dd,level) {
if(tht == 2) {
if(wopen != 4) {
var pviewd = $('img').style.display;
preview();
wopen = 2;
$('img').style.display = pviewd;
}} else if(dd == -1) {
if(wopen != 4) {
preview(tht.innerHTML.replace(/∼/g,"<br />").replace(/∥/g,"<hr />"),"xx",180);
}} else {
$('pview').style.display = "none";
var calmon = '';
<? if($mbr_level >= $editable_level) {?>
if(<?=$mbr_level?> >= parseInt(level)) calmon = tht.getElementsByTagName('a')[0].innerHTML.replace(/∼/g,"\n").replace(/∥/g,"\n---\n");
<?}?>
px = x;py =y;
calmon = "<fieldset id='calmwrte' style='position:absolute'><div title='이동' onmousedown='calmwmove(this,1)' onmouseup='calmwmove(this,2)'>" + $('mnth').value.substr(4) + "월 "+ dd+ "일</div><textarea cols='1' rows='1' onmousedown='wopen=4;setTimeout(\"wopen=4\",50);'>" + calmon + "</textarea><br />";
calmon += "<input type='button' onclick='calmwsize(this,1)' value=' + ' /><input type='button' onclick='calmwsize(this,2)' value=' - ' /><input type='button' onclick='imgview(0)' value='close' /><input type='button' onclick='calmm(1,\""+dd+"\")' value='write' /></fieldset>";
imgview(calmon,2);
setTimeout('wopen=4',200);
if(brwsrw < x + 200) $('img').style.left = $('pview').style.left;
}}
function calmwmove(ths,w) {
if(w == 1){
ry=ths.parentNode;
px=Array(x,px);
py=Array(y,py);
ths.style.cursor='all-scroll';
} else {
px=ths.parentNode.style.left;
py=ths.parentNode.style.top;
ry='';
ths.style.cursor='move';
}}
function calmwsize(ths,w) {
if(w == 1){
ths.parentNode.getElementsByTagName('textarea')[0].style.height = ths.parentNode.offsetHeight*2 -50 + "px";
ths.parentNode.style.width=ths.parentNode.offsetWidth*2 +"px";
ths.parentNode.style.height=ths.parentNode.offsetHeight*2 +"px";
} else if(ths.parentNode.offsetHeight > 200) {
ths.parentNode.getElementsByTagName('textarea')[0].style.height = ths.parentNode.offsetHeight/2 -50 + "px";
ths.parentNode.style.width=ths.parentNode.offsetWidth/2 +"px";
ths.parentNode.style.height=ths.parentNode.offsetHeight/2 +"px";
}}
$('calmemosel').value = "<?=$mnth?>";
//]]>
</script></div>
<div id='calmemodv' class='tab_div'>
<?
}
$month = substr($mnth, 4, 2);
$year = substr($mnth, 0, 4);
$pxt = mktime(0, 0, 0, $month, 1, $year);
$med = date("t", $pxt);
$nxt = mktime(23, 59, 59, $month, $med, $year);

$fem = date("w", $pxt);
$nxm = $year.str_pad($month + 1, 2, 0, STR_PAD_LEFT);
$pxm = $year.str_pad($month - 1, 2, 0, STR_PAD_LEFT);
if($month == '12') $nxm = ($year + 1)."01";
else if($month == '01') $pxm = ($year - 1)."12";
?>

<table class='calm'>
<colgroup><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /><col width='14.3%' /></colgroup>
<tr class='navi'><td><input type='hidden' id='mnth' value='<?=$mnth?>' /></td><td><a href='#none' onclick="calmm('<?=$pxm?>')">&lt;</a></td><td colspan='3'><?=substr($mnth, 0, 4)?> : <?=(int)substr($mnth, 4, 2)?></td><td><a href='#none' onclick="calmm('<?=$nxm?>')">&gt;</a></td><td>&nbsp;</td></tr>
<tr class='day'><td><font color='#FF0000'>일</font></td><td>월</td><td>화</td><td>수</td><td>목</td><td>금</td><td>토</td></tr><tr>

<?
if($thsmnth == $mnth) $thsmnthd = date("d");
for($i = 0; $i < $fem; $i++) echo "<td>&nbsp;</td>";
for($stt = 1; $stt <= $med; $stt++) {
$sst = ($stt + $fem) % 7;
echo "<td ";
if($writable_level <= $mbr_level) echo " onclick='calmv(this,\"{$stt}\",\"{$dd[$stt][0]}\")'";
if($sst == 1) echo " style='color:#ff6633'";
if($dd[$stt]) {echo " class='isdoc'";$ddstt = substr($dd[$stt],1);}
else $ddstt = "&nbsp;";
echo "><a href='#none' onmouseover='calmv(this,-1)' onmouseout='calmv(2)'>{$ddstt}</a><br /><div";
if($thsmnthd == $stt) echo " class='thisdoc'";
echo ">{$stt}</div></td>";
if($sst == 0 && $stt != $med) echo "</tr><tr>";
}
if($sst > 0) for($i = $sst; $i < 7; $i++) echo "<td>&nbsp;</td>";
?>

</tr>
</table>
<? if(!$_POST['ajax']) echo "</div>";?>