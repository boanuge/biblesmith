<?php
###################################################
# Date : 2006년 1월 22일
# Name : 정승화
###################################################

	$file_name = "bible_all.php";
	$dir_name = "./bible_all";
	$background = "";

###################################################

?>
<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=euc-kr"/>

<script language="JavaScript">
function open_window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable)
{
	toolbar_str = toolbar ? 'yes' : 'no';
	menubar_str = menubar ? 'yes' : 'no';
	statusbar_str = statusbar ? 'yes' : 'no';
	scrollbar_str = scrollbar ? 'yes' : 'no';
	resizable_str = resizable ? 'yes' : 'no';
	window.open(url, name, 'left='+left+',top='+top+',width='+width+',height='+height+',toolbar='+toolbar_str+',menubar='+menubar_str+',status='+statusbar_str+',scrollbars='+scrollbar_str+',resizable='+resizable_str);
}
</script>

<?php
	//$dirname 에 데이터가 있는지 검사한다.
	if (!$dirname)
	{
		$dirname=$dir_name;
		$filename=$file_name;
	}

	//$check 에 데이터가 있는지 검사한다.
	if (!$check) $check="1";

	//$dirname 이 디렉토리인지 아닌지 검사한다.
	if (is_dir("$dirname"))
	{
		echo (" <title>BIBLE_ALL</title>
				<style type='text/css'>
				<!--
				@font-face {font-family:none;}
				A:link {color:blue;font-size:10pt;text-decoration:none;}
				A:visited {color:navy;font-size:10pt;text-decoration:none;}
				A:active {color:orange;font-size:10pt;text-decoration:none;}
				A:hover {color:red;font-size:10pt;text-decoration:none;}
				p,br,body,td,form,div {color:#090909;font-size:10pt;font-family:none;}
				select,textarea,input {font-size:10pt;font-family:none;}
				-->
				</style>
				<style>
				<!--
				a { text-decoration:none; }
				-->
				Body {scrollbar-face-color: #FFFFFF; scrollbar-shadow-color: 999798;
					scrollbar-highlight-color: 999798; scrollbar-3dlight-color: #FFFFFF;
					scrollbar-darkshadow-color: #F6F6F6; scrollbar-track-color: #FFFFFF;
					scrollbar-arrow-color: 999798;}
				</style> ");
		echo (" </head> ");
		echo (" <body bgcolor=white text=black link=black vlink=black alink=red
					leftmargin=9 marginwidth=9 topmargin=9 marginheight=9
					style='background:url($background) fixed no-repeat center middle'> ");
		echo (" <table border=0 width=100% cellpadding=0 cellspacing=0
					bordercolorlight=black bordercolordark=silver align=center> ");
		
		//이전 $dirname 을 $file1 에 기억한다.
		$file1 = $dirname;

		if ($dir = @opendir("$dirname"))
		{
			$data=array();
			$count=0;
			while (($file2 = readdir($dir)) !== false)
			{
				$data[$count++]=$file2;
				sort($data);
			}
			for ($i=0;$i<$count;$i++)
			{
				//디렉토리에서 첫부분에 있는 . 과 .. 을 제거하기 위해서 필요하다.
				if ($data[$i] != "." && $data[$i] != "..")
				{
					//주소에 새로운 $dirname 과 $check 변수를 주면서 이동한다.
					if ( $check == 1 )
					if ( bcmod($i, 2) == 0 )
					{ echo ("<tr><td width=50%><a href='$filename?dirname=$file1/$data[$i]&check=2'><font>$data[$i]</font></a></td>"); }
					elseif ( bcmod($i, 2) == 1 )
					{ echo ("<td width=50%><a href='$filename?dirname=$file1/$data[$i]&check=2'><font>$data[$i]</font></a><br></td></tr>"); }
					if ( $check == 2 )
					{ echo ("<!--<a href=\"javascript:open_window('_blank', '$filename?dirname=$file1/$data[$i]&check=3', 0, 0, 100, 100, 0, 0, 0, 1, 1)\">--><img src='$dirname/$data[$i]' width=320 height=233>&nbsp;<!--</a>-->"); }
				}
			}
			closedir($dir);
		}
		echo "</table><p>&nbsp;";
		echo "<a href='javascript:history.go(-1);'><font color=gray>Back</font></a>&nbsp;";
		echo "<a href='javascript:history.go(1);'><font color=gray>Forward</font></a>";
	}
	else
	{
		echo (" <title>BIBLE_ALL</title>
		<style>
		<!--
		a { text-decoration:none; }
		-->
		Body {scrollbar-face-color: #FFFFFF; scrollbar-shadow-color: 999798;
				  scrollbar-highlight-color: 999798; scrollbar-3dlight-color: #FFFFFF;
				  scrollbar-darkshadow-color: #F6F6F6; scrollbar-track-color: #FFFFFF;
				  scrollbar-arrow-color: 999798;}
		</style>

		 <script language='javascript'> 
			var arrTemp=self.location.href.split(\"?\"); 
			var picUrl = (arrTemp.length>0)?arrTemp[1]:\"\"; 
			var NS = (navigator.appName==\"Netscape\")?true:false; 
		
			function FitPic()
			{ 
				iWidth = (NS)?window.innerWidth:document.body.clientWidth; 
				iHeight = (NS)?window.innerHeight:document.body.clientHeight; 
				iWidth = document.images[0].width - iWidth; 
				iHeight = document.images[0].height - iHeight; 
				window.resizeBy(iWidth, iHeight); 
				self.focus(); 
			}; 
		 </script> 

		</head> ");
		echo (" <body bgcolor=white text=black link=black vlink=black alink=red leftmargin=0 marginwidth=0 topmargin=0 marginheight=0 onload='FitPic();'> <!--onblur=self.close()--> ");
		echo (" <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' height='100%'>
				<tr><td width='100%' height='100%' align='center' valign='middle'><p><img src='./$dirname'></p></td></tr></table> ");
	}
?>

</body>
</html>
