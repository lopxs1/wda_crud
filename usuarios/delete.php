<?php if (!isset($_SESSION)) session_start(); ?>   
<?php if (isset($_SESSION['user'])) : ?>
	<?php if ($_SESSION['user'] == "admin") : ?> 
        <?php 
            require_once("functions.php");

            if (isset($_GET['id'])) {
                try {
                    // Verifica se o usuário existe no banco de dados
                    $usuario = find("usuarios", $_GET['id']);
                    if ($usuario) {
                        // Deleta o usuário e a foto
                        delete($_GET['id']);
                        if (!empty($usuario['foto']) && file_exists("fotos/" . $usuario['foto'])) {
                            unlink("fotos/" . $usuario['foto']);
                        }
                        $_SESSION['message'] = "Usuário excluído com sucesso!";
                        $_SESSION['type'] = "success";
                    } else {
                        throw new Exception("Usuário não encontrado.");
                    }
                } catch (Exception $e) {
                    $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
                    $_SESSION['type'] = "danger";
                }
            }
            header("Location: index.php"); // Redireciona para a página de listagem
            exit;
        ?>
    <?php endif; ?>
 <?php endif; ?>