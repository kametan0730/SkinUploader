<?php

$dir = "picture";
$message = "";

if(!(is_dir($dir))) mkdir($dir);

$maxsize = 50000;

if(isset($_FILES["skin"]["size"])){

	$file = $_FILES["skin"];
	$size = $file["size"];
	$name = "skindata_".microtime()*mt_rand(1,500).".png";

	if(!(strstr($message,".png")) or $size > $maxsize){

		$message = "アップロードに失敗しました(Pngファイルでないか、".$maxsize."byte以上です)";


		if(move_uploaded_file($file["tmp_name"], $dir. DIRECTORY_SEPARATOR . $name)){
			chmod($dir .DIRECTORY_SEPARATOR . $name, 0644);
			$message = "アップロードに成功しました";
		}else{
			$message = "アップロードに失敗しました(不明な理由、権限関連)";
		}
	}
}

echo '<html><head><title>SkinUploader</title><link rel="shortcut icon" href="http://kametan.tokyo/favicon.ico" />
</head><body><h1>スキンアップローダー</h1><form action="uploader.php" method="post" enctype="multipart/form-data">
 <input type="file" name="skin"><a> </a><input type="submit" value="アップロード"></form></body></html>';


echo $message;
?>