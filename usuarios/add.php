<?php 
    if (!isset($_SESSION)) session_start();
    include("functions.php"); 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        add();
    }
    include(HEADER_TEMPLATE); 
?>
    <?php if (isset($_SESSION['user'])) : ?>
        <?php if ($_SESSION['user'] == "admin") : ?>
            <h2 class="mt-5">Novo Usuário</h2>

            <form action="add.php" method="post" enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr />
                <div class="form-group col-md-7">
                    <label for="name">Nome / Razão Social</label>
                    <input type="text" class="form-control" id="name" maxlength="50" name="usuario[nome]">
                </div>
                <div class="form-group col-md-5">
                    <label for="user">Login</label>
                    <input type="text" class="form-control" id="usuario" maxlength="50" name="usuario[user]">
                </div>
                <div class="form-group col-md-5">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" id="senha" maxlength="50" name="usuario[password]">
                </div>
                <div class="row">
                    <div class="form-group col-md-12 mb-2">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="imgPreview">Pré-visualização:</label><br>
                    <img src="../img/semimagem.jpg" class="shadow p-2 mb-2 bg-body rounded" id="imgPreview" width="200px" alt="Foto do usuário">
                </div>

                <div id="actions" class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                        <a href="index.php" class="btn btn-info text-light"><i class="fa-solid fa-xmark"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        <?php endif;?>
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
