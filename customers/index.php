<?php
    include("functions.php");
    index();
    if (!isset($_SESSION)) session_start();
?>

<?php include(HEADER_TEMPLATE); ?>

<header class="mt-2">
    <div class="row mt-5">
        <div class="col-sm-6">
            <h2>Clientes</h2>
        </div>
        <div class="col-sm-6 text-end h2">
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Cliente</a>
            <?php endif; ?>
            <a class="btn btn-info text-light" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<hr>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th width="30%">Nome</th>
                <th>CPF/CNPJ</th>
                <th>Telefone</th>
                <th>Atualizado em</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($customers) : ?>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?php echo $customer['id']; ?></td>
                        <td><?php echo $customer['name']; ?></td>
                        <td><?php echo $customer['cpf_cnpj']; ?></td>
                        <td><?php echo telefone($customer['phone']); ?></td>
                        <td><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></td>
                        <td class="actions text-end">
                            <a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Visualizar</a>
                            <?php if (isset($_SESSION['user'])) : ?>
                                <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-info text-light"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-cliente" data-customer="<?php echo $customer['id']; ?>">
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
</div>

<?php include('modal.php'); ?>

<?php include(FOOTER_TEMPLATE); ?>
