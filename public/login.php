<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>

<?php 
	$username = "";
	if(isset($_POST['submit'])) {

		// validations
		$required_fields = array("username", "password");
		validate_presences($required_fields);

		if(empty($errors)) {
			// Attempt the Login
			$username = $_POST['username'];
			$password = $_POST['password'];
			$found_admin = attempt_login($username, $password);

			if($found_admin) {
				$_SESSION['admin_id'] = $found_admin["id"];
				$_SESSION['username'] = $found_admin["username"];
				redirect_to("admin.php");
			} else {
				// Failure
				$_SESSION["message"] = "Username/password not found";
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
			<?=form_errors($errors);?>
			 <h2>Login</h2>
			 <form action="login.php" method="post">
			 	<p>Username:
					<input type="text" name="username" value="<?=htmlentities($username)?>">
			 	</p>
			 	<p>Password: 
					<input type="password" name="password" value="">
			 	</p>
			 	<input type="submit" name="submit" value="Submit" />
			 </form>
			 <br>
		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>