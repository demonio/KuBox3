<?php

class ClassesController extends AdminController 
{
	public function index( $id='' )
	{
		$this->folders = Load::model( 'classes' )->distinct( "folder" );
		$this->classes = Load::model( 'classes' )->find( "order: name" );
		$this->class_selected = ( $id ) ? Load::model( 'classes' )->find( $id ) : '';
	}
	
	public function add()
	{
		Load::model( 'classes' )->keep( $_POST );
		Router::redirect( 'admin/classes' );
	}
	
	public function edit( $id )
	{
		$_POST['id'] = $id;
		Load::model( 'classes' )->keep( $_POST );
		Router::redirect( "admin/classes/index/$id" );
	}
	
	public function quit( $id )
	{
		Load::model( 'classes' )->quit( $id );
		Router::redirect( 'admin/classes' );
	}
}
