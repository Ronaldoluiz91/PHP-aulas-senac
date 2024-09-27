<?php
class ACERVO
{
    private $addCategoria;
    private $addGenero;
    private $addEtaria;
    private $addTitulo;

    private $genero;
    private $categoria;
    private $etaria;

    private $loginValido;



    public function setAddCategoria(string $addCategoria)
    {
        $this->addCategoria = $addCategoria;
    }
    public function getAddCategoria()
    {
        return $this->addCategoria;
    }

    public function setAddGenero(string $addGenero)
    {
        $this->addGenero = $addGenero;
    }
    public function getAddGenero()
    {
        return $this->addGenero;
    }

    public function setAddEtaria(string $addEtaria)
    {
        $this->addEtaria = $addEtaria;
    }
    public function getAddEtaria()
    {
        return $this->addEtaria;
    }

    public function setAddTitulo(string $addTitulo)
    {
        $this->addTitulo = $addTitulo;
    }
    public function getAddTitulo()
    {
        return $this->addTitulo;
    }

    public function setGenero(string $genero)
    {
        $this->genero = $genero;
    }
    public function getGenero()
    {
        return $this->genero;
    }

    public function setCategoria(string $categoria)
    {
        $this->categoria = $categoria;
    }
    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setEtaria(string $etaria)
    {
        $this->etaria = $etaria;
    }
    public function getEtaria()
    {
        return $this->etaria;
    }

    public function setLoginValido(string $loginValido)
    {
        $this->loginValido = $loginValido;
    }
    public function getLoginValido()
    {
        return $this->loginValido;
    }

    public function AddCategoria(string $fxCad)
    {
        require  "../config/db/conn.php";

        $sql = "SELECT * FROM tbl_categoria WHERE descricao = :addCategoria ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':addCategoria', $this->addCategoria);
        $stmt->execute();

        $categoriaDB = "";

        //Busca o resultado da consulta 
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categoriaDB = $row['descricao'];
        }

        if ($categoriaDB === $this->addCategoria) {
            $result = [
                'status' => false,
                'msg' => "Categoria ja cadastrada",
                'Categoria' => $this->addCategoria,
            ];
        } else {
            $insertSql = "INSERT INTO tbl_categoria (idCategoria, descricao) 
          VALUES (null, :descricao)";
            $insertStmt = $conn->prepare($insertSql);

            // Executa a inserção
            $insertStmt->execute([
                ':descricao' => $this->addCategoria,
            ]);

            $result = [
                'status' => true,
                'msg' => "Cadastro realizado com sucesso",
            ];
        }

        return $this->fxCad = $result;
    }

    public function addGenero(string $fxCad)
    {
        require  "../config/db/conn.php";

        $sql = "SELECT * FROM tbl_genero WHERE descricao = :addGenero ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':addGenero', $this->addGenero);
        $stmt->execute();

        $generoDB = "";

        //Busca o resultado da consulta 
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $generoDB = $row['descricao'];
        }

        if ($generoDB === $this->addGenero) {
            $result = [
                'status' => false,
                'msg' => "Genero ja cadastrado",
                'Categoria' => $this->addGenero,
            ];
        } else {
            $insertSql = "INSERT INTO tbl_genero (idGenero, descricao) 
          VALUES (null, :descricao)";
            $insertStmt = $conn->prepare($insertSql);

            // Executa a inserção
            $insertStmt->execute([
                ':descricao' => $this->addGenero,
            ]);

            $result = [
                'status' => true,
                'msg' => "Cadastro realizado com sucesso",
            ];
        }

        return $this->fxCad = $result;
    }

    public function addEtaria(string $fxCad)
    {
        require  "../config/db/conn.php";

        $sql = "SELECT * FROM tbl_etaria WHERE descricao = :addEtaria ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':addEtaria', $this->addEtaria);
        $stmt->execute();

        $etariaDB = "";

        //Busca o resultado da consulta 
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $etariaDB = $row['descricao'];
        }

        if ($etariaDB === $this->addEtaria) {
            $result = [
                'status' => false,
                'msg' => "Faixa etaria ja cadastrado",
            ];
        } else {
            $insertSql = "INSERT INTO tbl_etaria (idEtaria, descricao) 
          VALUES (null, :descricao)";
            $insertStmt = $conn->prepare($insertSql);

            // Executa a inserção
            $insertStmt->execute([
                ':descricao' => $this->addEtaria,
            ]);

            $result = [
                'status' => true,
                'msg' => "Cadastro realizado com sucesso",
            ];
        }
    }

    public function addTitulo(string $fxCad)
    {
        require  "../config/db/conn.php";

        // Verifica se o título já está cadastrado
        $sql = "SELECT * FROM tbl_acervo WHERE Titulo = :addTitulo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':addTitulo', $this->addTitulo);
        $stmt->execute();

        $tituloDB = "";

        // Busca o resultado da consulta 
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tituloDB = $row['Titulo'];
        } 
        
        if($tituloDB === $this->addTitulo)
        {
              $result = [
                'status' => false,
                'msg' => "Título já cadastrado",
            ];
        } else {

            // Verifica se o usuário está logado
            $sql = "SELECT * FROM tbl_login WHERE nome = :loginValido OR email = :loginValido";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':loginValido', $this->loginValido);
            $stmt->execute();

            // Busca o resultado da consulta 
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->loginValido = $row['idLogin'];


                // Prepara sua consulta SQL para inserir na tabela
                $insertSql = "INSERT INTO tbl_acervo (idAcervo, Titulo, FK_idGenero, FK_idCategoria, FK_idEtaria, Fk_idLogin) 
                      VALUES (null, :titulo, :genero, :categoria, :etaria, :login)";
                $insertStmt = $conn->prepare($insertSql);

                // Executa a inserção
                $insertStmt->execute([
                    ':titulo' => $this->addTitulo,
                    ':genero' => $this->genero,
                    ':categoria' => $this->categoria,
                    ':etaria' => $this->etaria,
                    ':login' => $this->loginValido,
                ]);

                $result = [
                    'status' => true,
                    'msg' => "Cadastro realizado com sucesso",
                ];
            } else {
                $result = [
                    'status' => false,
                    'msg' => "Você precisa estar logado para cadastrar.",
                ];
            }
        }

        return $this->fxCad = $result;
        

    }
}
