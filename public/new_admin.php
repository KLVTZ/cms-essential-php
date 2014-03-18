<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>
<?php confirm_logged_in(); ?>

<?php 

	if(isset($_POST['submit'])) {

		// validations
		$required_fields = array("username", "password");
		validate_presences($required_fields);

		$fields_with_max_length = array("username" => 30);
		validate_max_lengths($fields_with_max_length); 


		if(empty($errors)) {
			$username = mysql_prep($_POST["username"]);
			$hashed_password = password_encrypt($_POST["password"]);

			$query = "INSERT INTO admins (username, hashed_password) 
				VALUES ('{$username}', '{$hashed_password}')";
			$result = mysqli_query($connection, $query);

			if($result) {
				$_SESSION["message"] = "Admin created.";
				redirect_to("manage_admins.php");
			} else {
				$_SESSION["message"] = "Admin creation failed.";
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
			 <h2>Create Admin</h2>
			 <form action="new_admin.php" method="post">
			 	<p>Username:
					<input type="text" name="username" value="">
			 	</p>
			 	<p>Password: 
					<input type="password" name="password" value="">
			 	</p>
			 	<input type="submit" name="submit" value="Create Admin" />
			 </form>
			 <br>
			 <a href="manage_admins.php">Cancel</a>
		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>