<?php

class Boxes extends ActiveRecord
{					
	/**
	 */
	public function keep( $post )
    {
		if ( ! empty( $post['id'] ) ) $this->id = $post['id'];
		$parents = explode( '.', $post['parents_id'] );
		$this->parents = $parents[0];
		$this->parents_id = $parents[1];
		$this->hook = $post['hook'];
		$this->weight = $post['weight'];
		$this->name = $post['name'];
		$this->html = $post['html'];
		$this->css = $post['css'];
		$this->js = $post['js'];
		$this->box = empty( $post['box'] ) ? '0' : '1';

		if ( $this->save() )
		{
			$template_id = $this->getTemplateIdByParent( $this->parents, $this->parents_id );
			
			# SI SE CREAN CAJAS DEL TEMPLATE SE BORRA PARA EL ARCHIVO PARA GENERARLO DE NUEVO
			if ( $this->hook <> 'Page' ) Load::model( 'templates' )->mount( $template_id );
			
			# EL ARCHIVO CSS SE BORRA PARA SER AUTOGENERADO CADA VEZ QUE SE CREA O EDITA UNA CAJA
			Load::model( 'css' )->mount( $template_id );
			
			# EL ARCHIVO CSS SE BORRA PARA SER AUTOGENERADO CADA VEZ QUE SE CREA O EDITA UNA CAJA
			Load::model( 'js' )->mount( $template_id );
			
			# AQUI QUIERO ENVIAR LA CAJA VIA POST A UNA URL PARA GUARDARLA EN REMOTO A OTRO SERVER
			
			return $this->id;
		}
	}

	/**
	 */
	public function getTemplateIdByParent( $parents, $id )
    {
		if ( $parents == 'templates' ) return $id;
		
		$item = Load::model( $parents )->find( $id );
		
		if ( isset( $item->templates_id ) ) return $item->templates_id;
		
		$this->getTemplateIdByParent( $item->parents,  $item->parents_id );
	}
	
	/**
	 */
	public function read( $parents, $parent_id, $hook='Page' )
	{
		$boxes = Load::model( 'boxes' )->find( "conditions: parents='$parents' AND parents_id=$parent_id AND hook='$hook'", "order: weight" );
		if ( ! $boxes ) return;

		foreach ( $boxes as $box )
		{
			$box->childrens = $this->read( 'boxes', $box->id );
			$a[] = $box;
		}
		return $a;
	}
	
	/**
	 */
	public function quit( $id )
    {
		Load::model( 'boxes' )->delete( $id );
		#$boxes = Load::model( 'boxes' )->find( "conditions: boxes_id=$id" );
		#if ( ! $boxes ) return;		
		#foreach ( $boxes as $box ) $this->quit( $box->id );
	}	
}
