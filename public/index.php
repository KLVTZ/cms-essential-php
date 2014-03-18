<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>

<?php $layout_context = "public"; ?>
<?php require_once("../includes/layouts/header.php");?>
<?php find_selected_page(true); ?>
	<div id="main">
		<div id="navigation">
			<?=public_navigation($current_subject, $current_page);?>
		</div>
		<div id="page">
			<?php if ($current_page) : ?>

					<h2><?=htmlentities($current_page["menu_name"]);?></h2>
					<?=nl2br(htmlentities($current_page["content"]));?>
				<?php else : ?>
					<p>Welcome!</p>
			<?php endif; ?>

		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>