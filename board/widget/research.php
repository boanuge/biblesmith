<?
if($set) {
//$pollno = "00001";// 위에 정의된게 없으면 여기서 주석풀고, 정의되도록 합니다. 값은 5자리입니다.
if($pollno) {
$plla = $dxr."poll_1.dat"; //질문
if($fa = @fopen($plla,"r")) {
while($fao = fgets($fa)) {
if(substr($fao,0,5) == $pollno) {$faa = explode("\x1b",$fao);break;}
}
fclose($fa);
?>
<table cellspacing='0' cellpadding='0' class='head_all poll_tbl'>
<tr class='title_tr'><td class='title_td'><div style='padding-left:8px;cursor:pointer'><b>설문조사</b></div></td></tr>
<tr><td class='gtlst'>
<center><ul>
<li class='frst'><?=substr($faa[0],5)?></li>
<?
for($pl = 1;$faa[$pl + 1];$pl++){
?>
<li><input type='radio' name='sublist_<?=$pollno?>' value='<?=$pl?>' /> <?=$faa[$pl]?></li>
<?
}
?>
</ul>
<input type='button' class='srbt' value='투표하기' style='margin-right:10px' onclick='survey_<?=$pollno?>(1)' />
<input type='button' class='srbt' value='결과보기' onclick='popup("include/poll.php?no=<?=$pollno?>",640,480)' />
</center></td></tr></table>
<script type='text/javascript'> 
//<![CDATA[
function survey_<?=$pollno?>(pono) {
if(pono) {
var mvl = '';
for(var i=document.getElementsByName('sublist_<?=$pollno?>').length -1;i >= 0;i--) {
if(document.getElementsByName('sublist_<?=$pollno?>')[i].checked == true) {
mvl = document.getElementsByName('sublist_<?=$pollno?>')[i].value;
}}
if(mvl != '') {
azax("include/poll.php?&poll=<?=$pollno?>&vote=" + mvl,9);
} else alert('답변을 선택하세요');
}}
//]]>
</script>
<?
}}}
?>
