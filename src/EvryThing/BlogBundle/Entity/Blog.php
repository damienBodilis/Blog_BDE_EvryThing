<?php

namespace EvryThing\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 * @ORM\HasLifecycleCallbacks()
 */
class Blog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $author;

    /**
     * @ORM\Column(type="text")
     */
    protected $accroche;

	/**
     * @ORM\Column(type="text")
     */
    protected $contenu;
	
    /**
     * @ORM\Column(type="string", length=1000)
     */
    protected $image;

    /**
     * @ORM\Column(type="text")
     */
    protected $tags;

	/**
	* @ORM\OneToMany(targetEntity="EvryThing\BlogBundle\Entity\Commentaire", mappedBy="blog")
	*/
	private $commentaires; 

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;
	
	public function __construct()
	{
		$this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Blog
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Blog
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set accroche
     *
     * @param string $accroche
     * @return Blog
     */
    public function setAccroche($accroche)
    {
        $this->accroche = $accroche;
        return $this;
    }

    /**
     * Get accroche
     *
     * @return string 
     */
    public function getAccroche()
    {
        return $this->accroche;
    }
	
	 /**
     * Set contenu
     *
     * @param string $contenu
     * @return Blog
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }


    /**
     * Set image
     *
     * @param string $image
     * @return Blog
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Blog
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Blog
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Blog
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
/**
	* @param EvryThing\BlogBundle\Entity\Commentaire $commentaire
	* @return Blog
	*/
	public function addCommentaire(\EvryThing\BlogBundle\Entity\Commentaire $commentaire)
	{
		$this->commentaires[] = $commentaire;
		return $this;
	}

	/**
	* @param EvryThing\BlogBundle\Entity\Commentaire $commentaire
	*/
	public function removeCommentaire(\EvryThing\BlogBundle\Entity\Commentaire $commentaire)
	{
		$this->commentaires->removeElement($commentaire);
	}	

	/**
	* @return Doctrine\Common\Collections\Collection
	*/
	public function getCommentaires()
	{
		return $this->commentaires;
	}


public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new NotBlank());
        $metadata->addPropertyConstraint('blog', new NotBlank());
    }
	
public function upload()
	{
		// Si jamais il n'y a pas de fichier (champ facultatif)
		if (null === $this->image) {
		  return;
		}
		// On garde le nom original du fichier de l'internaute
		$name = $this->image->getClientOriginalName();

		// On déplace le fichier envoyé dans le répertoire de notre choix
		$this->image->move($this->getUploadRootDir(), $name);
		$this->image = 'bundles/evrythingblog/images/'.$name;
	}
public function getUploadDir()
	{
		return '/articles';
	}

protected function getUploadRootDir()
	{
		// On retourne le chemin relatif vers l'image pour notre code PHP
		return __DIR__.'/../../../../web/bundles/evrythingblog/images/';
	}
}
