<?php

class Fields
{				
	public function read( $table, $field_selected='' )
    {
		$fields = Load::model( 'initialize' )->find_all_by_sql( "SHOW COLUMNS FROM $table" );
		if ( ! $field_selected ) return $fields;
		foreach ( $fields as $field ) $a[$field->Field] = $field;
		return $a[$field_selected];
	}
	
	public function add( $post )
    {
		$after = empty( $post['after'] ) ? 'id' : $post['after'];
		$after = ( $post['name'] == $after ) ? 'id' : $post['after'];
		$not_null = empty( $post['not_null'] ) ? '' : $post['not_null'];
		$sql = "ALTER TABLE {$post['table']} ADD {$post['name']} {$post['type']}$not_null AFTER $after;";
		Load::model( 'initialize' )->sql( $sql );
	}

	public function edit( $table, $field, $post )
    {
		$after = empty( $post['after'] ) ? 'id' : $post['after'];
		$after = ( $post['name'] == $after ) ? 'id' : $post['after'];
		$not_null = empty( $post['not_null'] ) ? '' : $post['not_null'];
		$sql = "ALTER TABLE $table CHANGE $field {$post['name']} {$post['type']}$not_null AFTER $after;";
		Load::model( 'initialize' )->sql( $sql );
	}

	public function quit( $table, $field )
    {
		$sql = "ALTER TABLE $table DROP COLUMN $field";
		Load::model( 'initialize' )->sql( $sql );
	}
}
