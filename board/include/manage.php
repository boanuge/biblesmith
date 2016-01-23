<?
$cnt = 10; // 게시판관리에서 하나의 목록번호에 나열할 게시판 갯수
if($mbr_level == 9) {
$_SERVER['QUERY_STRING'] = str_replace("&","&amp;",$_SERVER['QUERY_STRING']);
?>
<center style="margin:70px 0 70px 0">
<table cellpadding='0px' cellspacing='0px' width='950px'>
<tr><td style='border-style:solid;border-color:#3A5E90;border-width:1px 1px 0 1px;background-color:#5289CC'>
<table cellpadding='0px' cellspacing='0px' width='100%'>
<tr><td style='height:30px;margin:0;border-style:solid;border-color:#5289CC;border-width:1px 1px 0 1px;background-color:#2A5EB2;width:100%;padding-left:15px'>
<div id='tit_1' class='section_title<? if($_POST['ffilex'] != 'find' && $_SERVER['QUERY_STRING'] == '') echo "2";?>' onclick="location.href='?'">전체설정</div>
<img src='icon/t.gif' class='section_title_between<? if($_GET['board'] || ($_POST['ffilex'] != 'find' && $_SERVER['QUERY_STRING'] =='')) echo "2";?>' alt='' /><div class='section_title<? if($_GET['board']) echo "2";?>' onclick="location.href='?board=1'">게시판관리</div>
<img src='icon/t.gif' class='section_title_between<? if($_GET['board'] || $_GET['drct'] || $_POST['ffilex'] == 'find') echo "2";?>' alt='' /><div class='section_title<? if($_GET['drct'] || $_POST['ffilex'] == 'find') echo "2";?>' onclick="location.href='?drct=<?=$dxr?>'">파일관리</div>
<img src='icon/t.gif' class='section_title_between<? if($_GET['drct'] || $_POST['ffilex'] == 'find' || $_GET['member']) echo "2";?>' alt='' /><div class='section_title<? if($_GET['member']) echo "2";?>' onclick="location.href='?member=1'">회원관리</div>
<img src='icon/t.gif' class='section_title_between<? if($_GET['member'] || $_GET['section']) echo "2";?>' alt='' /><div class='section_title<? if($_GET['section']) echo "2";?>' onclick="location.href='?section=1'">섹션관리</div>
<img src='icon/t.gif' class='section_title_between<? if($_GET['section'] || $_GET['statistics']) echo "2";?>' alt='' /><div class='section_title<? if($_GET['statistics']) echo "2";?>' onclick="location.href='?statistics=1'">접속통계</div>
<img src='icon/t.gif' class='section_title_between<? if($_GET['statistics']) echo "2";?>' alt='' /><div class='section_title' onclick="nwopn('<?=$index?>?mbr_info=1')">관리자정보</div>
</td></tr>
</table></td></tr>
<tr><td style='border-style:solid;border-color:#D4D4D4;border-width:0px 1px 1px 1px;background-color:#F7F7F7;padding:0px 1px 1px 1px;text-align:center'>
<?
function rtchecked($val) {
if($val && $val != '0') return "checked='checked'";
else return "";
}
if($_GET['board']) {
?>
<form name="bdstfm" method="post" action="<?=$admin?>" style="margin:0">
<input type='hidden' name='from' value='<?=$_SERVER['SCRIPT_NAME']?>?<?=$_SERVER['QUERY_STRING']?>' />
<table border='0px' cellpadding='3px' cellspacing='1px' class='ttb' style='table-layout:fixed'>
<colgroup><col width='38px' /><col width='55px' /><col width='90px' /><col width='65px' /><col width='32px' /><col width='210px' /><col width='260px' /><col width='150px' /></colgroup>
<tr><td colspan='8'>
<div id='admtip' style='width:920px'>게시판관리</div></td></tr>
<tr class='bdhdr'><td>링크</td><td>게시판ID</td><td>게시판이름</td><td onmouseover='vwtip(this,0)'>목록형태</td><td onmouseover='vwtip(this,2)'>분류</td><td onmouseover='vwtip(this,3)'>번호/이름/분류/날짜/조회/추천/비추</td><td style='text-align:left'><span onmouseover='vwtip(this,4)'>목록 </span>/<span onmouseover='vwtip(this,5)'> 읽기 </span>/<span onmouseover='vwtip(this,6)'> 쓰기 </span>/<span onmouseover='vwtip(this,7)'> 덧글 </span>/<span onmouseover='vwtip(this,48)'> 업로드 </span>/<span onmouseover='vwtip(this,37)'> 다운 </span>/<span onmouseover='vwtip(this,38)'> 공지</span></td>
<td>스킨 / 추가설정</td></tr>
<?
function temp297($val,$vn) {
global $sett;
if($val == '') $val = $sett[$vn];
return (int)$val;
}
$scx = "";
$secx = fopen($dxr."section.dat","r");
for($sx = 1;!feof($secx);$sx++) {$sc = explode("\x1b",fgets($secx));$scx[$sx] = array($sc[0],"^".$sc[2]."^");}
fclose($secx);
$i = 0;
$iy = 0;
$jaccum = '';
$stt = ($_GET['board'] - 1)*$cnt;
$ett = $stt + $cnt;
$fs = fopen($ds,"r");
$fc = fopen($dc,"r");
while(!feof($fs)) {
$bdset = fgets($fs);
$dcfile = fgets($fc);
if(trim($bdset)){
$bid = trim(substr($bdset, 0, 10));
if($i >= $stt && $i < $ett){
$i1 = $i + 1;
$tct = explode("\x1b", $bdset);
$ctct = substr_count($dcfile,"\x1b") - 1;
$tct_pn = substr($tct[0],50,2);
$tct_qh = substr($tct[0],57,2);
$csff = array('','00');
$csf = $dxr.$bid."/set.dat";
if(file_exists($csf) && $csf = @fopen($csf,"r")) {
$csff[0] = trim(fgets($csf));$csff[1] = trim(fgets($csf));fclose($csf);
}
?>
<tr onmouseover='this.style.background="#FFF29B"' onmouseout='this.style.background=""' style='text-align:center'>
<td><input type='hidden' name='order[]' value='<?=$i?>' /><a target='_blank' href='<?=$index?>?id=<?=$bid?>&amp;p=1' class='f7'>&nbsp;<?=$i1?>&nbsp;</a></td>
<td><input type='text' name='id[]' maxlength='10' value='<?=$bid?>' readonly='readonly' onclick="idchg(this)" /><input type='hidden' name='idd[]' value='<?=$bid?>' /></td>
<td><input type='text' name='nam[]' value='<?=str_replace("&","&amp;",$tct[1])?>' style='width:80px' /></td>
<td><select name='pt[]'>
<option value='a' <?=seltd('a',$tct[0][26])?>>제목형</option>
<option value='b' <?=seltd('b',$tct[0][26])?>>본문형</option>
<option value='c' <?=seltd('c',$tct[0][26])?>>요약형</option>
<option value='g' <?=seltd('g',$tct[0][26])?>>갤러리</option>
<option value='d' <?=seltd('d',$tct[0][26])?>>방명록</option>
<option value='e' <?=seltd('e',$tct[0][26])?>>블로그</option>
<option value='k' <?=seltd('k',$tct[0][26])?>>달력형</option>
</select>
</td>
<td><input type='button' onclick="popup('<?=$admin?>?mst=<?=$i1?>', 300, 200)" value='<?=$ctct?>' class='button' style='width:25px' /></td>
<td style='height:25px' align='center'><input type='hidden' name='pd[]' value='<?=$tct[0][38]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][38])?> class='no mgn5' title='번호' /><input type='hidden' name='pe[]' value='<?=$tct[0][39]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][39])?> class='no mgn5'  title='이름' /><input type='hidden' name='pj[]' value='<?=$tct[0][48]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][48])?> class='no mgn5'  title='분류' /><input type='hidden' name='pf[]' value='<?=$tct[0][40]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][40])?> class='no mgn5'  title='날짜' /><input type='hidden' name='pg[]' value='<?=$tct[0][41]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][41])?> class='no mgn5'  title='조회' /><input type='hidden' name='ph[]' value='<?=$tct[0][42]?>' /><input type='checkbox' onclick="chkchk3(this,<?=$iy?>,1)" <?=rtchecked($tct[0][42])?> class='no mgn5'  title='추천' /><input type='hidden' name='qk[]' value='<?=$tct[0][59]?>' /><input type='checkbox' onclick="chkchk3(this,<?=$iy?>,2)" <?=rtchecked($tct[0][59])?> class='no mgn5'  title='비추' />
</td>
<td>
<select class='w30' name='pl[]' onmouseover='vwtip("",4)'><?=degree($tct[0][22],1)?></select>
<select class='w30' name='pr[]' onmouseover='vwtip("",5)'><?=degree($tct[0][23],1)?></select>
<select class='w30' name='pw[]' onmouseover='vwtip("",6)'><?=degree($tct[0][24],1)?></select>
<select class='w30' name='pc[]' onmouseover='vwtip("",7)'><?=degree($tct[0][25],1)?></select>
<select class='w30' name='re[]' onmouseover='vwtip("",48)'><?=degree($tct[7][31],1)?></select>
<select class='w30' name='qo[]' onmouseover='vwtip("",37)'><?=degree($tct[7][3],1)?></select>
<select class='w30' name='qt[]' onmouseover='vwtip("",38)'><?=degree($tct[7][8],0)?></select>
</td>
<td>
&nbsp;<select name='tct1[]' style='width:80px'><?=$skinoption?></select>
&nbsp;<a href='#none' onclick="toggle('bdwdth<?=$iy?>')" onmouseover='vwtip(this,9)'>추가설정</a></td></tr>
<tr><td colspan='8'><div id='bdwdth<?=$iy?>' class='exsett'><h4>추가 설정</h4>
&nbsp;최근글: <input type='text' name='lastno[]' value='<?=substr($tct[0], 10, 6)?>' style='width:40px' maxlength='6' /><input type='hidden' name='wlastno[]' value='<?=substr($tct[0], 10, 6)?>' />
&nbsp;총갯수: <input type='text' name='cnt[]' value='<?=substr($tct[0], 16, 6)?>' style='width:40px'  maxlength='6' /><input type='hidden' name='wcnt[]' value='<?=substr($tct[0], 16, 6)?>' />
&nbsp;업로드번호: <input type='text' value='<?=$tct[5]?>' style='width:40px' disabled='disabled' />
&nbsp;분산저장횟수: <input type='text' value='<?=$tct[6]?>' style='width:40px' disabled='disabled' />
&nbsp;<span onmouseover='vwtip(this,10)'>게시판관리자</span> : <input type='text' name='tct2[]' value='<?=$tct[3]?>' style='width:70px' />
&nbsp;공지글목록 : <input type='text' value='<?=$tct[4]?>' style='width:150px' disabled='disabled' />
&nbsp;<input type='button' onclick='if(confirm("게시판을 삭제하시겠습니까")) dell("<?=$iy?>")' value='게시판삭제' class='button' style='width:70px' />
<div style='padding:10px 0 10px 20px;text-align:left'>
&nbsp;<span onmouseover='vwtip(this,11)'>목록상단</span>::
&nbsp;<span onmouseover='vwtip(this,12)'>분류출력 </span><select name='py[]'><option value='0' <?=seltd('0',$tct[0][27])?>>출력안함</option><option value='1' <?=seltd('1',$tct[0][27])?>>선택상자</option><option value='2' <?=seltd('2',$tct[0][27])?>>분류박스</option></select>
&nbsp;<span onmouseover='vwtip(this,13)'>항목별정렬선택상자 </span><input type='hidden' name='pa[]' value='<?=$tct[0][45]?>' /><input type='checkbox' onclick="chkchk(this,<?=$iy?>)" <?=rtchecked($tct[0][45])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,15)'>목록형태고정 </span><input type='hidden' name='qa[]' value='<?=$tct[0][53]?>' /><input type='checkbox' onclick="chkchk5(this,<?=$iy?>)" <?=rtchecked($tct[0][53])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,46)'>항목나열위치 </span><select name='rd[]'><option value='0' <?=seltd('0',$tct[7][30])?>>감춤</option><option value='1' <?=seltd('1',$tct[7][30])?>>목록상단</option><option value='2' <?=seltd('2',$tct[7][30])?>>목록하단</option></select>
<br />&nbsp;<span>목록관련</span>::
&nbsp;<span onmouseover='vwtip(this,1)'>목록갯수</span>: <input type='text' name='po[]' maxlength='2' value='<?=substr($tct[0], 36, 2)?>' style='width:25px' />
&nbsp;<span onmouseover='vwtip(this,20)'>항목별정렬 </span><input type='hidden' name='pi[]' value='<?=$tct[0][47]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][47])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,16)'>본문하단목록 </span><input type='hidden' name='pz[]' value='<?=$tct[0][30]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][30])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,49)'>NEW표시 </span><input type='hidden' name='qp[]' value='<?=$tct[7][4]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[7][4])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,50)'>HOT표시 </span><select name='rg[]' onchange='chkchk4(this,<?=$iy?>)'><option value='0' <?=seltd('0',$tct[8][1])?>>감춤</option><option value='1' <?=seltd('1',$tct[8][1])?>>조회수</option><option value='2' <?=seltd('2',$tct[8][1])?>>덧글수</option><option value='3' <?=seltd('3',$tct[8][1])?>>추천수</option><option value='4' <?=seltd('4',$tct[8][1])?>>평점</option><option value='5' <?=seltd('5',$tct[8][1])?>>평가자수</option></select><input type='text' name='rh[]' value='<?=substr($tct[8],2)?>' style='width:40px' />이상 
<br />&nbsp;<span>본문관련</span>::
&nbsp;<select name='pk[]'><option value='0' <?=seltd('0',$tct[0][49])?>>사용안함</option><option value='1' <?=seltd('1',$tct[0][49])?>>엮인글허용</option><option value='2' <?=seltd('2',$tct[0][49])?>>게시물신고</option></select>
&nbsp;<span title=''>답글허용 </span><input type='hidden' name='qc[]' value='<?=$tct[0][55]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][55])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,17)'>글쓴이서명 </span><input type='hidden' name='pb[]' value='<?=$tct[0][46]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][46])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,18)'>본문링크표시 </span><input type='hidden' name='pp[]' value='<?=$tct[0][31]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][31])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,14)'>rss출력 </span><input type='hidden' name='px[]' value='<?=$tct[0][29]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][29])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,19)'>rss본문길이제한 </span><input type='hidden' name='qj[]' value='<?=$tct[7][1]?>' /><input type='checkbox' onclick="chkck(this)" <?=rtchecked($tct[7][1])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,32)'>글자크기 </span><select name='pn[]'><option value='08' <?=seltd('08',$tct_pn)?>>8pt</option><option value='09' <?=seltd('09',$tct_pn)?>>9pt</option><option value='10' <?=seltd('10',$tct_pn)?>>10pt</option><option value='11' <?=seltd('11',$tct_pn)?>>11pt</option><option value='12' <?=seltd('12',$tct_pn)?>>12pt</option><option value='13' <?=seltd('13',$tct_pn)?>>13pt</option><option value='14' <?=seltd('14',$tct_pn)?>>14pt</option><option value='15' <?=seltd('15',$tct_pn)?>>15pt</option><option value='18' <?=seltd('18',$tct_pn)?>>18pt</option></select>
&nbsp;<span onmouseover='vwtip(this,33)'>글꼴 </span><select name='qi[]'><option value='0' <?=seltd('0',$tct[8][0])?>>굴림</option><option value='1' <?=seltd('1',$tct[8][0])?>>돋움</option><option value='2' <?=seltd('2',$tct[8][0])?>>바탕</option><option value='3' <?=seltd('3',$tct[8][0])?>>궁서</option><option value='4' <?=seltd('4',$tct[8][0])?>>맑은고딕</option><option value='5' <?=seltd('5',$tct[8][0])?>>Arial</option><option value='6' <?=seltd('6',$tct[8][0])?>>Tahoma</option><option value='7' <?=seltd('7',$tct[8][0])?>>Verdana</option><option value='8' <?=seltd('8',$tct[8][0])?>>Trebuchet MS</option><option value='9' <?=seltd('9',$tct[8][0])?>>sans-serif</option></select>
<br />&nbsp;<span>추가입력</span>::
&nbsp;<span onmouseover='vwtip(this,21)'>추가입력 </span><input type='hidden' name='qb[]' value='<?=$tct[0][54]?>' /><input type='checkbox' onclick='chkchk2(this)' <?=rtchecked($tct[0][54])?> class='no' /><span<? if(!$tct[0][54]) echo " style='display:none'";?>>&nbsp;<a href="#none" onmouseover="vwtip(this,62)" onclick="vwedit('<?=$bid?>',1)">view.html</a>, <a href="#none" onmouseover="vwtip(this,63)" onclick="vwedit('<?=$bid?>',2)">write.html</a>, <span onmouseover="vwtip(this,64)">목록출력 </span><input type='hidden' name='qd[]' value='<?=$tct[7][0]?>' /><input type='checkbox' onclick='chkchk2(this)' <?=rtchecked($tct[7][0])?> class='no' /></span>
<br />&nbsp;<span>기타설정</span>::
&nbsp;<span onmouseover='vwtip(this,22)'>업로드크기제한 </span><input type='hidden' name='rc[]' value='<?=$tct[7][9]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[7][9])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,34)'>IP 기록제외 </span><select name='qe[]'><option value='0' <?=seltd('0',$tct[0][43])?>>모두제외</option><?=degree($tct[0][43],3)?><option value='a' <?=seltd('a',$tct[0][43])?>>모두사용</option></select>
&nbsp;<span onmouseover='vwtip(this,24)'>IP 노출설정 </span><select name='qf[]'><option value='0' <?=seltd('0',$tct[0][44])?>>모든ip 모두에게</option><option value='1' <?=seltd('1',$tct[0][44])?>>모든ip 회원에게</option><option value='2' <?=seltd('2',$tct[0][44])?>>모든ip 관리자에게</option><option value='7' <?=seltd('7',$tct[0][44])?>>비회원ip 모두에게</option><option value='8' <?=seltd('8',$tct[0][44])?>>비회원ip 회원에게</option><option value='9' <?=seltd('9',$tct[0][44])?>>비회원ip 관리자에게</option></select>
&nbsp;<span onmouseover='vwtip(this,51)'>업로드경로변경 </span><select name='ri[]'><option value='0' <?=seltd('0',$tct[7][33])?>>기본</option><option value='1' <?=seltd('1',$tct[7][33])?>>노출경로</option></select>
<br />&nbsp;<span>기타설정</span>::
&nbsp;<span onmouseover='vwtip(this,47)'>태그안씀 </span><input type='hidden' name='rf[]' value='<?=$tct[7][32]?>' /><input type='checkbox' onclick="chkck(this)" <?=rtchecked($tct[7][32])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,36)'>불펌방지 </span>  <select name='qn[]' onchange='chkchk4(this,<?=$iy?>)'><option value='0' <?=seltd('0',$tct[7][2])?>>사용안함</option><option value='1' <?=seltd('1',$tct[7][2])?>>1단계</option><option value='2' <?=seltd('2',$tct[7][2])?>>2단계</option><option value='3' <?=seltd('3',$tct[7][2])?>>3단계</option><option value='4' <?=seltd('4',$tct[7][2])?>>4단계</option><option value='5' <?=seltd('5',$tct[7][2])?>>5단계 대화상자</option><option value='6' <?=seltd('6',$tct[7][2])?>>6단계  대화상자</option></select>
&nbsp;<span onmouseover='vwtip(this,44)'>최근글제외 </span><input type='hidden' name='qg[]' value='<?=$tct[0][56]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][56])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,45)'>최근덧글제외 </span><input type='hidden' name='ps[]' value='<?=$tct[0][52]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][52])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,52)'>회원로그제외 </span><input type='hidden' name='rj[]' value='<?=$tct[0][62]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][62])?> class='no' />
<br />&nbsp;<span>추천설정</span>::
&nbsp;<span onmouseover='vwtip(this,29)'>추천사용 </span><input type='hidden' name='ql[]' value='<?=$tct[0][60]?>' /><input type='checkbox' onclick="chkchk3(this,<?=$iy?>,3)" <?=rtchecked($tct[0][60])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,29)'>비추사용 </span><input type='hidden' name='qm[]' value='<?=$tct[0][61]?>' /><input type='checkbox' onclick="chkchk3(this,<?=$iy?>,4)" <?=rtchecked($tct[0][61])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,39)'>평점사용 </span><input type='hidden' name='qq[]' value='<?=$tct[7][5]?>' /><input type='checkbox' onclick="chkchk6(this,<?=$iy?>)" <?=rtchecked($tct[7][5])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,65)'>추천권한 </span> <select name='rv[]'><?=degree($tct[9][0],4)?></select>
&nbsp;<span onmouseover='vwtip(this,67)'>피추천회원 포인트 </span>  <select name='ry[]'><option value='0' <?=seltd('0',$tct[9][6])?>>사용안함</option><? if($tct[0][60]) {?><option value='1' <?=seltd('1',$tct[9][6])?>>추천만 가산</option><?} if($tct[0][61]) {?><option value='2' <?=seltd('2',$tct[9][6])?>>비추만 감산</option><?} if($tct[0][60] && $tct[0][61]) {?><option value='3' <?=seltd('3',$tct[9][6])?>>추천비추 가감</option><?} if($tct[7][5]) {?><option value='1' <?=seltd('1',$tct[9][6])?>>평점 중간점수이상 가산</option><option value='2' <?=seltd('2',$tct[9][6])?>>평점 중간점수이하 감산</option><option value='3' <?=seltd('3',$tct[9][6])?>>평점 중간점수기준 가감</option><?}?></select>
&nbsp;피추천수의 <input type='text' name='rz[]' value='<?=(int)substr($tct[9],7,4)?>' maxlength='4' style='width:30px' onmouseover='vwtip(this,68)' />%를 적립
<br />&nbsp;<span>덧글설정</span>::
&nbsp;<span onmouseover='vwtip(this,69)'>덧글스킨설정 </span><select name='csf[]' style='width:80px'><option value=''></option><?=$skinoption?></select>
&nbsp;<span onmouseover='vwtip(this,70)'>덧글추천사용 </span><input type='hidden' name='cql[]' value='<?=$csff[1][0]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($csff[1][0])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,71)'>덧글비추사용 </span><input type='hidden' name='cqm[]' value='<?=$csff[1][1]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($csff[1][1])?> class='no' />
<br />&nbsp;<span>특수기능</span>::
&nbsp;<span onmouseover='vwtip(this,53)'>rss리더 </span><input type='hidden' name='rk[]' value='<?=$tct[0][63]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][63])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,54)'>익명게시판 </span><input type='hidden' name='rl[]' value='<?=$tct[0][64]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][64])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,55)'>활성순정렬 </span><input type='hidden' name='rm[]' value='<?=$tct[0][65]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][65])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,56)'>본문삭제를 숨김으로 </span><input type='hidden' name='rn[]' value='<?=$tct[0][66]?>' /><input type='checkbox' onclick='chkck(this)' <?=rtchecked($tct[0][66])?> class='no' />
<br />&nbsp;<span onmouseover='vwtip(this,57)'>변경금지</span>::
&nbsp;<span onmouseover='vwtip(this,57)'>본문 </span><select name='ro[]'><option value='0' <?=seltd('0',$tct[0][67])?>>금지해제</option><option value='1' <?=seltd('1',$tct[0][67])?>>수정금지</option><option value='2' <?=seltd('2',$tct[0][67])?>>삭제금지</option><option value='3' <?=seltd('3',$tct[0][67])?>>모두금지</option></select>
&nbsp;<span onmouseover='vwtip(this,57)'>덧글 </span><select name='rp[]'><option value='0' <?=seltd('0',$tct[0][68])?>>금지해제</option><option value='1' <?=seltd('1',$tct[0][68])?>>수정금지</option><option value='2' <?=seltd('2',$tct[0][68])?>>삭제금지</option><option value='3' <?=seltd('3',$tct[0][68])?>>모두금지</option></select>
&nbsp;<span onmouseover='vwtip(this,57)'>회원레벨 </span><select class='w30' name='rq[]' onmouseover='vwtip("",57)'><?=degree($tct[0][79],0)?></select> 이상은 금지해제됨
<br />&nbsp;<span>미리보기</span>::
&nbsp;<span onmouseover='vwtip(this,8)'>본문미리보기 </span><select name='pv[]'><option value='1' <?=seltd('1',$tct[0][28])?>>모두사용</option><option value='2' <?=seltd('2',$tct[0][28])?>>대문에만</option><option value='3' <?=seltd('3',$tct[0][28])?>>목록에만</option><option value='0' <?=seltd('0',$tct[0][28])?>>모두차단</option></select>
&nbsp;<span onmouseover='vwtip(this,26)'>덧글미리보기 </span><select name='rr[]'><option value='1' <?=seltd('1',$tct[0][70])?>>모두사용</option><option value='2' <?=seltd('2',$tct[0][70])?>>대문에만</option><option value='3' <?=seltd('3',$tct[0][70])?>>목록에만</option><option value='0' <?=seltd('0',$tct[0][70])?>>모두차단</option></select>
<br />&nbsp;<span>대문/목록</span>::
&nbsp;<span onmouseover='vwtip(this,58)'>덧글링크 </span><select name='rs[]'><option value='1' <?=seltd('1',$tct[0][71])?>>모두사용</option><option value='2' <?=seltd('2',$tct[0][71])?>>대문에만</option><option value='3' <?=seltd('3',$tct[0][71])?>>목록에만</option><option value='0' <?=seltd('0',$tct[0][71])?>>모두차단</option></select>
&nbsp;<span onmouseover='vwtip(this,59)'>링크표시 </span><select name='pu[]'><option value='1' <?=seltd('1',$tct[0][32])?>>모두사용</option><option value='2' <?=seltd('2',$tct[0][32])?>>대문에만</option><option value='3' <?=seltd('3',$tct[0][32])?>>목록에만</option><option value='0' <?=seltd('0',$tct[0][32])?>>모두차단</option></select>
&nbsp;<span onmouseover='vwtip(this,60)'>썸네일노출 </span><select name='rt[]'><option value='1' <?=seltd('1',$tct[0][72])?>>모두사용</option><option value='2' <?=seltd('2',$tct[0][72])?>>대문에만</option><option value='3' <?=seltd('3',$tct[0][72])?>>목록에만</option><option value='0' <?=seltd('0',$tct[0][72])?>>모두차단</option></select>
&nbsp;<span onmouseover='vwtip(this,61)'>본문일부노출 </span><select name='ru[]'><option value='1' <?=seltd('1',$tct[0][73])?>>모두사용</option><option value='2' <?=seltd('2',$tct[0][73])?>>대문에만</option><option value='3' <?=seltd('3',$tct[0][73])?>>목록에만</option><option value='0' <?=seltd('0',$tct[0][73])?>>모두차단</option></select>
<br />&nbsp;<span>대문설정</span>::
&nbsp;<select name='pq[]'> <option value='1' <?=seltd('1',$tct[0][33])?> >제목형</option><option value='2' <?=seltd('2',$tct[0][33])?> >요약형</option><option value='3' <?=seltd('3',$tct[0][33])?> >썸네일</option><option value='4' <?=seltd('4',$tct[0][33])?> >탭형태</option><option value='5' <?=seltd('5',$tct[0][33])?> >뉴스형</option></select>
&nbsp;<span onmouseover='vwtip(this,25)'>글갯수</span>: <input type='text' name='pm[]' maxlength='2' value='<?=substr($tct[0], 34, 2)?>' />
&nbsp;<span onmouseover='vwtip(this,27)'>섹션선택: </span><select name='qh[]'>
<?
for($c = 1;$scx[$c][0];$c++) {$cv = str_pad($c,2,0,STR_PAD_LEFT);
?>
<option value='<?=$cv?>' <?=seltd($cv,$tct_qh)?> <?=(strpos($scx[$c][1],'^'.$bid.'^') !== false)? "style='background:#FFDD00'":"";?>><?=$scx[$c][0]?></option>
<?}?><option value='00' <?=seltd('00',$tct_qh)?> >선택안함</option><option value='xx' <?=seltd('xx',$tct_qh)?> title='게시판만 출력'>섹션없음</option></select>
<br />&nbsp;<span>포인트설정</span>::
&nbsp;<span onmouseover='vwtip(this,40)'>본문쓰기 </span>  <select name='qu[]'><option value='+' <?=seltd('+',$tct[7][10])?>>+</option><option value='-' <?=seltd('-',$tct[7][10])?>>-</option></select> <input type='text' name='qv[]' value='<?=(int)substr($tct[7],11,4)?>' maxlength='4' style='width:40px' />
&nbsp;<span onmouseover='vwtip(this,41)'>덧글쓰기</span>  <select name='qw[]'><option value='+' <?=seltd('+',$tct[7][15])?>>+</option><option value='-' <?=seltd('-',$tct[7][15])?>>-</option></select> <input type='text' name='qx[]' value='<?=(int)substr($tct[7],16,4)?>' maxlength='4' style='width:40px' />
&nbsp;<span onmouseover='vwtip(this,42)'>다운로드 </span>  <select name='qy[]'><option value='+' <?=seltd('+',$tct[7][20])?>>+</option><option value='-' <?=seltd('-',$tct[7][20])?>>-</option></select> <input type='text' name='qz[]' value='<?=(int)substr($tct[7],21,4)?>' maxlength='4' style='width:40px' />
&nbsp;<span onmouseover='vwtip(this,43)'>본문읽기 </span>  <select name='ra[]'><option value='+' <?=seltd('+',$tct[7][25])?>>+</option><option value='-' <?=seltd('-',$tct[7][25])?>>-</option></select> <input type='text' name='rb[]' value='<?=(int)substr($tct[7],26,4)?>' maxlength='4' style='width:40px' />
&nbsp;<span onmouseover='vwtip(this,66)'>추천 </span>  <select name='rw[]'><option value='+' <?=seltd('+',$tct[9][1])?>>+</option><option value='-' <?=seltd('-',$tct[9][1])?>>-</option></select> <input type='text' name='rx[]' value='<?=(int)substr($tct[9],2,4)?>' maxlength='4' style='width:40px' />
<span<? if(!$sett[15]) echo " style='display:none'";?>><br />&nbsp;<span>메일통보</span>::
&nbsp;<span onmouseover='vwtip(this,29)'>게시판관리자에게 새글 메일통보 </span><input type='hidden' name='qr[]' value='<?=$tct[7][6]?>' /><input type='checkbox' onclick="chkchk7(this,<?=$iy?>)" <?=rtchecked($tct[7][6])?> class='no' />
&nbsp;<span onmouseover='vwtip(this,29)'>글쓴이에게 덧글 메일통보 </span><input type='hidden' name='qs[]' value='<?=$tct[7][7]?>' /><input type='checkbox' onclick="chkck(this)" <?=rtchecked($tct[7][7])?> class='no' />
</span><div style='float:right;padding-right:10px'><input type='button' value='적용' onclick="bdpst(<?=$iy?>,2)" class='button' style='height:20px;width:100px' /></div></div>
<div style='float:left;width:90px'>
<?
if($tct[0][63]){
if(!$rid) $rid = $bid;
?>
&nbsp;<font color='red'><a href="#none" onclick="popup('<?=$admin?>?rss=<?=urlencode($bid)?>', 470,200);" style="color:red">rss주소 편집</a><br />&nbsp;<a target="_blank" href="<?=$exe?>?id=<?=urlencode($bid)?>&amp;read=1" style="color:red">rss리더 갱신</a><br /></font>
<?
}
?>
<input type='button' onmouseover='vwtip(this,28)' onclick='bdcopy("<?=$bid?>")' value='게시판복제' class='button' style='width:70px' /></div> 
<div style='float:left;width:420px' align='center'><textarea rows='1' cols='1' style='width:410px;height:50px;overflow:auto'><? if($fh = @fopen($dxr.$bid."/head.dat","r")) {while(!feof($fh)) {echo str_replace("&","&amp;",fgets($fh));}fclose($fh);}?>
</textarea><input type='button' value='게시판상단 내용추가' onclick="mkhead(this,'head.dat','<?=$bid?>')" class='button' style='height:20px;width:200px' /></div>
<div style='float:left;width:420px' align='center'><textarea rows='1' cols='1' style='width:410px;height:50px;overflow:auto'><? if($fh = @fopen($dxr.$bid."/middle.dat","r")) {while(!feof($fh)) {echo str_replace("&","&amp;",fgets($fh));}fclose($fh);}?>
</textarea><input type='button' value='본문하단 내용추가' onclick="mkhead(this,'middle.dat','<?=$bid?>')" class='button' style='height:20px;width:200px' /></div></div></td></tr>
<?
$jsaccum .= "$$('tct1[]',{$iy}).value='{$tct[2]}';\n";
$jsaccum .= "$$('csf[]',{$iy}).value='{$csff[0]}';\n";
$iy++;
}
$bids .= $bid.",";
$i++;
}}
fclose($fs);
fclose($fc);
$mcnt = $i -1;
$pnt = 10;
if($cnt <= $mcnt) {
?>
<tr><td colspan='8' style='text-align:center;background-color:#EAEAEA'>
<?
$mp = (int)($mcnt / $cnt) + 1;
pagen('board',$mp,10,0);
?>
</td></tr>
<?
}
?>
<tr><td colspan='5'><label>총갯수정리 <input type='hidden' id='abcnt' value='0' /><input type='checkbox' onclick='chkck(this)' class='no' /></label> &nbsp; <? if($rid) {?><input type="button" onclick="window.open('<?=$exe?>?id=<?=$rid?>&amp;read=1&amp;rn=1','')" value="rss리더 모두갱신" class='button' style="width:100px;" /><?}?></td>
<td colspan='3' align='right'><input type="button" onmouseover="vwtip(this,23)" onclick="bdpst(0,1)" value="적 용" class="button" style="width:450px;height:25px;margin-right:20px" /></td>
</tr></table></form>
<form name="pstfm" method="post" action="<?=$admin?>" style="margin:0;height:0"><input type='hidden' name='from' value='?<?=preg_replace("`&open=[0-9]+`","",$_SERVER['QUERY_STRING'])?>' /></form>
<form name="nwbdfm" method="post" action="<?=$admin?>" style="margin:0"><input type='hidden' name='mode' value='new' /><input type='hidden' name='from' value='<?=$_SERVER['SCRIPT_NAME']?>?<?=$_SERVER['QUERY_STRING']?>' />
<table border='0px' cellpadding='3px' cellspacing='1px' class='ttb' style='table-layout:fixed'>
<colgroup><col width='38px' /><col width='55px' /><col width='90px' /><col width='97px' /><col width='210px' /><col width='260px' /><col width='150px' /></colgroup>
<tr style='background-color:#EAEAEA;text-align:center'><td>추가 :</td>
<td><input type='text' name='id' maxlength='10' /></td><td><input type='text' name='nam' style='width:80px' /></td>
<td align='left'><select name='pt'>
<option value='a'>제목형</option>
<option value='b'>본문형</option>
<option value='c'>요약형</option>
<option value='g'>갤러리</option>
<option value='d'>방명록</option>
<option value='e'>블로그</option>
<option value='k'>달력형</option>
</select></td>
<td><input type="button" onclick="idlong()" value="게시판추가" class="button" style="width:160px" /></td>
<td><select class='w30' name='pl'><?=degree(0,1)?></select>
<select class='w30' name='pr'><?=degree(0,1)?></select>
<select class='w30' name='pw'><?=degree(0,1)?></select>
<select class='w30' name='pc'><?=degree(0,1)?></select>
<select class='w30' name='re'><?=degree(0,1)?></select>
<select class='w30' name='qo'><?=degree(0,1)?></select>
<select class='w30' name='qt'><?=degree(0,0)?></select></td>
<td><input type="button" onclick="location.href='?mkbdlist=1'" value="설정복구" class='button' onmouseover='vwtip(this,30)' style='width:50px' /> &nbsp;<input type="button" onclick="openall()" value="기타설정 모두 열기 / 닫기" onmouseover='vwtip(this,31)' class='button' style="width:140px;" /></td></tr>
</table></form>
<form method="post" name="mkfrm" action="<?=$admin?>" style="margin:0" target="exe">
<input type="hidden" name="mkid" value="" />
<input type="hidden" name="mknm" value="" />
<textarea name="mktxt" rows="1" cols="1" style="display:none"></textarea>
</form>
<script type="text/javascript">
//<![CDATA[
function idchg(ths) {
if(ths.readOnly && confirm('게시판 아이디를 변경하시겠습니까')) {
ths.readOnly = false;
ths.focus();
}}
function vwedit(bid,vw) {
if(vw == 2) {
alert("글쓰기에 '추가입력' 항목 추가하는 방법 :\n---------\n추가항목 : <input type='text' name='addfield[]' \/>\n추가항목 : <select name=\'addfield[]\' />...<\/select>\n---------\n유의점 : name=\'addfield[]\'");
bid = bid + "/write.html";
} else {
alert("본문에 '추가입력' 값 표시하는 방법 :\n---------\n추가항목1 : $addfield[1]<br \/>\n추가항목2 : $addfield[2]<br \/>\n---------\n유의점 : $addfield[번호]");
bid = bid + "/view.html";
}
popup('?fm=<?=$dxr?>' + bid, 800, 400);
}
function idlong() {
var lcng = document.nwbdfm.id.value;
if(",<?=$bids?>".indexOf("," + lcng + ",") != -1) {alert('중복된 ID입니다');return false;}
else {
var abcg = (lcng.length*9 - encodeURIComponent(lcng).length)/8;
var leng = (lcng.length - abcg)*3 + abcg;
if(leng > 10) alert('게시판id가 너무 깁니다. (현재:' + leng + 'byte)');
else document.nwbdfm.submit();
}}
function toggle(what) {
var tog = $(what);
tog.style.display=(tog.style.display != "block")?"block":"none";
}
function openall() {
var oclo = ($('bdwdth0').style.display != "block")?"block":"none";
for(var i=0;i < <?=$cnt?>;i++) {
if($('bdwdth' + i)) $('bdwdth' + i).style.display = oclo;
}
}
function bdcopy(what) {
document.mkfrm.removeChild(document.mkfrm.getElementsByTagName("input")[0]);
document.mkfrm.removeChild(document.mkfrm.getElementsByTagName("textarea")[0]);
var node = "<input type='hidden' name='ffilex' value='copy' />";
node += "<input type='hidden' name='bdcopy' value='" + what +"' />";
document.mkfrm.innerHTML = node;
document.mkfrm.submit();
}
function mkhead(ths,mfn,mid) {
document.mkfrm.mkid.value = mid;
document.mkfrm.mknm.value = mfn;
document.mkfrm.mktxt.value = ths.previousSibling.value;
document.mkfrm.submit();
}
function chkck(ths) {
ths.previousSibling.value=(ths.previousSibling.value == '1')?'0':'1';
}
function chkchk(ths,i) {
if(ths.previousSibling.value == '1' || $$('pi[]',i).value == '1'){
ths.previousSibling.value=(ths.previousSibling.value == '1')?'0':'1';
} else {
$$('pi[]',i).previousSibling.style.background='#FFFF00';
alert('항목별정렬\(사용여부\) 먼저 체크하세요');
ths.checked=false;
}
}
function chkchk2(ths) {
if(ths.previousSibling.value == '1') {
ths.previousSibling.value= '0';
ths.nextSibling.style.display= 'none';
} else {
ths.previousSibling.value= '1';
ths.nextSibling.style.display= '';
}}
function chkchk3(ths,i,n) {
var hklm = Array('','ph[]','qk[]','ql[]','qm[]');
var wht = (n < 3)? hklm[n + 2]:hklm[n -2];
wht = $$(wht,i);
if(n != 1 && ths.previousSibling.value != '1') {
$$('qq[]',i).value = '0';
$$('qq[]',i).nextSibling.checked=false;
}
if(n < 3) {
if(ths.previousSibling.value == '1') ths.previousSibling.value = '0';
else {
ths.previousSibling.value = '1';
if(n != 1 || $$('qq[]',i).value != 1) {
wht.value = '1';
wht.nextSibling.checked=true;
}}} else {
if(ths.previousSibling.value == '0') ths.previousSibling.value = '1';
else {
ths.previousSibling.value = '0';
wht.value = '0';
wht.nextSibling.checked=false;
}}}
function chkchk4(ths,n) {
if(parseInt(ths.value) >= 4) {
if($$('qa[]',n).value == '0') {
$$('qa[]',n).value = '1';
$$('qa[]',n).nextSibling.checked=true;
alert('불펌방지 4단계 이상에서는 게시판 목록형태가 고정되어야 합니다');
}
if(ths.value == '6' && $$('pc[]',n).value != 'a') {
$$('pc[]',n).value = 'a';
alert('불펌방지 6단계 대화상자에서는 덧글을 사용할 수 없습니다');
}}}
function chkchk5(ths,n) {
if(!ths.checked) {
if(parseInt($$('qn[]',n).value) >= 4) {$$('qn[]',n).value = '3';alert('불펌방지 4단계 이상에서는 게시판 목록형태가 고정되어야 합니다');}
ths.previousSibling.value = '0';
} else ths.previousSibling.value = '1';
}
function chkchk6(ths,i) {
if(ths.checked) {
ths.previousSibling.value = '1';
$$('qk[]',i).value = '0';
$$('qk[]',i).nextSibling.checked=false;
$$('qm[]',i).value = '0';
$$('qm[]',i).nextSibling.checked=false;
$$('ql[]',i).value = '0';
$$('ql[]',i).nextSibling.checked=false;
} else ths.previousSibling.value = '0';
}
function chkchk7(ths,i) {
if(ths.checked) {
if($$('tct2[]',i).value == '') {
ths.checked = false;
alert('게시판관리자가 없습니다');
$$('tct2[]',i).focus();
} else ths.previousSibling.value = '1';
} else ths.previousSibling.value = '0';
}
function $$$(nae,i,lh) {
var val = $$(nae,i).value;
if(lh != 0) {while(val.length < lh) {val = "0" + val;}}
return val;
}
function infval(nname,nvalue) {
var input=document.createElement("input");
input.type="hidden";
input.name=nname;
input.value=nvalue;
return input;
}
function bdpst(ix,iy) {
iy = (iy == 1)? <?=($iy)?>:ix + 1;
var pform = document.pstfm;
if(ix != 0) pform.from.value = pform.from.value + "&open=" + iy;
var abcntt = $('abcnt').value;
for(var i = ix;i < iy;i++) {
pform.appendChild(infval('order[]',$$$('order[]',i,0)));
pform.appendChild(infval('id[]',$$$('id[]',i,0)));
pform.appendChild(infval('nam[]',$$$('nam[]',i,0)));
pform.appendChild(infval('lastcnt[]',$$$('lastno[]',i,6) + $$$('cnt[]',i,6) + $$$('wlastno[]',i,6) + $$$('wcnt[]',i,6) + abcntt));
pform.appendChild(infval('tct1[]',$$$('tct1[]',i,0)));
pform.appendChild(infval('tct2[]',$$$('tct2[]',i,0)));
pform.appendChild(infval('tct0[]',$$$('pl[]',i,1) + $$$('pr[]',i,1) + $$$('pw[]',i,1) + $$$('pc[]',i,1) + $$$('pt[]',i,1) + $$$('py[]',i,1) + $$$('pv[]',i,1) + $$$('px[]',i,1) + $$$('pz[]',i,1) + $$$('pp[]',i,1) + $$$('pu[]',i,1) + $$$('pq[]',i,1) + $$$('pm[]',i,2) + $$$('po[]',i,2) + $$$('pd[]',i,1) + $$$('pe[]',i,1) + $$$('pf[]',i,1) + $$$('pg[]',i,1) + $$$('ph[]',i,1) + $$$('qe[]',i,1) + $$$('qf[]',i,1) + $$$('pa[]',i,1) + $$$('pb[]',i,1) + $$$('pi[]',i,1) + $$$('pj[]',i,1) + $$$('pk[]',i,1) + $$$('pn[]',i,1) + $$$('ps[]',i,1) + $$$('qa[]',i,1) + $$$('qb[]',i,1) + $$$('qc[]',i,1) + $$$('qg[]',i,1) + $$$('qh[]',i,2) + $$$('qk[]',i,1) + $$$('ql[]',i,1) + $$$('qm[]',i,1) + $$$('rj[]',i,1) + $$$('rk[]',i,1) + $$$('rl[]',i,1) + $$$('rm[]',i,1) + $$$('rn[]',i,1) + $$$('ro[]',i,1) + $$$('rp[]',i,1) + $$$('rq[]',i,1) + $$$('rr[]',i,1) + $$$('rs[]',i,1) + $$$('rt[]',i,1) + $$$('ru[]',i,1)));
pform.appendChild(infval('tct7[]',$$$('qd[]',i,1) + $$$('qj[]',i,1) + $$$('qn[]',i,1) + $$$('qo[]',i,1) + $$$('qp[]',i,1) + $$$('qq[]',i,1) + $$$('qr[]',i,1) + $$$('qs[]',i,1) + $$$('qt[]',i,1) + $$$('rc[]',i,1) + $$$('qu[]',i,1) + $$$('qv[]',i,4) + $$$('qw[]',i,1) + $$$('qx[]',i,4) + $$$('qy[]',i,1) + $$$('qz[]',i,4) + $$$('ra[]',i,1) + $$$('rb[]',i,4) + $$$('rd[]',i,1) + $$$('re[]',i,1) + $$$('rf[]',i,1) + $$$('ri[]',i,1)));
pform.appendChild(infval('tct8[]',$$$('qi[]',i,1) + $$$('rg[]',i,1) + $$$('rh[]',i,0)));
pform.appendChild(infval('tct9[]',$$$('rv[]',i,1) + $$$('rw[]',i,1) + $$$('rx[]',i,4) + $$$('ry[]',i,1) + $$$('rz[]',i,4)));
pform.appendChild(infval('idd[]',$$$('idd[]',i,0)));
pform.appendChild(infval('rdt[]',$$$('cql[]',i,1) + $$$('cqm[]',i,1) + $$$('csf[]',i,0)));
}
pform.appendChild(infval('mode','modi'));
pform.submit();
}
function dell(i) {
var pform = document.pstfm;
pform.appendChild(infval('mode','dell'));
pform.appendChild(infval('id',$$$('id[]',i,0)));
pform.submit();
}
function vwtip(ths,i) {
var ttitle = Array("목록에서 게시물 출력형태, 또는 게시판종류설정",
"한 목록에 출력할 게시물 갯수",
"분류(카테고리) 추가, 수정, 삭제",
"목록(제목형)에 출력할 항목선택",
"권한제한설정(0~9) : 목록보기",
"권한제한설정(0~9) : 본문보기",
"권한제한설정(0~9) : 새글작성",
"권한제한설정(0~9) : 덧글(코멘트)작성",
"게시판목록과 대문에서, 본문 미리보기 설정",
"게시판 추가설정사항 열기/닫기",
"게시판관리자로 설정할 회원id",
"목록상단에 출력여부",
"목록상단에 분류선택상자 출력여부",
"본문형/요약형등의 목록상단에 항목별정렬 선택상자 출력여부",
"게시판 rss피드 출력여부",
"게시판 목록형태 고정여부",
"본문하단의 게시판목록 출력여부",
"본문에 글쓴이(회원)의 서명 출력여부",
"본문에 링크주소 출력여부",
"rss피드 본문길이제한 적용여부",
"번호/제목/날짜등의 항목별 정렬사용여부",
"데이타 추가입력 사용",
"전체설정의 업로드파일 크기제한 적용여부",
"나열된 게시판 전체의 설정을 저장합니다",
"전자의 ip를 후자에게 노출합니다",
"대문에 출력할 최근글 갯수",
"게시판목록과 대문에서\n, 덧글표시에 덧글 미리보기를 출력할지 여부를 설정합니다",
"게시판이 포함될 섹션선택",
"게시판_bk라는 게시판으로 게시판 복제하기",
"추천, 비추기능 사용여부 선택",
"게시판데이타에서 게시판설정을 찾아 board.bak에 저장합니다",
"게시판 추가설정사항 모두 열기/닫기",
"게시물본문,덧글의 글자크기",
"게시물본문,덧글의 글꼴",
"본문,덧글에서 IP사용 안하는 대상",
"게시판 목록하단에 [전체]버튼(=대문링크) 출력여부",
"본문 불펌 방지 선택\n 1단계:블록선택 차단\n 2단계:Ctrl키 차단\n 3단계:투명막+선택해제\n 4단계:ajax,iframe 차단\n 5단계:본문 대화상자\n 6단계:목록 대화상자",
"권한제한설정(0~9) : 첨부파일 다운로드",
"권한제한설정(0~9) : 공지글 읽기, 본문읽기권한보다 낮게 설정할 수 있습니다",
"평점(별점)기능 사용",
"포인트설정 : 본문쓰기",
"포인트설정 : 덧글쓰기",
"포인트설정 : 다운로드",
"포인트설정 : 본문읽기",
"좌우메뉴/대문의 최근글에 이 게시판을 제외시킬 것인지를 선택합니다",
"좌우메뉴/대문의 최근덧글에 이 게시판을 제외시킬 것인지를 선택합니다",
"게시판 목록 상단에 분류 나열 여부",
"태그(=꼬리표) 사용여부",
"권한제한설정(0~9) : 첨부파일 업로드",
"목록과 대문에 NEW이미지 표시 여부",
"목록에 HOT이미지 표시 여부",
"기본은 간접링크/보안위주,\n 노출경로는 성능위주/확장자제한",
"이 게시판의 본문,덧글을\n 각 글쓴이 회원의 회원로그에서\n 제외합니다",
"rss피드를 수집하는 게시판으로 설정합니다",
"익명게시판으로 설정합니다",
"최근 덧글 또는 최근 글순으로 정렬합니다",
"본문삭제시 데이타삭제 없이,\n 데이타숨김으로 처리합니다",
"전체설정의 변경금지시간 이후에는\n 수정/삭제가 불가능하도록 설정합니다",
"게시판 목록과 대문에서,\n 덧글표시에 덧글 링크(새창)를 출력할지 여부를 설정합니다.",
"게시판 목록과 대문에서,\n 게시물에 저장된 링크를 목록에 표시할지 여부를 설정합니다.",
"게시판 목록과 대문에서,\n 본문에 이미지를 미리보기 등에 표시할지 여부를 설정합니다.",
"게시판 목록과 대문에서,\n 본문일부를 미리보기 등에 표시할지 여부를 설정합니다.",
"본문에 추가입력 표시하는 파일 편집",
"글쓰기에 추가입력 항목 삽입하는 파일 편집",
"추가입력항목 게시판 목록에 표시여부",
"권한제한설정(0~9) : 추천,비추,평점",
"포인트설정 : 추천,비추,평점 - 추천한 회원에게",
"피추천 포인트 가감방식",
"피추천수의 몇퍼센트를 글쓴이 회원의 포인트에 적립할 것인지를 설정합니다.",
"덧글의 스킨을 게시판스킨과 별도로 설정합니다",
"덧글에 추천 사용여부",
"덧글에 비추 사용여부");
if(ttitle[i]) {
if(ths && ths.innerHTML) ttitle[i] = ths.innerHTML +" ::\n " +ttitle[i];
else if(ths && ths.value) ttitle[i] = ths.value +" ::\n " +ttitle[i];
$('admtip').innerHTML = ttitle[i];
}}
<?=$jsaccum?>
<? if($_GET['open']) echo "toggle('bdwdth".(--$_GET['open'])."')\n";?>

document.title = "게시판관리";
//]]>
</script>
<?
} else if($_GET['drct'] || $_POST['ffilex'] == 'find') {
$drct = ($_GET['drct'])? $_GET['drct']:$dxr;
if($_POST['ffilex'] == 'find') {
$fn = '';
$n = 0;
$owner = explode("<>",$_POST['ffiles']);
function filefind($dcr) {
global $fn,$n;
$dr = fopen($dcr,"r");
while(!feof($dr)) {
if(strpos(fgets($dr),$_POST['ffilew']) !== false) {$fn[$n] = $dcr;$n++;break;}
}
fclose($dr);
}
function dirfind($dcrr) {
global $fn,$n;
$d = dir($dcrr);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
if(is_dir($dcrr."/".$entry)) {
if(($_POST['ffileu'] == '2' || $_POST['ffileu'] == '3') && $entry == $_POST['ffilew']) {$dr[$n] = $dcrr."/".$entry;$n++;}
else dirfind($dcrr."/".$entry);
} else {
if($_POST['ffileu'] == '5') filefind($dcrr."/".$entry);
else if(($_POST['ffileu'] == '1' || $_POST['ffileu'] == '3') && $entry == $_POST['ffilew']) {$fn[$n] = $dcrr."/".$entry;$n++;}
else if($_POST['ffileu'] == '4' && strpos($entry,$_POST['ffilew']) !== false) {$fn[$n] = $dcrr."/".$entry;$n++;}
}}}
$d->close();
}
$ownerc = count($owner);
for($i = 0; $i < $ownerc; $i++) {
if(is_dir($owner[$i])) dirfind($owner[$i]);
else if($_POST['ffileu'] == '5') filefind($owner[$i]);
else if($entry = strpos($owner[$i],$_POST['ffilew']) !== false) {
if($_POST['ffileu'] == '4') {$fn[$n] = $owner[$i];$n++;}
else if(($_POST['ffileu'] == '1' || $_POST['ffileu'] == '3') && substr($owner[$i],$entry) == $_POST['ffilew']) {$fn[$n] = $owner[$i];$n++;}
}}

} else {
function dirsize($dcrr,$size) {
$d = dir($dcrr);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
if(is_dir($dcrr."/".$entry)) $size = dirsize($dcrr."/".$entry,$size);
else $size += @filesize($dcrr."/".$entry);
}
}
$d->close();
return $size;
}
if(substr($drct, -1) != "/") $drct = $drct."/";
$d = dir($drct);
while($entry = $d->read()) {
if($entry != "." && $entry != "..") {
if(is_dir($drct.$entry)) {
 $dr[$r] = $drct.$entry;
 $r++;
} else {
 $fn[$n] = $drct.$entry;
 $n++;
}
}
}
$d->close();
$drctl = strlen($drct);
function basenm($name) {
global $drctl;
return substr($name,$drctl);
}
}
?>
<div id='filelst'></div>
<form name='ffile' action="<?=$admin?>" method="post" style="margin:0">
<input type='hidden' name='ffiles' />
<input type='hidden' name='ffilew' />
<input type='hidden' name='ffilex' />
<input type='hidden' name='ffilet' value='<?=fchr($drct)?>' />
<input type='hidden' name='ffileu' value='1' />
</form>
<form name='file' enctype="multipart/form-data" action="<?=$admin?>" method="post" style="margin:0;background-color:#F7F7F7">
<span title='폴더내부 용량 계산으로 출력이 지연될 수 있습니다.'>폴더 내부크기 출력</span> <input type='hidden' name='dnsize' value='<?=$sett[38]?>' /><input type='checkbox'  onclick="this.previousSibling.value=(this.checked)? '1':'0';submit();" <? if($sett[38]) echo "checked='cheked'";?> class='no' style='margin-right:50px;padding-bottom:5px' />
파일업로드 : <input type='file' name='upfile' style='width:250px;height:20px;margin-right:50px' onchange='if(this.value) submit()' />
<input type='button' class='button' style='width:80px' value='URL 파일저장' onclick='submit()' /> <input type='text' name='linkfile' style='width:250px;height:20px' value='http://' />
<input type='hidden' name='uploadpath' value='<?=$drct?>' />
<script type='text/javascript'>
//<![CDATA[
<? if($_GET['drct']) {?>
var fdrct = Array("<?=$drct?>","<?=fchr($drct)?>");
<?} else echo "var fdrct = Array('','');";?>

var flist = Array(""<?
function perms($perms) {
return substr(sprintf('%o', fileperms($perms)), -4);
}
if(substr($drct, -2) == './') {if($drct == './') $drup = '../';else $drup = '../'.$drct;}
else {
$drup = preg_replace("`(.+)/[^/]+/`","$1",$drct)."/";
if($drup == $drct.'/' || $drup == '/') $drup = './';
}
$n = 2;
$drcnt = count($dr);
if($drcnt > 0) {
@sort($dr);
for($i = 0;$i < $drcnt; $i++) {
if($sett[38] == 1) {
 $drsize = dirsize($dr[$i],0);
 $fnszall += $drsize;
 if($drsize > 1048576) $drsize = sprintf("%.2f", ($drsize / 1048576))." mb";
 else if($drsize > 1024) $drsize = sprintf("%.2f", ($drsize / 1024))." k";
 }
 if($_POST['ffilex'] == 'find') $bdf = $dr[$i];
 else $bdf = basenm($dr[$i]);
 if(($fcf = fchr($bdf)) == $bdf) $fcf = '';
 echo ",Array(1,".($n % 2).",'{$bdf}','{$fcf}','{$drsize}','".fileowner($dr[$i])."','".perms($dr[$i])."','".date("y/m/d_H:i:s",filemtime($dr[$i]))."')";
 $n++;
}
}
$fncnt= count($fn);
if($fncnt > 0) {
@sort($fn);
for($ii = 0;$ii < $fncnt; $ii++) {
 $fnsize = filesize($fn[$ii]);
 $fnszall += $fnsize;
 if($fnsize > 1048576) {$fnsize = sprintf("%.2f", ($fnsize / 1048576))." mb";echo ",Array(2,";}
 else {if($fnsize > 1024) $fnsize = sprintf("%.2f", ($fnsize / 1024))." k";echo ",Array(3,";}
 if($_POST['ffilex'] == 'find') $bdf = $fn[$ii];
 else $bdf = basenm($fn[$ii]);
 if(($fcf = fchr($bdf)) == $bdf) $fcf = '';
 echo ($n % 2).",'{$bdf}','{$fcf}','{$fnsize}','".fileowner($fn[$ii])."','','".date("y/m/d_H:i:s",filemtime($fn[$ii]))."')";
 $n++;
}
}
 if($fnszall > 1048576) $fnszall = sprintf("%.2f", ($fnszall / 1048576))." m";
 else if($fnszall > 1024) $fnszall = sprintf("%.2f", ($fnszall / 1024))." k";
?>);

function flout() {
var fadd = "<table border='0px' cellpadding='5px' cellspacing='1px' class='ttb'>";
fadd += "<colgroup><col width='*' /><col width='60px' /><col width='50px' /><col width='35px' /><col width='35px' /><col width='110px' /><col width='100px' /></colgroup>";
fadd += "<tr><td style='text-align:left'><input type='text' style='width:300px' value='<?=fchr($drct)?>' /><input type='submit' onclick=\"location.href='?drct='+this.previousSibling.value\" value='경로이동' class='button' style='width:80px' title='아래 출력되는 폴더/파일의 경로이동' /></td>";
fadd += "<td colspan='6'><input type='text' id='newpath' style='width:240px' value='<?=fchr($drct)?>' /><input type='button' onclick=\"location.href='?delem='+$('newpath').value\" value='파일생성' class='button' style='width:65px' title='앞의 경로에 새로운 빈파일생성' /> <input type='button' onclick=\"location.href='?mkdir='+$('newpath').value\" value='폴더생성' class='button' style='width:65px' title='앞의 경로에 새로운 폴더생성' /></td></tr>";
fadd += "<tr style='background-color:#EAEAEA'><td>폴더는 경로이동 /파일은 다운로드</td><td>파일크기</td><td title='파일소유자'>소유자</td><td title='폴더는 권한 / 파일은 내용편집'>편집</td><td title='파일내용 검색교체'>검색</td><td title='파일수정일, 클릭하면 링크'>수정일 / 링크</td><td>삭제</td></tr>";
fadd += "<tr style='background-color:#F1F1F1'><td colspan='7' style='text-align:left'> <a href='?drct=<?=fchr($drup)?>'><font color='#0000CD'><?=$drup?></font></a></td></tr>";
var flength = flist.length;
for(var i=1;i < flength;i++) {
if(flist[i][3] == '') flist[i][3] = flist[i][2];
if(flist[i][1] == 1) fadd += "<tr style='background-color:#F1F1F1' onmouseover='this.style.background=\"#FFF29B\"' onmouseout='this.style.background=\"#F1F1F1\"'>";
else fadd += "<tr style='background-color:#FFFFFF' onmouseover='this.style.background=\"#FFF29B\"' onmouseout='this.style.background=\"#FFFFFF\"'>";
fadd += "<td style='text-align:left'><input type='checkbox' name='fiile' value='" + fdrct[0] + flist[i][2] + "' class='no' /> ";
if(flist[i][0] == 1) fadd += "<a href='?drct=" + fdrct[1] + flist[i][3] + "'><font color='#0000CD'>";
else fadd += "<a target='_blank' href='?down=" + fdrct[1] + flist[i][3] + "'><font color='red'>";
fadd += fdrct[0] + flist[i][2] + "</font></a></td><td>" + flist[i][4] + "</td><td>(" + flist[i][5] + ")</td>";
if(flist[i][0] == 1) fadd += "<td class='f7'>" + flist[i][6] + "</td><td><a onclick=\"popup('<?=$admin?>?fr=" + fdrct[1] + flist[i][3] + "/', 550, 250)\" href='#none'>검색</a>";
else {
if(flist[i][0] == 3) fadd += "<td><a onclick=\"popup('<?=$admin?>?fm=" + fdrct[1] + flist[i][3] + "', 800, 400)\" href='#none'>편집</a>";
else fadd += "<td>";
fadd += "</td><td><a onclick=\"popup('<?=$admin?>?fr=" + fdrct[1] + flist[i][3] + "', 550, 250)\" href='#none'>검색</a>";
}
fadd += "</td><td class='f8'><a target='_blank' href='" + fdrct[0] + flist[i][2] + "'>" + flist[i][7] + "</a></td>";
if(flist[i][0] == 1) fadd += "<td><a href='#none' onclick=\"if(confirm('폴더를 삭제하시겠습니까'))location.href='?deled=" + fdrct[1] + flist[i][3] + "';\"><font color='red'>폴더삭제</font></a></td></tr>";
else fadd += "<td><a href='?delef=" + fdrct[1] + flist[i][3] + "'>삭제</a> / <a href='?delem=" + fdrct[1] + flist[i][3] + "'>비움</a></td></tr>";
}
fadd += "<tr style='background-color:#EAEAEA'><td><div style='text-align:left;float:left;'><input type='button' value='선택' class='button' onclick='slect()' /></div><div style='text-align:right;float:right' id='copi'>폴더 : <?=$drcnt?> 개, 파일 : <?=$fncnt?> 개, 총크기 : <?=$fnszall?></div>";
fadd += "<form method='get' action='' onsubmit='sllect();return false' style='text-align:right;float:right;display:none;' id='copp'><span>경로</span> : <input type='text' id='copd' style='width:260px;background-color:#EAEAEA' value='<?=$drct?>' /><input type='submit' onclick=\"sllect(this.previousSibling.value, this.value)\" id='copc' value='' class='button' style='width:80px' /></form></td>";
fadd += "<td colspan='6' style='clear:both;text-align:center'><input type='button' onclick=\"fcopy('copy')\" value='copy' class='button' /> <input type='button' onclick=\"fcopy('rename')\" value='rename' class='button' style='width:50px' /> <input type='button' onclick=\"sllect('0777','')\" value='0777' class='button' style='width:30px' /><? if(strpos(ini_get('disable_functions'),"system") === false){?> <input type='button' onclick=\"sllect('compressf','')\" value='압축-f' class='button' style='width:38px' title='files폴더 빼고 압축' /> <input type='button' onclick=\"sllect('compress','')\" value='압축' class='button' style='width:30px' /> <input type='button' onclick=\"fcopy('decompress')\" value='압축해제' class='button' style='width:50px' /><?}?> <input type='button' onclick=\"fcopy('find')\" value='검색' class='button' style='width:30px' /> ";
fadd += "<input type='button' onclick=\"if(confirm('선택 파일/폴더를 삭제하시겠습니까',''))sllect('delete','')\" value='삭제' class='button' /> <input type='button' onclick=\"sllect('clear','')\" value='비움' class='button' /></td></tr>";
fadd += "<tr style='clear:both'><td colspan='4'></td></tr></table>";
$('filelst').innerHTML = fadd;
}

function slect() {
var tog = document.getElementsByName('fiile');
for(i = 0; i < tog.length; i++){
if(tog[i].checked == true) tog[i].checked = false;
else tog[i].checked = true;
}
}

function sllect(xx,yy) {
if(!xx) {
xx = $('copd').value;
yy = $('copc').value;
}
if(xx) {
var tog = document.getElementsByName('fiile');
var got = '';
for(i = 0; i < tog.length; i++){
if(tog[i].checked == true) got += tog[i].value + "<>";
}
document.ffile.ffiles.value = got.substr(0, got.length -2);
document.ffile.ffilew.value = xx;
document.ffile.ffilex.value = yy;
document.ffile.submit();
}
}
function fcopy(xx) {
if($('copp').style.display == 'none') {
$('copi').style.display = 'none';
$('copp').style.display = 'block';
$('copc').value = xx;
if(xx == 'copy') $('copd').title = "\n < 선택한 것이 여럿 >이거나, < 하나의 폴더 >이고, \n\n < 존재하지 않는 경로 >를 입력한 경우 \n\n 그 경로의 폴더가 생성되어서 \n\n 선택한 폴더가 하나인 경우 하위경로가, \n\n 여럿인 경우엔 선택한 것들이 그 안에 복사됩니다. \n ";
else if(xx == 'rename') $('copd').title = "\n < 선택한 것이 여럿 >이고, \n\n < 존재하지 않는 경로 >를 입력한 경우 \n\n 그 경로의 폴더가 생성되어서 \n\n 그 안으로 선택한 것들이 이동됩니다. \n";
$('copp').firstChild.innerHTML = (xx == 'find')? '<select onchange="document.ffile.ffileu.value=this.options[this.selectedIndex].value;"><option value="1">파일이름 검색</option><option value="2">폴더이름 검색</option><option value="3">파일/폴더 이름검색</option><option value="4">검색어 포함한 파일이름</option><option value="5">파일내용 검색</option></select>&nbsp; 검색어':'경로';
if(xx == 'find') {$('copd').value = "<?=($_POST['ffilex'] == 'find')? $_POST['ffilew']:'';?>";$('copd').style.width = '150px';}
} else {
$('copi').style.display = 'block';
$('copp').style.display = 'none';
$('copc').value = '';
$('copd').title = '';
$('copd').value = '<?=$drct?>';
$('copd').style.width = '260px';
}
}
document.title = "파일관리";
setTimeout("flout()",100);
//]]>
</script>
<?
} else if($_GET['member']) {
if(!$_GET['orderby']) $_GET['orderby'] = 1;
?>
<div id='admtip' style='width:920px;margin:4px 0 5px 0'>회원관리</div>
<div style='text-align:center'>
<input type='button' value="전체쪽지발송" onclick="send('memo', 'all','all')" class='button' style='width:100px' />
 &nbsp; <input type='button' value="전체메일발송" onclick="send('mail', 'all', '')" class='button' style='width:100px' />
 &nbsp; <input type='button' value="가입환영쪽지편집" onclick='popup("<?=$admin?>?fm=<?=$dxr?>welcome", 800, 400)' class='button' style='width:100px' />
</div><div align='right'><form name='smember' method='get' action='?'><input type='hidden' name='member' value='1' /><input type='hidden' name='orderby' value='1' /><select name='search'><option value='id'>아이디</option><option value='nick'>닉네임</option><option value='no'>회원번호</option><option value='level'>회원레벨</option><option value='email'>이메일</option><option value='address'>주소</option><option value='registdate'>가입일자</option><option value='birthdate'>생년월일</option><option value='birthmonth'>태어난 달</option></select><input type='text' name='keyword' style='width:80px' /><input type='submit' value='회원검색' class='button' style='width:50px' />
 <select id='orderby' onchange="location.replace(('?member=1&amp;orderby=' + this.options[this.selectedIndex].value).replace(/amp;/,''))"><option value='1' <?=seltd('11',$_GET['orderby'])?>>가입일 높은순</option><option value='21' <?=seltd('21',$_GET['orderby'])?>>최근 방문일 높은순</option><option value='31' <?=seltd('31',$_GET['orderby'])?>>회원아이디 높은순</option><option value='41' <?=seltd('41',$_GET['orderby'])?>>회원레벨 높은순</option><option value='51' <?=seltd('51',$_GET['orderby'])?>>쓴글수 높은순</option><option value='61' <?=seltd('61',$_GET['orderby'])?>>쓴덧글수 높은순</option><option value='71' <?=seltd('71',$_GET['orderby'])?>>출석수 높은순</option><option value='81' <?=seltd('81',$_GET['orderby'])?>>추가점 높은순</option><option value='91' <?=seltd('91',$_GET['orderby'])?>>포인트 높은순</option><option value='11' <?=seltd('11',$_GET['orderby'])?>>가입일 낮은순</option><option value='22' <?=seltd('22',$_GET['orderby'])?>>최근 방문일 낮은순</option><option value='32' <?=seltd('32',$_GET['orderby'])?>>회원아이디 낮은순</option><option value='42' <?=seltd('42',$_GET['orderby'])?>>회원레벨 낮은순</option><option value='52' <?=seltd('52',$_GET['orderby'])?>>쓴글수 낮은순</option><option value='62' <?=seltd('62',$_GET['orderby'])?>>쓴덧글수 낮은순</option><option value='72' <?=seltd('72',$_GET['orderby'])?>>출석수 낮은순</option><option value='82' <?=seltd('82',$_GET['orderby'])?>>추가점 낮은순</option><option value='92' <?=seltd('92',$_GET['orderby'])?>>포인트 낮은순</option></select></form></div>
<table border='0px' cellpadding='2px' cellspacing='1px' class='ttb'>
<colgroup><col width='42px' /><col width='42px' /><col width='94px' /><col width='70px' /><col width='148px' /><col width='40px' /><col width='40px' /><col width='40px' /><col width='56px' /><col width='60px' /><col width='70px' /><col width='50px' /><col width='42px' /><col width='55px' /><col width='42px' /></colgroup>
<tr style='background-color:#EAEAEA'><td onmouseover='vwtip(this,0)'>no</td><td onmouseover='vwtip(this,1)'>성별</td><td>id / 쪽지</td>
<td>닉네임</td><td>메일주소</td><td>쓴글</td><td>덧글</td><td>출석</td><td>추가</td><td>포인트</td><td>가입일/로그</td><td>레벨</td><td  onmouseover='vwtip(this,2)'>적용</td><td onmouseover='vwtip(this,3)'>암호변경</td><td onmouseover='vwtip(this,4)'>삭제</td></tr>
<?
$cnt = ($_GET['cnt'])? $_GET['cnt']:30;
$stt = ($_GET['member'] - 1)*$cnt;
$ett = $stt + $cnt;
$i = 1;
$attd = array();
$ordr = array();
$mlst = array();
if($fa = @fopen($dxr."attend.dat","r")){
while(!feof($fa)) {
$fao = explode("\x1b",fgets($fa));
if($fao[1]) for($a = count($fao) -2;$a > 0;$a--) if(!$attd[$fao[$a]]) $attd[$fao[$a]] = substr($fao[0],0,4)."-".substr($fao[0],4,2)."-".substr($fao[0],6,2);
}
fclose($fa);
}
if($_GET['orderby'] != 1) {
$i = 1;
$fim = fopen($dim,"r");
while($xxx = fgets($fim)) {
if(strlen($xxx) > 10) {
$xxn = substr($xxx,0,5);
if($_GET['orderby'][0] == 1) $ordr[$xxn] = $i;
else if($_GET['orderby'][0] == 2) {if($attd[(int)$xxn]) $ordr[$xxn] = $attd[(int)$xxn];}
else if($_GET['orderby'][0] == 3) $ordr[$xxn] = substr($xxx,5,15);
else if($_GET['orderby'][0] == 4) {
$okok = explode("\x1b", $xxx);
$ordr[$xxn] = $okok[2].(99999-$xxn);
} else if($_GET['orderby'][0] >= 5) {
if($jn = @fopen($dxr.'_member_/member_'.(int)$xxn,'r')) {
$jno = explode("\x1b",fgets($jn));fclose($jn);
if($_GET['orderby'][0] == 5) $ordr[$xxn] = $jno[0];
else if($_GET['orderby'][0] == 6) $ordr[$xxn] = $jno[1];
else if($_GET['orderby'][0] == 7) $ordr[$xxn] = $jno[2];
else if($_GET['orderby'][0] == 8) $ordr[$xxn] = $jno[3];
else if($_GET['orderby'][0] == 9) $ordr[$xxn] = (int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9];
}}
$i++;
}}
fclose($fim);
if($_GET['orderby'][1] == 1) arsort($ordr);
else asort($ordr);
if(count($ordr) >= $cnt) $ordr = array_slice($ordr,$stt,$cnt);
$i = $stt +1;
foreach($ordr as $key => $value) {
$ordr[$key] = $i;
$i++;
}
}
function prevw($vk) {
global $sett;
$val = '';
if($sett[20][2] && substr($vk[6],10)) $val .= ' / 생년월일 '.substr($vk[6],10,4).'. '.substr($vk[6],14,2).'. '.substr($vk[6],16,2);
if($sett[20][1] && $vk[5]) $val .= ' /  '.$vk[5];
if($sett[20][0] && $vk[4]) $val .= ' / '.$vk[4];
if(substr($sett[20],4) && $vk[7]) $val .= ' / '.substr($sett[20],4).' '.$vk[7];
return $val;
}
$i = 1;
$fim = fopen($dim,"r");
while($xxx = fgets($fim)) {
if(strlen($xxx) > 10) {
if($i <= $ett) {
if($_GET['orderby'] == 1) {
if($_GET['search'] || $i > $stt) $yyy = explode("\x1b", $xxx);
$ml = 1;
if($_GET['search'] && $_GET['keyword']) {
if($_GET['search'] == 'id') {if(strpos($yyy[0],$_GET['keyword']) === false) $ml = 0;
} else if($_GET['search'] == 'nick') {if(strpos($yyy[1],$_GET['keyword']) === false) $ml = 0;
} else if($_GET['search'] == 'no') {if((int)substr($xxx,0,5) != $_GET['keyword']) $ml = 0;
} else if($_GET['search'] == 'level') {if($yyy[2] != $_GET['keyword']) $ml = 0;
} else if($_GET['search'] == 'email') {if(strpos($yyy[3],$_GET['keyword']) === false) $ml = 0;
} else if($_GET['search'] == 'address') {if(strpos($yyy[4],$_GET['keyword']) === false) $ml = 0;
} else if($_GET['search'] == 'registdate') {if(($xxx = (int)substr($yyy[6],0,10)) == 0 || date("Y",$xxx) != substr($_GET['keyword'],0,4) || (strlen($_GET['keyword']) >= 6 && date("m",$xxx) != substr($_GET['keyword'],4,2))) $ml = 0;
} else if($_GET['search'] == 'birthdate') {if(strlen($yyy[6]) <= 10 || substr($yyy[6],10,4) != substr($_GET['keyword'],0,4) || (strlen($_GET['keyword']) >= 6 && substr($yyy[6],14,2) != substr($_GET['keyword'],4,2))) $ml = 0;
} else if($_GET['search'] == 'birthmonth') {if(strlen($yyy[6]) <= 14 || substr($yyy[6],14,2) != substr($_GET['keyword'],0,2)) $ml = 0;
}}
if($ml) {if($i > $stt) $mlst[$i] = $yyy;$i++;}
} else {$i++;$ett++;$xxn = substr($xxx,0,5);if($ordr[$xxn]) $mlst[$ordr[$xxn]] = explode("\x1b", $xxx);}
} else if($_GET['search'] && $_GET['keyword']) break;else $i++;
}}
fclose($fim);
$mcnt = $i -2;
ksort($mlst);
$i = 1;
foreach($mlst as $okok) {
$odate = date("Y.m.d", substr($okok[6],0,10));
$okid = trim(substr($okok[0],5,15));
$okok[0] = (int)substr($okok[0], 0, 5);if($okok[1]) {
if($jn = @fopen($dxr."_member_/member_".$okok[0],"r")) {
$jno = explode("\x1b",fgets($jn));fclose($jn);
if($okok[9] == 'm') $okok[9] = '男';
else if($okok[9]=='f') $okok[9] = '女';
} else {
$jno = "0\x1b0\x1b1\x1b100\x1b\x1b1\x1b0\x1b0\x1b0\x1b0\x1b0\x1b0\x1b\x1b\x1b";
fopen($dxr."_member_/member_".$okok[0],"w");
fgets($jn,$jno);fclose($jn);
$okok[9] = 'x';
}
if($okok[10]) $okok[10] = "onclick='nwopn(\"".$okok[10]."\")' title='".$okok[10]."' style='width:20px'";
else $okok[10] = "title='empty' style='width:20px;background-color:#FFFFFF'";
?>
<tr onmouseover='this.style.background="#FFF29B";vwtip(this,"x")' onmouseout='this.style.background=""' title="  최근 방문 <?=$attd[$okok[0]]?><?=prevw($okok)?>  "><td class='cbox'><a target='_blank' href='<?=$index?>?mbr_info=1&amp;mbr=<?=$okok[0]?>'><?=$okok[0]?></a></td>
<td><input type='button' class='button' value='<?=$okok[9]?>' <?=$okok[10]?> /></td><td><input type='hidden' id='no_<?=$i?>' value='<?=$okok[0]?>' /><input type='hidden' id='usr_<?=$i?>' value='<?=$okid?>' /><a href='#none' onclick="send('memo', '<?=$okok[0]?>','<?=urlencode($okok[1])?>')" title='쪽지 보내기'><?=$okid?></a></td>
<td><input type='text' id='nick_<?=$i?>' value='<?=$okok[1]?>' style='width:65px' /></td><td><input type='text' id='email_<?=$i?>' value='<?=$okok[3]?>' style='width:100px' /><input type='button' onclick="send('mail', '<?=$okok[0]?>','<?=urlencode($okok[1])?>','<?=$mbr_no?>')" value='발송' class='button' /></td>
<td style='font-size:11px'><?=$jno[0]?></td><td style='font-size:11px'><?=$jno[1]?></td><td style='font-size:11px'><?=$jno[2]?></td><td style='font-size:11px'><input type='button' value='<?=$jno[3]?>' onclick="popup('<?=$admin?>?pview=<?=$okok[0]?>',400,300);" style='width:50px' class='button' /></td><td style='font-size:11px'><?=(int)$jno[11]+$jno[10]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]?></td><td><input type='button' class='button' onclick="nwopn('<?=$mblog?>?mno=<?=$okok[0]?>')" value='<?=$odate?>' style='width:60px' /></td><td><select id='level_<?=$i?>'>
<?
for($c = 0;$c < 9; $c++){
if($c == $okok[2]) $ic = " selected='selected'";
else $ic = "";
?>
<option value='<?=$c?>'<?=$ic?>><?=$c?></option>
<?
}
if($okok[2] == 9) $iic = " selected='selected'";
else $iic = "";
?>
<option value='9'<?=$iic?>>adm</option></select></td>
<td><input type='button' onclick="change('<?=$i?>','')" value='적용' class='button' /></td><td style='text-align:center'><input type='button' onclick="if($('newpswd').innerHTML != '') newpd();else {if(confirm('<?=$okid?>님의 비밀번호를 재설정합니까'))newpd('<?=$okid?>','<?=$i?>')}" value='암호변경' class='button' style='width:50px' /></td><td style='text-align:center'><input type='button' onclick="if(confirm('<?=$okid?>님의 회원정보를 삭제하시겠습니까'))change('<?=$i?>','delete')" value='삭제' class='button' /></td></tr>
<?
}
$i++;
}
if($cnt < $mcnt){
?>
<tr><td colspan='15' style='text-align:center;background-color:#EAEAEA'>
<?
$mp = (int)($mcnt / $cnt) + 1;
pagen('member',$mp,30,0);
?>
</td></tr>
<?
}
?>
<tr><td colspan='15' style='text-align:left;border-top:2px solid #D7D7D7;padding-left:20px '>
<?
$mblevel = "<option value='1'>level 1</option><option value='2'>level 2</option><option value='3'>level 3</option><option value='4'>level 4</option><option value='5'>level 5</option><option value='6'>level 6</option><option value='7'>level 7</option><option value='8'>level 8</option>";
if(!$_GET['search']) echo '전체회원수 :: '.($mcnt +1).' &nbsp; &nbsp; &nbsp; ';?><input type='button' value='전체회원 포인트 재계산' onclick='location.replace("?allpntcal=1")' class='button' style='width:130px' />
<form action="<?=$admin?>" method="post" style="float:right;margin:0"><select name='mblvby[]'><option value='1'>포인트</option><option value='2'>쓴글수</option><option value='3'>덧글수</option><option value='4'>출석수</option></select> <input type='text' name='mblvby[]' value='' /> 이상이면, 최소한 <select name='mblvby[]'><?=degree(0,3)?></select> <input type='button' value='회원레벨 일괄조정' onclick='if($$("mblvby[]",1).value != "") submit();else alert("값이 없습니다");' class='button' style='width:100px' /></form><div style='clear:both'></div>
<form action="<?=$admin?>" method="post" style="margin:0"><input type='hidden' name='from' value='<?=$_SERVER['QUERY_STRING']?>' />
<fieldset style='padding:20px;line-height:22px'><legend>회원관리설정</legend>
신규회원가입: <select name='xj'><option value='0' <?=seltd('0',$sett[61])?>>허용</option><option value='1' <?=seltd('1',$sett[61])?>>중단</option></select>
&nbsp;중복 로그인: <select name='xw'><option value='0' <?=seltd('0',$sett[74])?>>불허</option><option value='1' <?=seltd('1',$sett[74])?>>허용</option></select>
<br />로그인 암호키 전달: <select name='wi'><option value='0' <?=seltd('0',$sett[34])?>>ajax로</option><option value='1' <?=seltd('1',$sett[34])?>>직접 출력</option></select>
<br />출석 포인트 배점 : <input type='text' name='mpoint[]' style='width:35px' value='<?=$sett[18]?>' />
<br />신규덧글알림: <label><input type='radio' name='wu' value='1' style='width:13px' <? if($sett[83]) echo "checked='checked'";?> /> 사용함</label> &nbsp; <label><input type='radio' name='wu' value='0' style='width:13px' <? if(!$sett[83]) echo "checked='checked'";?> /> 사용 안 함</label>
<br />쪽지사용권한: <select name='xf'><?=degree($sett[57],4)?></select>부터
<br />쪽지도착 알림방법: <select name='mpoint[]'><option value='1' <?=seltd('1',$sett[52])?>>안 알림</option><option value='2' <?=seltd('2',$sett[52])?>>문구만</option><option value='3' <?=seltd('3',$sett[52])?>>문구+소리</option><option value='4' <?=seltd('4',$sett[52])?>>팝업+소리</option><option value='5' <?=seltd('5',$sett[52])?>>팝업+문구</option><option value='6' <?=seltd('6',$sett[52])?>>팝업+문구+소리</option><option value='7' <?=seltd('7',$sett[52])?>>팝업만</option></select>
<br />반복된 로그인 실패 차단: 24시간 동안 <input type='text' name='mpoint[]' value='<?=$sett[53]?>' />번 실패하면, 24시간 동안 차단합니다.
<br />회원정보 입력 사항: 
&nbsp;주소 <select name='mpoint[]'><option value='1' <?=seltd('1',$sett[20][0])?>>필수입력</option><option value='2' <?=seltd('2',$sett[20][0])?>>선택입력</option><option value='0' <?=seltd('0',$sett[20][0])?>>사용안함</option></select>
&nbsp;전화번호 <select name='mpoint[]'><option value='1' <?=seltd('1',$sett[20][1])?>>필수입력</option><option value='2' <?=seltd('2',$sett[20][1])?>>선택입력</option><option value='0' <?=seltd('0',$sett[20][1])?>>사용안함</option></select>
&nbsp;생년월일 <select name='mpoint[]'><option value='1' <?=seltd('1',$sett[20][2])?>>필수입력</option><option value='2' <?=seltd('2',$sett[20][2])?>>선택입력</option><option value='0' <?=seltd('0',$sett[20][2])?>>사용안함</option></select>
&nbsp;성별 <select name='mpoint[]'><option value='1' <?=seltd('1',$sett[20][3])?>>필수입력</option><option value='2' <?=seltd('2',$sett[20][3])?>>선택입력</option><option value='3' <?=seltd('3',$sett[20][3])?> title='회원의 성별선택 사용안함'>사용안함</option></select>
<br />회원정보 추가 입력: <input type='text' name='mpoint[]' style='width:100px' value='<?=substr($sett[20],4)?>' />
<br /><div style='float:left'>회원 레벨명칭 :</div><div id='mbclass'>
<?
if($sett[59]) {
$sett59 = explode("\x18",$sett[59]);
for($i =0;$sett59[$i];$i++) {
?>
<span class='f8'><select name='mbclevel[]'><?=degree($sett59[$i][0],3)?></select>부터 <input type='text' name='mbcname[]' value='<?=substr($sett59[$i],1)?>' /><img src='icon/x.gif' alt='삭제' title='명칭삭제' onclick='addmbvs(this)' /> | </span>
<?}} if(!$sett59[1]) {?>
<span class='f8'><select name='mbclevel[]'><?=degree(0,3)?></select>부터 <input type='text' name='mbcname[]' /><img src='icon/x.gif' alt='삭제' title='명칭삭제' onclick='addmbvs(this)' /> | </span>
<?}?></div>
<input type='button' class='button' onclick='addmbvs()' value='레벨명칭추가' style='float:left;width:80px' /><div style='clear:both'></div>
회원탈퇴 방법: <select name='xl'><option value='0' <?=seltd('0',$sett[63])?>>회원 단독으로 탈퇴가능</option><option value='1' <?=seltd('1',$sett[63])?>>관리자에게 탈퇴신청</option></select><br />
<input type='submit' class='button' value='적용' style='width:200px'/>
</fieldset></form></td></tr>
</table>
<div  id='newpswd' style='display:none;text-align:center'></div>
<form name="memb" method="post" action="<?=$admin?>" style='margin:0;'>
<input type='hidden' name='from' value='<?=$_SERVER['SCRIPT_NAME']?>?<?=$_SERVER['QUERY_STRING']?>' />
<input type='hidden' name='username_3' value='' />
<input type='hidden' name='password_3' value='newpass' />
<input type='hidden' name='password2' value='' />
<input type='hidden' name='level' value='' />
<input type='hidden' name='no' value='' />
<input type='hidden' name='cnick' value='' />
<input type='hidden' name='cemail' value='' />
<input type='hidden' name='wr' value='' />
<input type='hidden' name='wc' value='' />
<input type='hidden' name='deletee' value='' />
</form>
<script type='text/javascript'>
//<![CDATA[
function vwtip(ths,i) {
var ttitle = Array("회원을 특정하는 고유번호 / 클릭하면 회원정보 링크",
"회원의 성별 / 클릭하면 홈페이지 링크",
"회원정보 수정내용 저장",
"회원의 비밀번호를 재설정",
"회원정보 삭제");
if(i == 'x' || ttitle[i]) {
if(i == 'x') ttitle = ths.title;
else if(ttitle[i]) {
if(ths.innerHTML) ttitle = ths.innerHTML +" :: " +ttitle[i];
else if(ths.value) ttitle = ths.value +" :: " +ttitle[i];
}
$('admtip').innerHTML = ttitle;
}}
function change(x, ode){
var meb = document.memb;
var nick = $('nick_' + x).value;
if(ode == 'delete') meb.deletee.value=ode;
else if(ode == 'newpass') newpd();
meb.username_3.value=chbase($('usr_' + x).value);
meb.level.value=$('level_' + x).value;
meb.no.value=$('no_' + x).value;
meb.cnick.value=$('nick_' + x).value;
meb.cemail.value=$('email_' + x).value;
meb.submit();
}
function newpd(pid,x) {
if(pid) {
$('newpswd').innerHTML = pid + "님의 새 비밀번호 : <input type='text' style='width:150px;margin-right:5px' /><input type='button' value='비밀번호변경' style='width:80px' class='button' onclick=\"var npss=this.previousSibling.value;if(npss != '') {document.memb.password2.value=npss;change('" + x + "','newpass')}\" /> &nbsp; <input type='button' value='취소' style='width:40px' class='button' onclick='newpd()' />";
$('newpswd').style.display = 'block';
} else {
$('newpswd').innerHTML = '';
$('newpswd').style.display = 'none';
}
}
function addmbvs(ths) {
var mbcls = $('mbclass');
var mbcln = mbcls.getElementsByTagName('span').length;
if(ths) {if(mbcln > 1) mbcls.removeChild(ths.parentNode);}
else if(mbcln < 9) mbcls.innerHTML = mbcls.innerHTML + "<span class='f8'>" + mbcls.getElementsByTagName('span')[mbcln -1].innerHTML + "</span>";
}
<? if($_GET['search'] && $_GET['keyword']) echo "document.smember.search.value = '{$_GET['search']}';document.smember.keyword.value = '{$_GET['keyword']}';";?>
document.title = "회원관리";
//]]>
</script>
<?
} else if($_GET['section']) {
$fsidlist = "^";
$fs = fopen($ds,"r");
while($fso = fgets($fs)) {
$fsid = trim(substr($fso,0,10));
$fsidlist .= $fsid."^";
}
fclose($fs);
$sectt = "<option value=''>사용안함</option>";
for($i = 0;$secto[$i]; $i++) {
$sectt .= "<option value='{$secto[$i]}'>{$secto[$i]}</option>";
}
?>
<table border='0px' cellpadding='5px' cellspacing='1px' class='ttb'>
<tr><td style='padding:5px 5px 5px 10px;line-height:230%' align='center'>
<form method='post' action='<?=$admin?>' style="margin:0">
<input type='hidden' name='stm' value='1' />
<div style='padding:10px 0 10px 0'>
<span style='font-weight:bold;'>레이아웃 선택 :: </span><select name='sectmenu' onchange='sectmenuchange(this)'>
<?=$sectt?>
</select> &nbsp; <b>편집</b> : <span id='sectmenudit'><a href='#none' onclick='popup("<?=$admin?>?fm=module/<?=$sett[26]?>.php", 800, 400)'><?=$sett[26]?>.php</a> &nbsp; <a href='#none' onclick='popup("<?=$admin?>?fm=module/<?=$sett[26]?>.css", 800, 400)'><?=$sett[26]?>.css</a></span></div>
<table cellpadding='3px' cellspacing='1px' width='900px'>
<caption style='background:#DADADA;border-bottom:2px solid #fff;padding:5px'><b>섹션그룹설정</b><a href='#none' onclick="popup('?fm=module/_head.php', 800, 400)" style="margin-left:50px">_head.php</a></caption>
<tr style='background-color:#EAEAEA'><th style='height:25px'>번호</th><th>이름</th><th>레이아웃</th><th>하위섹션</th><th title="
 회원번호를 입력합니다.
두명 이상일 경우엔 쉼표(,)로 구분합니다. 
">섹션그룹 관리자</th></tr>
<?
$i = 1;
$file = $dxr."section_group.dat";
$sectgp = "<option value='0'>&nbsp;</option>";
if(file_exists($file)) {
$st =fopen($file,"r");
while($sto = fgets($st)) {
if($stn = explode("\x1b",$sto)) {
$sectgp .= "<option value='{$i}'>{$stn[0]}</option>";
?>
<tr style='text-align:center'>
<td><input type='text' value='<?=$i?>' style='border:0;width:20px' /></td>
<td><input type='text' name='stgs[]' value='<?=str_replace("&","&amp;",$stn[0])?>' style='width:200px' /></td>
<td><input type='hidden' value='<?=$stn[1]?>' /><select name='stgl[]'><?=$sectt?></select></td>
<td><input type='text' value='<?=$stn[2]?>' style='width:200px' readonly='readonly' /></td>
<td><input type='text' name='stga[]' value='<?=$stn[3]?>' style='width:200px' /></td></tr>
<?
$i++;
}}
fclose($st);
}
?>
<tr style='text-align:center'>
<td>new</td>
<td><input type='text' name='stgs[]' value='' style='width:200px' /></td>
<td><select name='stgl[]'><?=$sectt?></select></td>
<td style='width:200px'></td>
<td><input type='text' name='stga[]' value='' style='width:200px' /></td></tr>
</table>
<table cellpadding='3px' cellspacing='1px' width='900px'>
<caption style='background:#DADADA;border-bottom:2px solid #fff;padding:5px'><b>섹션설정</b></caption>
<colgroup><col width='50px' /><col width='50px' /><col width='70px' /><col width='385px' /><col width='90px' /><col width='155px' /><col width='100px' /></colgroup>
<tr style='background-color:#EAEAEA'><th style='height:25px'>번호</th><th>순서</th>
<th>섹션이름</th><th>하위목록</th><th>하위목록처리</th><th>대문좌우하단css</th><th>섹션그룹</th></tr>
<?
$file = $dxr."section.dat";
$i = 1;
if(file_exists($file)) {
$st =fopen($file,"r");
while($sto = fgets($st)) {
if($stn = explode("\x1b",$sto)) {
$im = $i - 1;
if($stn[1] != '3' && $stn[1] != '6' && $stn[1] != '7' && $stn[1] != 's') $sectedit = "<input type='button' value='대문' onclick=\"popup('?ectgt=' + $$('sn[]',".$im.").value,500,410)\" class='button' style='width:25px' /> <input type='button' value='좌우' onclick=\"popup('?sect_arr=' + $$('sn[]',".$im.").value,610,500)\" class='button' style='width:25px' /> <input type='button' value='하단' onclick=\"popup('?fm=widget/sectbtm_{$i}', 800, 400)\" class='button' style='width:25px' /> <input type='button' value='css' onclick=\"popup('?fm=module/sectcss_{$i}.css', 800, 400)\" class='button' style='width:25px' />";
else $sectedit = "";
$stid = explode("^",$stn[2]);
for($ii = 0;$stid[$ii];$ii++) $fsidlist = str_replace("^".$stid[$ii]."^","^",$fsidlist);
if($stn[4]) $stn[4] =";background:#F7F4E1' title='가입회원:".(substr_count($stn[5],',') -1)."명";
?>
<tr style='text-align:center'><td><input type='text' name='sn[]' value='<?=$i?>' style='border:0;width:20px' onclick="nwopn('<?=$index?>?section=<?=$i?>')" /></td><td><input type='button' value='↑' onclick='mvup(<?=$i?>)' class='uparrow' /></td><td><input type='text' name='sect[]' value='<?=str_replace("&","&amp;",$stn[0])?>' style='width:60px' /></td><td><input type='text' name='sectadd[]' value='<?=str_replace("&","&amp;",$stn[2])?>' style='width:335px' /><input type='button' value='소모임' onclick="popup('?sect_group=' + $$('sn[]',<?=$im?>).value,300,320)" class='button' style='width:40px<?=$stn[4]?>' /> </td>
<td><input type='hidden' value='<?=$stn[1]?>' /><select name='sectlnk[]'><option value='1'>+섹션대문</option><option value='4'>&nbsp; └ 출력x</option><option value='3'>-링크</option><option value='6'>-새창링크</option><option value='7'>-스크립트</option><option value='8'>+전체대문</option><option value='s'>+하위메뉴</option><option value='x'>+섹션안씀</option></select></td>
<td><?=$sectedit?></td><td><input type='hidden' value='<?=$stn[6]?>' /><select name='sectgrp[]'><?=$sectgp?></select></td></tr>
<?
$i++;
}
}
fclose($st);
}
if($i < 98) {
?>
<tr style='text-align:center'><td>new</td><td></td><td><input type='text' name='sect[]' id='new' value='' style='width:60px' /></td><td><input type='text' name='sectadd[]' value='' style='width:365px' /></td>
<td><select name='sectlnk[]'><option value='1'>+섹션대문</option><option value='4'>&nbsp; └ 출력x</option><option value='3'>-링크</option><option value='6'>-새창링크</option><option value='7'>-스크립트</option><option value='8'>+전체대문</option><option value='s'>+하위메뉴</option><option value='x'>+섹션안씀</option></select></td>
<td style='border:1px solid #919191'>하단 출력위치</td><td>: <select id='sectbtm' onchange='var sf=document.sectbtmf;sf.xg.value=this.options[this.selectedIndex].value;sf.submit()'><option value='100'>대문</option><option value='010'>목록</option><option value='001'>본문</option><option value='011'>목록+본문</option><option value='110'>대문+목록</option><option value='101'>대문+본문</option><option value='111'>대문+목록+본문</option></select></td></tr>
<?
}
$fsidlist = substr($fsidlist,1,-1);
if(!$fsidlist) $fsidlist = "없음";
?>
<tr><td colspan='7' align='center'>
섹션에 할당 안된 게시판 : <textarea rows='1' cols='1'style='width:600px;height:18px;overflow:auto;border:0;background:#F7F7F7' >^<?=$fsidlist?></textarea>
<div id='secxplain'>
<span class='red'>## 하위목록처리 - 하나짜리</span><br />
-링크 :: 링크주소 하나 입력<br />
-새창링크 :: 링크주소 하나 입력<br />
-스크립트 :: 자바스크립트 하나 입력<br />
<span class='red'>## 하위목록처리 - 기타</span><br />
+섹션대문 :: 하위메뉴 O, 섹션대문 O, 섹션이름 O<br />
&nbsp; └ 출력x :: 하위메뉴 O, 섹션대문 O, 섹션이름 X<br />
+전체대문 :: 전체게시판 하위목록에 추가해서 '섹션대문'으로<br />
+하위메뉴 :: 하위메뉴 O, 섹션대문 X, 섹션이름 O<br />
+섹션안씀 :: 하위메뉴 게시판은 섹션대문 X, 섹션이름 X<br />
<span class='red'># 하위목록 입력방법</span><br />
└게시판 :: <span class='blue'>게시판아이디1<span class='red'>^</span>게시판아이디2<span class='red'>^</span>게시판아이디3</span><br />
└링크 :: <span class='blue'>제목1<span class='red'>></span>경로1<span class='red'>^</span>제목2<span class='red'>></span>경로2</span><br />
└새창링크 :: <span class='blue'>제목1<span class='red'>></span>경로1<span class='red'>></span>nw<span class='red'>^</span>제목2<span class='red'>></span>경로2<span class='red'>></span>nw</span><br />
└자바스크립트함수링크 :: <span class='blue'>제목1<span class='red'>></span>함수1<span class='red'>></span>js<span class='red'>^</span>제목2<span class='red'>></span>함수2<span class='red'>></span>js</span>
<br/>&nbsp; └ (작은 따옴표 사용불가, 큰 따옴표만)
</div></td></tr>
</table>
<?
if(is_dir("widget")) {
$wdopen = opendir("widget");
while($wfile[] = readdir($wdopen)) {}
closedir($wdopen);
@sort($wfile);
foreach($wfile as $w) if($w != '.' && $w != '..' && $w) {
if(substr($w,-4) == '.css') $wcss[] = $w;
else $wphp[] = $w;
}}
$wtitl = array();
$wtitl['by_hot3php'] = "조회순/덧글순/추천순 탭형목록";
$wtitl['by_hotphp'] = "조회순,덧글순,추천순 중 소스에서 설정하는 하나짜리";
$wtitl['hot_postphp'] = "전체 최근 게시물";
$wtitl['hot_replephp'] = "전체 최근 덧글";
$wtitl['hot2php'] = "전체최근글/전체최근덧글 탭형목록";
$wtitl['markerphp'] = "전광판";
$wtitl['markerdat'] = "전광판 데이타파일";
$wtitl['member_loginphp'] = "회원로그인";
$wtitl['researchphp'] = "설문조사";
?>
<fieldset id='gatewidget' style="border:1px solid #0000ff;padding:30px;width:550px"><legend style='padding:0 20px 0 20px'><b>대문위젯 :: </b>대문(편집)에 <##widget/파일이름##> 삽입, <b>스타일 선택 :: </b><select name='wgcss'><option value=''></option>
<?
if($wcss) foreach($wcss as $css) echo "<option value='".substr($css,0,-4)."'>{$css}</option>";
?>
</select></legend>
<?
if($wcss) foreach($wcss as $w) echo "<div><a href='#none' onclick=\"popup('?fm=widget/{$w}', 800, 400)\">{$w}</a></div>";
echo "<hr style='clear:both' />";
if($wphp) foreach($wphp as $w) echo "<div><a href='#none' onclick=\"popup('?fm=widget/{$w}', 800, 400)\" title='".$wtitl[str_replace(".","",$w)]."'>{$w}</a></div>";
?>
</fieldset>
<input type='submit' value=' 적용 ' class='button' style='width:400px;height:20px;margin:15px 0 10px 0' />
</form>
<form name='sectbtmf' method='post' action='<?=$admin?>' style="margin:0">
<input type='hidden' name='from' value='<?=$_SERVER['QUERY_STRING']?>' />
<input type='hidden' name='xg' value='' />
</form>
<script type='text/javascript'>
function mvup(ths) {
var pt=ths - 2;
var nt=ths - 1;
var psect = $$('sect[]',pt).value;
$$('sect[]',pt).value = $$('sect[]',nt).value;
$$('sect[]',nt).value = psect;
var psectadd = $$('sectadd[]',pt).value;
$$('sectadd[]',pt).value = $$('sectadd[]',nt).value;
$$('sectadd[]',nt).value = psectadd;
var psectlnk = $$('sectlnk[]',pt).value;
$$('sectlnk[]',pt).value = $$('sectlnk[]',nt).value;
$$('sectlnk[]',nt).value = psectlnk;
var psectsn = $$('sn[]',pt).value;
$$('sn[]',pt).value = $$('sn[]',nt).value;
$$('sn[]',nt).value = psectsn;
var psectgrp = $$('sectgrp[]',pt).value;
$$('sectgrp[]',pt).value = $$('sectgrp[]',nt).value;
$$('sectgrp[]',nt).value = psectgrp;
}
$$('sectmenu',0).value = '<?=$sett[26]?>';
$$('wgcss',0).value = '<?=$sett[45]?>';
$('sectbtm').value = '<?=$sett[58]?>';
if($('new')) $('new').focus();
for(var i=document.getElementsByName('sectlnk[]').length -2;i >= 0;i--) {$$('sectlnk[]',i).value = $$('sectlnk[]',i).previousSibling.value;$$('sectgrp[]',i).value = $$('sectgrp[]',i).previousSibling.value;}
for(var i=document.getElementsByName('stgl[]').length -2;i >= 0;i--) {$$('stgl[]',i).value = $$('stgl[]',i).previousSibling.value;}
document.title='섹션관리';
</script>
</td></tr>
</table>
<?
} else if($_GET['statistics']) {
$countin = array("hour","request","host","query","browser");
$counting = array(array(),array(),array(),array(),array());
for($c = 0;$c < 5;$c++) {
if($_GET['statistics'] == 1 || ($c != 0 && $c != 4)) {
if($fv = @fopen($dxr."count_".$countin[$c].".dat","r")) {
while($fvo = trim(fgets($fv))) {
$fvn = (int)substr($fvo,0,6);
if($c == 0 || $c == 4 || $fvn >= $sett[47]) $counting[$c][substr($fvo,6)] = $fvn;
}
fclose($fv);
}}}
if($_GET['statistics'] == 1) {
?>
<table id='graph_browser' class='table' cellpadding='2px' cellspacing='2px'><tr><th colspan='8' class='title'>누적 브라우저별</th></tr>
<tr>
<?
$sum = 0;
$cnt ='';
$browser = array('ie6','ie7','ie8','ie9','chrome','firefox','opera','other');
for($b = 0;$b < 8;$b++) {
$sum += $counting[4][$browser[$b]];
?><td><?=$browser[$b]?></td><?
$cnt .= "<td>{$counting[4][$browser[$b]]}</td>";
}
?>
</tr><tr class='cnt'><?=$cnt?></tr>
<tr style='height:100px'>
<?
if($sum) {
for($b = 0;$b < 8;$b++) {
$wd = sprintf("%.2f",$counting[4][$browser[$b]]/$sum);
?>
<td valign='bottom'><div style='height:<?=($wd*100)+10?>px'><?=$wd*100?>%</div></td>
<?
}}
$vmonth = ($_GET['month'])? $_GET['month']:date("Ym",$time -86400*3);
$vday = array();
$amonth = array();
$big = 0;
if($fp = @fopen($dxr."count.dat","r")) {
while($fpo = fgets($fp)) {
$vc = (int)substr($fpo,8);
if(substr($fpo,0,6) == $vmonth) {$vday[substr($fpo,6,2)] = $vc;if($big < $vc) $big = $vc;}
$amonth[substr($fpo,0,6)] += $vc;
}
fclose($fp);
}
?>
</tr></table>
<table id='graph_month' class='table' cellpadding='2px' cellspacing='2px'><tr><td class='title'><div style='float:left;width:480px;background:transparent;padding-top:3px'><b><?=substr($vmonth,0,4)?>년 <?=substr($vmonth,4)?>월 방문자수</b> (전체:<?=$amonth[$vmonth]?> 최고:<?=$big?>) </div><select onchange="location.href='?statistics=1&amp;month=' + this.options[this.selectedIndex].value;" style='float:right'>
<?
foreach($amonth as $key => $value) {
if($key == $vmonth) echo "<option value='{$key}' selected='selected'>{$key} ({$value})</option>";
else echo "<option value='{$key}'>{$key} ({$value})</option>";
}
?></select></td></tr>
<tr><td valign='bottom' height='130px'>
<?
foreach($vday as $key => $value) {
?><div style='height:<?=$value/$big*100?>%'><?=$key?><br /><span class='f7'><?=$value?></span></div><?
}
?>
</td></tr></table>
<table id='graph_hour' class='table' style='clear:both' cellpadding='2px' cellspacing='2px'><tr><th colspan='25' class='title'>누적 시간대별</th></tr>
<tr>
<?
$sum = 0;
$cnt ='';
for($i = 0;$i < 24;$i++) {
$ii = str_pad($i,2,0,STR_PAD_LEFT);
$sum += $counting[0][$ii];
?>
<td><?=$i?>시</td>
<?
$cnt .= "<td>{$counting[0][$ii]}</td>";
}
?>
</tr><tr class='cnt'><?=$cnt?></tr>
<tr style='height:100px'>
<?
if($sum) {
for($i = 0;$i < 24;$i++) {
$ii = str_pad($i,2,0,STR_PAD_LEFT);
$wd = sprintf("%.2f",$counting[0][$ii]/$sum);
?>
<td valign='bottom'><div style='height:<?=($wd*300)+10?>px'><?=$wd*100?>%</div></td>
<?
}}
?>
</tr></table>
<?
}
?>
<table cellpadding='2px'><tr>
<?
$max = 0;
$name = array('','요청받은 페이지','접속한 사이트','검색어순위');
for($c=1;$c < 4;$c++) {
$cnt = count($counting[$c]);
$max = ($max > $cnt)? $max:$cnt;
?>
<td valign='top'><table cellpadding='2px' cellspacing='2px' class='table'>
<tr class='title'><th width='40px'>순위</th><th width='40px'>횟수</th><th width='216px'><b><?=$name[$c]?></b></th></tr>
<?
arsort($counting[$c]);
$d = 0;
$limit = ($_GET['statistics'] == 1)? 10:20;
$start = ($_GET['statistics'] == 1)? 0:($_GET['statistics']-1)*$limit -10;
foreach($counting[$c] as $key => $value) {
$key = str_replace("&","&amp;",$key);
if($d >= $start) {
if($c == 1) $key = "<a target='_blank' href='{$index}?{$key}'>{$key}</a>";
else if($c == 2) $key = "<a target='_blank' href='http://{$key}'>{$key}</a>";
?>
<tr><td><?=$d+1?></td><td class='cnt'><?=$value?></td><td><?=$key?></td></tr>
<?
}
$d++;
if($d == $start + $limit) break;
}
?>
</table></td>
<?
}
?>
</tr>
<tr><td colspan='3' align='center'>
<?
$max = (int)(($max + 9)/20) +1;
pagen('statistics',$max,20,0);
?>
</tr>
<tr><td colspan='3' align='center'>
<script type='text/javascript'>
function vwtip(ths,i) {
var ttitle = Array("접속통계 횟수순 정렬에 출력할 배열의 최소횟수를 정합니다","접속통계 저장데이타 중에서 횟수 *회 이하의 기록을 삭제합니다");
ths.title = "\n  " + ttitle[i] + "  \n \n";
}
document.title='접속통계';
</script>
<div style='float:right'><form method='post' action='<?=$admin?>' style="margin:0"><input type='hidden' name='from' value='<?=$_SERVER['QUERY_STRING']?>' />요청받은 페이지 <input type='text' name='dlimit[]' value='0' style='width:15px' /><span onmouseover='vwtip(this,1)'>접속한 사이트 </span><input type='text' name='dlimit[]' value='0' style='width:15px' /> 검색어순위 <input type='text' name='dlimit[]' value='0' style='width:15px' />이하 내역삭제</span>  &nbsp; <span onmouseover='vwtip(this,0)'>접속통계 배열최소횟수</span>: <input type='text' name='statisticn' style='width:35px' value='<?=$sett[47]?>' /> &nbsp; <input type='submit' class='button' value='적용' /></form>
</div></td></tr></table>
<?
} else {
$sett_xd=substr($sett[16],0,3);
$sett_xe=substr($sett[16],3,3);
for($i = substr_count(substr($sett[14],7 + strlen($_SERVER['HTTP_HOST'])),'/');$i > 1;$i--) $sett_we .= '../';
if(file_exists($sett_we.'favicon.ico')) $sett_we = "<input type='checkbox' onclick=\"this.previousSibling.value=(this.previousSibling.value == '1')? '0':'1'\" ".rtchecked($sett[31])." class='no' /> 사용여부 선택";
else {$sett_we = "파일없음";$sett[31] = 0;}
?>
<table border='0px' cellpadding='5px' cellspacing='1px' class='ttb'>
<tr><td style='padding:5px'>
<div id='admtip' style='width:920px'>전체설정</div></td></tr>
<tr><td style='padding:5px 5px 5px 150px;text-align:left'>
<form action="<?=$admin?>" method="post" style="margin:0;line-height:220%">
홈페이지 제목: <input type='text' name='titlee' style='width:150px' value='<?=$sett[0]?>' /> &nbsp; <span onmouseover='vwtip(this,0)'>즐겨찾기 파비콘 (http://<?=$_SERVER['HTTP_HOST']?>/favicon.ico)</span> <input type='hidden' name='we' value='<?=$sett[31]?>' /><?=$sett_we?><br />
<span onmouseover='vwtip(this,1)'>외부파일 삽입</span>: &nbsp; → 위쪽 : <input type='text' name='b' style='width:100px' value='<?=$sett[2]?>' /> &nbsp; → 아래쪽 : <input type='text' name='c' style='width:100px' value='<?=$sett[3]?>' /> &nbsp; → CSS : <input type='text' name='ww' style='width:100px' value='<?=$sett[24]?>' /><br />
가로넓이 설정: &nbsp; → <span onmouseover='vwtip(this,2)'>본문그림</span> : <input type='text' name='k' style='width:30px' value='<?=$sett[11]?>' /> &nbsp; → <span onmouseover='vwtip(this,3)'>게시판</span> : <input type='text' name='l' style='width:30px' value='<?=$sett[12]?>' /><select name='vc'><option value='0' <?=seltd('0',$sett[77])?>>px</option><option value='1' <?=seltd('1',$sett[77])?>>%</option></select><span> &nbsp; → <span onmouseover='vwtip(this,62)'>게시판 최소 넓이</span> : <input type='text' name='vl' style='width:30px' value='<?=$sett[88]?>' /></span>
<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; → <span onmouseover='vwtip(this,42)'>미리보기</span>: <input type='text' name='xc' style='width:30px' value='<?=$sett[55]?>' /> &nbsp; → <span onmouseover='vwtip(this,4)'>덧글표시</span> : <input type='text' name='wb' style='width:30px' value='<?=$sett[28]?>' /> &nbsp; → <span onmouseover='vwtip(this,5)'>덧글미리보기</span> : <input type='text' name='e' style='width:30px' value='<?=$sett[5]?>' /><br />
좌우메뉴 넓이: &nbsp; → 대문 :: 좌측 : <input type='text' name='xp' style='width:30px' value='<?=$sett[67]?>' /> &nbsp; 우측 : <input type='text' name='xq' style='width:30px' value='<?=$sett[68]?>' /> &nbsp; → 게시판 :: 좌측 : <input type='text' name='xr' style='width:30px' value='<?=$sett[69]?>' /> &nbsp; 우측 : <input type='text' name='xs' style='width:30px' value='<?=$sett[70]?>' /> &nbsp; → <span onmouseover='vwtip(this,58)'>좌우메뉴간격</span> : <input type='text' name='vd' style='width:30px' value='<?=$sett[78]?>' /><br />
<span onmouseover='vwtip(this,6)'>상단 내용추가</span>: <textarea name='head' rows='1' cols='1' style='width:500px;height:80px;overflow:auto'><? if($fp=@fopen($dxr."head","r")) {echo str_replace("&","&amp;",@fread($fp,filesize($dxr."head")));fclose($fp);}?></textarea><br />
<span onmouseover='vwtip(this,46)'>출력위치 설정</span>: <select name='xd'><option value='100' <?=seltd('100',$sett_xd)?>>대문</option><option value='010' <?=seltd('010',$sett_xd)?>>목록</option><option value='001' <?=seltd('001',$sett_xd)?>>본문</option><option value='011' <?=seltd('011',$sett_xd)?>>목록+본문</option><option value='110' <?=seltd('110',$sett_xd)?>>대문+목록</option><option value='101' <?=seltd('101',$sett_xd)?>>대문+본문</option><option value='111' <?=seltd('111',$sett_xd)?>>대문+목록+본문</option></select><br />
<span onmouseover='vwtip(this,7)'>하단 내용추가</span>: <textarea name='tail' rows='1' cols='1' style='width:500px;height:80px;overflow:auto'><? if($fp=@fopen($dxr."tail","r")) {echo str_replace("&","&amp;",@fread($fp,filesize($dxr."tail")));fclose($fp);}?></textarea><br />
<span onmouseover='vwtip(this,47)'>출력위치 설정</span>: <select name='xe'><option value='100' <?=seltd('100',$sett_xe)?>>대문</option><option value='010' <?=seltd('010',$sett_xe)?>>목록</option><option value='001' <?=seltd('001',$sett_xe)?>>본문</option><option value='011' <?=seltd('011',$sett_xe)?>>목록+본문</option><option value='110' <?=seltd('110',$sett_xe)?>>대문+목록</option><option value='101' <?=seltd('101',$sett_xe)?>>대문+본문</option><option value='111' <?=seltd('111',$sett_xe)?>>대문+목록+본문</option></select><br />
<span onmouseover='vwtip(this,13)'>회원가입 약관</span>: <textarea name='member_agreement' rows='1' cols='1' style='width:500px;height:80px;overflow:auto'><? if($fp=@fopen($dxr."member_agreement","r")) {echo str_replace("&","&amp;",@fread($fp,filesize($dxr."member_agreement")));fclose($fp);}else echo "홈페이지에 맞는 이용약관을 입력합니다.";?></textarea><br />
<span onmouseover='vwtip(this,14)'><b>대문</b> 스킨</span>: <select name='a'>
<?=$skinoption?>
</select> &nbsp; <span onmouseover='vwtip(this,15)'>대문 셀간격</span>: <input type='text' name='wn' value='<?=$sett[39]?>' style='width:30px' /> &nbsp; <span onmouseover='vwtip(this,16)'>게시판하나 대문출력여부</span>: <select name='wo'><option value='0' <?=seltd('0',$sett[40])?> onmouseover='vwtip(this,17)'>no</option><option value='1' <?=seltd('1',$sett[40])?>>yes</option></select><br />
<span><b>rss</b>&nbsp; 피드 갯수</span>: &nbsp; → 게시판 : <input type='text' name='wj' style='width:35px' value='<?=$sett[35]?>' /> &nbsp; → <span>전체피드</span> : <input type='text' name='wk' style='width:35px' value='<?=$sett[36]?>' /> &nbsp; → <span onmouseover='vwtip(this,30)'>rss&nbsp;본문길이</span>: <select name='d'><option value='0' <?=seltd('0',$sett[4])?>>본문전체</option><option value='1' <?=seltd('1',$sett[4])?>>128byte</option><option value='2' <?=seltd('2',$sett[4])?>>256byte</option><option value='3' <?=seltd('3',$sett[4])?>>512byte</option><option value='4' <?=seltd('4',$sett[4])?>>1024byte</option><option value='5' <?=seltd('5',$sett[4])?>>2048byte</option></select> &nbsp; → <span onmouseover='vwtip(this,31)'>rss&nbsp;html삭제</span>: <select name='wa'><option value='0' <?=seltd('0',$sett[27])?>>삭제안함</option><option value='1' <?=seltd('1',$sett[27])?>>삭제함</option></select><br />
<span onmouseover='vwtip(this,22)'><b>태그</b> 나열갯수</span>: <input type='text' name='w' style='width:35px' value='<?=$sett[23]?>' />
&nbsp; <span onmouseover='vwtip(this,21)'>태그링크의 목록방식</span>: <select name='v'><option value='a' <?=seltd('a',$sett[22])?>>제목형</option><option value='b' <?=seltd('b',$sett[22])?>>본문형</option><option value='c' <?=seltd('c',$sett[22])?>>요약형</option></select>
&nbsp; <span onmouseover='vwtip(this,20)'>태그 스타일구분 횟수</span>: <input type='text' name='u' style='width:65px' value='<?=$sett[21]?>' /><br />
<span onmouseover='vwtip(this,11)'><b>메일</b>발송 사용</span>: <select name='h'><?=degree($sett[8],4)?><option value='a' <?=seltd('a',$sett[8])?>>사용안함</option></select>
&nbsp; <span onmouseover='vwtip(this,12)'>메일발송 방법</span>: <select name='r'><option value='0' <?=seltd('0',$sett[15])?>>아웃룩 (자동발송X)</option><option value='1' <?=seltd('1',$sett[15])?>>팝업창 (자동발송O)</option></select>
<? if($sett[15] == 1){?>&nbsp; <span onmouseover='vwtip(this,41)'>메일인증 사용여부</span>: <select name='wt'><option value='0' <?=seltd('0',$sett[46])?>>사용안함</option><option value='1' <?=seltd('1',$sett[46])?>>회원가입에만</option><option value='2' <?=seltd('2',$sett[46])?>>이메일변경에만</option><option value='3' <?=seltd('3',$sett[46])?>>모두사용함</option></select><?}?><br />
<span onmouseover='vwtip(this,19)'>방문내역 열람</span>: <select name='wv'><?=degree($sett[25],4)?></select><br />
<span onmouseover='vwtip(this,37)'>분산저장 단위</span>: <input type='text' name='g' style='width:100px' value='<?=$sett[7]?>' /><br />
<span onmouseover='vwtip(this,8)'>내용추가 방식</span>: <select name='wf'><option value='0' <?=seltd('0',$sett[32])?>>include</option><option value='1' <?=seltd('1',$sett[32])?>>readfile</option></select>
&nbsp; <span onmouseover='vwtip(this,28)'>임시파일 삭제</span>: <select name='wd'><option value='1'>1일뒤</option><option value='0.5'>12시간뒤</option><option value='0.25'>6시간뒤</option><option value='2'>2일뒤</option><option value='3'>3일뒤</option><option value='7'>7일뒤</option><option value='0'>삭제안함</option></select><br />
<span onmouseover='vwtip(this,9)'>파일 외부링크</span>: <select name='m'><option value='0' <?=seltd('0',$sett[13])?>>비허용</option><option value='1' <?=seltd('1',$sett[13])?>>허용</option></select>
&nbsp; <span onmouseover='vwtip(this,10)'>업로드 크기제한</span>: <input type='checkbox' onclick="this.nextSibling.value=(this.checked)?'<?=$sett[9]?>':'0';this.nextSibling.style.display=(this.checked)?'':'none';" <?=rtchecked($sett[9])?> class='no' style='margin-right:5px' /><input type='text' name='i' value='<?=$sett[9]?>' />mb<br />
<span onmouseover='vwtip(this,49)'>NEW 표시기간</span>: <select name='xk'><option value='0' <?=seltd('0',$sett[62])?>>출력안함</option><option value='1' <?=seltd('1',$sett[62])?>>6시간</option><option value='2' <?=seltd('2',$sett[62])?>>12시간</option><option value='4' <?=seltd('4',$sett[62])?>>24시간</option><option value='8' <?=seltd('8',$sett[62])?>>2일</option><option value='12' <?=seltd('12',$sett[62])?>>3일</option><option value='28' <?=seltd('28',$sett[62])?>>7일</option></select>
&nbsp; <span onmouseover='vwtip(this,23)'>추천인 ip 보존기간</span>: <input type='text' name='wc' style='width:50px' value='<?=$sett[29]?>' /> 일<br />
<span onmouseover='vwtip(this,51)'>덧글 목록갯수</span>:  <input type='text' name='xn' style='width:50px' value='<?=$sett[65]?>' /> 개
&nbsp; <span onmouseover='vwtip(this,52)'>덧글 페이지 처리</span>:  <select name='xo'><option value='0' <?=seltd('0',$sett[66])?>>페이징 사용안함</option><option value='1' <?=seltd('1',$sett[66])?>>정확히 갯수로 자름</option><option value='2' <?=seltd('2',$sett[66])?>>하위 덧글 이어붙임</option></select><br />
<span onmouseover='vwtip(this,48)'>대문 회전주기</span>: <span>탭형목록</span> <input type='text' name='xia' style='width:50px' value='<? $sett60 = strpos($sett[60],'|');echo substr($sett[60],0,$sett60)?>' /> 초
 &nbsp; <span>뉴스형내용</span> <input type='text' name='xib' style='width:50px' value='<?=substr($sett[60],$sett60 + 1)?>' />초<br />
<span onmouseover='vwtip(this,18)'>검색목록 새창</span>: <select name='j'><option value='1' <?=seltd('1',$sett[10])?>>모두 새창으로</option><option value='2' <?=seltd('2',$sett[10])?>>게시판검색만 새창</option><option value='3' <?=seltd('3',$sett[10])?>>전체검색만 새창</option><option value='4' <?=seltd('4',$sett[10])?>>모두 그 창에서</option></select>
&nbsp; <span onmouseover='vwtip(this,39)'>덧글 이미지URL 처리</span>: <select name='wq'><option value='0' <?=seltd('0',$sett[42])?>>이미지팝업 링크</option><option value='1' <?=seltd('1',$sett[42])?>>이미지 직접출력</option></select>
&nbsp; <span onmouseover='vwtip(this,26)'>블로그형목록배수</span>: <select name='s'><option value='1' <?=seltd('1',$sett[19])?>>1x</option><option value='2' <?=seltd('2',$sett[19])?>>2x</option><option value='3' <?=seltd('3',$sett[19])?>>3x</option><option value='4' <?=seltd('4',$sett[19])?>>4x</option><option value='5' <?=seltd('5',$sett[19])?>>5x</option><option value='6' <?=seltd('6',$sett[19])?>>6x</option><option value='7' <?=seltd('7',$sett[19])?>>7x</option><option value='8' <?=seltd('8',$sett[19])?>>8x</option><option value='9' <?=seltd('9',$sett[19])?>>9x</option><option value='10' <?=seltd('10',$sett[19])?>>10x</option><option value='11' <?=seltd('11',$sett[19])?>>11x</option><option value='12' <?=seltd('12',$sett[19])?>>12x</option><option value='13' <?=seltd('13',$sett[19])?>>13x</option><option value='14' <?=seltd('14',$sett[19])?>>14x</option><option value='15' <?=seltd('15',$sett[19])?>>15x</option><option value='16' <?=seltd('16',$sett[19])?>>16x</option><option value='17' <?=seltd('17',$sett[19])?>>17x</option><option value='18' <?=seltd('18',$sett[19])?>>18x</option><option value='19' <?=seltd('19',$sett[19])?>>19x</option><option value='20' <?=seltd('20',$sett[19])?>>20x</option></select><br />
<span onmouseover='vwtip(this,32)'>상단 이름경로</span>: <select name='wp'><option value='0' <?=seltd('0',$sett[41])?>>표시안함</option><option value='1' <?=seltd('1',$sett[41])?>>경로빼고 게시판이름만</option><option value='2' <?=seltd('2',$sett[41])?>>그룹경로 뺌</option><option value='3' <?=seltd('3',$sett[41])?>>섹션경로 뺌</option><option value='4' <?=seltd('4',$sett[41])?>>게시판경로 뺌</option><option value='5' <?=seltd('5',$sett[41])?>>그룹경로만</option><option value='6' <?=seltd('6',$sett[41])?>>섹션경로만</option><option value='7' <?=seltd('7',$sett[41])?>>게시판경로만</option><option value='8' <?=seltd('8',$sett[41])?>>전부 표시함</option></select>
&nbsp; <span onmouseover='vwtip(this,43)'>회원로그 스킨</span>: <select name='wx'><?=$skinoption?></select><br />
<span onmouseover='vwtip(this,40)'>썸네일 작성크기</span>:  &nbsp; → 가로 : <input type='text' name='wr1' style='width:35px' maxlength='4' value='<?=(int)substr($sett[43],0,4)?>' />px &nbsp; → 세로 : <input type='text' name='wr2' style='width:35px' maxlength='4' value='<?=(int)substr($sett[43],4,4)?>' />px<span onmouseover='vwtip(this,24)'> &nbsp; → 썸네일 화질 : </span><input type='text' name='wr3' style='width:25px' maxlength='3' value='<?=(int)substr($sett[43],8,3)?>' />% &nbsp; → 썸네일 원본비율 : </span><select name='wr4'><option value='0' <?=seltd('0',substr($sett[43],11,1))?>>여백줘서 원본비율로</option><option value='1' <?=seltd('1',substr($sett[43],11,1))?>>여백없이 꽉차게</option></select><br />
<span onmouseover='vwtip(this,25)'>글쓴이 팝업메뉴</span>:  <select name='ws'><option value='1' <?=seltd('1',$sett[44])?>>아이콘에 큰 이미지</option><option value='2' <?=seltd('2',$sett[44])?>>팝업에 큰 이미지</option><option value='3' <?=seltd('3',$sett[44])?>>둘 다 보임</option><option value='4' <?=seltd('4',$sett[44])?>>둘 다 안보임</option></select>
&nbsp; <span onmouseover='vwtip(this,36)'>글쓰기 원격작성가능 회원레벨</span>:  <select name='xb'><option value='0' <?=seltd('0',$sett[54])?>>모두 불허</option><?=degree($sett[54],3)?></select><br />
<span onmouseover='vwtip(this,27)'>글쓰기 높이설정</span>: <input type='text' name='wg' style='width:100px' value='<?=$sett[33]?>' />px<br />
<span onmouseover='vwtip(this,45)'>글쓰기 시간간격</span>:  &nbsp; → 본문 : <input type='text' name='wy' style='width:35px' value='<?=$sett[49]?>' />분 &nbsp; → 덧글 : <input type='text' name='wz' style='width:35px' value='<?=$sett[50]?>' />분 &nbsp; → 적용 안받는 대상 : <select name='xa'><?=degree($sett[51],4)?></select><br />
<span onmouseover='vwtip(this,61)'>게시물 길이제한</span>:  &nbsp; → 본문 : <input type='text' name='vi' style='width:35px' value='<?=$sett[85]?>' />KB &nbsp; → 덧글 : <input type='text' name='vj' style='width:35px' value='<?=$sett[86]?>' />KB &nbsp; → 적용 안받는 대상 : <select name='vk'><?=degree($sett[87],4)?></select><br />
<span onmouseover='vwtip(this,59)'>스팸방지 코드</span>: <select name='wh'><option value='0' <?=seltd('0',$sett[82])?>>사용안함</option><option value='1' <?=seltd('1',$sett[82])?>>비회원 덧글</option><option value='2' <?=seltd('2',$sett[82])?>>비회원 덧글, 회원 덧글</option><option value='3' <?=seltd('3',$sett[82])?>>비회원 덧글+글쓰기</option><option value='4' <?=seltd('4',$sett[82])?>>비회원 덧글+글쓰기, 회원 덧글</option><option value='5' <?=seltd('5',$sett[82])?>>비회원 덧글+글쓰기, 회원 덧글+글쓰기</option></select><br />
<span onmouseover='vwtip(this,55)'>로그인 체크박스</span>: <select name='xh'><option value='0' <?=seltd('0',$sett[17])?>>출력 안함</option><option value='1' <?=seltd('1',$sett[17])?>>글쓰기에 출력</option><option value='2' <?=seltd('2',$sett[17])?>>덧글쓰기에 출력</option><option value='3' <?=seltd('3',$sett[17])?>>양쪽 모두 출력</option></select><br />
<span onmouseover='vwtip(this,53)'>변경금지 설정: &nbsp; → 시간</span> : 작성후 <input type='text' name='xt' style='width:50px' value='<?=$sett[71]?>' />시간 뒤부터 &nbsp; → <span onmouseover='vwtip(this,54)'>수정삭제 버튼 출력여부</span>: <select name='xu'><option value='0' <?=seltd('0',$sett[72])?>>모두 출력안함</option><option value='1' <?=seltd('1',$sett[72])?>>덧글에만 출력</option><option value='2' <?=seltd('2',$sett[72])?>>본문에만 출력</option><option value='3' <?=seltd('3',$sett[72])?>>모두 출력함</option></select>
<br /><span>중복차단 설정</span>: <select name='f'><option value='0' <?=seltd('0',$sett[6])?>>덧글,새글 중복차단</option><option value='1' <?=seltd('1',$sett[6])?>>덧글 중복차단</option><option value='2' <?=seltd('2',$sett[6])?>>새글 중복차단</option><option value='3' <?=seltd('3',$sett[6])?>>중복차단 사용안함</option></select>
<br /><span onmouseover='vwtip(this,33)'>IP 접속차단목록</span>:  <textarea name='ban' rows='1' cols='1' style='width:120px;height:40px;overflow:auto'><? if($fp=@fopen($dxr."ban","r")) {echo @fread($fp,filesize($dxr."ban"));fclose($fp);}?></textarea>차단할 IP를 한 줄에 하나씩. 숫자대신 와일드카드*를 사용할수 있습니다.
<br /><span onmouseover='vwtip(this,33)'>IP 쓰기차단목록</span>:  <textarea name='ban2' rows='1' cols='1' style='width:120px;height:40px;overflow:auto'><? if($fp=@fopen($dxr."ban2","r")) {echo @fread($fp,filesize($dxr."ban2"));fclose($fp);}?></textarea>차단할 IP를 한 줄에 하나씩. 숫자대신 와일드카드*를 사용할수 있습니다.
<br /><span onmouseover='vwtip(this,44)'>금지단어 설정</span>:  <textarea name='prohibit' rows='1' cols='1' style='width:120px;height:40px;overflow:auto'><? if($fp=@fopen($dxr."prohibit","r")) {echo @fread($fp,filesize($dxr."prohibit"));fclose($fp);}?></textarea>금지할 단어를 한 줄에 하나씩
<br /><span onmouseover='vwtip(this,57)'>대문캐시 갱신</span>: <select name='vb'><option value='0' <?=seltd('0',$sett[76])?>>사용안함</option><option value='1' <?=seltd('1',$sett[76])?>>새글 있으면</option><option value='2' <?=seltd('2',$sett[76])?>>새글 or 새덧글 있으면</option><option value='3' <?=seltd('3',$sett[76])?>>시간주기로만</option><option value='4' <?=seltd('4',$sett[76])?>>새글 or 시간주기</option><option value='5' <?=seltd('5',$sett[76])?>>새글 or 새덧글 or 시간주기</option></select>
&nbsp; <span onmouseover='vwtip(this,23)'>시간주기</span>:  <input type='text' name='va' style='width:50px' value='<?=$sett[75]?>' />분&nbsp; <input type='button' class='button' value=' 캐시 삭제(갱신) ' onclick='location.replace("?renewcache=all")' style='width:100px' /> &nbsp; <input type='button' class='button' value=' 대문 새로고침 ' onclick='dvframe()' style='width:100px' />
<br /><span onmouseover='vwtip(this,59)'>게시물 신고설정</span>: &nbsp; → 신고권한 : <select name='ve'><?=degree($sett[79],4)?></select>&nbsp; → 신고수 <input type='text' name='vf' style='width:30px' value='<?=$sett[80]?>' /> 이상이면 게시물 잠금&nbsp; → 신고수 계산 <select name='vg'><option value='1' <?=seltd('1',$sett[81])?>>모두 1</option><option value='4' <?=seltd('4',$sett[81])?>>(회원레벨/4)+1</option><option value='3' <?=seltd('3',$sett[81])?>>(회원레벨/3)+1</option><option value='2' <?=seltd('2',$sett[81])?>>(회원레벨/2)+1</option></select>
<br /><span onmouseover='vwtip(this,56)'>게시판 잠금설정</span>:  <input type='checkbox' onclick="this.nextSibling.value=(this.checked)?'1':'0';" <?=rtchecked($sett[73])?> class='no' /><input type='hidden' name='xv' value='<?=$sett[73]?>' />
<br /><span onmouseover='vwtip(this,60)'>접속자수 파악</span>:  <input type='checkbox' onclick="this.nextSibling.value=(this.checked)?'1':'0';" <?=rtchecked($sett[84])?> class='no' /><input type='hidden' name='vh' value='<?=$sett[84]?>' />

<br /><span onmouseover='vwtip(this,50)'>첨부파일 확장자</span>:  <input type='text' name='xm' style='width:500px' value='<?=$sett[64]?>' />확장자 간의 구분은 |로<br />
<span onmouseover='vwtip(this,34)'>게시판 데이타 다른곳으로 가져가기 사용 </span><input type='hidden' name='wl' value='<?=$sett[37]?>' /><input type='checkbox' onclick="this.previousSibling.value=(this.previousSibling.value == '1')? '0':'1'" <?=rtchecked($sett[37])?> class='no' /> &nbsp; <input type='button' value=' 게시판 가져오기 ' onclick="popup('?bkipt=1',400,375)" class='button' style='width:100px' onmouseover='vwtip(this,35)' /><br />
<input type='button' value='설문조사작성' class='button' style='width:150px' onclick="popup('include/poll.php?make=1',640,480)" />
&nbsp; <input type='button' value='스타일정의 추가' class='button' onmouseover='vwtip(this,38)' style='width:150px' onclick="popup('?fm=icon/style.css', 800, 400)" /><br />

<input type='submit' value=' 적용 ' class='button' style='width:490px;height:25px' /><input type='button' value=' uninstall ' class='button' style='width:100px;height:20px;margin-left:100px' onclick="if(confirm('srboard를 언인스톨하시겠습니까')) window.open('?bd_uninstall=<?=$mbr_id?>');" />
</form>
<div id='dvfi'></div>
<script type='text/javascript'>
function vwtip(ths,i) {
var ttitle = Array("즐겨찾기 파비콘 (16*16) 존재여부/사용여부",
"게시판에 외부파일 인클루드 위쪽 / 아래쪽 / css파일",
"본문에 보여질 그림의 최대넓이\n (자동리사이즈크기)",
"게시판의 전체넓이\n좌우메뉴 포함해서  (반드시 픽셀단위의 숫자만으로 / %단위 안됨)",
"목록/대문에 덧글표시넓이 default:24\n (반드시 픽셀단위의 숫자만으로 / %단위 안됨)",
"목록/대문에 덧글미리보기창 넓이 default:500\n (반드시 픽셀단위의 숫자만으로 / %단위 안됨)",
"게시판 위쪽에 출력할 내용추가",
"게시판 아래쪽에 출력할 내용추가",
"상/하단 내용추가 파일의 게시판 삽입방식",
"게시판 업로드 파일 외부링크 허용/ 비허용",
"게시판 업로드파일 크기제한,\n 값은 mb단위로 (정수,분수,소수)로 적으세요.\n 값이 0이면, 업로드크기제한을 안합니다.",
"메일 발송 회원레벨제한\n 또는 메일 발송 사용안함",
"메일 발송 방법 :\n 아웃룩링크 (자동발송사용불가) \n 팝업창 (서버가 지원해줘야함 / 자동발송기능 사용가)",
"회원가입할 때 동의해야 하는 이용약관",
"대문에서 사용할 게시판스킨 선택",
"대문 table의 cellspacing,디폴트 10,단위는 px입니다. 숫자만 적으세요",
"섹션게시판이 하나일때,대문출력 또는 게시판직행 선택",
"대문출력없이 게시판으로 직행합니다",
"게시판검색과 전체검색, 검색된 게시물 열리는 창",
"방문내역을 열람할수 있는 회원레벨",
"검색횟수순으로 태그모양 달리하는데, 그때 모양달리할 검색횟수단위",
"태그 클릭했을때, 태그 검색목록 출력방식",
"목록하나에 나열할 태그갯수",
"대문캐시 갱신주기 (갱신조건에 시간주기가 포함된 경우)",
"썸네일 작성할 때의 화질설정,\n 화질을 올리면 이미지 파일용량이 커집니다.\n (권장값 80 ~ 100)",
"회원의 자기사진을 이름앞에\n 작은 아이콘 마우스오버에서\n 큰 이미지로 띄울 것인지 또는,\n 팝업메뉴에 띄울 것인지 선택 ",
"블로그형의 본문형목록이 제목형으로 바뀔때 목록수에 곱할값",
"글쓰기 편집창 높이",
"글쓰기 임시저장파일 삭제시간",
"회원 출석부를 열람할수 있는 회원레벨",
"rss피드 본문 출력하는 길이",
"rss피드 본문에 html태그 삭제여부",
"게시판 상단에 게시판이름 / 경로 출력여부와 경로표시 제외사항 선택",
"아이피 차단 목록편집 (와일드카드 * 사용가)",
"보안위험이 있을수 있으니까, 가져가기 직전에 열어두세요",
"다른 곳의 srboard 게시판을 게시판 가져오기",
"글쓰기 원격작성 허용할 회원레벨",
"게시판 데이타파일 분산저장하는 개수의 단위",
"손쉽게 추가하는 스타일정의,\n 레이아웃이나 게시판의 스타일정의와 상충하는 경우에도\n 최우선적으로 적용됩니다.",
"덧글 본문에 URL주소 끝에 확장자가 이미지파일인 경우에,\n 덧글 저장할 때 자동처리방법 선택",
"썸네일 작성할 때 썸네일이미지의 가로x세로 크기설정",
"회원가입시, 이메일주소변경시, 메일인증 사용여부",
"게시판목록에서 본문미리보기 가로넓이 설정",
"회원로그의 게시물 본문스킨",
"제목, 본문, 덧글에 사용할 수 없는 금지어를 한 줄에 하나씩 지정합니다.",
"도배방지를 위한 본문,덧글 글쓰기의 시간간격 제한,\n 단위는 분(60초)\n 그리고 시간간격 제한을 적용받지 않는 회원레벨 설정",
"상단 내용추가를 출력할 위치 선정",
"하단 내용추가를 출력할 위치 선정",
"대문에서 탭형목록 회전 주기와\n 뉴스형목록 회전 주기 (단위는 초)",
"NEW 표시 여부 또는 시간 선택",
"게시판관리/업로드경로가 경로노출일 때,\n 첨부 허용할 확장자",
"덧글 페이징할 덧글 갯수의 단위 ",
"덧글 페이징 사용여부\n 페이징 갯수로 정확히 나눔 \n덧글의 덧글은 갯수와 무관하게 이어붙임 ",
"변경금지 설정한 경우,\n 본문/덧글 작성후에 이 시간이 지나면\n 변경금지가 발효됩니다.\n (설정여부는 게시판관리에서) ",
"변경금지가 발효될 때,\n 수정/삭제 버튼의 출력여부를 설정합니다. ",
"로그인 체크박스 출력여부 / 출력장소 설정",
"게시판 업데이트 등의 경우에,\n 오류방지를 위해 게시판 접속을 차단합니다.",
"대문캐시 사용여부와 갱신조건",
"좌우메뉴와 게시판사이의 간격설정 (단위 px)",
"스팸방지코드 사용여부와 조건설정",
"좌우메뉴 접속자수 출력할 게시판 전체의 접속자수 파악여부",
"게시물 글쓰기 길이 제한 설정. 단위는 KB. 0 으로 설정하면 사용 안 함",
"게시판 최소 넓이, 단위는 px, 0으로 설정하면 사용 안 함");
if(ttitle[i]) {
if(ths.innerHTML) ttitle[i] = ths.innerHTML +" ::\n " +ttitle[i];
else if(ths.value) ttitle[i] = ths.value +" ::\n " +ttitle[i];
$('admtip').innerHTML = ttitle[i];
}}
function dvframf(n) {
var dvfd = $('dvfi').getElementsByTagName('iframe')[n].contentWindow;
dvfd.document.getElementsByTagName('form')[0].submit();
}
function dvframe() {
var dvf = '';
<?
$dvfi = 1;
$dvff = 0;
if($dvst = @fopen($dxr."section.dat","r")) {
while($dvsto = fgets($dvst)) {
if($dvstn = explode("\x1b",$dvsto)) {
if($dvstn[1] != '3' && $dvstn[1] != '6' && $dvstn[1] != '7' && $dvstn[1] != 's') {
echo "dvf += \"<iframe src='?ectgt=".$dvfi."' style='height:5px'><\/iframe>\";\n";
$dvff++;
}
$dvfi++;
}}
fclose($dvst);
}
?>
$('dvfi').innerHTML = dvf;
for(var i = 0;i < <?=$dvff?>;i++) {setTimeout('dvframf(' + i + ')',1000+ (i*500));}
setTimeout("$('dvfi').innerHTML = '';",2500+ (i*500));
}
$$('a',0).value = '<?=$sett[1]?>';
$$('wx',0).value = '<?=$sett[48]?>';
document.title = "전체설정";
setTimeout("$$('vl',0).parentNode.style.visibility = ($$('vc',0).value == '0')? 'hidden':'visible'",1000);
</script>
</td></tr>
</table>
<?
}
?>
<div style='padding-top:10px;text-align:right'>현재버전 <b title='2011-03-10'>srboard 38.00 </b>&nbsp;&nbsp;(최신버전 <iframe src="http://sariputra.oranc.co.kr/latest.html" width="90px" height="15px" frameborder="0"></iframe>)</div>
</td></tr></table>
<?
}
?>