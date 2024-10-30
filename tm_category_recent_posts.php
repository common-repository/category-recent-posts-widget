<?php
/*
 * Plugin Name: Category Recent Posts Widget
 * Plugin URI: http://themedios.com/
 * Description: Displays recent posts on category archive page, belonging to the respective category
 * Author: The Medios, illuminatus7
 * Version: 1.1
 * Author URI: http://codincafe.com/
 *
 * Like WordPress, this code is GPL v2 (or later) (copyleft), and is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'tm_load_catrecentposts_widgets' );

/**
 * Register our widget.
 * 'tm_Category_Recent_Posts_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function tm_load_catrecentposts_widgets() {
	register_widget( 'tm_Category_Recent_Posts_Widget' );
}

class tm_Category_Recent_Posts_Widget extends WP_Widget {

	function tm_Category_Recent_Posts_Widget() {
		$widget_options = array( 'classname' => 'tm-cat-recent-post', 'description' => __('Displays Recent Posts on category archive pages', 'themedios') );
		$control_options = array( 'width' => 300, 'height' => 350, 'id_base' => 'tm-cat-recent-post-widget' );
		$this->WP_Widget( 'tm-cat-recent-post-widget', __('Category Recent Posts', 'themedios'), $widget_options, $control_options );
	}

	function widget( $args, $instance )  {
		
		extract($args);
		$title = apply_filters( 'widget_title', $instance['title'] );
                $number_of_posts = $instance['number_of_posts'];
                $show_excerpt = $instance['show_excerpt'];
                $excerpt_number_words = $instance['excerpt_number_words'];
                $read_more_text = $instance['read_more_text'];

		if (is_category()) {
                        
                        //Get the category of the current page
			$this_category = get_category( get_query_var( 'cat' ), false );
				
                                // Widget header
				echo $before_widget;
				echo $before_title; echo $title; echo $after_title;
				echo '<ul class="tm-recent">';
				$recent_posts = wp_get_recent_posts ('orderby=id&show_count=0&category='.$this_category->cat_ID.'&numberposts='.$number_of_posts );
                                if (!empty($recent_posts)) {
                                    
                                    // loop trough posts arrays
                                    foreach( $recent_posts as $post ) {
                                        
                                        // echo each post on a list element
                                        echo '<li><a href="' . get_permalink($post['ID']) . '" title="Permalink To '.$post['post_title'].'" >' .   $post['post_title'].'</a> </li> ';
                                        
                                        // If Show excerpt is checked then show it
                                        if ( 1 == $show_excerpt ) {
                                            if (!empty($read_more_text) && isset($read_more_text)){
                                                $more = ' <a href="'.get_permalink($post['ID']).'" title="Permalink To '.$post['post_title'].'" class="tm-read-more-text">'.$read_more_text.'</a>';
                                            } else {
                                                $more = ' <a href="'.get_permalink($post['ID']).'" title="Permalink To '.$post['post_title'].'" class="tm-read-more-text">&hellip;</a>';
                                            }
                                            // Trim the shortcode stripped excert
                                            $trimmed_excerpt = wp_trim_words( strip_shortcodes($post['post_content']), $num_words = strip_shortcodes($excerpt_number_words), strip_shortcodes($more));
                                            echo '<div class="tm-excerpt">' . $trimmed_excerpt . '</div>';
                                        }
                                    }
                                }
				
                                // widget footer
				echo $after_widget;			
				echo '</ul>';
		} 
	}
	
	function update( $new_instance, $old_instance ) {
		
		/* Strip tags for title to remove HTML (important security for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number_of_posts'] = strip_tags( $new_instance['number_of_posts'] );
		$instance['show_excerpt'] = strip_tags( $new_instance['show_excerpt'] );
		$instance['excerpt_number_words'] = strip_tags( $new_instance['excerpt_number_words'] );
		$instance['read_more_text'] = strip_tags($new_instance['read_more_text']);
                
		return $instance;
	}
	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Category Recent Posts', 'themedios'), 'number_of_posts' => 5, 'show_excerpt' => 1, 'excerpt_number_words' => 10, 'read_more_text' => '...' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
				<!-- Widget Title: Text Input -->
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'themedios'); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
				</p>
                                
                                <!-- Number of Posts: Text Input -->
				<p>
					<label for="<?php echo $this->get_field_id( 'number_of_posts' ); ?>"><?php _e('Number of posts to display:', 'themedios'); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'number_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_of_posts' ); ?>" value="<?php echo $instance['number_of_posts']; ?>" size="3" />
				</p>
                                
                                <!-- Display Excerpt or not: Checkbox -->
                                <p>
                                        <input class="checkbox" type="checkbox" value="1" <?php checked( $instance['show_excerpt'], 1 ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
                                        <label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>">Show Excerpt?</label>
                                </p>
                                
                                <!-- Read More Text: Text Input -->
                                <p>
                                        <label for="<?php echo $this->get_field_id( 'read_more_text' ); ?>"><?php _e('Read More Text:', 'themedios'); ?></label><br />
					<input type="text" id="<?php echo $this->get_field_id( 'read_more_text' ); ?>" name="<?php echo $this->get_field_name( 'read_more_text' ); ?>" value="<?php echo $instance['read_more_text'] = isset($instance['read_more_text']) ? $instance['read_more_text'] : ''; ?>" class="widefat"/>
                                </p>
                                
                                <!-- Number of words in excerpt: Text Input -->
				<p>
					<label for="<?php echo $this->get_field_id( 'excerpt_number_words' ); ?>"><?php _e('Number of words to be displayed in excerpt:', 'themedios'); ?></label>
					<input type="text" id="<?php echo $this->get_field_id( 'excerpt_number_words' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_number_words' ); ?>" value="<?php echo $instance['excerpt_number_words']; ?>" size="3" />
				</p>
	
	<?php
	}
}