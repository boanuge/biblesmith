<?php
// 항상 로그인 패스워드 요구: 세션 초기화
session_start();
session_unset();
session_destroy();
session_start();

ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(0); // 브라우저 닫으면 세션 만료

###################################################
# Date : 2025-06-30
# Name : Rev. Chung
###################################################

$file_name = "index.php";
$dir_name = "."; #"./";
$password = "jesus";  // 비밀번호

###################################################

header("Content-type: text/html; charset=utf-8");

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

// 로그인 처리
if (isset($_POST['password'])) {
	if ($_POST['password'] === $password) {
		$_SESSION['authenticated'] = true;
	} else {
		echo "<script>alert('비밀번호가 틀렸습니다.');</script>";
	}
}

// 인증되지 않았다면 로그인 폼 출력
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
	echo "
		<html>
		<head>
			<meta charset='utf-8'>
			<title>로그인 필요</title>
			<style>
				body {
					display: flex;
					justify-content: center;
					align-items: center;
					height: 100vh;
					margin: 0;
					font-family: sans-serif;
				}
				.login-box {
					text-align: center;
					border: 1px solid #ccc;
					padding: 30px;
					border-radius: 8px;
					box-shadow: 0 0 10px rgba(0,0,0,0.1);
				}
			</style>
		</head>
		<body>
			<div class='login-box'>
				<form method='post'>
					<label>비밀번호를 입력하세요:</label><br>
					<font size=2 color=silver>당신을 가장 사랑하시는 분 (소문자)</font><br><br>
					<input type='password' name='password' id='password'>
					<input type='submit' value='Enter'>
				</form>
			</div>
			<script>
				document.getElementById('password').focus();
			</script>
		</body>
		</html>
	";
	exit;
}

// 로그인 성공 시 아래 코드 실행
echo (" <html>
		<head>
		<meta http-equiv='content-type' content='text/html; charset=utf-8'/>
		<title>[비공개] 자료모음</title>
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

echo	(" <body bgcolor=white text=black link=black vlink=black alink=black leftmargin=9 marginwidth=9 topmargin=9 marginheight=9>
		<font color=green>
		<b>##################</b><br>
		<b># [비공개] 자료모음 #<br>
		<b>##################</b><br>
		</font><br>
	");

if (!$dirname) $dirname=$dir_name;

if (is_dir("$dirname"))
{
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
			if ($data[$i] != "." && $data[$i] != ".."
				&& $data[$i] != "index.php" && !(strpos($data[$i], "_") === 0))
			{
				if(is_dir("$file1/$data[$i]"))
				{ $filesize = "Folder"; }
				else
				{ $filesize = fsize("$file1/$data[$i]"); }
				echo "&nbsp;<a href='$dir_name/$data[$i]'>$data[$i]</a>&nbsp;&nbsp;&nbsp;&nbsp;<font color=green>$filesize</font><br>&nbsp;<br>";
			}
		}
		closedir($dir);
	}
}

echo ("</body></html>");
?>
