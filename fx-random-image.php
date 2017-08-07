<?php
/**
 * @package FX Random image
 * @author Aivaras Sondeckis
 * @version 1
 */
/*
Plugin Name: FX Random image
Plugin URI: http://wordpress.org/#
Description: Displays a random image from post or page you specify. Plugin creates FX-Random-image widget. Use widget to add image to sidebar or add <code>&lt;?php FX_Random_Image($pageID, $link, $size); ?&gt;</code> function to theme. $pageID is page/post ID from there to take images, if $link = true adds link to image, $link = false no link on image, $size - image size ('thumbnail', 'medium' or 'large'). Example <code>&lt;?php FX_Random_Image(1, false, 'large'); ?&gt;</code>
Author: Aivaras Sondeckis
Version: 1.0.2
Author URI: http://www.3Dgrafika.lt/
*/

class FX_RandomImage_Widget extends WP_Widget {
  
  
  function FX_RandomImage_Widget() {
    // widget actual processes
    $widget_ops = array('classname' => 'widget_RandomImage', 'description' => __( "Widget that displays random image from Page or Post") );
    $control_ops = array('width' => 200, 'height' => 300);
    $this->WP_Widget('RandomImage', __('FX Random Image'), $widget_ops, $control_ops);
  }


  function form($instance) {
    // outputs the options form on admin
    $instance = wp_parse_args( (array) $instance, array('randompage_id'=>'Page ID', 'addlink'=>'true') );
    
    $randompage_id = htmlspecialchars($instance['randompage_id']);
    $addlink = htmlspecialchars($instance['addlink']);
    
    $checkbox_value = $addlink == 'true' ? 'false' : 'true';
    $checked = $addlink  == 'true' ? 'checked' : '';
    
    # Input Page ID
    echo '<p style="text-align:right;"><label for="' . $this->get_field_name('randompage_id') . '">' . __('Page ID:') . ' <input style="width: 70px;" id="' . $this->get_field_id('randompage_id') . '" name="' . $this->get_field_name('randompage_id') . '" type="text" value="' . $randompage_id . '" /></label></p>';
    # CheckBox checkbox Add Link
    echo '<p style="text-align:right;"><label for="' . $this->get_field_name('addlink') . '">' . __('Add link:') . ' <input id="' . $this->get_field_id('addlink') . '" name="' . $this->get_field_name('addlink') . '" type="checkbox" value="true" ' .$checked. '/></label></p>';

  }
  

  function update($new_instance, $old_instance) {
    // processes widget options to be saved
    $instance = $old_instance;
    $instance['randompage_id'] = strip_tags(stripslashes($new_instance['randompage_id']));
    $instance['addlink'] = $new_instance['addlink'] == 'true' ? 'true' : 'false';
    
    return $instance;
  }
  

  function widget($args, $instance) {
    // outputs the content of the widget
    extract($args);
    $randomimagepage_ID = empty($instance['randompage_id']) ? 'Page ID' : $instance['randompage_id'];
    $addlink = $instance['addlink'];
    
    // Before the widget
    echo $before_widget;
    
    // Show the Random image
    FX_Random_Image($randomimagepage_ID, $addlink, 'large');
  
    # After the widget
    echo $after_widget;
  }
  
}

/**
* External function (shortcode) for users to add in theme.
*
*/
function FX_Random_Image($randomimagepage_ID, $addlink, $imagesize) {
  //============getting random attachment from post================    
  
  $attachments = get_children( array('post_parent' => $randomimagepage_ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image'));
  
  if ($attachments) {
    if ($attachments === FALSE) {
      $template_path_temp = get_bloginfo('template_directory');
    } else {
      $content_attachments = "";
      $attachments_rand = rand(1,sizeof($attachments));
      $attachments_count = 0;
      foreach($attachments as $attach) {
        $content_attachments = '';
        if(++$attachments_count == $attachments_rand) {
          if($addlink == 'true') {
            $content_attachments = '<a href="';
            $content_attachments .= wp_get_attachment_url($attach->ID);
            $content_attachments .= '">';
          }
          $content_attachments .= wp_get_attachment_image($attach->ID,$imagesize,false);
          if($addlink == 'true') {
            $content_attachments .= '</a>';
          }          
          break;
        }
      }
      //$content_attachments = apply_filters('the_content', $content_attachments);
      echo $content_attachments;
    }
  }

  
}

/**
* Register widget.
*
* Calls 'widgets_init' action after the widget has been registered.
*/

function RandomImage_init() {
  register_widget('FX_RandomImage_Widget');
}

add_action('widgets_init', 'RandomImage_init');

?>
