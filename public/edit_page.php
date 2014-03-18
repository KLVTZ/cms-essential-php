<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>
<?php find_selected_page(); ?>
<?php confirm_logged_in(); ?>
<?php 

	if(!$current_page) {
		// subject ID was missing or invalid or
		// subject couldn't be found in database
		redirect_to("manage_content.php");
	}

	if(isset($_POST['submit'])) {

		// validations
		$required_fields = array("menu_name", "position", "visible");
		validate_presences($required_fields);

		$fields_with_max_length = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_length); 


		if(empty($errors)) {

			$id = $current_page["id"];
			$menu_name = mysql_prep($_POST["menu_name"]);
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];
			$content = mysql_prep($_POST["content"]);
			
			$query = "UPDATE pages SET menu_name = '{$menu_name}', position = {$position}, visible = {$visible}, content = '{$content}' WHERE id = {$id} LIMIT 1";

			$result = mysqli_query($connection, $query);

			if($result && mysqli_affected_rows($connection) == 1) {
				$_SESSION["message"] = "Page updated.";
				redirect_to("manage_content.php?page=$id");
			} else {
				$message = "Page update failed.";
			}
		}
	} else {
		// This is probably a GET request
	}

 ?>
 <?php $layout_context = "admin"; ?>
<?php require_once("../includes/layouts/header.php");?>

	<div id="main">
		<div id="navigation">
			<?= navigation($current_subject, $current_page);?>
		</div>
		<div id="page">
			<?php if(!empty($message)) : ?>
				<div class="message"><?=$message?></div>
			<?php endif; ?>
			<?=form_errors($errors);?>
			 <h2>Edit Page <?=htmlentities($current_page["menu_name"]);?></h2>
			 <form action="edit_page.php?page=<?=urlencode($current_page['id']);?>" method="post">
			 	<p>Menu Name:
					<input type="text" name="menu_name" value="<?=htmlentities($current_page["menu_name"]);?>">
			 	</p>
			 	<p>Position:
					<select name="position">
					<?php 
						$page_set = find_pages_for_subject($current_page["subject_id"], false);
						$page_count = mysqli_num_rows($page_set); 
					?>
					<?php for($count = 1; $count <= $page_count; $count++) : ?>
						<option value="<?=$count?>"<?php if($current_page["position"] == $count) { echo " selected"; } ?>><?=$count?></option>
					<?php endfor; ?>
					</select>
			 	</p>
			 	<p>Visible:
					<input type="radio" name="visible" value="0" <?php if($current_page["visible"] == 0) { echo "checked"; } ?> /> No
					&nbsp;
					<input type="radio" name="visible" value="1" <?php if($current_page["visible"] == 1) { echo "checked"; } ?>  /> Yes
			 	</p> 
			 	<p>Content: <br>
			 		<textarea name="content" id="content" cols="80" rows="20"><?=htmlentities($current_page["content"]);?></textarea>
			 	</p>
			 	<input type="submit" name="submit" value="Edit Page" />
			 </form>
			 <br>
			 <a href="manage_content.php?page=<?=urlencode($current_page["id"])?>">Cancel</a>
			 &nbsp;
			 &nbsp;
			 <a href="delete_page.php?page=<?=$current_page['id']?>" onclick="return confirm('Are you sure?');">Delete page</a>
		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>