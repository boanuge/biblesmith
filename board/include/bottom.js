
function fpass(edit, mno, no, xx, fx, pno, id) {
	if(edit && (document.passe.style.display == 'none' || fx == 'x')) {
	if(mno >= 3) {
	if(fx != 'x' && (edit != 'edit' || mno != 4)) $('curtain').style.display='block';
	var varray = new Array();
	varray['edit'] ='수정';
	varray['delete'] ='삭제';
	varray['unlock'] ='잠금해제';
	varray['disclose'] = '잠금해제';
	varray['del_reple'] = '리플삭제';
	varray['del_stb'] = '트랙백삭제';
	varray['del_rtb'] = '트랙백삭제';
	varray['del_guest'] = '방명록삭제';
	document.passe.editt.value = varray[edit];
	document.passe.edit.value = edit;
	document.passe.action = 'exe.php';
	document.passe.no.value = no;
	if(pno) document.passe.pno.value = pno;
	if(xx) document.passe.xx.value = xx;
	if(id) document.passe.id.value = id;
	if(edit == 'edit' && mno == 4) {$$('passe',0).submit();return;}
	else if(mno == 4) $$('passe',0).getElementsByTagName('td')[0].style.display = 'none';
	else $$('passe',0).getElementsByTagName('td')[0].style.display = 'block';
	if(fx != 'x') {
	document.passe.style.left = (document.documentElement.clientWidth - 250)/2 + 'px';
	document.passe.style.top = scrbody(1) + (document.documentElement.clientHeight - 90)/2 + 'px';
	document.passe.style.display = 'block';
	}} else if(fx == 'x') return 'x';else if(mno == 2) alert("글쓴이가 아닙니다");else if(mno == 0) alert("변경할 수 있는 시간이 지났습니다");
	} else {
	document.passe.edit.value = '';
	document.passe.style.display = 'none';
	$('curtain').style.display='none';
	}
}
function ffpass(tht, no, xn) {
	var fx = fpass('unlock',3,no,xn,'x','','');
	if(fx != 'x') {
	$(tht).innerHTML = "<form method='post' action='exe.php' style='width:250px;text-align:center'>" + document.passe.innerHTML + "</form>";
	}
}
function scrap(xn, nx) {
nwopn('admin.php?id=' + setop[6] + '&xx=' + xn + '&scrap=' + nx);
}
function vote(ox, xn, nx, iyd) {
if(!iyd) iyd = setop[6];
var ok = 1;
if(ox == 1) ok=confirm("이 게시물을 추천하시겠습니까?");
else if(ox == 2) ok=confirm("이 게시물을 비추하시겠습니까?");
else if(ox == 3) ok=confirm("이 게시물을 신고하시겠습니까?");
if(ok) {
azax('exe.php?&id=' + iyd + '&vote=' + nx + '&apop=' + ox + '&xx=' + xn,9);
}}
function prohsbmt(form) {
var proh = ckprohibit(form.content.value);
if(proh) {alert('금지단어 "' + proh + '"가 들어 있습니다');
} else form.submit();
}
function rpmd(cc, mno, content, cup, id, xx, cb, ulink) {
	if(document.mdrp.style.display == 'none'){
	if(mno >= 3) {
	$('curtain').style.display='block';
	content = content.innerHTML.replace(/<br[ \/]*>/gi, "\r\n");
	content = content.replace(/<br [^>]+>/gi, "\r\n");
	if(mno == 4) $$('mdrp',0).getElementsByTagName('td')[0].style.display = 'none';
	else $$('mdrp',0).getElementsByTagName('td')[0].style.display = 'block';
	document.mdrp.content.value = content;
	if(ulink) document.mdrp.link.value = ulink;
	document.mdrp.edit.value = "modify_rp";
	document.mdrp.cc.value = cc;
	if(id) document.mdrp.id.value = id;
	if(cb == '1') document.mdrp.rsecrt.checked = true;
	else document.mdrp.rsecrt.checked = false;
	if(xx) document.mdrp.xx.value = xx;
	if(id == '' && cup == 'guest') {
	document.mdrp.target = '_self';
	document.mdrp.action = '?';
	$('mdrpt_1').innerHTML = '방명록 수정';
	$('mdrpt_2').value = '방명록수정';
	}
	document.mdrp.style.left = (document.documentElement.clientWidth - 500)/2 + 'px';
	document.mdrp.style.top = scrbody(1) + (document.documentElement.clientHeight - 330)/2 + 'px';
	document.mdrp.style.display = 'block';
	} else if(mno == 2) alert("글쓴이가 아닙니다");
	else if(mno == 0) alert("변경할 수 있는 시간이 지났습니다");
	} else {
	document.mdrp.edit.value = '';
	document.mdrp.style.display = 'none';
	$('curtain').style.display='none';
	}
}
function tabview(ths) {
var tpc = ths.parentNode.childNodes;
var j = tpc.length;
var tablist;
for(var i=0;i < j;i++) {
if(tpc[i].className) {
tablist = $("tablist_" + tpc[i].id.substr(8));
if(tablist) {
if(tpc[i] == ths) {
tablist.className = "tab_list tlisto";tpc[i].className = "tab_head theado";
} else {
tablist.className = "tab_list tlistx";tpc[i].className = "tab_head theadx";
}}}}}

var thigh = Array();
function tabthigh() {
var tablist;
var tpc;
var ods;
var j = 0;
for(var k=1;k <= tpn;k++){
if(!thigh[k]) thigh[k] = 0;
tpc = $('tpn_' + k).childNodes;
j = tpc.length;
var next = 0;
for(var i=0;i < j;i++) {
if(tpc[i].className) {
tablist = $("tablist_" + tpc[i].id.substr(8));
if(tablist) {
ods = tablist.style.display;
tablist.style.display = "block";
if(thigh[k] < tablist.scrollHeight) thigh[k] = tablist.scrollHeight;
tablist.style.display = ods;
}}}
for(var i=0;i < j;i++) {
if(tpc[i].className) {
tablist = $("tablist_" + tpc[i].id.substr(8));
if(tablist) {
if(thigh[k] != 0 && thigh[k] >= tablist.scrollHeight) {tablist.style.height = thigh[k] + 'px';}
}}}}
setInterval("tabrotate()", tabchng);
}
if(tabchng !== 0) tabthigh();
function tabrotate() {
var tablist;
var tpc;
var j = 0;
for(var k=1;k <= tpn;k++){
if(k == stopt) continue;
if(!thigh[k]) thigh[k] = 0;
tpc = $('tpn_' + k).childNodes;
j = tpc.length;
var next = 0;
for(var i=0;i < j;i++) {
if(tpc[i].className) {
tablist = $("tablist_" + tpc[i].id.substr(8));
if(tablist) {
if(next == 0 && tpc[i].className == "tab_head theado") {
tablist.className = "tab_list tlistx";tpc[i].className = "tab_head theadx";next = i + 1;
}}}}
if(next + 1 == j || !tpc[next]) next = 0;
if(!tpc[next].id) next++;
tablist = $("tablist_" + tpc[next].id.substr(8));
tablist.className = "tab_list tlisto";tpc[next].className = "tab_head theado";
}}

function newxrotate() {
var newx5t = '';
var newxx = '';
var newx60 = 0;
var newx61 = 0;
for(var ii = 1;ii <= nwx; ii++) {
if(ii == stopn) continue;
var newx6g=$('newx6_' + ii).getElementsByTagName('input');
if(newx6g[0]) {
newx60 = parseInt(newx6g[0].value);
newx61=newx6g.length + newx60;
for(var i=newx60;i < newx61; i++) {if($('newxi_' + ii).value == i) {if(i >= newx61 -1) newx5t += "newx(" + newx60 + ");";else newx5t += "newx(" + (i + 1) + ");";}}
}}
eval(newx5t);
}
function newx(iii) {
if(newtxt[iii] && newtxt[iii][7]) {
var nt0 = (newtxt[iii][0])?"<a href='" + newtxt[iii][5] + "'><img src='" + newtxt[iii][0] + "' class='gthumb_100' alt='' /></a>":"";
$('newx2_' + newtxt[iii][7]).innerHTML = nt0;
$('newx3_' + newtxt[iii][7]).innerHTML = "<div class='newx_4'><input type='hidden' id='newxi_" + newtxt[iii][7] + "' value='" + iii + "' /><a href='" + newtxt[iii][5] + "'>" + newtxt[iii][1] + "</a></div>" + newtxt[iii][4] + "<div class='newx_5'>by " + newtxt[iii][2] + " | comments " + newtxt[iii][3] + " | " + newtxt[iii][6] + "</div>";
var newx6g=$('newx6_' + newtxt[iii][7]).getElementsByTagName('img');
var newx6a=$('newx6_' + newtxt[iii][7]).getElementsByTagName('a');
if(newx6g && newx6g.length) for(var ii=newx6g.length -1;ii >= 0; ii--) {if(newx6g[ii].name == 'newxe') {if(newx6g[ii] == document.getElementsByName('newxe')[iii]) {newx6g[ii].className='gthumb_100 gthumb_100h';if(newx6a[ii].href == '') newx6a[ii].href = newtxt[iii][5].replace(/amp;/g,'');} else newx6g[ii].className='gthumb_100';}}
else for(var ii=newx6a.length -1;ii >= 0; ii--) {if(newx6a[ii].className.substr(0,3) == 'lnk') {if(newx6a[ii].href.substr(newx6a[ii].href.indexOf("?")).replace(/&/g,"&amp;") == newtxt[iii][5]) newx6a[ii].className='lnk gthumb_100h'; else newx6a[ii].className='lnk';}}
}}