<?php

class FieldsController extends AdminController 
{
	public function index( $table='', $field='' )
	{
		$this->tables = Load::model( 'initialize' )->find_all_by_sql( "SHOW TABLES" );
		$this->fields = ( $table ) ? Load::model( 'fields' )->read( $table ) : '';
		$this->table_selected = ( $table ) ? $table : '';
		$this->field_selected = ( $field ) ? Load::model( 'fields' )->read( $table, $field ) : '';
		#_::d($this->field_selected);
	}
	
	public function add()
	{
		Load::model( 'fields' )->add( $_POST );
		Router::redirect( "admin/fields/index/{$_POST['table']}/{$_POST['name']}" );
	}
	
	public function edit( $table, $field )
	{
		Load::model( 'fields' )->edit( $table, $field, $_POST );
		Router::redirect( "admin/fields/index/{$_POST['table']}/{$_POST['name']}" );
	}
	
	public function quit( $table, $field )
	{
		Load::model( 'fields' )->quit( $table, $field );
		Router::redirect( 'admin/fields' );
	}
}
