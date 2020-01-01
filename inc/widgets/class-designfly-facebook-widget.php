<?php
/**
 * Custom widget to display facebook page and timeline.
 *
 * @package DESIGNfly
 */

/**
 * Adds DESIGNfly_Facebook_Widget.
 */
class DESIGNfly_Facebook_Widget extends WP_Widget {
	/**
	 * Default App ID.
	 *
	 * @var string
	 */
	private $default_app_id = '503595753002055';
	/**
	 * Default FB URL.
	 *
	 * @var string
	 */
	private $default_fb_url = 'https://www.facebook.com/rtCamp.solutions/';

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'DESIGNfly_Facebook_Widget', // Base ID.
			esc_html__( 'DESIGNfly Facebook', 'designfly' ), // Name.
			array( 'description' => esc_html__( 'A Widget to show Facebook details.', 'designfly' ) ) // Args.
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

		$title  = apply_filters( 'widget_title', $instance['title'] );
		$app_id = empty( $instance['app_id'] ) ? $this->default_app_id : $instance['app_id'];
		$fb_url = empty( $instance['fb_url'] ) ? $this->default_fb_url : $instance['fb_url'];

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		wp_register_script( 'designfly-fbwidgetscript', get_template_directory_uri() . '/js/fb-widget.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'designfly-fbwidgetscript' );
		wp_localize_script( 'designfly-fbwidgetscript', 'designfly_fbwidgetscript_vars', array( 'app_id' => $app_id ) );

		echo '<div class="fb_loader" style="text-align: center !important;"><img src="' . get_template_directory_uri() . '/img/loader.gif" alt="DESIGNfly Facebook Widget" /></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<div id="fb-root"></div><div class="fb-page" data-href="' . esc_url( $fb_url ) . ' " data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="on" data-show-posts="on" hide_cta="false" data-tabs="timeline"></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

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

		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['app_id'] = sanitize_text_field( $new_instance['app_id'] );
		$instance['fb_url'] = sanitize_text_field( $new_instance['fb_url'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title  = ( ! empty( $instance['title'] ) ? $instance['title'] : '' );
		$app_id = ( ! empty( $instance['app_id'] ) ? $instance['app_id'] : $this->default_app_id );
		$fb_url = ( ! empty( $instance['fb_url'] ) ? $instance['fb_url'] : $this->default_fb_url );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'designfly' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'app_id' ) ); ?>"><?php echo esc_html__( 'Facebook Application Id:', 'designfly' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'app_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'app_id' ) ); ?>" type="text" value="<?php echo esc_attr( $app_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>"><?php echo esc_html__( 'Facebook Page Url:', 'designfly' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb_url' ) ); ?>" type="text" value="<?php echo esc_attr( $fb_url ); ?>" />
			<small>
				<?php echo esc_html__( 'Works with only', 'designfly' ); ?>
				<a href="http://www.facebook.com/help/?faq=174987089221178" target="_blank">
					<?php echo esc_html__( 'Valid Facebook Pages', 'designfly' ); ?>
				</a>
			</small>
		</p>

		<?php
	}
}
