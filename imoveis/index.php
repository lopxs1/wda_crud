			<?php
				include("functions.php");
				index();
				if (!isset($_SESSION)) session_start();
			?>

			<?php include(HEADER_TEMPLATE); ?>

			<header class="mt-2">
				<div class="row mt-5">
					<div class="col-sm-6">
						<h2>Imóveis</h2>
					</div>
					<div class="col-sm-6 text-end h2">
					<?php if (isset($_SESSION['user'])) : ?>
						<a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Imóvel</a>
					<?php endif; ?>
						<a class="btn btn-info text-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
					</div>
				</div>
			</header>

			<?php if (!empty($_SESSION['message'])) : ?>
				<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
					<?php echo $_SESSION['message']; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php //clear_messages(); ?>

			<?php endif; ?>

			<hr>

            <form name="filtro" action="index.php" method="post">
				<div class="row">
					<div class="form-group col-md-4">
						<div class="input-group mb-3">
							<input type="text" class="form-control" maxlenght="80" name="users" placeholder="Insira o nome do proprietário" required>
							<button type="submit" class="btn btn-primary"><i class='fas fa-search'></i> Consultar</button>
						</div>
					</div>
				</div>
			</form>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Proprietário</th>
						<th>Endereço</th>
						<th>Cidade</th>
						<th>Estado</th>
						<th>Foto</th>
						<th>Atualizado em</th>
						<th>Opções</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($imoveis) : ?>
					<?php foreach ($imoveis as $customer) : ?>
					<tr>
						<td><?php echo $customer['id']; ?></td>
						<td><?php echo $customer['name']; ?></td>
						<td><?php echo $customer['address']; ?></td>
						<td><?php echo $customer['city']; ?></td>
						<td><?php echo $customer['state']; ?></td>
						<td>
						    <?php 
						        if(!empty($customer['photo'])) {
						            echo "<img src=\"" . BASEURL . "imoveis/img/" . $customer['photo'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
						        } else {
						            echo "<img src=\"" . BASEURL . "img/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"100px\">";
						        }
						    ?>
						</td>
						<?php $data = new Datetime ($customer['modified'],
								new DateTimeZone("America/Sao_Paulo")); ?>
						<td><?php echo $data->format("d/m/Y - H:i:s"); ?></td>
						<td class="actions text-right">
						<a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Visualizar</a>
						<?php if (isset($_SESSION['user'])) : ?>
							<a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-info text-light"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
							<a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $customer['id']; ?>">
								<i class="fa fa-trash"></i> Excluir
							</a>
						<?php endif; ?>
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
		<?php include('modal.php'); ?>


<?php include(FOOTER_TEMPLATE); ?>