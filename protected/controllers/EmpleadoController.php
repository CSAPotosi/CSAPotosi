<?php

class EmpleadoController extends Controller
{
    public function actionIndex()
    {
        $this->menu = OptionsMenu::menuEmpleado([], ['empleados', 'index']);
        $this->render('index');
    }

    public function actionCreate()
    {
        $this->menu = OptionsMenu::menuempleado([], ['empleados', 'create']);
        $modelPerson = new PersonaForm();
        if (isset($_POST['PersonaForm'])) {
            $modelPerson->setAttributes($_POST['PersonaForm'], false);
            $id_empleado = $modelPerson->saveEmpleado();
            if ($id_empleado != 0)
                if ($_POST['medico']) {
                    $this->redirect(["medico/onlyMedico", 'id' => $id_empleado]);
                } else {
                    $this->redirect(["empleado/index"]);
                }

        }
        $this->render('create', array('modelPerson' => $modelPerson));
    }

    public function actionGetEmpleadoListAjax()
    {
        $page = $_POST['page'] * Yii::app()->params['itemListLimit'];
        $query = $_POST['query'];
        $empleadoList = Empleado::getEmpleadoList($page, $query);
        $this->renderPartial('_empleadoListView', ['empleadoList' => $empleadoList]);
    }

    public function actionDetalleEmpleado($id)
    {
        $this->menu = OptionsMenu::menuempleado(['id_empleado' => $id], ['empleado', 'detalleEmpleado']);
        $empleado = Empleado::model()->findByPk($id);
        $this->render('detalleEmpleado', ['empleado' => $empleado]);
    }

    public function actionUpdate($id)
    {
        $this->menu = OptionsMenu::menuEmpleado(['id_empleado' => $id], ['empleado', 'updateEmpleado']);
        $modelPerson = new PersonaForm();
        $persona = Persona::model()->findByPk($id);
        if (isset($_POST['PersonaForm'])) {
            $modelPerson->setAttributes($_POST['PersonaForm'], false);
            $id_empleado = $modelPerson->saveEmpleado($id);
            if ($id_empleado != 0) {
                if ($_POST['medico'] == 1)
                    $this->redirect(["medico/onlyMedico", 'id' => $id_empleado]);
                if ($_POST['medico'] == 0)
                    $this->redirect(["empleado/DetalleEmpleado", 'id' => $id_empleado]);
            }

        }
        $this->render('update', array('modelPerson' => $modelPerson, 'persona' => $persona));
    }

    public function actionindexBackup()
    {
        $backups = opendir('Backups/');
        $this->render('indexBackup', ['backups' => $backups]);
    }

    public function actionCreateBackup()
    {
        chdir('c:\\Program Files\\PostgreSQL\\9.5\\bin\\');
        $comando1 = 'SET PGPASSWORD=root';
        $comando2 = "pg_dump -U postgres -F t -f c:\\wamp\\www\\CSAPotosi\\Backups\\SantaAna-" . strtotime(date('d-m-Y H:i:s')) . ".backup csapotosi_db";
        shell_exec($comando1 . "&&" . $comando2);
        $this->redirect(['indexBackup']);

    }

    public function actionCargarBackup($id)
    {
        chdir('c:\\Program Files\\PostgreSQL\\9.5\\bin\\');
        $comando1 = 'SET PGPASSWORD=root';
        $comando2 = "pg_restore -U postgres -c -d csapotosi_db -v c:\\wamp\\www\\CSAPotosi\\Backups\\SantaAna-" . $id . ".backup";
        shell_exec($comando1 . "&&" . $comando2);
        $this->redirect(['indexBackup']);
    }
}