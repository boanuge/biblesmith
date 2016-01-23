
<div class='menu20 hslice' id='m20_<?=$rctid?>'>
<div class='menu25'><div class='menu_title menuone entry-title' onclick="resize_n('resizhgt_<?=$rctid?>')"><?=$rctname?></div></div>
<div class='menu60'><div id='resizhgt_<?=$rctid?>' class='menu40 entry-content'>
<?
$ofn = fopen($dxr.$rctid."/no.dat","r");
$ofl = fopen($dxr.$rctid."/list.dat","r");
for($ii = 0;$ii < 15 && $ofno = (int)substr(fgets($ofn),0,6);$ii++){
$oflo = explode("\x1b",fgets($ofl));
$oflo[3] = str_replace("&","&amp;",str_replace('"','',$oflo[3]));
echo "\n<div class='link'><a href='".$index."?id=".$rctid.$ptslys."&amp;no=".$ofno."' onmouseover='preview(this.innerHTML,\"xx\")' onmouseout='preview()'>".$oflo[3]."</a></div><div class='small'>".date("m/d", substr($oflo[0],0,10))." - ".$oflo[1]."</div>";
}
fclose($ofn);
fclose($ofl);
?>

</div></div><div class='menu70'></div></div>