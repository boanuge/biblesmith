
function replax() {
var xx = document.guest_;
var cont = $$('guest_','wcontent');
if($$('guest_','antispam') && $$('guest_','antispam').readOnly == false) {alert('스팸 방지 코드를 넣으세요.');return false;}
if(((xx.name.value && xx.pass.value) || (!$$('guest_','name') && !$$('guest_','pass'))) && cont.value) {
var doc = cont.value.replace(/([\n\s])http:\/\/([^"'<>\r\n\s]+)\.(jpg|gif|png|jpeg)/gi, "$1<img src='http://$2.$3'>");
doc = doc.replace(/([\n\s])http:\/\/([^"'<>\r\n\s]+)/gi, "$1<a href='http://$2'>http://$2</a>");
var proh = ckprohibit(doc);
if(proh) alert('금지단어 "' + proh + '"가 들어 있습니다');
else document.guest_.submit();
} else alert('빈 칸이 있습니다');
}