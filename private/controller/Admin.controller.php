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

            $result = $ACERVO->$fxCad;
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

    default:
        $result = [
            'status' => false,
            'msg' => " <p>Sistema indisponivel. Tente mais tarde... </p>"
        ];
        break;
}


header('Content-Type: Application/json');
echo json_encode($result);
