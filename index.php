<?
	include("includes/functions.php");
	$slug = get_slug();
	$skip_document = $thatsa404 = false;
	// db_connect();

	function slug_to_path($slug) {
		if ($slug == "/") {
			return "pages/home.php";
		} elseif (file_exists("pages$slug/index.php")) {
			return "pages$slug/index.php";
		} elseif (file_exists("pages$slug.php")) {
			return "pages$slug.php";
		} else {
			global $thatsa404;
			$thatsa404 = true;
			return "pages/404.php";
		}
	}
	$include_path = slug_to_path($slug);

	if (!$skip_document) {
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#db5945">
		<title><?= ($thatsa404) ? "404 Title" : get_title($slug)?></title>
		<!--Roboto--> <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
		<!--Favicon: http://realfavicongenerator.net -->
		<link rel="stylesheet" type="text/css" href="/css/global.css?r=<?=rand(0,999)?>">
		<?= get_css($slug); ?>
	</head>

	<body>
		<section id="body" class="body">
			<? include("$include_path"); ?>
		</section>
		<!--jQuery--> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!--js.cookie--> <script src="/js/js.cookie-2.1.4.min.js"></script>
		<!--rangeSlider--> <script src="/js/rangeSlider-0.3.11.min.js"></script>
	</body>
</html>
<?
	}
	// db_disconnect();
?>
