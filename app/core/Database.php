<?php

// A trait cannot be used on its own, unless it's used within another class
Trait Database {

  // connect method
  private function connect () {

    $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
    // username is root
    $con = new PDO($string, DBUSER, DBPASS);
    return $con;
  }

 // query method
  // is responsible for executing SQL queries
  public function query ($query, $data = []) {

    $con = $this->connect();
    $stm = $con->prepare($query);

    $check = $stm->execute($data);
      if($check) {
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
          if(is_array($result) && count($result)) {
            
            return $result;
          }
       }
        return false;
  }

  // This function returns 1 row
  public function get_row($query, $data = []) {

    $con = $this->connect();
    $stm = $con->prepare($query);

    $check = $stm->execute($data);
      if($check) {
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
          if(is_array($result) && count($result)) {
            
            return $result[0];
          }
       }
        return false;
  }
}
