<?php
/* @var $this AuthenticationController */

$this->breadcrumbs = array(
    'Init',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <div class="row">
                            <article class="col-md-6">
                                <form action="<?php echo $this->createAbsoluteUrl('authentication/init'); ?>"
                                      method="post">
                                    <div>
                                        Crear usuario administrador<br>
                                        nombre de usuario : admin<br>
                                        password : admin<br>
                                        <input type="hidden" name="reset" value="1"/>
                                    </div>
                                    <div>
                                        <input type="submit" value="Crear administrador">
                                    </div>
                                </form>
                            </article>
                            <article class="col-md-6">
                                <form action="<?php echo $this->createAbsoluteUrl('authentication/init'); ?>"
                                      method="post">
                                    <div>
                                        <label for="adminuser">Nombre del usuario al que se le asigna rol de
                                            administrador con todos los permisos</label>
                                        <input type="text" name="adminuser"/>
                                    </div>
                                    <div>
                                        <input type="submit" value="Resetear Roles">
                                    </div>
                                </form>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>