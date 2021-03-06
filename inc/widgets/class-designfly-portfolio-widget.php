<?php
/**
 * Custom widget to display portfolios.
 *
 * @package DESIGNfly
 */

/**
 * Adds DESIGNfly_Portfolio_Widget.
 */
class DESIGNfly_Portfolio_Widget extends WP_Widget {
	/**
	 * Default number of items to show.
	 *
	 * @var int
	 */
	private $default_nois = 8;

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'DESIGNfly_Portfolio_Widget', // Base ID.
			esc_html__( 'DESIGNfly Portfolios', 'designfly' ), // Name.
			array( 'description' => esc_html__( 'A Widget to show Portfolios', 'designfly' ) ) // Args.
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
		$posts = get_posts(
			array(
				'post_type'    => 'designfly_portfolio',
				'numberposts'  => ( ! empty( $instance['nois'] ) ? $instance['nois'] : $this->default_nois ),
				'post_status'  => 'publish',
				'meta_key'     => '_thumbnail_id',
				'meta_compare' => 'EXISTS',
			)
		);

		if ( ! empty( $posts ) ) :

			echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			echo '<div class="portfolio-widget-block">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			foreach ( $posts as $post ) {
				echo '<img src="' . get_the_post_thumbnail_url( $post ) . '">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			echo '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

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
		$title = ( ! empty( $instance['title'] ) ? $instance['title'] : '' );
		$nois  = ( ! empty( $instance['nois'] ) ? $instance['nois'] : $this->default_nois );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'designfly' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['nois']  = ( ! empty( $new_instance['nois'] ) ) ? sanitize_text_field( $new_instance['nois'] ) : $this->default_nois;

		return $instance;
	}
} // close DESIGNfly_Portfolio_Widget.
