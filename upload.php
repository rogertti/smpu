<?php
/**
 * upload.php
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under GPL License.
 *
 * License: http://www.plupload.com/license
 * Contributing: http://www.plupload.com/contributing
 */

// HTTP headers for no cache etc
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
$pyfolder = md5('folder');

/*$targetDir = 'fiscal/'.$_GET[''.$pyfolder.''];

    if(!file_exists($targetDir)) {
        $mk = mkdir('fiscal/'.$_GET[''.$pyfolder.''],0777,true);
    }*/

$targetDir = ''.$_GET['raiz'].'/'.$_GET[''.$pyfolder.''];

    if(!file_exists($targetDir)) {
        $mk = mkdir(''.$_GET['raiz'].'/'.$_GET[''.$pyfolder.''], 0777, true);
        
            if(!$mk) {
                die('erro.');
            }
    }

$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds

// 5 minutes execution time
@set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Get parameters
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';

// Clean the fileName for security reasons
$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);

// Make sure the fileName is unique but only if chunking is disabled
if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
	$ext = strrpos($fileName, '.');
    $ext = strtolower($ext);
	$fileName_a = substr($fileName, 0, $ext);
	$fileName_b = substr($fileName, $ext);

	$count = 1;
	while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
		$count++;

	$fileName = $fileName_a . '_' . $count . $fileName_b;
}

//caso n„o entre no if de cima
$ext = explode('.',$fileName);
$fileName = $ext[0].'.'.strtolower($ext[1]);

$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

// Create target dir
if (!file_exists($targetDir))
	@mkdir($targetDir);

// Remove old temp files	
if ($cleanupTargetDir) {
	if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
		while (($file = readdir($dir)) !== false) {
			$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

			// Remove temp file if it is older than the max age and is not the current file
			if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
				@unlink($tmpfilePath);
			}
		}
		closedir($dir);
	} else {
		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	}
}	

// Look for the content type header
if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
	$contentType = $_SERVER["HTTP_CONTENT_TYPE"];

if (isset($_SERVER["CONTENT_TYPE"]))
	$contentType = $_SERVER["CONTENT_TYPE"];

// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
if (strpos($contentType, "multipart") !== false) {
	if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
		// Open temp file
		$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
		if ($out) {
			// Read binary input stream and append it to temp file
			$in = @fopen($_FILES['file']['tmp_name'], "rb");

			if ($in) {
				while ($buff = fread($in, 4096))
					fwrite($out, $buff);
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			@fclose($in);
			@fclose($out);
			@unlink($_FILES['file']['tmp_name']);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
	} else
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
} else {
	// Open temp file
	$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
	if ($out) {
		// Read binary input stream and append it to temp file
		$in = @fopen("php://input", "rb");

		if ($in) {
			while ($buff = fread($in, 4096))
				fwrite($out, $buff);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');

		@fclose($in);
		@fclose($out);
	} else
		die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);
}

//Thumbnail
function thumbnail($diretorio,$imagem,$x,$y) {
    $extensao = strtolower(end(explode('.', $imagem)));
    $cp = copy($diretorio."/".$imagem,$diretorio."/"."tb-".$imagem);
    
        if (!$cp) {
            die('erro');
        }
        else {
            $imagem = "tb-".$imagem;
        }
           
    //Define o nome do novo thumbnail
	$thumbnail = explode('.', $imagem);
	#$thumbnail = $diretorio."/".$thumbnail[0]."_mini.".$extensao;
	$thumbnail = $diretorio."/".$thumbnail[0].".".$extensao;
    $imagem = $diretorio."/".$imagem;
	        
        //Cria uma nova imagem da imagem original
	    if ($extensao == 'jpg' || $extensao == 'jpeg'): $img_origem = imagecreatefromjpeg($imagem);
        elseif ($extensao == 'png'): $img_origem = imagecreatefrompng($imagem);
        elseif ($extensao == 'gif'): $img_origem = imagecreatefromgif($imagem);
        endif;
	
    //Recupera as dimensoes da imagem original
	$origem_x = imagesx($img_origem); //Largura
	$origem_y = imagesy($img_origem); //Altura
	
	   //Se a imagem nao for proporcional ao thumbnail que se vai gerar
	   //Pega a maior face e calcula a outra face proporcional a imagem original
	   if ($origem_x > $origem_y): // Se a largura for maior que a altura
           $final_x = $x; //A largura sera a do thumbnail
		   $final_y = floor( $x * $origem_y / $origem_x ); //Calculo a altura proporcional
		   $f_x = 0; //Posiciono a imagem no x = 0
		   $f_y = round( ( $y / 2 ) - ( $final_y / 2 ) ); //Centralizo a imagem no vertice y
	   else: //Se a altura for maior ou igual a largura
		   $final_y = $y; //A altura sera a do thumbnail
		   $final_x = floor( $y * $origem_x / $origem_y ); //Calculo a largura proporcional
		   $f_y = 0; //Posiciono a imagem no x = 0
		   $f_x = round( ( $x / 2 ) - ( $final_x / 2 ) ); //Centralizo a imagem no vertice x
	   endif;
	
    //Gero a nova imagem do thumbnail do tamanho $x X $y
	//$img_final = imagecreate($x,$y);
	$img_final = imagecreatetruecolor($x,$y);
	
	//Copio a imagem original para a imagem do thumbnail utilizando os dados que foram calculados
	imagecopyresized($img_final, $img_origem, $f_x, $f_y, 0, 0, $final_x, $final_y, $origem_x, $origem_y);
	
        //Salvo o novo thumbnail
	    if ( $extensao == 'jpg' || $extensao == 'jpeg' ): imagejpeg($img_final, $thumbnail, 50);
        elseif ($extensao == 'png'): imagepng($img_final, $thumbnail);
        elseif ($extensao == 'gif'): imagegif($img_final, $thumbnail);
	    endif;
	
    //progressive
    imageinterlace($img_final, 1);

    //Destruo as imagens que foram utilizadas
	imagedestroy($img_origem);
	imagedestroy($img_final);
    
    unset($diretorio,$imagem,$x,$y,$extensao,$cp,$thumbnail,$img_origem,$img_final,$origem_x,$origem_y,$final_x,$final_y,$f_x,$f_y);
}

thumbnail($targetDir,$fileName,180,120);
unset($cryptlink);

die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
