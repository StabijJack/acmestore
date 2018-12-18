<?php

namespace App\Classes;

class UploadFile
{
    protected $filename;
    protected $max_filesize = 2097152;
    protected $extension;
    protected $path;

    public function getName()
    {
        return $this->filename;
    }
    protected function setName($file, $name = "")
    {
        if($name === '')
        {
            $name = pathinfo($file, PATHINFO_FILENAME);
        }
        $name = strtolower(str_replace(['_', ' '], '-', $name));
        $hash - md5(microtime());
        $ext = $this->fileExtension($file);
        $this->filename = "{$name}-{$hash}.{$ext}";
    }
    protected function fileExtension($file)
    {
        return $this->extension = pathinfo($flie,PATHINFO_EXTENSION);
    }
    public static function fileSize($file)
    {
        $fileObj = new static;
        return $file > $fileObj->max_filesize ? true : false;
    }
    public static function isImage($file)
    {
        $fileObj = new static;
        $ext = $fileObj->fileExtension($file);
        $validExt = array('jpg', 'jpeg', 'png', 'bmp', 'gif');
        if(!in_array(strtolower($ext), $validExt)){
            return false;
        }
        return true;
    }
    public function path()
    {   
        return $this->path;
    }
}