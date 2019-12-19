<?php
/**
 * Custom widget to display popular/recent/related posts.
 *
 * @package DESIGNfly
 */

/**
 * Adds DESIGNfly_Portfolio_Widget.
 */
class DESIGNfly_Posts_Widget extends WP_Widget {
    // Default number of items to show.
	private $default_nois = 5;
	// Default post type to show.
	private $default_type = 'popular';

    /**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'DESIGNfly_Posts_Widget', // Base ID
			esc_html__( 'DESIGNfly Posts', 'designfly' ), // Name
			array( 'description' => esc_html__( 'A Widget to show popular/recent/related posts', 'designfly' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$qry_args = array(
			'post_type'      => 'post',
            'numberposts'    => ( ! empty( $instance['nois'] ) ? $instance['nois'] : $this->default_nois ),
            'post_status'    => 'publish'
		);

		if ( 'popular' === $instance['type'] ) {
			$qry_args['meta_key'] = 'designfly_post_views_count';
			$qry_args['orderby']  = array( 'meta_value_num' => 'DESC' );
		}

		if ( 'recent' === $instance['type'] ) {
			if ( ! is_singular() ) {
				return;
			}
		}

		if ( 'related' === $instance['type'] ) {
			if ( ! is_singular() ) {
				return;
			}

			$qry_args['post__not_in'] = array( get_the_ID() );

			$terms = get_terms( array(
				'object_ids' => get_the_ID(),
				'hide_empty' => false,
				'fields'     => 'ids'
			) );
			
			$qry_args['tag__in'] = $terms;
		}

		$posts = get_posts( $qry_args );

        if ( ! empty( $posts ) ) :

            echo $args['before_widget'];
            if ( ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
            }
            echo '<div class="designfly-posts-widget-block">';

            foreach ( $posts as $post ) {

				?>
				<div class="widget-post-block">
					<?php if ( has_post_thumbnail( $post ) ) : ?>
						<img src="<?= esc_url( get_the_post_thumbnail_url( $post ) ) ?>">
					<?php endif; ?>
					<div class="widget-post-details">
						<span class="post-title">
							<a class="post-title-link" href="<?= esc_url( get_post_permalink( $post ) ) ?>">
								<?= get_the_title( $post ); ?>
							</a>
						</span>
						<span class="post-meta">
							<?php
							designfly_posted_by( $post );
							echo '&nbsp;';
							designfly_posted_on( $post );
							?>
						</span>
					</div>
				</div>
				<?php
            }

            echo '</div>';
            echo $args['after_widget'];

        endif;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$nois  = ! empty( $instance['nois'] ) ? $instance['nois'] : esc_html__( $this->default_nois, 'designfly' );
		$type  = ! empty( $instance['type'] ) ? $instance['type'] : esc_html__( $this->default_type, 'designfly' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'designfly' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_attr_e( 'Type of Posts:', 'designfly' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>">
				<option <?php selected( $type, 'popular' ); ?> value="<?= esc_html( 'popular' ) ?>"><?= esc_html__( 'Popular Posts', 'designfly' ) ?></option>
				<option <?php selected( $type, 'recent' ); ?> value="<?= esc_html( 'recent' ) ?>"><?= esc_html__( 'Recent Posts', 'designfly' ) ?></option>
				<option <?php selected( $type, 'related' ); ?> value="<?= esc_html( 'related' ) ?>"><?= esc_html__( 'Related (to current post) Posts', 'designfly' ) ?></option>
			</select>
		</p>
        <p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'nois' ) ); ?>"><?php esc_attr_e( 'Number of items:', 'designfly' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'nois' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nois' ) ); ?>" type="number" value="<?php echo esc_attr( $nois ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['nois']  = ( ! empty( $new_instance['nois'] ) ) ? sanitize_text_field( $new_instance['nois'] ) : $this->default_nois;
		$instance['type']  = ( ! empty( $new_instance['type'] ) ) ? sanitize_text_field( $new_instance['type'] ) : $this->default_type;

		return $instance;
	}
} // close DESIGNfly_Portfolio_Widget.