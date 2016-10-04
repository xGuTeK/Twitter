<div>
    <hr>
    <form action="index.php?act=newTweet" method="post" id="newReplyForm">
        <textarea class="textarea-tweet" name="newTweetText"></textarea><br><span class="textarea-count"></span>
        <input class="tweets-mesageboxButton" type="submit" value="Reply">
    </form>
    <hr>
    <?php

    while ($comment = $result->fetch_array()) {
        $this->loadDataFromDb($comment['user_id']);
        echo '
        <a href="index.php?profile='.$this->getTmp('login').'" class="tweetprofile">
            <div class="profile-small-photo" style="background-image: url(./upload/profile/'.$this->getTmp('photo').'); background-size: cover; background-repeat: no-repeat;"></div>
        </a>
        <span class="zoomCommentName">'.ucfirst($this->getTmp('name')).' '.ucfirst($this->getTmp('surname')).'</span>
        <span class="zoomCommentLogin">@'.$this->getTmp('login').'</span><br>
        <span class="tweetComment">'.$comment['comment_text'].'</span>';


    }

    ?>


</div>