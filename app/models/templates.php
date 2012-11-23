<?php

class Templates extends ActiveRecord
{				
	public function keep( $post )
    {
		if ( $this->save( $post ) ) $this->mount( $this->id );
	}
	
	public function mount( $conditions )
    {
		$this->find_first( $conditions ); 
		
		$template_name = mb_strtolower( $this->name );
		$file = APP_PATH . "views/_shared/templates/$template_name.phtml";

		$boxes = Load::model( 'boxes' )->find( "conditions: parents='templates' AND parents_id=$this->id", "order: weight" );
		$head = '';
		foreach ( $boxes as $box )
		{
			if ( $box->hook <> 'Head' ) continue;
			$id = _::slug( $box->name );
			$head .= "\r\n\t\t" . str_replace( "\r\n", "\r\n\t\t", $box->html );
		}
		$before = '';
		foreach ( $boxes as $box )
		{
			if ( $box->hook <> 'Before' ) continue;
			$id = _::slug( $box->name );
			if ( $box->box ) $before .= "\r\n\t\t\t<div class=\"box\" id=\"$id\">";
				$before .= ( $box->box ) ? "\r\n\t\t\t\t" : "\r\n\t\t\t";
				$before .= str_replace( "\r\n", "\r\n\t\t\t\t", $box->html );
			if ( $box->box ) $before .= "\r\n\t\t\t</div>";
		}
		$after = '';
		foreach ( $boxes as $box )
		{ 
			if ( $box->hook <> 'After' ) continue;
			$id = _::slug( $box->name );
			if ( $box->box ) $after .= "\r\n\t\t\t<div class=\"box\" id=\"$id\">";
				$after .= ( $box->box ) ? "\r\n\t\t\t\t" : "\r\n\t\t\t";
				$after .= str_replace( "\r\n", "\r\n\t\t\t\t", $box->html );				
			if ( $box->box ) $after .= "\r\n\t\t\t</div>";
		}
		$data = "<!DOCTYPE html>";
		$data .= "\r\n<html lang=\"en\">";
			$data .= "\r\n\t<head>";
				$data .= "$head";
			$data .= "\r\n\t</head>";
			$data .= "\r\n\t<body>";
				$data .= "\r\n\t\t<div class=\"box\" id=\"web\">";
					$data .= $before;
					$data .= "\r\n\t\t\t<div class=\"box\" id=\"page-content\">";
						$data .= "<?php View::content(); ?>";
					$data .= "\r\n\t\t\t</div>";
					$data .= "\r\n$after";
				$data .= "\r\n\t\t</div>";
			$data .= "\r\n\t</body>";
		$data .= "\r\n</html>";
		file_put_contents( $file, $data ) or exit();
		chmod( $file, 0777 );
	}
	
	/**
	 * QUITA EL TEMPLATE DE LA BD Y BORRA EL ARCHIVO
	 */
	public function quit( $id )
    {
		#Load::model( 'templates' )->deleteFile( $id );
		Load::model( 'templates' )->delete( $id );
	}
}
