<?php
/**
 * Class Strong_Testimonials_Average_Shortcode
 *
 * @since 2.31.0
 */

class Strong_Testimonials_Average_Shortcode {

	/**
	 * @var string
	 */
	public $shortcode = 'testimonial_average_rating';

	public function __construct() {
		add_shortcode( $this->shortcode, array( $this, 'testimonial_average_rating_shortcode' ) );
	}

	/**
	 * Return average rating.
	 *
	 * @param $atts
	 * @param null $content
	 * @since 2.31.0
	 * @return string
	 */
	public function testimonial_average_rating_shortcode( $atts, $content = null ) {
		$pairs = array(
			// parts
			'average'  => '',
			'count'    => '',
			'stars'    => '',
			// style
			'block'    => '',
			'centered' => '',
			// HTML
			'element'  => 'div', // span
			'class'    => '', // on wrapper
			// filters
			'category' => '',
		);
		$pairs = apply_filters( "wpmtst_shortcode_defaults__{$this->shortcode}", $pairs );

		$atts = shortcode_atts( $pairs, normalize_empty_atts( $atts ), $this->shortcode );

		// default parts
		if ( ! $content ) {
			$content = '{title} {stars} {summary}';
		}

		// set parts
		preg_match_all( "#{(.*?)}#", $content, $parts );
		/*
		 * Example:
		 *
		 * Array
		 * (
		 *     [0] => Array
		 *         (
		 *             [0] => {title}
		 *             [1] => {stars}
		 *             [2] => {summary}
		 *         )
		 *
		 *     [1] => Array
		 *         (
		 *             [0] => title
		 *             [1] => stars
		 *             [2] => summary
		 *         )
		 * )
		 */
		$tag_list = $parts[0];
		$tag_keys = $parts[1];
		$parts    = array_fill_keys( $tag_keys, '' );

		// get posts
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'wpm-testimonial',
			'post_status'      => 'publish',
			'suppress_filters' => true,
		);

		// category
		if ( $atts['category'] ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'wpm-testimonial-category',
					'field'    => is_numeric( $atts['category'] ) ? 'id' : 'slug',
					'terms'    => $atts['category'],
				),
			);
		}

		$args        = apply_filters( 'wpmtst_query_args', $args, $atts );
		$posts_array = get_posts( $args );

		// get summary
		$summary = $this->get_summary( $posts_array );
		/*
		 * Example:
		 *
		 * Array
         * (
         *     [review_count] => 2
         *     [rating_count] => 2
         *     [rating_sum] => 10
         *     [rating_average] => 5
         *     [rating_detail] => Array
         *         (
         *             [5] => 2
         *             [4] => 0
         *             [3] => 0
         *             [2] => 0
         *             [1] => 0
         *             [0] => 0
         *         )
         * )
		 */

		// Want to build your own HTML? Return any truthy value to short-circuit this shortcode output.
		$html = apply_filters( 'wpmtst_average_rating_pre_html', '', $atts, $summary );
		if ( $html ) {
			return $html;
		}

		// assemble classes
		$class_list = array_filter( array_merge( array( 'strong-rating-wrapper', 'average' ), explode( ' ', $atts['class'] ) ) );
		if ( $atts['block'] ) {
			$class_list[] = 'block';
		}
		if ( $atts['centered'] ) {
			$class_list[] = 'centered';
		}

		// title
		if ( isset( $parts['title'] ) ) {
			$parts['title'] = sprintf( '<span class="strong-rating-title">%s</span>', __( 'Average Rating:', 'strong-testimonials' ) );
		}
		if ( isset( $parts['title2'] ) ) {
			/* translators: %s is a number */
		    $count = sprintf( _n( 'Average of %s Rating:', 'Average of %s Ratings:', $summary['rating_count'], 'strong-testimonials' ), $summary['rating_count'] );
			$parts['title2'] = sprintf( '<span class="strong-rating-title">%s</span>', $count );
		}

		// stars
		if ( isset( $parts['stars'] ) ) {
			$parts['stars'] = $this->print_stars( wpmtst_round_to_half( $summary['rating_average'] ) );
		}

		// average
		if ( isset( $parts['average'] ) ) {
		    if(!$summary['rating_average']){
                $parts['average'] = sprintf( '<span class="strong-rating-average">0</span>', $summary['rating_average'] );
            }else{
                $parts['average'] = sprintf( '<span class="strong-rating-average">%s</span>', $summary['rating_average'] );
            }
		}

		// count
		if ( isset( $parts['count'] ) ) {
			$parts['count'] = sprintf( '<span class="strong-rating-count">%s</span>', $summary['rating_count'] );
		}

		// summary phrase
		if ( isset( $parts['summary'] ) ) {

			/* translators: %s is a number */
			$average = sprintf( _n( '%s star', '%s stars', $summary['rating_average'], 'strong-testimonials' ), $summary['rating_average'] );
			$count   = sprintf( _n( '(based on %s rating)', '(based on %s ratings)', $summary['rating_count'], 'strong-testimonials' ), $summary['rating_count'] );
			$parts['summary'] = sprintf( '<span class="strong-rating-summary">%s</span>', $average . ' ' . $count );

		} elseif ( isset( $parts['summary2'] ) ) {

			/* translators: %s is a number */
			$average = sprintf( _n( '%s star', '%s stars', $summary['rating_average'], 'strong-testimonials' ), $summary['rating_average'] );
			$parts['summary2'] = sprintf( '<span class="strong-rating-summary">%s</span>', $average );

		}

		// replace tags
		foreach ( $tag_list as $key => $tag ) {
			$content = str_replace( $tag, $parts[ $tag_keys[ $key ] ], $content );
		}

		// assemble it
		$html = sprintf( '<%s class="%s">%s</%s>', $atts['element'], join( ' ', $class_list ), $content, $atts['element'] );

		wp_enqueue_style( 'wpmtst-rating-display' );

		return apply_filters( 'wpmtst_average_rating_html', $html, $atts, $summary );
	}

	/**
	 * Calculate and return the average rating.
	 *
	 * @param $posts
	 * @since 1.1.0
	 * @return array|null
	 */
	public function get_summary( $posts = null ) {
		// Set a placeholder.
		$average = array(
			'review_count'   => null,
			'rating_count'   => null,
			'rating_sum'     => null,
			'rating_average' => null,
			'rating_detail'  => null,
		);

		if ( $posts ) {

			// initialize totals
			$review_count  = count( $posts );
			$rating_count  = 0;
			$rating_sum    = 0;
			// initial values for each rating
			$rating_detail = array_fill_keys( array( 5, 4, 3, 2, 1, 0 ), 0 );

			foreach ( $posts as $post ) {
				// get rating value
				$value = $this->get_rating_value( $post );
				// add to detail array
				$rating_detail[ $value ]++;
				// add to count and sum
				if ( $value ) {
					$rating_sum += $value;
					$rating_count++;
				}
			}

			if ( $rating_count ) {
				$average = array(
					'review_count'   => number_format( $review_count ),
					'rating_count'   => number_format( $rating_count ),
					'rating_sum'     => number_format( $rating_sum ),
					'rating_average' => trim( number_format( $rating_sum / $rating_count, 1 ), '.0' ),
					'rating_detail'  => $rating_detail,
				);
			}

		}

		return $average;
	}

	/**
	 * Return the rating value for a single post.
	 *
	 * @param $post
	 * @since 1.1.0
	 * @return int|null
	 */
	private function get_rating_value( $post ) {
		$rating_field = $this->find_first_rating_field();

		if ( $rating_field ) {
            $rating = intval( get_post_meta( $post->ID, $rating_field['name'], true ) );
            if ( ! $rating ) {
                $rating = intval( $rating_field['default_display_value'] );
            }
		} else {
			$rating = 5;
		}

		return $rating;
	}

	/**
	 * Find the first rating field.
	 *
	 * @since 1.1.0
	 * @return bool|int|string
	 */
	private function find_first_rating_field() {
		$fields = wpmtst_get_custom_fields();
		foreach ( $fields as $key => $field ) {
			if ( 'rating' == $field['input_type'] ) {
				return $field;
			}
		}

		return false;
	}

	/**
	 * Print the stars.
	 *
	 * @param double $rating Rounded to half.
	 * @param string $class  The container CSS class.
	 * @since 2.31.0
	 * @return string
	 */
	public function print_stars( $rating = 0.0, $class = 'strong-rating' ) {
		$rating  = (double) $rating;
		$is_zero = ( 0 == $rating ) ? ' current' : '';
		ob_start();
		?>
		<span class="<?php echo esc_attr( $class ); ?>">
            <span class="star0 star<?php echo $is_zero; ?>"></span>
			<?php
			if ( $is_zero ) {
				echo str_repeat( '<span class="star"></span>', 5 );
			} else {
				for ( $i = 1; $i <= 5; $i++ ) {
					$star_class = 'star';
					if ( $i == round( $rating ) ) {
						$star_class .= ' current';
					}
					if ( 0.5 == $i - $rating ) {
						$star_class .= ' half';
					}
					printf( '<span class="%s"></span>', $star_class );
				}
			}
			?>
		</span>
		<?php
		$html = apply_filters( 'wpmtst_average_rating_stars_html', ob_get_clean(), $rating );

		return $html;
	}

}
