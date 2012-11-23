<?php

/**
 */
class Pages extends ActiveRecord
{				
	/**
	 */
	public function keep( $post )
    {
		if ( ! empty( $post['id'] ) ) $this->find( $post['id'] );
		
		$this->templates_id = $post['templates_id'];
		$weight = explode( '.', $post['weight'] );
		$this->level1 = $weight[0];
		$this->level2 = $weight[1];
		$this->url = $post['url'];
		$this->title = $post['title'];
		
		if ( $this->save() ) return $this->id;
	}
}
