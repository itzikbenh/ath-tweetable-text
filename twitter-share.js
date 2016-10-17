(function() {
     /* Register the buttons */
     tinymce.create('tinymce.plugins.MyButtons', {
          init : function(ed, url) {
               /**
               * Adds HTML tag to selected content
               */
               ed.addButton( 'twitter_share_button', {
                    title : 'Add Twitter share link',
                    image : '../wp-content/plugins/ath-twitter-share/twitter-icon.png',
                    //icon : 'mce-ico mce-i-link twitter-share',
                    onclick: function() {
                        // Open window with a specific url
                        ed.windowManager.open({
                            title: 'Twitter Share',
                            url: twitter_share_data.form_url,
                            width: 585,
                            height: 480,
                        });
                    }
               });
          },
          createControl : function(n, cm) {
               return null;
          },
     });
     /* Start the buttons */
     tinymce.PluginManager.add( 'my_button_script', tinymce.plugins.MyButtons );
})();