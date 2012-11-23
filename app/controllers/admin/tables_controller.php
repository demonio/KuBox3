<?php

class TablesController extends AdminController 
{
	public function index( $table='' )
	{
		$this->tables = Load::model( 'initialize' )->find_all_by_sql( "SHOW TABLES" );
		$this->table_selected = ( $table ) ? $table : '';
		$database = Config::get( 'config.application.database' );
		$this->database = Config::get( "databases.$database.name" );
		#_::d($this->tables);
	}
	
	public function add()
	{
		Load::model( 'tables' )->add( $_POST['name'] );
		Router::redirect( "admin/tables/index/{$_POST['name']}" );
	}
	
	public function edit( $table )
	{
		Load::model( 'tables' )->edit( $table, $_POST['name'] );
		Router::redirect( "admin/tables/index/{$_POST['name']}" );
	}
	
	public function quit( $table )
	{
		Load::model( 'tables' )->quit( $table );
		Router::redirect( 'admin/tables' );
	}
}
