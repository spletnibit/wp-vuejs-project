<!DOCTYPE html>
<html lang="sl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="<?=get_bloginfo('url')?>">

	<title><?php echo the_title(); ?></title>
	<meta name="description" content="<?php echo $excerpt; ?>"/>
	
	<link rel="stylesheet" href="/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/wp-content/themes/spletnibit/dist/css/main.css">

	<?php wp_head() ?>
</head>
<body>
<div id="app"></div>

<script src="/dist/build.js"></script>
<!-- <script src="http://localhost:8080/dist/build.js"></script>-->
</body>
</html>
