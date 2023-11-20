<?php
class Dbconfig {
    protected $serverName;
    protected $userName;
    protected $passCode;
    protected $dbName;

    function Dbconfig() {
        $this -> serverName = 'localhost';
        $this -> userName = 'ussd';
        $this -> passCode = 'ussd123456';
        $this -> dbName = 'ussd';
    }
}
?>