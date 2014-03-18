<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php $layout_context = "admin"; ?>
<?php require_once("../includes/layouts/header.php");?>
<?php confirm_logged_in(); ?>

<?php find_selected_page(); ?>

	<div id="main">
		<div id="navigation">
			<?= navigation($current_subject, $current_page);?>
		</div>
		<div id="page">
			<?= message(); ?>
			<?php $errors = errors();?>
			<?=form_errors($errors);?>
			 <h2>Create Subject</h2>
			 <form action="create_subject.php" method="post">
			 	<p>Menu Name:
					<input type="text" name="menu_name" value="">
			 	</p>
			 	<p>Position:
					<select name="position">
					<?php 
						$subject_set = find_pages_for_subject($subject_id, false);
						$subject_count = mysqli_num_rows($subject_set); 
					?>
					<?php for($count = 1; $count <= $subject_count + 1; $count++) : ?>
						<option value="<?=$count?>"><?=$count?></option>
					<?php endfor; ?>
					</select>
			 	</p>
			 	<p>Visible:
					<input type="radio" name="visible" value="0" /> No
					&nbsp;
					<input type="radio" name="visible" value="1" /> Yes
			 	</p> 
			 	<input type="submit" name="submit" value="Create Subject" />
			 </form>
			 <br>
			 <a href="manage_content.php">Cancel</a>
		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>