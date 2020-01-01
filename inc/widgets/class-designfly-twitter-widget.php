<?php
/**
 * Custom widget to display twitter page and timeline.
 *
 * @package DESIGNfly
 */

/**
 * Adds DESIGNfly_Twitter_Widget.
 */
class DESIGNfly_Twitter_Widget extends WP_Widget {

    /**
	 * Register widget with WordPress.
	 */
    public function __construct() {
		parent::__construct(
			'DESIGNfly_Twitter_Widget', // Base ID
			esc_html__( 'DESIGNfly Twitter', 'designfly' ), // Name
			array( 'description' => esc_html__( 'A Widget to show Twitter feeds.', 'designfly' ), ) // Args
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
    function widget( $args , $instance ) {

        $title = apply_filters( 'widget_title' , $instance['title'] );
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
        }

        echo $args['after_widget'];

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
    function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['nots'] = sanitize_text_field( $new_instance['nots'] );
        
        return $instance;
    }

    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
    function form( $instance ) {
        $title = ( ! empty( $instance['title'] ) ? $instance['title'] : '' );
        $nots = ( ! empty( $instance['nots'] ) ? $instance['nots'] : '' );

        $oauth_token = get_option( 'oauth_token' );
        if ( empty( $oauth_token ) ) {
            echo '<p class="designfly-config-warning"><a target="_blank" href="' . esc_url( admin_url( 'admin.php?page=designfly-twitter-configuration' ) ) . '">' . esc_html__( 'Twitter Configuration', 'designfly' ) . '</a>' . esc_html__( ' is not set, please set them first.', 'designfly' ) . '</p>';
        }
        ?>
        
        <p>
            <label for="<?= $this->get_field_id( 'title' ) ?>"><?= esc_html__( 'Title:', 'designfly' ) ?></label>
            <input class="widefat" id="<?= $this->get_field_id( 'title' ) ?>" name="<?= $this->get_field_name( 'title' ) ?>" type="text" value="<?= esc_attr( $title ) ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id( 'nots' ) ?>"><?= esc_html__( 'Number of Tweets:', 'designfly' ) ?></label>
            <input class="widefat" id="<?= $this->get_field_id( 'nots' ) ?>" name="<?= $this->get_field_name( 'nots' ) ?>" type="number" value="<?= esc_attr( $nots ) ?>" />
        </p>
        
        <?php
    }
}
