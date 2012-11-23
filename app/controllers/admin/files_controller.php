<?php

/**
 */
class FilesController extends AdminController 
{
	protected function before_filter()
	{
	    $this->limit_params = false;	
	}
	
	public function index()
	{
		$this->items = _fs::readDirs( PUB_PATH );
		$this->f = Load::model( 'files' )->read( $this->parameters );
	}
	
	public function quit()
	{
		Load::model( 'files' )->quit( PUB_PATH . implode( '/', $this->parameters ) );
		Router::redirect( 'admin/files' );
	}
	
	public function upload()
	{
		if ( $_FILES['upload']['name'] ) Load::model( 'files' )->upload( $_POST, $_FILES['upload'] );
		Router::redirect( "admin/files/index/{$_POST['dir']}{$_FILES['upload']['name']}" );
	}
	
	public function folder()
	{
		Load::model( 'files' )->folder( $_POST );
		Router::redirect( 'admin/files' );
	}
}
