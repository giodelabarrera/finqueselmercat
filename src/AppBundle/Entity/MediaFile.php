<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * MediaFile
 *
 * @ORM\Entity
 * @ORM\Table(name="media_file")
 */
class MediaFile
{
    /**
     *
     */
    const UPLOAD_DIR = 'uploads/media_file';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="content_type", type="string", length=255, nullable=true)
     */
    private $contentType;

    /**
     * @ORM\Column(name="content_size", type="integer", nullable=true)
     */
    private $contentSize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @Assert\File(maxSize="5000000", groups={"creation"})
     * @Assert\NotBlank(groups={"creation"})
     */
    private $file;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\DateTime()
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Assert\DateTime()
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * MediaFile constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->mediaFileTags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return null|string
     */
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->getHashDir($this->path).'/'.$this->path;
    }

    /**
     * @return null|string
     */
    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->getHashDir($this->path).'/'.$this->path;
    }

    /**
     * @return string
     */
    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // files should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return self::UPLOAD_DIR;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return MediaFile
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return MediaFile
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Devuelve nombre de directorio con niveles de profundidad en base a nombre de fichero
     * @param string encriptedFilename
     * @return string
     */
    public function getHashDir($encriptedFilename, $levelsDeep = 4)
    {
        return implode("/", str_split(substr($encriptedFilename, 0, $levelsDeep)));
    }

    /**
     * Encripta nombre de fichero
     *
     * @return string
     */
    public function createDir($dirname) {
        // The `true` flag here will have `mkdir` create directories recursively.  
        if (!file_exists($dirname) && !mkdir($dirname, 0777, true))
            throw new \Exception("Could not create directory " . $dirname);

        return true;
    }

    /**
     * Encripta nombre de fichero
     *
     * @return string
     */
    public function encryptFilename($filename)
    {
        $encrypted = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        if (pathinfo($filename, PATHINFO_EXTENSION))
            $encrypted .= '.'.pathinfo($filename, PATHINFO_EXTENSION);
        return $encrypted;
    }

    /**
     * Sube el archivo al servidor
     *
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // dump($this->getFile());
        // dump($this->getFile()->getClientOriginalName());
        // dump($this->getFile()->getClientMimeType());
        // dump($this->getFile()->getClientSize());
        // dump($this->getFile()->guessClientExtension());
        // dump($this->getFile()->getClientOriginalExtension());
        // die();

        // guarda nombre original de archivo
        $this->name = $this->getFile()->getClientOriginalName();

        // encripta nombre de archivo
        $encryptedFilename = $this->encryptFilename($this->getFile()->getClientOriginalName());
        
        // nombre de directorio generado a partir de los niveles de profundidad del nombre de fichero encriptado
        $dirname = $this->getHashDir($encryptedFilename);

        // crea directorio
        $this->createDir($this->getUploadRootDir().'/'.$dirname);

        // move takes the target directory and then the target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir().'/'.$dirname,
            $encryptedFilename
        );

        // set the path property to the filename where you've saved the file
        $this->path = $encryptedFilename;

        // inserta contenido de otros campos
        $this->contentType = $this->getFile()->getClientMimeType();
        $this->contentSize = $this->getFile()->getClientSize();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MediaFile
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return MediaFile
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set contentType
     *
     * @param string $contentType
     *
     * @return MediaFile
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set contentSize
     *
     * @param integer $contentSize
     *
     * @return MediaFile
     */
    public function setContentSize($contentSize)
    {
        $this->contentSize = $contentSize;

        return $this;
    }

    /**
     * Get contentSize
     *
     * @return integer
     */
    public function getContentSize()
    {
        return $this->contentSize;
    }
}
