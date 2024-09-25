<?php
class ACERVO
{
    private $addCategoria;
    private $addGenero;


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

public function AddCategorias(string $fxCad){
$result = [
                'status' => true,
                'msg' => "Cadastro realizado com sucesso",
            ];
        return $this->fxCad = $result;
}

    public function AddCategoria(string $fxCad)
    {/*
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
*/
$result = [
                'status' => true,
                'msg' => "Cadastro realizado com sucesso2",
            ];
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
                'msg' => "Categoria ja cadastrada",
                'Categoria' => $this->addCategoria,
            ];
        } else {
            $insertSql = "INSERT INTO tbl_categoria (idCategoria, descricao) 
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
}
