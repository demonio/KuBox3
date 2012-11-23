<?php

/**
 */
class Css
{				
	/**
	 */
	public function mount( $conditions )
    {
		$template = Load::model( 'templates' )->find_first( $conditions );
		$template_name = mb_strtolower( $template->name );
		$file = PUB_PATH . "css/$template_name.css";
		
		$sql = "SELECT * FROM boxes ORDER BY FIELD ( hook, 'Head', 'Before', 'Page', 'After' )";
		$boxes = Load::model( 'boxes' )->find_all_by_sql( $sql );
		$css = "";
		foreach ( $boxes as $box )
		{
			if ( ! $box->css ) continue;
			$css .= "/* $box->name BOX ( $box->parents.$box->parents_id.$box->hook.$box->weight ) */\r\n";
			$css .= "$box->css\r\n\r\n";
		}
		file_put_contents( $file, $css ) or exit();
		chmod( $file, 0777 );
	}
}
