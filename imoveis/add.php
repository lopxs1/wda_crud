<?php 
	include("functions.php"); 
	add();
	if (!isset($_SESSION)) session_start();
	include(HEADER_TEMPLATE); 
?>
	<?php if (isset($_SESSION['user'])) : ?>
		<h2 class="mt-5">Novo Imóvel</h2>
		<form action="add.php" method="post" enctype="multipart/form-data">
			<!-- area de campos do form -->
			<hr />
			<div class="row">
				<div class="form-group col-md-7">
					<label for="name">Proprietário</label>
					<input type="text" class="form-control" name="customer[name]">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-5">
					<label for="campo1">Endereço</label>
					<input type="text" class="form-control" name="customer[address]">
				</div>
				<div class="form-group col-md-3">
					<label for="campo2">Bairro</label>
					<input type="text" class="form-control" name="customer[hood]">
				</div>
				<div class="form-group col-md-2">
					<label for="campo3">Data de Cadastro</label>
					<input type="date" class="form-control" name="customer[created]" disabled>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-5">
					<label for="campo1">Município</label>
					<input type="text" class="form-control" name="customer[city]">
				</div>
				<div class="form-group col-md-1">
					<label for="campo3">UF</label>
					<input type="text" class="form-control" name="customer[state]" maxlength="2" minlength="2">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<label for="campo3">Descrição</label>
					<input type="text" class="form-control" name="customer[descr]">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
   					<label for="campo1">Foto</label>
   					<input type="file" class="form-control" id="foto" name="photo">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
                    <label for="imgPreview">Pré-visualização:</label><br>
                    <img src="../img/semimagem.jpg" class="shadow p-2 mb-2 bg-body rounded" id="imgPreview" width="200px" alt="Foto do proprietário">
                </div>
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
