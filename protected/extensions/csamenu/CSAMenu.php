<?php
class CSAMenu extends CWidget{
	public $menu=[];
	public $title='';

	public function run(){
		$this->render('renderCSAMenu');
	}
	
	
	/*
	 * [
	 * 	['title'=>'','url'=>'','active']
	 * ]
	 * 
	 */
}