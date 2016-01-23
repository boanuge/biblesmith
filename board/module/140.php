<?
if(!$topsection) {
include("module/_top.php");
if(count($grp) > 1) include("module/_head.php");
?>
<div style="position:absolute;top:24px;left:0;width:100%">
<table cellspacing="0" cellpadding="0" style="width:<?=$srwtpx?>;margin:0 auto 0 auto">
<tr><td style="height:135px" valign="top"><img class="pngEX" src="module/140/logo.png" alt="logo" style="width:266px;height:50px" /></td>
        <td id="login140" style="width:356px" valign="top">
				<img class="pngEX" src="module/140/loginbg.png" alt="logo" style="position:relative;width:356px;height:73px" />
        <form method="post" action="<?=$admin?>" style="margin:0;position:relative;margin-top:-65px" onsubmit="convertbase(this);return false"><input type="hidden" name="username_3" value="" /><input type="hidden" name="password_3" value="" /><input type="hidden" name="from" value="<?=$_SERVER["REQUEST_URI"]?>" />
<?
if($mbr_no && $mbr_level){
?>
<p>
<?
if(!$chkmemo) {
$chkmemo = 1;
?><div id="check_memo"></div><?
}
if(file_exists("icon/m20_".$mbr_no)) {echo "<img src=\"icon/m20_".$mbr_no."\" class=\"icos\"";if(!strpos($_SERVER["PHP_SELF"],$exe)) echo " onmouseover=\"imgview(this.src,1)\" onmouseout=\"imgview(0,1)\"";echo " alt=\"\" />";}
?>
<b><?=$_SESSION["m_nick"]?></b> <span style="font-size:8pt">(레벨 <?=$mbr_level?> : <span title=" 쓴글: <?=$jno[0]?>, 덧글: <?=$jno[1]?>, 출석: <?=$jno[2]?> ">포인트 <?=$jno[10]*$sett[17]+$jno[2]*$sett[18]+$jno[3]+$jno[6]+$jno[7]+$jno[8]+$jno[9]?></span>)</span>
<div>&nbsp;ㆍ&nbsp;<a href="<?=$index?>?mbr_info=1">회원정보</a>
&nbsp;ㆍ&nbsp;<a href="#none" onclick="read('get')">쪽지함</a>
&nbsp;ㆍ&nbsp;<a href="#none" onclick="read('member.php')">회원로그</a>
&nbsp; &nbsp;<input type="submit" name="logout" class="submit" value="logout" tabindex="3" /></div>
<?} else {?>
        <div id="loginwelcome"><div style="float:left">Welcome Guest</div><div style="float:right;padding-right:30px">
				<span style="vertical-align:bottom">auto</span><input type="checkbox" name="autologin" value="0" onclick="if(this.checked){this.value=1;alert("체크하면, 자동으로 로그인됩니다.\r\n공공장소에서는 체크하지 마세요.");}else this.value=0;" style="border:0;width:16px;height:16px;vertical-align:bottom" />
				<? if($sett[15]){?> &nbsp; <a href="#none" onclick="popup('<?=$admin?>?askaddr=1',400,200)" style="text-decoration:underline;color:#778785" class="f7">ID/PW Find</a><?}?>
				</div><div style="clear:both"></div></div>
                <p>
                <input title="username" name="username" class="username" value="Username" onclick="if(value == 'Username') value = '';"/>
                <input name="password" type="password" class="password" title="password" value="Password" onclick="if(value == 'Password') value = '';"/>
                <input type="button" onclick="convertbase(this.form)" class="submit" value="login" tabindex="3" />
<?}?>
                </p>
            </form>
        </td></tr>
<tr><td colspan="2" valign="top">
<div style="width:<?=$srwtpx?><? if($isie == 1 && $ie8 != 1) echo ";padding-top:13px\"";?> class="nav">
<script type="text/javascript">/*<![CDATA[*/</script><ul id="section"><?=secdiv(0,1,40)?></ul><script type="text/javascript">/*]]>*/</script>
<div><img src="icon/t.gif" alt="" /></div>
</div></table></div>
<div style="height:168px"> </div>
<?
include("module/_lftrgt.php");
} else {
include("module/_lftrgt.php");
?>

<div id="footer" style="width:<?=$srwtpx?>;margin:0 auto 0 auto">
        <div id="copyright">&copy; 2009 <strong><? $s=substr($sett[14],7);echo substr($s,0,strpos($s,"/"));?></strong>. Designed by <a href="http://www.crownstyles.com">Crown</a>
    </div></div>
<?
}
?>