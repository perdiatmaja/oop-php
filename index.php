<?php
require_once "utils/IncludesFiles.php";

use BaseController;

class Main extends BaseController
{
    function test()
    {
        $result = $this->getList("user");

        if ($result) {
            if ($this->getNumRows($result) > 0) {
                print_r($result);
             } else {
                echo "0 results";
             }
        } else {
            die("no");
        }
    }
}

$main = new Main();
$main->test();
