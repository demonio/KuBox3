<?php

/**
 */
class IndexController extends FirstController 
{
	public function index( $url='' )
	{
		if ( ! $url )
		{
			$page = Load::model( 'pages' )->find_first( "order: level1,level2" );
			return Router::redirect( "$page->url" );
		}
		$this->page = Load::model( 'pages' )->find_first( "conditions: url='$url'" );
		if ( ! $this->page ) exit( '404' );
		$template = Load::model( 'templates' )->find( $this->page->templates_id );
		$template_name = mb_strtolower( $template->name );
		View::template( $template_name );
		
		$this->boxes = Load::model( 'boxes' )->read( 'pages', $this->page->id );
	}
}
