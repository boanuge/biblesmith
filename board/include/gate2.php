<?
if($ismobile == 2) {
?><ul class="mbeul"><?
foreach($bob as $boc) {
if($boc[0]) echo "<li><a href='{$index}?id=".encodee($boc[0])."'>{$bdidnm[$boc[0]]}</a></li>";
}
?>
</ul>
<?
} else {
$ysrkiin = '';
if($bakfname) {
$gtbk1 = $dxr."_member_/_bak_/gatebk1_".$bakfname.".dat";
$gtbk2 = $dxr."_member_/_bak_/gatebk2_".$bakfname.".dat";
$gbok = 0;$gtbt = 0;
$sett[76] = (int)$sett[76];
if($sett[76] > 0 && file_exists($gtbk1) && filesize($gtbk1) > 0) {
$gtbt = filemtime($gtbk1);
if($sett[76] >= 3 && $time - $gtbt > $sett[75]*60) $gbok = 1;
else if($sett[76] != 3 && $gtbt > 0 && $bob) {
foreach($bob as $boc) {
if($boc[0]) {
if(filemtime($dxr.$boc[0]."/body.dat") > $gtbt) {$gbok = 1;break;}
else if(($sett[76] == 2 || $sett[76] == 5) && filemtime($dxr.$boc[0]."/new_rp.dat") > $gtbt) {$gbok = 1;break;}
}}}}}
if($bakfname && $gtbt > 0 && $gbok == 0) {
$ftbk1 = fopen($gtbk1,"r");
while($data = fgets($ftbk1)) $ysrkiin .= $data;
fclose($ftbk1);
$ftbk2 = fopen($gtbk2,"r");
while($data = fgets($ftbk2)) $memb .= $data;
fclose($ftbk2);
} else {
$yi = 0;
$yinclwt = '';
$yinxv = '';
$f = (int)$f;
$iii = (int)$iii;
foreach($bob as $boc) {
list($ymid,$rlmt,$ymss23,$ywtdh,$ysectgt) = $boc;
$ymss = $fsbs[$ymid];
if($sectadmin == 3 && (int)substr($ymss,47,2) == $section) {$ymss[13] = 9;$ymss[14] = 9;$ymss[15] = 9;$ymss[18] = 0;}
if($ymss23 != '4' || $ysectgt23) {
if($ysrkjn) {$ysrkiin .= "<div class='fcler'></div></div><div class='tab_div' onmouseover='stopt={$tpn}' onmouseout='stopt=-1'>".$ysrkjn."</div>".$ysectgt23;$ysrkjn = '';$ysectgt23 = '';}
$yi = 0;
$tlmt = 0;
}
if($ymid && $ymss && $ymss[12] !== 'a' && $ymss[12] <= $mbr_level && $rlmt > 0) {
if($bwr) $eid = urlencode($ymid);
else $eid = $ymid;
$rft = (int)substr($ymss, 6, 6);
$yisnt = (int)substr($ymss, 26, 2);
$ymwth = explode("\x1b",$ymss);
$no = "";
$ysrken = str_replace("<#sum#>",$rft,$srkn);
if(!$ymss[19]) $ysrken = str_replace("<#rsslink#>","<;>",$ysrken);
$ysrken = str_replace("<#bd_id#>",$eid,$ysrken);
$ysrken = str_replace("<#bd_name#>",$ymwth[1],$ysrken);
if($ymss23 == '4' && $yi == 0) {$ywtdh7 = $ywtdh -10;$ywdtt4[$ymid] = array();}
if($ymss23 != '4') {
$ysrkiin .= tagcut('noid_head',$ysrken);
if($ymss23 == '5') {$nwx++;$ysrk5n = "<table cellspacing='0' cellpadding='0' width='100%' class='newx_1' onmouseover='stopn={$nwx}' onmouseout='stopn=0'><tr><td rowspan='2'><div id='newx2_{$nwx}' class='newx_2'><#newx_2#></div></td><td width='100%'><div id='newx3_{$nwx}' class='newx_3'><div class='newx_4'><#newx_4#></div><#newx_3#><div class='newx_5'><#newx_5#></div></div></td></tr><tr><td><div id='newx6_{$nwx}' class='newx_6'><#newx_6#></div></td></tr></table>";}
} else {
$yi++;
$rlmt=($tlmt)? $tlmt:$rlmt;
if($yi == 1) {
$tpn++;
$tlmt = $rlmt;
$ysrkiin .= "<div id='tpn_{$tpn}' class='tab_top' onmouseover='stopt={$tpn}' onmouseout='stopt=-1'>";
$on = 'o';
$first = " class='first'";
} else {$on = 'x';$first = '';}
$ysrkiin .= "<div class='tab_head thead{$on}' id='tabhead_{$iii}' onclick='rhref(this.firstChild.firstChild.href)' onmouseover='tabview(this)'><div{$first}><a href='?id={$eid}'>{$ymwth[1]}</a></div></div>";
$ysrkjn .= "<table class='tab_list tlist{$on}' id='tablist_{$iii}' cellpadding='0' cellspacing='0'><tr><td><div style='float:left'>";
}
if($ymss23 == '4' && $ysectgt) $ysectgt23 = $ysectgt;
$len = 256;
if($ymss23 == '5') $ysrken= tagcut('noid_body_5',$ysrken);
else if($ymss23 == '3') $ysrken= tagcut('noid_body_3',$ysrken);
else if($ymss23 == '2') {$ysrken= tagcut('noid_body_2',$ysrken);$len = 192;}
else $ysrken= tagcut('noid_body_1',$ysrken);
$ysrken = str_replace("<#bdid#>",$eid,$ysrken);
$nL4 = ($ymss23 == '4' || $ymss23 == '1')? 'nL4':'oL4';
$fl = fopen($dxr.$ymid."/list.dat","r");
$fn = fopen($dxr.$ymid."/no.dat","r");
$fb = fopen($dxr.$ymid."/body.dat","r");
$yii = 0;
if($ymss[22] == 1 || $ymss[22] == 2) $ymss[22] = 4;
if($ymss[18] == 1 || $ymss[18] == 2) $ymss[18] = 4;
if($ymss[60] == 1 || $ymss[60] == 2) $ymss[60] = 4;
if($ymss[61] == 1 || $ymss[61] == 2) $ymss[61] = 4;
if($ymss[62] == 1 || $ymss[62] == 2) $ymss[62] = 4;
if($ymss[63] == 1 || $ymss[63] == 2) $ymss[63] = 4;
if($ymss[13] == 'a' || $ymss[13] > $mbr_level) $mbread = 3;
else $mbread = 0;
while($yii < $rlmt && $yii < $rft){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = explode("\x1b", fgets($fl));
$flo[5] = str_replace("&","&amp;",$flo[5]);
$mmb = strcut(fgets($fb), $len);
if(substr($zzz,6,2) == 'aa') continue;
$zzz = explode("\x1b", $zzz);
$no = (int)substr($zzz[0], 0, 6);
$mn = substr($zzz[0], 9);
$yislock = 0;
if((int)$zzz[0][8]) {
if($zzz[0][8] == 9) $yislock = 1;
if($zzz[0][8] > $mbr_level && $_COOKIE["scrt_".$no.$yid] != md5($no."_".$sessid.$yid)) $secret = ($yislock)? 2:1;
} else $secret = $mbread;
$ntime = date("H")*3600 + date("i")*60 + date("s");
$datt = substr($flo[0], 0, 10);
if($datt > 0) $datte = ($datt > $time - $ntime)? date("H:i",$datt):date("m-d",$datt);else $datte = '';
$ywdtt = 0;
$ysrkeen = str_replace("<#datte#>",$datte,$ysrken);
if($zzz[2] > 0 || $zzz[3] > 0 ||$zzz[4] > 0) {
$nrp = (int)($zzz[2] + $zzz[4] + $zzz[3]);
$ysrkeen = str_replace("<#nrp#>",$nrp,$ysrkeen);
$ywdtt += $sett[28] + strlen($zzz[2])*6;
$zzz[2] = " <span class='r8'>[".$zzz[2]."]</span>";
} else {$ysrkeen = str_replace("<#isnrp#>","<;>",$ysrkeen);$zzz[2] = '';$nrp = 0;}
if($secret == 2 || ($secret && $ymss[63] != 4)) {
if($ymss[16] == 'd') $flo[3] = '[비밀글]';
$mmb = '';
} else if($ymss[16] == 'd') $flo[3] = strcut($mmb, 128);
$cmtlv = '';
if(!$secret && $nrp) {
if($ymss[61] == 4) {
$cmtlv .= " target='_blank' href='?id={$eid}&amp;comment={$no}'";
if($ymss[60] == 4) $cmtlv .= " onmouseover='imgview(this.href,5,0)'";
} else if($ymss[60] == 4) {$ysrkeen = str_replace("<#ispvrp#>","<a href='#none' onmouseover='imgview(\"?id={$eid}&amp;comment={$no}\",5,0)'>",$ysrkeen);$cmtlv = 3;}
if($cmtlv && $cmtlv != 3) $ysrkeen = str_replace("<#ispvrp#>","<a{$cmtlv}>",$ysrkeen);
}
if(!$cmtlv) $ysrkeen = str_replace("<#ispvrp#>","<a href='#none'>",$ysrkeen);
$jsurl = 0;
if($secret == 2 || $ymss[63] != 4) $mmb = "";
if($secret == 2 || $ymss[62] != 4) {
if($type == 'g') {$ysrkeen = str_replace("<#simg#>","icon/noimg.gif",$ysrkeen);$rsimg = 0;}
else if($type == 'c') {$ysrkeen = str_replace("<#issimg#>","<;>",$ysrkeen);$rissimg = 0;}
$flo[4] = '';
}
if($secret && $secret != 2 && $flo[5]) {
	$jsurl = 1;
	$ysrkeen = str_replace("<#jsurl#>","onclick=\"nwopn('{$flo[5]}')\"",$ysrkeen);
  $ysrkeen = str_replace("<#url#>","<a target='_blank' href='{$flo[5]}' class='lnk'>",$ysrkeen);
	if($ymss[22] == 4) $ysrkeen = str_replace("<#isnlink#>","<;>",$ysrkeen);
}
if($flo[5] == '' || $secret == 2 || $ymss[22] != 4) $ysrkeen = str_replace("<#isnlink#>","<;>",$ysrkeen);
else if($flo[5]) {$list_body = str_replace("<#rlink#>",$flo[5],$list_body);$ywdtt += 25;}
if($yislock) $flo[3] = "<img src='icon/lock.gif' alt='' class='lock' /> ".$flo[3];

if($ymwth[7][4] && $datt >= $sett[62]) {$ysrkeen = str_replace("<#isnew#>","<img src='icon/nw.gif' class='{$nL4}' alt='' />",$ysrkeen);$ywdtt += 16;}
if($flo[4] && substr($flo[4], 0, 5) != "http:") $flo[4] = $exe."?id=".urlencode($ymid)."&amp;file=".$flo[4];
$url = "?id={$eid}&amp;no={$no}";
if($flo[3] == '') $flo[3] = ' …… ';
else $flo[3] = str_replace("&","&amp;",$flo[3]);
if(!$flo[4] && $ymss23 == '3') $ysrkeen = str_replace("<#simg#>","<img src='icon/noimg.gif' class='gthumb_100' alt='' />",$ysrkeen);
else if($flo[4] && $ymss23 != '5') $ysrkeen = str_replace("<#simg#>","<img src='".$flo[4]."' class='gthumb_100' alt='' />",$ysrkeen);
$ysrkeen = str_replace("<#nick#>",$flo[1],$ysrkeen);
$ysrkeen = str_replace("<#rpcnt#>",$zzz[2],$ysrkeen);
$ysrkeen = str_replace("<#bdno#>",$no,$ysrkeen);
if($ymss[16]== 'b' || $ymss[16]== 'd') {
$pg = (int)($yii  / $yisnt) + 1;
$url = "?id={$eid}&amp;p={$pg}#{$no}";
}
if($ymss23 == '5') {
$memb .= "\nnewtxt[{$nxs}] = Array(\"".str_replace('"','\\"',$flo[4])."\",\"".str_replace('"','\\"',$flo[3])."\",\"".str_replace('"','\\"',$flo[1])."\",\"".$nrp."\",\"".str_replace('"','\\"',$mmb)."\",\"{$url}\",\"{$datte}\",\"{$nwx}\");";
$ysrkeen = str_replace("<#newx#>","newx({$nxs})",$ysrkeen);
$urlp = " onmouseover=\"newx({$nxs})\"";
$ysrkeen = str_replace("<#gate_5#>","<input type='hidden' value='{$nxs}' />",$ysrkeen);
if($yii == 0) {
if($flo[4]) $ysrk5n = str_replace("<#newx_2#>","<a href='{$url}'><img src='".$flo[4]."' class='gthumb_100' alt='' /></a>",$ysrk5n);
$ysrk5n = str_replace("<#newx_4#>","<input type='hidden' id='newxi_{$nwx}' value='{$nxs}' /><a href='{$url}'>".$flo[3]."</a>",$ysrk5n);
$ysrk5n = str_replace("<#newx_3#>",$mmb,$ysrk5n);
$ysrk5n = str_replace("<#newx_5#>","by ".$flo[1]." | comments ".$nrp." | ".$datte,$ysrk5n);
$class = ' gthumb_100h';
} else $class = '';
if(!$flo[4])  $flo[4] = 'icon/noimg.gif';
$ysrkeen = str_replace("<#simg#>","<img src='{$flo[4]}' name='newxe' class='gthumb_100{$class}' alt='' />",$ysrkeen);
$nxs++;
} else if($ymss23 != '2') {
if($flo[4]) {
if($ymss23 == '3') $flo[4] = '';
else $flo[4] = "<img src='".$flo[4]."' class='gthumb_100' alt='' />";
}
if($secret != 2 && $ymss[18] == 4) {
$memb .= "\npretxt[{$iii}] = \"".str_replace('"','\\"',$flo[4])."<div class='prsjt'>".str_replace('"','\\"',$flo[3])."<\/div><span class='n8'> by ".str_replace('"','\\"',$flo[1])."<\/span> <span class='r7'>[".$nrp."]<\/span><br \/>".str_replace('"','\\"',$mmb)."\";";
$urlp = " name='pv{$iii}'";
}
if(!$ygthumb && $flo[4] && $ymss23 == '4') {if(!$sett[77]) $ywtdh8 = "width:".($ywtdh7 -129)."px";else $ywtdh8 = "";$ygthumb = 131;$ysrkjn .= "<a href='{$url}'{$urlp}>{$flo[4]}</a></div><div style='float:left;{$ywtdh8}'>";}
} else if($ymss23 == '2') $ysrkeen = str_replace("<#memb#>",$mmb,$ysrkeen);
if(!$jsurl) {
$ysrkeen = str_replace("<#jsurl#>","onclick=\"rhref('{$url}');\"{$urlp}",$ysrkeen);
$ysrkeen = str_replace("<#url#>","<a href='{$url}'{$urlp} class='lnk{$class}'>",$ysrkeen);
}
$ysrkeen = str_replace("<#subject#>",$flo[3],$ysrkeen);
$ywdtt = $ywtdh - $ywdtt -10;
if($ymss23 != '2' && $ymss23 != '3' && $ymss23 != '5') {
if($ymss23 == '4') {$ywdtt4[$ymid][] = $ywdtt;}
else if(!$sett[77]) {
if($bwr == 'ie6') $ysrkeen = str_replace("<#wtdh#>","width:expression((this.scrollWidth < {$ywdtt})? '':'{$ywdtt}px')",$ysrkeen);
else $ysrkeen = str_replace("<#wtdh#>","max-width:{$ywdtt}px",$ysrkeen);
}}
if($ymss23 == '5') $ysrk5n = str_replace("<#newx_6#>",$ysrkeen."<#newx_6#>",$ysrk5n);
else if($ymss23 != '4') $ysrkiin .= $ysrkeen;
else $ysrkkn .= $ysrkeen;
$url = '';
$urlp = '';
} else if($usmw != $ymid && $ymwth[6]) {
$usmw = $ymid;
fclose($fl);
fclose($fn);
fclose($fb);
$fn = fopen($dxr.$ymid."/^".$ymwth[6]."/no.dat","r");
$fl = fopen($dxr.$ymid."/^".$ymwth[6]."/list.dat","r");
$fb = fopen($dxr.$ymid."/^".$ymwth[6]."/body.dat","r");
$yii--;
}
$yii++;
$iii++;
}
fclose($fl);
fclose($fn);
fclose($fb);
if($ymss23 == '5') $ysrkiin .= $ysrk5n;
if($ysrkkn || $ymss23 == '4') {
$ysrknn = explode("<#wtdh#>",$ysrkkn);
$ysrkkn = '';
for($r = 0;$ysrknn[$r];$r++) {
$ysrkkn .= $ysrknn[$r];
if(!$sett[77] && $ywdtt4[$ymid][$r] && $ysrknn[$r +1]) {
$ywdtt = $ywdtt4[$ymid][$r] - $ygthumb;
if($bwr == 'ie6') $ysrkkn .= "width:expression((this.scrollWidth < {$ywdtt})? '':'{$ywdtt}px')";
else $ysrkkn .= "max-width:{$ywdtt}px";
}
}
$ywdtt4[$ymid] = '';
$ygthumb = 0;
$ysrkjn .= $ysrkkn."</div></td></tr></table>";$ysrkkn = '';
}
else $ysrkiin .= "</td></tr></table>";
}
if($ymss23 != '4') $ysrkiin .= $ysectgt;
}
if($ysrkjn || $ymss23 == '4') {$ysrkiin .= "<div class='fcler'></div></div><div class='tab_div' onmouseover='stopt={$tpn}' onmouseout='stopt=-1'>".$ysrkjn."</div>";$ysrkjn = '';}
if($ymss23 == '4' && $ysectgt23) {$ysrkiin .= $ysectgt23;$ysectgt23 = '';}
if($sett[76] > 0 && $bakfname) {
$ftbk1 = fopen($gtbk1,"w");
if(strpos($srkiin,'<;>') !== false) $srkiin = preg_replace("`<;>(.+)<!--/-->`sU","",$srkiin);
$srkiin = str_replace("<!--/-->","",preg_replace("`<#[^#]+#>`","",$srkiin));
fputs($ftbk1,"<###$"."nxs=".$nxs.";$"."nwx=".$nwx.";$"."tpn=".$tpn.";$"."iii=".$iii.";###>".$ysrkiin);
fclose($ftbk1);
$ftbk2 = fopen($gtbk2,"w");
fputs($ftbk2,$memb);
fclose($ftbk2);
}}
if($yinclwt=inclvde($ysrkiin)) foreach($yinclwt as $yinxv) {if($yinxv[0] == 1) eval($yinxv[1]);else if($yinxv[0] == 2) include($yinxv[1]);else echo $yinxv[1];}
$bob = '';
$yi = 0;
$ysrkiin = '';
$yinclwt = '';
$yinxv = '';
$bakfname = '';
}
?>
