<?php

/**
 */
class Methods extends ActiveRecord
{				
	public function keep( $post )
    {
		if ( ! empty( $post['id'] ) )
		{
			$this->id = $post['id'];
			$this->find( $this->id );
		}
		$this->classes_id = $post['classes_id'];		
		$this->name = mb_strtolower( $post['name'] );
		$this->params = $post['params'];		
		$this->code = $post['code'];		
		if ( $this->save() ) $this->mount( $this->classes_id );
	}
	
	public function mount( $id )
    {
		$class = Load::model( 'classes' )->find( $id );
		$methods = Load::model( 'methods' )->find( "conditions: classes_id=$id" );
		
		$suffix_name = ( $class->folder == 'controllers' ) ? 'Controller' : '';
		$sire = " extends $class->sire";
		
		$code = "<?php\r\n";
		$code .= "\r\n";
		$code .= "class $class->name$suffix_name" . $sire;
		$code .= "\r\n{";
		foreach ( $methods as $method )
		{
			$params = ( $method->params ) ? " $method->params " : '';
			$code .= "\r\n\tpublic function $method->name($params)";
			$code .= "\r\n\t{";
			$code .= str_replace( "\r\n", "\r\n\t\t", "\r\n$method->code" );
			$code .= "\r\n\t}";
			$code .= "\r\n";
		}
		$code .= "\r\n}";
		$code .= "\r\n";

		$suffix_file = ( $class->folder == 'controllers' ) ? '_controller' : '';
		$file = APP_PATH . "$class->folder/" . mb_strtolower( $class->name ) . "$suffix_file.php";
		file_put_contents( $file, $code ) or exit();
		chmod( $file, 0777 );
		return $this->id;
	}
	
	public function quit( $id )
    {
		$method = $this->find( $id );
		$this->delete( $id );
		$this->mount( $method->classes_id );
	}
}
