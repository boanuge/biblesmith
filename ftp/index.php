<?php
###################################################
# Date : 2006.03.31.
# Name : Seung-Hwa Chung
###################################################

	$file_name = "index.php";
	$dir_name = "./";

###################################################

header("Content-type: text/html; charset=euc-kr");

function fsize($file)
{
	$a = array("B", "KB", "MB", "GB", "TB", "PB");
	$pos = 0;
	$size = filesize($file);
	while ($size >= 1024)
	{
		$size /= 1024;
		$pos++;
	}
	return round($size,2)." ".$a[$pos];
}

	echo (" <html>
				<head>
				<meta http-equiv='content-type' content='text/html; charset=euc-kr'/>
				<title>FTP</title>
				<style type='text/css'>
				<!--
				@font-face {font-family:none;}
				A:link {color:blue;font-size:12pt;text-decoration:none;}
				A:visited {color:navy;font-size:12pt;text-decoration:none;}
				A:active {color:orange;font-size:12pt;text-decoration:none;}
				A:hover {color:red;font-size:12pt;text-decoration:none;}
				p,br,body,td,form,div {color:#090909;font-size:12pt;font-family:none;}
				select,textarea,input {font-size:12pt;font-family:none;}
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
				</style>
				</head>");

	echo (" <body bgcolor=white text=black link=black vlink=black alink=black
				leftmargin=9 marginwidth=9 topmargin=9 marginheight=9> ");

	//Check if $dirname is null
	if (!$dirname) $dirname=$dir_name;
	
	//Check if $dirname is a folder
	if (is_dir("$dirname"))
	{
		//Copy the folder name $dirname to $file1
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
				//Remove the files "." and ".." from the list
				//Remove the files "index.php" and "_..." from the list
				if ($data[$i] != "." && $data[$i] != ".."
					&& $data[$i] != "index.php" && !(strpos($data[$i], "_") === 0))
				{
					//새로운 디렉토리를 보여준다.
					{
						if(is_dir("$file1/$data[$i]"))
						{ $filesize = "Folder"; }
						else
						{ $filesize = fsize("$file1/$data[$i]"); }
						echo "&nbsp;<a href='$dir_name/$data[$i]'>$data[$i]</a>&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>$filesize</font><br>&nbsp;<br>";
					}
				}
			}
			closedir($dir);
		}
	}

	echo ("</body></html>");
?>
