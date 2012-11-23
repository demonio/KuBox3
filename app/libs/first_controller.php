<?php

require_once CORE_PATH . 'kumbia/controller.php';

class FirstController extends Controller
{
	final protected function initialize()
	{
		$this->url = $_SERVER['REQUEST_URI'];

		if ( _::a( $_POST, 'task' ) == 'users/login' )
		{
			unset( $_POST['task'] );
			$logged = Load::model( 'users' )->login( $_POST );
		 	if ( ! $logged ) exit( Router::redirect( 'register' ) );
		}

		if ( _::a( $_POST, 'task' )  == 'users/register' )
		{
			unset( $_POST['task'] );
			Load::model( 'users' )->register( $_POST );
		}
	}

	final protected function finalize()
	{

	}
}
