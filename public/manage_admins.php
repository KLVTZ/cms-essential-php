<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>

<?php $admin_set = find_all_admins(); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php require_once("../includes/layouts/header.php");?>
	
<?php find_selected_page(); ?>
	<div id="main">
		<div id="navigation">
		<br>
			<a href="admin.php">&laquo; Main menu</a><br>

		</div>
		<div id="page">
			<?= message(); ?>
			<h2>Manage Admins</h2>
				<table>
					<tr>
						<th style="text-align: left; width: 200px;">Username</th>
						<th colspan="2" style="text-align: left;">Actions</th>
					</tr>
					<?php while($admin = mysqli_fetch_assoc($admin_set)) : ?>
						<tr>
							<td><?=htmlentities($admin["username"])?></td>
							<td><a href="edit_admin.php?id=<?=urlencode($admin["id"]);?>">Edit</a></td>
							<td><a href="delete_admin.php?id=<?=urlencode($admin["id"]);?>" onclick="return confirm('Are you sure?');">Delete</a></td>
						</tr>
					<?php endwhile; ?>
				</table>
				<br>
				<a href="new_admin.php">Add new admin</a>
		</div> 
	</div>

<?php require_once("../includes/layouts/footer.php");?>