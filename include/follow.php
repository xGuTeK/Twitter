<?php
if (isset($_GET['act']))
{
    if ( $_GET['act'] == 'follow' && isset($_GET['id']) && ($_GET['id'] > 0) )
    {
        $followId = $db->connect()->escape_string($_GET['id']);
        $user->userFollow($user->getUserID(), $followId, "follow");
    }
    if ( $_GET['act'] == 'unfallow' && isset($_GET['id']) && ($_GET['id'] > 0) )
    {
        $unFollowId = $db->connect()->escape_string($_GET['id']);
        $user->userFollow($user->getUserID(), $unFollowId, "unfollow");
    }
}

