<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	
	public function index()
	{
		$config = [
			'title' => 'Data Bencana Hidrometeorologi',
			'subtitle' => 'Data Bencana Hidrometeorologi'
		];
		$this->render($config);
	}


}
