<?php
//////////////////////////////////////////////////////////////////////////////////////////
//호출방법 - 띄어쓰기없이쓸것!
//예: cscs_ng.php?korean=대전시서구월평동302번지 //EUC-KR (인코딩)
//예: cscs_ng.php?korean=위도,경도
//////////////////////////////////////////////////////////////////////////////////////////
list($valueLeft, $valueRight) = split(",", $korean, 2);

if($valueLeft != "" && $valueRight != "")
{
echo <<<END_HTML
<html>
<head>
<script type="text/javascript" src="cscs_lib.js"></script>
<script type="text/javascript">
var TM128_naver = new CS(csList.TM128_katech_3param);
var WGS84_google = new CS(csList.GOOGLE_WGS84);
var Latitude = $valueLeft;
var Longitude = $valueRight;
var Pgoogle = new PT(Longitude, Latitude);
cs_transform(WGS84_google, TM128_naver, Pgoogle);
var newURL = "../gmap.php?naverX="+Pgoogle.x+"&naverY="+Pgoogle.y+"&googleX="+Latitude+"&googleY="+Longitude+"&noloop=1";
document.location.href=newURL;
</script>
</head>
<body></body>
</html>
END_HTML;
}
//////////////////////////////////////////////////////////////////////////////////////////
else
{
	$file = "http://maps.naver.com/api/geocode.php?key=ffaba14ee5e7a91869daef3c091e22c0&query=$korean";
	
	if($noloop == 1)
	{
		echo "$naverX,$naverY:$googleX,$googleY";
	}
	else
	{
//////////////////////////////////////////////////////////////////////////////////////////
		$nameX = "x";
		$nameY = "y";

		$valueX = array(322788); //지도 디폴트 값 (분당 한신)
		$valueY = array(532187); //지도 디폴트 값 (분당 한신)
		//$valueX = array(343839); //지도 디폴트 값 (대전 황실)
		//$valueY = array(418000); //지도 디폴트 값 (대전 황실)
//////////////////////////////////////////////////////////////////////////////////////////
		$counterX = 0;
		$counterY = 0;
		$currentTag = ""; 
		$currentAttribs = ""; 
		function startElement($parser, $name, $attribs) 
		{
			global $currentTag, $currentAttribs; 
			$currentTag = $name; 
			$currentAttribs = $attribs; 
		}
		function endElement($parser, $name) 
		{
			global $currentTag; 
			$currentTag = ""; 
			$currentAttribs = ""; 
		}
		function characterData($parser, $data) 
		{
		global $counterX;
		global $counterY;
		global $valueX;
		global $valueY;
		global $nameX;
		global $nameY;
		global $currentTag;
			switch ($currentTag)
			{
				case $nameX:
				$valueX[$counterX] = $data;
				$counterX++;
				break;
				case $nameY: 
				$valueY[$counterY] = $data;
				$counterY++;
				break;
			}
		}
		$xmlParser = xml_parser_create();
		$caseFold = xml_parser_get_option($xmlParser, XML_OPTION_CASE_FOLDING);
		$targetEncoding = xml_parser_get_option($xmlParser, XML_OPTION_TARGET_ENCODING);
		if ($caseFold == 1) { xml_parser_set_option($xmlParser, XML_OPTION_CASE_FOLDING, false); }
		xml_set_element_handler($xmlParser, "startElement", "endElement");
		xml_set_character_data_handler($xmlParser, "characterData");
		if (!($fp = fopen($file, "r"))) { die("$file<br>XML data can not be opened."); }
		while ($data = fread($fp, 4096)) {
		if (!xml_parse($xmlParser, $data, feof($fp)))
			{
				die(sprintf("XML error: %s at line %d",
				xml_error_string(xml_get_error_code($xmlParser)),
				xml_get_current_line_number($xmlParser)));
				xml_parser_free($xmlParser);
			}
		}
		xml_parser_free($xmlParser); 
//////////////////////////////////////////////////////////////////////////////////////////
echo <<<END_HTML
<html>
<head>
<script type="text/javascript" src="cscs_lib.js"></script>
<script type="text/javascript">
var TM128_naver = new CS(csList.TM128_katech_3param);
var WGS84_google = new CS(csList.GOOGLE_WGS84);
var Xnaver = $valueX[0];
var Ynaver = $valueY[0];
var Pnaver = new PT(Xnaver, Ynaver);
cs_transform(TM128_naver, WGS84_google, Pnaver);
var Xgoogle = Pnaver.y;
var Ygoogle = Pnaver.x;
var newURL = "../gmap.php?naverX="+Xnaver+"&naverY="+Ynaver+"&googleX="+Xgoogle+"&googleY="+Ygoogle+"&noloop=1";
document.location.href=newURL;
</script>
</head>
<body></body>
</html>
END_HTML;
	}
}
//////////////////////////////////////////////////////////////////////////////////////////
?>
