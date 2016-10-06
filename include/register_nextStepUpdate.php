<?php
if($_GET['act'] == 'registerNextStepUpdate') {
    if (isset($_POST['Login']) && isset($_POST['Name']) && isset($_POST['Surname'])) {
        $login = $_POST['Login'];
        $name = $_POST['Name'];
        $surname = $_POST['Surname'];

        if((strlen($login) >= 4 && strlen($login) <= 12)) {
            if ((strlen($name) >=2 && strlen($name) <= 20)){
                if((strlen($surname) >= 2) && (strlen($surname) <=20)){

                    if ($user->registerNextStep($user->getUserID(), $login, $name, $surname) == true) {
                        echo '1';
                    } else {
                        echo '0';
                    }

                } else {
                    echo 'Nazwisko musi zawierać od 2 do 20 znaków.';
                }
            } else {
                echo 'Imię musi zawierać od 2 do 20 znaków.';
            }
        } else {
            echo 'Login musi zawierać od 4 do 12 znaków.';
        }
    }
}