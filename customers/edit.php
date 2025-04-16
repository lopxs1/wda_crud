<?php 
	include("functions.php"); 
	edit();
    if (!isset($_SESSION)) session_start();
	include(HEADER_TEMPLATE);
?>
<?php if (isset($_SESSION['user'])) : ?>
    <header>
        <h2 class="mt-5">Atualizar Cliente</h2>
    </header>
    
    <form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
        <hr />
        <!-- Nome / Razão Social, CNPJ / CPF, Data de Nascimento -->
        <div class="row">
            <div class="form-group col-md-7">
                <label for="name">Nome / Razão Social</label>
                <input type="text" class="form-control" name="customer[name]" value="<?php echo $customer['name']; ?>">
            </div>
    
            <div class="form-group col-md-3">
                <label for="campo2">CNPJ / CPF</label>
                <input type="text" class="form-control" name="customer[cpf_cnpj]" maxlength="11" minlength="11" value="<?php echo $customer['cpf_cnpj']; ?>">
            </div>
    
            <div class="form-group col-md-2">
                <label for="campo3">Data de Nascimento</label>
                <input type="date" class="form-control" name="customer[birthdate]" value="<?php echo formatadata($customer['birthdate'], "Y-m-d"); ?>">
            </div>
        </div>
    
        <!-- Endereço, Bairro, CEP, Data de Cadastro -->
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
                <label for="campo3">CEP</label>
                <input type="text" class="form-control" name="customer[zip_code]" maxlength="8" minlength="8" value="<?php echo $customer['zip_code']; ?>">
            </div>
    
            <div class="form-group col-md-2">
                <label for="campo3">Data de Cadastro</label>
                <input type="text" class="form-control" name="customer[created]" disabled value="<?php echo formatadata($customer['created'], "d/m/Y - H:i:s"); ?>">
            </div>
        </div>
    
        <!-- Município, Telefone, Celular, UF, Inscrição Estadual -->
        <div class="row">
            <div class="form-group col-md-5">
                <label for="campo1">Município</label>
                <input type="text" class="form-control" name="customer[city]" value="<?php echo $customer['city']; ?>">
            </div>
    
            <div class="form-group col-md-2">
                <label for="campo2">Telefone</label>
                <input type="tel" class="form-control" name="customer[phone]" value="<?php echo $customer['phone']; ?>">
            </div>
    
            <div class="form-group col-md-2">
                <label for="campo3">Celular</label>
                <input type="tel" class="form-control" name="customer[mobile]" value="<?php echo $customer['mobile']; ?>">
            </div>
    
            <div class="form-group col-md-1">
                <label for="campo3">UF</label>
                <input type="text" class="form-control" name="customer[state]" maxlength="2" minlength="2" value="<?php echo $customer['state']; ?>">
            </div>
    
            <div class="form-group col-md-2">
                <label for="campo3">Inscrição Estadual</label>
                <input type="text" class="form-control" name="customer[ie]" maxlength="9" minlength="9" value="<?php echo $customer['ie']; ?>">
            </div>
        </div>
    
        <!-- Ações -->
        <div id="actions" class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                <a href="index.php" class="btn btn-info text-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
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
