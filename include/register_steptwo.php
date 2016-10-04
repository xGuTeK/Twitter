<?php
if(!$user->getLogin() && $_GET['act'] != 'checkLogin'){
    ?>
<script>
    function checkLogin() {
        var login = $('#login');
        if(login.val().length >= 4) {
            $.ajax({
                url: "index.php?act=checkLogin",// your username checker url
                type: "POST",
                data: {login: login.val()},
                success: function (response) {
                    $('#loginCheckImg').css('display', 'block');
                    if (response == 'OK.') {
                        login.css('border', '2px solid green');
                        $("#send").disabled = false;
                        $('#loginCheckImg').attr('src', 'template/img/icons/Success-icon.png');
                    }
                    if (response == 'Login already exist.') {
                        login.css('border', '2px solid red');
                        $("#send").disabled = true;
                        $('#loginCheckImg').attr('src', 'template/img/icons/Error-icon.png');
                    }
                }
            });
        } else {
            $('#loginCheckImg').css('display', 'none');
            login.css('border', '');
            $('#send').prop("disabled", true);
        }
    }
</script>
<?php
    echo '<div class="registerStep2">
  <h2>Register step two</h2>
  <form id="registerStepTwoForm">
    <input type="text" name="Login" placeholder="Login" id="login" onkeyup="checkLogin(); return false;" maxlength="12" required /><img id="loginCheckImg" src="" style="display: none; float: left;">
    <input type="text" name="Name" placeholder="Name" maxlength="20" required/>
    <input type="text" name="Surname" placeholder="Surname" maxlength="20" required/>
    <input type="button" value="OK" id="send" />
  </form>
</div>';
}

if($_GET['act'] == 'checkLogin'){
    if(isset($_POST['login'])){
        $login = $_POST['login'];
        if($user->checkIfLoginExist($login) == true){
            echo 'Login already exist.';
        } else {
            echo 'OK.';

        }
    }


}
