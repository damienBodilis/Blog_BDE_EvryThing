<?php

namespace EvryThing\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="EvryThing\DocumentBundle\Entity\DocumentRepository")
 */
class Document
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=1000)
     */
    private $url;
	
    private $dossier; //à tester!

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description; //pas implémenter
	
    private $file;

    public function __construct()
    {
	$this->date = new \Datetime();
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
     * Set nom
     *
     * @param string $nom
     * @return Document
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Document
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set dossier
     *
     * @param string $dossier
     * @return Document
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return string 
     */
    public function getDossier()
    {
        return $this->dossier;
    }
	
    /**
     * Set description
     *
     * @param string $description
     * @return Document
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
	
	public function getFile(){
		return $this->file;
	}
	
	public function setFile(UploadedFile $file){
		$this->file = $file;
	}
	
	public function upload($albums)
	{
		// Si jamais il n'y a pas de fichier (champ facultatif)
		if (null === $this->file) {
		  return;
		}
		// On garde le nom original du fichier de l'internaute
		$name = $this->file->getClientOriginalName();

		// On déplace le fichier envoyé dans le répertoire de notre choix
		$this->file->move($this->getUploadRootDir($albums), $name);
		
		$this->url = $name;
	}

	public function getUploadDir($albums)
	{
		// On retourne le chemin relatif vers l'image pour un navigateur
		//echo $albums[3];
		return $albums[$this->dossier];
	}

	protected function getUploadRootDir($albums)
	{
		// On retourne le chemin relatif vers l'image pour notre code PHP
		return __DIR__.'/../../../../web/bundles/evrythinggalerie/images/'.$this->getUploadDir($albums);
	}
}
