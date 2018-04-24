<?php 
	session_start();
	require_once 'csrf.php'; 
	$csrf = new CSRF();
?>
<html>
	<form method="post" action="create.php">
		Name:<br><input type="text" name="name" required><br>
		Value:<br><input type="number" name="value" required><br>
		<input type="hidden" name="csrf" value="<?php echo $csrf->generate(); ?>" /> <br>
		<input type="submit" value="Send">
	</form>
</html>
