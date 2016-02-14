/*global tinymce, tinyMCE*/

jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.shortcode_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('insert_shortcode', function() {
                    var selected = tinyMCE.activeEditor.selection.getContent();
                    var content;
                    if( selected ){
                        //If text is selected when button is clicked
                        //Wrap shortcode around it.
                        content =  '[shortcode]'+selected+'[/shortcode]';
                    }else{
                        content =  '[shortcode]  [/shortcode]';
                    }

                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
            ed.addButton('shortcode', {title : 'shortcode', cmd : 'insert_shortcode', text:'shortcode'});
        }
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('shortcode', tinymce.plugins.shortcode_plugin);
});