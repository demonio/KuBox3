<?php

/**
 */
class ModelsController extends AdminController 
{
	protected function before_filter()
	{
	    $this->limit_params = false;	
	}

	public function index( $model='', $method='' )
	{
		$this->models = Load::model( 'models' )->read();
		#_::d($this->models);
		$this->model_selected = new stdClass;
		if ( $method ) $this->models[$model]->method = $method;
		if ( $model ) $this->model_selected = $this->models[$model];
	}
	
	public function add()
	{
		Load::model( 'models' )->add( $_POST );
		Router::redirect( 'admin/models' );
	}
	
	public function edit( $id )
	{
		Load::model( 'models' )->edit( $id, $_POST );
		Router::redirect( "admin/models/index/$id" );
	}
	
	public function quit( $id )
	{
		Load::model( 'models' )->quit( $id );
		Router::redirect( 'admin/models' );
	}
}
