<?php

include("../db/conn.php");

// $hashDB = $_GET['hash'];

//verificar se o email ou usuario esta cadastrado no banco de dados
$sql = "SELECT hash FROM tbl_login WHERE email OR nome" ;

$exc = $conn->query($sql);

if ($exc->num_rows > 0) {
    while ($row = $exc->fetch_assoc()) {
        $hashRec = $row["hash"];
        echo $hashRec;
    }
 
}else{
    echo "Usuario não encontrado";
}


?>
