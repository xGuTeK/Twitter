<?php

if(!isset($_GET['q'])) {
    ?>

    <div id="searchresults">
        <?php
        if (isset($_POST['queryString'])) {

            $queryString = $db->connect()->escape_string($_POST['queryString']);

            if (strlen($queryString) > 0) {
                $query = $db->connect()->query("SELECT `users`.`login`,
                                                        `users`.`name`,
                                                        `users`.`surname`,
                                                        `users_profile_images`.`photo`
                                                FROM `users`
                                                JOIN `users_profile_images` ON `users`.`email` = `users_profile_images`.`id` 
                                                WHERE `login` LIKE '%" . $queryString . "%' 
                                                    OR `name` LIKE '%" . $queryString . "%'
                                                    OR `surname` LIKE '%" . $queryString . "%'
                                                    OR `email` LIKE '%" . $queryString . "%'
                                                ORDER BY users.id LIMIT 5");
                if ($query) {
                    while ($result = $query->fetch_object()) {
                        echo '<div class="searchItem">
                                <a href="index.php?profile=' . $result->login . '" class="tweetprofile">
                                    <div style="background-image: url(./upload/profile/' . $result->photo . '); background-size: cover; background-repeat: no-repeat;"></div>
                                    <span class="searchheading">' . $result->name . ' ' . $result->surname . '<span> @' . $result->login . '</span></span>
                                    <span></span>
                                </a>
                              </div>';
                    }
                    echo '<span class="seperator"><a href="index.php?act=search&q='.$queryString.'" title="Sitemap">Wyniki wyszukiwania dla ' . $queryString . '</a></span>';
                }
            }
        }
        ?>
    </div>
    <?php
} elseif (isset($_GET['q'])) {
    $queryString = $db->connect()->escape_string($_GET['q']);

    $query = $db->connect()->query("SELECT `users`.`login`, 
                                            `users`.`name`, 
                                            `users`.`surname`, 
                                            `users_profile_images`.`photo`,
                                            `users_profile_images`.`background`,
                                            `users_profile_stats`.`Tweets`,
                                            `users_profile_stats`.`Following`,
                                            `users_profile_stats`.`Followers` 
                                    FROM `users` 
                                    JOIN `users_profile_images` ON `users`.`email` = `users_profile_images`.`id` 
                                    JOIN `users_profile_stats` ON `users`.`id` = `users_profile_stats`.`id` 
                                    WHERE `login` LIKE '%" . $queryString . "%' 
                                        OR `name` LIKE '%" . $queryString . "%' 
                                        OR `surname` LIKE '%" . $queryString . "%'
                                        OR `email` LIKE '%" . $queryString . "%' 
                                    ORDER BY users.id LIMIT 12");

    if($query){

    } else {

    }


}