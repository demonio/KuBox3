<?php

class Tables
{				
	public function add( $table )
    {
		$sql = "CREATE TABLE `$table` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		Load::model( 'initialize' )->sql( $sql );
	}

	public function edit( $old, $new )
    {
		$sql = "RENAME TABLE $old TO $new";
		Load::model( 'initialize' )->sql( $sql );
	}

	public function quit( $table )
    {
		$sql = "DROP TABLE IF EXISTS `$table`;";
		Load::model( 'initialize' )->sql( $sql );
	}
}
