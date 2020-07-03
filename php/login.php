<?php
$username = $_GET["username"];
$password = $_GET["password"];
$useraccountcreated = ($_GET["newaccount"] == "1") ? true : false;

function create_account($username, $password) {
    $_password = password_hash($password, PASSWORD_DEFAULT);
    $data = (object)array();
    $data->username = $username;
    $data->password = $password;
    $file = fopen("users/" . $username . ".json", "w+");
    fwrite($file, json_encode($data));
    fclose($file);
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