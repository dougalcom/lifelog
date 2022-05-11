<?
date_default_timezone_set("US/Central");

// THE PASSWORD
$passhash = ""; // the real password for production

// App base URL
$baseURL = "/";

// DB link setup
$link = mysqli_connect("localhost","user","password","database");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);
function relativeTime($time){   
	$time = strtotime($time);
    $delta = time() - $time;
    if ($delta < 1 * MINUTE){ return $delta == 1 ? "one second ago" : $delta . " seconds ago"; }
    if ($delta < 2 * MINUTE){ return "a minute ago"; }
    if ($delta < 45 * MINUTE){ return floor($delta / MINUTE) . " minutes ago"; }
    if ($delta < 90 * MINUTE){ return "an hour ago"; }
    if ($delta < 24 * HOUR){ return floor($delta / HOUR) . " hours ago"; }
    if ($delta < 48 * HOUR){ return "yesterday"; }
    if ($delta < 7 * DAY){ return date(l,$time); }
    if ($delta < 30 * DAY){ return floor($delta / DAY) . " days ago"; }
    if ($delta < 12 * MONTH){ $months = floor($delta / DAY / 30); return $months <= 1 ? "one month ago" : $months . " months ago";}
    else{$years = floor($delta / DAY / 365); return $years <= 1 ? "one year ago" : $years . " years ago";}
}

//MySQL Input Sanitizer
function str2db($input, $strip_tags=true) {
	if(is_array($input)) {
		foreach($input as $key => $value) {
			$input[$key] = str2db($value);
		}
	} else {
		if(get_magic_quotes_gpc()) {
			if(ini_get('magic_quotes_sybase')){
					$input = str_replace("''", "'", $input);
			}
			else {
				$input = stripslashes($input);
			}
        }
		if($strip_tags) {
			$input = strip_tags($input);
		}
		$input = mysqli_real_escape_string($link, $input);
		$input = trim($input);
	}
	return $input;
}

function truncText($string, $length) {
	$tail = ' ...'; //indicator of truncation
	
	if (strlen($string) <= $length) return $string; //string is already smaller than desired
	
	$pos = strrpos($string, '.');
	if ($pos >= $length-4) {
		$string = substr($string, 0, $length-4);
		$pos = strrpos($string, '.');
	}
	if ($pos >= $length*0.4) return substr($string, 0, $pos+1).$tail;
	
	$pos = strrpos($string, ' ');
	if ($pos >= $length-4) {
		$string = substr($string, 0, $length-4);
		$pos = strrpos($string, ' ');
	}
	if ($pos >= $length*0.4) return substr($string, 0, $pos).$tail;
	
	return substr($string, 0, $length-4).$tail;
} //truncText()
?>
