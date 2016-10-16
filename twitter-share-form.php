<div class="twitter-share-div">
    <label for="text">Text</label><br>
    <input class="twitter-share-input" id="text" type="text" placeholder="Text">
</div>

<div class="twitter-share-div">
    <label for="via">Via (Twitter handler without the '@' sign)</label><br>
    <input class="twitter-share-input" id="via" type="text" placeholder="Via" value="coveragerinc">
</div>

<div class="twitter-share-div">
    <label for="permalink">Post URL</label><br>
    <input class="twitter-share-input" id="permalink" type="text" placeholder="URL">
</div>

<div class="twitter-share-div">
    <label for="hashtags">Hashtags (comma separated)</label><br>
    <input class="twitter-share-input" id="hashtags" type="text" placeholder="Hashtags">
</div>

<div class="preview">
    <label for="preview">Preview</label><br>
    <textarea id="preview" name="name" rows="6" cols="90" readonly>

    </textarea>
</div>

<button id="insert-share-link">Insert share link</button>
<span class="num-chars-allowed">140</span>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

<script>

//We use the parent, because we are inside of an iframe. This will only work if both documents are in the same origin.
var permalink = parent.document.getElementById("sample-permalink").getElementsByTagName("A")[0];
$('#permalink').val(permalink);

var via = $('#via').val();

var escaped_selected_text = $("<div/>").html(parent.tinyMCE.activeEditor.selection.getContent()).text();
$('#text').val(escaped_selected_text);
$('#preview').val(escaped_selected_text + " " + permalink + " via @" + via);

var num_chars = $(".num-chars-allowed").text();
$(".num-chars-allowed").text(num_chars - $('#preview').val().length);

$("#text, #via, #permalink, #hashtags").on("change paste keyup keydown", function() {
    set_preview_on_change();
});

function set_preview_on_change() {
    var via           = $('#via').val();
    var permalink     = $('#permalink').val();
    var hashtags      = $('#hashtags').val().replace(/\s/g, ''); //remove spaces
    var text_to_share = $("#text").val();

    hashtags = "#" + hashtags.replace(/,/g , " #"); //replaces commas with hashtags
    //We manually add this hashtag at the front so we must remove if nothing is left.
    if(hashtags === "#") {
        hashtags = "";
    }

    //We use replace at the end to remove double spaces.
    $('#preview').val((text_to_share + " " + permalink  + " " + hashtags + " via @" + via).replace(/\s\s+/g, ' '));
    $(".num-chars-allowed").text(num_chars - $('#preview').val().length);
    //Change color to red if exceeded beyond allowed characters.
    if($(".num-chars-allowed").text() < 0) {
        $(".num-chars-allowed").css("color", "red");
    } else {
        $(".num-chars-allowed").css("color", "black");
    }
}


document.getElementById( 'insert-share-link' ).onclick = function(){
    var via           = $('#via').val();
    var permalink     = $('#permalink').val();
    var hashtags      = $('#hashtags').val().replace(/\s/g, ''); //removes spaces.
    var text_to_share = $("#text").val();
    //In case text has been changed we need to return the original one.
    var original_selected_text = parent.tinyMCE.activeEditor.selection.getContent();

    var twitter_url = "https://twitter.com/intent/tweet?";
    twitter_url += "url="+encodeURIComponent(permalink)+"&";
    twitter_url += "via="+via+"&";
    twitter_url += "text="+encodeURIComponent(text_to_share)+"&";
    twitter_url += "hashtags="+encodeURIComponent(hashtags)+"&";

    var return_text = '';
    return_text = '<a href="'+twitter_url+'" target="_blank">' + original_selected_text + ' <i class="fa fa-twitter" aria-hidden="true" style="color:#15c1e1 !important"></i></a>';
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