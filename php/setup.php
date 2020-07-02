<?php
require_once("../vendors/DataStoreLib/DataStoreLib.php");

if (isset($_POST["clicked"])) {
    $ds = new DataStore();
    $ds->Init("Users", "Users.json");
    $ds->Add("Test", "Password");
    $ds->Save();
}
?> 