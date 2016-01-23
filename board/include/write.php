<?
$write = "include/write.php";
if(!$sett) {
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')) {$isie = 1;if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8') || false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9')) $ie8 = 1;if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7') || $ie8 == 1) $eid = $id;else {$eid = $uid;$bwr = 'ie6';}}
else {
$isie = 2;
if($id) $eid = $uid;
if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'AppleWebKit')) $bwr = 'chrome';
else if(false !== strpos($_SERVER['HTTP_USER_AGENT'],'Opera')) $bwr = 'opera';
}
$sett[14] = "http://".$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/include/') +1);
}
if($slss[2]) $wdth[2] = $slss[2];
if(!$isie) $isie = 2;
$http = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/')+1);
$sectcss = "module/sectcss_".$section.".css";
if(!file_exists($sectcss) || !filesize($sectcss)) $sectcss = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>&nbsp;</title>
<meta name="generator" content="srboard" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8;FF=3;OtherUA=4" />
<? if($ismobile == 2) {?>
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=2.5, minimum-scale=0.5, width=device-width" />
<?} if($sett[31]) {?><link rel="shortcut icon" type="image/x-icon" href="http://<?=$_SERVER['HTTP_HOST']?>/favicon.ico" />
<?} if(!$_GET['box']) {?>
<link rel='stylesheet' type='text/css' href='include/srboard.css' />
<? if($sett[26]){?><link rel='stylesheet' type='text/css' href='module/<?=$sett[26]?>.css' />
<?} if($sectcss){?><link rel='stylesheet' type='text/css' href='<?=$sectcss?>' />
<?} if($wdth[2]) {?><link rel='stylesheet' type='text/css' href='skin/<?=$wdth[2]?>/style.css' />
<?}}?>
<style type='text/css'>
body, textarea, #wtable, input {font-family:Gulim; outline:none}
body {margin:0}
input, select {padding:0; vertical-align:middle; font-size:9pt}
label {cursor:pointer}
<? if($bwr == 'opera') {?>#replace_a, #replace_b {border:1px solid #BFBFBF}
<?}?>
.bt {font-family:gulim; font-size:9pt; width:190px; padding:0; border:0; border:1px solid #9A9487; background-color:#DDDDDD} /*위지윅파일업로드*/
#color_set input {cursor:pointer; width:17px; height:17px; border-width:1px; border-style:solid; border-color:#EFEFEF #5D5D5D #5D5D5D #EFEFEF} /*위지윅색상팔레트*/
#color_set .mvmr {background:#FFFFFF;width:60px;height:17px;font-size:11px;font-family:tahoma}
ul.butn {float:left;padding:0; margin:auto; list-style-type:none; text-align:left}
ul.butn li {float:left; text-decoration:none; display:inline}
a.butt3 {display:block; cursor:pointer; font-family:verdana,Gulim; letter-spacing:-1px; height:18px; padding:3px 6px 1px 6px; background:url('icon/b3.png')} /*위지윅 버튼*/
a.butt3, a.butt3:link, a.butt3:visited {text-decoration:none; color:#222222; border-color:#CECECE #E9E9E9 #CECECE #E9E9E9; border-style:solid; border-width:1px; margin-bottom:1px}
a.butt3:hover, a.butt3:active {text-decoration:none; color:#222222; border-top:2px solid #FF6633; margin-bottom:0}
ul.butn li:hover ul {display:block}
.preev {position:absolute; margin-left:-1px; padding:0; list-style-type:none; display:none; border:1px solid #333333; background-color:#FBFBFB} /*위지윅 선택팝업*/
.preev li {display:inline; width:100%}
.preev li a {background-color:#FFFFFF; display:block; text-decoration:none; padding:3px 5px 5px 10px; margin:0}
.preev li a:link,.preev li a:visited, .preev li a:hover,.preev li a:active {text-decoration:none; color:#000000; background:transparent}
.preev li:hover a {background-color:#C1F471}
.preev li div, .preev li fieldset {margin:5px; text-align:center}
.emotic li {width:19px; height:19px; border-bottom:1px solid #D7D7D7; border-right:1px solid #D7D7D7; padding:3px}
.emotic li:hover {background:#FF6633}
.emotic li img {width:19px; height:19px; cursor:pointer; border:0}
.bold8 {font-weight:bold}
.butt1{cursor:pointer; height:24px; border:0; background:url('icon/b3.png'); font-size:11px; border:1px solid #CECECE; font-weight:bold; padding-left:3px; padding-right:3px} /*위지윅 버튼*/
.checkk {margin:0 8px 2px 4px} /*위지윅 체크박스*/
.inputt {margin:2px 0 2px 10px}
.n7 {font-size:7pt; font-family:verdana,Gulim; font-weight:normal}
#wtable {margin-top:10px}
#prvw,#regular {cursor:pointer}
.butt6 {border:0; border:1px solid #CDCDCD; margin-top:10px; letter-spacing:0; font-size:10pt; font-family:verdana; color:#444; width:150px;font-weight:bold; height:27px; background:url('icon/b3.png') repeat-x 0% 100%}
#previe {float:left; width:70px; height:70px; border:1px solid #CCCCCC}
#previe img {width:70px; height:70px}
#fuplist li {height:17px; padding:2px 5px 2px 5px; width:225px; margin:0}
#fuplist span {font-family:verdana; font-size:9px}
#fuplist span.lt {float:left; width:145px; overflow:hidden; white-space:nowrap}
#fuplist span.rt {float:right; width:80px; text-align:right}
#fuplist {float:left; border:1px solid #CCCCCC; height:70px; width:250px; border:1px solid #CCCCCC;overflow:auto}
#tagdiv {background-color:#FFF8C9; margin-top:5px}
</style>
<!--[if IE]>
<style type='text/css'>
#content {word-break:break-all;text-overflow:ellipsis}
a.butt3 {padding:4px 6px 0 6px}
</style>
<![endif]-->
<!--[if lte IE 6]>
<link rel='stylesheet' type='text/css' href='include/ie6.css' />
<![endif]-->
<?
if($sett[24]) echo "<link rel='stylesheet' type='text/css' href='{$sett[24]}' />\n";
if(file_exists('icon/style.css')) echo "<link rel='stylesheet' type='text/css' href='icon/style.css' />\n";
if($_GET['box']) {
?>
<script type='text/javascript'>
//<![CDATA[
<?
if($isie == 1) echo "var opener = dialogArguments;";
?>
var gbox = '<?=$_GET['box']?>';
var gaox = '<?=$_GET['aox']?>';
var pxlor = '';
function $(id) {return document.getElementById(id);}

function callColorDlg() {
var sColor = dlghelper.ChooseColorDlg().toString(16);
if(sColor.length < 6) sColor = "000000".substring(0,6-sColor.length).concat(sColor);
xxcolor(sColor);
}

function mktb() {
var mkcols = $('tb_col').value;
var mkrows = $('tb_row').value;
var divv = '';
if($('bak_color').value) divv += "background-color:" + $('bak_color').value + ";";
if($('fnt_color').value) divv += "color:" + $('fnt_color').value + ";";
if($('box_width').value) divv += "width:" + $('box_width').value + ";";
if($('box_height').value) divv += "height:" + $('box_height').value + ";";
if(divv) divv = ' style="' + divv + '"';
var mkcg = "<colgroup>";
var mkcwidth = parseInt(100/mkcols) + '%';
for(var i=0; i < mkcols; i++) {mkcg += "<col width=" + mkcwidth + " />";}
mkcg += "</colgroup>";
var mktr = "<tr>";
for(var i=0; i < mkcols; i++) {mktr += "<td>&nbsp;</td>";}
mktr += "</tr>";
var mktable = "<table cellspacing='0' cellpadding='2px' border='1'" + divv + "><tbody>" + mkcg;
for(var i=0; i < mkrows; i++) {mktable += mktr;}
mktable += "</tbody></table>";
opener.tag(mktable, '', 'plus', '', '');
window.close();
}

function xcolor() {
if(gbox == 'table') {
mktb();
} else if(gaox == 'url') {
var http = $('http').value;
if(http != '' && http != 'http://') {
if(gbox == 'a') {
var pmtxt = opener.mtxt();
if(pmtxt && pmtxt != '') opener.tag("<a href='" + http + "'>","<\/a>","plus","",5);
else {alert('선택된 영역이 없습니다.');return false;}
} else opener.tag("<img src='" + http + "' />","","plus","",7);
}
} else {
if($('bod_color') && $('bod_color').value) var brcolr = $('bod_color').value;
else var brcolr = '#000000';
if(gbox == 'img') {
gaox = opener.$('imgbordr');
if($('bod_width').value) gaox.value = $('bod_width').value + " " + $('bod_style').value + " " + brcolr;
else {gaox.value = '';gaox.checked = false;}
} else {
if($('legend') && $('legend').value) var blgnd = $('legend').value.replace(/["']/g,'´');
else var blgnd = '';
if(gaox == 'moreless') var divv = '<a onclick=\'togle(this.nextSibling)\' class="more" style="border-color:'+ brcolr +';">' + blgnd + '<\/a><div ondblclick=\'this.style.display="none"\' class="less" style="display:none;';
else var divv = '<' + gbox + ' style="';
if($('bak_color') && $('bak_color').value) divv += "background-color:" + $('bak_color').value + ";";
if($('fnt_color') && $('fnt_color').value) divv += "color:" + $('fnt_color').value + ";";
if(gbox == 'a') {
opener.tag(divv + '" onmouseover=\'imgview(this.href,4,' + parseInt($('box_width').value) + ')\' href="' + blgnd + '" title="링크미리보기" target=\'_blank\'>', '</' + gbox + '>','plus','','');
} else {
if($('bod_width') && $('bod_width').value) {
if(gbox == 'span')  divv += "border-bottom:" + $('bod_width').value + " " + $('bod_style').value + " " + brcolr + ";";
else divv += "border:" + $('bod_width').value + " " + $('bod_style').value + " " + brcolr + ";";
}
if($('fnt_family') && $('fnt_family').value) divv += "font-family:" + $('fnt_family').value + ";";
if($('fnt_size') && $('fnt_size').value) divv += "font-size:" + $('fnt_size').value + ";";
if(gbox == 'fontstyle') opener.tag(divv.replace('<fontstyle','<span') + '">', '</span>','plus','','');
else if(gbox == 'span') opener.tag(divv + '" onmouseover=\'preview("' + blgnd + '","xx")\' onmouseout=\'preview()\'>', '</' + gbox + '>','plus','','');
else {
if($('box_width').value) divv += "width:" + $('box_width').value + ";";
if($('box_height').value) divv += "height:" + $('box_height').value + ";";
if(gaox == 'scroll') divv += ";overflow:auto;";
if($('bod_padding').value) divv += "padding:" + $('bod_padding').value + ";";
if($('bod_lht').value) divv += "line-height:" + $('bod_lht').value + ";";
if(gbox == 'fieldset') opener.tag(divv + '"><legend>' + blgnd + '</legend>', '</' + gbox + '>','plus','','');
else opener.tag(divv + '">', '</' + gbox + '>','plus','','');
}}}}
setTimeout("window.close()",10);
return false;
}

function xxcolor(xolor) {
if(gbox == 'color') {
opener.tag('{span style="color:' + xolor + '"}','{/span}','plus','',5);
window.close();
} else if(gbox == 'bgcolor') {
opener.tag('{span style="background-color:' + xolor + '"}','{/span}','plus','',5);
window.close();
} else if(pxlor != '') {
pxlor.value = xolor;
} else alert('색상이 들어갈 곳을 클릭하세요');
}

function setup() {
if(gaox == 'url') {$('http').focus();$('http').select();
} else {
	var hcolor = new Array('ff0000','dc143c','b22222','800000','8b0000','a52a2a','a0522d','8b4513','cd5c5c','bc8f8f','f08080','fa8072','e9967a','ff7f50','ff6347','f4a460','ffa07a','cd853f','d2691e','ff4500','ffa500','ff8c00','d2b48c','ffdab9','ffe4c4','ffe4b5','ffdead','f5deb3','deb887','b8860b','daa520','ffd700','ffff00','fafad2','eee8aa','f0e68c','bdb76b','7cfc00','adff2f','7fff00','00ff00','32cd32','9acd32','808000','6b8e23','556b2f','228b22','006400','008000','2e8b57','3cb371','8fbc8f','90ee90','98fb98','00ff7f','00fa9a','008080','008b8b','20b2aa','66cdaa','5f9ea0','4682b4','7fffd4','b0e0e6','afeeee','add8e6','b0c4de','87ceeb','87cefa','48d1cc','40e0d0','00ced1','00ffff','00ffff','00bfff','1e90ff','6495ed','4169e1','0000ff','0000cd','000080','00008b','191970','483d8b','6a5acd','7b68ee','9370db','9932cc','9400d3','8a2be2','ba55d3','dda0dd','e6e6fa','d8bfd8','da70d6','ee82ee','4b0082','8b008b','800080','c71585','ff1493','ff00ff','ff00ff','ff69b4','db7093','ffb6c1','ffc0cb','ffe4e1','ffebcd','ffffe0','fff8dc','faebd7','ffefd5','fffacd','f5f5dc','faf0e6','fdf5e6','e0ffff','f0f8ff','f5f5f5','fff0f5','fffaf0','f5fffa','f8f8ff','f0fff0','fff5ee','fffff0','f0ffff','fffafa','ffffff','dcdcdc','d3d3d3','c0c0c0','a9a9a9','778899','708090','808080','696969','2f4f4f','000000');
	var tb = '';
	for(i = 0; i < 140; i++){
	tb += '<input type="button" style="background:#'+hcolor[i]+'" onclick="xxcolor(\'#'+hcolor[i]+'\')" onmouseover="bgxolor(\'#'+hcolor[i]+'\')" />';
	}
	if('<?=$isie?>' == '1') tb += '<input type="button" class="mvmr" onclick="callColorDlg()" value="more" />';
	$('color_set').innerHTML = tb;
	if($('bod_color')) $('bod_color').focus();
	else if($('bak_color')) $('bak_color').focus();
}}

var dtitle = '<?=$_GET['box']?> / <?=$_GET['aox']?>';
if('<?=$_GET['cox']?>' != '') dtitle = '<?=$_GET['cox']?>';
document.title = dtitle;
if(parent) parent.document.title = dtitle;

function bgxolor(xolor) {
if('<?=$bwr?>' != 'opera') {
if(!pxlor || eval(pxlor).value == '') {
var bxo = (opener.$('wzor').value == 'w')?opener.obw.document.body:opener.obj;
if(gbox == 'bgcolor' || (eval(pxlor) && eval(pxlor) == $('bak_color'))) bxo.style.backgroundColor = xolor;
else bxo.style.color = xolor;
}}}

function ppxlor(ths,n) {
pxlor=ths;
if($('bod_color')) $('bod_color').style.backgroundColor='#FFF';
if($('bak_color')) $('bak_color').style.backgroundColor='#FFF';
if($('fnt_color')) $('fnt_color').style.backgroundColor='#FFF';
ths.style.backgroundColor='#F0FFF0';
if(ths.value) ths.value = '';
}

function unload() {
opener.obw.document.body.style.backgroundColor = '#FFF';
opener.obw.document.body.style.color = '#000';
opener.obj.style.backgroundColor = '#FFFDFA';
opener.obj.style.color = '#000';
}
//]]>
</script>
<style type='text/css'> .butt1{cursor:pointer; height:25px; border:0; background:url('../icon/b3.png'); font-size:11px; border:1px solid #CECECE; font-weight:bold}</style>
</head>
<body class="bbody" onload="setup()" onunload="unload()" style="font-size:9pt;line-height:25px;overflow:hidden;background-color:#D7D7D7">
<center style='padding-bottom:10px'>
<?
if($_GET['aox'] == 'url') {
?>
<form method='get' action='?' onsubmit='return xcolor();' style='margin:20px 0 0 0'>
주소 : <input type='text' id='http' style='width:300px;height:20px' value='http://' onclick="if(this.value=='http://') this.value=''" /><input type='submit' class='butt1' value='입력' /></form>
<?} else {
if($_GET['box'] != 'color' && $_GET['box'] != 'bgcolor') {
?>
<div style='width:260px;text-align:left;padding:15px 0 10px 0'>
<? if($_GET['box'] != 'fontstyle') {
if($_GET['box'] == 'a') {?>
링크주소 : <input type='text' id='legend' style='width:192px' value='' /> <br />
<?} else if($_GET['box'] == 'span') {?>
풍선말 : <input type='text' id='legend' style='width:204px' value='' /><br />
<?} if($_GET['box'] != 'table' && $_GET['box'] !='a') {?>
<fieldset style='text-align:center;padding:5px'><legend>Border : </legend><select id='bod_width'><option value=''>0</option><option value='1px' selected='selected'>1px</option><option value='2px'>2px</option><option value='3px'>3px</option><option value='4px'>4px</option><option value='5px'>5px</option><option value='6px'>6px</option><option value='7px'>7px</option><option value='8px'>8px</option><option value='9px'>9px</option><option value='10px'>10px</option><option value='11px'>11px</option><option value='12px'>12px</option><option value='13px'>13px</option><option value='14px'>14px</option><option value='15px'>15px</option><option value='16px'>16px</option><option value='17px'>17px</option><option value='18px'>18px</option><option value='19px'>19px</option><option value='20px'>20px</option></select>
 &nbsp;<select id='bod_style'><option value='solid'>형태</option><option value='solid'>solid</option><option value='dashed'>dashed</option><option value='dotted'>dotted</option><option value='double'>double</option><option value='inset'>inset</option><option value='outset'>outset</option></select>
 &nbsp;<input type='text' id='bod_color' style='width:72px' onfocus='ppxlor(this)' /></fieldset>
<? if($_GET['box'] != 'img' && $_GET['box'] != 'span' && $_GET['box'] !='a') {?>
padding : <input type='text' id='bod_padding' style='width:70px' value='10px' />&nbsp;
줄간격 : <input type='text' id='bod_lht' style='width:67px' onclick='if(!this.value) this.value="150%"' value='' /><br />
<?}
} else if($_GET['box'] == 'table') {
?>
가로 : <select id='tb_col'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option></select>&nbsp; 
세로 : <select id='tb_row'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option><option value='18'>18</option><option value='19'>19</option><option value='20'>20</option></select><br />
<?}} if($_GET['box'] != 'img') {if($_GET['box'] == 'fieldset') {?>
제목 : <input type='text' id='legend' style='width:217px' /><br />
<?} else {
if($_GET['aox'] == 'moreless') {?>
제목 : <input type='text' id='legend' style='width:217px' value='보기/닫기' /><br />
<?}?>
배경색 : <input type='text' id='bak_color' style='width:73px' onfocus='ppxlor(this)' value='' />&nbsp;
<?}?>
글자색 : <input type='text' id='fnt_color' style='width:73px' onfocus='ppxlor(this)' value='' /><br />
<?if($_GET['box'] != 'table' && $_GET['box'] !='a') {?>
글꼴 : <select id='fnt_family'><option value=''>---</option><option value='Gulim'>굴림</option><option value='Dotum'>돋움</option><option value='Batang'>바탕</option><option value='Gungsuh'>궁서</option><option value='Malgun Gothic'>맑은고딕</option><option value='Arial'>Arial</option><option value='Tahoma'>Tahoma</option><option value='Verdana'>Verdana</option><option value='Trebuchet MS'>Trebuchet MS</option><option value='sans-serif'>sans-serif</option></select>
&nbsp;글자크기 : <select id='fnt_size'><option value=''>---</option><option value='7pt'>7pt</option><option value='8pt'>8pt</option><option value='9pt'>9pt</option><option value='10pt'>10pt</option><option value='11pt'>11pt</option><option value='12pt'>12pt</option><option value='14pt'>14pt</option><option value='18pt'>18pt</option><option value='24pt'>24pt</option><option value='36pt'>36pt</option></select>
<?} if($_GET['box'] != 'span' && $_GET['box'] != 'fontstyle') {?>
넓이 : <input type='text' id='box_width' style='width:85px' onclick='if(!this.value) this.value="100%"' value='<? if($_GET['box']=='span') echo "500px";?>' />&nbsp;
높이 : <input type='text' id='box_height' style='width:85px' onclick='if(!this.value) this.value="100px"' value='<? if($_GET['aox']=='scroll') echo "180px";?>' /><br />
<?}}?></div>
<input type='button' onclick='xcolor()' class='butt1' style='width:200px' value='적용' />
<?}?>
<div id="color_set" style="width:100%"></div>
<?if($isie == 1) {?>
<object id="dlghelper" classid="clsid:3050f819-98b5-11cf-bb82-00aa00bdce0b" width="0px" height="0px"></object>
<?}}?>
</center>
</body>
</html>
<?
exit;
} else if($_GET['spc']) {
?>
<style type='text/css'>
body {background:#EAEAEA}
table {display:none; width:419px}
td {font-family:Gulim; font-size:11px; border:1px solid #EAEAEA; text-align:center; cursor:pointer; height:18px; width:18px; background:#FFF}
td:hover {border-color:#FF6633; background:#FFFF00}
div {font-size:9pt; padding:5px 0 5px 20px}
span {cursor:pointer}
</style>
</head>
<body>
<div><span onclick='charT(0)' style='font-weight:bold'>일반기호</span> | <span onclick='charT(1)'>숫자,단위</span> | <span onclick='charT(2)'>원,괄호</span> | <span onclick='charT(3)'>한글</span> | <span onclick='charT(4)'>그리스,라틴어</span> | <span onclick='charT(5)'>일본어</span></div>
<table style='display:block' cellSpacing='1px' cellPadding='0px'><tbody><tr><td>｛</td><td>｝</td><td>〔</td><td>〕</td><td>〈</td><td>〉</td><td>《</td><td>》</td><td>「</td><td>」</td><td>『</td><td>』</td><td>【</td><td>】</td><td>‘</td><td>’</td><td>“</td><td>”</td><td>、</td><td>。</td></tr>
<tr><td>·</td><td>‥</td><td>…</td><td>§</td><td>※</td><td>☆</td><td>★</td><td>○</td><td>●</td><td>◎</td><td>◇</td><td>◆</td><td>□</td><td>■</td><td>△</td><td>▲</td><td>▽</td><td>▼</td><td>◁</td><td>◀</td></tr>
<tr><td>▷</td><td>▶</td><td>♤</td><td>♠</td><td>♡</td><td>♥</td><td>♧</td><td>♣</td><td>⊙</td><td>◈</td><td>▣</td><td>◐</td><td>◑</td><td>▒</td><td>▤</td><td>▥</td><td>▨</td><td>▧</td><td>▦</td><td>▩</td></tr>
<tr><td>±</td><td>×</td><td>÷</td><td>≠</td><td>≤</td><td>≥</td><td>∞</td><td>∴</td><td>°</td><td>′</td><td>″</td><td>∠</td><td>⊥</td><td>⌒</td><td>∂</td><td>≡</td><td>≒</td><td>≪</td><td>≫</td><td>√</td></tr>
<tr><td>∽</td><td>∝</td><td>∵</td><td>∫</td><td>∬</td><td>∈</td><td>∋</td><td>⊆</td><td>⊇</td><td>⊂</td><td>⊃</td><td>∪</td><td>∩</td><td>∧</td><td>∨</td><td>￢</td><td>⇒</td><td>⇔</td><td>∀</td><td>∃</td></tr>
<tr><td>´</td><td>～</td><td>ˇ</td><td>˘</td><td>˝</td><td>˚</td><td>˙</td><td>¸</td><td>˛</td><td>¡</td><td>¿</td><td>ː</td><td>∮</td><td>∑</td><td>∏</td><td>♭</td><td>♩</td><td>♪</td><td>♬</td><td>㉿</td></tr>
<tr><td>→</td><td>←</td><td>↑</td><td>↓</td><td>↔</td><td>↕</td><td>↗</td><td>↙</td><td>↖</td><td>↘</td><td>㈜</td><td>№</td><td>㏇</td><td>™</td><td>㏂</td><td>㏘</td><td>℡</td><td>♨</td><td>☏</td><td>☎</td></tr>
<tr><td>☜</td><td>☞</td><td>¶</td><td>†</td><td>‡</td><td>®</td><td>ª</td><td>º</td><td>♂</td><td>♀</td><td>&nbsp;</td></tr>
</tbody></table><table cellSpacing='1px' cellPadding='0px'><tbody><tr><td>½</td><td>⅓</td><td>⅔</td><td>¼</td><td>¾</td><td>⅛</td><td>⅜</td><td>⅝</td><td>⅞</td><td>¹</td><td>²</td><td>³</td><td>⁴</td><td>ⁿ</td><td>₁</td><td>₂</td><td>₃</td><td>₄</td><td>Ⅰ</td><td>Ⅱ</td></tr>
<tr><td>Ⅲ</td><td>Ⅳ</td><td>Ⅴ</td><td>Ⅵ</td><td>Ⅶ</td><td>Ⅷ</td><td>Ⅸ</td><td>Ⅹ</td><td>ⅰ</td><td>ⅱ</td><td>ⅲ</td><td>ⅳ</td><td>ⅴ</td><td>ⅵ</td><td>ⅶ</td><td>ⅷ</td><td>ⅸ</td><td>ⅹ</td><td>￦</td><td>$</td></tr>
<tr><td>￥</td><td>￡</td><td>€</td><td>℃</td><td>Å</td><td>℉</td><td>￠</td><td>¤</td><td>‰</td><td>㎕</td><td>㎖</td><td>㎗</td><td>ℓ</td><td>㎘</td><td>㏄</td><td>㎣</td><td>㎤</td><td>㎥</td><td>㎦</td><td>㎙</td></tr>
<tr><td>㎚</td><td>㎛</td><td>㎜</td><td>㎝</td><td>㎞</td><td>㎟</td><td>㎠</td><td>㎡</td><td>㎢</td><td>㏊</td><td>㎍</td><td>㎎</td><td>㎏</td><td>㏏</td><td>㎈</td><td>㎉</td><td>㏈</td><td>㎧</td><td>㎨</td><td>㎰</td></tr>
<tr><td>㎱</td><td>㎲</td><td>㎳</td><td>㎴</td><td>㎵</td><td>㎶</td><td>㎷</td><td>㎸</td><td>㎹</td><td>㎀</td><td>㎁</td><td>㎂</td><td>㎃</td><td>㎄</td><td>㎺</td><td>㎻</td><td>㎼</td><td>㎽</td><td>㎾</td><td>㎿</td></tr>
<tr><td>㎐</td><td>㎑</td><td>㎒</td><td>㎓</td><td>㎔</td><td>Ω</td><td>㏀</td><td>㏁</td><td>㎊</td><td>㎋</td><td>㎌</td><td>㏖</td><td>㏅</td><td>㎭</td><td>㎮</td><td>㎯</td><td>㏛</td><td>㎩</td><td>㎪</td><td>㎫</td></tr>
<tr><td>㎬</td><td>㏝</td><td>㏐</td><td>㏓</td><td>㏃</td><td>㏉</td><td>㏜</td><td>㏆</td><td>&nbsp;</td></tr>
</tbody></table><table cellSpacing='1px' cellPadding='0px'><tbody><tr><td>㉠</td><td>㉡</td><td>㉢</td><td>㉣</td><td>㉤</td><td>㉥</td><td>㉦</td><td>㉧</td><td>㉨</td><td>㉩</td><td>㉪</td><td>㉫</td><td>㉬</td><td>㉭</td><td>㉮</td><td>㉯</td><td>㉰</td><td>㉱</td><td>㉲</td><td>㉳</td></tr>
<tr><td>㉴</td><td>㉵</td><td>㉶</td><td>㉷</td><td>㉸</td><td>㉹</td><td>㉺</td><td>㉻</td><td>ⓐ</td><td>ⓑ</td><td>ⓒ</td><td>ⓓ</td><td>ⓔ</td><td>ⓕ</td><td>ⓖ</td><td>ⓗ</td><td>ⓘ</td><td>ⓙ</td><td>ⓚ</td><td>ⓛ</td></tr>
<tr><td>ⓜ</td><td>ⓝ</td><td>ⓞ</td><td>ⓟ</td><td>ⓠ</td><td>ⓡ</td><td>ⓢ</td><td>ⓣ</td><td>ⓤ</td><td>ⓥ</td><td>ⓦ</td><td>ⓧ</td><td>ⓨ</td><td>ⓩ</td><td>①</td><td>②</td><td>③</td><td>④</td><td>⑤</td><td>⑥</td></tr>
<tr><td>⑦</td><td>⑧</td><td>⑨</td><td>⑩</td><td>⑪</td><td>⑫</td><td>⑬</td><td>⑭</td><td>⑮</td><td>㈀</td><td>㈁</td><td>㈂</td><td>㈃</td><td>㈄</td><td>㈅</td><td>㈆</td><td>㈇</td><td>㈈</td><td>㈉</td><td>㈊</td></tr>
<tr><td>㈋</td><td>㈌</td><td>㈍</td><td>㈎</td><td>㈏</td><td>㈐</td><td>㈑</td><td>㈒</td><td>㈓</td><td>㈔</td><td>㈕</td><td>㈖</td><td>㈗</td><td>㈘</td><td>㈙</td><td>㈚</td><td>㈛</td><td>⒜</td><td>⒝</td><td>⒞</td></tr>
<tr><td>⒟</td><td>⒠</td><td>⒡</td><td>⒢</td><td>⒣</td><td>⒤</td><td>⒥</td><td>⒦</td><td>⒧</td><td>⒨</td><td>⒩</td><td>⒪</td><td>⒫</td><td>⒬</td><td>⒭</td><td>⒮</td><td>⒯</td><td>⒰</td><td>⒱</td><td>⒲</td></tr>
<tr><td>⒳</td><td>⒴</td><td>⒵</td><td>⑴</td><td>⑵</td><td>⑶</td><td>⑷</td><td>⑸</td><td>⑹</td><td>⑺</td><td>⑻</td><td>⑼</td><td>⑽</td><td>⑾</td><td>⑿</td><td>⒀</td><td>⒁</td><td>⒂</td><td>&nbsp;</td></tr>
</tbody></table><table cellSpacing='1px' cellPadding='0px'><tbody><tr><td>ㄱ</td><td>ㄲ</td><td>ㄳ</td><td>ㄴ</td><td>ㄵ</td><td>ㄶ</td><td>ㄷ</td><td>ㄸ</td><td>ㄹ</td><td>ㄺ</td><td>ㄻ</td><td>ㄼ</td><td>ㄽ</td><td>ㄾ</td><td>ㄿ</td><td>ㅀ</td><td>ㅁ</td><td>ㅂ</td><td>ㅃ</td><td>ㅄ</td></tr>
<tr><td>ㅅ</td><td>ㅆ</td><td>ㅇ</td><td>ㅈ</td><td>ㅉ</td><td>ㅊ</td><td>ㅋ</td><td>ㅌ</td><td>ㅍ</td><td>ㅎ</td><td>ㅏ</td><td>ㅐ</td><td>ㅑ</td><td>ㅒ</td><td>ㅓ</td><td>ㅔ</td><td>ㅕ</td><td>ㅖ</td><td>ㅗ</td><td>ㅘ</td></tr>
<tr><td>ㅙ</td><td>ㅚ</td><td>ㅛ</td><td>ㅜ</td><td>ㅝ</td><td>ㅞ</td><td>ㅟ</td><td>ㅠ</td><td>ㅡ</td><td>ㅢ</td><td>ㅣ</td><td>ㅥ</td><td>ㅦ</td><td>ㅧ</td><td>ㅨ</td><td>ㅩ</td><td>ㅪ</td><td>ㅫ</td><td>ㅬ</td><td>ㅭ</td></tr>
<tr><td>ㅮ</td><td>ㅯ</td><td>ㅰ</td><td>ㅱ</td><td>ㅲ</td><td>ㅳ</td><td>ㅴ</td><td>ㅵ</td><td>ㅶ</td><td>ㅷ</td><td>ㅸ</td><td>ㅹ</td><td>ㅺ</td><td>ㅻ</td><td>ㅼ</td><td>ㅽ</td><td>ㅾ</td><td>ㅿ</td><td>ㆀ</td><td>ㆁ</td></tr>
<tr><td>ㆂ</td><td>ㆃ</td><td>ㆄ</td><td>ㆅ</td><td>ㆆ</td><td>ㆇ</td><td>ㆈ</td><td>ㆉ</td><td>ㆊ</td><td>ㆋ</td><td>ㆌ</td><td>ㆍ</td><td>ㆎ</td><td>&nbsp;</td></tr>
</tbody></table><table cellSpacing='1px' cellPadding='0px'><tbody><tr><td>Α</td><td>Β</td><td>Γ</td><td>Δ</td><td>Ε</td><td>Ζ</td><td>Η</td><td>Θ</td><td>Ι</td><td>Κ</td><td>Λ</td><td>Μ</td><td>Ν</td><td>Ξ</td><td>Ο</td><td>Π</td><td>Ρ</td><td>Σ</td><td>Τ</td><td>Υ</td></tr>
<tr><td>Φ</td><td>Χ</td><td>Ψ</td><td>Ω</td><td>α</td><td>β</td><td>γ</td><td>δ</td><td>ε</td><td>ζ</td><td>η</td><td>θ</td><td>ι</td><td>κ</td><td>λ</td><td>μ</td><td>ν</td><td>ξ</td><td>ο</td><td>π</td></tr>
<tr><td>ρ</td><td>σ</td><td>τ</td><td>υ</td><td>φ</td><td>χ</td><td>ψ</td><td>ω</td><td>Æ</td><td>Ð</td><td>Ħ</td><td>Ĳ</td><td>Ŀ</td><td>Ł</td><td>Ø</td><td>Œ</td><td>Þ</td><td>Ŧ</td><td>Ŋ</td><td>æ</td></tr>
<tr><td>đ</td><td>ð</td><td>ħ</td><td>I</td><td>ĳ</td><td>ĸ</td><td>ŀ</td><td>ł</td><td>ł</td><td>œ</td><td>ß</td><td>þ</td><td>ŧ</td><td>ŋ</td><td>ŉ</td><td>Б</td><td>Г</td><td>Д</td><td>Ё</td><td>Ж</td></tr>
<tr><td>З</td><td>И</td><td>Й</td><td>Л</td><td>П</td><td>Ц</td><td>Ч</td><td>Ш</td><td>Щ</td><td>Ъ</td><td>Ы</td><td>Ь</td><td>Э</td><td>Ю</td><td>Я</td><td>б</td><td>в</td><td>г</td><td>д</td><td>ё</td></tr>
<tr><td>ж</td><td>з</td><td>и</td><td>й</td><td>л</td><td>п</td><td>ф</td><td>ц</td><td>ч</td><td>ш</td><td>щ</td><td>ъ</td><td>ы</td><td>ь</td><td>э</td><td>ю</td><td>я</td><td>&nbsp;</td></tr>
</tbody></table><table cellSpacing='1px' cellPadding='0px'><tbody><tr><td>ぁ</td><td>あ</td><td>ぃ</td><td>い</td><td>ぅ</td><td>う</td><td>ぇ</td><td>え</td><td>ぉ</td><td>お</td><td>か</td><td>が</td><td>き</td><td>ぎ</td><td>く</td><td>ぐ</td><td>け</td><td>げ</td><td>こ</td><td>ご</td></tr>
<tr><td>さ</td><td>ざ</td><td>し</td><td>じ</td><td>す</td><td>ず</td><td>せ</td><td>ぜ</td><td>そ</td><td>ぞ</td><td>た</td><td>だ</td><td>ち</td><td>ぢ</td><td>っ</td><td>つ</td><td>づ</td><td>て</td><td>で</td><td>と</td></tr>
<tr><td>ど</td><td>な</td><td>に</td><td>ぬ</td><td>ね</td><td>の</td><td>は</td><td>ば</td><td>ぱ</td><td>ひ</td><td>び</td><td>ぴ</td><td>ふ</td><td>ぶ</td><td>ぷ</td><td>へ</td><td>べ</td><td>ぺ</td><td>ほ</td><td>ぼ</td></tr>
<tr><td>ぽ</td><td>ま</td><td>み</td><td>む</td><td>め</td><td>も</td><td>ゃ</td><td>や</td><td>ゅ</td><td>ゆ</td><td>ょ</td><td>よ</td><td>ら</td><td>り</td><td>る</td><td>れ</td><td>ろ</td><td>ゎ</td><td>わ</td><td>ゐ</td></tr>
<tr><td>ゑ</td><td>を</td><td>ん</td><td>ァ</td><td>ア</td><td>ィ</td><td>イ</td><td>ゥ</td><td>ウ</td><td>ェ</td><td>エ</td><td>ォ</td><td>オ</td><td>カ</td><td>ガ</td><td>キ</td><td>ギ</td><td>ク</td><td>グ</td><td>ケ</td></tr>
<tr><td>ゲ</td><td>コ</td><td>ゴ</td><td>サ</td><td>ザ</td><td>シ</td><td>ジ</td><td>ス</td><td>ズ</td><td>セ</td><td>ゼ</td><td>ソ</td><td>ゾ</td><td>タ</td><td>ダ</td><td>チ</td><td>ヂ</td><td>ッ</td><td>ツ</td><td>ヅ</td></tr>
<tr><td>テ</td><td>デ</td><td>ト</td><td>ド</td><td>ナ</td><td>ニ</td><td>ヌ</td><td>ネ</td><td>ノ</td><td>ハ</td><td>バ</td><td>パ</td><td>ヒ</td><td>ビ</td><td>ピ</td><td>フ</td><td>ブ</td><td>プ</td><td>ヘ</td><td>ベ</td></tr>
<tr><td>ペ</td><td>ホ</td><td>ボ</td><td>ポ</td><td>マ</td><td>ミ</td><td>ム</td><td>メ</td><td>モ</td><td>ャ</td><td>ヤ</td><td>ュ</td><td>ユ</td><td>ョ</td><td>ヨ</td><td>ラ</td><td>リ</td><td>ル</td><td>レ</td><td>ロ</td></tr>
<tr><td>ヮ</td><td>ワ</td><td>ヰ</td><td>ヱ</td><td>ヲ</td><td>ン</td><td>ヴ</td><td>ヵ</td><td>ヶ</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</tbody></table>
<script type='text/javascript'>
//<![CDATA[
<?
if($isie == 1) echo "var opener = dialogArguments;";
?>
function charT(no) {
for(var i=0;i < 6;i++) {
if(i !=no) {
document.getElementsByTagName('table')[i].style.display = 'none';
document.getElementsByTagName('span')[i].style.fontWeight = 'normal';
} else {
document.getElementsByTagName('table')[i].style.display = 'block';
document.getElementsByTagName('span')[i].style.fontWeight = 'bold';
}}}
function xxclick(e) {
<?if($isie == 1) {?>
mousxent = event.srcElement;
<?} else {?>
mousxent = e.target;
<?}?>
if(mousxent && mousxent.tagName.toLowerCase() == 'td') opener.tag('',mousxent.innerHTML,'plus','','');
}
document.onclick = xxclick;
parent.document.title = '특수문자';
//]]>
</script>
</body>
</html>
<?
exit;
}
?>
<script type='text/javascript'>
var wopen = 1;
var setop = Array('<?=$isie?>','<?=$bwr?>',<?=$sett[5]?>,'<?=$sett[55]?>','<?=(($sett[8] != 'a' && $sett[8] <= $mbr_level)?1:0)?>','<?=(($sett[57] != 'a' && $sett[57] <= $mbr_level)?1:0)?>','<?=$uid?>',525);
var ffldr = "http://<?=$_SERVER['HTTP_HOST']?><?=$_SERVER['PHP_SELF']?>?id=<?=$uid?>&amp;";
var btype = "<?=($sss[26] == 'd')? 'd':'';?>";
</script>
</head>
<body class="bbody" onclick="endyrsz();if(wopen==2) imgview(0)" onload="if(!sessno) setup()">
<span id='img' style='display:none;width:0'></span>
<div id='pview' style='display:none;padding:5px; line-height:130%'></div>
<script type="text/javascript" src="include/top.js"></script>
<?
$_SERVER['REQUEST_URI'] = str_replace("&","&amp;",$_SERVER['REQUEST_URI']);
if($sett[2]) include($sett[2]);
if(!$sett[41] || $sett[41] == 1) $bhlct = '';
else {
$bhlct = "<a href='{$index}'>HOME</a>";
if($sett[41] != 2 && $sett[41] != 6 && $sett[41] != 7 && $grp[$sgp]) $bhlct .= " &gt; <a href='{$index}?group={$sgp}'>{$grp[$sgp][0]}</a>";
if($sett[41] != 3 && $sett[41] != 5 && $sett[41] != 7 && $section && (count($bfsb[$section]) > 1 || $sett[40])) $bhlct .= " &gt; <a href='{$index}?section={$section}'>{$sect[$section][0]}</a>";
if($sett[41] != 4 && $sett[41] != 5 && $sett[41] != 6) $bhlct .= " &gt; <a href='{$dxpt}&amp;p=1'>{$wdth[1]}</a>";
}
if($sett[26]) include('module/'.$sett[26].'.php');
if($sett[41]){?><div class='bd_name'><h2><? if($sss[29]){?><a target='_blank' href='<?=$exe?>?rss=<?=$uid?>'><img src='icon/rss.gif' alt='' border='0' /></a><?} else {?><img src='icon/norss.gif' alt='' border='0' /><?}?><a href='<?=$dxpt?>'><?=$bdidnm[$id]?></a></h2><div><?=$bhlct?></div></div><?}
if($sett[16][2]) {if($sett[32]) @readfile($dxr."head");else include($dxr."head");}
if($_POST['edit'] == "edit" && false !== strpos($wdth[4],$_POST['no']."^")) {$notrt = "checked='checked'";$notrtv = 1;}
else $notrtv = 0;
if($sett[32]) @readfile($dxr.$id."/head.dat");else include($dxr.$id."/head.dat");
?>
<form method="post" name="wform" action="<?=$exe?>" style="margin:0">
<table id='wtable' border='0' cellspacing='0' cellpadding='0' style='width:100%'>
<tr><td>
<?
if(($sett[6] == 0 || $sett[6] == 2) && $_GET['write'] == "new" && ($mbr_level > 0 || $sss[43])) $xdouble = '1';else $xdouble = '';
if($_GET['depth'] && ($sss[54] || !$sss[55])) $exit = 'exit';
else if($_GET['write'] != "new" || $xdouble) {
$fl = fopen($dl,"r");
$fn = fopen($dn,"r");
$fb = fopen($db,"r");
$num = 0;
while(!feof($fn)){
$xxx = fgets($fn);
$num = (int)substr($xxx, 0, 6);
if(!$num) break;
else if($xdouble) {
if(($mbr_no && strpos($xxx,$mbr_no."\x1b") == 9) || (!$mbr_no && trim(substr(fgets($fl),10,15)) == $_SERVER['REMOTE_ADDR'])) {
$xdouble = fgets($fb);
break;
} else fgets($fb);
} else if(($_POST['edit'] && $_POST['no'] == $num) || ($_GET['depth'] && $_GET['write'] == $num)) {
$xxx = explode("\x1b", $xxx);
$flo = explode("\x1b", fgets($fl));
$content = fgets($fb);
$mo = substr($xxx[0], 9);
if(($xxx[6][0] == 'a' || $xxx[0][8] > $mbr_level) && $_GET['depth']) $exit = 'exit';
$ctt = substr($xxx[0], 6, 2);
break;
} else {
fgets($fl);
fgets($fb);
}
}
fclose($fl);
fclose($fn);
fclose($fb);
}
if($_POST['edit'] == "edit" || $_GET['depth']) {
if($exit == 'exit') {
echo "<script type='text/javascript'>history.go(-1);</script>";
exit;
}
$flo[1] = str_replace('"', '″',$flo[1]);
if($_POST['edit'] != "edit") $content = str_replace("<br />", "\n", $content);
$content =  str_replace("&", "&amp;", $content);
if($_POST['edit'] == "edit"){
$timecut = (!$sss[67] || $sss[67] == 2 || $sss[69] <= $mbr_level)? 0:$time - ($sett[71]*3600);
if(($mo && $mo == $mbr_no) || (!$mo && $_POST['pass'] && $flo[2] == $_POST['pass'])|| $mbr_level == "9") $psscked = 2;
if($psscked == 2 && (!$timecut || substr($flo[0],0,10) >= $timecut)) {
$flo[3] = str_replace("\"", "″",$flo[3]);
if($sss[54]) {$conval = explode("\x1b", $content);$content=$conval[0];}
} else {
if($psscked != 2) $psscked = "비밀번호가 틀립니다. (".wpass(2)."/10)";
else $psscked = "시간초과로 변경금지되었습니다.";
scrhref($dxpt."&amp;no=".$_POST['no']."&amp;p=".$_POST['p'],0,$psscked);
exit;
}
?>
<input type="hidden" name="xx" value="<?=$_POST['xx']?>" />
<input type="hidden" name="no" value="<?=$_POST['no']?>" />
<input type="hidden" name="mode" value="<?=$_POST['edit']?>" />
<?
} else {
$content = "<br /><br /><br /><br /><div class='quot'>아래는 <b>{$flo[1]}</b>님의 글입니다.<div class='quot2'>{$content}</div></div>";
$flo = '';
}} else $xxx = "000000";
$content =  str_replace("<", "&lt;", $content);
if(!$flo[3]) $flo[3] = '제목을 입력하세요';
$_SESSION[$wtses] = array($id,$_POST['no']);
$istn = 0;
if($_POST['no']) $uno = $_POST['no'];
else {
$istn =1;
$nwdoc = $dxr.$id."/nwdoc";
if(!file_exists($nwdoc) || $time - filemtime($nwdoc) > 7200) {
$uno = $lst + 1;
$fw = fopen($nwdoc,"w");
} else {
$fw = fopen($nwdoc,"r+");
$uno = (int)fread($fw,6) + 1;
if($uno == 1000000) $uno = 1;
rewind($fw);
}
$uno6 = str_pad($uno,6,0,STR_PAD_LEFT);
fputs($fw,$uno6);
fclose($fw);
?>
<input type="hidden" name="uno" value="<?=$uno6?>" />
<?
}
?>
<input type="hidden" name="pno" value="<?=$uno?>" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="reply" value="<?=$_GET['write']?>" />
<input type="hidden" name="p" value="<?=$_REQUEST['p']?>" />
<input type="hidden" name="depth" value="<?=$_GET['depth']?>" />
<input type="hidden" name="ntime" value="<?=$dockie2?>" />
<div style="padding-right:6px">
<?
if($ctg) {
?>
<select name='ct' style='vertical-align:middle;float:right;margin-left:5px'>
	<option value="00" style="color:#999">선택하세요</option>
<?
foreach($ctg as $ii => $ctname) {
if($ctname) {
$ctname = preg_replace('`<[^>]+>`','',$ctname);
if($_POST['edit'] == "edit" && $ctt == $ii) echo "<option value='{$ii}' selected='selected'>{$ctname}</option>";
else echo "<option value='{$ii}'>{$ctname}</option>";
}}
?></select><?
} else echo "<input type='hidden' name='ct' />\n";
if($mbr_no <= 0) {
$uzname = ($sss[64])? "익명":(($_POST['edit'] == "edit")? $flo[1]:$_SESSION['yname']);
$uzpass = ($_POST['edit'] == "edit")? $flo[2]:$_SESSION['ypass'];
?>
<div style='float:left;width:395px'>이름<input type="text" name="name" style="width:100px" value="<?=$uzname?>" maxlength='20' class="inputt" />
 &nbsp; 비밀번호<input type="password" name="pass" style="width:100px" value="<?=$uzpass?>" maxlength='10' class="inputt" /><? if($sett[17] == 1||$sett[17] == 3){?> &nbsp; <label title="
 회원인 경우,
 회원아이디와 회원비밀번호를 넣고,
 여기를 체크해서 로그인할 수 있습니다.
 회원이 아닌경우엔 무시하세요 .
"> 로그인<input
 type="checkbox" class="checkk" onclick="chksbmt2(this)" /></label><?}?></div>
<?} if($_POST['edit'] != 'edit' && $sett[82] > 2 && (!$mbr_no || $sett[82] == 5)) {?>
<div class="antispamdv"><img src="include/antispam.php?no=<?=$uno?>" alt="antispam" /><input type="text" name="antispam" value="" onblur="chkatcode(<?=$uno?>,this)" /><span class="f8">왼쪽 값을 입력하세요</span></div>
<?
} if($sss[26] != 'd') {
?>
<input type="text" name="subject" style="width:100%;clear:both;margin-left:0" value="<?=$flo[3]?>" onclick="if(this.value=='제목을 입력하세요') this.value=''" maxlength="70" class="inputt" />
<?
}
?>
</div>
<?
if(!$flo[5]) $flo[5] = "http://";
if($bwr == 'ie6') $preev = " onmouseover='this.style.backgroundColor=\"#C1F471\"' onmouseout='this.style.backgroundColor=\"transparent\"'";
else $preev = "";
if($sss[54]) {
if($fa=@fopen($dxr.$id."/write.html","r")) {
while($fao=fgets($fa)) echo $fao;
fclose($fa);
}
if($conval) {
echo "<script type='text/javascript'>
//<![CDATA[\n";
for($a = 1;isset($conval[$a]);$a++) {
$aa = $a -1;
echo "document.getElementsByName('addfield[]')[{$aa}].value = \"".trim($conval[$a])."\";\n";
}
echo "
//]]>
</script>";
}}
if($ismobile != 2) {
?>
<div class='fcler' onmousedown='mtxt(9)'><ul class="butn">
<li><a class='butt3'>글꼴</a><ul style='width:100px' class='preev'>
<li style='font-family:Gulim'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Gulim\'}','{/span}','plus','t',this)">굴림</a></li>
<li style='font-family:Dotum'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Dotum\'}','{/span}','plus','t',this)">돋움</a></li>
<li style='font-family:Batang'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Batang\'}','{/span}','plus','t',this)">바탕</a></li>
<li style='font-family:Gungsuh'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Gungsuh\'}','{/span}','plus','t',this)">궁서</a></li>
<li style='font-family:Malgun Gothic'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Malgun Gothic\'}','{/span}','plus','t',this)">맑은고딕</a></li>
<li style='font-family:Arial'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Arial\'}','{/span}','plus','t',this)">Arial</a></li>
<li style='font-family:Tahoma'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Tahoma\'}','{/span}','plus','t',this)">Tahoma</a></li>
<li style='font-family:Verdana'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Verdana\'}','{/span}','plus','t',this)">Verdana</a></li>
<li style='font-family:Trebuchet MS'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:Trebuchet MS\'}','{/span}','plus','t',this)">Trebuchet MS</a></li>
<li style='font-family:sans-serif'><a<?=$preev?> onmousedown="tag('{span style=\'font-family:sans-serif\'}','{/span}','plus','t',this)">sans-serif</a></li>
</ul></li>
<li><a class='butt3'>크기</a><ul style='width:280px' class='preev'>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:7pt\'}','{/span}','plus','t',this)"><span style='font-size:7pt'>글자크기(7pt)</span></a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:8pt\'}','{/span}','plus','t',this)"><span style='font-size:8pt'>글자크기(8pt)</span></a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:9pt\'}','{/span}','plus','t',this)"><span style='font-size:9pt'>글자크기(9pt)</span></a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:10pt\'}','{/span}','plus','t',this)"><span style='font-size:10pt'>글자크기(10pt)</span></a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:11pt\'}','{/span}','plus','t',this)"><span style='font-size:11pt'>글자크기(11pt)</span></a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:13pt\'}','{/span}','plus','t',this)"><span style='font-size:13pt'>글자크기(13pt)</span></a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:16pt\'}','{/span}','plus','t',this)"><span style='font-size:16pt'>글자크기(16pt)</span></a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:20pt\'}','{/span}','plus','t',this)"><span style='font-size:20pt'>글자크기(20pt)</span></a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'font-size:25pt\'}','{/span}','plus','t',this)"><span style='font-size:25pt'>글자크기(25pt)</span></a></li>
</ul></li>
<li><a class='butt3'>박스</a><ul style='width:100px' class='preev'>
<li><a<?=$preev?>  onclick="popup('<?=$write?>?box=div',400,335)">div</a></li>
<li><a<?=$preev?> onclick="popup('<?=$write?>?box=div&amp;aox=scroll',400,335)"> - 내부스크롤</a></li>
<li><a<?=$preev?> onclick="popup('<?=$write?>?box=div&amp;aox=moreless',400,360)"> - 보기/닫기</a></li>
<li><a<?=$preev?> onclick="popup('<?=$write?>?box=fieldset',400,360)">fieldset</a></li>
<li><a<?=$preev?> onclick="popup('<?=$write?>?box=table',400,245)">table</a></li>
<li style='border-top:1px solid black'></li>
<li><a<?=$preev?> onclick="popup('<?=$write?>?box=fontstyle',400,310)">폰트스타일</a></li>
<li><a<?=$preev?> onclick="popup('<?=$write?>?box=span',400,310)">밑줄/풍선말</a></li>
<li><a<?=$preev?> onclick="popup('<?=$write?>?box=a',400,245)">미리보기 링크</a></li>
</ul></li>
<li><a class='butt3'>정렬</a><ul style='width:70px' class='preev'>
<li><div style="text-align:left;margin:0"><a<?=$preev?> onmousedown="tag('{div align=\'left\'}','{/div}','justifyLeft','','')">left</a></div></li>
<li><div style="text-align:center;margin:0;background-color:#EAEAD6"><a<?=$preev?> onmousedown="tag('{div align=\'center\'}','{/div}','JustifyCenter','','')">center</a></div></li>
<li><div style="text-align:right;margin:0"><a<?=$preev?> onmousedown="tag('{div align=\'right\'}','{/div}','JustifyRight','','')">right</a></div></li>
</ul></li>
<li><a class='butt3'>기타</a><ul style='width:100px' class='preev'>
<li><a<?=$preev?> onmousedown="tag('{sup}','{/sup}','superscript','','')">위첨자&lt;sup&gt;</a></li>
<li><a<?=$preev?> onmousedown="tag('{sub}','{/sub}','subscript','','')">아래첨자&lt;sub&gt;</a></li>
<li><a<?=$preev?> onmousedown="tag('{div style=\'margin-left:40px\'}','{/div}','indent','','')">들여쓰기</a></li>
<li><a<?=$preev?> onclick="tag('','','outdent','','')">내어쓰기</a></li>
<li><a<?=$preev?> onmousedown="tag('{hr size=\'3\' /}','','inserthorizontalrule', '','')">수평선</a></li>
<li><a<?=$preev?> onmousedown="tag('{span style=\'text-decoration: underline\' title=\'클릭:네이버사전\' onclick=\'imgview(\\\'http:\/\/dic.naver.com/search.nhn?query=\\\' +encodeURIComponent(this.innerHTML),5,500)\'}','{/span}','plus','','')">네이버사전</a></li>
<li><a<?=$preev?> onmousedown="tag('{a style=\'text-decoration: underline\' title=\'링크:네이버검색\' onclick=\'nwopn(\\\'http:\/\/search.naver.com/search.naver?where=nexearch&amp;sm=tab_jum&amp;query=\\\' +encodeURIComponent(this.innerHTML))\'}','{/a}','plus','','')">네이버검색</a></li>
<li><a<?=$preev?> onmousedown="tag('{a style=\'text-decoration: underline\' title=\'링크:구글검색\' onclick=\'nwopn(\\\'http:\/\/www.google.co.kr/search?q=\\\' +encodeURIComponent(this.innerHTML))\'}','{/a}','plus','','')">구글검색</a></li>
</ul></li>
<li><a class='butt3'>목록</a><ul style='width:100px' class='preev'>
<li><a<?=$preev?> onclick="tag('','{ul}{li}##{/li}{/ul}','plus','',3)">기호목록&lt;ul&gt;</a></li>
<li><a<?=$preev?> onclick="tag('','{ol}{li}##{/li}{/ol}','plus','',3)">번호목록&lt;ol&gt;</a></li></ul></li>
<li><a<?=$preev?> class='butt3 bold8' onclick="popup('<?=$write?>?box=a&amp;aox=url&amp;cox=Lnk',400,50)" title="링크삽입">Lnk</a></li>
<li><a class='butt3 bold8' onclick="popup('<?=$write?>?box=img&amp;aox=url&amp;cox=Img',400,50)" title="이미지삽입">Img</a></li>
</ul>
<?
if(!$sett[77] && $srwdth < 565) {
?>
<div class='fcler'></div>
<?
}
if($sett[30]) {
$dtime = $time - ($sett[30]*86400);
$tm = opendir($dxr."_member_");
while($tmp = readdir($tm)) {
if(substr($tmp,0,3) == 'wtp') {
if(filemtime($dxr."_member_/".$tmp) < $dtime) @unlink($dxr."_member_/".$tmp);
}
}
closedir($tm);
}
if($tpsz = @filesize($saved)) {
$fp = fopen($saved,"r");
$svd = fread($fp,$tpsz);
fclose($fp);
$tpsz = ($tpsz > 1024)? sprintf("%.1f",$tpsz/1024)."kb":$tpsz."b";
$tpsz = "<span class='n7'>{$tpsz}</span>";
}
if(is_dir("icon/emoticon")) {
$emotc = array();
$edopn = opendir("icon/emoticon");
while($emoc = readdir($edopn)) {
if($emoc != '.' && $emoc != '..') $emotc[] = $emoc;
}
closedir($edopn);
if($emotc[1]) sort($emotc);
}
?>
<ul class="butn">
<li><a class='butt3' onclick="popup('<?=$write?>?box=color',303,120)" style="color:red" title="글자색">가</a></li>
<li><a class='butt3' onclick="popup('<?=$write?>?box=bgcolor',303,120)" title="배경색"><span style="background-color:yellow">가</span></a></li>
<li><a class='butt3' onmousedown="tag('{b}','{/b}','bold','','')" style="font-weight:bold" title="굵게">가</a></li>
<li><a class='butt3' onmousedown="tag('{i}','{/i}','italic','','')" style="font-style:italic" title="기울게">가</a></li>
<li><a class='butt3' onmousedown="tag('{u}','{/u}','underline','','')" style="text-decoration:underline" title="밑줄">가</a></li>
<li><a class='butt3' onmousedown="tag('{s}','{/s}','strikethrough','','')" style="text-decoration:line-through" title="취소선">가</a></li>
<? if($emotc) {?>
<li style='width:27px'><a class='butt3' title="이모티콘"><img src='icon/emoticon.gif' alt='' border='0' /></a><ul style='width:234px' class='preev emotic'>
<?
foreach($emotc as $key => $value) {
?>
<li><img src='icon/emoticon/<?=$value?>' alt='' onclick="tag('','{img src=\'' + this.src + '\' alt=\'\' /}','plus','','')" /></li>
<?
}
?></ul></li><?}?>
<li><a class='butt3' onclick="popup('<?=$write?>?spc=1',420,200)" title="특수문자">※</a></li>
</ul>
<ul class="butn" style='float:right'>
<li><a class='butt3' id='dehtml' onclick="wsghtm()" style='padding:4px 8px 0 8px;font-weight:bold' title='위지윅/HTML 전환'>html</a></li></ul></div>
<?} else {?><div id='dehtml' style='display:none'></div><?}?>
<div class='fcler'></div><div id='contentdiv' style='height:<?=$sett[33]?>px;border:1px solid #BFBFBF'>
<? if($ismobile != 2) {?><iframe id="previw" style="clear:both;width:100%;height:100%;font-size:9pt;margin:0;display:none" marginheight='0px' marginwidth='0px' frameborder='0'></iframe>
<iframe id="wsgwin" style="clear:both;width:100%;height:100%;font-size:9pt;margin:0;background:#FFFFFF;" marginheight='0px' marginwidth='0px' frameborder='0'></iframe><?} else {?><input type="text" id="wsgwin" style="display:none" /><?}?>
<div id="texx" style="overflow:auto;height:<?=$sett[33]?>px;clear:both;display:none;padding-right:25px;background:#FFFDFA"><textarea name="wcontent" id="content" rows="1" cols="1" onmouseup='save_pos(this)' onkeyup='if(ctrk) save_pos(this)' onkeydown='if(ekc == 13) texresiz(this,0)' style="line-height:15px;width:100%;height:100%;font-size:9pt;background:#FFFDFA url('icon/line_no.png') repeat-y;padding-left:22px;margin:0;overflow:hidden;border:0"><?=str_replace("</textarea","<//textarea",$content)?></textarea></div>
</div>
<? if($ismobile != 2) {?>
<input type='button' id='rszdv' class='rszdv' onmousedown='startyrsz()' onmouseup='endyrsz()' onclick='endyrsz()' />
<div id='wzwg' style='display:block;float:left;'>
<a onclick="first()" class="butt3 bold8" style="float:left">처음</a>
<a onclick="tag('','','undo','','')"  class='butt3' style="float:left;font-size:11px;font-weight:bold" title='실행취소'>undo</a>
<a onclick="tag('','','redo','','')" class='butt3' style="float:left;font-size:11px;font-weight:bold" title='다시실행'>redo</a>
</div>
<select id='html' onchange="var xx=this.options[this.selectedIndex].value;if(xx){seltrans(xx);this.value='';}" style='display:none;float:left;font-size:9pt'>
	<option value="">줄바꿈등등</option>
	<option value="nl2br">\n → &lt;br&gt;</option>
	<option value="nl+br">\n → \n&lt;br&gt;</option>
	<option value="nl-" style='color:red'>\n → ''</option>
	<option value="br2nl">&lt;br&gt; → \n</option>
	<option value="br+nl">&lt;br&gt; → \n&lt;br&gt;</option>
	<option value="br-" style='color:red'>&lt;br&gt; → ''</option>
	<option value="lt">&lt; → &amp;lt;</option>
	<option value="lt-">&amp;lt; → &lt;</option>
	<option value="delp" style='color:red'>&lt;p&gt;&lt;/p&gt; → ''</option>
	<option value="edtb">테이블편집</option>
	<option value="lowcase">소문자로</option>
	<option value="upcase">대문자로</option>
	<option value="w3c">웹표준 변환</option>
</select>
<div style='float:left;padding:7px 0 0 3px'>
<label title='검색치환을 정규식으로'>정규식 <input type='checkbox' class='checkk' id='regular' /></label></div>
<div style='float:right'>
<a id='tpsv' onclick="bysaved()" class="butt3 bold8" style="float:left">임시저장 <?=$tpsz?></a>
<a id="aprevw" onclick="prevw()" class="butt3 bold8" style="float:left">미리보기</a></div><div class='fcler'></div><?}?>
<table cellspacing='0' cellpadding='0' style='width:100%;padding:3px 0 3px 0'><tr><td style='width:50%'><table cellspacing='0' cellpadding='0' style='width:100%'><tr><td style='width:50px'></td><td></td></tr></table></td>
<td style='width:50%'><table cellspacing='0' cellpadding='0' style='width:100%'><tr><td style='width:65px;text-align:center'></td>
<td></td></tr></table></td></tr></table>
</td></tr>
<tr><td>
<? if($wdth[7][31] != 'a' && $wdth[7][31] <= $mbr_level) {?>
<div id='previe'></div>
<ul id='fuplist' style='list-style-type:none;margin:0;padding:0'><li></li></ul>
<div style='float:left'>
<div style='float:left;padding:3px 0 0 3px;height:45px;color:#BABABA'><input type='hidden' name='afsze' value='' /><span id='afszt'>0</span> KB<? if($sett[9] && $wdth[7][9]) echo " / ".($sett[9]*1024)." KB";?> &nbsp; <br /></div>
<div class='fcler'></div><div style='float:left'></div><iframe id='uploadlist' src='<?=$exe?>?id=<?=$uid?>&amp;ufn=<?=$uno?>&amp;no=<?=$_POST['no']?>&amp;ntime=<?=$dockie2?>' style='height:25px;width:75px;float:left;' frameborder='0'></iframe>
<a onmousedown='mtxt(9)' onclick='tfdx()' class="butt3 bold8" style="float:left">삭제</a>
<a onmousedown='mtxt(9)' onclick='pimg()' class="butt3 bold8" style="float:left"><? if(!$ismobile && $iswindows) {?><img src='icon/f.png' style='height:12px;vertical-align:middle;margin-right:3px;border:0' alt='' /><?}?>본문삽입</a>
</div><div class='fcler'></div>
<? if($wdth[7][33]){?><div style='padding:5px 0 5px 0;color:#BABABA'>첨부 허용: <?=str_replace("|",",",$sett[64])?></div>
<?}} if($sss[26] != 'd') {?>
<div style='float:left;padding:5px 0 5px 0'><label>트랙백<input
 type="checkbox" class="checkk" onclick="toggle($('hidden1'))" /></label><label>링크<input id="inhidden2"
 type="checkbox" class="checkk" onclick="toggle($('hidden2'))" /></label><? if(!$wdth[7][32]) {?><label>태그<input
 type="checkbox" class="checkk" onclick="toggle($('hidden3'))" /></label><?} if($sett[15]) {
function rtchecked($val) {
if($val && $val != '0') return "value=\"{$val}\" checked=\"checked\"";
else return "";
}
?><label title='덧글이 달리면 메일로 통보합니다'>덧글메일통보 <input type="checkbox" class="checkk"
<? if(($_POST['edit'] != 'edit' && $mbr_level) || ($_POST['edit'] == 'edit' && $mo)) {echo " name='perm_rpmail' ";if($_POST['edit'] == "edit") echo rtchecked(substr($xxx[6],1));else echo rtchecked($wdth[7][7]);} else {
echo " onclick=\"if(this.nextSibling.style.display=='') {this.nextSibling.style.display='none';this.nextSibling.value='Email Address';} else this.nextSibling.style.display=''\"";
if($_POST['edit'] == 'edit' && substr($xxx[6],1)) echo " checked='checked'";echo " /><input type='text' name='perm_rpmail' onclick='if(this.value==\"Email Address\") this.value=\"\"' title='메일주소를 적으면 덧글을 메일로 통보합니다' value='";
if($_POST['edit'] == 'edit' && substr($xxx[6],1)) echo substr($xxx[6],1)."'";else echo "Email Address' style='display:none'";
}?> /></label><?} if($mbr_level == "9"){?></div><div style='float:left;padding:5px 0 5px 0'><label>공지글<input
 type="checkbox" class="checkk" name="notice" value="<?=$notrtv?>" onclick="this.value=(this.value=='1')? '0':'1'" <?=$notrt?> /></label><label>분류편집<input
 type="checkbox" class="checkk" onclick="if(this.checked){repeatt(1);popup('<?=$admin?>?mst=<?=$idn?>', 300, 200)}" /></label><?}}?></div><div class='fcler'></div>

<? if($sss[26] != 'd') {if((int)$xxx[2] == 0) {?>  &nbsp; 덧글&nbsp;<select name="perm_rp"><option value="0">허용</option><option value="a">차단</option></select><?} if(!$xxx[6] || (!$_GET['depth'] && (int)$xxx[6][0] == 0)){?> &nbsp; 답글&nbsp;<select name="perm_re"><option value="0">허용</option><option value="a">차단</option></select><?} if((int)$xxx[4] == 0) {?> &nbsp; 엮인글&nbsp;<select name="perm_tb"><option value="0">허용</option><option value="a">차단</option></select><?}}?>
<div id='hidden1' style='display:none'>트랙백주소<input type="text" name="tb_url" style="width:33%" value="http://" class="inputt" /> &nbsp; 글주소<input type="text" name="tb_link" style="width:33%" value="http://" class="inputt" /></div>
<div id='hidden2' style='display:none'>링크주소<input type="text" name="wf_link5" style="width:74%" value="<?=$flo[5]?>" class="inputt" onclick="if(this.value=='http://') this.value='';" />&nbsp;</div>
<div id='hidden3' style='display:none'>태그<input type="text" name="wf_link6" style="width:50%" value="<?=$flo[6]?>" class="inputt" />&nbsp;<input type="button" onclick="tagw()" class="butt6" value="태그보기" style="margin:0;height:18px;width:60px;font-size:8pt" />&nbsp;태그의 구분은 쉼표(,)로<div id='tagdiv'></div></div>
<input type="hidden" id="wzor" value="w" /><input type="hidden" id="gout" value="1" /><input type="hidden" id="wrwn" value="0" /><input type="hidden" id="edht" value="300" /><input type="hidden" id="prvw" value="0" /><iframe name="exe" style="display:none;width:0;height:0"></iframe>
</td></tr>
<tr><td align='center'><input type="button" onclick="wcancel()" class="butt6" value="cancel" style="margin-right:10px" /><input type="button" onclick="sbmt()" class="butt6" value="submit" />
</td></tr>
</table></form>
<form name="svfm" action="<?=$exe?>" method="post" target="exe" style="visibility:hidden"><input type="hidden" name="id" value="<?=$id?>" /><input type="hidden" name="no" value="<?=$_POST['no']?>" /><textarea name="saved" rows="1" cols="1" style="width:0;height:0;border:0;display:none"><?=str_replace("<","&lt;",str_replace("&","&amp;",$svd))?></textarea></form>
<textarea id="ckdouble" rows="1" cols="1" style="width:0;height:0;border:0;visibility:hidden"><?=trim($xdouble)?></textarea>
<?
if($sett[16][5]) {if($sett[32]) @readfile($dxr."tail");else include($dxr."tail");}
if($sett[26]) include('module/'.$sett[26].'.php');
if($sett[3]) include($sett[3]);
?>
<script type='text/javascript'>
//<![CDATA[
var obj = $$('wcontent',0);
var obw = $('wsgwin').contentWindow;
var updoc = '';
var rdio;
var ofen;
var win;
var oselt = '';
var mmo = false;

function tagw(ths) {
if($('tagdiv').innerHTML) $('tagdiv').innerHTML = '';
else azax('<?=$index?>?&id=<?=$id?>&order=2&tag=1','tagview(ajax)');
}

function tagview(val) {
val = val.substr(val.indexOf("</div>") +6);
val = val.substr(0,val.indexOf("<script"));
$('tagdiv').innerHTML = val.replace(/tago[^<]+<span/g,"tago(this)'").replace(/<\/span><\/a>/g,"</a>").replace(/<a href='\?id=([^']+)'>/g,"<a onclick=\"azax('<?=$index?>?id=$1','tagview(ajax)')\">");
}
function tago(ths) {
$$('wf_link6',0).value = $$('wf_link6',0).value + ths.innerHTML + ",";
}

function texresiz(ths, n) {
var th=parseInt(ths.style.height);
var nh=ths.scrollHeight<? if($isie == 2 && !$bwr) echo "-4";?>;
if(n == 1) {
var texh = parseInt($('texx').style.height);
if(texh < nh) ths.style.height=nh + 13 + 'px';
else ths.style.height=texh + 'px';
} else if(th < nh) ths.style.height=nh + 13 + 'px';
}

function tdbck(ths) {
if(!window.open(ffldr.replace(/amp;/,'') + ths.childNodes[1].value,'_blank')) {
if(confirm("팝업이 차단되어 있습니다.\n파일주소를 Find란에 입력합니까")) $('replace_a').value = ffldr + ths.childNodes[1].value;
}}

function tfdx() {
if(updoc != '') {
if(updoc.document.delup.delfile.value) {
updoc.document.delup.submit();
setTimeout("updoc.fselct()",500);
} else alert("파일을 선택하세요");
}}

function tclick(ths) {
if(rdio[0].innerHTML) {
if(!ths) {ths = rdio[0];}
if(ctrk == true) {
var updel = updoc.document.delup.delfile.value;
if(updel.substr(0,2) != "^^") updel = "^^" + updel;
if(updel.substr(updel.length -2,2) != "^^") updel += "^^";
if(updel.indexOf("^^" + ths.firstChild.value + "^^") == -1) updoc.document.delup.delfile.value = updel + ths.firstChild.value + "^^";
} else {
for(var i=rdio.length -1;i >= 0;i--) {rdio[i].style.background = '';if(rdio[i].firstChild) rdio[i].firstChild.className = '';}
updoc.document.delup.delfile.value = ths.firstChild.value;
}
ths.style.background = '#DBDBDB';ths.firstChild.className = 'xsltd';
if(ths.className == 'emg') {
var imgbdr = ($('imgbordr').checked)? " style='border:" + $('imgbordr').value + "'":"";
$('previe').innerHTML = "<img name=\"img580\" onclick=\"imgview(this.src,0,0," + ths.firstChild.value + ")\" src=\"" + ffldr + ths.childNodes[1].value + "\"" + imgbdr + " alt=\"\" \/>";
} else $('previe').innerHTML = "";
}
ctrk = false;
}

function startyrsz() {
$('rszdv').style.cursor="row-resize";
if($('prvw').value == '1') $('previw').style.display = 'none';
else if($('wzor').value == 'w') $('wsgwin').style.display = 'none';
ry = y;
}

function endyrsz() {
if($('rszdv')) {
$('rszdv').style.cursor="n-resize";
$("edht").value=parseInt($("contentdiv").style.height);
if($('prvw').value == '1') $('previw').style.display = 'block';
else if($('wzor').value == 'w') $('wsgwin').style.display = 'block';
ry = '';
}}

function resizeheight(w,h){
h= (h - parseInt(ry) + parseInt($('edht').value));
$('contentdiv').style.height = h + 'px';
$('texx').style.height = h + 'px';
if(parseInt($('content').style.height) < h) $('content').style.height = h + 'px';
}

function pimg() {
var isfile;
if($('wzor').value == 'w') obw.focus();
else obj.focus();
var imgv = $('imgbordr').value;
imgv = (imgv != '')?"border:" + imgv:"";
var imgbder = (imgv != '')?"style=\"" + imgv + "\"":"";
var rlengt = rdio.length;
for(var i=0;i < rlengt;i++) {
if(rdio[i] && rdio[i].childNodes.length) {
if(rdio[i].firstChild.className == 'xsltd') {
if(!rdio[i].className) tag("","<a href=\"" + ffldr + rdio[i].childNodes[1].value + "\"/>" + rdio[i].childNodes[2].innerHTML + "</a><br />","plus","","");
else if(rdio[i].className == 'emg') tag("","<img name=\"img580\" " + imgbder + " onclick=\"imgview(this.src,0,0," + rdio[i].firstChild.value + ")\" src=\"" + ffldr + rdio[i].childNodes[1].value + "\" alt=\"\" /><br />","plus","",7);
else if(rdio[i].className == 'wma') {var as=(confirm('자동재생하시겠습니까?'))?1:0;var ht=(confirm('높이를 45px로 합니까?'))?'45px':'270px';tag("","<embed type='application/x-mplayer2' src='" + ffldr + rdio[i].childNodes[1].value + "' style='width:300px;height:" + ht + ";" + imgv + "' autostart='" + as + "' /><br />","plus","","");}
else if(rdio[i].className == 'swf') tag("","<embed src='" + ffldr + rdio[i].childNodes[1].value + "' type='application/x-shockwave-flash' style='width:400px;height:300px;" + imgv + "' /><br />","plus","","");
isfile = 1;
}}}
if(!isfile) alert('파일을 선택하세요');
}

function memo(n) {
var rtv = '';
if($('wzor').value == 'w') rtv = obw.document.body.innerHTML;
else if(n) {
if($('wrwn').value == 1) rtv = obj.value.replace(/[\r\n]/g, "");
else rtv = obj.value.replace(/[\r]?\n/g, "<br>");
$('wrwn').value = 0;
} else rtv = obj.value;
return rtv;
}

function first() {
mmo = false;
obw.document.body.innerHTML = memo(0) + "##";
obw.focus();
sharp();
}

function sharp() {
$('replace_a').value = '##';
setTimeout("findtxt(2)",10);
setTimeout("$('replace_a').value = ''",50);
}

function chksbmt2(ths) {
var cform = (ths)? ths.form:sith.form;
if(ths) {
if(cform.name.value && cform.pass.value) {
sith = ths;
if(ajax) setTimeout("chksbmt2(sith)",100);
else {
ajax = 'chksbmt';
startax("<?=$admin?>?&username_3=" + parent.chbase(cform.name.value) + "&password_3=" + parent.chbase(cform.pass.value));
chksbmt2();
}} else {alert('빈 칸이 있습니다');ths.checked=false;}} else if(ajax == 'chksbmt') setTimeout("chksbmt2()",100);
else if(ajax != '') {
if(ajax.indexOf('alert') == -1) {
var cnpn = cform.name.parentNode;
if(cnpn.nextSibling) cnpn.style.display = 'none';
} else {alert("로그인 되지 않았습니다.\n다시 시도해서 로그인하거나\n아니면, 비회원인 채로 작성하세요");sith.checked=false;}
ajax = '';
sith = '';
}}

function prevw() {
if($('previw').style.display == 'block') {
$('prvw').value = '0';
$('aprevw').innerHTML = '미리보기';
$('previw').style.display = 'none';
if($('wzor').value == 'w') {
$('wsgwin').style.display = 'block';
$('texx').style.display = 'none';
} else {
$('wsgwin').style.display = 'none';
$('texx').style.display = 'block';
}} else {
$('aprevw').innerHTML = '미리보기해제';
$('prvw').value = '1';
$('texx').style.display = 'none';
$('wsgwin').style.display = 'none';
$('previw').style.display = 'block';
var doc = $('previw').contentWindow.document;
doc.open();
doc.write("<html>");
doc.write("<head>");
doc.write("<link rel='stylesheet' type='text/css' href='skin/<?=$wdth[2]?>/style.css' />");
doc.write("<script type='text/javascript'>function toggle(ths){ths.style.display=(ths.style.display == 'none')?'block':'none'}<\/script>");
doc.write("</head>");
doc.write("<body style='background:#FAFEFF;margin:5px'>");
doc.write("<div class='bdo'>");
doc.write(memo(1));
doc.write("</div>");
doc.write("</body>");
doc.write("</html>");
doc.close();
}
}

function mtxt(mxt) {
var mtmt = "";
if($('wzor').value != 'w') {
if(obj.createTextRange && obj.currentPos) {if(obj.value.length - obj.currentPos.text.length > 4) mtmt = obj.currentPos.text;}
else if(obj.selectionEnd && obj.selectionStart != obj.selectionEnd) mtmt = obj.value.substring(obj.selectionStart, obj.selectionEnd);
} else {
if('<?=$isie?>' == '1') {
obw.focus();
if(mmo == false) mmo = obw.document.selection.createRange();
if(mxt != 9) mtmt = mmo.htmlText;
} else {
try{
if(mmo == false) mmo = obw.getSelection().getRangeAt(0);
if(mxt != 9) {var node = document.createElement('div');
node.appendChild(mmo.cloneContents());
mtmt = node.innerHTML;
}} catch(e) {}
}}
if(!mtmt) {
if(mxt == 5) mtmt = "##";
if(mxt != 7) mtmt = "";
}
if(mxt != 9) return mtmt;
}

function tag(prefix, postfix, tagx, tagg, ttag) {
var vurl = "";
prefix = prefix.replace(/{/g,"<").replace(/}/g,">").replace(/\\'/g,'"');
postfix = postfix.replace(/{/g,"<").replace(/}/g,">");
if($('wzor').value != 'w') {
if(prefix == '<ul>' || prefix == '<ol>') {
prefix = prefix + '<li>';
postfix = '</li>' + postfix;
}
if(obj.createTextRange && obj.currentPos) {
		obj.currentPos.text = prefix + obj.currentPos.text + postfix;
		obj.focus();
} else if(obj.selectionEnd && obj.selectionStart != obj.selectionEnd) {
	var s1 = obj.value.substring(0, obj.selectionStart);
	var s2 = obj.value.substring(obj.selectionStart, obj.selectionEnd);
	var s3 = obj.value.substring(obj.selectionEnd);
	obj.value = s1 + prefix + s2 + postfix + s3;
} else obj.value = prefix + postfix + obj.value;
} else {
if(tagx == 'plus'){
if(tagg == 't') {mmo = false;mtxt();ofen = ttag.parentNode.parentNode;ofen.style.display='none';setTimeout('ofen.style.display="";',10);}
obw.focus();
var mmtxt = mtxt(ttag);
mmtxt = prefix + mmtxt + postfix;
if('<?=$isie?>' == '1') mmo.pasteHTML(mmtxt);
else {mmo.deleteContents();mmo.insertNode(mmo.createContextualFragment(mmtxt));}
if(ttag == 3) sharp();
} else {
obw.focus();
obw.document.execCommand(tagx,ttag,ttag);
}
}
mmo = false;
}

var iefn = 0;
function findtxt(alrt) {
var old = $('replace_a').value;
if(setop[0] == '1') {
if(tath != old) {iefn = 0;tath = old;}
if($('wzor').value != 'w') var tx=obj.createTextRange();
else var tx=obw.document.body.createTextRange();
for(var i=0;i <= iefn && (found=tx.findText(old)) != false; i++){tx.moveStart("character",old.length);tx.moveEnd("textedit");} if(found){tx.moveStart("character",-old.length);tx.findText(old);tx.select();tx.scrollIntoView();iefn++;} else {iefn = 0;if(alrt != 2) alert("검색결과가 없습니다.");}
} else if(setop[1] != 'opera') {
if($('wzor').value != 'w') {document.createRange();window.find(old, true, true, true, false, true, false);}
else {obw.document.createRange();if(!obw.find(old, true, true, true, false, true, false) && alrt != 2) alert("검색결과가 없습니다.");}
} else alert('opera는 지원안됩니다.');
}

function seltrans(str) {
	var old = "";
	var neo = "";
	var old__ = "";
	var old_ = "";
	var neo__ = "";
	var neo_ = "";
	if(str == 'nl2br') {
	old = /[\r]/gi;
	neo = "";
	old_ = /[\n]/gi;
	neo_ = "<br />";
	} else if(str == 'br2nl') {
	old = /<br>/gi;
	neo = "\n";
	old_ = /<br[ \/]*>/gi;
	neo_ = "\n";
	} else if(str == 'nl+br') {
	old = /[\n]/gi;
	neo = "\n<br />";
	} else if(str == 'br+nl') {
	old = /<br/gi;
	neo = "\n<br";
	} else if(str == 'br-') {
	old = /<br[ /]*>/gi;
	neo = "";
	} else if(str == 'nl-') {
	old = /[\r\n]/g;
	neo = "";
	} else if(str == 'lt') {
	old = /&/gi;
	neo = "&amp;";
	old_ = /</gi;
	neo_ = "&lt;";
	old__ = />/gi;
	neo__ = "&gt;";
	} else if(str == 'lt-') {
	old = /&lt;/gi;
	neo = "<";
	old_ = /&gt;/gi;
	neo_ = ">";
	old__ = /&amp;/gi;
	neo__ = "&";
	} else if(str == 'delp') {
	old = /<[/]?p>/gi;
	neo = "";
	} else if(str == 'edtb') {
	$('wrwn').value = 1;
	old = /[\n]/gi;
	neo = "\n<br />";
	old_ = /><t/gi;
	neo_ = ">\r\n<T";
	old__ = /><\/t/gi;
	neo__ = ">\r\n</T";
	} else if(str == 'eddv') {
	old = /><div/gi;
	neo = ">\r\n<DIV";
	old_ = /><\/div/gi;
	neo_ = ">\r\n</DIV";
	} else if(str == 'replace') {
	old = $('replace_a').value;
	if($('regular').checked != true) old = old.replace(/([\(\)\{\}\[\]\.\?\+\*\|\^\$\\])/gi,"\\$1");
	old = new RegExp(old,'gi');
	neo = $('replace_b').value;
	}
if(str.indexOf('br') != -1 ||str.indexOf('br') != -1) $('wrwn').value = 0;
if(str == 'w3c') {
$$('saved',0).value = '';
old__ = obj.value;
old = old__.indexOf('<');
while(old != -1) {
old = old__.indexOf('<');
neo = old__.indexOf('>');
neo_ += old__.substr(0,old);
neo__ = old__.substring(old,neo + 1).replace(/ ([a-z]+)=([^'"> ]+)/gi," $1='$2'");
neo__ = neo__.replace(/ (width|height|cellpadding|cellspacing)='([0-9]+)'/gi," $1='$2px'");
old__ = old__.substr(neo + 1);
old_ = neo__.match(/[<\/ '"]+[-A-Z]+[='": >]/g);
if(old_) {
for(var i=0;i < old_.length;i++) {
neo__ = neo__.replace(new RegExp(old_[i],'g'),old_[i].toLowerCase());
}
}
neo_ += neo__;
}
old__ = neo_ + old__;
neo_ = '';
old = old__.split(/<p>/g);
old_ = old.length;
for(var i=0;i < old_;i++) {
neo_ += old[i].replace(/<\/p>/,"<br />");
}
if(neo_.indexOf('<embed') != -1 && neo_.indexOf('</embed>') == -1) neo_ = neo_.replace(/<embed([^>]+[^\/])>/g,"<embed$1 />");
neo_ = neo_.replace(/<(br|input|img|hr)([^>\/]*)>/g,"<$1$2 />");
if(neo_.indexOf('<textarea') != -1 && neo_.indexOf('</textarea>') == -1) neo_ += "</textarea>";
if(neo_.indexOf('<xmp') != -1 && neo_.indexOf('</xmp>') == -1) neo_ += "</xmp>";
if(neo_.indexOf('<pre') != -1 && neo_.indexOf('</pre>') == -1) neo_ += "</pre>";
<? if($mbr_level != 9){?>neo_ = neo_.replace(/<([\/]?)(script|iframe)/g,"&lt;$1$2");<?}?>
obj.value = neo_.replace(/<(br|hr)>/g,"<$1 />").replace(/<img([^>]+[^\/])>/g,"<img$1 />");
} else {
if($('wzor').value != 'w') {
if(obj.createTextRange && obj.currentPos && obj.currentPos.text) {
	if(str == 'lowcase') obj.currentPos.text = obj.currentPos.text.toLowerCase();
	else if(str == 'upcase') obj.currentPos.text = obj.currentPos.text.toUpperCase();
	else obj.currentPos.text = obj.currentPos.text.replace(old, neo).replace(old_, neo_).replace(old__, neo__);
	obj.focus();
} else if(obj.selectionEnd && obj.selectionStart != obj.selectionEnd) {
	var s1 = obj.value.substring(0, obj.selectionStart);
	var s2 = obj.value.substring(obj.selectionStart, obj.selectionEnd);
	var s3 = obj.value.substring(obj.selectionEnd);
	if(str == 'lowcase') obj.value = s1 + s2.toLowerCase() + s3;
	else if(str == 'upcase') obj.value = s1 + s2.toUpperCase() + s3;
	else obj.value = s1 + s2.replace(old, neo).replace(old_, neo_).replace(old__, neo__) + s3;
} else {
	if(str == 'lowcase') obj.value = obj.value.toLowerCase();
	else if(str == 'upcase') obj.value = obj.value.toUpperCase();
	else obj.value = obj.value.replace(old, neo).replace(old_, neo_).replace(old__, neo__);
}
if(str == 'edtb') seltrans('eddv');
} else obw.document.body.innerHTML = memo(0).replace(old, neo);
}
}

function save_pos(obj) {
try {
if(obj.createTextRange) obj.currentPos = document.selection.createRange().duplicate();
} catch(e) {}
}

function wsghtm() {
<? if($ismobile != 2) {?>
if($('prvw').value == '1') prevw();
oselt = (setop[1] != 'opera')? mtxt():'';
if(oselt) $('replace_a').value = oselt.replace(/[\r\n]/g, "").replace(/<[^>]+>/g, "");
if($('wzor').value == 'w') {
$('wzor').value = 'h';
$('dehtml').innerHTML = 'wswg';
obj.value=obw.document.body.innerHTML.replace(/ sab="[0-9]+">/gi,">").replace(/[\r\n]/g, "").replace(/<\/P><P>/gi, "\n").replace(/<\/div><div>/gi, "\n").replace(/<br>/gi, "\n");
$('html').style.display = 'block';
$('wzwg').style.display = 'none';
$('wsgwin').style.display = 'none';
$('texx').style.display = 'block';
if('<?=$isie?>' == '1') obj.focus();
texresiz($('content'),1);
mmo = false;
} else {
obw.document.body.innerHTML = memo(1);
$('wzor').value = 'w';
$('dehtml').innerHTML = 'html';
$('html').style.display = 'none';
$('wzwg').style.display = 'block';
$('wsgwin').style.display = 'block';
$('texx').style.display = 'none';
if('<?=$isie?>' == '1') obw.focus();
}
if(oselt) {findtxt(2);if(setop[0] != '1') setTimeout("findtxt(2)",100);}
<?}?>
}

function setup() {
if(!obw) obw = $('wsgwin').contentWindow;
<? if($ismobile != 2) {?>
	try
	{
 		var doc = obw.document;
 		doc.designMode = 'On';
 		doc.open();
 		doc.write("<html>");
 		doc.write("<head>");
 		doc.write("<link rel='stylesheet' type='text/css' href='skin/<?=$wdth[2]?>/style.css' />");
 		doc.write("<style type='text/css'>p,div,td {margin:2px} body {font-size:9pt;font-family:Gulim;line-height:120%; white-space:pre-wrap; margin:5px} a, a:link, a:hover, a:visited {text-decoration:underline}</style>");
 		doc.write("<!--[if IE]><style type='text/css'>body {word-break:break-all}</style><![endif]-->");
 		doc.write("</head>");
 		doc.write("<body class='wbody'>");
 		doc.write("</body>");
 		doc.write("</html>");
 		if(obj.value) doc.write(obj.value.replace(/<\/\/textarea>/gi,"</textarea>"));
 		doc.close();
 	}
 	catch(e) {if(!obw) {obw = $('wsgwin').contentWindow;setup();}}
pview = $('pview');
obw.focus();
<? if($ismobile == 3) {?>
wsghtm();
<?} else {?>
if('<?=$iswindows?>' != '1') {wsghtm();wsghtm();}
<?}} else {?>
$('wzor').value = 'h';
$('wsgwin').style.display = 'none';
$('wsgwin').style.height = '0px';
$('texx').style.display = 'block';
<?}?>
sessno = <?=$sessno?>;
$('texx').style.overflowX = 'hidden';
azax("<?=$exe?>?&onload=<?=$time?>&id=<?=($id)?$id:1?>&isvcnct=<?=$isvcnnct?>",9);
setTimeout("repeatt(0)", 15000);
obj.style.overflowX='hidden';
if('<?=$_GET['ct']?>' && document.wform.ct) document.wform.ct.value='<?=$_GET['ct']?>';
rdio = ($('fuplist'))?$('fuplist').getElementsByTagName('li'):'';
<?
if($_POST['edit'] == "edit") {
echo "document.wform.perm_vw.value='{$xxx[0][8]}';";
if($xxx[2] === 'a') echo "document.wform.perm_rp.value='a';";
if($xxx[4] === 'a') echo "document.wform.perm_tb.value='a';";
if($xxx[6][0] === 'a') echo "document.wform.perm_re.value='a';";
}
if($sss[26] == 'd' || $sss[23] === 'a') echo "$('hidden2').style.display = 'block';$('inhidden2').checked = true;";
?>
}

function bysaved() {
if(confirm('임시저장된 내용을 불러옵니까')) {
if($('wzor').value == 'w')  obw.document.body.innerHTML = $$('saved',0).value;
else obj.value = $$('saved',0).value;
} else repeatt(1);
}

function repeatt(n) {
<? if($ismobile != 2) {?>
var param;
if($('wzor').value == 'w') param = obw.document.body.innerHTML.replace(/[\r\n]/g,"");
else param = memo(1);
if(param.length > 10) {
$$('saved',0).value = param;
document.svfm.submit();
$$('saved',0).value = param;
	var today = new Date();
	$('tpsv').innerHTML = "임시저장 <span class='n7'>" + today.getHours() + ":" + today.getMinutes() + "</span>";
	if('<?=$bwr?>' == 'ie6') $('tpsv').style.width = '80px';
}
if(n != '1') setTimeout("repeatt(0)",60000);
<?}?>
}

function ckprohibit(ths) {
var prhbw = new Array(''<?
if($fp=@fopen($dxr."prohibit","r")){
while($fpo = trim(fgets($fp))) echo ",'{$fpo}'";
fclose($fp);
}
?>);
for(var i=prhbw.length -1;i > 0;i--) {
if(ths.indexOf(prhbw[i]) != -1) return prhbw[i];
}}
function sbmt() {
azax("<?=$exe?>?&id=<?=$id?>&iswtp=1","cnw = ajax");
if(cnw != "b") setTimeout("sbmt()",200);
else sbmt2();
}
function sbmt2() {
var proh;
if(document.wform.antispam && document.wform.antispam.readOnly == false) alert("스팸 방지 코드를 넣으세요");
else {
if(document.wform.ct.value == '00') alert("'분류'를 선택하세요");
else {
repeatt(1);
if($('wzor').value == 'w') wsghtm();
else if($('wrwn').value == 1) obj.value=obj.value.replace(/[\r\n]/g, "");
if(obj.value == '') alert("'본문'이 비었습니다.");
else if(btype != 'd' && document.wform.subject.value == '') alert("'제목'이 비었습니다.");
else {
<? if((int)$sett[85] > 0 && $mbr_level < $sett[87]) {?>
var over = strbyte(obj.value) - <?=$sett[85]*1024?>;
if(over > 0) {alert('내용이 너무 깁니다. (' + over + 'byte 초과)');return false;}
<?}?>
if(btype != 'd') proh = ckprohibit(document.wform.subject.value);
if(proh) alert("제목에 금지단어 '"+proh+"'가 들어 있습니다");
else {
proh = ckprohibit(document.wform.content.value);
if(proh) alert("내용에 금지단어 '"+proh+"'가 들어 있습니다");
}
if(!proh) {
$('gout').value='3';
if(document.wform.tb_url.value=='http://') document.wform.tb_url.value = '';
if(document.wform.tb_link.value=='http://') document.wform.tb_link.value = '';
if(document.wform.wf_link5.value=='http://') document.wform.wf_link5.value = '';
<? if($isie == 1 || $bwr == 'opera') {?>
seltrans('w3c');
<?} if($isie == 1) {?>
obj.value = obj.value.replace(/<a ([^>]+) target='_blank'>/gi,"<a target='_blank' $1>");
obj.value = obj.value.replace(/<a href=/gi,"<a target='_blank' href=");
<?}?>
obj.value = obj.value.replace(/[\r]?\n/g,"<br />");
<? if($mbr_no <= 0) {?>
if(document.wform.name.value == '') alert("'이름'이 비었습니다");
else if(document.wform.pass.value == '') alert("'비밀번호'가 비었습니다");
else if(document.wform.pass.value.match(/[^0-9a-z]/i)) alert("'비밀번호'는 영문숫자만");
else 
<?}?>if($('ckdouble').value == obj.value) alert("중복된 내용입니다");
else document.wform.submit();
}}wsghtm();}}}

<?
if($mbr_level) {
?>
function checkmemo(val) {
var mdiv = $('check_memo');
var iscmm = 1;
if(!mdiv) {mdiv = $('img');iscmm = 2;}
if(val == 'new_memo') {
<?
if($sett[52] > 1 && $sett[57] != 'a' && $sett[57] <= $mbr_level) {
?>
var alertt = "";
if(iscmm == 1 && ('<?=$sett[52]?>' == '2' || '<?=$sett[52]?>' == '3' || '<?=$sett[52]?>' == '5' || '<?=$sett[52]?>' == '6')) alertt += "<a name='is_memo' onclick=\"read('get');this.parentNode.innerHTML='';\"><b>[쪽지가 도착했습니다]</b></a><br />";
if('<?=$sett[52]?>' == '3' || '<?=$sett[52]?>' == '4' || '<?=$sett[52]?>' == '6') alertt += "<embed src='icon/memo' type='application/x-mplayer2' autostart='true' loop='0' style='width:1px;height:1px' />";
if(parseInt('<?=$sett[52]?>') >= 4) read('get');
mdiv.innerHTML = alertt;
location.replace =(location.href + '#is_memo');
mdiv.parentNode.style.display = 'block';
<?}?>
} else if(iscmm == 1 && mdiv.innerHTML != '') mdiv.innerHTML = '';
setTimeout('azax("<?=$exe?>?&check_memo=<?=$time?>&id=1&isvcnct=<?=$isvcnnct?>",9)',30000);
}
<?}?>

if("<?=$_POST['edit']?>") document.title = "글수정 - <?=$bdidnm[$id]?>";
else document.title = "글쓰기 - <?=$bdidnm[$id]?>";
setTimeout("setup()",100);
setTimeout("if(!sessno) setup()",300);
setTimeout("if(!sessno) setup()",800);
setTimeout("if(!sessno) setup()",1500);
function wcancel() {
if(confirm('이 페이지를 벗어나시겠습니까','')){
if(ufdell()) {
$('gout').value='2';
setTimeout("rplace('<?=$dxpt?>&amp;no=<?=$_POST['no']?>&amp;p=1')",200);
}}}
function ufdell() {
if(updoc) {
var delf = '';
if('<?=$_GET['write']?>' == 'new') {
if(rdio[0].innerHTML) {
for(var i=rdio.length-2;i >= 0;i--) {
delf += rdio[i].firstChild.value + "^^";
}
if(delf != '') {
$('fuplist').innerHTML = '';
updoc.document.delup.delfile.value = "^^" + delf;
}}} else updoc.document.delup.delfile.value = '';
updoc.document.delup.dxess.value = '3';
updoc.document.delup.submit();
if(delf != '') alert("업로드한 파일은 전부 삭제되었습니다\n");
} else {
$$('saved',0).value = 'dxess';
document.svfm.submit();
}
return true;
}
window.onbeforeunload = function(){
var goux = $('gout').value;
if(goux != '3') {
repeatt(1);
$('gout').value = '3';
if(goux != '2') {
ufdell();
return "\n \n";
}}}
window.onunload = function(){window.onbeforeunload();}
//]]>
</script>
</body>
</html>