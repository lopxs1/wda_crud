<?php 
	include("functions.php"); 
	view($_GET["id"]);
	if (!isset($_SESSION)) session_start();
	include(HEADER_TEMPLATE); 
?>

			<h2 class="mt-5">Imóvel <?php echo $customer['id']; ?></h2>
			<hr>

			<?php if (!empty($_SESSION["message"])) : ?>
			<div class="alert alert-<?php echo $_SESSION["type"]; ?>">
				<?php echo $_SESSION["message"] . "\n"; ?>
			</div>
			<?php endif; ?>

			<dl class="dl-horizontal">
				<dt>Nome do Proprietário:</dt>
				<dd><?php echo $customer['name']; ?></dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>Endereço:</dt>
				<dd><?php echo $customer['address']; ?></dd>

				<dt>Bairro:</dt>
				<dd><?php echo $customer['hood']; ?></dd>
				
				<dt>Cidade:</dt>
				<dd><?php echo $customer['city']; ?></dd>

				<dt>UF:</dt>
				<dd><?php echo $customer['state']; ?></dd>

				<dt>Descrição:</dt>
				<dd><?php echo $customer['descr']; ?></dd>

			</dl>

			<dl class="dl-horizontal">

			<dt>Foto:</dt>
			<dd>
			    <?php
					if(!empty($customer['photo'])) {
						echo "<img src=\"" . BASEURL . "imoveis/img/" . $customer['photo'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
					} else {
						echo "<img src=\"" . BASEURL . "img/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
					}
			    ?>
			</dd>

			</dl>

			<dl class="dl-horizontal">
				<dt>Data de Cadastro:</dt>
				<dd><?php echo formatadata($customer['created'], "d/m/Y - H:i:s"); ?></dd>
								
				<dt>Data de Alteração:</dt>
				<dd><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></dd>

			</dl>

			<div id="actions" class="row">
				<div class="col-md-12">
					<?php if (isset($_SESSION['user'])) : ?>
						<a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
					<?php endif; ?>
					<a href="index.php" class="btn btn-info text-light"><i class="fa-solid fa-xmark"></i> Voltar</a>
				</div>
			</div>

<?php include(FOOTER_TEMPLATE); ?>