<?php

class Article {
    use Model;

    protected $table = 'articles';
    protected $allowedColumns = ['title', 'content', 'src', 'alt_text', 'created_at'];

    public function __construct() {
        $this->connect();
    }
    
    public function findByID($id) {
        return $this->first(['id' => $id]);
    }

    public function insertArticle($data) {
        return $this->insert($data);
    }

    public function updateArticle($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteArticle($id) {
        return $this->delete($id);
    }
}
?>
