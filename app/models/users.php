<?php

class Users extends ActiveRecord
{
	public function login( $post )
	{
		$pass = md5( $post['password'] . ' pass del demonio' );
		$user = Load::model( 'users' )->find_first( "conditions: username='{$post['username']}' AND password='$pass'" );
		
		if ( $user )
		{
			$_SESSION['logged'] = 1;
			$_SESSION['username'] = $user;
			$_SESSION['flash'][] = Flash::valid( 'Bienvenido.' );
			return 1;
		}
		else
		{
			$_SESSION['flash'][] = Flash::warning( 'El usuario y contraseña es es correcta.' );
			return 0;
		}
	}

	public function register( $post )
	{
		$this->delete_all( "username='{$post['username']}' AND confirm=0" );
		
		$user = $this->find_first( "conditions: username='{$post['username']}' AND confirm=1" );
		
		if ( $user ) return $_SESSION['flash'][] = Flash::warning( 'El nombre de usuario ya esta en uso.' );
		
		if ( empty(  $post['nick'] ) or empty(  $post['username'] ) or empty(  $post['password'] ) ) return $_SESSION['flash'][] = Flash::warning( 'Todos los campos son obligatorios.' );
		
		$this->nick = $post['nick'];
		$this->username = $post['username'];
		$this->password = md5( $post['password'] . ' del demonio' );
		if ( $this->create() )
		{
			mail( $this->username, 'Confirme su registro en MTG SEARCH.it', URL_PATH . "users/confirm/$this->password", "FROM: cylon@mtgsearct.it" );
			$_SESSION['flash'][] = Flash::warning( 'Por favor, confirme el registro en su correo.' );
		}
	}

}
