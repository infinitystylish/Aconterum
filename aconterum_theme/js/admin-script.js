// Uploading files
var file_frame;
var element;

jQuery('.add-title-image').on('click',function( event ){
   event.preventDefault();
    $this = jQuery(this);

    element = jQuery(this).attr("class").split(' ')[1];

    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    }

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();

      // Do something with attachment.id and/or attachment.url here
      var data = {
        'attachment_id': attachment.id,
        'attachment_url' : attachment.url
      };
      // We can also pass the url value separately from ajaxurl for front end AJAX implementations

      if(element === "firm"){
         jQuery($this).parent().prev().prev().children('.image-firm').val(data.attachment_url);
         jQuery($this).parent().prev().children('.img-image-firm').attr("src",data.attachment_url);
      }else if(element == "general"){
         jQuery($this).prev().prev('input[class^="image-"]').val(data.attachment_url);
         jQuery($this).prev('img[class^="img-image-"]').attr("src",data.attachment_url);
      }

    });

    // Finally, open the modal
    file_frame.open();
});


jQuery('.remove-title-image').on('click',function( event ){
  event.preventDefault();
  jQuery(this).prev().prev().prev('input[class^="image-"]').val("");
  jQuery(this).prev().prev('img[class^="img-image-"]').attr("src","");
});

// Restore the main ID when the add media button is pressed
/*$('a.add_media').on('click', function() {
  wp.media.model.settings.post.id = wp_media_post_id;
});*/



