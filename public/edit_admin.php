<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>
<?php confirm_logged_in(); ?>

<?php 

	$admin = find_admin_by_id($_GET["id"]);

	if(!$admin) {
		redirect_to("manage_admins.php");
	}

	if(isset($_POST['submit'])) {

		// validations
		$required_fields = array("username", "password");
		validate_presences($required_fields);

		$fields_with_max_length = array("username" => 30);
		validate_max_lengths($fields_with_max_length); 


		if(empty($errors)) {
			$id = $admin["id"];
			$username = mysql_prep($_POST["username"]);
			$hashed_password = password_encrypt($_POST["password"]);

			$query = "UPDATE admins SET username = '{$username}', hashed_password = '{$hashed_password}' WHERE id = {$id} LIMIT 1";
			$result = mysqli_query($connection, $query);

			if($result) {
				$_SESSION["message"] = "Admin edited.";
				redirect_to("manage_admins.php");
			} else {
				$_SESSION["message"] = "Admin editing failed.";
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
			&nbsp;
		</div>
		<div id="page">
			<?= message(); ?>
			<?php $errors = errors();?>
			<?=form_errors($errors);?>
			 <h2>Edit Admin <?=htmlentities($admin["username"])?></h2>
			 <form action="edit_admin.php?id=<?=urlencode($admin["id"])?>" method="post">
			 	<p>Username:
					<input type="text" name="username" value="<?=htmlentities($admin["username"]);?>">
			 	</p>
			 	<p>Password: 
					<input type="password" name="password" value="">
			 	</p>
			 	<input type="submit" name="submit" value="Edit admin" />
			 </form>
			 <br>
			 <a href="manage_admins.php">Cancel</a>
		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>