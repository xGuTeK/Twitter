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
                        <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile" onmouseover="tooltip.pop(this, \'#profile-tooltip\', {position:0, cssClass:\'no-padding\'})">
                            <div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div>
                        </a>                    
                    </div>
                    <div class="ReplyProfileInfo">
                        <span class="ReplyName" onmouseover="tooltip.pop(this, \'#profile-tooltip\', {position:0, cssClass:\'no-padding\'})">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</span>
                        <span class="ReplyLogin" onmouseover="tooltip.pop(this, \'#profile-tooltip\', {position:0, cssClass:\'no-padding\'})">@'.$this->getTmp('login').'</span>
                        <div style="display:none;">
                            <div id="profile-tooltip" style="width: 300px; min-height: 270px;">
                                <div style=" position: relative; cursor: pointer;">
                                    <img class="" width="300" height="100" src="./upload/background/'.$this->getTmp('background').'" alt="Profile banner" />
                                    <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile">
                                        <img class="profile-picture-tooltip" src="./upload/profile/'.$this->getTmp('photo').'" alt="Profile banner"/>
                                    </a>
                                    <p class="name-tooltip">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</p>
                                    <p class="login-tooltip">@'.$this->getTmp('login').'</p>
                                    <img class="follow-button-tooltip" src="./template/img/icons/follow_user_icon.png">
                                    <p class="desc-tooltip">'.$this->getTmp('desc').'</p>
                                    <div class="stats-tooltip">
                                        <div class="stats-tweet-tooltip">
                                            <span>Tweety</span>
                                            <p>'.$this->getTmp('tweets').'</p>
                                        </div>
                                        <div class="stats-tweet-tooltip">
                                            <span>Obserwowani</span>
                                            <p>'.$this->getTmp('following').'</p>
                                        </div>
                                        <div class="stats-tweet-tooltip">
                                            <span>Obserwujący</span>
                                            <p>'.$this->getTmp('followers').'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="TweetTime" data-toggle="tooltip-data" data-placement="top" title="'.$comment["comment_date"].'"> · '.$this->getTimeDifference($comment["comment_date"]).'</span>
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