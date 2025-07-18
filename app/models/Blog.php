<?php

class Blog {
    use Model;

    protected $table = 'blogs';
    protected $allowedColumns = ['title', 'src', 'alt_text', 'content', 'date'];

    public function __construct() {
        $this->connect();
    }

    public function findBlogById($id) {
        return $this->first(['id' => $id]);
    }

    public function insertBlog($data) {
        return $this->insert($data);
    }

    public function updateBlog($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteBlog($id) {
        return $this->delete($id);
    }
}

?>
