<?php

/**
 */
class TemplatesController extends AdminController 
{
	public function index( $id=0 )
	{
		$this->templates = Load::model( 'templates' )->find( "order: name" );
		$this->template_selected = ( $id ) ? Load::model( 'templates' )->find( $id ) : '';
	}
	
	public function add()
	{
		Load::model( 'templates' )->keep( $_POST );
		Router::redirect( 'admin/templates' );
	}
	
	public function edit( $id )
	{
		$_POST['id'] = $id;
		Load::model( 'templates' )->keep( $_POST );
		Router::redirect( "admin/templates/index/$id" );
	}
	
	public function quit( $id )
	{
		Load::model( 'templates' )->quit( $id );
		Router::redirect( 'admin/templates' );
	}
}
