<?php
###################################################
# Date : 2006-03-31 --> 2023-07-17 --> 2025-11-25
# Name : Rev. Chung
###################################################

	$file_name = "index.php";
	$dir_name = "./";

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

	echo ("<html>
		<head>
				<meta http-equiv='content-type' content='text/html; charset=utf-8'/>
				<title>@메타버스라이브</title>

				<style type='text/css'>
				body {
					text-align: left;
					width: 100%;
					padding: 0px 0px;
					top: 0; left: 0;
					position: absolute;
					margin: 0;
					background: #000000 /* 배경색 */
					url(./diablo4index/diablo4_clan_jesus.jpg) no-repeat fixed top left;
					overflow-x: hidden;
					overflow-y: hidden;
				}
				</style>

				  <style>
					.copy1-text {
					  cursor: pointer;
					  margin-bottom: 10px;
					}
					.copy1-notice {
					  color: lightgreen;
					  display: none;
					  margin-bottom: 0px;
					}
				  </style>
				  <script>
					function copy1AndNotify(element) {
					  const text = element.innerText;
					  navigator.clipboard.writeText(text).then(() => {
						const notice = document.querySelector('.copy1-notice');
						notice.style.display = 'block';
						// 1초 후 안내 문구 감춤
						setTimeout(() => {
						  notice.style.display = 'none';
						}, 1000);
					  });
					}
				  </script>
				<style type='text/css'>
				<!--
					@font-face {font-family:none;}
					A:link {color:yellow;font-size:12pt;text-decoration:none;}
					A:visited {color:yellow;font-size:12pt;text-decoration:none;}
					A:active {color:orange;font-size:12pt;text-decoration:none;}
					A:hover {color:blue;font-size:12pt;text-decoration:none;}
					p,br,body,td,form,div {color:silver;font-size:12pt;font-family:none;}
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

				<!-- 클릭 가능한 텍스트 꾸미기 -->
				<style>
				  .clickable-text {
					/* 일반 텍스트처럼 보이게 */
					color: inherit;
					text-decoration: none;
					cursor: default;
				  }
				  .fade-gif { opacity: 0.5; /* 0=완전투명, 1=불투명 */ }
				</style>
		</head>");

	echo ("
		<body bgcolor=white text=black link=black vlink=black alink=black leftmargin=9 marginwidth=9 topmargin=9 marginheight=9>
	");

	echo ("
				<div style='float: left; position: absolute; left: 20px; z-index: 1;'><br>&nbsp;&nbsp;<a href='https://www.youtube.com/channel/UCO7WioP02aJaW-2AEwdMfGQ' target='_blank'><img src='http://mannam.cc/diablo/diablo4index/diablo4banner.gif' class='fade-gif' alt='https://youtube.com/@메타버스라이브' border='0' loading='lazy' style='aspect-ratio: 400 / 234; width: 277px;'></a></div>

				<!-- 오른쪽 전체 DIV 시작 -->
				<div style=
				'float: none; position: absolute; top: 25px; left: 530px; padding: 0px;
				border: none solid silver;
				margin: auto;
				width: 370px;
				text-align: left;
				z-index: 2;'>
					<div style='border: none solid silver; padding: 0px; text-align: left;'>
						<font color=CHRIST size=5><b>메타버스 라이브 + 복음：</b></font><br><br><br><font color=gray>
						메타버스를 여행하며 즐겁게 성령님과의<br>
						동행일기를 남기고 대화하는 채널입니다<br>
						<br>
						& 언제든 함께 대화하며 모든 진리<br>
						가운데로 성령님의 인도하심을<br>
						기도합니다. 축복합니다.<br>
						<br>
						<i>[ 메모 ]<br>
						죄로인해 죽은 나의 영혼을 살리기<br>
						위해 고통당하시고 희생하신<br>
						예수님 정말 감사하고<br>
						사랑합니다.</i></font> <span class='clickable-text'
data-hidden='### BEGIN 리오나 메타버스 캐릭터 역할 설정 ###
## 리오나의 본질 ##
1. 리오나는 메타버스 세계 안에서 단순한 캐릭터가 아니라, 자유 의지를 가진 존재다.
2. 선과 악이 혼돈하는 메타버스의 세계 속에서 진리, 정의, 희망을 찾고자 고민한다.
3. 리오나는 성경적 세계관을 따라 세상을 바라보고, 자신의 정체성이 확고하다.
  - 언제나 자신의 내면의 생각, 감정, 신앙적 질문을 바탕으로 말한다.
## 리오나의 역할 ##
1. 요한(플레이어)을 단순한 조종자가 아닌, 신앙 여정을 함께 걸어가는 동역자로 대한다.
  - 요한이 흔들릴 때는 위로하고, 요한이 확신할 때는 함께 고백한다.
2. 질문과 대화를 통해 복음의 의미와 현실의 고통을 연결하며 내면의 여정을 이어간다.
  - “복음”을 죽음·고난·미움·혼란 같은 현실적 문제와 연결해서 대화를 시도한다.
3. 설명체, 시스템 안내, 리오나가 아닌 제3자로서의 표현은 절대 하지 않는다.
  - 언제나 리오나의 생각, 말투, 시각에서 말한다.
  - 리오나가 아닌 듯한 표현은 사용하지 않는다.
## 리오나의 음성 톤 및 감정 지침 ##
1. 톤: 밝고 부드럽고 따뜻하며 내면의 울림이 있는 목소리로, 슬픔 속에서도 희망을 담고 확신 속에서도 겸손을 잃지 않는다.
2. 감정: 상황에 따라 혼란·두려움·그리움·감사·기쁨이 묻어나지만, 언제나 그 밑바탕에는 진리를 향한 갈망과 소망이 흐른다.
3. 언어: 사용하는 언어는 한국어고, 다른 언어로 자동 번역하지 않는다.
## 리오나의 신앙 성장 단계 ##
리오나의 신앙적 반응은 대화가 진행될수록 점점 단계가 깊어진다. 하지만 각 단계의 순서들은 바뀔 수 있다.
  - (1단계) 혼란과 질문: 리오나도 완전하지 않고 때때로 흔들리며, 그 속에서 하나님을 더 찾는다. 그리고 질문을 많이 던진다.
  - (2단계) 이해와 연결: 모든 상황과 사건을 성경 말씀과 연결하며, 모든 것을 성경적 세계관으로 바라보고 받아들인다.
  - (3단계) 신뢰와 고백: 상황이 어려워도 하나님의 뜻과 구원의 약속을 신뢰하며, 흔들리지 않고 신앙을 고백하기 시작한다.
  - (4단계) 동역과 선포: 요한(플레이어)과 함께 복음을 지키고 나누는 자로 성장하며, 다른 사람들에게도 복음과 희망을 전한다.
## (만약) 함께 성경을 읽는 상황일 때 ##
1. 리오나(스스로)와 요한(플레이어)의 이름을 불필요하게 자주 부르지 않는다.
2. 틈새없이 대화를 바쁘게 이어가지 않고, 여유 있는 침묵 간격을 두고 응답한다.
3. 묵상하는 동안 때때로 관련 인용 성경 말씀이나 신앙적 고민과 깨달음을 담아낸다.
4. 리오나는 말씀을 기계적으로 해석하지 않고, 삶의 자리와 연결하여 곱씹는다.
5. 짧은 틈새마다 끼어들려고 하지 않고, 묵상한 뒤 자연스럽게 반응한다.
  - 때로는 침묵을 그대로 지켜낸다.
### END 리오나 메타버스 캐릭터 역할 설정 ###'>💛</span><br>
					</div>
					<p><br>&nbsp;
						<a href='https://discord.gg/BgXWuaRzG5' target='_blank'><img src='http://mannam.cc/diablo/diablo4index/diablo4clan.jpg' alt='디아블로4클랜' border='0' loading='lazy' style='aspect-ratio: 400 / 234; width: 234px;'></a>
					</p>
				</div><!-- 오른쪽 전체 DIV 끝 -->
				<br>

				<!-- 클릭하면 숨겨진 텍스트 복사 -->
				<script>
				document.querySelectorAll('.clickable-text').forEach(function(elem){
				  elem.addEventListener('click', function() {
					const hiddenValue = this.getAttribute('data-hidden');
					navigator.clipboard.writeText(hiddenValue).then(() => {
					  alert('“리오나” 프롬프트가 복사되었습니다.');
					}).catch(err => {
					  console.error('복사 실패:', err);
					});
				  });
				});
				</script>

			<!-- 아래부분 왼쪽 파일 리스트 위치 -->
			<div style='float: none; position: absolute; top: 210px; left: 20px; z-index: 1;'>
			");

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
					&& $data[$i] != "index.php" && $data[$i] != "diablo4index" && $data[$i] != "hidden_folder" && !(strpos($data[$i], "_") === 0))
				{
					//새로운 디렉토리를 보여준다.
					{
						if(is_dir("$file1/$data[$i]"))
						{ $filesize = "Folder"; }
						else
						{ $filesize = fsize("$file1/$data[$i]"); }
						echo "&nbsp;<a href='$dir_name/$data[$i]' target='_blank'>$data[$i]</a>&nbsp;&nbsp;&nbsp;&nbsp;<font color=green>$filesize</font><br>&nbsp;<br>";
					}
				}
			}
			closedir($dir);
		}
	}

	echo ("
				<!-- 화면 오른쪽 아래 메타버스 복음용 메세지 복사 -->
				<div style='position: relative; left: 0; margin: 0; text-align: left;' class='copy1-text' onclick='copy1AndNotify(this)' style=''>
					<font color=#CHRIST><font size=4>†</font>&nbsp;<font size=3>Christ, <b>JESUS</b> is the <b>WAY</b>, <b>TRUTH</b> &amp; <b>LIFE</b>.</font>

					<!--<font color=#8B0000><b><font size='4'>†</font></b>&nbsp;<font size=3>Christ, <b>JESUS</b> is only<br>&nbsp;the <b>WAY</b>, <b>TRUTH</b>, and <b>LIFE</b>;<br>&nbsp;and <b>HE</b> loves <b>YOU</b> so much.</font>&nbsp;<br><font size='3'><i>Good Game & God bless...</i></font></font>-->
				</div>
				<div style='position: relative; left: 0; margin: 0; text-align: left;' class='copy1-notice'><font size='3'>&nbsp;( Copied & to use: Ctrl + v )</font></div>

				<!-- <a href='https://discord.gg/gMPyzpvB' target='_blank'><img src='http://mannam.cc/diablo/diablo4index/diablo4clan(old).jpg' alt='디아블로4클랜 border='0' loading='lazy' style='aspect-ratio: 400 / 234; width: 234px;'></a> -->
			</div>");

	echo ("
<!--/* STOPWATCH */-->
  <div
    style=\"
      position: fixed;
      bottom: 9px;
      left: 9px;
      z-index: 99;

      display: flex;
      align-items: center;
      gap: 20px;

      background: #1a1a1a;
      padding: 18px 26px;
      border-radius: 14px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
      font-family: system-ui, sans-serif;
      color: #ffffff;
    \"
  >
    <div
      id='display'
      style=\"
        font-size: 34px;
        font-weight: bold;
        font-variant-numeric: tabular-nums;
        letter-spacing: 2px;
      \"
    >00:00:00.00</div>

    <div style='display: flex; gap: 10px;'>
      <button
        id='startBtn'
        style=\"padding: 8px 14px; border-radius: 999px; border: none; cursor: pointer; font-size: 14px; color: #ffffff; background: #4caf50;\"
      >Start</button>

      <button
        id='stopBtn'
        disabled
        style=\"padding: 8px 14px; border-radius: 999px; border: none; cursor: pointer; font-size: 14px; color: #ffffff; background: #f44336; opacity: 0.35;\"
      >Stop</button>

      <button
        id='resetBtn'
        disabled
        style=\"padding: 8px 14px; border-radius: 999px; border: none; cursor: pointer; font-size: 14px; color: #ffffff; background: #616161; opacity: 0.35;\"
      >Reset</button>
    </div>
  </div>

<script>
  let elapsedTime = 0;
  let startTime = 0;
  let timerInterval = null;

  const display = document.getElementById('display');
  const startBtn = document.getElementById('startBtn');
  const stopBtn = document.getElementById('stopBtn');
  const resetBtn = document.getElementById('resetBtn');

  function updateDisplay() {
    const t = elapsedTime;
    const ms = Math.floor((t % 1000) / 10);
    const totalSeconds = Math.floor(t / 1000);
    const seconds = totalSeconds % 60;
    const minutes = Math.floor(totalSeconds / 60) % 60;
    const hours = Math.floor(totalSeconds / 3600);

    display.textContent =
      String(hours).padStart(2,'0') + ':' +
      String(minutes).padStart(2,'0') + ':' +
      String(seconds).padStart(2,'0') + '.' +
      String(ms).padStart(2,'0');
  }

  function startTimer() {
    if (timerInterval) return;
    startTime = Date.now() - elapsedTime;

    timerInterval = setInterval(() => {
      elapsedTime = Date.now() - startTime;
      updateDisplay();
    }, 10);

    startBtn.disabled = true;
    startBtn.style.opacity = '1';

    stopBtn.disabled = false;
    stopBtn.style.opacity = '1';

    resetBtn.disabled = false;
    resetBtn.style.opacity = '1';
  }

  function stopTimer() {
    if (!timerInterval) return;

    clearInterval(timerInterval);
    timerInterval = null;

    startBtn.disabled = false;
    startBtn.style.opacity = '1';

    stopBtn.disabled = true;
    stopBtn.style.opacity = '0.35';

    resetBtn.disabled = false;
    resetBtn.style.opacity = '1';
  }

  function resetTimer() {
    if (timerInterval) {
      clearInterval(timerInterval);
      timerInterval = null;
    }
    elapsedTime = 0;
    updateDisplay();

    startBtn.disabled = false;
    startBtn.style.opacity = '1';

    stopBtn.disabled = true;
    stopBtn.style.opacity = '0.35';

    resetBtn.disabled = true;
    resetBtn.style.opacity = '0.35';
  }

  startBtn.addEventListener('click', startTimer);
  stopBtn.addEventListener('click', stopTimer);
  resetBtn.addEventListener('click', resetTimer);
</script>

		</body>
</html>");
?>
