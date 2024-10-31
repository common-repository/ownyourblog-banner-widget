<?php
/*
Plugin Name: OwnYourBlog Banner Widget
Plugin URI: http://bestwebsite.biz
Description: Виджет, выводящий баннер в сайдбаре с вашей ссылкой. Show any banner in your sidebar with your affiliate link easily. Custom width, .gif, .jpg, .png images format.
Version: 1.0
Author: Vitaliy Syromyatnikov
Author URI: http://bestwebsite.biz
Text Domain: ownyourblogbanner
Domain Path: /langs
*/

add_action( 'widgets_init', 'banner_widget' );
if (function_exists('load_plugin_textdomain'))
  load_plugin_textdomain('ownyourblogbanner', PLUGINDIR.'/ownyourblog-banner-widget/langs/');
function banner_widget() {
	register_widget( 'Banner_Widget' );
}
class Banner_Widget extends WP_Widget {
	function Banner_Widget() {
		$widget_ops = array( 'classname' => 'example', 'description' => __('Widget shows unlimited banners in your sidebar', 'ownyourblogbanner') );
		$control_ops = array( 'width' => 250, 'height' => 320, 'id_base' => 'banner-widget' );
		$this->WP_Widget( 'banner-widget', __('Banners Widget', 'ownyourblogbanner'), $widget_ops, $control_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$link = $instance['link'];
		$width = $instance['width'];
		$image = $instance['image'];
		$text = $instance['text'];
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			<p align="center"><a href="<? echo $link;?>" target="_blank" title="<? echo $text;?>">
			<img src="<? echo $image;?>" width="<? echo $width;?>px" align="middle" border="0" /></a></p>
		<?
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['text'] = strip_tags( $new_instance['text'] );
		$instance['width'] = strip_tags( $new_instance['width'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Create Your Website', 'ownyourblog-banner'), 'link' => 'http://bestwebsite.biz', 'image' => 'http://bestwebsite.biz/wp-content/uploads/2010/11/banner1.png', 'width' =>'250', 'test' => __('Create Your Website', 'ownyourblogbanner'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title (Заголовок):</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>">Your aff link (Партнерская ссылка)</label>
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>">Banner Image URL (Адрес рисунка)</label>
			<input id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">Banner Width (Ширина рисунка)</label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>">Hover Title (Всплывающая надпись)</label>
			<input id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo $instance['text']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}
?>