<?php 
	include("functions.php"); 
	edit();
	if (!isset($_SESSION)) session_start();
	include(HEADER_TEMPLATE); 
	?>
	<?php if (isset($_SESSION['user'])) : ?>
			<h2 class="mt-5">Alterar Imóvel</h2>

			<form action="edit.php?id=<?php echo $customer['id']; ?>" method="post" enctype="multipart/form-data">
				<!-- area de campos do form -->
				<hr />
				<div class="row">
					<div class="form-group col-md-7">
						<label for="name">Proprietário</label>
						<input type="text" class="form-control" name="customer[name]" value="<?php echo $customer['name']; ?>">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-5">
						<label for="campo1">Endereço</label>
						<input type="text" class="form-control" name="customer[address]" value="<?php echo $customer['address']; ?>">
					</div>

					<div class="form-group col-md-3">
						<label for="campo2">Bairro</label>
						<input type="text" class="form-control" name="customer[hood]" value="<?php echo $customer['hood']; ?>">
					</div>

					<div class="form-group col-md-2">
						<label for="campo3">Descrição</label>
						<input type="text" class="form-control" name="customer[descr]" value="<?php echo $customer['descr']; ?>">
					</div>

					<div class="form-group col-md-2">
						<label for="campo3">Data de Cadastro</label>
						<input type="date" class="form-control" name="customer[created]" disabled value="<?php echo formatadata($customer['created'], "d/m/Y - H:i:s"); ?>">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-5">
						<label for="campo1">Município</label>
						<input type="text" class="form-control" name="customer[city]" value="<?php echo $customer['city']; ?>">
					</div>

					<div class="form-group col-md-1">
						<label for="campo3">UF</label>
						<input type="text" class="form-control" name="customer[state]" maxlength="2" minlength="2" value="<?php echo $customer['state']; ?>">
					</div>
				</div>

				<div class="row">
					<?php
						$photo = "";
						if (empty($customer['photo'])){
							$photo = "semimagem.jpg";
						} else {
							$photo = $customer['photo'];
						}
					?>
					<div class="form-group col-md-4">
					   <label for="campo1">Foto</label>
					   <input type="file" class="form-control" id="foto" name="photo" value="photos/<?php echo $photo ?>">
					</div>
				</div>
				<div class="form-group col-md-2">
				   <label for="pre">Pré-visualização:</label>
				   <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="<?php echo BASEURL . 'imoveis/img/' . $photo; ?>" alt="Foto do Proprietário">
				</div>

				<div id="actions" class="row mt-2">
					<div class="col-md-12">
					<button type="submit" class="btn btn-primary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
					<a href="index.php" class="btn btn-info text-light"><i class="fa-solid fa-xmark"></i> Cancelar</a>
					</div>
				</div>
			</form>
		<?php else : ?>
			<div class="alert alert-danger mt-5" role="alert">
			  	<strong>Você não tem permissão para acessar está página.</strong>
				<a href="index.php" class="btn btn-danger text-light"><i class="fa-solid fa-xmark"></i> Voltar</a>
			</div>
		<?php endif; ?>
<?php include(FOOTER_TEMPLATE); ?>

<script>
	$(document).ready(() => {
		$("#foto").change(function () {
			const file = this.files[0];
			if (file) {
				let reader = new FileReader();
				reader.onload = function (event) {
					$("#imgPreview").attr("src", event.target.result);
				};
				reader.readAsDataURL(file);
			}
		});
	});
</script>