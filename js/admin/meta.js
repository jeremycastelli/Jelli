/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
 
    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;
 
    // Runs when the image button is clicked.
    $('#meta-image-button').click(function(e){
 
        // Prevents the default action from occuring.
        e.preventDefault();

        var $parent = $(this).parent('.meta-image');
 
        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }
 
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            //title: 'Choose image', //meta_image.title,
           // button: { text:  meta_image.button },
           // library: { type: 'image' }
        });
 
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
 
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            
            console.log(media_attachment);
            // Sends the attachment URL to our custom image input field.
            $parent.find('#meta-image-id').val(media_attachment.id);
            $parent.find('#meta-image').attr('src',media_attachment.sizes.thumbnail.url).css('display','block');
            $parent.find('#meta-image-button').css('display','none');
            $parent.find('#meta-image-remove').css('display','inline');
        });
 
        // Opens the media library frame.
        meta_image_frame.open();
    });


    $('#meta-image-remove').click(function(e){
    
        // Prevents the default action from occuring.
        e.preventDefault();

        var $parent = $(this).parent('.meta-image');
        $parent.find('#meta-image-id').val('');
        $parent.find('#meta-image').attr('src','').css('display','none');
        $parent.find('#meta-image-button').css('display','inline');
        $(this).css('display','none');


    });
});