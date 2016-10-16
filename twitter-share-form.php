
<div class="twitter-share-div">
    <label for="via">Via (Twitter handler without the '@' sign)</label><br>
    <input class="twitter-share-input" id="via" type="text" placeholder="Via" value="coveragerinc">
</div>

<div class="twitter-share-div">
    <label for="post-url">Post URL</label><br>
    <input class="twitter-share-input" id="post-url" type="text" placeholder="URL">
</div>

<div class="twitter-share-div">
    <label for="hashtags">Hashtags (comma separated)</label><br>
    <input class="twitter-share-input" id="hashtags" type="text" placeholder="Hashtags">
</div>

<div class="preview">
    <label for="preview">Preview</label><br>
    <textarea id="preview" name="name" rows="8" cols="90" readonly>

    </textarea>
</div>

<button id="insert-share-link">Insert share link</button>
<span class="num-chars-allowed">140</span>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

<script>

//We use the parent, because we are inside of an iframe. This will only work if both documents are in the same origin.
var permalink = parent.document.getElementById("sample-permalink").getElementsByTagName("A")[0];
document.getElementById( 'post-url' ).value = permalink;

var via = $('#via').val();

var escaped_selected_text = $("<div/>").html(parent.tinyMCE.activeEditor.selection.getContent()).text();
$('#preview').val(escaped_selected_text + " " + permalink + " via @" + via);

var count     = escaped_selected_text + permalink + via;
var num_chars = $(".num-chars-allowed").text();
$(".num-chars-allowed").text(num_chars - count.length);

// $(document).on("keypress", "#hashtags", function() {
//     console.log($(this).val());
// })
$("#hashtags").keyup(function() {
    var hashtags = $(this).val();
    $(".num-chars-allowed").text(num_chars - count.length - hashtags.length);
    $('#preview').val(escaped_selected_text + " " + permalink  + " " + hashtags + " via @" + via);
});


document.getElementById( 'insert-share-link' ).onclick = function(){
    var via           = document.getElementById( 'via' ).value;
    var post_url      = document.getElementById( 'post-url' ).value;
    var hashtags      = document.getElementById( 'hashtags' ).value.replace(/\s/g, ''); //removes spaces.
    var selected_text = parent.tinyMCE.activeEditor.selection.getContent();
    console.log(via);
    console.log(selected_text);

    return;

    var twitter_url = "https://twitter.com/intent/tweet?";
    twitter_url += "url="+encodeURIComponent(post_url)+"&";
    twitter_url += "via="+via+"&";
    twitter_url += "text="+encodeURIComponent(selected_text)+"&";
    twitter_url += "hashtags="+encodeURIComponent(hashtags)+"&";

    var return_text = '';
    return_text = '<a href="'+twitter_url+'" target="_blank">' + selected_text + '</a>';
    console.log(return_text.length);
    parent.tinyMCE.activeEditor.execCommand('mceInsertContent', 0, return_text);
    parent.tinyMCE.activeEditor.windowManager.close(window);
};

</script>

<style>
    .twitter-share-div {
        margin-bottom: 15px;
    }

    .twitter-share-input, #preview {
        width: 35em;
        margin: 1px;
        padding: 7px 5px;
        border: 1px solid #ddd;
        -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
        box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
        background-color: #fff;
        color: #32373c;
        -webkit-transition: 50ms border-color ease-in-out;
        transition: 50ms border-color ease-in-out;
        font-size: 16px;
    }

    .preview {
        margin-bottom: 10px;
    }

    #preview-share-link, #insert-share-link {
        background: #0085ba;
        border-color: #0073aa #006799 #006799;
        -webkit-box-shadow: 0 1px 0 #006799;
        box-shadow: 0 1px 0 #006799;
        color: #fff;
        text-decoration: none;
        outline: 0;
        text-shadow: 0 -1px 1px #006799,1px 0 1px #006799,0 1px 1px #006799,-1px 0 1px #006799;
        display: inline-block;
        text-decoration: none;
        font-size: 13px;
        line-height: 26px;
        height: 28px;
        margin: 0;
        padding: 0 10px 1px;
        cursor: pointer;
        border-width: 1px;
        border-style: solid;
        -webkit-appearance: none;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        white-space: nowrap;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .num-chars-allowed {
        float: right;
        margin-right: 20;
    }

</style>