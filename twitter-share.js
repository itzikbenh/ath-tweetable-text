(function() {
     /* Register the buttons */
     tinymce.create('tinymce.plugins.MyButtons', {
          init : function(ed, url) {
               /**
               * Inserts shortcode content
               */
               ed.addButton( 'button_twitter', {
                    title : 'Insert Twitter icon shortcode',
                    image : '../wp-content/plugins/ath-twitter-share/twitter-icon.png',
                    onclick : function() {
                         ed.selection.setContent('[twitter-icon]');
                    }
               });
               /**
               * Adds HTML tag to selected content
               */
               ed.addButton( 'button_green', {
                    title : 'Add Twitter share link',
                    //image : '../wp-includes/images/smilies/icon_mrgreen.gif',
                    icon : 'mce-ico mce-i-link twitter-share',
                    //cmd: 'button_green_cmd',
                    onclick: function() {
                        // Open window with a specific url
                        ed.windowManager.open({
                            title: 'Twitter Share',
                            url: twitter_share_data.form_url,
                            width: 600,
                            height: 450,
                        });
                    }
               });
               ed.addCommand( 'button_green_cmd', function( via ) {
                    var selected_text = ed.selection.getContent();
                    var return_text = '';
                    return_text = '<h1>' + selected_text + '</h1>';
                    ed.execCommand('mceInsertContent', 0, return_text);
               });
          },
          createControl : function(n, cm) {
               return null;
          },
     });
     /* Start the buttons */
     tinymce.PluginManager.add( 'my_button_script', tinymce.plugins.MyButtons );
})();