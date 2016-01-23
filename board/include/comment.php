<? if($_POST['time']) {echo $_POST['time'] - time();exit;}?>
<script type='text/javascript'>
//<![CDATA[
if(top.length == 0) var pxxx = opener;
else var pxxx = parent;
var gout = 1;

function rrp(no,nc,mt,cp) {
if($('rpp_' + nc).innerHTML) {
$('rpp_' + nc).innerHTML = "";
$('rpp_' + nc).style.display = "none";
} else {
var rf = $$('cmmt_' + mt,0).innerHTML;
var cmt = RegExp('cmmt_' + mt,'gi');
rf = rf.replace(cmt,'rp_' + nc);
rf = '<form name="rp_' + nc + '" method="post" action="<?=$exe?>" style="padding-top:10px">' + rf + '</form>';
$('rpp_' + nc).innerHTML = rf;
$('rpp_' + nc).style.display = "block";
rpp(nc,'cmmt_' + mt,cp);
}
toprsz();
}
function rpp(nc,cmt,cp) {
var ccf =$$('rp_' + nc,0);
<?if(!$mbr_level){?>
ccf.name.value = $$(cmt,0).name.value;
ccf.pass.value = $$(cmt,0).pass.value;
<?}?>
ccf.up.value = parseInt(cp) + 1;
ccf.cc.value = nc;
if($$(cmt,0).antispam) {ccf.antispam.value = $$(cmt,0).antispam.value;}
}
function toprsz() {
if(pxxx == parent) {
var bht = document.body.offsetHeight;
if(setop[0] == '2' || setop[1] == 'ie6' || '<?=$_GET['scroll']?>' != '') bht += 5;
if('<?=$_GET['scroll']?>' == '') {if(pxxx.$('comment_<?=$_GET['comment']?>')) pxxx.$('comment_<?=$_GET['comment']?>').style.height = bht + 'px';
} else if(bht < <?=$sett[5]?>) pxxx.$('img').getElementsByTagName('iframe')[0].style.height = bht + 'px';
} else document.body.style.overflowY='auto';
}
function chksbmt(ths) {
thtck = ths;
<?
if($sss[25] <= $mbr_level) {
if($_COOKIE["cmt_".$uid] && $mbr_level < $sett[51] && $time - substr($_COOKIE["cmt_".$uid],0,10) < $sett[50]*60) {?>
azax("include/comment.php?&time=<?=$sett[50]*60 + substr($_COOKIE["cmt_".$uid],0,10)?>","if(ajax > 0) alert('시간간격 제한 (<?=$sett[50]?>분) : ' + ajax + '초 남았습니다');else chkssbmt(thtck);");
<?} else {?>
chkssbmt(ths);
<?}}?>
}
function chkssbmt(ths) {
var cform = ths.form;
<?if(!$_COOKIE[$docoo]) {?>if(document.cookie.indexOf('=<?=$dockie?>') == -1) {alert('쿠키가 막혀있습니다.');return false;}<?}?>
if(cform.antispam && cform.antispam.readOnly == false) {alert('스팸 방지 코드를 넣으세요.');return false;}
if(cform.content.value == '') {alert('내용이 비었습니다.');return false;}
else if(cform.content.value == $('ckdouble').value) {alert('중복된 내용입니다.');return false;}
else {var proh = pxxx.ckprohibit(cform.content.value);if(proh) {alert('금지단어 "' + proh + '"가 있습니다.');return false;}}
<?if(!$mbr_level){?>if(eval(cform.name) && (cform.name.value == '' || cform.pass.value == '' )) {alert('빈 칸이 있습니다');return false;}<?}
if((int)$sett[86] > 0 && $mbr_level < $sett[87]) {?>
var over = strbyte(cform.content.value) - <?=$sett[86]*1024?>;
if(over > 0) {alert('내용이 너무 깁니다. (' + over + 'byte 초과)');return false;}
<?}?>
azax("<?=$exe?>?&id=<?=$id?>&isctp=1","cnw = ajax");
if(cnw != "b") setTimeout("chkssbmt(thtck)",200);
else {
gout = 0;
cform.submit();
}}
function chksbmt2(ths) {
var cform = (ths)? ths.form:sith.form;
if(ths) {
if(cform.name.value && cform.pass.value) {
sith = ths;
if(ajax) setTimeout("chksbmt2(sith)",100);
else {
ajax = 'chksbmt';
startax("<?=$admin?>?&username_3=" + pxxx.chbase(cform.name.value) + "&password_3=" + pxxx.chbase(cform.pass.value));
chksbmt2();
}} else {alert('빈 칸이 있습니다');ths.checked=false;}} else if(ajax == 'chksbmt') setTimeout("chksbmt2()",50);
else if(ajax != '') {
if(ajax.indexOf('alert') == -1) {
var cnpn = cform.name.parentNode;
if(cnpn.nextSibling && cnpn.nextSibling.tagName && cnpn.nextSibling.tagName.toLowerCase() == 'td' && cnpn.nextSibling.getElementsByTagName('textarea')) cnpn.nextSibling.style.width=parseInt(cnpn.nextSibling.offsetWidth) + parseInt(cnpn.style.width) + 'px';
cnpn.style.display = 'none';
if(tath == '99') cnpn.parentNode.style.display = 'none';
} else {alert("로그인 되지 않았습니다.\n다시 시도해서 로그인하거나\n아니면, 비회원인 채로 작성하세요");sith.checked=false;}
ajax = '';
sith = '';
tath = '';
}}
//]]>
</script>
<?
if($wdth[6]) {
for($aa = 1; $aa <= $wdth[6]; $aa++) {
if($_GET['comment'] <= (int)substr($do[$aa], 0 ,6)) {$xx = $aa;break;}
}}
if($xx > 0) $idd = $id."/^".$xx;
else $idd = $id;
$no6 = str_pad($_GET['comment'],6,0,STR_PAD_LEFT);
$fn = fopen($dxr.$idd."/no.dat","r");
while(!feof($fn)){
$xxx= fgets($fn);
if($no6 == substr($xxx, 0, 6)) {
if(substr($xxx,6,2) == 'aa' && $mbr_level != 9) $deleted = 1;
break;
}}
fclose($fn);
if($deleted == 1) exit;
$crp = explode("\x1b", $xxx);
$mn = substr($crp[0], 9);
if(false !== strpos("^".$wdth[4],"^".$_GET['comment']."^")) {if($wdth[7][8] <= $mbr_level) $notice = 1;else $notice = 2;}
if($notice == 2 || ($notice != 1 && $authority[23] && ($sss[23] == 'a' || !$mn || $mn != $mbr_no))) exit;
if($xxx[8] <= $mbr_level || ($mn && $mn == $mbr_no) || $_COOKIE["scrt_".$_GET['comment'].$id] == md5($_GET['comment']."_".$sessid.$id)) {
$srkin = str_replace("<#pno#>",$_GET['comment'],$srkin);
if($crp[4] !== 'a' && $sss[49]) $srkiin = str_replace("<#nReply#>",(int)$crp[2],tagcut('rp',$srkin));
else $srkiin = '<img src="icon/t.gif" alt="" style="height:10px" />';
$ism3 = (!$mn)? 3:(($mn == $mbr_no || $mbr_level == 9)? 4:2);
$sr_rpv = tagcut('rpv',$srkin);
if($crp[3] >= 1){
// 엮은글 출력
$fr = fopen($dxr.$id."/stb.dat","r");
$cc = 1;
while(!feof($fr)){
$comt = fgets($fr);
if(substr($comt, 0, 6) == $no6) {
	$rdata = explode("\x1b", $comt);
$sr_rp = str_replace("<#cid#>","crp3_".$crp[3],$sr_rpv);
$sr_rp = str_replace("<#name#>","<b class='nick'>엮은글</b>",$sr_rp);
$sr_rp = str_replace("<#tname#>","<b class='nick'>엮은글</b>",$sr_rp);
$sr_rp = str_replace("<#isipr#>","<;>",$sr_rp);
$sr_rp = str_replace("<#isrrpx#>","<;>",$sr_rp);
$sr_rp = str_replace("<#istrrpx#>","<!--/-->",$sr_rp);
$sr_rp = str_replace("<#bdo#>","<a target='_blank' href='{$rdata[1]}'>{$rdata[1]}</a>",$sr_rp);
$sr_rp = str_replace("<#rdymd#>",date("Y-m-d", $rdata[3]),$sr_rp);
$sr_rp = str_replace("<#rdhis#>",date("H:i:s", $rdata[3]),$sr_rp);
$sr_rp = str_replace("<#rdlnk#>","pxxx.fpass('del_stb','{$ism3}','{$cc}','{$xx}','','{$_GET['comment']}','{$id}')",$sr_rp);
$sr_rp = str_replace("<#isrmlnk#>","<;>",$sr_rp);
$sr_rp = str_replace("<#isrrlnk#>","<;>",$sr_rp);
$srkiin .= $sr_rp;
$crp[3]--;
}
if($crp[3] == 0) break;
$cc++;
}
fclose($fr);
$rtitle = "";
}
if($crp[4] >= 1){
// 엮인글 출력
$fr = fopen($dxr.$id."/rtb.dat","r");
$cc = 1;
while(!feof($fr)){
$comt = fgets($fr);
if(substr($comt, 0, 6) == $no6) {
	$rdata = explode("\x1b", $comt);
$sr_rp = str_replace("<#cid#>","crp4_".$crp[4],$sr_rpv);
$sr_rp = str_replace("<#name#>","<b class='nick'>엮인글</b>",$sr_rp);
$sr_rp = str_replace("<#tname#>","<b class='nick'>엮인글</b>",$sr_rp);
$sr_rp = str_replace("<#isipr#>","<;>",$sr_rp);
$sr_rp = str_replace("<#isrrpx#>","<;>",$sr_rp);
$sr_rp = str_replace("<#istrrpx#>","<!--/-->",$sr_rp);
$sr_rp = str_replace("<#ipr#>",$rdata[6],$sr_rp);
$sr_rp = str_replace("<#bdo#>","<a target='_blank' href='{$rdata[2]}'>[{$rdata[1]}] {$rdata[3]}</a><br>{$rdata[4]}",$sr_rp);
$sr_rp = str_replace("<#rdymd#>",date("Y-m-d", $rdata[5]),$sr_rp);
$sr_rp = str_replace("<#rdhis#>",date("H:i:s", $rdata[5]),$sr_rp);
$sr_rp = str_replace("<#rdlnk#>","pxxx.fpass('del_rtb','{$ism3}','{$cc}','{$xx}','','{$_GET['comment']}','{$id}')",$sr_rp);
$sr_rp = str_replace("<#isrmlnk#>","<;>",$sr_rp);
$sr_rp = str_replace("<#isrrlnk#>","<;>",$sr_rp);
$srkiin .= $sr_rp;
$crp[4]--;
}
if($crp[4] == 0) break;
$cc++;
}
fclose($fr);
}
$cc = $crp[2];
if($crp[2] >= 1){
// 코멘트 출력
$cmt = '';
$cmm = ',';
if($crp[2] > $sett[65] && $sett[66] > 0) {
$pend = (int)(($crp[2] -1)/$sett[65]) + 1;
if($_GET['page'] == 1) {
$fstt = 0;
$fend = $crp[2] % $sett[65];
if($fend === 0) $fend = $sett[65];
} else {
if(!$_GET['page']) $_GET['page'] = $pend;
$fstt = $crp[2] - $sett[65]*($pend -$_GET['page'] +1);
$fend = $sett[65] + $fstt;
}} else {
$fstt = 0;
$fend = $crp[2];
}
$c = 1;
if(!$csff[1][0]) $sr_rpv = str_replace("<#x_appr#>","<;>",$sr_rpv);
if(!$csff[1][1]) $sr_rpv = str_replace("<#x_oppo#>","<;>",$sr_rpv);
if($mbr_level < $wdth[9][0]) $isrvt = 0;else $isrvt = 1;
$fr = fopen($dxr.$idd."/rlist.dat","r");
for($i = 1;$comt = fgets($fr);$i++) {
if(substr($comt, 0, 6) == $no6) {
if($c > $fstt) {
if($sett[66] == 2 && $c > $fend && substr($comt,13,1) != '1') $fend++;
if($c <= $fend) {
$cmt[$i] = $comt;
$com5 = substr($comt, 24, 5).",";
if(strpos($cmm, $com5) === false) $cmm .= $com5;
} else break;
}
$c++;
}
}
fclose($fr);
if($cmm != ',') {
$fmm = array();
$fim = fopen($dim,"r");
while($fm = fgets($fim)) {
$fmo = substr($fm,0,5);
if(strpos($cmm,$fmo.",")) {
$fmm[(int)$fmo] = explode("\x1b",$fm);
}
}
fclose($fim);
if($sett[83] && $mbr_no && $mn != $mbr_no && strpos($cmm,$mbr_no.",")) notiff($mbr_no,0,$id10.$no6,0);
}
$fb = fopen($dxr.$idd."/rbody.dat","r");
$d = 1;
for($j = 1;$j <= $i;$j++) {
if($d <= $fend) {
if($comt = $cmt[$j]) {
$d++;
$cbody = fgets($fb);
$comtm = explode("\x1b",trim(substr($comt, 29)));
$cdate = substr($comt, 14, 10);
$sr_rp = str_replace("<#cid#>","crp2_".$crp[2],$sr_rpv);
$mm = (int)substr($comt, 24, 5);
if($mm) $homepage = $fmm[$mm][10];
$ipr = trim(substr($cbody, 0, 15));
if($ipr && (!$mm || $sss[44] < 3) && ($mbr_level == 9 || ($sss[44] != 2 && $sss[44] != 9 && ($mbr_level || $sss[44] == 0 || $sss[44] == 7)))) $sr_rp = str_replace("<#ipr#>",$ipr,$sr_rp);
else $sr_rp = str_replace("<#isipr#>","<;>",$sr_rp);
$cup = substr($comt, 13, 1);
$cc = substr($comt, 6, 7);
if($cup == 1) {
$sr_rp = str_replace("<#isrrpx#>","<;>",$sr_rp);
$sr_rp = str_replace("<#istrrpx#>","<!--/-->",$sr_rp);
} else {
$sr_rp = str_replace("<#istrrpx#>","<;>",$sr_rp);
$sr_rp = str_replace("<#rrpmg#>"," style='margin:4px 0 4px ".(30 * ($cup -1))."px'",$sr_rp);
}
if($cbody[25] == "\x1b") {
if($mbr_level != 9 && (!$mm || $mm != $mbr_no) && (!$mn || $mn != $mbr_no) && $_COOKIE["scrt_".$cc.$id] != md5($cc."_".$sessid.$id)) {
if(!$mm || !$mn) {$bdo = "비밀글입니다";$memb .= "\nffpass('bdo{$cc}','disclose','3','{$cc}','{$_GET['comment']}','{$cup}');";}
else $bdo = "<u>비밀글입니다</u>";
} else $bdo = substr($cbody, 26, -1);
$cb25 = 1;
} else {$bdo = substr($cbody, 25, -1);$cb25 = 0;}
if(!$mm && $bdo[0] == "\x18") {$http = strpos($bdo,"\x1b");$homepage = substr($bdo,1,$http -1);$bdo = substr($bdo,$http + 1);}
if(($sett[6] == 0 || $sett[6] == 1) && ($mbr_no && $mm == $mbr_no) || (!$mbr_no && $ipr == $_SERVER['REMOTE_ADDR'])) $xdouble = $bdo;
if($_GET['search'] == 'r') $bdo = skword($bdo);
$bdo = "<div id='bdo{$cc}' class='bdo'>{$bdo}</div>";
if(!$sss[64] && $mm && file_exists("icon/m80_".$mm)) $sr_rp = str_replace("<#m12#>","<img src='icon/m80_{$mm}' class='m12' alt='' />",$sr_rp);
$sr_rp = str_replace("<#rdymd#>",date("Y-m-d", $cdate),$sr_rp);
$sr_rp = str_replace("<#rdhis#>",date("H:i:s",$cdate),$sr_rp);

$imm = imn($mm,$cdate,0,0,0);
if($imm[0] == 0 && (!$sett[72] || $sett[72] == 2)) $sr_rp = str_replace('<#isrmlnk#>','<;>',$sr_rp);
else $sr_rp = str_replace("<#rmlnk#>","pxxx.rpmd('{$cc}','{$imm[2]}',$('bdo{$cc}'),'{$cup}','{$id}','{$xx}','{$cb25}','{$homepage}')",$sr_rp);
if($imm[1] == 0 && (!$sett[72] || $sett[72] == 2)) $sr_rp = str_replace('<#isrdlnk#>','<;>',$sr_rp);
else $sr_rp = str_replace("<#rdlnk#>","pxxx.fpass('del_reple','{$imm[3]}','{$cc}','{$xx}','','{$_GET['comment']}','{$id}')",$sr_rp);
if($cup < 9 && $sss[25] !== 'a' && $sss[25] <= $mbr_level) {
$sr_rp = str_replace("<#rrlnk#>","rrp({$mbr_level},'{$cc}','{$_GET['comment']}','{$cup}')",$sr_rp);
$sr_rp = str_replace("<#rrdiv#>","<div id='rpp_{$cc}' class='rrpw'></div>",$sr_rp);
} else {
$sr_rp = str_replace("<#isrrlnk#>","<;>",$sr_rp);
}
$ccd = "<a name='c{$cc}'>&nbsp;</a>";
$sr_rp = str_replace("<#name#>",name($comtm[0], $mm, 1, 1, $fmm[$mm][2], $homepage).$ccd,$sr_rp);
$sr_rp = str_replace("<#tname#>",name($comtm[0], $mm, 1, 0, $fmm[$mm][2], $homepage).$ccd,$sr_rp);
if($isrvt && $uzname != trim($comtm[0]) && (!$mm || $mm != $mbr_no)) $isrvtt = 1;else $isrvtt = 0;
if($csff[1][0]) {$sr_rp = str_replace("<#nAppr#>",(int)$comtm[1],$sr_rp);$sr_rp = str_replace("<#vtApp#>","rvote({$isrvtt},1,'{$cc}')",$sr_rp);}
if($csff[1][1]) {$sr_rp = str_replace("<#nOppo#>",(int)$comtm[2],$sr_rp);$sr_rp = str_replace("<#vtOpp#>","rvote({$isrvtt},2,'{$cc}')",$sr_rp);}
$sr_rp = str_replace("<#bdo#>",$bdo,$sr_rp);
$srkiin .= $sr_rp;
$homepage = '';
$crp[2]--;
} else fgets($fb);
} else break;
}
fclose($fb);
}
if($sss[25] !== 'a' && $crp[2] !== 'a' && $sss[25] <= $mbr_level){
$sr_rpw = tagcut('rpw',$srkin);
if($mbr_no) $sr_rpw = str_replace("<!--/--><;>","",$sr_rpw);
else if($sett[17] < 2) $sr_rpw = str_replace("<#isxlgn#>","<;>",$sr_rpw);
if(!$sett[82] || ($mbr_no && ($sett[82] == 1 || $sett[82] == 3))) $sr_rpw = str_replace("<#isatspm#>","<;>",$sr_rpw);
$cwrt = "<input type='hidden' name='id' value='{$id}' />";
$cwrt .= "<input type='hidden' name='pno' value='{$_GET['comment']}' />";
$cwrt .= "<input type='hidden' name='cc' value='{$cc}' />";
$cwrt .= "<input type='hidden' name='request' value='{$_SERVER['REQUEST_URI']}' />";
$cwrt .= "<input type='hidden' name='xx' value='{$xx}' />";
$cwrt .= "<input type='hidden' name='up' value='1' />";
$cwrt .= "<input type='hidden' name='ip' value='".md5($sessid)."' />";
$sr_rpw = str_replace("<#cwrt#>",$cwrt,$sr_rpw);
$sr_rpw = str_replace("<#yname#>",$uzname,$sr_rpw);
$srkiin .= str_replace("<#ypass#>",$uzpass,$sr_rpw);
}
$srkiin .= tagcut("rp_bottom",$srkin);
echo str_replace("<!--/-->","",preg_replace("`<#[^#]+#>`","",preg_replace("`<;>(.+)<!--/-->`sU","",$srkiin)));
if($pend) {
pagen('page',$pend,10,0);
if($_GET['page'] != 1) {
if(!$_GET['page']) $fend = --$pend;else if($_GET['page'] > 1) $fend = --$_GET['page'];else $fend = 0;
if($fend) $fend = "rplace('?".preg_replace("`&(amp;)?page=[0-9]+`","",$_SERVER['QUERY_STRING'])."&amp;page={$fend}')";
}}}
if(!$ismobile) {
?>
<script type="text/javascript" src="include/ZeroClipboard.js"></script>
<?}?>
<script type='text/javascript'>
//<![CDATA[
var clip = null;
function zclipinit() {
if($('d_clip_button')) {
clip = new ZeroClipboard.Client();
clip.glue('d_clip_button');
}}
function ffpass(tht, edit, mno, no, pno, cup, xn) {
	var tht = $(tht);
	var fx = pxxx.fpass(edit, mno, no, xn, 'x', pno, '<?=$id?>');
	if(fx != 'x') {
	tht.innerHTML = "<form method='post' action='<?=$exe?>' style='width:250px;text-align:center'><input type='hidden' name='cup' value='" + cup + "' />" + pxxx.document.passe.innerHTML + "</form>";
	}
	mdrequest();
}
function mdrequest() {
for(var i= document.getElementsByName('request').length-1;i >= 0;i--) {document.getElementsByName('request')[i].value= "<?=$_SERVER['REQUEST_URI']?>";}
}
function fpass() {
}
function rvote(isrv,ap,cc) {
if(isrv == 0) alert('권한이 없습니다');
else azax('exe.php?&id=<?=$uid?>&rvote=' + cc + '&apop=' + ap + '&xx=<?=$xx?>',9);
}
function setup() {
<?=$memb?>
pview = $('pview');
toprsz();
<?
if(!$ismobile) {
?>
setTimeout('zclipinit()',100);
<?
}
?>
setTimeout('img_resize()',100);
setTimeout('if(!isopo) img_resize()',1000);
if(pxxx && pxxx.location.href) {
var pcc = pxxx.location.href.indexOf('&cc=') + 4;
if(pcc != 3) {
pcc = pxxx.location.href.substr(pcc,7);
if($('bdo' + pcc)) {
var bdopp = $('bdo' + pcc);
if(bdopp.parentNode.parentNode) bdopp = bdopp.parentNode.parentNode;
else if(bdopp.parentNode) bdopp = bdopp.parentNode;
bdopp.className = ((bdopp.className)?bdopp.className + ' ':'') + 'seltdrp';
parent.siht = '#c' + pcc;
} else if(parent.siht != '#c' + pcc && <?=(int)$pend?> > 0) <?=$fend?>;
}}
<?
if(!$_COOKIE[$docoo] || $_COOKIE[$docoo] != $dookie) echo "document.cookie = \"{$docoo}={$dockie}\"\n";
?>
setTimeout('pxxdsht(4)',300);
if($$('antispam',0)) {
var spmnu = document.cookie.indexOf('spmnumber=');
if(spmnu != -1) {
spmnu = document.cookie.substr(spmnu + 10,14);
spmnu = spmnu.substr(0,spmnu.indexOf(';'));
if($$('pno',0).value == spmnu.substr(6)) {
$$('antispam',0).value = spmnu.substr(0,6);
chkatcode($$('pno',0).value,$$('antispam',0));
}}}
}
function pxxdsht(px) {
if(location.href.indexOf('#') == -1) {
var sihtt = pxxx.document.documentElement.scrollHeight;
if(siht != sihtt) {
siht = sihtt;
if(parent.siht && parent.siht.substr(0,2) == '#c') location.replace(parent.siht);
if(pxxx.$('curtain')) pxxx.$('curtain').style.height = sihtt + 'px';
}
px--;
if(px == 3) setTimeout('pxxdsht(3)',500);
else if(px > 0) setTimeout('pxxdsht(' + px + ')',1000);
}}
setTimeout("setup()",50);
setTimeout("if(!pview) setup()",200);
window.onbeforeunload = function(){
if(gout == 1) {
var textc = document.getElementsByName('content');
for(var i=textc.length -1;i >= 0;i--) {
if(textc[i].value) {if('<?=$isie?>' != '1' && '<?=$bwr?>' != '') prompt('복사하세요',textc[i].value.replace(/\n/g,'<br />')); else return "-----------------";}
}}}
window.onunload = function(){window.onbeforeunload();}
//]]>
</script>
<textarea id="ckdouble" rows="1" cols="1" style="width:0;height:0;border:0;visibility:hidden"><?=trim(preg_replace("`<[^>]+>`", "", preg_replace("`<br />`", "\r\n", $xdouble)))?></textarea>
</body>
</html>