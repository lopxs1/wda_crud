<?php

	include("../config.php");
	include(DBAPI);

	$customers = null;
	$customer = null;

	/**
	 *  Listagem de Clientes
	 */

    function index() {
    global $imoveis;
    if (!empty($_POST['users'])) {
        $imoveis = filter($_POST['users']);
    } else {
        $imoveis = find_all("imoveis");
    }
}

	function filter($searchTerm) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    $searchTerm = trim($conn->real_escape_string($searchTerm));
    $query = "SELECT * FROM imoveis WHERE name LIKE '%$searchTerm%'";
    $result = $conn->query($query);

    if (!$result) {
        die("Erro na consulta: " . $conn->error);
    }

    $data = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();

    return $data;
}

	/**
	*	Atualizacao/Edicao de imovel
	*/
	function edit() {

		$now = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));

		if (isset($_GET['id'])) {

			$id = $_GET['id'];

			if (isset($_POST['customer'])) {

				$customer = $_POST['customer'];
				$customer['modified'] = $now->format("Y-m-d H:i:s");

				if (!empty($_FILES["photo"]["name"])) {
					$pasta_destino = "img/";
					$nomearquivo = basename($_FILES["photo"]["name"]);
					$arquivo_destino = $pasta_destino . $nomearquivo;
					$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
					if (!in_array($tipo_arquivo, ['jpg', 'jpeg', 'png', 'gif'])) {
						throw new Exception("Somente imagens JPG, PNG e GIF são permitidas.");
					}
					if ($_FILES["photo"]["size"] > 5000000) {
						throw new Exception("O arquivo enviado é muito grande. O limite é 5MB.");
					}
					if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $arquivo_destino)) {
						throw new Exception("Erro ao enviar a foto para o servidor.");
					}
					$customer['photo'] = $nomearquivo;
				}

				update('imoveis', $id, $customer);
				header('location: index.php');
			} else {

				global $customer;
				$customer = find('imoveis', $id);
			} 
		} else {
			header('location: index.php');
		}
	}
	
	/**
	*  Cadastro de imoveis
	*/
	function add() {
		if (!empty($_POST['customer'])) {
			try {
				$customer = $_POST['customer'];
				$nomearquivo = '';

				$today = 
				new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
				$customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
	
				// Verifica upload de imagem
				if (!empty($_FILES["photo"]["name"])) {
					$pasta_destino = "img/";
					$arquivo_destino = $pasta_destino . basename($_FILES["photo"]["name"]);
					$nomearquivo = basename($_FILES["photo"]["name"]);
					$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
					$tamanho_arquivo = $_FILES["photo"]["size"];
	
					upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $_FILES["photo"]["tmp_name"], $tamanho_arquivo);
					$customer['photo'] = $nomearquivo;
				}
	
				save('imoveis', $customer);
				header('location: index.php');
			} catch (Exception $e) {
				$_SESSION['message'] = "Erro: " . $e->getMessage();
				$_SESSION['type'] = "danger";
			}
		}
	}

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
				if(move_uploaded_file($_FILES["photo"] ["tmp_name"], $arquivo_destino)) {
					$_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
					$_SESSION['type'] = "success";
				} else { 
					throw new Exception("Desculpe, o arquivo não pode ser enviado!");
				}
			}
		} catch (Exception $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->GetMessage();
			$_SESSION['type'] = "danger";
		}
	}
	
	/**
	*  Visualização de um imovel
	*/
	function view($id = null) {
		global $customer;
		$customer = find("imoveis", $id);
	}
	/**
	 *  Exclusão de um Cliente
	 */
	function delete($id = null) {

		global $customer;
		$customer = remove('imoveis', $id);

		header('location: index.php');
	}

	function cortarTexto($pdf, $texto, $larguraMax) 
	{
		$textoConvertido = $pdf->converteTexto($texto);
		$tamanhoTexto = $pdf->GetStringWidth($textoConvertido);
		if ($tamanhoTexto <= $larguraMax) {
			return $textoConvertido;
		} else {
			while ($pdf->GetStringWidth($textoConvertido . '...') > $larguraMax && strlen($textoConvertido) > 0) {
				$textoConvertido = substr($textoConvertido, 0, -1);
			}
			return $textoConvertido . '...';
		}
	}	

	function dPDF($p = null)
	{
    require_once '../inc/pdf.php';

	$pdf = new PDF('L');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);

	$altura = 30;

	$pdf->Cell(10, 10, $pdf->converteTexto('ID'), 1);
	$pdf->Cell(50, 10, $pdf->converteTexto('Endereço'), 1);
	$pdf->Cell(40, 10, $pdf->converteTexto('Bairro'), 1);
	$pdf->Cell(25, 10, $pdf->converteTexto('Cidade'), 1);
	$pdf->Cell(120, 10, $pdf->converteTexto('Descrição'), 1);
	$pdf->Cell(30, 10, $pdf->converteTexto('Foto'), 1);
	$pdf->Ln();

	$imoveis = null;
	if ($p) {
		$imoveis = filter($p);
	} else {
		$imoveis = find_all("imoveis");
	}

	foreach ($imoveis as $imovel) {
		$pdf->Cell(10, $altura, cortarTexto($pdf, $imovel['id'], 10), 1);
		$pdf->Cell(50, $altura, cortarTexto($pdf, $imovel['address'], 50), 1);
		$pdf->Cell(40, $altura, cortarTexto($pdf, $imovel['hood'], 37), 1);
		$pdf->Cell(25, $altura, cortarTexto($pdf, $imovel['city'], 25), 1);
		$pdf->Cell(120, $altura, cortarTexto($pdf, $imovel['descr'], 120), 1);

		$x = $pdf->GetX();
		$y = $pdf->GetY();

		$pdf->Cell(30, $altura, '', 1);

		$foto = !empty($imovel['photo']) ? __DIR__ . "/img/" . $imovel['photo'] : __DIR__ . "/../img/semimagem.jpg";

		if (file_exists($foto)) {
			$pdf->Image($foto, $x + 2, $y + 2, 26, 26);
		}

		$pdf->Ln();
	}

	$pdf->Output();


	}
	
?>