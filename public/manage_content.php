<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php $layout_context = "admin"; ?>
<?php require_once("../includes/layouts/header.php");?>
<?php confirm_logged_in(); ?>
	
<?php find_selected_page(); ?>
	<div id="main">
		<div id="navigation">
			<br>
			<a href="admin.php">&laquo; Main menu</a><br>
			<?= navigation($current_subject, $current_page);?>
			<br>
			<a href="new_subject.php">+ Add a subject</a>
		</div>
		<div id="page">
			<?= message(); ?>
			<?php if($current_subject) : ?>
				<h2>Manage Subject</h2>
				Menu name: <?=$current_subject["menu_name"] . "<br>";?>
				Position: <?=$current_subject["position"] . "<br>";?>
				<?php $visibility = ($current_subject["visible"] == 1) ? "yes" : "no";  ?>
				Visible: <?=$visibility . "<br>";?>
				<br><a href="edit_subject.php?subject=<?=$current_subject["id"]?>">Edit Subject</a><br> <br>
				<hr>
				<h2>Pages in this subject:</h2>
				<?= show_pages_for_subject($current_subject["id"]);?><br>
				<a href="new_page.php?subject=<?=$current_subject["id"]?>"> Add a new page to this subject</a>
			<?php elseif($current_page) : ?>
				<h2>Manage Page</h2>
				Menu name: <?=$current_page["menu_name"] . "<br>";?>
				Position: <?=$current_page["position"] . "<br>";?>
				<?php $visibility = ($current_subject["visible"] == 1) ? "yes" : "no";  ?>
				Content: <br>
				<div class="content"><?=$current_page["content"]?></div>
				<a href="edit_page.php?page=<?=$current_page["id"]?>">Edit Page</a>
			<?php else : ?>
				<?="Please select a subject or page";?>
			<?php endif; ?>

		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>