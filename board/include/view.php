<?
$no6 = str_pad($_GET['no'],6,0,STR_PAD_LEFT);
$plus = 0;
if($wdth[6] && $_GET['no'] <= (int)substr($do[$wdth[6]],0,6)) {
for($aa = 1; $aa <= $wdth[6]; $aa++){
if($_GET['no'] <= (int)substr($do[$aa],0,6)) {$xx = $aa;break;}
}
}
if($xx > 0) $idd = $id."/^".$xx;
else $idd = $id;
$rdoc = '';
$rdoct = 0;
$i = 0;
$ths = 0;
$brk = 1;
$fn = fopen($dxr.$idd."/no.dat","r");
while(!feof($fn)){
$uuu[$i] = fgets($fn);
if(!$sss[30] && $brk) {
$uuo = substr(trim($uuu[$i]),0,-1);
$rpn = substr($uuo,strrpos($uuo,"\x1b") + 1,1);
if($no6 == substr($uuo, 0, 6)) {$ths = 1;if($sss[55]){if($rpn == '0') $rdoc = '';$rdoc[] = $i;} else $brk = 0;}
else if($sss[55]) {
if(!$ths){
if($rdoc && $rpn == '0') $rdoc = '';$rdoc[] = $i;
} else {
if($rpn != '0') $rdoc[] = $i;else $brk = 0;
}}}
$i++;
}
fclose($fn);
if(!$sss[30]) {
if($sss[55]) {$rdoct = count($rdoc);}
if($rdoct < 2 && !$sss[30]) {$rdoct = 3;$rdoc = '';}
if($rdoct > 2) {$fcct = $rdoct;$fno = 'a';$isnt = $rdoct;$sum = $fct;$type = 'a';}
}
if(false !== strpos("^".$wdth[4],"^".$_GET['no']."^")){if($wdth[7][8] <= $mbr_level) $notice = 1;else $notice = 2;}
$fl = fopen($dxr.$idd."/list.dat","r");
$fb = fopen($dxr.$idd."/body.dat","r");
$ii = 0;
$ufu = '';
while($uuu[$ii]){
if($no6 == substr($uuu[$ii], 0, 6)) {
if(substr($uuu[$ii],6,2) == 'aa') {if($mbr_level != 9) break;else $deleted = 1;}
$ths = $ii;
$crp = explode("\x1b",$uuu[$ii]);
$mn = substr($crp[0],9);
$flo = fgets($fl);
$memo = trim(fgets($fb));
if($crp[0][8] > $mbr_level && (!$mn || $mn != $mbr_no) && $_GET['no'] && $_COOKIE["scrt_".$_GET['no'].$id] != md5($_GET['no']."_".$sessid.$id)) {
$memo = "<div class='authority' id='passv_{$id}_{$_GET['no']}' align='center'>비밀글 입니다.</div>";
if(!$mn) {$memb .= "\nsetTimeout(\"ffpass('passv_{$id}_{$_GET['no']}','{$_GET['no']}','{$xx}')\",50);";}$noright = 1;
} else if($notice == 2 || ($notice != 1 && $authority[23] && ($sss[23] == 'a' || !$mn || $mn != $mbr_no))) {$memo = $authority[0];$onload .= "\n$('authority_list').innerHTML=$('srlogin').innerHTML + '<br />";if($mbr_level && $aview == 4) $onload .= "소모임에 가입되어 있지 않습니다.<br />';";else $onload .= "본문 읽기 권한이 없습니다.<br />';";$noright = 1;}
if($deleted == 1) $memo = "<h2 class='bd_name'>삭제된 글입니다.</h2>".$memo;
if($rdoct) {$fdn[$rdoct] = $uuu[$ii];$fdl[$rdoct] = $flo;$fdb[$rdoct] = '';$rdoct--;}
$flo = explode("\x1b",$flo);
$name = $flo[1];
if(!$noright && $uzname != trim($name) && (!$mn || $mn != $mbr_no)) {
$gtt = "_".$_GET['no']."_";
if(!$_COOKIE["vst_".$id] || ($_COOKIE["vst_".$id] && false === strpos($_COOKIE["vst_".$id], $gtt))) {
if($_COOKIE["vst_".$id]) $gtt = $_COOKIE["vst_".$id].substr($gtt,1);
setcookie("vst_".$id, $gtt, $time + 86400);
$plus = 1;
$crp[1] = $crp[1] + 1;
$uuu[$ii] = $crp[0]."\x1b".$crp[1]."\x1b".$crp[2]."\x1b".$crp[3]."\x1b".$crp[4]."\x1b".$crp[5]."\x1b".$crp[6]."\x1b\n";
}}} else {
if(!$sss[30] && $rdoct && (($rdoc && in_array($ii,$rdoc)) || ($rdoc == '' && ($ii == $ths - 1 || $ii == $ths + 1)))) {$fdn[$rdoct] = $uuu[$ii];$fdl[$rdoct] = fgets($fl);$fdb[$rdoct] = strcut(fgets($fb),256);$rdoct--;}
else {fgets($fl);fgets($fb);}}
$ufu .= $uuu[$ii];
$ii++;
}
fclose($fl);
fclose($fb);
if(!$flo) {
scrhref($dxpt."&amp;p=".$gp,0,0);
exit;
}
if($plus == 1) {
if(!file_exists($dxr.$idd."/no.dat@@") && strlen($ufu) == filesize($dxr.$idd."/no.dat")) {
$nfn = fopen($dxr.$idd."/no.dat@@","w");
fputs($nfn,$ufu);
fclose($nfn);
copy($dxr.$idd."/no.dat@@",$dxr.$idd."/no.dat");
unlink($dxr.$idd."/no.dat@@");
$plus = 0;
} else {$onajax = "&nlus=".$_GET['no'];if($xx > 0) $onajax .= "&xx=".$xx;}
}
if(!$schphp && $sss[30]) {
if(($type == 'a' || $type == 'e') && $wdth[4]) {$nss = explode('^', $wdth[4]);$nsc = count($nss) -1;$nscc = $nsc;}
if($wdth[6] && $xx) $px = $fct - substr($do[$xx],6,6);$gp = (int)(($ths + $nscc + (int)$px)/$isnt) + 1;$_GET['p'] = $gp;}
if($type == 'd') {echo "<script type='text/javascript'>rplace('{$dxpt}&amp;p={$gp}&amp;rp={$_GET['no']}&amp;cc={$_GET['cc']}')</script>";exit;}
if($mn) {
$fim = fopen($dim,"r");
while($fm = fgets($fim)) {
if((int)substr($fm,0,5) == $mn) {
$fmm = explode("\x1b",$fm);
break;
}}
fclose($fim);
if($sett[83] && $mn == $mbr_no) notiff($mn,0,$id10.$no6,0);
}
$ctt = substr($crp[0], 6, 2);
$date = substr($flo[0], 0, 10);
if(!$sss[31]) $flo[5] = '';
$sr_body = tagcut('body',$srkin);
$ipr = trim(substr($flo[0], 10, 15));
if($ipr && (!$mn || $sss[44] < 3) && ($mbr_level == 9 || ($sss[44] != 2 && $sss[44] != 9 && ($mbr_level || $sss[44] == 0 || $sss[44] == 7)))) $sr_body = str_replace("<#ipr#>",$ipr,$sr_body);
else $sr_body = str_replace("<#isipr#>","<;>",$sr_body);
if(!$wdth[7][32] && $flo[6]) {
$tagg = explode(",",$flo[6]);
$tag = "<div class='tagg'><img src='icon/tag.gif' alt='' /> ";
foreach($tagg as $taggi){if($taggi) {
if($_GET['search'] == 't') $taggi = skword($taggi);
$tag .= "<a href='?id={$eid}&amp;search=t&amp;keyword=".urlencode($taggi)."&amp;p=1'>{$taggi}</a>, ";
}}
$tag = substr($tag, 0, -2)."</div>";
}
if($mn && $sss[46]) {
$m8 = file_exists("icon/m80_".$mn);
if($m8 && ($a = @fopen("icon/m02_".$mn,"r"))) {
if($m8) $sr_body = str_replace("<#sign12#>","<img src='icon/m80_{$mn}' style='width:80px;height:80px;float:left' alt='' />",$sr_body);
if($a) {$sr_body = str_replace("<#sign02#>",fread($a,filesize("icon/m02_".$mn)),$sr_body);fclose($a);}
} else $sr_body = str_replace("<#issign#>","<;>",$sr_body);
} else $sr_body = str_replace("<#issign#>","<;>",$sr_body);
function skeyw($memo) {
$mlt = explode('<',$memo);
$memo = '';
foreach($mlt as $mtt) {
$memo .= '<';
if(($msp = strpos($mtt,'>')) !== false) {
$memo .= substr($mtt,0,$msp);
$mtt = substr($mtt,$msp);
}
if($mtt) $memo .= skword($mtt);
}
return substr($memo,1);
}
?>
<script type='text/javascript'>/*<![CDATA[*/var xxn="<?=$xx?>";var ono="<?=$_GET['no']?>";document.title="[<?=$sett[0]?>] <?=$wdth[1]?> - <?=str_replace('"','',$flo[3])?>";/*]]>*/</script>
<?
if($_GET['search']) {
if($_GET['search'] == 's') $flo[3] = skword($flo[3]);
if($_GET['search'] == 'n') $name = str_replace($_GET['keyword'], "<span class='keyword'>{$_GET['keyword']}</span>",$name);
if($_GET['search'] == 'b') {$memo = skeyw($memo);}
}
if($ctg[$ctt]) $isnct = "";
else $isnct = "<;>";
if($crp[6][0] > 0) {
$insert = "";
for($r = $crp[6][0];$r > 0; $r--) $insert = $insert."re:";
$flo[3] = "<font class='t8'>".$insert."</font> ".$flo[3];
}
$url = "?".str_replace("&","&amp;",preg_replace("`(\?|&)(no|rp|p|slys)=[^&]+`i","",$_SERVER['QUERY_STRING']))."&amp;p=".$_GET['p'];
if(!$flo[5]) $isnlink = "<;>";
if($sss[54] && !$notice && $noright != 1) {
$addfield = explode("\x1b",$memo);
$memo = $addfield[0];
if($fv = @fopen($dxr.$id."/view.html","r")) {
$fvo ='';
while(!feof($fv)) {
$fvo .= fgets($fv);
}
eval("\$fvo=\"$fvo\";");
$memo = $fvo.$memo;
fclose($fv);
}} else if($aview >= 4 && !$noright) $onload .= "\nsetTimeout(\"aview('{$id}','{$_GET['no']}','{$xx}')\",150);";
?>
<div style='height:19px'>&nbsp;</div>
<?
$depth = $crp[6][0] + 1;
if($fh = @fopen($dxr.$id."/middle.dat","r")) {while(!feof($fh)) {$memo .= fgets($fh);}fclose($fh);}
$sr_body = str_replace("<#no#>",$_GET['no'],$sr_body);
$nvote = explode('|',$crp[5]);
if($wdth[7][5]) {
if(!$noright) {
$ratng = ($nvote[1])? sprintf("%.2f",$nvote[0]/$nvote[1]):0;
$memo .= "<div class='rating'><div class='rating_bg'><div class='rating_st' style='float:left;width:".(int)($ratng*25)."px'><img src='icon/t.gif' alt='' /></div></div><div style='float:left;padding-left:20px'>".($ratng*2)."점 <span class='f8'>(참여:".(int)$nvote[1]."명)</span></div>";
if($mbr_level >= $wdth[9][0] && (!$mn || $mn != $mbr_no)) $memo .= "<div onclick=\"this.childNodes[1].style.display=(this.childNodes[1].style.display=='block')?'none':'block'\" style='float:right;width:128px'><div class='rating_set'>평점</div><fieldset class='rating_fd' onclick='if(this.style.height == \"126px\") this.style.height=\"0px\"'>
<div class='rating_sel' onclick=\"vote('s0','{$xx}','{$_GET['no']}')\"><div class='rating_st' style='width:0px'></div></div>
<div class='rating_sel' onclick=\"vote('s1','{$xx}','{$_GET['no']}')\"><div class='rating_st' style='width:25px'>&nbsp;</div></div>
<div class='rating_sel' onclick=\"vote('s2','{$xx}','{$_GET['no']}')\"><div class='rating_st' style='width:50px'>&nbsp;</div></div>
<div class='rating_sel' onclick=\"vote('s3','{$xx}','{$_GET['no']}')\"><div class='rating_st' style='width:75px'>&nbsp;</div></div>
<div class='rating_sel' onclick=\"vote('s4','{$xx}','{$_GET['no']}')\"><div class='rating_st' style='width:100px'>&nbsp;</div></div>
<div class='rating_sel' onclick=\"vote('s5','{$xx}','{$_GET['no']}')\"><div class='rating_st' style='width:125px'>&nbsp;</div></div>
</fieldset></div>";
$memo .= "<div class='fcler'></div></div>";
}} else {
if($sss[60]) $sr_body = str_replace("<#nAppr#>",(int)$nvote[0],$sr_body);
if($sss[61]) $sr_body = str_replace("<#nOppo#>",(int)$nvote[1],$sr_body);
}
if($crp[6][0] === 'a' || $crp[6][0] == 9 || $sss[24] === 'a' || $sss[24] > $mbr_level || !$sss[55] || $sss[54] || $xx || $sss[63] || $sss[26] == 'd') $sr_body = str_replace('<#frited#>','<;>',$sr_body);
$sr_body = imn($mn,$date,$sr_body,$_GET['no'],$xx);
$sr_body = str_replace("<#xx#>",$xx,$sr_body);
$sr_body = str_replace("<#url#>",$url,$sr_body);
$sr_body = str_replace("<#subject#>",$flo[3],$sr_body);
$sr_body = str_replace("<#name#>",name($name, $mn, 0, 1, $fmm[2], $fmm[10]),$sr_body);
$sr_body = str_replace("<#tname#>",name($name, $mn, 0, 0, $fmm[2], $fmm[10]),$sr_body);
$sr_body = str_replace("<#isnct#>",$isnct,$sr_body);
if($isnct != "<;>") {
$sr_body = str_replace("<#ct_no#>",$ctt,$sr_body);
$sr_body = str_replace("<#ct_name#>",$ctg[$ctt],$sr_body);
}
$sr_body = str_replace("<#nHit#>",(int)$crp[1],$sr_body);
$sr_body = str_replace("<#nReply#>",(int)$crp[2],$sr_body);
$sr_body = str_replace("<#nTrb_out#>",(int)$crp[3],$sr_body);
$sr_body = str_replace("<#nTrb_in#>",(int)$crp[4],$sr_body);
$sr_body = str_replace("<#date#>",@date("Y-m-d H:i", $date),$sr_body);
$sr_body = str_replace("<#memo#>",nocopy($memo),$sr_body);
$sr_body = str_replace("<#isnlink#>",$isnlink,$sr_body);
$sr_body = str_replace("<#rlink#>",str_replace("&","&amp;",$flo[5]),$sr_body);
$sr_body = str_replace("<#tag#>",$tag,$sr_body);
if(!$noright) $sr_body = str_replace("<#uplist#>",uplist($_GET['no']),$sr_body);
$sr_body = str_replace("<#depth#>",$depth,$sr_body);
if($inclwt=inclvde($sr_body)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) include($inxv[1]);else echo $inxv[1];}
if($_GET['no'] && $type == 'b') $type = 'a';
?>
<script type='text/javascript'>
//<![CDATA[
function cfsz(size) {
for(var i = -1;i < 1 || $('bdo' + i);i++) {
if($('bdo' + i)) {
$('bdo' + i).style.fontSize = size + "pt";
}
}
var ifr = document.getElementsByTagName('iframe');
if(ifr) {
var ifrl = ifr.length;
for(var i = 0;i < ifrl;i++) {
if(ifr[i].src && ifr[i].src.indexOf('comment=') != -1) {
var ifdv = ifr[i].contentWindow.document.getElementsByTagName('div');
var ifdvl = ifdv.length;
for(var ii = 0;ii < ifdvl;ii++) {
if(ifdv[ii].className == 'bdo') ifdv[ii].style.fontSize = size + 'pt';
}}}}
document.cookie = "cfsz="+ size + ";expire=<?=$time + 86400?>;path=/;";
}
if('<?=$fz?>' !='' && $('cfsz')) $('cfsz').value='<?=$fz?>';
//]]>
</script>
