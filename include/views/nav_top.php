<div class="nav_search">
    <form id="searchForm">
        <div class="nav_search_field">
            <input type="text" id="searchInput" placeholder="Wyszukaj osoby" maxlength="20" onkeyup="lookup(this.value);"/>
        </div>
        <input type="submit" id="searchSubmit" value="" />
        <div id="suggestions"></div>
    </form>
</div>
<div class="nav_profile_menu">

    <div class="dropdown" style="" title="Profil i ustawienia">
        <button class="profile-small nav_profile_button" type="button" id="menu1" data-toggle="dropdown" style="background-image: url('<?php echo './upload/profile/'.$user->getProfileImage(); ?>'); background-size: cover; background-repeat: no-repeat; height: 30px; width: 30px; position: relative; top: 10%;"></button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?profile=<?php echo $user->getLogin(); ?>"><i class="glyphicon glyphicon-user" style=""></i>Zobacz profil</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-envelope"></i>Wiadomości</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="glyphicon glyphicon-cog"></i>Ustawienia</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?act=logout"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
        </ul>
    </div>
</div>