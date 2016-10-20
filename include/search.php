<div id="searchresults">
<?php
if(isset($_POST['queryString'])) {

    $queryString = $db->connect()->escape_string($_POST['queryString']);


    if (strlen($queryString) > 0) {
        $query = $db->connect()->query("SELECT `users`.`login`, `users`.`name`, `users`.`surname`, `users_profile_images`.`photo` FROM `users` JOIN `users_profile_images` ON `users`.`email` = `users_profile_images`.`id` WHERE `login` LIKE '%" . $queryString . "%' OR `name` LIKE '%" . $queryString . "%' OR `surname` LIKE '%" . $queryString . "%' ORDER BY users.id LIMIT 5");
        if ($query) {
            while ($result = $query->fetch_object()) {
                echo '<div class="searchItem">';
                echo '<a href="index.php?profile='.$result->login.'" class="tweetprofile">
                        <div style="background-image: url(./upload/profile/'.$result->photo.'); background-size: cover; background-repeat: no-repeat;"></div>';

               echo '<span class="searchheading">' . $result->name .' '. $result->surname . '<span> @'.$result->login.'</span></span>';

                echo '<span></span></a></div>';
            }
            echo '<span class="seperator"><a href="#test" title="Sitemap">Wyniki wyszukiwania dla ' . $queryString . '</a></span>';
        }
    }
}
?>
</div>
