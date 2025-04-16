<?php if (!isset($_SESSION)) session_start(); ?>
<?php if (isset($_SESSION['user'])) : ?>
	<?php 
		include("functions.php"); 
	
		if (isset($_GET['id'])){
			delete($_GET['id']);
		} else {
			die("ERRO: ID não definido.");
		}
	?>
<?php endif; ?>