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

    private $consumer_key    = 'FPYSYWIdyUIQ76Yz5hdYo5r7y';
    private $consumer_secret = 'GqPj9BPgJXjRKIGXCULJljocGPC62wN2eeMSnmZpVelWreFk9z';

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
        $tweets = $this->get_tweets( $instance );

        if ( empty( $tweets ) ) {
            return;
        }

        $title = apply_filters( 'widget_title' , $instance['title'] );

        $screen_name = get_option( 'screen_name', 'rtCamp' );
        $follow      = '<div><form method="get" action="https://twitter.com/' . esc_attr( $screen_name ) . '"><button type="submit" class="twitter-follow-button"><span class="dashicons dashicons-twitter"></span>' . esc_html__( 'Follow us', 'designfly' ) . '</button></form></div>';
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . esc_html( $title ) . $follow . $args['after_title'];
        }

        foreach ( $tweets as $tweet ) {
            ?>
            <div class="designfly-tweet-block">
                <div class="designfly-tweet-block-header">
                    <img src="<?= esc_url( $tweet['user']['profile_image_url_https'] ) ?>" alt="<?= esc_attr( $tweet['user']['name'] ) ?>">
                    <div class="designfly-tweet-header-block">
                        <div class="designfly-tweet-name-handle">
                            <span class="designfly-tweet-name"><?= esc_html( $tweet['user']['name'] ) ?></span>
                            <span class="designfly-tweet-handle"><a target="_blank" href="<?= esc_url( $tweet['user']['url'] ) ?>"><?= esc_html( '@' . $tweet['user']['screen_name'] ) ?></a></span>
                        </div>
                        <span class="designfly-tweet-time"><?= esc_html( $this->time2str( $tweet['created_at'] ) ) ?></span>
                    </div>
                </div>
                <p class="designfly-tweet-text"><?= esc_html( $tweet['text'] ) ?></p>
            </div>
            <?php
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
        $instance['nots']  = sanitize_text_field( $new_instance['nots'] );
        
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

    /**
     * Converts timestamp or string time to relative time.
     * 
     * @param String $ts Timestamp.
     * 
     * @return String Formatted date.
     */
    private function time2str( $ts ) {
        if ( ! ctype_digit( $ts ) ) {
            $ts = strtotime( $ts );
        }
    
        $diff = time() - $ts;

        if ( 0 == $diff ) {
            
            return 'now';

        } elseif ( $diff > 0 ) {
            
            $day_diff = floor( $diff / 86400 );
            if ( 0 == $day_diff ) {
                
                if ( $diff < 60 ) { 
                    return 'now'; 
                }
                if ( $diff < 120 ) { 
                    return '1 min'; 
                }
                if ( $diff < 3600 ) { 
                    return floor( $diff / 60 ) . ' min'; 
                }
                if ( $diff < 7200 ) { 
                    return '1h'; 
                }
                if ( $diff < 86400 ) { 
                    return floor( $diff / 3600 ) . 'h'; 
                }

            }

            if ( 1 == $day_diff ) { 
                return 'Yesterday'; 
            }
            if ( $day_diff < 7 ) { 
                return $day_diff . ' days'; 
            }
            if ( $day_diff < 31 ) { 
                return ceil( $day_diff / 7 ) . ' weeks'; 
            }
            if ( $day_diff < 60 ) { 
                return 'last month'; 
            }
            
            return date( 'F Y', $ts );

        } else {
            
            $diff     = abs( $diff );
            $day_diff = floor( $diff / 86400 );
            
            if ( 0 == $day_diff ) {
                
                if ( $diff < 120 ) { 
                    return '1 min'; 
                }
                if ( $diff < 3600 ) { 
                    return floor( $diff / 60 ) . ' min'; 
                }
                if ( $diff < 7200 ) { 
                    return '1h'; 
                }
                if ( $diff < 86400 ) { 
                    return floor( $diff / 3600 ) . 'h'; 
                }

            }

            if ( 1 == $day_diff ) { 
                return 'Tomorrow'; 
            }
            if ( $day_diff < 4 ) { 
                return date( 'l', $ts ); 
            }
            if ( $day_diff < 7 + ( 7 - date( 'w' ) ) ) { 
                return 'next week'; 
            }
            if ( ceil( $day_diff / 7 ) < 4 ) {
                return 'in ' . ceil( $day_diff / 7 ) . ' weeks'; 
            }
            if ( date( 'n', $ts ) === date( 'n' ) + 1 ) { 
                return 'next month'; 
            }

            return date( 'F Y', $ts );
        }
    }

    /**
     * Gets tweet from tweeter API.
     * 
     * @param Array $args Array of widget arguments.
     * 
     * @return Array Tweets.
     */
    private function get_tweets( $args ) {
        $oauth_token        = get_option( 'oauth_token' );
        $oauth_token_secret = get_option( 'oauth_token_secret' );
        $screen_name        = get_option( 'screen_name', 'rtCamp' );

        if ( empty( $oauth_token_secret ) || empty( $oauth_token ) ) {
            return false;
        }

        $oauth_access_token        = $oauth_token;
        $oauth_access_token_secret = $oauth_token_secret;
        $consumer_key              = $this->consumer_key;
        $consumer_secret           = $this->consumer_secret;
        
        $twitter_timeline = "user_timeline";

        $request = array(
            'count'       => ( ! empty( $args['nots'] ) ? $args['nots'] : '1' ),
            'screen_name' => 'rtCamp',
        );
        
        $oauth = array(
            'oauth_consumer_key' => $consumer_key,
            'oauth_nonce' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_token' => $oauth_access_token,
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0',
        );

        $oauth = array_merge( $oauth, $request );
         
        // make base string
        $baseURI = "https://api.twitter.com/1.1/statuses/$twitter_timeline.json";
        $method = "GET";
        $params = $oauth;
         
        $r = array();
        ksort( $params );
        foreach ( $params as $key => $value ) {
            $r[] = "$key=" . rawurlencode( $value );
        }
        $base_info = $method. "&" . rawurlencode( $baseURI ) . '&' . rawurlencode( implode( '&', $r ) );
        $composite_key = rawurlencode( $consumer_secret ) . '&' . rawurlencode( $oauth_access_token_secret );
         
        // get oauth signature
        $oauth_signature = base64_encode( hash_hmac( 'sha1', $base_info, $composite_key, true ) );
        $oauth['oauth_signature'] = $oauth_signature;

        $r = 'Authorization: OAuth ';
 
        $values = array();
        foreach ( $oauth as $key => $value ) {
            $values[] = "$key=\"" . rawurlencode( $value ) . "\"";
        }
        $r .= implode( ', ', $values );
        
        // get auth header
        $header = array( $r, 'Expect:' );
        
        // set cURL options
        $options = array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query( $request ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true
        );

        $feed = curl_init();
        curl_setopt_array( $feed, $options );
        $json = curl_exec( $feed );
        curl_close( $feed );
        
        // decode json format tweets
        $tweets = json_decode( $json, true );

        if ( empty( $tweets ) ) {
            return false;
        }

        return $tweets;
    }
}
