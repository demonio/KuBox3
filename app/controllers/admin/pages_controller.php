<?php

/**
 */
class PagesController extends AdminController 
{
	public function index( $id=0 )
	{
		$this->templates = Load::model( 'templates' )->find( "order: name" );
		$this->pages = Load::model( 'pages' )->find( "order: level1,level2" );
		$this->page_selected = ( $id ) ? Load::model( 'pages' )->find( $id ) : '';
	}
	
	public function add()
	{
		$id = Load::model( 'pages' )->keep( $_POST );
		Router::redirect( "admin/pages/index/$id" );
	}
	
	public function edit( $id )
	{
		$_POST['id'] = $id; 
		Load::model( 'pages' )->keep( $_POST );
		Router::redirect( "admin/pages/index/$id" );
	}
	
	public function quit( $id )
	{
		Load::model( 'pages' )->delete( $id );
		Router::redirect( 'admin/pages' );
	}
}
