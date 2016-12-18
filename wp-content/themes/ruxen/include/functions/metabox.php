<?php
/*------------- METABOXS START -------------*/
/*------------- POST SLIDER TITLE -------------*/

function ruxen_post_slider_title1_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_post_slider_title1', __( 'Slider Top Title', 'ruxen' ), 'ruxen_post_slider_title1_meta_box_post_slider_title1', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ruxen_post_slider_title1_meta_box_add' );

function ruxen_post_slider_title1_meta_box_post_slider_title1()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
	$text = isset( $values['post_slider_title1_meta_box_text'] ) ? strip_tags( esc_attr( $values['post_slider_title1_meta_box_text'][0] ) ) :'';
    if( $text == "" ) {
		$text = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'post_slider_title1_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <input type="text" name="post_slider_title1_meta_box_text" id="form-input-tip" style="width:100%;" value="<?php echo esc_attr( $text ); ?>" />
    </p>
    <?php    
}

function ruxen_post_slider_title1_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['post_slider_title1_meta_box_text'] ) )
        update_post_meta( $post_id, 'post_slider_title1_meta_box_text', strip_tags( wp_kses( $_POST['post_slider_title1_meta_box_text'], $allowed ) ) );
         
    if( isset( $_POST['post_slider_title1_meta_box_select'] ) )
        update_post_meta( $post_id, 'post_slider_title1_meta_box_select', strip_tags( esc_attr( $_POST['post_slider_title1_meta_box_select'] ) ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk = isset( $_POST['post_slider_title1_meta_box_check'] ) && $_POST['post_slider_title1_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'post_slider_title1_meta_box_check', $chk );

}
add_action( 'save_post', 'ruxen_post_slider_title1_meta_box_save' );


function ruxen_post_slider_title2_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_post_slider_title2', __( 'Slider Bottom Title', 'ruxen' ), 'ruxen_post_slider_title2_meta_box_post_slider_title2', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ruxen_post_slider_title2_meta_box_add' );

function ruxen_post_slider_title2_meta_box_post_slider_title2()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
	$text = isset( $values['post_slider_title2_meta_box_text'] ) ? strip_tags( esc_attr( $values['post_slider_title2_meta_box_text'][0] ) ) :'';
    if( $text == "" ) {
		$text = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'post_slider_title2_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <input type="text" name="post_slider_title2_meta_box_text" id="form-input-tip" style="width:100%;" value="<?php echo esc_attr( $text ); ?>" />
    </p>
    <?php    
}

function ruxen_post_slider_title2_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['post_slider_title2_meta_box_text'] ) )
        update_post_meta( $post_id, 'post_slider_title2_meta_box_text', strip_tags( wp_kses( $_POST['post_slider_title2_meta_box_text'], $allowed ) ) );
         
    if( isset( $_POST['post_slider_title2_meta_box_select'] ) )
        update_post_meta( $post_id, 'post_slider_title2_meta_box_select', strip_tags( esc_attr( $_POST['post_slider_title2_meta_box_select'] ) ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk = isset( $_POST['post_slider_title2_meta_box_check'] ) && $_POST['post_slider_title2_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'post_slider_title2_meta_box_check', $chk );

}
add_action( 'save_post', 'ruxen_post_slider_title2_meta_box_save' );

/*------------- VIDEO POST META BOX -------------*/
function ruxen_video_post_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_video_post', __( 'Video Post Embed', 'ruxen' ), 'ruxen_video_post_meta_box_video_post', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ruxen_video_post_meta_box_add' );

function ruxen_video_post_meta_box_video_post()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_video = get_post_custom( $post->ID );
	$text_video = isset( $values_video['video_post_meta_box_text'] ) ? strip_tags( esc_attr( $values_video['video_post_meta_box_text'][0] ) ) :'';
    if( $text_video == "" ) {
		$text_video = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'video_post_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <textarea name='video_post_meta_box_text' id='form-input-tip-video' rows='3' style='width:100%;'><?php echo esc_html( stripcslashes( $text_video ) ); ?></textarea>
    </p>
    <?php    
}

function ruxen_video_post_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_video = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['video_post_meta_box_text'] ) )
        update_post_meta( $post_id, 'video_post_meta_box_text', addslashes( $_POST['video_post_meta_box_text'] ) );
         
    if( isset( $_POST['video_post_meta_box_select'] ) )
        update_post_meta( $post_id, 'video_post_meta_box_select', addslashes( $_POST['video_post_meta_box_select'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk_video = isset( $_POST['video_post_meta_box_check'] ) && $_POST['video_post_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'video_post_meta_box_check', $chk_video );

}
add_action( 'save_post', 'ruxen_video_post_meta_box_save' );

/*------------- AUDIO POST META BOX -------------*/
function ruxen_audio_post_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_audio_post', __( 'Audio Post Embed', 'ruxen' ), 'ruxen_audio_post_meta_box_audio_post', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ruxen_audio_post_meta_box_add' );

function ruxen_audio_post_meta_box_audio_post()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_audio = get_post_custom( $post->ID );
	$text_audio = isset( $values_audio['audio_post_meta_box_text'] ) ? strip_tags( esc_attr( $values_audio['audio_post_meta_box_text'][0] ) ) :'';
    if( $text_audio == "" ) {
		$text_audio = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'audio_post_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <textarea name='audio_post_meta_box_text' id='form-input-tip-audio' rows='3' style='width:100%;'><?php echo esc_html( stripcslashes( $text_audio ) ); ?></textarea>
    </p>
    <?php    
}

function ruxen_audio_post_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_audio = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['audio_post_meta_box_text'] ) )
        update_post_meta( $post_id, 'audio_post_meta_box_text', addslashes( $_POST['audio_post_meta_box_text'] ) );
         
    if( isset( $_POST['audio_post_meta_box_select'] ) )
        update_post_meta( $post_id, 'audio_post_meta_box_select', addslashes( $_POST['audio_post_meta_box_select'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk_audio = isset( $_POST['audio_post_meta_box_check'] ) && $_POST['audio_post_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'audio_post_meta_box_check', $chk_audio );

}
add_action( 'save_post', 'ruxen_audio_post_meta_box_save' );

/*------------- LINK POST META BOX -------------*/
function ruxen_link_post_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_link_post', __( 'Link Post URL', 'ruxen' ), 'ruxen_link_post_meta_box_link_post', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ruxen_link_post_meta_box_add' );

function ruxen_link_post_meta_box_link_post()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_link = get_post_custom( $post->ID );
	$text_link = isset( $values_link['link_post_meta_box_text'] ) ? strip_tags( esc_attr( $values_link['link_post_meta_box_text'][0] ) ) :'';
    if( $text_link == "" ) {
		$text_link = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'link_post_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <input name='link_post_meta_box_text' type="text" class='form-input-tip' id='form-input-tip-link' rows='3' value="<?php echo esc_html( stripcslashes( $text_link ) ); ?>" style='width:100%;'>
    </p>
    <?php    
}

function ruxen_link_post_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_link = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['link_post_meta_box_text'] ) )
        update_post_meta( $post_id, 'link_post_meta_box_text', addslashes( $_POST['link_post_meta_box_text'] ) );
         
    if( isset( $_POST['link_post_meta_box_select'] ) )
        update_post_meta( $post_id, 'link_post_meta_box_select', addslashes( $_POST['link_post_meta_box_select'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk_link = isset( $_POST['link_post_meta_box_check'] ) && $_POST['link_post_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'link_post_meta_box_check', $chk_link );

}
add_action( 'save_post', 'ruxen_link_post_meta_box_save' );

/*------------- PAGE DESCRIPTION TEXT -------------*/
function ruxen_description_page_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_description_page', __( 'Page Banner Description', 'ruxen' ), 'ruxen_description_page_meta_box_description_page', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ruxen_description_page_meta_box_add' );

function ruxen_description_page_meta_box_description_page()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_description = get_post_custom( $post->ID );
	$text_description = isset( $values_description['description_page_meta_box_text'] ) ? strip_tags( esc_attr( $values_description['description_page_meta_box_text'][0] ) ) :'';
    if( $text_description == "" ) {
		$text_description = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'description_page_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <input name='description_page_meta_box_text' type="text" class='form-input-tip' id='form-input-tip-description' rows='3' value="<?php echo esc_html( stripcslashes( $text_description ) ); ?>" style='width:100%;'>
    </p>
    <?php    
}

function ruxen_description_page_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_description = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['description_page_meta_box_text'] ) )
        update_post_meta( $post_id, 'description_page_meta_box_text', addslashes( $_POST['description_page_meta_box_text'] ) );
         
    if( isset( $_POST['description_page_meta_box_select'] ) )
        update_post_meta( $post_id, 'description_page_meta_box_select', addslashes( $_POST['description_page_meta_box_select'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk_description = isset( $_POST['description_page_meta_box_check'] ) && $_POST['description_page_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'description_page_meta_box_check', $chk_description );

}
add_action( 'save_post', 'ruxen_description_page_meta_box_save' );

/*------------- PAGE BANNER TITLE -------------*/
function ruxen_title_page_meta_box_add()
{
	add_meta_box( 'my-meta-box-id_title_page', __( 'Page Banner Title', 'ruxen' ), 'ruxen_title_page_meta_box_title_page', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'ruxen_title_page_meta_box_add' );

function ruxen_title_page_meta_box_title_page()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values_title = get_post_custom( $post->ID );
	$text_title = isset( $values_title['title_page_meta_box_text'] ) ? strip_tags( esc_attr( $values_title['title_page_meta_box_text'][0] ) ) :'';
    if( $text_title == "" ) {
		$text_title = '';
	}
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'title_page_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <input name='title_page_meta_box_text' type="text" class='form-input-tip' id='form-input-tip-title' rows='3' value="<?php echo esc_html( stripcslashes( $text_title ) ); ?>" style='width:100%;'>
    </p>
    <?php    
}

function ruxen_title_page_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
     
    // now we can actually save the data
    $allowed_title = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['title_page_meta_box_text'] ) )
        update_post_meta( $post_id, 'title_page_meta_box_text', addslashes( $_POST['title_page_meta_box_text'] ) );
         
    if( isset( $_POST['title_page_meta_box_select'] ) )
        update_post_meta( $post_id, 'title_page_meta_box_select', addslashes( $_POST['title_page_meta_box_select'] ) );
         
    // This is purely my personal preference for saving check-boxes
    $chk_title = isset( $_POST['title_page_meta_box_check'] ) && $_POST['title_page_meta_box_select'] ? 'on' : 'off';
    update_post_meta( $post_id, 'title_page_meta_box_check', $chk_title );

}
add_action( 'save_post', 'ruxen_title_page_meta_box_save' );

/*------------- POST GALLERY -------------*/
  function ruxen_add_gallery_metabox($post_type) {
    $types = array('post', 'page', 'custom-post-type');
    if (in_array($post_type, $types)) {
      add_meta_box(
        'gallery-metabox',
        __( 'Post Gallery', 'ruxen' ),
        'ruxen_gallery_meta_callback',
        $post_type,
        'normal',
        'high'
      );
    }
  }
  add_action('add_meta_boxes', 'ruxen_add_gallery_metabox');
  function ruxen_gallery_meta_callback($post) {
    wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
    $ids = get_post_meta($post->ID, 'vdw_gallery_id', true);
    ?>
    <table class="form-table">
      <tr><td>
        <a class="gallery-add button" href="#" data-uploader-title="<?php echo __( 'Add image(s) to gallery', 'ruxen' ); ?>" data-uploader-button-text="<?php echo __( 'Add image(s)', 'ruxen' ); ?>"><?php echo __( 'Add image(s)', 'ruxen' ); ?></a>

        <ul id="gallery-metabox-list">
        <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>

          <li>
            <input type="hidden" name="vdw_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
            <img class="image-preview" src="<?php echo $image[0]; ?>">
            <a class="change-image button button-small" href="#" data-uploader-title="<?php echo __( 'Change image', 'ruxen' ); ?>" data-uploader-button-text="<?php echo __( 'Change image', 'ruxen' ); ?>"><?php echo __( 'Change image', 'ruxen' ); ?></a><br>
            <small><a class="remove-image" href="#"><?php echo __( 'Remove image', 'ruxen' ); ?></a></small>
          </li>

        <?php endforeach; endif; ?>
        </ul>

      </td></tr>
    </table>
  <?php }
  function ruxen_gallery_meta_save($post_id) {
    if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(isset($_POST['vdw_gallery_id'])) {
      update_post_meta($post_id, 'vdw_gallery_id', $_POST['vdw_gallery_id']);
    } else {
      delete_post_meta($post_id, 'vdw_gallery_id');
    }
  }
  add_action('save_post', 'ruxen_gallery_meta_save');
/*------------- METABOXS END -------------*/