<?php 
	include("functions.php"); 
	edit();
	if (!isset($_SESSION)) session_start();
	include(HEADER_TEMPLATE);
?>
	<?php if (isset($_SESSION['user'])) : ?>
		<?php if ($_SESSION['user'] == "admin") : ?>
			<header>
				<h2>Atualizar Usuário</h2>
			</header>

			<form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data" >
			<hr>
				<div class="row">
					<div class="form-group col-md-8">
					   <label for="name">Nome</label>
					   <input type="text" class="form-control" name="usuario[nome]" value="<?php echo $usuario['nome']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
					   <label for="campo2">Usuário (Login)</label>
					   <input type="text" class="form-control" name="usuario[user]" value="<?php echo $usuario['user']; ?>">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4">
					   <label for="name">Senha</label>
					   <input type="password" class="form-control" name="usuario[password]" value="">
					</div>
				</div>
				<div class="row">
					<?php
						$foto = "";
						if (empty($usuario['foto'])){
							$foto = "semimagem.jpg";
						} else {
							$foto = $usuario['foto'];
						}
					?>
					<div class="form-group col-md-4">
					   <label for="campo1">Foto</label>
					   <input type="file" class="form-control" id="foto" name="foto" value="fotos/<?php echo $foto ?>">
					</div>
				</div>
					<div class="form-group col-md-2">
					   <label for="pre">Pré-visualização:</label>
					   <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="<?php echo BASEURL . 'usuarios/img/' . $foto; ?>" alt="Foto do usuário">
					</div>
				</div>
					
				<div id="actions" class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
						<a href="index.php" class="btn btn-info text-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
					</div>
				</div>
			</form>
		<?php endif; ?>
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

