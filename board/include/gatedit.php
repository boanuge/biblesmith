<?
if($_POST['ectn'] && isset($_POST['ectg'])) {
@unlink($dxr."_member_/_bak_/gatebk1_".$_POST['ectn'].".dat");
@unlink($dxr."_member_/_bak_/gatebk2_".$_POST['ectn'].".dat");
$ectg = str_replace("\r","",str_replace("\n","",stripslashes($_POST['ectg'])));
if($sett[77] == '1') {
$ectg = preg_replace("`>[\t ]+<`i","><",$ectg);
} else {
$srwdth = $sett[12];
if(($sett[67] || $sett[68]) && ($stb = @fopen($dxr."section_arr.dat","r"))) {
for($sb=1;$sb < $_POST['ectn'];$sb++) fgets($stb);
$stbo = explode("@@",fgets($stb));
fclose($stb);
$sett78 = ($sett[39] > $sett[78])? 0:$sett[78] - $sett[39];
if($sett[67] && strpos($stbo[0],"@L:") !== false) {$srwdth -= (int)$sett[67];$srwdth -= $sett78;}
if($sett[68] && strpos($stbo[0],"@R:") !== false) {$srwdth -= (int)$sett[68];$srwdth -= $sett78;}
}
if($ectlt = fopen("module/".$_POST['ectl'].".php","r")) {
for($e = 1;$e < 5;$e++) fgets($ectlt);
$ectltv = trim(fgets($ectlt));
fclose($ectlt);
if(substr($ectltv,1,5) == 'srpdg') {eval($ectltv);$srwdth -= $srpdg;
}}
$tr = explode("<tr",$ectg);
$ectg = $tr[0];
$wtd = substr($tr[0],0,strpos($tr[0],'</colgroup>'));
if($wtd) {
if(preg_match_all("`width='([0-9\.]+)%`i",$wtd,$colwt)) $wtd = count($colwt[0]);
else if(preg_match_all("`width='([0-9\.]+)px`i",$wtd,$colwp)) {$wtd = count($colwp[0]);$test = 0;for($i=0;$i< $wtd;$i++) {$test += $colwp[1][$i];} if($test != $srwdth) {echo "셀의 넓이 총합이 게시판넓이와 다릅니다.";exit;}}
}
$cwth = $sett[39]*($wtd +1)/$wtd;
if(!$colwt && !$colwp) {echo "&lt;colspan width='숫자%' /&gt;가 잘못되었습니다.";exit;}
$jump = array();
for($r = 1;$tr[$r];$r++) {
$td = explode("<td",$tr[$r]);
$ectg .= "<tr".$td[0];
$rd = 1;
for($d = 1;$td[$d];$d++) {
if(substr($td[$d],0,8) == " width='") {
if(($px = strpos($td[$d],"px'")) === false) {$px = strpos($td[$d],"%'");$pxx = $px +2;}
else $pxx = $px + 3;
if($px !== false && $px <  strpos($td[$d],">")) $td[$d] = substr($td[$d],$pxx)." ";
}
$colw = 0;
$cols = (preg_match("` colspan=['\"]?([0-9]+)`i",$td[$d],$cols))? $cols[1]:1;
$rows = (preg_match("` rowspan=['\"]?([0-9]+)`i",$td[$d],$rows))? $rows[1]:1;
for($w = $rows;$w > 1;$w--) {
$jump[$r + $w -1][$d - $cols + 1] = $cols;
}
for($l = $cols;$l > 0;$l--) {
$ll = $rd + $l -2 + (int)$jump[$r][$d];
if($colwp) $colw += $colwp[1][$ll];
else $colw += $colwt[1][$ll];
}
$rd += $cols;
if($colwp) $wtdh = $colw - ($cwth*$cols) + ($cols-1)*$sett[39];
else $wtdh = $colw*$srwdth/100 - ($cwth*$cols) + ($cols-1)*$sett[39];
$wtdh = round($wtdh,2);
$ectg .= "<td width='{$wtdh}px'".$td[$d];
}
}
}
$filee = $dxr."section_add.dat";
$tpfile = $dxr."section_add.dat@@";
$sta = fopen($filee, "r");
$tsta = fopen($tpfile, "w");
for($i = 1;$stao = fgets($sta);$i++) {
if($i == $_POST['ectn']) $stao = $ectg."\n";
fputs($tsta,$stao);
}
fclose($sta);
fclose($tsta);
copy($tpfile,$filee);
unlink($tpfile);
echo "<body onload=\"setTimeout('self.close()', 500)\" bgcolor='#F0F0F0'><div style='font-size:100px;text-align:center'>완료</div>";
} else {
?>
<title><?=$_GET['ectgt']?> 대문편집</title>
<style type='text/css'>
input {height:18px; font-size:9pt}
td {text-align:left}
#yrsz {width:100%; height:7px; background:url('icon/b3.png') repeat-x 0% 80%; cursor:s-resize}
</style>
</head>
<body onload='setup()' style='background-color:#F7F7F7;margin:0;padding:0;overflow:hidden'>
<form name='sectfm' method='post' action='?' style='margin:0'>
<center>
<input type='hidden' name='ectn' value='<?=$_GET['ectgt']?>' />
<input type='hidden' id='colw' value='' />
<?
if($_GET['ectgt']) {
$fst = fopen($dxr."section.dat","r");
$fsta = fopen($dxr."section_add.dat","r");
for($ii=1;$ii < $_GET['ectgt'];$ii++) {fgets($fsta);fgets($fst);}
$sectt = explode("\x1b",fgets($fst));
$sectgt = str_replace("<t","\n<t",str_replace("&","&amp;",fgets($fsta)));
$sectgt = preg_replace("`<td width='[0-9\.]+(px|%)'`","<td",$sectgt);
fclose($fst);
fclose($fsta);
if(!$sectt[6]) $sectt6 = $sett[26];
else if((int)$sectt[6] >= 1) {
$sef = fopen($dxr."section_group.dat","r");
for($ii=1;$ii < $sectt[6];$ii++) fgets($sef);
$sefg = explode("\x1b",fgets($sef));
fclose($sef);
$sectt6 = $sefg[1];
}}
?>
<input type='hidden' name='ectl' value='<?=$sectt6?>' />
<textarea id='ectg' name='ectg' style='width:98%;height:180px;overflow:auto;line-height:140%'><?=$sectgt?></textarea>
<div id='yrsz' onmousedown='starsz()' onmouseup='endyrsz()' title='크기조정'></div>
<input type='button' value=' 아래로 ' onclick='toifr()' class='button' style='width:60px' />
 &nbsp; <input type='button' value=' 위로 ' onclick='toectg()' class='button' style='width:60px' />
 &nbsp; <input type='submit' value=' 저장 ' class='button' style='width:60px' />
 &nbsp; <input type='button' value=' 닫기 ' onclick='self.close()' class='button' style='width:60px' />
 &nbsp; <input type='button' value=' 창크게 ' onclick='rexize(this)' class='button' style='width:60px' />
 &nbsp; <input type='button' value=' 셀추가 ' onclick='addsell()' class='button' style='width:60px' />
 &nbsp; <input type='button' value=' 캐시삭제 ' onclick='ifrw.location.replace("?renewcache=<?=$_GET['ectgt']?>")' class='button' style='width:60px' />
</center>
</form>
<iframe id='ifr' style='width:100%;height:220px' frameborder='0'></iframe>
<script type='text/javascript'>
//<![CDATA[
var ifrw = document.getElementById('ifr').contentWindow;
var ectgg = document.getElementById('ectg');
var y;
var ry = 0;
var ymov = 0;
function toifr() {
var ectd = ectgg.value.replace(/&/g,"&amp;").split(/<\/td>/i);
var ectt ='';
var colw = ectd[0].split("<col ");
colw = colw.length -1;
document.getElementById('colw').value = colw;
for(var i=0;i < ectd.length -1;i++) {
var reg = / colspan=['"]?([0-9]+)/i;
var neo = ectd[i].match(reg);
var cols = (neo)? neo[1]:1;
var reg = / rowspan=['"]?([0-9]+)/i;
var neo = ectd[i].match(reg);
var rows = (neo)? neo[1]:1;
var ecdt = ectd[i].indexOf('<td');
var edct = ectd[i].substr(ecdt);
var etcd = edct.indexOf('>') + 1;
ectt += ectd[i].substr(0,ecdt) + edct.substr(0,etcd) + "가로 <input type='text' name='coli' value='" + cols + "' /> &nbsp; 세로 <input type='text' name='rowi' value='" + rows + "' /><img src='icon/x.gif' alt='' title='삭제' onclick='this.parentNode.getElementsByTagName(\"input\")[0].value=\"0\";parent.toectg();' /><span onclick='resiz(1,"+i+")'>+</span> <span onclick='resiz(2,"+i+")'>-</span><br /><textarea name='cells' class='txta' style='height:20px'>" + edct.substr(etcd) + "</textarea></td>";
}
ifrw.document.body.innerHTML = "전체 가로 갯수 : <input type='text' id='colw' value='" + colw + "' /> <input type='button' onclick='parent.transcol()' value='가로갯수변경' style='border:1px solid #CCC;width:100px' /><input type='hidden' id='ocolw' value='" + colw + "' /><table cellspacing='2px' cellpadding='2px' border='1' width='100%'>" + ectt + "</table>";
}
function addsell() {
var colw = ectgg.value.split("<col ");
colw = colw.length -1;
if(colw > 2) ectgg.value = ectgg.value + "\n<tr>\n<td valign='top'></td><td colspan='" + (colw -1) + "' valign='top'></td>\n</tr>";
else if(colw == 2) ectgg.value = ectgg.value + "\n<tr>\n<td valign='top'></td><td valign='top'></td>\n</tr>";
else ectgg.value = ectgg.value + "\n<tr>\n<td valign='top'></td>\n</tr>";
toifr();
}
function transcol() {
var tval = parseInt(ifrw.document.getElementById('colw').value) - parseInt(ifrw.document.getElementById('ocolw').value);
if(tval != 0) {
var ok = 1;
var tcol = ifrw.document.getElementsByTagName('tr');
if(tval < 0) for(var i=tcol.length -1;i >= 0;i--) {if(ok == 1 && tval + parseInt(tcol[i].getElementsByTagName('input')[0].value < 1)) ok= 0;}
if(ok == 1) for(var i=tcol.length -1;i >= 0;i--) {tcol[i].getElementsByTagName('input')[0].value = tval + parseInt(tcol[i].getElementsByTagName('input')[0].value);}
toectg();
}}
function toectg() {
var ectd = ectgg.value.substr(ectgg.value.indexOf('<tr'));
ectd = ectd.replace(/ (col|row)span='[0-9]'/gi,'').replace(/<\/?tr>/gi,'').replace(/[\r\n]/g,'');
ectd = ectd.split("<td ");
var ectt = ectd[0];
var ii;
var ci;
var ri;
var cw = parseInt(ifrw.document.getElementById('colw').value);
var cellcount = 1;
var jp = ','
var jj;
var rn = 0;
var colio = ifrw.document.getElementsByName('coli').length;
for(var i=1;i <= colio;i++) {
ii = i -1;
ci = parseInt(ifrw.document.getElementsByName('coli')[ii].value);
ri = parseInt(ifrw.document.getElementsByName('rowi')[ii].value);
if(ci > cw) ci = cw;
if(ci > 0) {
if(cellcount % cw == 1 || cw == 1) {ectt += "\n\n<tr>";rn++;}
ectt += "\n<td ";
if(ifrw.document.getElementsByName('coli')[i] && ifrw.document.getElementsByName('coli')[i].value == '0' && (cellcount+ci-1)%cw > 0) ci++;
if(ci > 1) ectt += "colspan='" + ci + "' ";
if(ri > 1) {
for(var r=2;r <= ri;r++) {
for(var c=1;c <= ci;c++) {
jj = cellcount + (cw*(r -1)) + (c-1);
jp += jj + ',';
}
}
ectt += "rowspan='" + ri + "' ";
}
ectt += ectd[i].substr(0,ectd[i].indexOf('>') + 1) + ifrw.document.getElementsByName('cells')[ii].value + ectd[i].substr(ectd[i].indexOf('</td'));
cellcount += ci;
if(jp != ',') {
while(jp.indexOf(',' + cellcount + ',') != -1) {
jp = jp.replace(',' + cellcount + ',',',');
if(cellcount % cw == 1) {ectt += "\n</tr>\n<tr>";rn++;}
cellcount++;
}
}
if(cellcount % cw == 1 || cw == 1) ectt += "\n</tr>";
else if(ifrw.document.getElementsByName('coli')[i] && cw != 1 && (cellcount + parseInt(ifrw.document.getElementsByName('coli')[i].value)) > cw*rn + 1) {
while(cellcount % cw != 1) {ectt += "\n<td valign='top'></td>";cellcount++;}
ectt += "\n</tr>";
rn++;
}
}
}
if(cellcount % cw != 1 && cw != 1) {
ii = (cw + 1 - (cellcount % cw)) % cw;
if(ii > 1) ectt += "\n<td colspan='" + ii + "' valign='top'></td>";
else ectt += "\n<td valign='top'></td>";
ectt += "\n</tr>";
}
var cgp = ectgg.value.indexOf('</colgroup>');
var cg = ectgg.value.substr(0,cgp + 11);
if(cgp == -1 || parseInt(ifrw.document.getElementById('ocolw').value) != cw) {
cg = "<colgroup>";
var cow = parseInt(100/cw);
for(var i=cw;i > 0;i--) cg += "<col width='" + cow + "%' />";
cg += "</colgroup>";
}
ectgg.value = cg + ectt;
toifr();
}
function rexize(that) {
var tval;
var mw=window.screen.availWidth;
var mh=window.screen.availHeight;
if(navigator.appVersion.indexOf('MSIE') != -1) {
if(mw - parseInt(dialogWidth) > 10) {dialogWidth=mw +'px';dialogHeight=(mh-70) +'px';tval = 1;}else{dialogWidth='507px';dialogHeight='437px';dialogTop=(mh-437)/2;dialogLeft=(mw-507)/2;tval = 2;}
} else {
if(mw - window.innerWidth > 10){resizeTo(mw,mh);tval = 1;if(navigator.appVersion.indexOf('Chrome') == -1) moveTo(window.screen.width-mw,0);}else{resizeTo(515,526);tval = 2;if(navigator.appVersion.indexOf('Chrome') == -1) moveTo((mw-515)/2,(mh-526)/2);}
}
if(tval == 1) {
that.value='창작게';
var nh = (mh-120)/2;
document.getElementById('ectg').style.height = nh + 'px';
document.getElementById('ifr').style.height = nh + 'px';
} else {
that.value='창크게';
document.getElementById('ectg').style.height = '180px';
document.getElementById('ifr').style.height = '220px';
}
}
function setup() {
var doc = ifrw.document;
doc.open();
doc.write("<html>");
doc.write("<head>");
doc.write("<style type='text/css'>body,td,textarea {font-family:gulim; font-size:9pt; line-height:140%} input,.txta {width:12px; border:0; border-bottom:1px solid black; background-color:#F7F7F7} .butt {border:0; color:#FFF; background:#000; width:30px} .txta {overflow:auto;  width:100%} img {cursor:pointer; width:13px; vertical-align:middle; margin-left:5px} span {cursor:pointer; margin-left:4px}</style>");
doc.write("<script type='text/javascript'>function resiz(b,n){var txtht=parseInt(document.getElementsByName('cells')[n].style.height);document.getElementsByName('cells')[n].style.height = (b==1)?(txtht*2) + 'px':(txtht/2) + 'px';} function setup(s) {var txa = document.getElementsByName('cells');for(var i=txa.length -1;i >= 0;i--) {if(s) txa[i].style.height = txa[i].scrollHeight + 'px';else txa[i].style.width = txa[i].parentNode.width;}}<\/script>");
doc.write("</head>");
doc.write("<body bgcolor='#F7F7F7' onload='setup();setTimeout(\"setup(1)\",100)'>");
doc.write("</body>");
doc.write("</html>");
doc.close();
toifr();
top.document.title = "\"<?=$sectt[0]?>\" 대문편집";
}
function onloaded() {
var ht =parent.window.document.documentElement.clientHeight -37;
document.getElementById('ectg').style.height = parseInt(ht*0.45) + 'px';
document.getElementById('ifr').style.height = parseInt(ht*0.55) + 'px';
}
function starsz() {
ymov = 2;
ry = y - parseInt(document.getElementById('ectg').style.height);
}
function endyrsz() {
ymov = 0;
ry = 0;
}
function mousemov(e){
  if(navigator.appVersion.indexOf('MSIE') == -1){
   y = e.pageY;
	} else {
   y = event.clientY + document.documentElement.scrollTop;
	}
if(ymov == 2) {
document.getElementById('ifr').style.height = parseInt(document.getElementById('ifr').style.height) - (y - ry - parseInt(document.getElementById('ectg').style.height)) + 'px';
document.getElementById('ectg').style.height = y - ry + 'px';
}}

document.onmousemove = mousemov;
document.onclick = function() {if(ymov == 1) endyrsz();}
window.onresize = function(){onloaded();}
//]]>
</script>
</body>
</html>
<?
}
?>