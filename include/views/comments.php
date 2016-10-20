<script>
    $("#newReplyForm").submit(function( e ) {
        e.preventDefault();
        var text = $('.textarea-reply').val();

        $.ajax({
            url: "index.php?act=newReply&id=",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data)
            {
                alert(data);
                $('.textarea-reply').val('');
            }
        });
    });

</script>

<div>
    <hr>
    <div class="ReplyWrite">
        <form action="index.php?act=newReply" method="post" id="newReplyForm">
            <textarea class="textarea-reply" name="newReplyText"></textarea><br><span class="textarea-count"></span>
            <input type="hidden" name="tweetID" value="<?php echo $_GET['tweetID']; ?>">
            <input class="tweets-mesageboxButton" type="submit" value="Reply">
        </form>
    </div>
    <?php
    if($result->num_rows > 0) {
        while ($comment = $result->fetch_array()) {
            $this->loadDataFromDb($comment['user_id']);

            echo '
                  <div class="ReplyContent">
                    <div class="ReplyProfilePhoto">
                        <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile">
                            <div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div>
                        </a>                    
                    </div>
                    <div class="ReplyProfileInfo">
                        <span class="ReplyName">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</span><span class="ReplyLogin">@'.$this->getTmp('login').'</span>
                    </div>
                    <div class="ReplyText">
                        <span class="tweetComment2" style="clear: both;">'.$comment['comment_text'].'</span>
                    </div>
                  </div>
            ';

        }
    } else {
        echo '<div class="ReplyContentEmpty">
                <p style="text-align: center; width: 100%; font-weight: bold;">Brak komentarzy</p>    
              </div>';
    }

    ?>


</div>