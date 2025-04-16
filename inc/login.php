<?php
    session_start(); // Sempre inicie a sessão no início do arquivo
    include ("../config.php");
    include (HEADER_TEMPLATE);
?>

<!-- Exibir a mensagem de erro caso exista -->
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible mt-2" role="alert" id="actions">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); // Limpa a mensagem após exibição ?>
<?php endif; ?>

<div id="actions" class="mt-4 mb-5">
    <form action="valida.php" method="post">
        <div class="row">
            <!-- User input -->
            <div class="form-floating col-12 mb-2 p-1">
                <input type="text" class="form-control" id="log" placeholder="Usuário" name="login" required>    
                <label for="log">Usuário</label>
            </div>
            <!-- Password Input -->
            <div class="form-floating col-12 mb-2 p-1">
                <input type="password" class="form-control" id="pass" placeholder="Senha" name="senha" required>
                <label for="pass">Senha</label>
            </div>
            <!-- Submit button -->
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-primary btn-block mb-4"><i class="fa-solid fa-user-check"></i> Conectar</button>
                <a href="<?php echo BASEURL; ?>" class="btn btn-info text-light btn-block mb-4"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
            </div>
        </div>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
