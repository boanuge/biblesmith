
var wwin;
var siht;
var tath;
var brwsrw = document.documentElement.clientWidth;
var thtck;
var sessno;
var tpn = 0;
var nwx = 0;
var tabchng = 0;
var newxchng;
var inty = 10;
var intx = 20;
var x, y;
var ekc = 1;
var ajax = '';
var px, py;
var ry = '';
var pretxt = new Array();
var newtxt = new Array();
var ajaxx;
var isazax = '';
var stopt = 0;
var stopn = 0;
var exmus;
var pview;
var isopo;
var ctrk = false;
var cnw = '';
var ajaxbusy = 0;
var mdiv;

function $(id) {return document.getElementById(id);}

function keydow(e) {
if(setop[0] == '2') {ekc = e.which;ctrk = e.ctrlKey;}
else if(setop[0] == '1') {ekc = event.keyCode;ctrk = event.ctrlKey;}
if(ctrk && window.keyctrl) keyctrl();
return ekc;
}

function mouseclicked(e) {
var etype;
if(setop[0] == '1') {exmus = event.srcElement;etype = event.type;}
else {exmus = e.target;etype = e.type;}
var ename = exmus.name;
if(!ename) ename = exmus.className;
if(exmus.tagName.toLowerCase() == 'a' && ename && ename.substr(0,2) == 'pv') {
if(etype == 'mouseover') {
if(ename.substr(2,1) == 'x') preview(exmus,ename.substr(2));
else preview(ename.substr(2),'');
} else preview();
}}

function mousemov(e){
if(pview) {
  if(setop[0] == '2'){
   y = e.pageY;
   x = e.pageX;
	} else if(setop[0] == '1'){
   y = event.clientY + scrbody(1);
   x = event.clientX + scrbody(2);
	}
if(wopen == 3 && eval(pview) && eval(brwsrw)) {
var pvsw = parseInt(pview.style.width) + 30;
pview.style.top  = y + inty + 'px';
if(x + intx + pvsw > brwsrw) pview.style.left = brwsrw - pvsw + scrbody(2) + 'px';
else pview.style.left = x + intx + 'px';
} else pview = $("pview");
if(ry != '' && window.resizeheight) resizeheight(x,y);
}}

document.onmousemove = mousemov;
document.onkeydown = keydow;
document.onkeyup = keydow;
document.onmouseover = mouseclicked;
document.onmouseout = mouseclicked;

function imgview(sur, im, swth, fno) {
var imgee = $('img');
if(sur == 0) {
inty = 10;
intx = 20;
wopen = 1;
imgee.style.display = 'none';
if($('curtain')) $('curtain').style.display='none';
} else {
if(wopen == 2) imgview(0);
if(im) {
if(im == 4 || im == 5) imgee.style.top = y + 10 + 'px';
else {imgee.style.top = y - 10 + 'px';if(im==9) sur=sur.replace(/m20/,"m80");}
imgee.style.left = x + 15 + 'px';
} else imgee.style.top = scrbody(1) + 100 + 'px';
if(im == 4 || im == 5) {
if(!swth) swth = setop[2];
var cwth = document.documentElement.clientWidth - swth - 20;
if(cwth <  x) imgee.style.left = cwth + 'px';
if(im == 5) sur = sur + "&amp;scroll=1";
sur = "<iframe class='img nobgcolor' src='" + sur + "' style='width:" + swth + "px;height:" + swth + "px;background-color:#FFFFFF' frameborder='0'></iframe>";
if(im == 5) {
setTimeout("imgview(\"" + sur + "\",6,0)",400);
px = x;
py = y;
im = 8;
}}
if(im != 8) {
if(im == 6) {if(-6 < px-x && px-x < 6 && -6 < py-y && py-y < 6){imgee.innerHTML = sur;im = 7;}}
else if(im == 2 || im == 4) imgee.innerHTML = sur;
else if(im != 5) {
var imgin = "";
if(!im) {
if(sur.indexOf('exe.php?id=' + setop[6]) != -1) {imgin = "<a target='exe' href='" + sur + "&amp;fno=" + fno + "&amp;down=1' onclick='imgview(0)'>다운로드</a>";}
imgee.innerHTML = "<table cellspacing='1px' cellpadding='0' id='imgopen'><tr><th><input type='button' value='이동' onmousedown='wopen=1;ry=$(\"img\");px=Array(x,x-40);py=Array(y,y-10);' onmouseup='ry=\"\";px=0;py=0' /></th><th>" + imgin + "</th><th><a target='_blank' href='" + sur + "' onclick='imgview(0)'>새창으로</a></th><th><input type='button' value='닫기' onclick='imgview(0)' /></th></tr><tr><td colspan='4' style='padding-top:3px'><img onclick='imgview(0)' class='img' src='" + sur + "' onload='imglocat(this)' alt='' /></td></tr></table>";
if($('curtain')) $('curtain').style.display='block';
} else imgee.innerHTML = imgin + "<img onclick='imgview(0)' class='img' src='" + sur + "' alt='' />";
}
if(im != 6) {
imgee.style.display = 'block';
setTimeout('wopen = 2',100);
}}}
if(im != 8) {px = 0;py = 0;}
}

function preview(no, xx, pww) {
if(pview) {
$("img").style.display = 'none';
pview = $('pview');
if(xx == 'xz') {no = no.innerHTML + '<br />' + no.parentNode.nextSibling.innerHTML;xx = 'xx';}
else if(xx == 'xy') {no = no.innerHTML;xx = 'xx';}
inty = 10;
intx = 20;
	if(no) {
	wopen = 3;
	if(pww) pview.style.width = pww + 'px';
	if(xx == 'xx') pview.innerHTML = no;
	else pview.innerHTML = pretxt[no];
	if(xx == 'xx' || pretxt[no]) {if(x || y) {
	if(setop[0] == '1') pview.style.filter = 'alpha(opacity=94)';
	else pview.style.opacity = '.94';
	pview.style.top=y+10 +'px';pview.style.left=x+20 +'px';pview.style.display = 'block';
	}}} else {
	wopen = 1;
	pview.style.width = setop[3] +'px';
	pview.innerHTML = "";
	pview.style.display = 'none';
}}}

function opeclo(A) {
if($(A).style.display == 'none') {
$(A).style.display = 'block';
if(A == 'tag') $(A).contentWindow.location.replace('include/tag.php?id=' + setop[6] + '&tag=1');
}
else $(A).style.display = 'none';
}

function wwname(mane,no,targ,url,is80) {
$("img").style.display = 'none';
var namee = "<div class='prev' id='wname' style='display:block;'>";
if(no > 0) {
if(is80 == '1') namee += "<div><img src='icon/m80_" + no + "' class='pu80' /></div>";
if(setop[6] != '') {
namee += "<div><a href='javascript:;' onclick='" + targ.substr(1) + ".locato(\"m\"," + no + ")'><span>■</span> 게시판검색</a></div>";
namee += "<div><a href='javascript:;' onclick='" + targ.substr(1) + ".locato(\"c\"," + no + ")'><span>■</span> 덧글검색</a></div>";
}
if(setop[5] == '1') namee += "<div><a href='#none' onclick=\"send('memo', '" + no + "','" + mane + "')\"><span>■</span> 쪽지보내기</a></div>";
if(setop[4] == '1') namee += "<div><a href='#none' onclick=\"send('mail', '" + no + "','" + mane + "')\"><span>■</span> 메일보내기</a></div>";
namee += "<div><a href='member.php?mno=" + no + "' target='_blank'><span>■</span> 회원로그</a></div>";
} else if(setop[6] != '') {
namee += "<div><a href='javascript:;' onclick='" + targ.substr(1) + ".locato(\"keyword\",\"" + mane + "\",\"&amp;search=n\")'><span>■</span> 게시판검색</a></div>";
namee += "<div><a href='javascript:;' onclick='" + targ.substr(1) + ".locato(\"keyword\",\"" + mane + "\",\"&amp;search=r\")'><span>■</span> 덧글검색</a></div>";
}
if(url) namee += "<div><a target='_blank' href='" + url + "'><span>■</span> 홈페이지</a></div>";
namee += "</div>";
imgview(namee,2);
}

function imglocat(ths) {
$('img').style.left = (setop[0] == '1')?(parseInt(window.document.documentElement.clientWidth)-parseInt(ths.width))/2+'px':(parseInt(window.innerWidth)-parseInt(ths.width))/2+'px';
}

function popup(url, wt, ht, iee) {
if(iee && setop[0] != '1') return false;
else url = url.replace(/&amp;/g,"&");
setTimeout('if(!wwin) {if(confirm("팝업이 차단되어 있습니다. 새창으로 띄우시겠습니까")) nwopn("' + url + '");}',500);
if (setop[0] == '1') {
var pten = (setop[1] == 'ie6')? 8:0;
wt = wt + 7 + pten;
ht = ht + 27 + pten;
if(!iee || iee == '0') url = 'admin.php?fram='+url;
wwin = window.showModelessDialog(url, window,  'dialogWidth:'+ wt +'px;dialogHeight:'+ ht +'px; resizable:Yes; center:Yes; status:No; help: No; scroll:' + ((iee)?'Yes':'No') +'; center:Yes');
} else {
wt += 7;
ht += 26;
wwin = window.open(url,'_blank','location=no,resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,width='+ wt +'px,height='+ ht +'px,left='+ ((screen.width - wt) / 2) +'X,top='+ ((screen.height - ht) / 2) +'Y');
}
if(wwin) wwin.focus();
}

function send(mm, no, to) {
popup('exe.php?send='+mm+'&no='+no+'&to='+to,310,250,0);
}

function read(read) {
if(read == 'get'||read == 'post') popup('exe.php?memo='+read,400,300,0);
else popup(read,850,650,0);
}

function locato(wher,val,rest) {
if(!rest) rest = '';
if(wher != 'p' && (!rest || rest.indexOf('p=') == -1)) rest = rest + '&amp;p=1';
var what = 1;
var dcloc = location.search.slice(1).replace(/[&]no=[^&]*/gi,'').replace(/[&]p=[^&]*/gi,'');
var pwher = dcloc.indexOf('&'+wher+'=');
if(pwher != -1) {
pwher = dcloc.substr(pwher + wher.length + 2);
if(pwher.indexOf('&') != -1) pwher = pwher.substr(0,pwher.indexOf('&'));
else if(pwher.indexOf('#') != -1) pwher = pwher.substr(0,pwher.indexOf('#'));
if(pwher == val) what = 2;
pwher = new RegExp('&'+wher+'=[^&]*','gi');
dcloc = dcloc.replace(pwher,'');
}
if(what == 1) dcloc += '&' + wher + '=' + val;
rhref('?' + dcloc + rest);
}

function opencal(ths) {
var targt = $('calendar').getElementsByTagName('ul');
for(var i=targt.length -1;i >= 0;i--) {
if(targt[i].parentNode == ths) targt[i].className = 'onload';
else targt[i].className = '';
}}

function xcroll(tht, thv) {
if(ekc == 13 ||ekc == 8 ||ekc == 46) {
if(setop[0] == '2' && setop[1] == '' && ekc != 13)  tht.style.height = thv + 'px';
var tch=tht.scrollHeight;
if(setop[1] == 'chrome') tch -= 20;
if(tch > thv) {
if(ekc == 13) {tht.style.height=tch + 14 + 'px';return true;}
else if(ekc == 8 ||ekc == 46) {tht.style.height=tch + 'px';return true;}
}
}
}

function startax(param) {
if(ajaxbusy == 1) setTimeout("startax(\"" + param + "\")",100);
else {ajaxbusy = 1;
var srbhttp = false;
try {srbhttp = new XMLHttpRequest();}
catch(e) {try {srbhttp = new ActiveXObject("Msxml2.XMLHTTP");}
catch(e) {try {srbhttp = new ActiveXObject("Microsoft.XMLHTTP");}
catch(e) {return false;}}}
if(srbhttp) {
param = param.replace(/%/g,"%25").replace(/\+/g,"%2B") + "&ajax=1";
srbhttp.open("POST", param, true);
srbhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
srbhttp.onreadystatechange = function(){
if(srbhttp.readyState=='4' && srbhttp.status=='200') {
	ajaxbusy = 0;
	ajax = srbhttp.responseText;
	delete srbhttp;
}}
srbhttp.send(param);
}}}

var azx1 = false;
var azx2 = false;
function azax(param,gkatn) {
if(param) {
if(isazax || ajax) {
if(azx1 != false && azx1 != param) {azx2=param;setTimeout("azax(azx2,\""+gkatn+"\")",600);}
else {azx1=param;setTimeout("azax(azx1,\""+gkatn+"\")",300);}
} else {
if(azx1==param) azx1 = false;
isazax = gkatn;
ajax = 'azax';
startax(param);
azax();
}} else if(ajax == 'azax') setTimeout("azax()",30);
else if(ajax != '') {
if(isazax) {
if(typeof(isazax) == 'number' && isazax == 9) eval(ajax);
else eval(isazax);
isazax = '';
}
ajax = '';
}}

function scrbody(n) {
if(n == 1) var val = (setop[1] == 'chrome')? document.body.scrollTop:document.documentElement.scrollTop;
else var val = (setop[1] == 'chrome')? document.body.scrollLeft:document.documentElement.scrollLeft;
return val;
}

function chbase(str) {
var str_1 = '';
var str_2 = '';
for(var i=str.length -1;i >= 0;i--){
str_1 += (str.charCodeAt(i) + sessno).toString(34);
}
for(var i=str_1.length -1;i >= 0;i--){
str_2 += (str_1.charCodeAt(i)).toString(18);
}
return str_2;
}
function convertbase(ths) {
if(sessno === '') {if(confirm("새로고침이 필요합니다. 새로고침하시겠습니까")) location.reload();else return false;}
if(ths.username||ths.password) {
ths.username_3.value = chbase(ths.username.value);
ths.password_3.value = chbase(ths.password.value);
ths.username.value = '';
ths.password.value = '';
}
ths.submit();
}
function nwopn(purl){
if(!window.open(purl,'_blank')) {
var ok = 1;
/*
if(exmus.tagName.toLowerCase() == 'a') {
exmus.target = '_blank';
ok = ((exmus.href = purl))? 2:1;
}
*/
if(ok == 1 && confirm('팝업이 차단되었습니다.페이지 이동하시겠습니까')) location.replace(purl);
}}
function rplace(purl){
location.replace(purl.replace(/amp;/g,''));
}
function rhref(purl){
location.href=purl.replace(/amp;/g,'');
}
/*
function scrmv(mvid,mgt,sto) {
var pst = parseInt($(mvid).style.top);
var gap = scrbody(1) + mgt;
if(gap != pst) $(mvid).style.top = gap + 'px';
setTimeout("scrmv('"+mvid+"',"+mgt+","+sto+")",sto);
}
*/

function fthsn(prnt,son) {
son = document.getElementsByName(son);
var retn;
var ppt;
for(var i = son.length -1;i >= 0;i--) {
ppt = son[i];
do {
if(ppt == prnt) {retn = son[i];break;break;}
} while((ppt = ppt.parentNode) && ppt.tagName.toLowerCase() != 'body');
}
return retn;
}
function $$(a,b) {
var rt = document.getElementsByName(a)[0];
if(b != 0 || b != '') rt = fthsn(rt,b);
return rt;
}
function IE6png(obj) {
    obj.width=obj.height=1;
    obj.className=obj.className.replace(/pngEX/i,'');
    obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image')";
    obj.src='icon/t.gif';
}
function lgnpt(ths,i,n) {
if(!ths.value) {
var tcs = (i == 2)? "i140 ":"i93 ";
tcs += (n == 2)? ths.name:"userbc";
ths.className = tcs;
}}
function img_resize() {
var rszimg = document.getElementsByName('img580');
if(rszimg) {
for(i=rszimg.length -1; i >= 0; i--) {
if(rszimg[i].width > setop[7]) rszimg[i].style.width = setop[7] +'px';
rszimg[i].style.cursor = 'pointer';
}}
isopo = 1;
}
function toggle(tog) {
if(tog) tog.style.display = (tog.style.display == 'block')?'none':'block';
}
function chkatcode(nmr,rmn) {
if(rmn == 1) {
if(ajax == 'a') {
siht.nextSibling.innerHTML = "입력한 값이 맞습니다.";
siht.style.background = "";
siht.readOnly = true;
if(document.body.className == 'cbody') document.cookie = "spmnumber=" + siht.value + siht.previousSibling.src.substr(siht.previousSibling.src.indexOf('=')+1);
} else if(ajax == 'b') {
siht.nextSibling.innerHTML = "입력한 값이 틀렸습니다.";
siht.style.background = "#FF6600";
}} else {
siht = rmn;
azax('exe.php?&antispam=' + rmn.value + '&pno=' + nmr,'chkatcode(ajax,1)');
}}
document.onclick = function() {
ry='';px=0;py=0;
if(wopen == 2) imgview(0);
}
function isnotiff(val) {
if(val.indexOf("#") > 0) {
mdiv = $('check_memo');
if(!mdiv) mdiv = $('img');
mdiv.parentNode.style.display = 'block';
val = val.split("#");
var valen = val.length - 1;
var alertt = "<a onclick='this.nextSibling.style.display=(this.nextSibling.style.display==\"block\")? \"none\":\"block\"' onmouseover='this.nextSibling.style.display=(this.nextSibling.style.display==\"block\")? \"none\":\"block\"'><b>새로운 덧글이 " + valen + "개 있습니다<\/b><\/a><div class='iscmtnt' onclick='this.style.display=\"none\"' style='margin-left:" + ((mdiv.offsetWidth - 200)/2) + "px'>";
var idnocc;
for(var i = valen - 1;i >= 0; i--) {
if(val[i] != '') {
idnocc = "id=" + val[i].substr(0,10).replace(/\s/g,"") + "&amp;no=" + parseFloat(val[i].substr(10,6));
alertt += "&bull; &nbsp;<a href='index.php?" + idnocc + "&amp;cc=" + val[i].substr(16,7) + "'>" + idnocc + "<\/a><br \/>";
}}
mdiv.innerHTML = mdiv.innerHTML + alertt + "&bull; &nbsp;<a href='#none' onclick='startax(\"exe.php?&notifx=1&id=1\");mdiv.innerHTML=\"\"'><b>덧글 알림 삭제<\/b><\/a><br \/><\/div>";
}}
function strbyte(str) {
var abc = (str.length*9 - encodeURIComponent(str).length)/8;
return (str.length - abc)*3 + abc;
}