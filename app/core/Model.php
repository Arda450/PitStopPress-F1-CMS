<?php
//  Model class extends Database class
//  models are classes that connect to the database


// Main Model trait
Trait Model {

  use Database;

    protected $limit = '10'; // limit pro seite
    protected $offset = '0';
    protected $order_type = "desc"; // bedeutet: absteigend
    protected $order_column = "id";
    public $errors = [];
    // this one returns multiple rows
    // :id ist ein platzhalter
    // $data is what you're looking for and $data_not is the opposite
    // Diese Funktion ruft alle Datensätze aus der Datenbanktabelle ab, die dem Modell zugeordnet ist.


     // Diese Methode gibt die zuletzt eingefügte ID zurück
     public function lastInsertId() {
      return $this->connect()->lastInsertId();
  }

    public function __construct() { // erstellt eine instanz der datenbank
      $this->connect(); // connect () Stellt die Verbindung zur Datenbank her
  }


    public function findAll() {
      /*Es wird eine SQL-Abfrage erstellt, um alle Datensätze auszuwählen,
      die den Bedingungen entsprechen (where)*/
      $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
      return $this->query($query);
      
    }
      /*Die Funktion akzeptiert zwei Arrays, $data und $data_not,
      die Bedingungen für die Abfrage enthalten. */
      /*Diese Funktion ruft Datensätze ab, die bestimmten Bedingungen entsprechen. */
      public function where($data, $data_not = []) {

        // BEISPIEL START

        // $keys = array_keys($data);                        // ['name', 'email']
        // $keys_not = array_keys($data_not);               // ['status']
        // $query = "select * from $this->table where ";

        // Erste foreach-Schleife (für $data):
        //   // Ergebnis: $query = "select * from $this->table where name = :name && email = :email && "

        // Zweite foreach-Schleife (für $data_not):
        //   // Ergebnis: $query = "select * from $this->table where name = :name && email = :email && status != :status && "
      
      // BEISPIEL ENDE
      
      // Gegen SQL Injectionen auf diese Weise gut gesichert


          // nächste 3 Zeilen: Initialisierung
      $keys = array_keys($data);
      $keys_not = array_keys($data_not);
      /**Es wird eine SQL-Abfrage erstellt, um alle Datensätze auszuwählen,
       * die den Bedingungen entsprechen (where) */
      $query = "select * from $this->table where ";

      // key ist der spaltenname
      /**Für jede Bedingung in $data wird die Spalte ($key) und der Platzhalter hinzugefügt ($key = :$key) */
      foreach ($keys as $key) {
          $query .= $key . " = :" . $key . " && ";
      }

      // && um mehrere where klausel nacheinander zu verknüpfen

      foreach ($keys_not as $key) {
          $query .= $key . " != :" . $key . " && ";
      }

      $query = trim($query, " && "); //  trimmt das letzte "&&"

      /**Die Bedingungen werden kombiniert und die Abfrage wird sortiert, begrenzt und versetzt wie in findAll. */
      $query .= " order by  $this->order_column $this->order_type limit $this->limit offset $this->offset";
      $data = array_merge($data, $data_not);

      return $this->query($query, $data);
      
    }

    // add some common functions
    // Diese Funktion ruft den ersten Datensatz ab, der bestimmten Bedingungen entspricht.
    // Ähnlich wie where, aber es wird nur ein einzelner Datensatz zurückgegeben (limit 1)
    public function first($data, $data_not = []) {

      // grabs the keys from an array
      $keys = array_keys($data);
      $keys_not = array_keys($data_not);
      $query = "select * from $this->table where ";

      foreach ($keys as $key) {
          $query .= $key . " = :" . $key . " && ";
      }

      foreach ($keys_not as $key) {
          $query .= $key . " != :" . $key . " && ";
      }

      $query = trim($query, " && ");

      $query .= " limit $this->limit offset $this->offset";
      $data = array_merge($data, $data_not);

      $result = $this->query($query, $data);
      if($result)
        return $result[0];

      return false;
    }

    // id will be auto generated
    public function insert($data) {

      /* Es wird überprüft, ob die zu speichernden Daten in den erlaubten Spalten
      ($this->allowedColumns) enthalten sind.
      Nicht erlaubte Spalten werden entfernt */ 
       if(!empty($this->allowedColumns)) {
        foreach ($data as $key => $value) {
          if(!in_array($key, $this->allowedColumns)) {
            unset($data[$key]);
          }
        }
      }
      
      $keys = array_keys($data);
      /**Eine SQL-Abfrage wird erstellt, um die Daten in die Tabelle einzufügen */
      $query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";

       // Führt die Query aus und gibt die ID des eingefügten Datensatzes zurück
        $result = $this->query($query, $data);
        if ($result) {
            return $this->lastInsertId();
        }
        return false;
}

    // Diese Funktion aktualisiert einen bestehenden Datensatz in der Tabelle.
    public function update($id, $data, $id_column = 'id') {

      /* Es wird überprüft, ob die zu aktualisierenden Daten in den erlaubten 
      Spalten enthalten sind. Nicht erlaubte Spalten werden entfernt. */ 
      if(!empty($this->allowedColumns)) {
        foreach ($data as $key => $value) {
          if(!in_array($key, $this->allowedColumns)) {
            unset($data[$key]);
          }
        }
      }
      // grabs the keys from an array
      $keys = array_keys($data);
      $query = "update $this->table set ";
      
      foreach ($keys as $key) {
        $query .= $key . " = :" . $key . ", ";
      }
      
      $query = trim($query, ", ");
      
      /**Die Bedingung, welche Zeile aktualisiert werden soll 
       * (where $id_column = :$id_column), wird hinzugefügt. */
      $query .= " where $id_column = :$id_column ";
      
      $data[$id_column] = $id;

      $this->query($query, $data);
      return false;
    }


    // $id is enough to delete. if columns are not called id, use the 2 param
    // Diese Funktion löscht einen Datensatz aus der Tabelle
    public function delete($id, $id_column = 'id') {

      $data[$id_column] = $id;
      $query = "delete from $this->table where $id_column = :$id_column ";
      $this->query($query, $data);

      return false;
    }
}