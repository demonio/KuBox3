<?php

class Classes extends ActiveRecord
{				
	public function keep( $post )
    {
		if ( ! empty( $post['id'] ) )
		{
			$this->id = $post['id'];
			$this->find( $this->id );
		}
		$this->name = $post['name'];
		$this->folder = mb_strtolower( $post['folder'] );		
		$this->sire = $post['sire'];		
		$this->vars = $post['vars'];		
		if ( $this->save() )
		{
			$methods = Load::model( 'methods' )->find( "conditions: classes_id=$this->id" );
			
			$sire = " extends $this->sire";
						
			$code = "<?php\r\n";
			$code .= "\r\n";
			$code .= "class $this->name$sire";
			$code .= "\r\n{";
			foreach ( $methods as $method )
			{
				$code .= "\r\n\tpublic function $method->name( $method->params )";
				$code .= "\r\n\t{";
				$code .= str_replace( "\r\n", "\r\n\t\t", "\r\n$method->code" );
				$code .= "\r\n\t}";
				$code .= "\r\n";
			}
			$code .= "\r\n}";
			$code .= "\r\n";
			$file = APP_PATH . "models/" . mb_strtolower( $this->name ) . ".php";
			file_put_contents( $file, $code ) or exit();
			chmod( $file, 0777 );
			return $this->id;
		}
	}
	
	public function quit( $id )
    {
		$this->delete( $id );
	}
}
