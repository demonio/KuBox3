<?php

/**
 */
class _
{
	static public function e( $x ) { echo '<pre>' . htmlentities( print_r( $x, 1 ), ENT_QUOTES ) . '</pre>'; }
	static public function d( $x ) { die( self::e( $x ) ); }
	static public function a( $o, $p, $suf='' ) { if ( isset( $o[$p] ) ) return $o[$p] . $suf; }
	static public function ea( $o, $p, $suf='' ) { echo self::a( $o, $p, $suf ); }
	static public function o( $o, $p, $suf='' ) { if ( isset( $o->$p ) ) return $o->$p . $suf; }
	static public function eo( $o, $p, $suf='' ) { echo self::o( $o, $p, $suf ); }
	static public function selected( $a, $b ) { return ( $a == $b ) ? ' selected="selected"' : ''; }
	static public function eselected( $a, $b ) { echo self::selected( $a, $b ); }
	static public function checked( $a, $b ) { return ( $a == $b ) ? ' checked="checked"' : ''; }
	static public function echecked( $a, $b ) { echo self::checked( $a, $b ); }

    static public function slug( $s )
    {
        $search = explode( ',', 'ç,Ç,ñ,Ñ,æ,Æ,œ,á,Á,é,É,í,Í,ó,Ó,ú,Ú,à,À,è,È,ì,Ì,ò,Ò,ù,Ù,ä,ë,ï,Ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,Š,Œ,Ž,š,¥, ' );
        $replace = explode( ',', 'c,C,n,N,ae,AE,oe,a,A,e,E,i,I,o,O,u,U,a,A,e,E,i,I,o,O,u,U,ae,e,i,I,oe,ue,y,a,e,i,o,u,a,e,i,o,u,s,o,z,s,Y,-' );
        $s = str_replace( $search, $replace, $s );
        #$s = preg_replace( '/[^a-z0-9_]/i', '-', $s );
		$s = mb_strtolower( $s );
		return $s;
	}

    static public function cut( $s, $beg, $end )
    {
		$a = preg_split( "/$beg/i", $s, 2 );
		if ( empty( $a[1] ) ) return; 
		$b = preg_split( "/$end/i", $a[1], 2 );
		return trim( $b[0] );
	}
}
