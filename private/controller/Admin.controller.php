<?php
include("../model/Admin.model.php");

$ACERVO = new ACERVO();

$fxCad = $_POST['fxCad'];
switch ($fxCad) {
    case 'cadCategoria':
        $addCategoria = $_POST['categoria'];
        if (empty($addCategoria)) {
            $result = [
                'status' => false,
                'msg' => "Usuario- Preencha o campo back"
            ];
        } else {
            $ACERVO->setAddCategoria($addCategoria);

            $ACERVO->AddCategoria($fxCad);

            $result = $ACERVO->fxCad;
        }
        break;
    case 'cadGenero':

        $addGenero = $_POST['genero'];

        if (empty($addGenero)) {
            $result = [
                'status' => false,
                'msg' => "Preencha o campo back"
            ];
        } else {
            $ACERVO->setAddGenero($addGenero);
            $ACERVO->addGenero($fxCad);

            $result = $ACERVO->fxCad;
        }
        break;

    case 'cadEtaria':
        $addEtaria = $_POST['etaria'];
        if (empty($addEtaria)) {
            $result = [
                'status' => false,
                'msg' => "Preencha o campo back"
            ];
        } else {
            $ACERVO->setAddEtaria($addEtaria);
            $ACERVO->addEtaria($fxCad);

            $result = $ACERVO->fxCad;
        }
        break;

    case 'cadMidia':
        $addTitulo = $_POST['titulo'];
        $genero = $_POST['sel_genero'];
        $categoria = $_POST['sel_categoria'];
        $etaria = $_POST['sel_etaria'];
        $loginValido = $_POST['login'];

        if (empty($addTitulo) || empty($genero) || empty($categoria) || empty($etaria) || empty($loginValido)) {
            $result = [
                'status' => false,
                'msg' => "Preencha todos os campos back"
            ];
        } else {
            $ACERVO->setAddTitulo($addTitulo);
            $ACERVO->setGenero($genero);
            $ACERVO->setCategoria($categoria);
            $ACERVO->setEtaria($etaria);
            $ACERVO->addTitulo($fxCad);

            $result = $ACERVO->fxCad;
        }
        break;

    default:
        $result = [
            'status' => false,
            'msg' => " <p>Sistema indisponivel. Tente mais tarde... </p>"
        ];
        break;
}


header('Content-Type: Application/json');
echo json_encode($result);

// echo "<pre>";
// var_dump($ACERVO);
// echo "</pre>";

// echo "<pre>";
// var_dump($result);
// echo "</pre>";

