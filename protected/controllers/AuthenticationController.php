<?php

class AuthenticationController extends Controller
{
    public $defaultAction = 'adminRoles';
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        //USER: paso 1 = agregar regla de acceso por cada action  controllerNameActionName.
        return array(
            array('allow',
                'actions' => array('viewOperations'),
                'roles' => array('authenticationViewOperations'),
            ),
            array('allow',
                'actions' => array('adminRoles'),
                'roles' => array('authenticationAdminRoles'),
            ),
            array('allow',
                'actions' => array('createRole'),
                'roles' => array('authenticationCreateRole'),
            ),
            array('allow',
                'actions' => array('updateRole'),
                'roles' => array('authenticationUpdateRole'),
            ),
            array('allow',
                'actions' => array('view'),
                'roles' => array('authenticationView'),
            ),
            array('allow',
                'actions' => array('deleteRole'),
                'roles' => array('authenticationDeleteRole'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAdminRoles()
    {
        $this->menu = OptionsMenu::menuAuthenticacion([], ['Roles', 'authentication_AdminRoles']);
        $list = Yii::app()->authManager->getRoles();
        $this->render("admin", array(
            'list' => $list,
            'tipo' => 2,
        ));
    }

    public function actionCreateRole()
    {
        $this->menu = OptionsMenu::menuAuthenticacion([], ['Roles', 'authentication_AdminRoles']);
        $role = new RoleForm;
        if (isset($_POST["RoleForm"])) {
            $role->attributes = $_POST["RoleForm"];
            if ($role->validate()) {
                $trans = Yii::app()->db->beginTransaction();
                try {
                    $rol = Yii::app()->authManager->createRole(trim($role->name), $role->description, null, 1);
                    if (isset($_POST["tarea_rol"])) {
                        foreach ($_POST["tarea_rol"] as $tarea_rol) {
                            $rol->addChild($tarea_rol);
                        }
                    }
                    $trans->commit();
                } catch (Exception $e) {
                    echo "Excepcion: " . $e->getMessage() . "/n";
                    $trans->rollback();
                    //todo-le: Agregar pagina de excepcion
                    Yii::app()->end();
                }
                $this->redirect(array('view', 'id' => $rol->name));
            }
        }
        $listRoles = Yii::app()->authManager->getRoles();
        $this->render('createRole', array(
            'role' => $role,
            'listRoles' => $listRoles,
        ));
    }

    public function actionUpdateRole($id)
    {
        $this->menu = OptionsMenu::menuAuthenticacion([], ['Roles', 'authentication_AdminRoles']);
        $role = Yii::app()->authManager->getAuthItem($id);
        if (isset($_POST["oculto"])) {
            $trans = Yii::app()->db->beginTransaction();
            try {
                if (isset($_POST['description'])) {
                    $role->description = $_POST['description'];
                    Yii::app()->authManager->saveAuthItem($role);
                }
                $query = "delete from \"AuthItemChild\" where parent= '" . $role->name . "';";
                $command = Yii::app()->db->createCommand($query);
                $command->execute();
                if (isset($_POST["tarea_rol"])) {
                    foreach ($_POST["tarea_rol"] as $tarea_rol) {
                        $role->addChild($tarea_rol);
                    }
                }
                $trans->commit();
            } catch (Exception $e) {
                echo "Excepcion: " . $e->getMessage() . "/n";
                $trans->rollback();
                //todo-le: Agregar pagina de excepcion
                Yii::app()->end();
            }
            $this->redirect(array('view', 'id' => $role->name));
        }
        $listRoles = Yii::app()->authManager->getRoles();
        $listTasksRolesSelected = Yii::app()->authManager->getItemChildren($role->name);
        $this->render('updateRole', array(
            'role' => $role,
            'listRoles' => $listRoles,
            'listTasksRolesSelected' => $listTasksRolesSelected,
        ));
    }

    public function actionView($id)
    {
        $this->menu = OptionsMenu::menuAuthenticacion([], ['Roles', 'authentication_AdminRoles']);

        $rol = Yii::app()->authManager->getAuthItem($id);
        if ($rol->type == 0)
            $this->redirect(array("viewOperations"));
        $listSelected = Yii::app()->authManager->getItemChildren($rol->name);
        $types = array("Operacion", "Tarea", "Rol");
        $this->render('view', array(
            'rol' => $rol,
            'types' => $types,
            'listSelected' => $listSelected,
        ));
    }

    public function actionDeleteRol($id)
    {
        $rol = Yii::app()->authManager->getAuthItem($id);
        $var = $rol->type;
        if ($var == 0)
            $this->redirect(array("viewOperations"));
        Yii::app()->authManager->removeAuthItem($id);
        $this->redirect(array("admin", 'tipo' => $var));
    }

}