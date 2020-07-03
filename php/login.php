<?php
$username = $_POST["username"];
$password = $_POST["password"];
$useraccountcreated = ($_POST["newaccount"] == "1") ? true : false;

function create_account($username, $password) {
    $_password = password_hash($password, PASSWORD_DEFAULT);
    $data = (object)array();
    $data->username = $username;
    $data->password = $_password;
    file_put_contents("../users/" . $username . ".json", json_encode($data));
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

if ($useraccountcreated) {
    if (file_exists("../users/" . $username . ".json")) {
        http_response_code(200);
        echo "912";
    } else {
        create_account($username, $password);
        http_response_code(200);
        echo "900";
    }
} else {
    if (file_exists("../users/" . $username . ".json")) {
        if (verify_account($username, $password)) {
            http_response_code(200);
            echo "900";
        } else {
            http_response_code(200);
            echo "901";
        }
    } else {
        http_response_code(200);
        echo "905";
    }
}
?>