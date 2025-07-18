<?php
// Validierungs- und Uploadlogik in diesem File.
class ImageHandler {
    use Model;

    private $allowedMimeTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
    private $allowedExtensions = ["jpg", "jpeg", "png", "gif", "webp"];
    private $maxFileSize = 1000000; // 1MB in Bytes
    private $maxImgWidth = 3000; // Max width in pixels
    private $maxImgHeight = 2000; // Max height in pixels

    private $errorsArr = [];

    public function __construct() {
        $this->connect();
    }

    public function checkFileError() {
        if (!isset($_FILES['myFile'])) {
            $this->errorsArr[] = "No file has been uploaded.";
            return false;
        }
    
        // Check if upload was successful
        if ($_FILES['myFile']['error'] !== UPLOAD_ERR_OK) {
            $this->errorsArr[] = $this->fileUploadErrorMessage($_FILES['myFile']['error']);
            return false;
        }
    
        // Check file type and size
        if (!$this->validateFileType($_FILES['myFile']['type'])) {
            $this->errorsArr[] = "Invalid file type. Allowed: " . implode(', ', $this->allowedMimeTypes);
            return false;
        }
    
        // Additional checks for file size and dimensions
        if ($_FILES['myFile']['size'] > $this->maxFileSize) {
            $this->errorsArr[] = "File is too big (maximum file size: " . ($this->maxFileSize / 1000000) . " MB).";
            return false;
        }

        
    
        $sizeArr = getimagesize($_FILES['myFile']['tmp_name']);
        $width = $sizeArr[0];
        $height = $sizeArr[1];
    
        if ($width > $this->maxImgWidth || $height > $this->maxImgHeight) {
            $this->errorsArr[] = "The image is too big. Maximum dimensions are {$this->maxImgWidth}x{$this->maxImgHeight} Pixel.";
            return false;
        }
    
        return true;
    }
    
    private function fileUploadErrorMessage($errorCode) {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return "The file is too large (larger than 1mb).";
            case UPLOAD_ERR_FORM_SIZE:
                return "The file exceeds the maximum file size specified in the form.";
            case UPLOAD_ERR_PARTIAL:
                return "The file was only partially uploaded. Please try again.";
            case UPLOAD_ERR_NO_FILE:
                return "No file was selected. Please select a file.";
            case UPLOAD_ERR_NO_TMP_DIR:
                return "There is a big problem. Please contact the administrator.";
            case UPLOAD_ERR_CANT_WRITE:
                return "The file could not be saved.";
            case UPLOAD_ERR_EXTENSION:
                return "File upload was stopped by an extension. Please contact the administrator.";
            default:
                return "An unknown error has occurred. Please try again.";
        }
    }
    
    private function validateFileType($fileType) {
        return in_array($fileType, $this->allowedMimeTypes);
    }
    
    
    public function moveFile($type) {
        if (!isset($_FILES['myFile'])) {
            $this->errorsArr[] = "No file has been uploaded.";
            return false;
        }
    
        if (!$this->checkFileError()) {
            return false;
        }
    
        $tmp_name = $_FILES["myFile"]["tmp_name"];
        $name = basename($_FILES["myFile"]["name"]);
        $name = time() . "_" . $name;

        $uploadDir = $type === 'blog' ? 'blog.images/' : 'homepage.images/';
        $uploadPath = "C:/xampp/htdocs/MVC/public/assets/images/{$uploadDir}" . $name;
    
        if (move_uploaded_file($tmp_name, $uploadPath)) {
            return $name;
        } else {
            $this->errorsArr[] = "The file could not be saved.";
            return false;
        }
    }

    public function getErrors() {
        return $this->errorsArr;
    }
}
?>
