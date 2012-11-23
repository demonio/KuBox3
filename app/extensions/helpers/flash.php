<?php

class Flash
{
	public static function show( $name='', $text ) { return "<div class=\"flash$name\">$text</div>" . PHP_EOL; }

	public static function error( $text ) { return self::show( ' error', "<strong>Error</strong> - $text" ); }

	public static function warning( $text ) { return self::show( ' warning', "<strong>Atención</strong> - $text" ); }
 
	public static function info( $text ) { return self::show( ' info', "<strong>Info</strong> - $text" ); }
		public static function notice( $text ) { return self::show( ' info', "<strong>Info</strong> - $text" ); }
 
	public static function valid( $text ) { return self::show( ' valid', "<strong>OK</strong> - $text" ); }
		public static function success( $text ) { return self::show( ' valid', "<strong>OK</strong> - $text" ); }
}
