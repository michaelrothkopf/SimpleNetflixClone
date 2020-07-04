<?php
error_reporting(0);

function create_account($username, $password) {
    $_password = password_hash($password, PASSWORD_DEFAULT);
    $data = (object)array();
    $data->username = $username;
    $data->password = $_password;
    file_put_contents("../users/" . $username . ".json", json_encode($data));
}

function generateLoginKey($username) {
    $filecontents = file_get_contents("../users/" . $username . ".json");
    $data = json_decode($filecontents);

    $key = uniqid("simple_netflix_clone_login_");
    $data->latest_key = password_hash($key, PASSWORD_DEFAULT);

    $expiredate = new DateTime();
    $expiredate->modify('+1 day');
    $data->key_expires = $expiredate;

    file_put_contents("../users/" . $username . ".json", json_encode($data));

    return $key;
}

function verifyLoginKey($username, $key) {
    $filecontents = file_get_contents("../users/" . $username . ".json");
    $data = json_decode($filecontents);

    $existingKey = $data->latest_key;
    $timestr = $data->key_expires->date;
    $existingKeyExpireTime = strtotime($timestr);

    $dt = new DateTime();
    //$_interval = $existingKeyExpireTime->diff($dt);
    //$interval = $interval->format('%s');

    if (password_verify($key, $existingKey)) {
        if ($dt < $existingKeyExpireTime) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function verify_account($username, $password) {
    $filecontents = file_get_contents("../users/" . $username . ".json");
    $data = json_decode($filecontents);
    if (password_verify($password, $data->password)) {
        return true;
    } else {
        return false;
    }
}

if ($_POST["mode"] == 1) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $useraccountcreated = ($_POST["newaccount"] == "1") ? true : false;

    if ($useraccountcreated) {
        if (file_exists("../users/" . $username . ".json")) {
            http_response_code(200);
            echo "912";
        } else {
            create_account($username, $password);
            http_response_code(200);
            echo "900" . generateLoginKey($username);
        }
    } else {
        if (file_exists("../users/" . $username . ".json")) {
            if (verify_account($username, $password)) {
                http_response_code(200);
                echo "900" . generateLoginKey($username);
            } else {
                http_response_code(200);
                echo "901";
            }
        } else {
            http_response_code(200);
            echo "905";
        }
    }
} else {
    $username = $_POST["username"];
    $key = $_POST["key"];

    if (verifyLoginKey($username, $key)) {
        echo "900";
    } else {
        echo "920";
    }
}
?>