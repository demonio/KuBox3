<?php

class InitializeController extends AdminController 
{
	public function index( $id='' )
	{
		$this->scripts = Load::model( 'initialize' )->find( "order: weight" );
		$this->script_selected = ( $id ) ? Load::model( 'initialize' )->find( $id ) : '';
	}
	
	public function add()
	{
		$id = Load::model( 'initialize' )->keep( $_POST );
		Router::redirect( "admin/initialize/index/$id" );
	}
	
	public function edit( $id )
	{
		$_POST['id'] = $id;
		Load::model( 'initialize' )->keep( $_POST );
		Router::redirect( "admin/initialize/index/$id" );
	}
	
	public function quit( $id )
	{
		Load::model( 'initialize' )->quit( $id );
		Router::redirect( 'admin/initialize' );
	}
}
