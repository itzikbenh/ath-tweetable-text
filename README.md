# ath-tweetable-text
WordPress plugin for sharing via twitter parts of text.
There are other plugins that would do it for you. I wanted to make my own and make it simple as possible. 

## Requirements
1. Include font-awesome in your theme since it uses the fa-twitter icon.
2. Add this style to your theme for changing the color of the tinymce link icon - ```.twitter-share { color: #2EA3F2 !important; }``` I didn't want to create a stylesheet file just for changing one element :)
3. Open twitter-share-form.php and add your twitter handler as a default value in the "via" input element.

![alt tag](https://github.com/itzikbenh/ath-tweetable-text/blob/master/twitter-share.gif)

## Addon
If you would like to add twitter share like the one theguardian.com uses then I have a [gist](https://gist.github.com/itzikbenh/a0211bdaecd3b1c65dfb409fc850a905) for it. Tested on latest browsers only, so run your own tests as well.

![alt tag](https://github.com/itzikbenh/ath-tweetable-text/blob/master/hover-share.gif)


