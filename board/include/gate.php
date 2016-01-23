<?
$gtbk1 = $dxr."_member_/_bak_/gatebk1_".$section.".dat";
$gtbk2 = $dxr."_member_/_bak_/gatebk2_".$section.".dat";
$gbok = 0;$gtbt = 0;
$sett[76] = (int)$sett[76];
if($sett[76] > 0 && file_exists($gtbk1) && filesize($gtbk1) > 0) {
$gtbt = filemtime($gtbk1);
if($sett[76] >= 3 && $time - $gtbt > $sett[75]*60) $gbok = 1;
else if($sett[76] != 3 && $gtbt > 0 && $bfsb[$section]) {
foreach($bfsb[$section] as $mid) {
if(strpos($mid,'>') === false) {
if(filemtime($dxr.$mid."/body.dat") > $gtbt) {$gbok = 1;break;}
else if(($sett[76] == 2 || $sett[76] == 5) && filemtime($dxr.$mid."/new_rp.dat") > $gtbt) {$gbok = 1;break;}
}}}}
if($gtbt > 0 && $gbok == 0) {
$ftbk1 = fopen($gtbk1,"r");
while($data = fgets($ftbk1)) $srkiin .= $data;
fclose($ftbk1);
$ftbk2 = fopen($gtbk2,"r");
while($data = fgets($ftbk2)) $memb .= $data;
fclose($ftbk2);
} else {
$srkin = tagcut('noid',$srkn);
$srkiin = tagcut('noid_once',$srkin);
$colg = strpos($sectgt,'</colgroup>');
if(strpos(($colh = substr($sectgt,0,$colg)),"px'")) {
preg_match_all("`width='([0-9\.]+)px`i",$colh,$coli);
for($i = count($coli[0]) -1;$i >= 0;$i--) {
$colj = sprintf("%.2f",$coli[1][$i]*100/$srwdth);
$colh = str_replace("width='".$coli[1][$i]."px","width='".$colj."%",$colh);
}
$sectgt = $colh.'</colgroup>'.strchr($sectgt,'<tr');
}
$sectgt = explode('<#board#>',$sectgt);
$sectgtc = count($sectgt) - 1;
$f = 0;
$i = 0;
if($bfsb[$section]) {
$iii = 0;
foreach($bfsb[$section] as $mid) {
if(!strpos($mid,'>')) {
$mss = $fsbs[$mid];
if($sectadmin == 3 && (int)substr($mss,47,2) == $section) {$mss[13] = 9;$mss[14] = 9;$mss[15] = 9;$mss[18] = 0;}
$rlmt = (int)substr($mss, 24, 2);
if($mid == '>') {
$i = 0;
if($srkjn) {$srkiin .= "<div class='fcler'></div></div><div class='tab_div' onmouseover='stopt={$tpn}' onmouseout='stopt=-1'>".$srkjn."</div>";$srkjn = '';}
}
if($mid && strpos($mid,'>') === false && $mss && $mss[12] !== 'a' && $mss[12] <= $mbr_level && $rlmt > 0 && ($sectgtc > 0 || ($sectgtc == 0 && $mss[23] == '4' && $i > 0))) {
if($bwr) $eid = urlencode($mid);
else $eid = $mid;
$rft = (int)substr($mss, 6, 6);
$isnt = (int)substr($mss, 26, 2);
$mwth = explode("\x1b",$mss);
$no = "";
$srken = str_replace("<#sum#>",$rft,$srkin);
if(!$mss[19]) $srken = str_replace("<#rsslink#>","<;>",$srken);
$srken = str_replace("<#bd_id#>",$eid,$srken);
$srken = str_replace("<#bd_name#>",$mwth[1],$srken);
if($mss[23] != '4' || $i == 0) {
$tcell = strrchr($sectgt[$f],'<td');
if(($wpx = substr($tcell,"px'")) < 15) $wtdh = substr($tcell,11,$wpx-11);
else $wtdh = (preg_match("` width=['\"]?([0-9\.]+)px`i",$tcell,$wtdh))? $wtdh[1]:1;
if($mss[23] == '4') {$wtdh7 = $wtdh -10;$wdtt4[$mid] = array();}
}
if($mss[23] != '4') {
if($srkjn) {$srkiin .= "<div class='fcler'></div></div><div class='tab_div' onmouseover='stopt={$tpn}' onmouseout='stopt=-1'>".$srkjn."</div>".$sectgt[$f];$srkjn = '';}
else $srkiin .= $sectgt[$f];
$sectgt[$f] = '';
$srkiin .= tagcut('noid_head',$srken);
if($mss[23] == '5') {$nwx++;$srk5n = "<table cellspacing='0' cellpadding='0' width='100%' class='newx_1' onmouseover='stopn={$nwx}' onmouseout='stopn=0'><tr><td rowspan='2'><div id='newx2_{$nwx}' class='newx_2'><#newx_2#></div></td><td width='100%'><div id='newx3_{$nwx}' class='newx_3'><div class='newx_4'><#newx_4#></div><#newx_3#><div class='newx_5'><#newx_5#></div></div></td></tr><tr><td><div id='newx6_{$nwx}' class='newx_6'><#newx_6#></div></td></tr></table>";}
$i = 0;
$tlmt = 0;$sectgtc--;
} else {
$i++;
$rlmt=($tlmt)? $tlmt:$rlmt;
if($i == 1) {
$tpn++;
$tlmt = $rlmt;
$srkiin .= $sectgt[$f]."<div id='tpn_{$tpn}' class='tab_top' onmouseover='stopt={$tpn}' onmouseout='stopt=-1'>";
$sectgt[$f] = '';
$on = 'o';
$first = " class='first'";
$f++;$sectgtc--;
} else {$on = 'x';$first = '';}
$srkiin .= "<div class='tab_head thead{$on}' id='tabhead_{$iii}' onclick='rhref(this.firstChild.firstChild.href)' onmouseover='tabview(this)'><div{$first}><a href='?id={$eid}'>{$mwth[1]}</a></div></div>";
$srkjn .= "<table class='tab_list tlist{$on}' id='tablist_{$iii}' cellpadding='0' cellspacing='0'><tr><td><div style='float:left'>";
}
$len = 256;
if($mss[23] == '5') $srken= tagcut('noid_body_5',$srken);
else if($mss[23] == '3') $srken= tagcut('noid_body_3',$srken);
else if($mss[23] == '2') {$srken= tagcut('noid_body_2',$srken);$len = 192;}
else $srken= tagcut('noid_body_1',$srken);
$srken = str_replace("<#bdid#>",$eid,$srken);
$nL4 = ($mss[23] == '4' || $mss[23] == '1')? 'nL4':'oL4';
$fl = fopen($dxr.$mid."/list.dat","r");
$fn = fopen($dxr.$mid."/no.dat","r");
$fb = fopen($dxr.$mid."/body.dat","r");
$ii = 0;
if($mss[22] == 1 || $mss[22] == 2) $mss[22] = 4;
if($mss[18] == 1 || $mss[18] == 2) $mss[18] = 4;
if($mss[60] == 1 || $mss[60] == 2) $mss[60] = 4;
if($mss[61] == 1 || $mss[61] == 2) $mss[61] = 4;
if($mss[62] == 1 || $mss[62] == 2) $mss[62] = 4;
if($mss[63] == 1 || $mss[63] == 2) $mss[63] = 4;
if($mss[13] == 'a' || $mss[13] > $mbr_level) $mbread = 3;
else $mbread = 0;
while($ii < $rlmt && $ii < $rft){
$zzz = fgets($fn);
if(trim($zzz)){
$flo = explode("\x1b", fgets($fl));
$flo[5] = str_replace("&","&amp;",$flo[5]);
$mmb = strcut(fgets($fb), $len);
if(substr($zzz,6,2) == 'aa') continue;
$zzz = explode("\x1b", $zzz);
$no = (int)substr($zzz[0], 0, 6);
$mn = substr($zzz[0], 9);
$islock = 0;
if((int)$zzz[0][8]) {
if($zzz[0][8] == 9) $islock = 1;
if($zzz[0][8] > $mbr_level && $_COOKIE["scrt_".$no.$id] != md5($no."_".$sessid.$id)) $secret = ($islock)? 2:1;
} else $secret = $mbread;
$ntime = date("H")*3600 + date("i")*60 + date("s");
$datt = substr($flo[0], 0, 10);
if($datt > 0) $datte = ($datt > $time - $ntime)? date("H:i",$datt):date("m-d",$datt);else $datte = '';
$wdtt = 0;
$srkeen = str_replace("<#datte#>",$datte,$srken);
if($zzz[2] > 0 || $zzz[3] > 0 ||$zzz[4] > 0) {
$nrp = (int)($zzz[2] + $zzz[4] + $zzz[3]);
$srkeen = str_replace("<#nrp#>",$nrp,$srkeen);
$wdtt += $sett[28] + strlen($zzz[2])*6;
$zzz[2] = " <span class='r8'>[".$zzz[2]."]</span>";
} else {$srkeen = str_replace("<#isnrp#>","<;>",$srkeen);$zzz[2] = '';$nrp = 0;}
if($secret == 2 || ($secret && $mss[63] != 4)) {
if($mss[16] == 'd') $flo[3] = '[비밀글]';
$mmb = '';
} else if($mss[16] == 'd') $flo[3] = strcut($mmb, 128);
$cmtlv = '';
if(!$secret && $nrp) {
if($mss[61] == 4) {
$cmtlv .= " target='_blank' href='?id={$eid}&amp;comment={$no}'";
if($mss[60] == 4) $cmtlv .= " onmouseover='imgview(this.href,5,0)'";
} else if($mss[60] == 4) {$srkeen = str_replace("<#ispvrp#>","<a href='#none' onmouseover='imgview(\"?id={$eid}&amp;comment={$no}\",5,0)'>",$srkeen);$cmtlv = 3;}
if($cmtlv && $cmtlv != 3) $srkeen = str_replace("<#ispvrp#>","<a{$cmtlv}>",$srkeen);
}
if(!$cmtlv) $srkeen = str_replace("<#ispvrp#>","<a href='#none'>",$srkeen);
$jsurl = 0;
if($secret == 2 || $mss[63] != 4) $mmb = "";
if($secret == 2 || $mss[62] != 4) {
if($type == 'g') {$srkeen = str_replace("<#simg#>","icon/noimg.gif",$srkeen);$rsimg = 0;}
else if($type == 'c') {$srkeen = str_replace("<#issimg#>","<;>",$srkeen);$rissimg = 0;}
$flo[4] = '';
}
if($secret && $secret != 2 && $flo[5]) {
	$jsurl = 1;
	$srkeen = str_replace("<#jsurl#>","onclick=\"nwopn('{$flo[5]}')\"",$srkeen);
  $srkeen = str_replace("<#url#>","<a target='_blank' href='{$flo[5]}' class='lnk'>",$srkeen);
	if($mss[22] == 4) $srkeen = str_replace("<#isnlink#>","<;>",$srkeen);
}
if($flo[5] == '' || $secret == 2 || $mss[22] != 4) $srkeen = str_replace("<#isnlink#>","<;>",$srkeen);
else if($flo[5]) {$list_body = str_replace("<#rlink#>",$flo[5],$list_body);$wdtt += 25;}
if($islock) $flo[3] = "<img src='icon/lock.gif' alt='' class='lock' /> ".$flo[3];

if($mwth[7][4] && $datt >= $sett[62]) {$srkeen = str_replace("<#isnew#>","<img src='icon/nw.gif' class='{$nL4}' alt='' />",$srkeen);$wdtt += 16;}
if($flo[4] && substr($flo[4], 0, 5) != "http:") $flo[4] = $exe."?id=".urlencode($mid)."&amp;file=".$flo[4];
$url = "?id={$eid}&amp;no={$no}";
if($flo[3] == '') $flo[3] = ' …… ';
else $flo[3] = str_replace("&","&amp;",$flo[3]);
if(!$flo[4] && $mss[23] == '3') $srkeen = str_replace("<#simg#>","<img src='icon/noimg.gif' class='gthumb_100' alt='' />",$srkeen);
else if($flo[4] && $mss[23] != '5') $srkeen = str_replace("<#simg#>","<img src='".$flo[4]."' class='gthumb_100' alt='' />",$srkeen);
$srkeen = str_replace("<#nick#>",$flo[1],$srkeen);
$srkeen = str_replace("<#rpcnt#>",$zzz[2],$srkeen);
$srkeen = str_replace("<#bdno#>",$no,$srkeen);
if($mss[16]== 'b' || $mss[16]== 'd') {
$pg = (int)($ii  / $isnt) + 1;
$url = "?id={$eid}&amp;p={$pg}#{$no}";
}
if($mss[23] == '5') {
$memb .= "\nnewtxt[{$nxs}] = Array(\"".str_replace('"','\\"',$flo[4])."\",\"".str_replace('"','\\"',$flo[3])."\",\"".str_replace('"','\\"',$flo[1])."\",\"".$nrp."\",\"".str_replace('"','\\"',$mmb)."\",\"{$url}\",\"{$datte}\",\"{$nwx}\");";
$srkeen = str_replace("<#newx#>","newx({$nxs})",$srkeen);
$urlp = " onmouseover=\"newx({$nxs})\"";
$srkeen = str_replace("<#gate_5#>","<input type='hidden' value='{$nxs}' />",$srkeen);
if($ii == 0) {
if($flo[4]) $srk5n = str_replace("<#newx_2#>","<a href='{$url}'><img src='".$flo[4]."' class='gthumb_100' alt='' /></a>",$srk5n);
$srk5n = str_replace("<#newx_4#>","<input type='hidden' id='newxi_{$nwx}' value='{$nxs}' /><a href='{$url}'>".$flo[3]."</a>",$srk5n);
$srk5n = str_replace("<#newx_3#>",$mmb,$srk5n);
$srk5n = str_replace("<#newx_5#>","by ".$flo[1]." | comments ".$nrp." | ".$datte,$srk5n);
$class = ' gthumb_100h';
} else $class = '';
if(!$flo[4])  $flo[4] = 'icon/noimg.gif';
$srkeen = str_replace("<#simg#>","<img src='{$flo[4]}' name='newxe' class='gthumb_100{$class}' alt='' />",$srkeen);
$nxs++;
} else if($mss[23] != '2') {
if($flo[4]) {
if($mss[23] == '3') $flo[4] = '';
else $flo[4] = "<img src='".$flo[4]."' class='gthumb_100' alt='' />";
}
if($secret != 2 && $mss[18] == 4) {
$memb .= "\npretxt[{$iii}] = \"".str_replace('"','\\"',$flo[4])."<div class='prsjt'>".str_replace('"','\\"',$flo[3])."<\/div><span class='n8'> by ".str_replace('"','\\"',$flo[1])."<\/span> <span class='r7'>[".$nrp."]<\/span><br \/>".str_replace('"','\\"',$mmb)."\";";
$urlp = " name='pv{$iii}'";
}
if(!$gthumb && $flo[4] && $mss[23] == '4') {if(!$sett[77]) $wtdh8 = "width:".($wtdh7 -129)."px";else $wtdh8 = "";$gthumb = 131;$srkjn .= "<a href='{$url}'{$urlp}>{$flo[4]}</a></div><div style='float:left;{$wtdh8}'>";}
} else if($mss[23] == '2') $srkeen = str_replace("<#memb#>",$mmb,$srkeen);
if(!$jsurl) {
$srkeen = str_replace("<#jsurl#>","onclick=\"rhref('{$url}');\"{$urlp}",$srkeen);
$srkeen = str_replace("<#url#>","<a href='{$url}'{$urlp} class='lnk{$class}'>",$srkeen);
}
$srkeen = str_replace("<#subject#>",$flo[3],$srkeen);
$wdtt = $wtdh - $wdtt -10;
if($mss[23] != '2' && $mss[23] != '3' && $mss[23] != '5') {
if($mss[23] == '4') {$wdtt4[$mid][] = $wdtt;}
else if(!$sett[77]) {
if($bwr == 'ie6') $srkeen = str_replace("<#wtdh#>","width:expression((this.scrollWidth < {$wdtt})? '':'{$wdtt}px')",$srkeen);
else $srkeen = str_replace("<#wtdh#>","max-width:{$wdtt}px",$srkeen);
}}
if($mss[23] == '5') $srk5n = str_replace("<#newx_6#>",$srkeen."<#newx_6#>",$srk5n);
else if($mss[23] != '4') $srkiin .= $srkeen;
else $srkkn .= $srkeen;
$url = '';
$urlp = '';
} else if($usmw != $mid && $mwth[6]) {
$usmw = $mid;
fclose($fl);
fclose($fn);
fclose($fb);
$fn = fopen($dxr.$mid."/^".$mwth[6]."/no.dat","r");
$fl = fopen($dxr.$mid."/^".$mwth[6]."/list.dat","r");
$fb = fopen($dxr.$mid."/^".$mwth[6]."/body.dat","r");
$ii--;
}
$ii++;
$iii++;
}
fclose($fl);
fclose($fn);
fclose($fb);
if($mss[23] == '5') $srkiin .= $srk5n;
if($srkkn || $mss[23] == '4') {
$srknn = explode("<#wtdh#>",$srkkn);
$srkkn = '';
for($r = 0;$srknn[$r];$r++) {
$srkkn .= $srknn[$r];
if(!$sett[77] && $wdtt4[$mid][$r] && $srknn[$r +1]) {
$wdtt = $wdtt4[$mid][$r] - $gthumb;
if($bwr == 'ie6') $srkkn .= "width:expression((this.scrollWidth < {$wdtt})? '':'{$wdtt}px')";
else $srkkn .= "max-width:{$wdtt}px";
}
}
$wdtt4[$mid] = '';
$gthumb = 0;
$srkjn .= $srkkn."</div></td></tr></table>";$srkkn = '';
}
else $srkiin .= "</td></tr></table>";
if($mss[23] != '4') $f++;
} else $i = 0;
}}}
if($srkjn || $mss[23] == '4') {$srkiin .= "<div class='fcler'></div></div><div class='tab_div' onmouseover='stopt={$tpn}' onmouseout='stopt=-1'>".$srkjn."</div>".$sectgt[$f];$srkjn = '';}
else $srkiin .= $sectgt[$f];
$sectgt[$f] = '';
$srkiin .= "</table>";
$srkiin .= tagcut('noid_tail',$srkin);
if($sett[76] > 0) {
$ftbk1 = fopen($gtbk1,"w");
if(strpos($srkiin,'<;>') !== false) $srkiin = preg_replace("`<;>(.+)<!--/-->`sU","",$srkiin);
$srkiin = str_replace("<!--/-->","",preg_replace("`<#[^#]+#>`","",$srkiin));
fputs($ftbk1,"<###$"."nxs=".$nxs.";$"."nwx=".$nwx.";$"."tpn=".$tpn.";$"."iii=".$iii.";###>".$srkiin);
fclose($ftbk1);
$ftbk2 = fopen($gtbk2,"w");
fputs($ftbk2,$memb);
fclose($ftbk2);
}}
if($inclwt=inclvde($srkiin)) foreach($inclwt as $inxv) {if($inxv[0] == 1) eval($inxv[1]);else if($inxv[0] == 2) include($inxv[1]);else echo $inxv[1];}
$i = 0;
?>