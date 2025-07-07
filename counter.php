<?php
	// "counter.php?file=./index.images/youtube.gif" 요청시,
	// (1) counter.txt 파일을 읽는다. (2) 1 증가 후 덮어쓴다.
	// (3) 실제 "youtube.gif"를 클라이언트에 전송한다.

	// 1) 원본 파라미터 가져오기
	$raw = $_GET['file'] ?? '';

	// 2) 보안 처리: .. 으로 상위 경로 진입 금지
	$clean = str_replace('..', '', $raw);

	// 3) ./ 또는 / 제거
	$clean = ltrim($clean, './');

	// 4) 실제 이미지 파일 경로
	$imgPath = __DIR__ . '/' . $clean;
	if (!is_file($imgPath)) {
		http_response_code(404);
		exit('File not found.');
	}

	// 5) 카운트 파일 읽고 증가
	$counterFile = __DIR__ . '/counter.txt';
	$count = file_exists($counterFile) ? (int)file_get_contents($counterFile) : 0;
	$count++;
	file_put_contents($counterFile, $count);

	// 6) 이미지 전송
	header('Content-Type: ' . mime_content_type($imgPath));
	header('Content-Length: ' . filesize($imgPath));
	readfile($imgPath);
	exit;
?>