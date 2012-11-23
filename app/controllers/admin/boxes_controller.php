<?php
/**
 */
class BoxesController extends AdminController 
{
	public function index( $id=0 )
	{
		$this->templates = Load::model( 'templates' )->find( "order: name" );
		$this->pages = Load::model( 'pages' )->find( "order: level1,level2" );
		$this->boxes = Load::model( 'boxes' )->find( "order: weight" );
		$this->box_selected = ( $id ) ? Load::model( 'boxes' )->find( $id ) : '';
	}
	
	public function add()
	{
		$id = Load::model( 'boxes' )->keep( $_POST );
		Router::redirect( "admin/boxes/index/$id" );
	}
	
	public function edit( $id )
	{
		$_POST['id'] = $id; 
		Load::model( 'boxes' )->keep( $_POST );
		Router::redirect( "admin/boxes/index/$id" );
	}
	
	public function quit( $id )
	{
		Load::model( 'boxes' )->quit( $id );
		Router::redirect( 'admin/boxes' );
	}
}
