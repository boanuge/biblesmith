<?
if($sett[61] && ($_POST['join'] ||$_GET['signup'])) {
echo "<script type='text/javascript'>alert('신규 회원가입 중지되었습니다.');location.replace('{$_SERVER['HTTP_REFERER']}');</script>";
exit;
}
function rtchecked($val) {
if($val && $val != '0') return "checked='checked'";
else return "";
}
function mkbirthday($birth) {
global $time;
$inht = "<select name='birthday[]' onchange='if(this.nextSibling.value)if(this.nextSibling.nextSibling.value){thtck=this.nextSibling.nextSibling;ischeck(4,1);}'><option value=''>year</option>";
for($i=date("Y",$time);$i > 1899;$i--) if(substr($birth,10,4) == $i) $inht .= "<option value='{$i}' selected='selected'>{$i} 년</option>";else $inht .= "<option value='{$i}'>{$i} 년</option>";
$inht .= "</select><select name='birthday[]' onchange='if(this.nextSibling.value)if(this.previousSibling.value)thtck=this.nextSibling;ischeck(4,1);'><option value=''>month</option>";
for($i=1;$i <= 12;$i++) {$ii = str_pad($i,2,0,STR_PAD_LEFT);if(substr($birth,14,2) == $ii) $inht .= "<option value='{$ii}' selected='selected'>{$ii} 월</option>";else $inht .= "<option value='{$ii}'>{$ii} 월</option>";}
$inht .= "</select><select name='birthday[]' onchange='if(this.previousSibling.value)if(this.previousSibling.previousSibling.value)thtck=this;ischeck(4,1);'><option value=''>day</option>";
for($i=1;$i <= 31;$i++) {$ii = str_pad($i,2,0,STR_PAD_LEFT);if(substr($birth,16,2) == $ii) $inht .= "<option value='{$ii}' selected='selected'>{$ii} 일</option>";else $inht .= "<option value='{$ii}'>{$ii} 일</option>";}
$inht .= "</select>";
return $inht;
}
if($_GET['signup']) {
if($mbr_level) echo "<script type='text/javascript'>location.href='?member_login=1';</script>";
else {
if(!$dxr) {
$sset = '';
if(!is_writable("data")) $sset .= "data ";
if(!is_writable("chat")) $sset .= "chat ";
if(!is_writable("icon")) $sset .= "icon ";
if(!is_writable("module")) $sset .= "module ";
if(!is_writable("widget")) $sset .= "widget ";
if($sset) {echo "<h1>".$sset." 디렉토리 권한을 FTP에서 777로 주세요</h1>";exit;}
}
?>
<script type='text/javascript'>
//<![CDATA[
function check_agree() {
if(document.getElementsByName('agreement')[0].getElementsByTagName('input')[0].checked) {
document.agreement.submit();
} else alert('이용약관과 개인정보 취급방침에 동의하셔야 합니다.');
}
document.title='이용약관과 개인정보 취급방침';
//]]>
</script>
<form method='post' name='agreement' id='agreement' action='<?=$index?>' style='margin:0'>
<center><textarea cols='1' rows='14' style='width:90%;overflow:auto;margin-bottom:10px' readonly='readonly'><? if($fp=@fopen($dxr."member_agreement","r")) {echo str_replace("&","&amp;",@fread($fp,filesize($dxr."member_agreement")));fclose($fp);}else echo "홈페이지에 맞는 이용약관과 개인정보 취급방침을 입력합니다.";?></textarea>
<br /><input type='checkbox' name='join' class='no' /> 이용약관과 개인정보 취급방침을 읽었으며 내용에 동의합니다. &nbsp; <input type='button' onclick='check_agree()' value='다음으로' class='srbt' /></center>
</form>
<?
}} else if($_POST['join'] ||$_GET['mbr_info']) {
?>
<script type='text/javascript'>
//<![CDATA[
function schaddr(address) {
if(document.getElementById('postaddrs').innerHTML) {faddr();return false;}
if(address) {
azax("include/zipcode.php?&zipcode="+address,"document.getElementById('postaddrs').style.height = '100px';document.getElementById('postaddrs').innerHTML = ajax;");
}}
function faddr(address) {
if(address) {
document.getElementsByName("postaddr")[0].value=address;
document.getElementsByName("postaddr")[0].readOnly = true;
}
document.getElementById('postaddrs').style.height = "0px";
document.getElementById('postaddrs').innerHTML = "";
}
function chkchk(ths) {
ths.previousSibling.value=(ths.previousSibling.value == '1')?'0':'1';
}
function onlynumber(ths) {
if(ths.value == '' || ths.value != ths.value.replace(/[^0-9]+/g,'')) {
ths.style.background='#ffdd00';
if(ths.value == '') alert('빈칸입니다'); else alert('숫자만 입력하세요');
ths.focus();return false;
} else {ths.style.background='#ffffff';return true;}
}
//]]>
</script>
<?
if($_POST['join']) {
$onload .= "\ndocument.signup.username.focus();\ndocument.title='회원가입';";
function sy($val) {
if($val == 1) $nvl = " sy";
return $nvl;
}
?>
<script type='text/javascript'>
//<![CDATA[
function go() {
var okk;
var form = document.signup;
if(form.username.value == '' || form.username.previousSibling.value != '1') okk = "아이디를";
else if(form.nick.value == '' || form.nick.previousSibling.value != '1') okk = "닉네임을";
else if(form.password.value == '' || form.password.value != form.password2.value) okk = "비밀번호를";
else if(form.email.value == '' || form.emailchecked.value != '') okk = "이메일주소를";
else if('<?=$sett[20][2]?>' == '1' && (document.getElementsByName('birthday[]')[0].value == '' || document.getElementsByName('birthday[]')[1].value == '' || document.getElementsByName('birthday[]')[2].value == '')) okk = "생년월일을";
else if('<?=$sett[20][0]?>' == '1' && form.postaddr.value == '') okk = "주소를";
else if('<?=$sett[20][0]?>' == '1' && form.addrplus.value == '') okk = "상세한 주소를";
else if('<?=$sett[20][1]?>' == '1' && (!onlynumber(document.getElementsByName('cellnumber[]')[0]) || !onlynumber(document.getElementsByName('cellnumber[]')[1]) || !onlynumber(document.getElementsByName('cellnumber[]')[2]))) okk = "전화번호를";
else if('<?=$sett[20][3]?>' == '1' && form.gender.value == 'g') okk = "성별을";
else {
convertbase(form);
}
if(okk) alert(okk + " 확인하세요!");
}
function ischeck(wht,n) {
if(wht) {
if(ajax != '') setTimeout("ischeck(1,1)",100);
else if(thtck.value) {
if(thtck.name == 'email' && thtck.value.split(/[\x00-\x2D]/g).length > 1) {alert("메일주소를 확인하세요");return;}
thtck.style.background = "url('icon/loading.gif') no-repeat 50% 50%";
ajax = thtck;
if(thtck.name == "ckemailaddr") startax("<?=$admin?>?&ckemailaddr="+thtck.value+"&email="+document.signup.email.value + "&sett46=1");
else if(thtck.name == "birthday[]") startax("include/mbr.php?&isdate="+document.getElementsByName('birthday[]')[0].value+document.getElementsByName('birthday[]')[1].value+thtck.value);
else startax("<?=$admin?>?&ck"+thtck.name+"="+encodeURIComponent(thtck.value));
ischeck();
}} else if(ajax == thtck) setTimeout("ischeck()",50);
else if(ajax != '') {
if(thtck.name == 'birthday[]') {
if(ajax != '9') {thtck.value='';eval(ajax);} else thtck.style.background='#ffffff';
} else {
if(thtck.name == 'email' || thtck.name == 'ckemailaddr') {
thtck = document.getElementsByName('email')[0];
if(ajax.indexOf('span') == -1) {
document.getElementById("ck" +thtck.name).style.height = '130px';
document.signup.emailchecked.value = '2';
} else {
document.getElementById("ck" +thtck.name).style.height = '30px';
if(ajax.indexOf('red') != -1) document.signup.emailchecked.value = '1';
else document.signup.emailchecked.value = '';
}}
document.getElementById("ck" +thtck.name).innerHTML = ajax;
if(ajax.indexOf('red') != -1) {thtck.style.background='#ffdd00';if(thtck.previousSibling.value) thtck.previousSibling.value ='2';}
else {thtck.style.background='#ffffff';if(thtck.previousSibling.value) thtck.previousSibling.value ='1';}
}
ajax = '';
thtck = '';
}}
//]]>
</script>
<form method="post" name="signup" action="<?=$admin?>" style="margin:0" onsubmit="go();return false;">
<input type='hidden' name='username_3' value='' />
<input type='hidden' name='password_3' value='' />
<input type='hidden' name='from' value='<?=$index?>?mbr_info=1<? if($_POST['slys']) echo "&slys=".$_POST['slys'];?>' />
<input type='hidden' name='emailchecked' value='1' />
<table id='signup' cellpadding='0px' cellspacing='0px' style='width:100%;margin-bottom:15px'><tr><td class='mbr_info'>
<div class='mbr_title'> &nbsp; 회원가입</div>
<div class='left sy'>아이디</div><div class='right'><input type='hidden' value='2' /><input type='text' name='username' maxlength='15' style='width:100px' onblur='thtck=this;ischeck(1,1)' /></div><div class='right' id='ckusername'></div><div class='fcler'></div>
<div class='left sy'>닉네임</div><div class='right'><input type='hidden' value='2' /><input type='text' name='nick' style='width:100px' onblur='thtck=this;ischeck(1,1)' /></div><div class='right' id='cknick'></div><div class='fcler'></div>
<div class='left sy'>비밀번호</div><div class='right'><input type='password' name='password' style='width:100px' /></div><div class='fcler'></div>
<div class='left sy'>비밀번호 재입력</div><div class='right'><input type='password' name='password2' style='width:100px' /></div><div class='fcler'></div>
<div class='left sy'>이메일주소</div><div class='right'><input type='hidden' value='2' /><input type='text' name='email' style='width:200px' /><input type='button' value='확인' onclick='thtck=this.previousSibling;ischeck(1,1)' class='srbt' style='width:35px;margin-left:5px' /></div><div class='fcler'></div>
<div class='left'>홈페이지</div><div class='right'><input type='text' name='blog' style='width:240px' value='http://' /></div><div class='fcler'></div>
<? if($sett[20][2]) {?>
<div class='left<?=sy($sett[20][2])?>'>생년월일</div><div class='right' id='mkbirth'>
<? echo mkbirthday(0);?> 공개 <input type='hidden' name='public_birthday' value='0' /><input type='checkbox' onclick='chkchk(this)' class='no' /></div><div class='fcler'></div><?
} if($sett[20][0]) {?>
<div class='left<?=sy($sett[20][0])?>'>주소</div><div class='right' style='height:43px'><input type='text' style='width:150px' value='동,면 이름으로 검색하세요' onclick='if(this.value=="동,면 이름으로 검색하세요")this.value="";' /><input type='button' onclick='var xx=this.previousSibling.value;if(xx)if(xx !="동,면 이름으로 검색하세요")schaddr(xx);else alert("동,면 이름을 입력하세요");' value='주소검색' class='srbt' /> 공개 <input type='hidden' name='public_postaddr' value='0' /><input type='checkbox' onclick='chkchk(this)' class='no' />
<br /><div id='postaddrs' style='position:absolute;background:#FFEC8A;overflow:auto'></div><input type='text' name='postaddr' style='width:300px' /><br /><input type='text' name='addrplus' style='width:300px' value='' /></div><div class='fcler'></div>
<?} if($sett[20][1]) {?>
<div class='left<?=sy($sett[20][1])?>'>전화번호</div><div class='right'><input type='text' name='cellnumber[]' value='' style='width:30px' maxlength='3' onkeyup='if(this.value.length==3) document.getElementsByName("cellnumber[]")[1].focus()' onblur='onlynumber(this)' /> - <input type='text' name='cellnumber[]' style='width:30px;margin-right:5px' maxlength='4' onkeyup='if(this.value.length==4) this.nextSibling.focus()' onblur='onlynumber(this)' /><input type='text' name='cellnumber[]' style='width:30px' maxlength='4' onblur='onlynumber(this)' /> 공개 <input type='hidden' name='public_cellnumber' value='0' /><input type='checkbox' onclick='chkchk(this)' class='no' /></div><div class='fcler'></div>
<?} if($sett[20][3]) {?>
<div class='left<?=sy($sett[20][3])?>'>성별선택</div><div class='right'><select name='gender' style='margin-top:5px'><?if($sett[20][3] == '2') echo "<option value='g'></option>";?><option value='m'>男</option><option value='f'>女</option></select> 공개 <input type='hidden' name='public_gender' value='0' /><input type='checkbox' onclick='chkchk(this)' class='no' /></div><div class='fcler'></div><?} else {?><input type='hidden' name='gender' value='g' />
<?} if(substr($sett[20],4)) {?>
<div class='left sy'><?=substr($sett[20],4)?></div><div class='right'><input type='text' name='addinfo' style='width:100px' /></div><div class='fcler'></div><?}?>
<div class='left'>회원가입</div><div class='right'><input type='button' onclick='go()' value="회원가입" class='srbt' style='width:200px;height:20px;margin-top:10px' /></div><div class='fcler'></div>
<div id='ckemail' style='margin-top:10px' align='center'></div><div class='fcler'></div>
</td></tr></table>
</form>
<?
} else if($_GET['mbr_info']) {
if(!$mbr_level) echo "<script type='text/javascript'>location.href='?member_login=1';</script>";
else {
if($_SESSION['rgstr']) $_SESSION['rgstr'] = '';
if($_GET['mbr'] && $mbr_level == 9) {
$mbno = $_GET['mbr'];
$jn = fopen($dxr."_member_/member_".$mbno,"r");
$jno = explode("\x1b", fgets($jn));
fclose($jn);
$blckprf = array("display:none","readonly='readonly'");
} else $mbno = $mbr_no;
//회원정보
$fim = fopen($dim,"r");
while(!feof($fim)) {
$xxx = fgets($fim);
if((int)(substr($xxx, 0, 5)) == $mbno) {
$okok = explode("\x1b", $xxx);
break;
}}
fclose($fim);
$mbid = trim(substr($okok[0],5,15));
$onload .= "\nsetTimeout(\"document.signup.mlog1.value = '".trim($okok[11])."';document.signup.mlog2.value = '".trim($okok[12])."';document.signup.mlog3.value = '".trim($okok[13])."';document.signup.mlog4.value = '".trim($okok[14])."';document.signup.mlog5.value =  '".trim($okok[15])."'\",100);\ndocument.title='{$okok[1]}님의 회원정보';";for($i =1;$sect[$i];$i++) {
if($sect[$i][4] && $sect[$i][4] <= $okok[2]) {
$sectg = "<tr><td><a target='_blank' href='?section={$i}'>{$sect[$i][0]}</a></td><td>".(substr_count($sect[$i][5],",") -1)." 명</td><td>";
if(false !== strpos($sect[$i][5],",".$mbno.",")) $sectg .= "<input type='button' onclick='thtck=this;inout({$i},2)' class='srbt' value='탈퇴' />";
else $sectg .= "<input type='button' onclick='thtck=this;inout({$i},1)' class='srbt' value='가입' />";
$sectg .= "</td></tr>";
}}
?>
<script type='text/javascript'>
//<![CDATA[
function checks(out) {
var okk;
var form = document.signup;
if(out == 'out') form.deletee.value = 'delete';
else {
if(form.password2.value != form.password3.value) okk = "비밀번호를";
else if(form.cnick.value == '' || form.cnick.previousSibling.value == '2' || (form.cnick.previousSibling.value == '3' && form.cnick.value != form.cnick.nextSibling.value)) okk = "닉네임을";
else if(form.cemail.value == '' || (form.emailchecked.value && form.cemail.value != form.cemail.nextSibling.value)) okk = "이메일주소를";
else if('<?=$sett[20][2]?>' == '1' && (document.getElementsByName('birthday[]')[0].value == '' || document.getElementsByName('birthday[]')[1].value == '' || document.getElementsByName('birthday[]')[2].value == '')) okk = "생년월일을";
else if('<?=$sett[20][0]?>' == '1' && form.postaddr.value == '') okk = "주소를";
else if('<?=$sett[20][0]?>' == '1' && form.addrplus.value == '') okk = "상세한 주소를";
else if('<?=$sett[20][1]?>' == '1' && (!onlynumber(document.getElementsByName('cellnumber[]')[0]) || !onlynumber(document.getElementsByName('cellnumber[]')[1]) || !onlynumber(document.getElementsByName('cellnumber[]')[2]))) okk = "전화번호를";
else if('<?=$sett[20][3]?>' == '1' && form.gender.value == 'g') okk = "성별을";
else out = 'out';
}
if(okk) alert(okk + " 확인하세요!");
else {
form.username_3.value = chbase('<?=$mbid?>');
form.submit();
}
}
function ischeck(wht,n) {
if(n) {
if(ajax != '') setTimeout("ischeck('"+wht+"',1)",100);
else if(thtck.value) {
if(thtck.name == 'cemail' && thtck.value.split(/[\x00-\x2D]/g).length > 1) {alert("메일주소를 확인하세요");return;}
thtck.style.background = "url('icon/loading.gif') no-repeat 50% 50%";
ajax = thtck;
if(thtck.name == "ckemailaddr") startax("<?=$admin?>?&ckemailaddr="+thtck.value+"&email="+document.signup.cemail.value + "&sett46=2");
else if(thtck.name == "birthday[]") startax("include/mbr.php?&isdate="+document.getElementsByName('birthday[]')[0].value+document.getElementsByName('birthday[]')[1].value+thtck.value);
else if(wht == 2) startax("<?=$admin?>?&sign="+encodeURIComponent(thtck.value));
else startax("<?=$admin?>?&ck"+thtck.name.substr(1)+"="+encodeURIComponent(thtck.value));
ischeck(wht);
}} else if(ajax == thtck) setTimeout("ischeck('"+wht+"')",50);
else if(ajax != '') {
if(wht != 2) {
if(thtck.name == 'cemail' || thtck.name == 'ckemailaddr') {
thtck = document.getElementsByName('cemail')[0];
if(ajax.indexOf('span') == -1) {
document.getElementById("ck" +thtck.name).style.height = '130px';
document.signup.emailchecked.value = '2';
} else {
document.getElementById("ck" +thtck.name).style.height = '30px';
if(ajax.indexOf('red') != -1) document.signup.emailchecked.value = '1';
else document.signup.emailchecked.value = '';
}}
if(wht == 4) {
if(ajax != '9') {thtck.value='';eval(ajax);} else thtck.style.background='#ffffff';
} else {
document.getElementById("ck" +thtck.name).innerHTML = ajax;
if(ajax.indexOf('red') != -1) {thtck.style.background='#ffdd00';if(thtck.previousSibling.value) thtck.previousSibling.value ='2';}
else {thtck.style.background='#ffffff';if(thtck.previousSibling.value) thtck.previousSibling.value ='1';}
}
} else thtck.style.background = "#FFFFFF";
ajax = '';
thtck = '';
}}
function bchk(ths,thu) {
if(ths.value!= ths.nextSibling.value) {thtck=ths;ischeck(3,1);} else {ths.previousSibling.value="3";ths.style.background="#ffffff";document.getElementById(thu).innerHTML="";}
}
function inout(gtm,outin) {
if(outin) {
azax("<?=$admin?>?&gtm="+gtm+"&inout="+outin,9);
}}
//]]>
</script>
<table cellpadding='0px' cellspacing='0px' style='width:100%;margin-bottom:15px'><tr><td class='mbr_info'>
<div class='mbr_title'> &nbsp; 회원정보</div>
<div class='left'>아이디</div><div class='right'><?=$mbid?></div><div class='fcler'></div>
<div class='left'>쓴 &nbsp; 글</div><div class='right'><?=$jno[0]?> 개</div><div class='fcler'></div>
<div class='left'>덧 &nbsp; 글</div><div class='right'><?=$jno[1]?> 개</div><div class='fcler'></div>
<div class='left'>출 &nbsp; 석</div><div class='right'><?=$jno[2]?> 회</div><div class='fcler'></div>
<div class='left'>포인트</div><div class='right'><input type='button' value='<?=(int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]?>' onclick="popup('<?=$admin?>?pview=<?=$mbno?>',400,300)" style='width:60px' class='srbt' /></div><div class='fcler'></div>
<div class='left'>가입일</div><div class='right'><?=date("Y년 m월 d일", substr($okok[6],0,10))?></div><div class='fcler'></div>
<div class='left'>레 &nbsp; 벨</div><div class='right'><?=levelname($okok[2])?> <span class='r8'>[Lv <?=$okok[2]?>]</span></div><div class='fcler'></div>
<div style='height:35px;padding-left:30px'><? if($sett[57] != 'a' && $sett[57] <= $okok[2]) {?><input type='button' onclick="read('get')" value="받은쪽지함" class='srbt' style="width:85px" />&nbsp; <input type='button' onclick="read('post')" value="보낸쪽지함" class='srbt' style="width:85px" />&nbsp; <?}?><input type='button' onclick="nwopn('<?=$mblog?>')" value="회원로그" class='srbt' style="width:85px" />&nbsp; <input type='button' onclick="rplace('<?=$admin?>?pointcal=<?=$mbno?>&amp;request=mbr_info')" value="포인트 재계산" class='srbt' style="width:85px" />
</div></td></tr></table>
<table cellpadding='0px' cellspacing='0px' style='width:100%;margin-bottom:15px'><tr><td class='mbr_info'>
<div class='mbr_title'> &nbsp; 프로필수정</div>
<div class='left'>자기사진</div><div class='right' style='height:90px'><img src='<?=(file_exists("icon/m80_".$mbno))? "icon/m80_".$mbno:"icon/noimg.gif";?>' style='width:80px;height:80px' alt='' /><img src='<?=(file_exists("icon/m20_".$mbno))? "icon/m20_".$mbno:"icon/noimg.gif";?>' style='width:20px;height:20px;margin-left:30px;margin-bottom:30px' alt='' />
<form method="post" enctype="multipart/form-data" action="<?=$exe?>" style="margin:0;"><input type='file' name='img' onchange='if(this.value) submit();' style='width:80px;<?=$blckprf[0]?>' /><input type='file' name='img2' onchange='if(this.value) submit();' style='width:80px;<?=$blckprf[0]?>' /></form></div><div class='fcler'></div>
<div class='left'>자기소개</div><div class='right' style='height:90px'>
<textarea rows='1' cols='60' style='width:90%;height:80px;overflow:visible' onblur='thtck=this;ischeck(2,1)' <?=$blckprf[1]?>><?=str_replace("&","&amp;",@join('',@file("icon/m02_".$mbno)))?></textarea>
</div><div class='fcler'></div>
</td></tr></table>
<form method="post" name="signup" action="<?=$admin?>" style="margin:0">
<input type='hidden' name='username_3' value='' />
<input type='hidden' name='password_3' value='newpass' />
<input type='hidden' name='from' value='<?=$_SERVER['REQUEST_URI']?>' />
<input type='hidden' name='no' value='<?=substr($okok[0], 0, 5)?>' />
<input type='hidden' name='emailchecked' value='1' />
<table cellpadding='0px' cellspacing='0px' style='width:100%;margin-bottom:15px'><tr><td class='mbr_info'>
<div class='mbr_title'> &nbsp; 개인정보수정</div>
<div class='left'>비밀번호변경</div><div class='right' style='height:30px'><input type='hidden' name='deletee' value='' />
새 비밀번호: <input type='password' name='password2' value='' style='width:150px' />
<br /><font title=' 비밀번호 변경시, 새 비밀번호 다시 입력 '> └ 다시입력</font>: <input type='password' name='password3' value='' style='width:150px' /></div><div class='fcler'></div>
<div class='left'>홈페이지</div><div class='right'><input type='text' name='blog' value='<?=$okok[10]?>' style='width:222px' /></div><div class='fcler'></div>
<div class='left'>닉네임</div><div class='right'><input type='hidden' value='3' /><input type='text' name='cnick' value='<?=$okok[1]?>' style='width:150px' onblur='bchk(this,"ckcnick")' /><input type='hidden' value='<?=$okok[1]?>' /></div><div style='float:left' id='ckcnick'></div><div class='fcler'></div>
<div class='left'>이메일</div><div class='right'><input type='hidden' value='3' /><input type='text' name='cemail' value='<?=$okok[3]?>' style='width:150px' /><input type='hidden' value='<?=$okok[3]?>' /><input type='button' value='확인' onclick='bchk(this.previousSibling.previousSibling,"ckcemail")' class='srbt' style='width:35px;margin-left:5px' /></div><div class='fcler'></div>
<div id='ckcemail' style='padding-left:165px;height:0'></div><div style='clear:both;height:0'></div>
<? if($sett[20][2]) {?><div class='left'>생년월일</div><div class='right' id='mkbirth'>
<? echo mkbirthday($okok[6]);?> 공개 <input type='hidden' name='public_birthday' value='<?=$okok[8][2]?>' /><input type='checkbox' onclick='chkchk(this)' <?=rtchecked($okok[8][2])?> class='no' /></div><div class='fcler'></div><?
} if($sett[20][0]) {$sep = strpos($okok[4],",");?>
<div class='left'>주소</div><div class='right' style='height:43px'><input type='text' style='width:150px' value='동,면 이름으로 검색하세요' onclick='if(this.value=="동,면 이름으로 검색하세요")this.value="";' /><input type='button' onclick='var xx=this.previousSibling.value;if(xx)if(xx !="동,면 이름으로 검색하세요")schaddr(xx);else alert("동,면 이름을 입력하세요");' value='주소검색' class='srbt' /> 공개 <input type='hidden' name='public_postaddr' value='<?=$okok[8][0]?>' /><input type='checkbox' onclick='chkchk(this)' <?=rtchecked($okok[8][0])?> class='no' />
<br /><div id='postaddrs' style='position:absolute;background:#FFEC8A;overflow:auto'></div><input type='text' name='postaddr' style='width:300px' value='<?=substr($okok[4],0,$sep)?>' /><br /><input type='text' name='addrplus' style='width:300px' value='<?=substr($okok[4],$sep + 1)?>' /></div><div class='fcler'></div>
<?} if($sett[20][1]) {
$celln = explode('-',$okok[5]);?>
<div class='left'>전화번호</div><div class='right'><input type='text' name='cellnumber[]' value='<?=$celln[0]?>' style='width:30px' maxlength='3' onkeyup='if(this.value.length==3) document.getElementsByName("cellnumber[]")[1].focus()' onblur='onlynumber(this)' /> <input type='text' name='cellnumber[]' value='<?=$celln[1]?>' maxlength='4' style='width:30px;margin-right:5px' onkeyup='if(this.value.length==4) this.nextSibling.focus()' onblur='onlynumber(this)' /><input type='text' name='cellnumber[]' value='<?=$celln[2]?>' style='width:30px' maxlength='4' onblur='onlynumber(this)' /> 공개 <input type='hidden' name='public_cellnumber' value='<?=$okok[8][1]?>' /><input type='checkbox' onclick='chkchk(this)' <?=rtchecked($okok[8][1])?> class='no' /></div><div class='fcler'></div>
<?} if($sett[20][3]) {?>
<div class='left'>성별선택</div><div class='right'><select name='gender'><option value='g' <?if($okok[9]=='g') echo "selected='selected'";?>></option><option value='m' <?if($okok[9]=='m') echo "selected='selected'";?>>男</option><option value='f' <?if($okok[9]=='f') echo "selected='selected'";?>>女</option></select> 공개 <input type='hidden' name='public_gender' value='<?=$okok[8][3]?>' /><input type='checkbox' onclick='chkchk(this)' <?=rtchecked($okok[8][3])?> class='no' /></div><div class='fcler'></div><?} else {?><input type='hidden' name='gender' value='g' />
<?} if(substr($sett[20],4)) {?>
<div class='left'><?=substr($sett[20],4)?></div><div class='right'><input type='text' name='addinfo' value='<?=$okok[7]?>' style='width:100px' /></div><div class='fcler'></div><?}?>
<div class='left'>회원로그 공개설정</div><div class='fcler'></div>
<div class='left' style='margin-left:50px'>쓴글</div><div class='right'><select name='mlog2'><option value='0'>비회원도</option><option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option><option value='9'>관리자</option><option value='a'>본인만</option></select></div><div class='fcler'></div>
<div class='left' style='margin-left:50px'>쓴덧글</div><div class='right'><select name='mlog3'><option value='0'>비회원도</option><option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option><option value='9'>관리자</option><option value='a'>본인만</option></select></div><div class='fcler'></div>
<div class='left' style='margin-left:50px'>스크랩</div><div class='right'><select name='mlog4'><option value='0'>비회원도</option><option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option><option value='9'>관리자</option><option value='a'>본인만</option></select></div><div class='fcler'></div>
<div class='left' style='margin-left:50px'>다이어리</div><div class='right'><select name='mlog1'><option value='0'>비회원도</option><option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option><option value='9'>관리자</option><option value='a'>본인만</option></select></div><div class='fcler'></div>
<div class='left' style='margin-left:50px'>출석</div><div class='right'><select name='mlog5'><option value='0'>비회원도</option><option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option><option value='9'>관리자</option></select></div><div class='fcler'></div>
<div style='height:35px;padding-left:30px'><input type="button" onclick="checks()" value="회원정보수정" class='srbt' style="width:100px;height:20px;margin-top:10px" /> &nbsp;
<input type="button" onclick="var xx=confirm('회원탈퇴하시겠습니까');if(xx)checks('out')" value="회원탈퇴" class='srbt' style="width:100px;height:20px;margin-top:10px" />
<?if($okok[2] == 9){?> &nbsp;<input type="button" onclick="document.signup.deletee.value='mailcheck';document.signup.submit();" value="메일함수확인" class='srbt' style="width:80px;height:20px;margin-top:10px" /><?}?>
</div><div class='fcler'></div></td></tr></table>
</form>
<?
if($sectg) {
?>
<table cellpadding='0px' cellspacing='0px' style='width:100%;margin-bottom:15px'><tr><td class='mbr_info'>
<div class='mbr_title'> &nbsp; 소모임 가입 / 탈퇴</div>
<table cellpadding='10px' cellspacing='0px' border='1' style='margin:0 0 20px 20px'>
<tr><th width='200px'>소모임 이름</th><th width='70px'>회원수</th><th width='50px'>&nbsp;</th></tr>
<?=$sectg?>
</table></td></tr></table>
<?
}}}} else if($_POST['isdate']) {
$date = mktime(0, 0, 0, substr($_POST['isdate'],4,2), substr($_POST['isdate'],6,2), substr($_POST['isdate'],0,4));
if(substr($_POST['isdate'],0,4) > 1969 && date("m",$date) != substr($_POST['isdate'],4,2)) echo "alert('not exist');";
else echo "9";
}
?>