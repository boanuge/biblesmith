var sxx = document.getElementsByName('ixx');
var sel = document.getElementsByName('cart');
var i;
function choice(){
var sx = rtsxv();
if(sx === 'a') sx = 0;
var sxv = sxx[sx].value;
var ctf = true;

for(i = 0; i < sel.length; i++){
if(sxx[i].value == sxv) {
if(sel[i].checked == true) ctf = false;
else if(sel[i].checked == false) {ctf = true;break;}
}
}
for(i = 0; i < sel.length; i++){
if(sxx[i].value == sxv) sel[i].checked = ctf;
else sel[i].checked = false;
}
document.adselect.xx.value = sxv;
}
function uchoice(that) {
var sxv = that.nextSibling.value;
document.adselect.xx.value = sxv;
for(i = 0; i < sel.length; i++){
if(sxx[i].value != sxv) sel[i].checked = false;
}
}
function choiced(chn){
var excv = document.adselect.exc.value;
if(excv.substr(0,7) == 'modify_') {
document.adselect.submit();
} else if(chn == '0' && (excv == 'change' || excv == 'move' || excv == 'copy' || excv == 'limit' || excv == 'add_tag' || excv == '')) {
document.adselect.changeto.style.display = (excv == 'change')? 'block':'none';
document.adselect.moveto.style.display = (excv == 'move' || excv == 'copy')? 'block':'none';
document.adselect.perm_vw.style.display = (excv == 'limit')? 'block':'none';
$('addtagdv').style.display = (excv == 'add_tag')? 'block':'none';
} else if(excv == 'deletect') {
if(confirm('이 범주의 모든 게시물을 삭제하시겠습니까')) rplace(document.location.href + '&deletect=1');
} else {
var xx = 1;
if(chn != 'delete_ct') {
if(excv == 'delete') xx = confirm('선택한 게시물을 삭제하시겠습니까');
else if(excv == 'delete_rp') xx = confirm('선택한 게시물의 덧글을 삭제하시겠습니까');
else if(excv == 'delete_body') xx = confirm('선택한 게시물의 본문을 삭제하시겠습니까');
}
if(xx) {
var selected = "";
var sxv = sxx[rtsxv()].value;
for(i = 0; i < sel.length; i++){
if(sel[i].checked == true && sel[i].value !='' && sxx[i].value == sxv) selected += sel[i].value + ":";
}
document.adselect.selected.value = selected;
document.adselect.xx.value = sxv;
if(selected) document.adselect.submit();
} else document.adselect.exc.value = "";
}
}
function rtsxv() {
var ii = 'a';
for(i = 0; i < sel.length;i++){
if(sel[i].checked == true) {ii = i;break;}
}
return ii;
}