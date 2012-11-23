<?php

/**
 */
class Js
{				
	/**
	 */
	public function mount( $conditions )
    {
		$template = Load::model( 'templates' )->find_first( $conditions );
		$template_name = mb_strtolower( $template->name );
		$file = PUB_PATH . "javascript/$template_name.js";
		
		$sql = "SELECT * FROM boxes ORDER BY FIELD ( hook, 'Head', 'Before', 'Page', 'After' )";
		$boxes = Load::model( 'boxes' )->find_all_by_sql( $sql );
		$js = "";
		foreach ( $boxes as $box )
		{
			if ( ! $box->js ) continue;
			$js .= "/* $box->name BOX ( $box->parents.$box->parents_id.$box->hook.$box->weight ) */\r\n";
			$js .= "$box->js\r\n\r\n";
		}
		file_put_contents( $file, $js ) or exit();
		chmod( $file, 0777 );
	}
}
