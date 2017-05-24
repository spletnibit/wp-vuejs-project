<?php
$img_src = '';
$excerpt = '';
?>
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


	<meta property="fb:app_id" content="523407941381727" />
	<meta property="og:title" content="<?php echo the_title(); ?>" />
  	<?php if ($excerpt): ?>
	<meta property="og:description" content="<?php echo $excerpt; ?>"/>
	<?php endif ?>
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="<?php echo the_permalink(); ?>"/>
	<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
	<?php if ($img_src): ?>
	<meta property="og:image" content="<?php echo $img_src; ?>"/>
	<?php endif ?>


</head>
<body>
<div id="fb-root"></div>
<div id="app"></div>

<!--<script src="/dist/build.js"></script>-->
 <script src="http://localhost:8080/dist/build.js"></script>
</body>
</html>
