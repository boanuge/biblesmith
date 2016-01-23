<div class="mbebg">
<?
if(!$topsection) {
echo "<a href='{$index}?section=1'>{$sett[0]}</a>";
if(count($grp) > 1) echo "&nbsp; &gt; &nbsp;<a href='{$index}?group={$sgp}'>{$grp[$sgp][0]}</a>";
if(!$_GET['group']) echo "&nbsp; &gt; &nbsp;<a href='{$index}?section={$section}'>{$sect[$section][0]}</a>";
$topsection = 1;
} else {
if($id) {
?>
<input type="button" class="mbebutt" onclick="location.href='<?=$index?>?id=<?=$id?>&amp;p=<?=($_GET['p'])? $_GET['p']:1;?>'" value="목록" />
<?}?>
<input type="button" class="mbebutt" onclick="history.go(-1)" value="이전" />
<input type="button" class="mbebutt" onclick="document.cookie='ckmobile=3';location.reload()" value="PC버전" />
<input type="button" class="mbebutt" onclick="location.href='<?=$index?>?member_login=<?=urlencode($_SERVER['REQUEST_URI'])?>'" value="<?=($mbr_level)? "로그아웃":"로그인";?>" />
<?
}
?>
</div>