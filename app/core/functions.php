<?php



function show($stuff){
	echo "<pre>";
	print_r($stuff);
	echo "<pre>";
}


function page($file){
	return "app/pages/".$file.".php";
}

function section($file){
	return "app/pages/sections/".$file."_section.php";
}

function message($message = '', $clear = false){

	if (!empty($message)) {

		$_SESSION['message'] = $message;
	}else{

		if (!empty($_SESSION['message'])) {
		 
			$msg = $_SESSION['message'];
			if ($clear) {
				unset($_SESSION['message']);
			}

			return $msg;
		}
	}

	return false;
}


function redirect($page){

	header("Location: ".ROOT."/".$page);
	die;
}


function set_value($key, $default = ''){

	if (!empty($_POST[$key])) {
		
		return $_POST[$key];
	}else{

		return $default;
	}

	return '';
}


function set_select($key, $value, $default = ''){

	if (!empty($_POST[$key])) {

		if ($_POST[$key] == $value) {
			 return " selected ";
		} 
	}else{

		if ($default == $value) {
			 return " selected ";
		}
	}

	return '';
}


function get_date($date){

	return date("jS M, Y",strtotime($date));
}


function logged_in(){
	
	if(!empty($_SESSION['USER']) && is_array($_SESSION['USER'])){
		return true;
	}
	return false;
}

 
function is_admin(){
	
	if(!empty($_SESSION['USER']['role']) && $_SESSION['USER']['role'] == 'admin'){
		return true;
	}
	return false;
}


function is_user(){
	
	if(!empty($_SESSION['USER']['role']) && $_SESSION['USER']['role'] == 'user'){
		return true;
	}
	return false;
}


function user($column){

	if(!empty($_SESSION['USER'][$column])){
		return $_SESSION['USER'][$column];
	}

	return "Unknown";
}

function authenticate($row){
	return $_SESSION['USER'] = $row;	
}


function str_to_url($url){

	$url = str_replace("'", "", $url);
	$url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
	$url = trim($url, "-");
	$url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
	$url = strtolower($url);
	$url = preg_replace('~[^-a-z0-9_]+~u', '', $url);

	return $url;
}

function rev_str_to_url($url){

	$url = $url = trim($url, "-");
	$url = preg_replace('~[^\\pL0-9_]+~u', ' ', $url);
	$url = preg_replace('~[^-a-z0-9_]+~u', ' ', $url);
	$url = ucwords($url);

	return $url;
}
 
function esc($str){
	
	return nl2br(htmlspecialchars($str));
}


function resize_image($filename, $max_size = 700){

	$extension = explode(".", $filename);
	$extension = strtolower(end($extension));

	if (file_exists($filename)) {
		 
		switch ($extension) {
		 	case 'png':
		 		$image = imagecreatefrompng($filename);
		 		break;

		 	case 'gif':
		 		$image = imagecreatefromgif($filename);
		 		break;

		 	case 'jpg':
		 	case 'jpeg':
		 		$image = imagecreatefromjpeg($filename);
		 		break;
		 	
		 	default:
		 		$image = imagecreatefromjpeg($filename);
		 		break;
		}

		$src_w = imagesx($image);
		$src_h = imagesy($image);

		if ($src_w > $src_h) {

			$dst_w = $max_size;
			$dst_h = ($src_h / $src_w) * $max_size;
		}else{

			$dst_w = ($src_w / $src_h) * $max_size;
			$dst_h = $max_size;
		}

		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		
		imagedestroy($image);

		imagejpeg($dst_image, $filename, 90);
		switch ($extension) {
		 	case 'png':
		 		imagepng($dst_image, $filename);;
		 		break;

		 	case 'gif':
		 		imagegif($dst_image, $filename);
		 		break;

		 	case 'jpg':
		 	case 'jpeg':
		 		imagejpeg($dst_image, $filename, 90);
		 		break;
		 	
		 	default:
		 		imagejpeg($dst_image, $filename, 90);
		 		break;
		}

	}

	return $filename;
}


function resize_logo($filename, $max_size = 400){

	$extension = explode(".", $filename);
	$extension = strtolower(end($extension));

	if (file_exists($filename)) {
		 
		switch ($extension) {
		 	case 'png':
		 		$image = imagecreatefrompng($filename);
		 		break;

		 	case 'gif':
		 		$image = imagecreatefromgif($filename);
		 		break;

		 	case 'jpg':
		 	case 'jpeg':
		 		$image = imagecreatefromjpeg($filename);
		 		break;
		 	
		 	default:
		 		$image = imagecreatefromjpeg($filename);
		 		break;
		}

		$src_w = imagesx($image);
		$src_h = imagesy($image);

		if ($src_w > $src_h) {

			$dst_w = $max_size;
			$dst_h = ($src_h / $src_w) * $max_size;
		}else{

			$dst_w = ($src_w / $src_h) * $max_size;
			$dst_h = $max_size;
		}

		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresampled($dst_image, $image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		
		imagedestroy($image);

		imagejpeg($dst_image, $filename, 90);
		switch ($extension) {
		 	case 'png':
		 		imagepng($dst_image, $filename);;
		 		break;

		 	case 'gif':
		 		imagegif($dst_image, $filename);
		 		break;

		 	case 'jpg':
		 	case 'jpeg':
		 		imagejpeg($dst_image, $filename, 90);
		 		break;
		 	
		 	default:
		 		imagejpeg($dst_image, $filename, 90);
		 		break;
		}

		imagedestroy($image);

	}

	return $filename;
}


function delete_image($file){

	if (file_exists($file)) {
		 unlink($file);
	}
}
 
 