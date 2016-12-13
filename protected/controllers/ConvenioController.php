<?php

class ConvenioController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('IndexConvenio'),
                'roles' => array('convenioIndex'),
            ),
            array('allow',
                'actions' => array('CreateConvenio'),
                'roles' => array('convenioCreateConvenio'),
            ),
            array('allow',
                'actions' => array('UpdateConvenio'),
                'roles' => array('convenioUpdateConvenio'),
            ),
            array('allow',
                'actions' => array('indexServicioConvenio'),
                'roles' => array('convenioindexServicioConvenio'),
            ),
            array('allow',
                'actions' => array('detalleConvenioServicio'),
                'roles' => array('conveniodetalleConvenioServicio'),
            ),
            array('allow',
                'actions' => array('changeStateConvenioServivio'),
                'roles' => array('conveniochangeStateConvenioServivio'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionIndexConvenio()
    {
        $this->menu = OptionsMenu::menuConvenio([], ['convenios', 'Lista Convenio']);
        $listConvenio = Convenio::model()->findAll([]);
        $convenioModel = new Convenio();
        $this->render('indexConvenio', ['listConvenio' => $listConvenio, 'modelConvenio' => $convenioModel]);
    }

    public function actionCreateConvenio()
    {
        $this->menu = OptionsMenu::menuConvenio([], ['convenios', 'Lista Convenio']);
        $modelConvenio = new Convenio();
        $this->ajaxValidation($modelConvenio);
        $listConvenio = Convenio::model()->findAll([
        ]);
        if (isset($_POST['Convenio'])) {
            $modelConvenio->attributes = $_POST['Convenio'];
            if ($modelConvenio->save())
                $this->redirect(['indexConvenio']);
        }
        $this->render('indexConvenio', ['listConvenio' => $listConvenio, 'modelConvenio' => $modelConvenio]);
    }

    public function actionUpdateConvenio($id)
    {
        $this->menu = OptionsMenu::menuConvenio([], ['convenios', 'Lista Convenio']);
        $modelConvenio = Convenio::model()->findByPk($id);
        $this->ajaxValidation($modelConvenio);
        $listConvenio = CategoriaServExamen::model()->findAll([]);
        if (isset($_POST['Convenio'])) {
            $modelConvenio->attributes = $_POST['Convenio'];
            if ($modelConvenio->save())
                $this->redirect(['indexConvenio']);
        }
        $this->render('indexConvenio', ['listConvenio' => $listConvenio, 'modelConvenio' => $modelConvenio]);
    }

    public function actionindexServicioConvenio($id)
    {
        $this->menu = OptionsMenu::menuConvenio(['id_convenio' => $id], ['convenio', 'Convenio Servicio']);
        $convenio = Convenio::model()->findByPk($id);
        $convenioServicio = new ConvenioServicio();
        $listServicio = Servicio::model()->findAll("id_serv not in (select id_servicio from convenio_servicio where id_convenio={$id})");
        $listaconvenioservicio = ConvenioServicio::model()->findAll(array(
            'condition' => "id_convenio='{$id}'",
            'order' => "id_servicio ASC",

        ));
        $listSelect = array();
        $this->render('indexServicioConvenio', [
            'listServicio' => $listServicio,
            'modelConvenio' => $convenio,
            'convenioServicio' => $convenioServicio,
            'listConvenioServicio' => $listaconvenioservicio,
            'listSelect' => $listSelect,
        ]);
    }

    public function actiondetalleConvenioServicio()
    {
        $conveniosservicios = $_POST['ConvenioServicio'];
        foreach ($conveniosservicios as $item):
            $modelConvenioServicio = new ConvenioServicio();
            $modelConvenioServicio->attributes = $item;
            $modelConvenio = $modelConvenioServicio->id_convenio;
            $models[] = $modelConvenioServicio;
        endforeach;
        $valid = $this->validar($models);
        if ($valid) {
            foreach ($conveniosservicios as $item):
                $modelConvenioServicio = new ConvenioServicio();
                $modelConvenioServicio->attributes = $item;
                $servicio = Servicio::model()->findByPk($item['id_servicio']);
                $modelConvenioServicio->descuento_servicio = $servicio->precio->monto * ($item['descuento_servicio']) / 100;
                $modelConvenioServicio->save();
            endforeach;
            return CHtml::normalizeUrl('convenio/indexServicioConvenio', array('id' => $modelConvenioServicio->id_convenio));
        } else {
            $this->renderPartial('serviciosSelect', array(
                'listSelect' => $models,
                'convenio' => $modelConvenio,
            ));
            return;
        }
    }

    public function validar($vector = array())
    {
        $flag = true;
        foreach ($vector as $item) {
            $flag = $flag && $item->validate();
        }
        return $flag;
    }

    protected function ajaxValidation($model)
    {
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionchangeStateConvenioServivio($id)
    {
        $convenio = ConvenioServicio::model()->findByPk($id);
        $convenio->activo = !$convenio->activo;
        $convenio->save();
    }
}
