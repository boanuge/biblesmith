<div id='sitemap'><div class='title'><?=($grp && $grp[$sgp][0])? $grp[$sgp][0]:$sett[0]?></div><ul class='main'>
<?
$secdiv = '';
for($ii=1;$sect[$ii];$ii++) {
if($sect[$ii][1] != 4 && $sect[$ii][1] != 5 && $sect[$ii][1] != 'x' && (!$grp || $sgp == $sect[$ii][6])) {
if($section == $ii) $active = " class='actv'";else $active = '';
if($sect[$ii][1] == 3) $secdiv .= "<li><div class='dt'><a href='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></div><div class='fcler'></div></li>";
else if($sect[$ii][1] == 7) $secdiv .= "<li><div class='dt'><a href='#none' onclick='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></div><div class='fcler'></div></li>";
else if($sect[$ii][1] == 6) $secdiv .= "<li><div class='dt'><a target='_blank' href='{$sect[$ii][2]}'><span>{$sect[$ii][0]}</span></a></div><div class='fcler'></div></li>";
else if(!$sett[40] && $sect[$ii][1] == 1 && count($bfsb[$ii]) == 1) $secdiv .= "<li><div class='dt'><a href='{$index}?id={$sect[$ii][2]}'><span{$active}>{$sect[$ii][0]}</span></a></div><div class='fcler'></div></li>";
else {
$ccfsb = count($bfsb[$ii]) -1;
if($sect[$ii][1] == 's') $secdiv .= "<li><div class='dt'><a href='#none'><span>{$sect[$ii][0]}</span></a></div>";
else $secdiv .= "<li><div class='dt'><a href='{$index}?section={$ii}'><span{$active}>{$sect[$ii][0]}</span></a></div>";
if($ccfsb >= 0) {
$secdiv .= "<div class='dd'>";
for($i=0;$i <= $ccfsb;$i++) {
if(strpos($bfsb[$ii][$i],'>')) {
$bfsd = explode('>',$bfsb[$ii][$i]);
if($bfsd[2]=='nw') $bfsd[1] .= "' target='_blank";
else if($bfsd[2]=='js') $bfsd[1] = "#none' onclick='".$bfsd[1];
$secdiv .= " &bull; <a href='{$bfsd[1]}'>{$bfsd[0]}</a>";
} else if($bfsb[$ii][$i] != '>') $secdiv .= " &bull; <a href='{$index}?id=".encodee($bfsb[$ii][$i])."'>{$bdidnm[$bfsb[$ii][$i]]}</a>";
}
$secdiv .= "</div><div class='fcler'></div></li>";
} else $secdiv .= "<div class='fcler'></div></li>";
}
}
}
echo $secdiv;
?>
</ul>
<div class='fcler'></div></div>