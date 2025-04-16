<?php 
	include("functions.php"); 
	add();
    if (!isset($_SESSION)) session_start();
	include(HEADER_TEMPLATE);
?>
<?php if (isset($_SESSION['user'])) : ?>
    <h2 class="mt-5">Novo Cliente</h2>

    <form action="add.php" method="post">
        <!-- Área de campos do formulário -->
        <hr />
        <div class="row">
            <div class="form-group col-md-7">
                <label for="name">Nome / Razão Social</label>
                <input type="text" class="form-control" name="customer[name]">
            </div>

            <div class="form-group col-md-3">
                <label for="campo2">CNPJ / CPF</label>
                <input type="text" class="form-control" name="customer[cpf_cnpj]" maxlength="11" minlength="11" placeholder="Insira apenas números">
            </div>

            <div class="form-group col-md-2">
                <label for="campo3">Data de Nascimento</label>
                <input type="date" class="form-control" name="customer[birthdate]">
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
                <label for="campo3">CEP</label>
                <input type="text" class="form-control" name="customer[zip_code]" maxlength="8" minlength="8" placeholder="Insira apenas números">
            </div>

            <div class="form-group col-md-2">
                <label for="campo3">Data de Cadastro</label>
                <input type="text" class="form-control" name="customer[created]" disabled>
            </div>
        </div>
    
        <div class="row">
            <div class="form-group col-md-5">
                <label for="campo1">Município</label>
                <input type="text" class="form-control" name="customer[city]">
            </div>

            <div class="form-group col-md-2">
                <label for="campo2">Telefone</label>
                <input type="tel" class="form-control" name="customer[phone]" maxlength="10" minlength="10" placeholder="Insira apenas números">
            </div>

            <div class="form-group col-md-2">
                <label for="campo3">Celular</label>
                <input type="tel" class="form-control" name="customer[mobile]" maxlength="11" minlength="11" placeholder="Insira apenas números">
            </div>

            <div class="form-group col-md-1">
                <label for="campo3">UF</label>
                <input type="text" class="form-control" name="customer[state]" maxlength="2" minlength="2">
            </div>

            <div class="form-group col-md-2">
                <label for="campo3">Inscrição Estadual</label>
                <input type="text" class="form-control" name="customer[ie]" maxlength="9" minlength="9" placeholder="Insira apenas números">
            </div>
        </div>
    
        <div id="actions" class="row mt-3">
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
