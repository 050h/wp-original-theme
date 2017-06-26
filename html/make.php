<?php
	unlink('../style.css');

	$dir = '../css/';
	$files = array_diff(scandir($dir), array('..', '.','.DS_Store'));

	$lisence = "/*\n\tTheme Name: じろう\n\tTheme URI: http://reizou05.com/theme\n\tAuthor: reizou05\n\tAuthor URI: http://reizou05.com\n\tDescription: オリジナルテーマ\n\tVersion: 0.0.1\n*/";

	file_put_contents('../style.css', $lisence,FILE_APPEND);

	foreach ($files as $file) {
		$contents = file_get_contents($dir.$file);
		file_put_contents('../style.css', $contents,FILE_APPEND);
	}