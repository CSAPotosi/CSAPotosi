<?php

class RegistroController extends Controller
{
    public function actionCreate()
    {
        $modelRegistro = new Registro();
        if (isset($_POST['Registro'])) {
            $modelRegistro->attributes = $_POST['Registro'];
            if ($modelRegistro->save()) {
                $this->redirect(array('create'));
            }
        }
        $this->render('create', array(
            'modelRegistro' => $modelRegistro,
        ));
    }

    public function actionSubir()
    {
        $ruta = "archivo/";
        if (isset($_POST['uploadedfile'])) {
            $ruta = $ruta . basename($_FILES['uploadedfile']['name']);
            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $ruta)) {
                echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
            } else {
                echo "Ha ocurrido un error, trate de nuevo!";
            }
        }
        $this->render('subir');
    }

    public function actionregistrar()
    {
        $target_path = "images/";

        $target_path = $target_path . basename($_FILES['uploadedfile']['name']);
        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            echo "El archivo " . basename($_FILES['uploadedfile']['name']) . " ha sido subido";
        } else {
            echo "Ha ocurrido un error, trate de nuevo!";
        }

    }
}