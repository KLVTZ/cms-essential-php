<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>
<?php find_selected_page(); ?>
<?php confirm_logged_in(); ?>

<?php 

	if(!$current_subject) {
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

			$id = $current_subject["id"];
			$menu_name = mysql_prep($_POST["menu_name"]);
			$position = (int) $_POST["position"];
			$visible = (int) $_POST["visible"];
			
			$query = "UPDATE subjects SET menu_name = '{$menu_name}', position = {$position}, visible = {$visible} WHERE id = {$id} LIMIT 1";

			$result = mysqli_query($connection, $query);

			if($result && mysqli_affected_rows($connection) == 1) {
				$_SESSION["message"] = "Subject updated.";
				redirect_to("manage_content.php");
			} else {
				$message = "Subject update failed.";
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
			 <h2>Edit Subject <?=$current_subject["menu_name"];?></h2>
			 <form action="edit_subject.php?subject=<?=$current_subject['id'];?>" method="post">
			 	<p>Menu Name:
					<input type="text" name="menu_name" value="<?=$current_subject["menu_name"];?>">
			 	</p>
			 	<p>Position:
					<select name="position">
					<?php 
						$subject_set = find_all_subjects(false);
						$subject_count = mysqli_num_rows($subject_set); 
					?>
					<?php for($count = 1; $count <= $subject_count; $count++) : ?>
						<option value="<?=$count?>"<?php if($current_subject["position"] == $count) { echo " selected"; } ?>><?=$count?></option>
					<?php endfor; ?>
					</select>
			 	</p>
			 	<p>Visible:
					<input type="radio" name="visible" value="0" <?php if($current_subject["visible"] == 0) { echo "checked"; } ?> /> No
					&nbsp;
					<input type="radio" name="visible" value="1" <?php if($current_subject["visible"] == 1) { echo "checked"; } ?>  /> Yes
			 	</p> 
			 	<input type="submit" name="submit" value="Edit Subject" />
			 </form>
			 <br>
			 <a href="manage_content.php">Cancel</a>
			 &nbsp;
			 &nbsp;
			 <a href="delete_subject.php?subject=<?=$current_subject['id']?>" onclick="return confirm('Are you sure?');">Delete subject</a>
		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>