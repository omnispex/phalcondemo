<?php
/**
 * Images
 *
 * Model Images
 *
 * @Source('images');
 */
class Images extends \Phalcon\Mvc\Model
{
    /**
     * @Primary
     * @Identity
     * @Column(type="integer", nullable=false, column="id", size="11")
     */
    public $id;

    /**
     * @Column(type="string", nullable=false, column="filename", size="30")
     */
    public $filename;

    /**
     * @Column(type="string", nullable=false, column="path", size="100")
     */
    public $path;

    /**
     * @Column(type="string", nullable=false, column="extension", size="5")
     */
    public $extension;

    /**
     * @Column(type="string", nullable=false, column="thumbnail", size="100")
     */
    public $thumbnail;

    /**
     * Uploads the file and save a record in the database
     * @param array $file the file array
     */
    public function uploadfile($file)
    {
        if ($file->getSize() > 0 && $file->getSize() < 20000000)
        {
            if ($file->getType()=='image/gif' || $file->getType()=='image/jpg' || $file->getType()=='image/jpeg' || $file->getType()=='image/png')
            {            
                $random=Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM);
                $extension=pathinfo($file->getName(),PATHINFO_EXTENSION);
                $realfilename=$random.'.'.pathinfo($file->getName(),PATHINFO_EXTENSION);
                $path='upload/'.$realfilename;
                $file->moveTo($path);

                $thumbnail=new Imagick($path);
                $thumbnail->cropThumbnailImage(150,100);
                $thumbnail->setImagePage(0,0,0,0);
                $thumbnail->writeImage('upload/thumbnails/'.$realfilename);

                $this->filename=$file->getName();
                $this->path=$path;
                $this->extension=pathinfo($file->getName(),PATHINFO_EXTENSION);
                $this->thumbnail='upload/thumbnails/'.$realfilename;
                $this->save();
            }
        }
    }

    /**
     * Deletes the file and remove the related record from the database
     */
    public function deletefile()
    {
        if (file_exists($this->path)) 
        {  
            unlink($this->path);
        } 
        if (file_exists($this->thumbnail)) 
        {  
            unlink($this->thumbnail);
        }
        $this->delete(); 
    }    
}