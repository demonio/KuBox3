<?php

/**
 */
class Files
{				
	/**
	 */
	public function read( $parameters )
    {
		$parameters = implode( '/', $parameters );
		$file = PUB_PATH . $parameters;
		#_::d($file);
		$a['dir_open'] = dirname( str_replace( PUB_PATH, '', $file ) );
		if ( $a['dir_open'] ) $a['dir_open'] .= '/';
		$a['abs_path'] = $file;
		$a['rel_path'] = str_replace( PUB_PATH, '', $file );
		if ( preg_match( '/\.(gif|jpg|png)$/i', $file ) )
		{
			$b = getimagesize( $a['abs_path'] );
			$a['width'] = $b[0];
			$a['height'] = $b[1];
		}
		else
		{
			$a['content'] = file_get_contents( $file );
		}
		return $a;
	}
	
	/**
	 */
	public function quit( $item )
    {
		if ( is_dir( $item ) ) rmdir( $item );
		else if ( file_exists( $item ) ) unlink( $item );
	}
	
	/**
	 */
	public function upload( $post, $file )
    {
		move_uploaded_file( $file['tmp_name'], PUB_PATH . $post['dir'] . $file['name'] );
	}
	
	/**
	 */
	public function folder( $post )
    {
		mkdir( PUB_PATH . $post['dir'], 0777 );
	}
}
