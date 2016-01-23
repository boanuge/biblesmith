<?
if($_POST['zipcode'] && strchr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST'])) {
$zp1 = array();
$fp1 = fopen("zipcode1.php","r");
fgets($fp1);
while($fpo = fgets($fp1)) $zp1[substr($fpo,0,3)]  = substr(trim($fpo),3);
fclose($fp1);
$fp2 = fopen("zipcode2.php","r");
fgets($fp2);
while($fpo = fgets($fp2)) {
if(strpos($fpo,$_POST['zipcode']) !== false) {
$outpt = 1;
echo "<a href='#none' onclick='faddr(this.innerHTML)'>[".substr($fpo,0,3)."-".substr($fpo,3,3)."] ".$zp1[substr($fpo,0,3)]." ".substr(trim($fpo),6)."</a><br />";
}}
fclose($fp2);
}
if(!$outpt) echo "<a href='#none' onclick='faddr()'>no result</a>";
?>