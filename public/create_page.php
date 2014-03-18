<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>
<?php confirm_logged_in(); ?>
<?php 

	if(isset($_POST['submit'])) {

		$subject_id = (int) $_SESSION["subject_id"];
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];
		$content = mysql_prep($_POST["content"]);


		// validations
		$required_fields = array("menu_name", "position", "visible", "content");
		validate_presences($required_fields);

		$fields_with_max_length = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_length); 


		if(!empty($errors)) {
			$_SESSION["errors"] = $errors;
			redirect_to("new_subject.php");
		}
		
		$query = "INSERT INTO pages (subject_id, menu_name, position, visible, content) 
					VALUES ({$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}')";

		$result = mysqli_query($connection, $query);

		if($result) {
			$_SESSION["message"] = "Page created.";
			redirect_to("manage_content.php?=subject" . urlencode($current_subject["id"]));
		} else {
			$_SESSION["message"] = "Page creation failed.";
		}
	} else {
		// This is probably a GET request
		redirect_to("manage_content.php");
	}

	if(isset($connection)) { mysqli_close($connection); }
?>



<?php  ?>
