<!DOCTYPE html>
<html lang="sl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="<?=get_bloginfo('url')?>">

	<title><?php echo the_title(); ?></title>
	<meta name="description" content="<?=the_content()?>"/>
	
	<link rel="stylesheet" href="/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/wp-content/themes/spletnibit/dist/css/main.css">

	<?php wp_head() ?>
</head>
<body>
<div id="app"></div>

<script src="/dist/build.js"></script>
<!-- <script src="http://localhost:8080/dist/build.js"></script>-->

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-101586181-1', 'auto');
	ga('send', 'pageview');

</script>
</body>
</html>
