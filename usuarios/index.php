<?php
require("functions.php");
require_once('../config.php');
index();
if (isset($_GET['pdf'])) {
    dPDF($_GET['pdf'] === "ok" ? null : $_GET['pdf']); 
    exit;
}
?>
<?php if (!isset($_SESSION)) session_start(); ?>

<?php include(HEADER_TEMPLATE); ?>
<?php if (isset($_SESSION['user'])) : ?>
	<?php if ($_SESSION['user'] == "admin") : ?>
		<header class="mt-5">
			<div class="row">
				<div class="col-sm-6">
					<h2>Usuários</h2>
				</div>
				<div class="col-sm-6 text-right h2">
					<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Usuário</a>
					<?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
						<a class="btn btn-danger" href="index.php?pdf=<?php echo $_POST['users']; ?>" target="_blank"><i class="fa-solid fa-file-pdf"></i> Listagem</a>
					<?php else : ?>
						<a class="btn btn-danger" href="index.php?pdf=ok" target="_blank"><i class="fa-solid fa-file-pdf"></i> Listagem</a>
					<?php endif ?>
					<a class="btn btn-info text-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
				</div>
			</div>
		</header>

		<form name="filter" action="index.php" method="post">
			<div class="row">
				<div class="form-group col-md-4">
					<div class="input-group mb-3">
						<input type="text" class="form-control" maxlenght="80" name="users" placeholder="Insira o nome" required>
						<button type="submit" class="btn btn-primary"><i class='fas fa-search'></i> Consultar</button>
					</div>
				</div>
			</div>
		</form>
		<?php if (!empty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
				<?php echo $_SESSION['message']; ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php clear_messages(); ?>
		<?php endif; ?>

		<hr>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th width="30%">Nome</th>
					<th>Usuário</th>
					<th>Foto</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($usuarios) : ?>
					<?php foreach ($usuarios as $usuario) : ?>
						<tr>
							<td align='center'><?php echo $usuario['id']; ?></td>
							<td><?php echo $usuario['nome']; ?></td>
							<td><?php echo $usuario['user']; ?></td>
							<td>
								<?php
								if (!empty($usuario['foto'])) {
									echo "<img src=\"" . BASEURL . "usuarios/img/" . $usuario['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
								} else {
									echo "<img src=\"" . BASEURL . "img/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
								}
								?>
							</td>
							<td class="actions text-right">
								<a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Visualizar</a>
								<a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-info text-light"><i class="fa fa-pencil"></i> Editar</a>
								<a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-user" data-usuario="<?php echo $usuario['id']; ?>">
									<i class="fa-solid fa-trash-can"></i> Excluir
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php endif; ?>
<?php else : ?>
	<div class="alert alert-danger mt-5" role="alert">
		<strong>Você não tem permissão para acessar está página.</strong>
		<a href="index.php" class="btn btn-danger text-light"><i class="fa-solid fa-xmark"></i> Voltar</a>
	</div>
<?php endif; ?>
<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>