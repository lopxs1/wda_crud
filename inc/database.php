<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function open_database() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
            $conn = new PDO($dsn, DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            throw new Exception("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    function close_database($conn) {
        $conn = null;
    }

    function find($table = null, $id = null) {
        $database = open_database();
        $found = null;

        try {
            if ($id) {
                $sql = "SELECT * FROM " . $table . " WHERE id = :id";
                $stmt = $database->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $found = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT * FROM " . $table;
                $stmt = $database->prepare($sql);
                $stmt->execute();
                $found = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }

        close_database($database);
        return $found;
    }

    function find_all($table) {
        return find($table);
    }

    function save($table = null, $data = null) {
        $database = open_database();

        $columns = implode(",", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO " . $table . " ($columns) VALUES ($placeholders)";

        try {
            $stmt = $database->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }

            $stmt->execute();

            $_SESSION['message'] = 'Registro cadastrado com sucesso.';
            $_SESSION['type'] = 'success';
        } catch (PDOException $e) {
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
        }

        close_database($database);
    }

    function update($table = null, $id = 0, $data = null) {
        $database = open_database();

        $items = [];
        foreach ($data as $key => $value) {
            $items[] = $key . " = :" . $key;
        }

        $items_str = implode(", ", $items);

        $sql = "UPDATE " . $table . " SET $items_str WHERE id = :id";

        try {
            $stmt = $database->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['message'] = 'Registro atualizado com sucesso.';
            $_SESSION['type'] = 'success';
        } catch (PDOException $e) {
            $_SESSION['message'] = 'Não foi possível realizar a operação.';
            $_SESSION['type'] = 'danger';
        }

        close_database($database);
    }

    function remove($table = null, $id = null) {
        $database = open_database();

        try {
            if ($id) {
                $sql = "DELETE FROM " . $table . " WHERE id = :id";
                $stmt = $database->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $_SESSION['message'] = "Registro removido com sucesso.";
                $_SESSION['type'] = 'success';
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        }

        close_database($database);
    }

    function telefone($dado) {
        return "(" . substr($dado, 0, 2) . ") " . substr($dado, 2, 5) . "-" .  substr($dado, 7, 4);    
    }

    function formatadata($data, $formato) {
        $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
        return $dt->format($formato);
    }

    function cep($cepdado) {
        return substr($cepdado, 0, 5) . "-" . substr($cepdado, 5, 3);        
    }

    function cpf($cpf_cnpj) {
        return substr($cpf_cnpj, 0, 9) . "-" . substr($cpf_cnpj, 9, 11);
    }

    function clear_messages() {
        $_SESSION['message'] = null;
        $_SESSION['type'] = null;
    }
?>
