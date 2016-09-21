<?php
class CSAMenu extends CWidget{
    public $menu = [];

	public function run(){
		$this->render('renderCSAMenu');
	}
}