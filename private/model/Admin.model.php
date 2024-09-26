<?php
class ACERVO
{
    private $addCategoria;
    private $addGenero;
    private $addEtaria;
    private $addTitulo;



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

        return $this->fxCad = $result;
    }

    public function addTitulo (string $fxCad)
    {

    }
}
