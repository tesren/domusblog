<?php

class Walker_Nav_Primary extends Walker_Nav_Menu{

	/**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */

	function start_lvl( &$output, $depth = 0, $args = array() ){//ul
		$indent = str_repeat("\t", $depth);
		$submenu = ($depth > 0) ? ' sub-menu bg-azul mx-5' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}

	 /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0){//li a span

		$indent = ( $depth ) ? str_repeat("\t", $depth) : '';

		$li_attributes = "";
		$class_names = $value = "";

		$classes = empty( $item->classes ) ? array() : (array) $item->classes; 

		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'nav-item';
		if( $depth && $args->walker->has_children ){
			$classes[] = 'dropdown-submenu';
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr($class_names) . '"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen( $id ) ? ' id="'. esc_attr( $id ) .'"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
		$attributes .= ! empty( $item->ID ) ? ' id="' . esc_attr($item->ID) . '"' : '';

		$attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" id="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : 'class="nav-link c21-link-nav"';

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $depth == 0 && $args->walker->has_children ) ? '</a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	/*function end_el(){} //closing li a span

	function end_lvl(){} //closing ul */

}