jQuery(document).ready(function($) {
	'use strict';
    $(document).on("click", ".upload_image_button", function() {

        jQuery.data(document.body, 'prevElement', $(this).prev());

        window.send_to_editor = function(html) {
            var imgurl = jQuery('img',html).attr('src');
            var inputText = jQuery.data(document.body, 'prevElement');

            if(inputText != undefined && inputText != '')
            {
                inputText.val(imgurl);
            }

            tb_remove();
        };

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
	
			
	$('#post-formats-select input').on('change', function() {
		if($(this).attr("id") =="post-format-audio") {
			$("#my-meta-box-id_audio_post").css("display", "block");
			$("#my-meta-box-id_link_post").css("display", "none");
			$("#my-meta-box-id_video_post").css("display", "none");
			$("#gallery-metabox").css("display", "none");
		}
		else if ($(this).attr("id") =="post-format-video") {
			$("#my-meta-box-id_video_post").css("display", "block");
			$("#my-meta-box-id_audio_post").css("display", "none");
			$("#my-meta-box-id_link_post").css("display", "none");
			$("#gallery-metabox").css("display", "none");
			
		}
		else if($(this).attr("id") =="post-format-link") {
			$("#my-meta-box-id_link_post").css("display", "block");
			$("#my-meta-box-id_video_post").css("display", "none");
			$("#my-meta-box-id_audio_post").css("display", "none");
			$("#gallery-metabox").css("display", "none");
		}
		else if($(this).attr("id") =="post-format-gallery") {
			$("#gallery-metabox").css("display", "block");
			$("#my-meta-box-id_link_post").css("display", "none");
			$("#my-meta-box-id_video_post").css("display", "none");
			$("#my-meta-box-id_audio_post").css("display", "none");
		}
		else {
			$("#my-meta-box-id_link_post").css("display", "none");
			$("#my-meta-box-id_video_post").css("display", "none");
			$("#my-meta-box-id_audio_post").css("display", "none");
			$("#gallery-metabox").css("display", "none");
		};
	});
	
	$("#post-formats-select input[checked]").each( 
		function() {
			var post_type_check = $(this).val();
			if(post_type_check == "audio") {
				$("#my-meta-box-id_audio_post").css("display", "block");
				$("#my-meta-box-id_link_post").css("display", "none");
				$("#my-meta-box-id_video_post").css("display", "none");
				$("#gallery-metabox").css("display", "none");
			}
			else if(post_type_check == "video") {
				$("#my-meta-box-id_video_post").css("display", "block");
				$("#my-meta-box-id_audio_post").css("display", "none");
				$("#my-meta-box-id_link_post").css("display", "none");
				$("#gallery-metabox").css("display", "none");
			}
			else if(post_type_check == "link") {
				$("#my-meta-box-id_link_post").css("display", "block");
				$("#my-meta-box-id_video_post").css("display", "none");
				$("#my-meta-box-id_audio_post").css("display", "none");
				$("#gallery-metabox").css("display", "none");
			}
			else if(post_type_check == "gallery") {
				$("#gallery-metabox").css("display", "block");
				$("#my-meta-box-id_link_post").css("display", "none");
				$("#my-meta-box-id_video_post").css("display", "none");
				$("#my-meta-box-id_audio_post").css("display", "none");
			}
			else{
				$("#my-meta-box-id_link_post").css("display", "none");
				$("#my-meta-box-id_video_post").css("display", "none");
				$("#my-meta-box-id_audio_post").css("display", "none");
				$("#gallery-metabox").css("display", "none");
			};
		} 
	);

	
});

jQuery(function($) {
	/* GALLERY ADMIN */
	$(function(){
	var file_frame;

	$(document).on('click', '#gallery-metabox a.gallery-add', function(e) {

	e.preventDefault();

	if (file_frame) file_frame.close();

	file_frame = wp.media.frames.file_frame = wp.media({
	  title: $(this).data('uploader-title'),
	  button: {
		text: $(this).data('uploader-button-text'),
	  },
	  multiple: true
	});

	file_frame.on('select', function() {
	  var listIndex = $('#gallery-metabox-list li').index($('#gallery-metabox-list li:last')),
		  selection = file_frame.state().get('selection');

	  selection.map(function(attachment, i) {
		attachment = attachment.toJSON(),
		index      = listIndex + (i + 1);

		$('#gallery-metabox-list').append('<li><input type="hidden" name="vdw_gallery_id[' + index + ']" value="' + attachment.id + '"><img class="image-preview" src="' + attachment.sizes.thumbnail.url + '"><a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br><small><a class="remove-image" href="#">Remove image</a></small></li>');
	  });
	});
	
		makeSortable();

		file_frame.open();

		});

		$(document).on('click', '#gallery-metabox a.change-image', function(e) {

		e.preventDefault();

		var that = $(this);

		if (file_frame) file_frame.close();

		file_frame = wp.media.frames.file_frame = wp.media({
		  title: $(this).data('uploader-title'),
		  button: {
			text: $(this).data('uploader-button-text'),
		  },
		  multiple: false
		});

		file_frame.on( 'select', function() {
		  attachment = file_frame.state().get('selection').first().toJSON();

		  that.parent().find('input:hidden').attr('value', attachment.id);
		  that.parent().find('img.image-preview').attr('src', attachment.sizes.thumbnail.url);
		});

		file_frame.open();

		});

		function resetIndex() {
		$('#gallery-metabox-list li').each(function(i) {
		  $(this).find('input:hidden').attr('name', 'vdw_gallery_id[' + i + ']');
		});
		}

		function makeSortable() {
		$('#gallery-metabox-list').sortable({
		  opacity: 0.6,
		  stop: function() {
			resetIndex();
		  }
		});
		}

		$(document).on('click', '#gallery-metabox a.remove-image', function(e) {
		e.preventDefault();

		$(this).parents('li').animate({ opacity: 0 }, 200, function() {
		  $(this).remove();
		  resetIndex();
		});
		});

		makeSortable();
	});
});