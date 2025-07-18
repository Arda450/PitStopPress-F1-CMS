<?php

class Dashboard {
    use Controller;
    
      public function home() {
        $this->view('dashboard/home');
      }



    protected $articleModel;
    protected $imageHandler;
    protected $blogModel;
    protected $resultModel;

    public function __construct() {
        $this->articleModel = $this->model('Article');
        $this->imageHandler = $this->model('ImageHandler');
        $this->blogModel = $this->model('Blog');
        $this->resultModel = $this->model('Result');
        // $this->requireLogin();
    }

    public function index() {
        $this->view('dashboard/home');
    }


    // ARTICLE PART
    public function articles() {
        $articles = $this->articleModel->findAll();
        $this->view('dashboard/articles', ['articles' => $articles]);
    }

    public function addArticleForm() {
        $this->view('dashboard/add.article');
    }

    public function addArticle() {
        // Fehler- und Erfolgs-Arrays bereinigen
         $errors = [];
         $success = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $altText = $_POST['alt_text'] ?? '';
            

            // Check if values are empty or undefined, set errors
             if (empty($title)) $errors[] = "Title can not be empty";
             if (empty($content)) $errors[] = "Content can not be empty";
             if (empty($altText)) $errors[] = "Alt text can not be empty";



            // Bild validieren und hochladen
            $imageHandler = new ImageHandler();
            if (!$imageHandler->checkFileError()) {
                $errors = array_merge($errors, $imageHandler->getErrors());
            } else {
                $imageName = $imageHandler->moveFile('article');
                if ($imageName === false) {
                    $errors = array_merge($errors, $imageHandler->getErrors());
                }
            }


             if(!empty($errors)) {
                $this->view('dashboard/add.article', ['errors' => $errors]);
                return;
               }

               

             $articleData = [
                'title' => $title,
                'content' => $content,
                'src' => $imageName,
                'alt_text' => $altText,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $articleId = $this->articleModel->insertArticle($articleData);

             if ($articleId) {
              
              }

            //   $this->view('dashboard/articles', ['success' => $success]);
            return header('location: ' . ROOT . '/dashboard/articles?success=Article created successfully.');
        
           
     }
}



    public function editArticleForm($articleId = null) {
        if ($articleId) {
            $article = $this->articleModel->findByID($articleId);
            $this->view('dashboard/edit.article', ['article' => $article]);
        } else {
            header('Location: ' . ROOT . '/dashboard/articles');
            exit();
        }
        
    }

    public function editArticle() {
        $errors = [];
        $success = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleId = $_POST['article_id'] ?? null;
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $altText = $_POST['alt_text'] ?? '';

            // Check if values are empty or undefined, set errors
            if (empty($title)) $errors[] = "Title can not be empty";
            if (empty($content)) $errors[] = "Content can not be empty";
            if (empty($altText)) $errors[] = "Alt text can not be empty";

             // Wenn ein Bild hochgeladen wird, verarbeite es
        $imageName = null;
        if (isset($_FILES['myFile']) && $_FILES['myFile']['error'] == UPLOAD_ERR_OK) {
            $imageName = $this->imageHandler->moveFile('article');
            if (!$imageName) {
                $errors[] = "Error uploading the image: " . implode(", ", $this->imageHandler->getErrors());
            }
        }
            
        if(!empty($errors)) {
            $this->view('dashboard/edit.article', ['errors' => $errors]);
            return;
           }

            $data = [
                'title' => $title,
                'content' => $content,
                'alt_text' => $altText
            ];

            if ($imageName) {
                $data['src'] = $imageName;
            }

            $articleId = $this->articleModel->updateArticle($articleId, $data);

            if ($articleId) {
                
                    $success[] = "Article updated successfully.";

                }
                return header('Location: ' . ROOT . '/dashboard/articles?success=Article updated successfully.');
        }

    }


    public function deleteArticle($articleId = null) {
        $errors = [];
        $success = [];

        $articleId = $this->articleModel->deleteArticle($articleId);

       
            if ($articleId) {
                $success[] = "Article deleted successfully.";
            } else {
                $errors[] = "Error deleting the article.";
            }
        

        return header('Location: ' . ROOT . '/dashboard/articles?success=Article deleted successfully.');
        
    }

// ARTICLE PART ENDING


    // BLOG PART

    public function blog() {
        $blogs = $this->blogModel->findAll();

        if ($blogs && is_array($blogs)) {
         // datum in dd.mm.yyyy formatieren
         foreach ($blogs as &$blog) {
            $dateObj = DateTime::createFromFormat('Y-m-d', $blog['date']);
            if ($dateObj) {
                $blog['date'] = $dateObj->format('d.m.Y');
            }
        }
    } else {
        $blogs = [];
    }
        $this->view('dashboard/blog', ['blogs' => $blogs]);
}

    public function addBlogForm() { // die Session-Fehlermeldungen bereinigen
        $this->view('dashboard/add.blog');
    }

    public function addBlog() {
        $errors = [];
        $success = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $altText = $_POST['alt_text'] ?? '';
            $date = $_POST['date'] ?? '';
    
            // Check if values are empty or undefined, set errors
            if (empty($title)) $errors[] = "Title can not be empty";
            if (empty($content)) $errors[] = "Content can not be empty";
            if (empty($altText)) $errors[] = "Alt text can not be empty";

            if (empty($date)) {
                $errors[] = "Date can not be empty";
            } elseif (!preg_match('/\d{2}\.\d{2}\.\d{4}/', $date)) {
                $errors[] = "Invalid date format. Please use dd.mm.yyyy.";
            } else {
                // Convert date to Y-m-d format for database storage
                $dateObj = DateTime::createFromFormat('d.m.Y', $date);
                if ($dateObj) {
                    $date = $dateObj->format('Y-m-d');
                } else {
                    $errors[] = "Invalid date format. Please use dd.mm.yyyy.";
                }
            }


    
            // Bild validieren und hochladen
            $imageHandler = new ImageHandler();
            if (!$imageHandler->checkFileError()) {
                $errors = array_merge($errors, $imageHandler->getErrors());
            } else {
                $imageName = $imageHandler->moveFile('blog');
                if ($imageName === false) {
                    $errors = array_merge($errors, $imageHandler->getErrors());
                }
            }
    
            if(!empty($errors)) {
                $this->view('dashboard/add.blog', ['errors' => $errors]);
                return;
            }
    
            $blogData = [
                'title' => $title,
                'content' => $content,
                'src' => $imageName,
                'alt_text' => $altText,
                'date' => $date
            ];
    
            $blogId = $this->blogModel->insertBlog($blogData);
    
            if ($blogId) {
                // $success[] = "Blog created successfully.";
               
            }
            return header('location: ' . ROOT . '/dashboard/blog?success=Blog created successfully.');
        }
    }
    

    public function editBlogForm($blogId = null) {
        if ($blogId) {
            $blog = $this->blogModel->findBlogByID($blogId);
            $this->view('dashboard/edit.blog', ['blog' => $blog]);
        } else {
            header('Location: ' . ROOT . '/dashboard/blog');
            exit();
        }
    }

    public function editBlog() {
        $errors = [];
        $success = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blogId = $_POST['blog_id'] ?? null;
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $altText = $_POST['alt_text'] ?? '';
            $date = $_POST['date'] ?? '';

             // Check if values are empty or undefined, set errors
             if (empty($title)) $errors[] = "Title can not be empty";
             if (empty($content)) $errors[] = "Content can not be empty";
             if (empty($altText)) $errors[] = "Alt text can not be empty";

            if (empty($date)) {
                $errors[] = "Race date can not be empty";
            } elseif (!preg_match('/\d{2}\.\d{2}\.\d{4}/', $date)) {
                $errors[] = "Invalid date format. Please use dd.mm.yyyy.";
            } else {
                // Convert date to Y-m-d format for database storage
                $dateObj = DateTime::createFromFormat('d.m.Y', $date);
                if ($dateObj) {
                    $date = $dateObj->format('Y-m-d');
                } else {
                    $errors[] = "Invalid date format. Please use dd.mm.yyyy.";
                }
            }
    
             // Wenn ein Bild hochgeladen wird, verarbeite es
        $imageName = null;
        if (isset($_FILES['myFile']) && $_FILES['myFile']['error'] == UPLOAD_ERR_OK) {
            $imageName = $this->imageHandler->moveFile('blog');
            if (!$imageName) {
                $errors[] = "Error uploading the image: " . implode(", ", $this->imageHandler->getErrors());
            }
        }

             
        if(!empty($errors)) {
            $this->view('dashboard/edit.blog', ['errors' => $errors]);
            return;
           }
            
            $data = [
                'title' => $title,
                'content' => $content,
                'alt_text' => $altText,
                'date' => $date
            ];

            if ($imageName) {
                $data['src'] = $imageName;
            }

            $blogId = $this->blogModel->updateBlog($blogId, $data);

            if ($blogId) {
                
                    $success[] = "Blog updated successfully.";

                }
                return header('Location: ' . ROOT . '/dashboard/blog?success=Blog updated successfully.');
        }

    }


    public function deleteBlog($blogId = null) {
        $errors = [];
        $success = [];

        if ($blogId) {
            if ($this->blogModel->deleteBlog($blogId)) {
                $success[] = "Blog deleted successfully.";
            } else {
                $errors[] = "Error deleting the blog.";
            }
        }

        return header('Location: ' . ROOT . '/dashboard/blog?success=Blog deleted successfully.');
        
    }

    // BLOG PART ENDING




// RESULT PART BEGINS HERE

public function results() {
    $results = $this->resultModel->findAll();

    if ($results && is_array($results)) {
    // datum in dd.mm.yyyy formatieren
    foreach ($results as $result) {
        $dateObj = DateTime::createFromFormat('Y-m-d', $result['race_date']);
        if ($dateObj) {
            $result['race_date'] = $dateObj->format('d.m.Y');
            }
        }
    } else {
        $results = [];  // Default to an empty array if no results are found or an error occurred
   }
        $this->view('dashboard/results', ['results' => $results]);
    }

    public function addResultForm() { // die Session-Fehlermeldungen bereinigen
        $this->view('dashboard/add.result');
    }

    public function addResult() {
        $errors = [];
        $success = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $race = $_POST['race'] ?? '';
            $raceDate = $_POST['race_date'] ?? '';
            $winner = $_POST['winner'] ?? '';
            $team = $_POST['team'] ?? '';
            $raceTime = $_POST['race_time'] ?? '';
            $laps = $_POST['laps'] ?? '';


             // Check if values are empty or undefined, set errors
             if (empty($race)) $errors[] = "Race input can not be empty";
            //  if (empty($raceDate)) $errors[] = "Racedate can not be empty";
             if (empty($raceDate)) {
                $errors[] = "Date can not be empty";
            } elseif (!preg_match('/\d{2}\.\d{2}\.\d{4}/', $raceDate)) {
                $errors[] = "Invalid date format. Please use dd.mm.yyyy.";
            } else {
                // Convert date to Y-m-d format for database storage
                $dateObj = DateTime::createFromFormat('d.m.Y', $raceDate);
                if ($dateObj) {
                    $raceDate = $dateObj->format('Y-m-d');
                } else {
                    $errors[] = "Invalid date format. Please use dd.mm.yyyy.";
                }
            }
             if (empty($winner)) $errors[] = "Winner input can not be empty";
             if (empty($team)) $errors[] = "Team input can not be empty";
             if (empty($raceTime)) $errors[] = "Racetime can not be empty";
             if (empty($laps)) $errors[] = "Laps input can not be empty";

             
             if(!empty($errors)) {
                $this->view('dashboard/add.result', ['errors' => $errors]);
                return;
               }


            $resultData = [
                'race' => $race,
                'race_date' => $raceDate,
                'winner' => $winner,
                'team' => $team,
                'race_time' => $raceTime,
                'laps' => $laps
            ];
    
            $resultId = $this->resultModel->insertResult($resultData);

            if ($resultId) {
                    
                // $success[] = "Result created successfully.";
                
                }
                return header('Location: ' . ROOT . '/dashboard/results?success=Result created successfully');
            
        }

       
    }

    public function editResultForm($resultId = null) {
        if ($resultId) {
            $result = $this->resultModel->findResultByID($resultId);
            $this->view('dashboard/edit.result', ['result' => $result]);
        } else {
            header('Location: ' . ROOT . '/dashboard/result');
            exit();
        }
    }

    public function editResult() {
        $errors = [];
        $success = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultId = $_POST['result_id'] ?? null;
            $race = $_POST['race'] ?? '';
            $raceDate = $_POST['race_date'] ?? '';
            $winner = $_POST['winner'] ?? '';
            $team = $_POST['team'] ?? '';
            $raceTime = $_POST['race_time'] ?? '';
            $laps = $_POST['laps'] ?? '';

             // Check if values are empty or undefined, set errors
             if (empty($race)) $errors[] = "Race input can not be empty";
             
             if (empty($raceDate)) {
                $errors[] = "Race date can not be empty";
            } elseif (!preg_match('/\d{2}\.\d{2}\.\d{4}/', $raceDate)) {
                $errors[] = "Invalid date format. Please use dd.mm.yyyy.";
            } else {
                // Convert date to Y-m-d format for database storage
                $dateObj = DateTime::createFromFormat('d.m.Y', $raceDate);
                if ($dateObj) {
                    $raceDate = $dateObj->format('Y-m-d');
                } else {
                    $errors[] = "Invalid date format. Please use dd.mm.yyyy.";
                }
            }

             if (empty($winner)) $errors[] = "Winner input can not be empty";
             if (empty($team)) $errors[] = "Team input can not be empty";
             if (empty($raceTime)) $errors[] = "Racetime can not be empty";
             if (empty($laps)) $errors[] = "Laps input can not be empty";

             if(!empty($errors)) {
                $this->view('dashboard/edit.result', ['errors' => $errors]);
                return;
               }

            
            $data = [
                'race' => $race,
                'race_date' => $raceDate,
                'winner' => $winner,
                'team' => $team,
                'race_time' => $raceTime,
                'laps' => $laps
            ];

            $resultId = $this->resultModel->updateResult($resultId, $data);

            if ($resultId) {
                
                    $success[] = "Result updated successfully.";

                }
                return header('Location: ' . ROOT . '/dashboard/results?success=Result updated successfully.');
        }

    }

    public function deleteResult($resultId = null) {
        $errors = [];
        $success = [];

        $resultId = $this->resultModel->deleteresult($resultId);

        if ($resultId) {
            
                $success[] = "Result deleted successfully.";
            } else {
                $errors[] = "Error deleting the result.";
            }
        

        return header('Location: ' . ROOT . '/dashboard/results?success=Result deleted successfully');
        
    }

}

?>
