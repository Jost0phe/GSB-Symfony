<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheFraisRepository")
 */
class FicheFrais
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visiteur;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $mois;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbJustificatifs;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $montantValide;

    /**
     * @ORM\Column(type="date")
     */
    private $dateModif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat;

    /**
     * @ORM\Column(type="float")
     */
    private $ETP;

    /**
     * @ORM\Column(type="float")
     */
    private $KM;

    /**
     * @ORM\Column(type="float")
     */
    private $NUI;

    /**
     * @ORM\Column(type="float")
     */
    private $REP;

    public function getId()
    {
        return $this->id;
    }

    public function getVisiteur()
    {
        return $this->visiteur;
    }

    public function setVisiteur(Visiteur $visiteur)
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    public function getMois()
    {
        return $this->mois;
    }

    public function setMois(string $mois)
    {
        $this->mois = $mois;

        return $this;
    }

    public function getNbJustificatifs()
    {
        return $this->nbJustificatifs;
    }

    public function setNbJustificatifs(int $nbJustificatifs): self
    {
        $this->nbJustificatifs = $nbJustificatifs;

        return $this;
    }

    public function getMontantValide()
    {
        return $this->montantValide;
    }

    public function setMontantValide(string $montantValide): self
    {
        $this->montantValide = $montantValide;

        return $this;
    }

    public function getDateModif()
    {
        return $this->dateModif;
    }

    public function setDateModif(\DateTimeInterface $dateModif)
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    public function getEtat()
    {
        return $this->etat;
    }

    public function setEtat(Etat $etat)
    {
        $this->etat = $etat;

        return $this;
    }
    
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getETP(): ?float
    {
        return $this->ETP;
    }

    public function setETP(float $ETP): self
    {
        $this->ETP = $ETP;

        return $this;
    }

    public function getKM(): ?float
    {
        return $this->KM;
    }

    public function setKM(float $KM): self
    {
        $this->KM = $KM;

        return $this;
    }

    public function getNUI(): ?float
    {
        return $this->NUI;
    }

    public function setNUI(float $NUI): self
    {
        $this->NUI = $NUI;

        return $this;
    }

    public function getREP(): ?float
    {
        return $this->REP;
    }

    public function setREP(float $REP): self
    {
        $this->REP = $REP;

        return $this;
    }
}
