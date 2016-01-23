<?
$mid = ""; // 게시판 아이디
$rlmt = 10; // 목록갯수
$div_wt = 700; // 전체 넓이 (단위는 px)
$img_wt = 460; // 큰 이미지 넓이 (단위는 px)
$img_ht = 240; // 큰 이미지 높이 (단위는 px)
$dsmg = '';

$ww2 = ($div_wt/2) - ($img_wt/2) - 2;
$mss = $fsbs[$mid];
$fu = fopen($dxr.$mid."/upload.dat","r");
while(!feof($fu)) {
$fuo = trim(fgets($fu));
$file = substr($fuo,6,-12);
$ext = strtolower(substr($file,-4));
if($ext == '.jpg' || $ext == '.gif' || $ext == '.png') $ff[urlencode(substr($file,0,-4))] = $file;
}
fclose($fu);
$ii = 0;
$ida = '';
$fl = fopen($dxr.$mid."/list.dat","r");
$fn = fopen($dxr.$mid."/no.dat","r");
while(!feof($fn)){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = explode("\x1b", fgets($fl));
if(substr($zzz,6,2) == 'aa') continue;
if($flo[4] == '') continue;
else $flo[4] = substr($flo[4],0,-6);
if($mss[13] === 'a' || (int)$zzz[8] > $mbr_level || $mss[13] > $mbr_level) continue;
if(substr($flo[4],0,7) != 'http://' && $ff[$flo[4]]) {
if(($zz6 = (int)substr($zzz,0,6))) {
$zzz = explode("\x1b",$zzz);
$zzz = (int)($zzz[2] + $zzz[3] + $zzz[4]);
$dsmg .= "Array('exe.php?id={$mid}&amp;file={$ff[$flo[4]]}','{$zz6}','{$flo[3]}','{$flo[1]}','{$zzz}'),";
$ii++;
}}} else {
$mwth = explode("\x1b",$mss);
list($ida,$fn,$fl) = data6($ida,array($fn,$fl),array($mid,$mwth[6]));
if($ida == 'q') break;
}
if($ii >= $rlmt) break;
}
fclose($fl);
fclose($fn);
unset($ff);
if($rlmt > $ii) $rlmt = $ii;
?>
<div id='de818' style='width:<?=$div_wt -4?>px;height:<?=$img_ht + 40?>px'></div>
<div id='de828' style='width:<?=$div_wt -14?>px'></div>
<script type='text/javascript'>
//<![CDATA[
var dml = Array(Array(100,80,<?=(($img_ht/2) -20)?>,20,1),Array(<?=$img_wt?>,<?=$img_ht?>,20,<?=$ww2?>,3),Array(100,80,<?=(($img_ht/2) -20)?>,<?=($div_wt - 128)?>,2));
var de88 = document.getElementById('de818');
var demg = document.getElementsByName('demgg');
var demp = $('de828').getElementsByTagName('input');
var n = 0;
var ett;
var opacit = 0;
var dsmg = Array(<?=substr($dsmg,0,-1)?>);
var ey = 2;
var dmlp = Array('',Array(0,0,0,<?=(($div_wt - 148) / 10)?>),Array(<?=(($img_wt - 100) / 10)?>,<?=(($img_ht - 80) / 10)?>,-<?=((($img_ht/2) -40) / 10)?>,-<?=(($div_wt - $ww2 - 128) / 10)?>),Array(-<?=(($img_wt - 100) / 10)?>,-<?=(($img_ht - 80) / 10)?>,<?=((($img_ht/2) -40) / 10)?>,-<?=(($ww2 - 20) / 10)?>));

function opasity(key,value) {
var isie = '<?=$isie?>';
if(isie == '1') key.style.filter = 'alpha(opacity=' + value + ')';
else key.style.opacity = value/100;
if(value == '100') key.style.zIndex = 2;
else key.style.zIndex = 1;
}
function pls(val,ps) {
val = val + ps;
if(val < 0) val += <?=$rlmt?>;
else if(val >= <?=$rlmt?>) val -= <?=$rlmt?>;
return val;
}
function pml(p,em) {
var pm = dml[p][4];
if(pm == 1 && em != 2) dml[p][3] += dmlp[1][3];
else if(pm == 2 && em == 2) dml[p][3] -= dmlp[1][3];
else {
if(em == 2) {
if(pm == 1) pm = 3;
else if(pm == 3) pm = 2;
dml[p][0] -= dmlp[pm][0];
dml[p][1] -= dmlp[pm][1];
dml[p][2] -= dmlp[pm][2];
dml[p][3] -= dmlp[pm][3];
} else {
dml[p][0] += dmlp[pm][0];
dml[p][1] += dmlp[pm][1];
dml[p][2] += dmlp[pm][2];
dml[p][3] += dmlp[pm][3];
}
}}
function emgrr(en,em) {
en--;
if(en > 0) {
setTimeout("emgrr(" + en + "," + em + ")",10);
for(var i=0; i < 3; i++) {
pml(i,em);
if(dml[i][4] == 1 && em != 2) {
	demg[i].style.marginLeft = dml[i][3] + 'px';
	if(ey == 2 && dml[i][3] >= <?=$ww2?>) {
	demp[n].style.background ='transparent';
	ey = 0;n = pls(n,1);demg[i].src=dsmg[pls(n,1)][0];
	} else if(dml[i][3] > <?=($div_wt - 129)?>) {
	dml[i][4] = 2;ey = 2;
	}
} else if(dml[i][4] == 2 && em == 2) {
	demg[i].style.marginLeft = dml[i][3] + 'px';
	if(ey == 2 && dml[i][3] <= <?=$ww2?>) {
	demp[n].style.background ='transparent';
	ey = 0;n = pls(n,-1);demg[i].src=dsmg[pls(n,-1)][0];
	} else if(dml[i][3] < 21) {
	dml[i][4] = 1;ey = 2;
	}
} else {
demg[i].style.width = dml[i][0] + 'px';
demg[i].style.height = dml[i][1] + 'px';
demg[i].style.marginTop = dml[i][2] + 'px';
demg[i].style.marginLeft = dml[i][3] + 'px';
if(em != 2) {
if(dml[i][4] == 3 && dml[i][0] <= 100) dml[i][4] = 1;
else if(dml[i][0] >= <?=$img_wt?> && dml[i][4] == 2) dml[i][4] = 3;
} else {
if(dml[i][4] == 3 && dml[i][0] <= 100) dml[i][4] = 2;
else if(dml[i][0] >= <?=$img_wt?> && dml[i][4] == 1) dml[i][4] = 3;
}
}
}
} else {
for(var i=0; i < 3; i++) {
if(dml[i][4] == 1) opasity(demg[i],'30');
else if(dml[i][4] == 2) opasity(demg[i],'50');
else opasity(demg[i],'100'); 
}
demp[n].style.background ='#000000';
}
}
function emgtt(w) {
if(w) {
clearInterval(ett);
ett = setInterval('emgtt()',5000);
}
emgrr(11,1);
}
function tot_1(v) {
if(dml[v][4] == 1) tot_3(n);
else if(dml[v][4] == 2) emgtt(1);
else if(dml[v][4] == 3) rhref("<?=$index?>?id=<?=$mid?>&amp;no=" + dsmg[n][1]);
}
function tot_2(v) {
if(dml[v][4] == 3) {
$("pview").style.width = '200px';
preview("<div class='prsjt'>" + dsmg[n][2] + "</div><span class='n8'>by " + dsmg[n][3] + "</span> <span class='r7'>[" + dsmg[n][4] + "]</span>","xx");
}}
function tot_3(v) {
if(v == n || v - n == <?=$rlmt?>) {
clearInterval(ett);
emgrr(11,2);
ett = setInterval('emgtt()',5000);
} else {
if(v - n != 2) {
demp[n].style.background = 'transparent';
n = pls(v,-2);
for(var i = 0;i < 3;i++) {
if(dml[i][4] == 1) demg[i].src=dsmg[pls(n,-1)][0];
else if(dml[i][4] == 3) demg[i].src=dsmg[n][0];
else if(dml[i][4] == 2) demg[i].src=dsmg[pls(n,1)][0];
}}
emgtt(1);
}}
function ve818() {
var dee = "<img name='demgg' onclick='tot_1(0)' onmouseover='tot_2(0)' onmouseout='preview()' src='" + dsmg[<?=($rlmt -1)?>][0] + "' style='width:" + dml[0][0] + "px;height:" + dml[0][1] + "px;margin-top:" + dml[0][2] + "px;margin-left:" + dml[0][3] + "px' />";
for(var i=1; i < 3; i++) {
dee += "<img name='demgg' onclick='tot_1(" + i + ")' onmouseover='tot_2(" + i + ")' onmouseout='preview()' src='" + dsmg[(i -1)][0] + "' style='width:" + dml[i][0] + "px;height:" + dml[i][1] + "px;margin-top:" + dml[i][2] + "px;margin-left:" + dml[i][3] + "px' />";
}
de88.innerHTML = dee;
dee = "<input type='button' name='dempt' onclick='tot_3(1)' value=' 1 ' style='background:#000000' />";
for(var i=2; i <= <?=$rlmt?>; i++) {
dee += "<input type='button' name='dempt' onclick='tot_3(" + i + ")' value=' " + i + " ' />";
}
$('de828').innerHTML = dee;
opasity(demg[0],'30');
opasity(demg[2],'50');
ett = setInterval('emgtt()',5000);
}
setTimeout('ve818();demg[1].style.zIndex=2',200);
//]]>
</script>
