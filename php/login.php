<?php
$username = $_POST["username"];
$password = $_POST["password"];
$useraccountcreated = ($_POST["password"] == "1") ? true : false;

function create_account($username, $password) {
    $_password = password_hash($password);
    $data = array();
    $data->username = $username;
    $data->password = $password;
    file_put_contents("users/" . $username . ".json", json_encode($data));
}

function verify_account($username, $password) {
    $filecontents = file_get_contents("users/" . $username . ".json");
    $data = json_decode($filecontents);
    if (password_verify($data->password, $password)) {
        return true;
    } else {
        return false;
    }
}

if ($useraccountcreated) {
    if (file_exists("users/" . $username . ".json")) {
        http_response_code(912);
        echo "912";
    } else {
        create_account($username, $password);
        http_response_code(900);
        echo "900";
    }
} else {
    if (file_exists("users/" . $username . ".json")) {
        if (verify_account($username, $password)) {
            http_response_code(900);
            echo "900";
        } else {
            http_response_code(901);
            echo "901";
        }
    } else {
        http_response_code(905);
        echo "905";
    }
}
?>