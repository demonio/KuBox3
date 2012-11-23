<?php

class MethodsController extends AdminController 
{
	public function index( $id='' )
	{
		$this->folders = Load::model( 'classes' )->distinct( "folder" );
		$this->classes = Load::model( 'classes' )->find( "order: name" );
		$this->methods = Load::model( 'methods' )->find( "order: name" );
		$this->method_selected = ( $id ) ? Load::model( 'methods' )->find( $id ) : '';
	}
	
	public function add()
	{
		$id = Load::model( 'methods' )->keep( $_POST );
		Router::redirect( "admin/methods/index/$id" );
	}
	
	public function edit( $id )
	{
		$_POST['id'] = $id;
		Load::model( 'methods' )->keep( $_POST );
		Router::redirect( "admin/methods/index/$id" );
	}
	
	public function quit( $id )
	{
		Load::model( 'methods' )->quit( $id );
		Router::redirect( 'admin/methods' );
	}
}
