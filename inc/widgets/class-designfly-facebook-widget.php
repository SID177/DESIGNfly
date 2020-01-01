<?php
/**
 * Facebook Widget Class
 * 
 * @package DESIGNfly
 */
class DESIGNfly_Facebook_Widget extends WP_Widget {
    // Default App ID.
    private $default_app_id = '503595753002055';
    // Default FB URL.
    private $default_fb_url = 'https://www.facebook.com/rtCamp.solutions/';

    /** constructor */
    public function __construct() {
		parent::__construct(
			'DESIGNfly_Facebook_Widget', // Base ID
			esc_html__( 'DESIGNfly Facebook', 'designfly' ), // Name
			array( 'description' => esc_html__( 'A Widget to show Facebook details.', 'designfly' ), ) // Args
		);
	}
    
    /** @see WP_Widget::widget */
    function widget( $args , $instance ) {

        $title                          =   apply_filters( 'widget_title' , $instance['title'] );
        $app_id                         =   empty( $instance['app_id'] ) ? $this->default_app_id : $instance['app_id'];
        $fb_url                         =   empty( $instance['fb_url'] ) ? $this->default_fb_url : $instance['fb_url'];
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
        }

        wp_register_script( 'designfly-fbwidgetscript' , get_template_directory_uri() . '/js/fb-widget.js', array( 'jquery' ), '1.0' );
        wp_enqueue_script( 'designfly-fbwidgetscript' );
        wp_localize_script( 'designfly-fbwidgetscript', 'designfly_fbwidgetscript_vars', array( 'app_id' => $app_id ) );
        
        echo '<div class="fb_loader" style="text-align: center !important;"><img src="' . get_template_directory_uri() . '/img/loader.gif" alt="DESIGNfly Facebook Widget" /></div>';
        echo '<div id="fb-root"></div>
        <div class="fb-page" data-href="' . esc_url( $fb_url ) . ' " data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="on" data-show-posts="on" hide_cta="false" data-tabs="timeline"></div>';
        echo $args['after_widget'];

    }

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title']  = sanitize_text_field( $new_instance['title'] );
        $instance['app_id'] = sanitize_text_field( $new_instance['app_id'] );
        $instance['fb_url'] = sanitize_text_field( $new_instance['fb_url'] );
        
        return $instance;
    }

    /** @see WP_Widget::form */
    function form( $instance ) {
        $title          =   ( ! empty( $instance['title'] ) ? $instance['title'] : '' );
        $app_id         =   ( ! empty( $instance['app_id'] ) ? $instance['app_id'] : $this->default_app_id );
        $fb_url         =   ( ! empty( $instance['fb_url'] ) ? $instance['fb_url'] : $this->default_fb_url );
        ?>
        
        <p>
            <label for="<?= $this->get_field_id( 'title' ) ?>"><?= esc_html__( 'Title:', 'designfly' ) ?></label>
            <input class="widefat" id="<?= $this->get_field_id( 'title' ) ?>" name="<?= $this->get_field_name( 'title' ) ?>" type="text" value="<?= esc_attr( $title ) ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id( 'app_id' ) ?>"><?= esc_html__( 'Facebook Application Id:', 'designfly' ) ?></label>
            <input class="widefat" id="<?= $this->get_field_id( 'app_id' ) ?>" name="<?= $this->get_field_name( 'app_id' ) ?>" type="text" value="<?= esc_attr( $app_id ) ?>" />
        </p>
        <p>
            <label for="<?= $this->get_field_id( 'fb_url' ) ?>"><?= esc_html__( 'Facebook Page Url:', 'designfly' ) ?></label>
            <input class="widefat" id="<?= $this->get_field_id( 'fb_url' ) ?>" name="<?= $this->get_field_name( 'fb_url' ) ?>" type="text" value="<?= esc_attr( $fb_url ) ?>" />
            <small>
                <?= esc_html__( 'Works with only', 'designfly' ) ?>
                <a href="http://www.facebook.com/help/?faq=174987089221178" target="_blank">
                    <?= esc_html__( 'Valid Facebook Pages', 'designfly' ) ?>
                </a>
            </small>
        </p>
        
        <?php
    }
}
