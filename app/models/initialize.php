<?php

/**
 */
class Initialize extends ActiveRecord
{				
	public function keep( $post )
    {
		if ( ! empty( $post['id'] ) )
		{
			$this->id = $post['id'];
			$this->find( $this->id );
		}
		$this->name = $post['name'];
		$this->weight = $post['weight'];		
		$this->code = $post['code'];		
		if ( $this->save() )
		{
			$code = "<?php\r\n";
			$code .= "\r\n";
			$code .= "require_once CORE_PATH . 'kumbia/controller.php';\r\n";
			$code .= "\r\n";
			$code .= "class FirstController extends Controller";
			$code .= "\r\n{";
			$code .= "\r\n\tfinal protected function initialize()";
			$code .= "\r\n\t{";
			foreach ( $this->find( "order: weight" ) as $script )
			{
				$code .= str_replace( "\r\n", "\r\n\t\t", "\r\n$script->code" ) . "\r\n";
			}
			$code .= "\t}";
			$code .= "\r\n";
			$code .= "\r\n\tfinal protected function finalize()";
			$code .= "\r\n\t{";
			$code .= "\r\n";
			$code .= "\r\n\t}";
			$code .= "\r\n}";
			$code .= "\r\n";
			$file = APP_PATH . "libs/first_controller.php";
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
