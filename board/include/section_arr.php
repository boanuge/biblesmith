<?
if($_GET['sect_arr']) {
$secn = 1;
$st = fopen($dxr."section.dat","r");
while($sto = fgets($st)) {
if($secn == $_GET['sect_arr']) {
$stn = explode("\x1b",$sto);
if($stn[1] != '3' && $stn[1] != '6' && $stn[1] != '7' && $stn[1] != 's') $sectt = $stn[0];
break;
}
$secn++;
}
fclose($st);
$gob = (int)$_GET['gob'];
$btbg[$gob] = " style='background:#FFE252'";
?>
<title>&lt;<?=$sectt?>&gt; 좌우메뉴 배치</title>
<style type='text/css'>
input {height:18px; font-size:9pt}
td {text-align:left}
</style>
</head>
<body onload='onloaded()' style='background-color:#F7F7F7;margin:0;padding:0'>
<form method='post' action='?' style='margin:0'><input type='hidden' name='arr' value='<?=$_GET['sect_arr']?>' /><input type='hidden' name='gob' value='<?=$gob?>' />
<?
$stb = fopen($dxr."section_arr.dat","r");
for($i = 1;$i < $_GET['sect_arr'];$i++) fgets($stb);
$secrr = explode("@@",trim(fgets($stb)));
$secar = explode("@",$secrr[$gob]);
fclose($stb);
for($i = 1;$secar[$i]; $i++) {
$key = substr($secar[$i],0,2);
$yek = substr($secar[$i],2);
if($secar[$i][0] == 'L') $sectleft .= "<input type='text' value='↑' onclick='setmv(this)' class='up' /><input type='text' name='subs[]' value='".$key.$sxvtm[$yek]."' onclick='setedit(this,2)' title='내용편집' class='subs' /><input type='text' value='→' onclick='setmove(this,3)' title='탈락' class='out' />";
else if($secar[$i][0] == 'R') $sectright .= "<input type='text' value='↑' onclick='setmv(this)' class='up' /><input type='text' name='subs[]' value='".$key.$sxvtm[$yek]."' onclick='setedit(this,2)' title='내용편집' class='subs' /><input type='text' value='→' onclick='setmove(this,4)' title='탈락' class='out' />";
}
foreach($sxvtm as $key => $value) {
if(strpos($secrr[$gob],":".$key) === false) $sectcenter .= "<div><input type='button' value='←' onclick='setmove(this,1)' /><input type='button' value='".$value."' onclick='setedit(this,0)' title='내용편집' style='width:100px' /><input type='button' value='→' onclick='setmove(this,2)' /></div>";
}
?>
<center><input type='button' class='button' value='대문' onclick='location.replace("?sect_arr=<?=$_GET['sect_arr']?>")'<?=$btbg[0]?>> &nbsp; <input type='button' class='button' value='게시판' onclick='location.replace("?sect_arr=<?=$_GET['sect_arr']?>&gob=1")'<?=$btbg[1]?>>&nbsp; &nbsp; 
 ::&nbsp; no.<?=$_GET['sect_arr']?>&nbsp; &lt;<b><?=$sectt?> / <?=($gob == 0)? "대문":"게시판"?></b>&gt; 좌우메뉴 순서와 배치 &nbsp;:: <br />좌우로 배정되지 않은 가운데 것은 출력하지 않습니다.<br />
<label><input type='checkbox' name='geb' class='no' /> &lt;<?=$sectt?>/<?=($gob == 0)? "대문":"게시판"?>&gt;의 배치를 &lt;<?=$sectt?>/<?=($gob == 1)? "대문":"게시판"?>&gt;에서도 동일하게</label>
<fieldset id='sectcenter' style="border:1px solid #0000ff;padding:20px;width:550px;margin:0">
<div id='sectleft' style='float:left'><?=$sectleft?></div>
<div id='sectcntr' style='float:left;padding-left:25px'><?=$sectcenter?></div>
<div id='sectright' style='float:right'><?=$sectright?></div>
</fieldset>
<input type='submit' value=' 적용 ' class='button' style='width:400px;height:20px;margin:15px 0 10px 0' /></center>
</form>

<script type='text/javascript'>
//<![CDATA[
function setedit(ths,num) {
var thsv = (num == 2)? ths.value.substr(2):ths.value;
var sditf = '';
var sedit = Array(<?foreach($sxvtm as $key => $value) echo "Array('{$value}','{$key}'),";?>Array('',''));
for(var i= sedit.length -2;i >= 0;i--) {
if(thsv == sedit[i][0]) sditf = sedit[i][1];
}
if(sditf) popup('<?=$admin?>?fm=module/' + sditf + '.ph_', 800, 400);

}
function setmove(ths,no) {
if(no == 3 || no == 4) {
var neww = "<div><input type='button' value='←' onclick='setmove(this,1)' /><input type='button' value='" + ths.previousSibling.value.substr(2) + "' onclick='setedit(this,0)' title='내용편집' style='width:100px' /><input type='button' value='→' onclick='setmove(this,2)' /></div>";
if(no == 3) {document.getElementById('sectleft').removeChild(ths.previousSibling.previousSibling);document.getElementById('sectleft').removeChild(ths.previousSibling);document.getElementById('sectleft').removeChild(ths);}
else {document.getElementById('sectright').removeChild(ths.previousSibling.previousSibling);document.getElementById('sectright').removeChild(ths.previousSibling);document.getElementById('sectright').removeChild(ths);}
document.getElementById('sectcntr').innerHTML = document.getElementById('sectcntr').innerHTML + neww;
} else if(no == 1) {
var neww = "<input type='text' value='↑' onclick='setmv(this)' class='up' /><input type='text' name='subs[]' value='L:" + ths.nextSibling.value + "' onclick='setedit(this,2)' title='내용편집' class='subs' /><input type='text' value='→' onclick='setmove(this,3)' title='탈락' class='out' />";
document.getElementById('sectleft').innerHTML = document.getElementById('sectleft').innerHTML + neww;
document.getElementById('sectcntr').removeChild(ths.parentNode);
} else if(no == 2) {
var neww = "<input type='text' value='↑' onclick='setmv(this)' class='up' /><input type='text' name='subs[]' value='R:" + ths.previousSibling.value + "' onclick='setedit(this,2)' title='내용편집' class='subs' /><input type='text' value='→' onclick='setmove(this,4)' title='탈락' class='out' />";
document.getElementById('sectright').innerHTML = document.getElementById('sectright').innerHTML + neww;
document.getElementById('sectcntr').removeChild(ths.parentNode);
}
}
function setmv(ths) {
if(ths.previousSibling && ths.previousSibling.previousSibling && ths.previousSibling.previousSibling.value) {
var xx=ths.nextSibling.value;
ths.nextSibling.value = ths.previousSibling.previousSibling.value;
ths.previousSibling.previousSibling.value=xx
}
}
function sectmenuchange(ths) {
var xx=ths.options[ths.selectedIndex].value;
if(xx) {
document.getElementById('sectmenudit').innerHTML = "<a href='#none' onclick='popup(\"<?=$admin?>?fm=module/" + xx + ".php\", 800, 400)'>" + xx + ".php</a> &nbsp; <a href='#none' onclick='popup(\"<?=$admin?>?fm=module/" + xx + ".css\", 800, 400)'>" + xx + ".css</a>";
}
}
function onloaded() {
var wh = parent.window.document.documentElement.clientHeight;
var sh = document.getElementById('sectcenter').scrollHeight;
if(wh + 100 < window.screen.availHeight) {
if(wh < sh + 100) {
if(navigator.appVersion.indexOf('MSIE') != -1) dialogHeight=(sh + 110) +'px';
else resizeTo(window.document.documentElement.scrollWidth + 100,(sh+200));
}}}
top.document.title = "<<?=$sectt?> / <?=($gob == 0)? "대문":"게시판"?>> 좌우메뉴 배치";
window.onresize = function(){onloaded();}
//]]>
</script>
</body>
</html>
<?
}
?>