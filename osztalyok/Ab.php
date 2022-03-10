<?php
class Ab {

  private $host;
  private $user;
  private $pass;
  private $abNev;

  protected function connect() {

    $this->host="localhost"; // ezt majd át kell írni!
    $this->user="root222";
    $this->pass="SIMO.321";
    $this->abNev="utazas";

    $con= new mysqli($this->host,$this->user,$this->pass,$this->abNev);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed to MySQL: " . $con->connect_error);
    }
    $con->set_charset("utf8");
    //error_reporting(E_ALL);

    return $con;
  }

}
?>