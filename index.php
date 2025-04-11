<?php include 'config.php'; ?>
<?php include DBAPI; ?>
<?php if (!isset($_SESSION)) session_start(); ?>
<?php include(HEADER_TEMPLATE); ?>
<?php 
	$erro = "";
	try{
		$db = open_database();
	} catch (Exception $e){
		$erro = $e->getMessage();
	}
?>

<?php
    function clearmessages(){
        if (isset($_SESSION['message'])) {
            unset($_SESSION['message']);
        }
        if (isset($_SESSION['type'])) {
            unset($_SESSION['type']);
        }
    }
?>
		</main>
			<section class="cta container-fluid">
				<h1 style="color: #ffffff" class="text-center p-8"></h1>
			</section>
		<main class="container">
			<h1 class="mt-3 text-center">Gerenciamento</h1>
			<hr>

			<?php if ($db) : ?>

			<div class="row">
				<h4>Clientes</h4>
				<?php if (isset($_SESSION['user'])) : ?>
					<div class="col-xs-6 col-sm-3 col-md-2">
						<a href="customers/add.php" class="btn btn-primary">
							<div class="row">
								<div class="col-xs-12 text-center">
									<i class="fa-solid fa-user-plus fa-5x"></i> 
								</div>
								<div class="col-xs-12 text-center">
									<p>Novo Cliente</p>
								</div>
							</div>
						</a>
					</div>
				<?php endif; ?>
				<div class="col-xs-6 col-sm-3 col-md-2">
					<a href="customers" class="btn btn-info text-light">
						<div class="row">
							<div class="col-xs-12 text-center">
								<i class="fa-solid fa-users fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center">
								<p>Clientes</p>
							</div>
						</div>
					</a>
				</div>
			</div>
			<hr>
			<div class="row" id="actions">
				<h4>Imóveis</h4>
				<?php if (isset($_SESSION['user'])) : ?>
					<div class="col-xs-6 col-sm-3 col-md-2">
						<a href="imoveis/add.php" class="btn btn-primary">
							<div class="row">
								<div class="col-xs-12 text-center text-light">
									<i class="fa-solid fa-folder-plus fa-5x"></i>
								</div>
								<div class="col-xs-12 text-center text-light">
									<p>Novo Imóvel</p>
								</div>
							</div>
						</a>
					</div>
				<?php endif; ?>
				<div class="col-xs-6 col-sm-3 col-md-2">
					<a href="imoveis" class="btn btn-info">
						<div class="row">
							<div class="col-xs-12 text-center text-light">
								<i class="fa-solid fa-house-user fa-5x"></i>
							</div>
							<div class="col-xs-12 text-center text-light">
								<p>Imóveis</p>
							</div>
						</div>
					</a>
				</div>
			</div>
			<?php if (isset($_SESSION['user'])) :  ?>
				<?php if ($_SESSION['user'] == "admin") : ?>	
					<hr>
					<div class="row">
						<h4>Usuários</h4>
						<div class="col-xs-6 col-sm-3 col-md-2">
							<a href="usuarios/add.php" class="btn btn-primary">
								<div class="row">
									<div class="col-xs-12 text-center text-light">
										<i class="fa-solid fa-user-plus fa-5x"></i>
									</div>
									<div class="col-xs-12 text-center text-light">
										<p>Novo Usuário</p>
									</div>
								</div>
							</a>
						</div>
						<div class="col-xs-6 col-sm-3 col-md-2">
							<a href="usuarios" class="btn btn-info">
								<div class="row">
									<div class="col-xs-12 text-center text-light">
										<i class="fa-solid fa-users fa-5x"></i>
									</div>
									<div class="col-xs-12 text-center text-light">
										<p>Usuários</p>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<?php else : ?>
				//<div class="alert alert-danger" role="alert">
					//<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
				//</div>
				<?php if (!empty($_SESSION['message'])) : ?>
					<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dimissible" role="alert">
						<p><strong>ERRO:</strong> Não foi possível conectar ao Banco de Dados!<br>
						<?php echo $_SESSION['message']; ?></p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php clear_messages(); ?>
			<?php endif; ?>
		<?php endif; ?>
<?php include(FOOTER_TEMPLATE); ?>