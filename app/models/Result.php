<?php

class Result {
    use Model;

    protected $table = 'results';
    protected $allowedColumns = ['race', 'race_date', 'winner', 'team', 'race_time', 'laps'];

    public function __construct() {
        $this->connect();
    }

    public function findResultById($id) {
        return $this->first(['id' => $id]);
    }

    public function insertResult($data) {
        return $this->insert($data);
    }

    public function updateResult($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteResult($id) {
        return $this->delete($id);
    }
}

?>
