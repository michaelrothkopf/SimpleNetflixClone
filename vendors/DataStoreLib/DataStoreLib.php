<?php
class DataStore {
    
    private $data = array();
    public $name;

    function Init($name, $filename = "") {
        $thix->data["METADATA"] = 0;
        $this->name = $name;
        if ($filename != "") {
            // Checks if the .json extension has been provided in the filename string
            $len = strlen($filename);
            $last5 = $filename[$len - 5] . $filename[$len - 4] . $filename[$len - 3] . $filename[$len - 2] . $filename[$len - 1];

            if ($last5 != ".json") {
                $this->filename = $filename . ".json";
            } else {
                $this->filename = $filename;
            }
        } else {
            $len = strlen($name);
            $last5 = $name[$len - 5] . $name[$len - 4] . $name[$len - 3] . $name[$len - 2] . $name[$len - 1];

            if ($last5 != ".json") {
                $this->filename = $name . ".json";
            } else {
                $this->filename = $name;
            }
        }
    }

    function Add($key, $value) {
        $this->data[$key] = $value;
    }

    function Modify($key, $value) {
        $this->data[$key] = $value;
    }

    function Remove($key) {
        unset($this->data[$key]);
    }

    function Compile() {
        return json_encode($this->data);
    }

    function Save() {
        file_put_contents("data/" . $this->filename, Compile());
    }

    function Load($loadfilename) {
        $dat = file_get_contents($loadfilename);
        $this->data = json_decode($dat);
    }

    function Get($key) {
        return $this->data[$key];
    }
}
?>