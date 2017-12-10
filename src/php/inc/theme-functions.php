<?php
function is_local() {

	$ip = $_SERVER['REMOTE_ADDR'];

	$whitelist = array(
		'89.0.223.149',
		'127.0.0.1',
		'::1'
	);

	if ( in_array( $ip, $whitelist ) ) {
		return true;
	} else {
		return false;
	}
}

add_filter( "the_content", "add_class_to_content" );

function add_class_to_content( $content ) {
	return str_replace( '<p', '<p class="hyphenate"', $content );
}

if ( ! function_exists( 'nimaji_get_menu_items' ) ) {

	/**
	 * get the menu items as seperate arrays
	 *
	 * @param $theme_location
	 *
	 * @return mixed
	 */
	function nimaji_get_menu_items( $theme_location ) {
		if ( ( $theme_location ) AND ( $locations = get_nav_menu_locations() ) AND isset( $locations[ $theme_location ] ) ) {

			$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );

			//create arrays with main items and sub items of menu
			foreach ( $menu_items as $menu_item ) {
				if ( $menu_item->menu_item_parent == '0' ) {
					$items_level_1[]     = $menu_item;
					$items_level_1_ids[] = $menu_item->ID;      //build an array of main menu item ids, so as to check if a sub items parent is a main item later on
				} else {
					$sub_items[] = $menu_item;
//					$items_level_2[$menu_item->menu_item_parent][] = $menu_item;
				}
			}

			// check if subitem is level 2
			if ( $sub_items !== null AND $items_level_1_ids !== null ) {
				foreach ( $sub_items as $sub_item ) {
					if ( in_array( $sub_item->menu_item_parent, $items_level_1_ids ) ) {
						$items_level_2[ $sub_item->menu_item_parent ][] = $sub_item;
						$items_level_2_ids[]                            = $sub_item->ID;
					} else {
						$sub_items_3_4[] = $sub_item;
					}
				}
			}

			//check if subitem is level 3 or level 4
			if ( $sub_items_3_4 !== null AND $items_level_2_ids !== null ) {
				foreach ( $sub_items_3_4 as $sub_item ) {
					if ( in_array( $sub_item->menu_item_parent, $items_level_2_ids ) ) {
						$items_level_3[ $sub_item->menu_item_parent ][] = $sub_item;
					} else {
						$items_level_4[ $sub_item->menu_item_parent ][] = $sub_item;
						$items_level_4_ids[]                            = $sub_item->ID;
					}
				}
			}

			$items[0] = $items_level_1;
			$items[1] = $items_level_2;
			$items[2] = $items_level_3;
			$items[3] = $items_level_4;

			return $items;
		}
		echo "Theme location doesn't exist<br>";

		return null;
	}
}


if ( ! function_exists( 'nimaji_menu' ) ) {

	function nimaji_menu( $theme_location ) {

		$items = nimaji_get_menu_items( $theme_location );

		if ( $items === null ) {
			return null;
		}

		$items_level_1 = $items[0];
		$items_level_2 = $items[1];
		$items_level_3 = $items[2];

		$html = '<div class="menu-logo">';
//		$html .= '<a href="' . get_home_url() . '" class="navbar-brand custom-logo-link" rel="home" itemprop="url"><img width="77" height="40" src="' . get_template_directory_uri() . '
//		/img/maehroboter-logo.svg" class="img-responsive" alt="Mähroboter Guru" itemprop="logo"></a>';
		$html .= get_custom_logo();
		$html .= '</div>';
		$html .= '<div id="nimaji-menu">';
		$html .= '<ul>';

		foreach ( $items_level_1 as $item_level_1 ) {

			if ( ! $items_level_2[ $item_level_1->ID ] ) {
				$html .= "<li><a href='$item_level_1->url' title='$item_level_1->title'>$item_level_1->title</a></li>";
			} else {
				$html .= "<li><a href='$item_level_1->url' title='$item_level_1->title'>$item_level_1->title</a>";
				$html .= "<ul>";
				if ( $items_level_2 !== null ) {
					foreach ( $items_level_2[ $item_level_1->ID ] as $item_level_2 ) {
						if ( ! $items_level_2[ $item_level_1->ID ] ) {
							$html .= "<li><a href='$item_level_2->url' title='$item_level_2->title'>$item_level_2->title</a></li>";
						} else {
							$html .= "<li><a href='$item_level_2->url' title='$item_level_2->title'>$item_level_2->title</a>";
							if ( $items_level_3 !== null ) {
								$html .= "<ul>";
								foreach ( $items_level_3[ $item_level_2->ID ] as $item_level_3 ) {
									$html .= "<li><a href='$item_level_3->url' title='$item_level_3->title'>$item_level_3->title</a></li>";
								}
								$html .= "</ul>";
							}
							$html .= "</li>";
						}
					}
				}
				$html .= "</ul>";
				$html .= "</li>";
			}
		}

		$html .= "</ul>";
		$html .= "</div>";

		return $html;
	}
}

if ( ! function_exists( 'nimaji_mobile_menu' ) ) {

	/**
	 * Generates and prints the main menu bar and flyout
	 *
	 * @param $theme_location
	 *
	 */
	function nimaji_mobile_menu( $theme_location ) {

		if ( ( $theme_location ) AND ( $locations = get_nav_menu_locations() ) AND isset( $locations[ $theme_location ] ) ) {

			$menu       = get_term( $locations[ $theme_location ], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );

			//create arrays with main items and sub items of menu
			foreach ( $menu_items as $menu_item ) {

				if ( $menu_item->menu_item_parent == '0' ) {

					$items_level_1[]     = $menu_item;
					$items_level_1_ids[] = $menu_item->ID;      //build an array of main menu item ids, so as to check if a sub items parent is a main item later on

				} else {

					$sub_items[] = $menu_item;
//					$items_level_2[$menu_item->menu_item_parent][] = $menu_item;

				}

			}

			// check if subitem is level 2
			if ( $sub_items !== null AND $items_level_1_ids !== null ) {

				foreach ( $sub_items as $sub_item ) {

					if ( in_array( $sub_item->menu_item_parent, $items_level_1_ids ) ) {

						$items_level_2[ $sub_item->menu_item_parent ][] = $sub_item;
						$items_level_2_ids[]                            = $sub_item->ID;

					} else {

						$sub_items_3_4[] = $sub_item;

					}

				}

			}

			//check if subitem is level 3 or level 4
			if ( $sub_items_3_4 !== null AND $items_level_2_ids !== null ) {

				foreach ( $sub_items_3_4 as $sub_item ) {

					if ( in_array( $sub_item->menu_item_parent, $items_level_2_ids ) ) {

						$items_level_3[ $sub_item->menu_item_parent ][] = $sub_item;

					} else {

						$items_level_4[ $sub_item->menu_item_parent ][] = $sub_item;
						$items_level_4_ids[]                            = $sub_item->ID;

					}

				}

			}

			//create menu output
			$menu_list = '<nav class="mobile-menu">';
			$menu_list .= '<div class="menu-list">';
			$menu_list .= '<ul id="menu-content" class="menu-content collapse out">';

			foreach ( $items_level_1 as $item_level_1 ) {

				if ( ! $items_level_2[ $item_level_1->ID ] ) {
					$menu_list .= '<li id="menu-' . $item_level_1->ID . '"><a href="' . $item_level_1->url . '"><span>' . $item_level_1->title . '</span></a></li>';
				} else {
					$menu_list .= '<li id="menu-' . $item_level_1->ID . '" data-toggle="collapse" data-target="#submenu-' . $item_level_1->ID . '" class="collapsed"><a href="#"> ' . $item_level_1->title . ' <span class="arrow"></span></a></li>';
					$menu_list .= '<ul class="sub-menu collapse" id="submenu-' . $item_level_1->ID . '">';

					foreach ( $items_level_2[ $item_level_1->ID ] as $item_level_2 ) {
						$menu_list .= '<li id="menu-' . $item_level_2->ID . '"><a href="' . $item_level_2->url . '"><span>' . $item_level_2->title . '</span></a></li>';
					}

					$menu_list .= '</ul>';
				}
			}

			//closw row
			$menu_list .= '</ul>';
			$menu_list .= '</div>';
			$menu_list .= '</nav>';

			echo $menu_list;
		}
	}
}

/**
 * @return array
 */
function nimaji_get_post_categories( $html = false ) {
	$args = array(
		'hide_empty' => 0,
		'orderby'    => 'name'
	);

	$categories     = get_categories( $args );
	$htmlCategories = '';
	if ( $html ) {
		foreach ( $categories as $category ) {
			$htmlCategories .= "<option value='$category->cat_ID'>$category->cat_name</option>";
		}

		return $htmlCategories;
	} else {
		return $categories;
	}
}

/**
 * @return mixed
 */
function allowed_upload_extensions() {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'allowed_upload_extensions' );