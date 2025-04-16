<?php
require_once('../config.php');
require_once(DBAPI);

$usuario = null;
$usuarios = null;

/* Filtragem de usuários */
function filter($searchTerm) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $searchTerm = trim($conn->real_escape_string($searchTerm)); // Sanitiza o termo de busca
    $query = "SELECT * FROM usuarios WHERE nome LIKE '%$searchTerm%'";
    $result = $conn->query($query);

    if (!$result) {
        die("Erro na consulta: " . $conn->error);
    }

    $data = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();

    return $data;
}

/* Lista de usuários */
function index() {
    global $usuarios;
    if (!empty($_POST['users'])) {
        $usuarios = filter($_POST['users']);
    } else {
        $usuarios = find_all("usuarios");
    }
}

/* Hash de senha */
function hashSenha($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
}

/* Verificação de senha */
function verificarSenha($senha, $hash) {
    return password_verify($senha, $hash);
}

/* Cadastro de usuários */
function add() {
    if (!empty($_POST['usuario'])) {
        try {
            $usuario = $_POST['usuario'];
            $nomearquivo = '';

            // Verifica upload de imagem
            if (!empty($_FILES["foto"]["name"])) {
                $pasta_destino = "img/";
                $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                $nomearquivo = basename($_FILES["foto"]["name"]);
                $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
                $tamanho_arquivo = $_FILES["foto"]["size"];

                upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $_FILES["foto"]["tmp_name"], $tamanho_arquivo);
                $usuario['foto'] = $nomearquivo;
            }

            // Hash da senha
            if (!empty($usuario['password'])) {
                $usuario['password'] = hashSenha($usuario['password']);
            }

            save('usuarios', $usuario);
            header('location: index.php');
        } catch (Exception $e) {
            $_SESSION['message'] = "Erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }
}

/* Upload de imagens */
function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
	try {
		 $nomearquivo = basename($arquivo_destino);
		 $uploadOk = 1;
		 
		if(isset($_POST["submit"])) {
			$check = getimagesize($nome_temp);
			if($check !== false) {
				$_SESSION['message'] = "File is an image - " . $check["mime"] . ".";
				$_SESSION['type'] = "info";
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
				throw new Exception("O arquivo não é uma imagem!");
			}
		}
		
		if(file_exists($arquivo_destino)) {
			$uploadOk = 0;
			throw new Exception("Desculpe, o arquivo já existe!");
		}
		
		if($tamanho_arquivo > 5000000) {
			$uploadOk = 0;
			throw new Exception("Desculpe, o arquivo é muito grande!");
		}
		
		if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif")  {
			$uploadOk = 0;
			throw new Exception("Desculpe, só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!");
		}
		
		if($uploadOk == 0) {
			throw new Exception("Desculpe, o arquivo não pode ser enviado!");
		} else {
			if(move_uploaded_file($_FILES["foto"] ["tmp_name"], $arquivo_destino)) {
				$_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
				$_SESSION['type'] = "success";
			} else { 
				throw new Exception("Desculpe, o arquivo não pode ser enviado!");
			}
		}
	} catch (Exeception $e) {
		$_SESSION['message'] = "Aconteceu um erro: " . $e->GetMessage();
		$_SESSION['type'] = "danger";
	}
}

/* Atualização de usuários */
function edit() {
    try {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if (isset($_POST['usuario'])) {
                $usuario = $_POST['usuario'];

                // Verifica se uma nova senha foi fornecida
                if (!empty($usuario['password'])) {
                    $usuario['password'] = hashSenha($usuario['password']);
                } else {
                    unset($usuario['password']); // Evita sobrescrever o hash se não houver nova senha
                }

                // Verifica upload de imagem
                if (!empty($_FILES["foto"]["name"])) {
                    $pasta_destino = "img/";
                    $nomearquivo = basename($_FILES["foto"]["name"]);
                    $arquivo_destino = $pasta_destino . $nomearquivo;
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

                    if (!in_array($tipo_arquivo, ['jpg', 'jpeg', 'png', 'gif'])) {
                        throw new Exception("Somente imagens JPG, PNG e GIF são permitidas.");
                    }

                    if ($_FILES["foto"]["size"] > 5000000) {
                        throw new Exception("O arquivo enviado é muito grande. O limite é 5MB.");
                    }

                    if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $arquivo_destino)) {
                        throw new Exception("Erro ao enviar a foto para o servidor.");
                    }

                    $usuario['foto'] = $nomearquivo;
                }

                update('usuarios', $id, $usuario);
                $_SESSION['message'] = "Usuário atualizado com sucesso!";
                header('Location: index.php');
                exit;
            } else {
                global $usuario;
                $usuario = find("usuarios", $id);
            }
        } else {
            header("Location: index.php");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

/* Visualização de usuário */
function view($id = null) {
    global $usuario;
    $usuario = find("usuarios", $id);
}

/* Exclusão de usuário */
function delete($id = null) {
    global $usuario;
    $usuario = remove("usuarios", $id);
    header("location: index.php");
}
?>
