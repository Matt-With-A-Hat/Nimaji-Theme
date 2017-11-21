<?php
// Register and load the widget
function wpb_load_latest_posts_widget() {
	register_widget( 'LatestPostsWidget' );
}

add_action( 'widgets_init', 'wpb_load_latest_posts_widget' );

// Creating the widget
class LatestPostsWidget extends WP_Widget {

	function __construct() {
		parent::__construct(

// Base ID of your widget
			'latest_posts_widget',

// Widget name will appear in UI
			__( 'LatestPostsWidget', 'latest_posts_widget' ),

// Widget description
			array( 'description' => __( 'Widget to display the latest posts', 'latest posts widget' ), )
		);
	}

// Creating widget front-end

	public function widget( $args, $instance ) {
		$title    = apply_filters( 'widget_title', $instance['title'] );
		$category = $instance['category'];
		if ( ! empty( $title ) ) {
			$title = $args['before_title'] . $title . $args['after_title'];
		}

		//get posts by category
		$args        = array(
			'numberposts'      => 10,
			'category'         => $category,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'suppress_filters' => true
		);
		$latestPosts = get_posts( $args );

		$htmlPostTitleList = '';
		foreach ( $latestPosts as $post ) {
			$htmlPostTitleList .= "<a class='neat-link' href='$post->guid' title='$post->post_title'><li>$post->post_title</li></a>";
		}

		//Template
		?>
		<div class="box--normal box--widget">
			<?= $title; ?>
			<ul class="bullet-list">
				<?= $htmlPostTitleList; ?>
			</ul>
		</div>

		<?php
		echo $args['after_widget'];
	}

// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'New title', 'wpb_widget_domain' );
		}

		$categories     = nimaji_get_post_categories();
		$htmlCategories = '';
		foreach ( $categories as $category ) {
			$htmlCategories .= "<option value='$category->cat_ID'>$category->cat_name</option>";
		}

// Widget admin form
		?>
		<p>
			<label for="<?= $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?= $this->get_field_id( 'title' ); ?>" name="<?= $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label for="<?= $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:' ); ?></label>
			<select class="widefat form-control" id="<?= $this->get_field_id( 'category' ); ?>" name="<?= $this->get_field_name( 'category' ); ?>">
				<?= nimaji_get_post_categories( true ) ?>
			</select>
		</p>
		<?php
	}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance             = array();
		$instance['title']    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['category'] = ( ! empty( $new_instance['category'] ) ) ? strip_tags( $new_instance['category'] ) : '';

		return $instance;
	}
} // Class wpb_widget ends here