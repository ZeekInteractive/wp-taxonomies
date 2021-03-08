<?php

namespace App\Taxonomies;

use Zeek\Modernity\Traits\Singleton;

abstract class Taxonomy {
	use Singleton;

	protected string $slug;
	protected string $singular;
	protected array $postTypes = [];

	protected bool $public = true;
	protected bool $show_ui = true;
	protected bool $show_in_menu = true;
	protected bool $show_in_nav_menus = true;
	protected bool $show_admin_column = true;
	protected bool $hierarchical = true;
	protected bool $has_archive = true;
	protected bool $show_in_rest = true;

	protected function __construct() {
		add_action( 'init', [ $this, 'init' ], 5 );
	}

	public function init() {
		register_taxonomy( $this->slug, $this->postTypes, [
			'labels'            => $this->taxonomylabels( $this->singular ),
			'hierarchical'      => $this->hierarchical,
			'public'            => $this->public,
			'show_ui'           => $this->show_ui,
			'show_in_menu'      => $this->show_in_menu,
			'show_in_nav_menus' => $this->show_in_nav_menus,
			'show_admin_column' => $this->show_admin_column,
			'has_archive'       => $this->has_archive,
			'show_in_rest'      => $this->show_in_rest,
		] );
	}

	private function taxonomylabels( string $singular ) {
		$plural = pluralize( $singular );

		return [
			'name'               => $plural,
			'singular_name'      => $singular,
			'menu_name'          => $plural,
			'all_items'          => $plural,
			'edit_item'          => 'Edit ' . $plural,
			'view_item'          => 'View ' . $plural,
			'update_item'        => 'Update ' . $singular,
			'add_new_item'       => 'Add New ' . $singular,
			'new_item_name'      => 'New ' . $singular,
			'parent_item'        => 'Parent ' . $singular,
			'parent_item_colon'  => 'Parent ' . $singular . ':',
			'search_items'       => 'Search ' . $plural,
			'popular_items'      => 'Popular ' . $plural,
			'not_found'          => 'No ' . $plural . ' found',
			'not_found_in_trash' => 'No ' . $plural . ' found in Trash',
		];
	}
}
