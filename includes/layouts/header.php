<?php if(!isset($layout_context)) { $layout_context = "public"; } ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Widget Corp <?php if($layout_context == "admin") { echo "Admin"; }?></title>
	<link rel="stylesheet" href="stylesheets/public.css">
</head>
<body>
	<div id="header">
		<h1>Widget Corp <?php if($layout_context == "admin") { echo "Admin"; }?></h1>
	</div>