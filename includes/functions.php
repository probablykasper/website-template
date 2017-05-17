<?

	// $css_paths = [
	// 	"/" => "home.css",
	// 	"/contact" => "contact.css"
	// ];
	// $titles = [
	// 	"/" => "Sitename",
	// 	"/contact" => "Contact"
	// ];
	// $js_paths = [
	// 	"/" => "home.js",
	// 	"/contact" => "contact.js"
	// ];

// ----------------------------------------------------------------------------
// GET THINGS
// ----------------------------------------------------------------------------

	function get_slug() {
		$slug = $_SERVER["REQUEST_URI"];
		$slug = explode("?", $slug, 2);
		$slug = $slug[0];
		$slug = strtolower($slug);
		if (preg_match("[/$]", $slug) && $slug != "/") {
			$slug = rtrim($slug, "/");
		}
		return $slug;
	}

	function get_css($slug, $path_only = false) {
		global $css_paths;
		$css = "";
		// Find out if slug is one from $css_paths
		foreach ($css_paths as $possible_slug => $css_path) {
			if ($possible_slug == $slug) {
				$css = "/css/$css_path?r=" . rand(0,999);
				if (!$path_only) {
					$css = '<link class="page-css" rel="stylesheet" type="text/css" href="'.$css.'"/>';
				}
			}
		}
		return $css;
	}

	function get_js($slug, $path_only = false) {
		global $js_paths;
		$js = "";
		// Find out if slug is one from $js_paths
		foreach ($js_paths as $possible_slug => $js_path) {
			if ($possible_slug == $slug) {
				$js = "/js/$js_path?r=" . rand(0,999);
				if (!$path_only) {
					$js = '<script class="page-js" src="'.$js.'"></script>';
				}
			}
		}
		return $js;
	}

	function get_title($slug) {
		global $titles;
		$title = "";
		// Find out if slug is one from $titles
		foreach ($titles as $possible_slug => $current_title) {
			if ($possible_slug == "/") {
				$title = $current_title;
			} elseif ($possible_slug == $slug) {
				$title = $current_title." - Nelation";
			}
		}
		return $title;
	}

// ----------------------------------------------------------------------------
// DATABASE
// ----------------------------------------------------------------------------

	function db_connect() {
		global $db_connection;
		$host = "localhost";
		$username = "web";
		$password = "BdW2XyeWaSVmFNcn";
		$db_name = "nelation";
		$db_connection = mysqli_connect($host, $username, $password, $db_name);
	}

	function db_disconnect() {
		// 5. Disconnect from db
		global $db_connection;
		mysqli_close($db_connection);
	}

	function db_query($query) {
		global $db_connection;
		$query = mysqli_real_escape_string($db_connection, $query);
		$result = mysqli_query($db_connection, $query);
		if (!$result) {
			echo "Bad, bad, bad error that we don't like: ".mysqli_error($db_connection);
			die();
		}
		return $result;
	}

// ----------------------------------------------------------------------------
// MISC
// ----------------------------------------------------------------------------

	function urlify($string) {
		$string = strtolower($string);
		$string = str_replace([" "], "-", $string);
		$string = preg_replace("/[^\w+-]/", "", $string);
		$string = preg_replace("[-+]", "-", $string);
		return $string;
	}

	function starts_with($haystack, $needle) {
	    $length = strlen($needle);
	    return (substr($haystack, 0, $length) === $needle);
	}

?>
