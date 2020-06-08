<?php

namespace App\Form;

use App\Entity\FicheFrais;
use App\Entity\Visiteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class FicheFraisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('libelle')
            ->add('mois',DateType::class, array('disabled' => true,'data' => new \DateTime()))
            //->add('nbJustificatifs')
            //->add('montantValide')
            ->add('ETP', NumberType::class, array('label'=>'Forfaits Etape:','attr'=>array('class'=>'form-control', 'placeholder'=>'15€')))
            ->add('KM', NumberType::class, array('label'=>'Frais Kilometriques:','attr'=>array('class'=>'form-control', 'placeholder'=>'100€')))
            ->add('NUI', NumberType::class, array('label'=>'Nuitée Hotêl:','attr'=>array('class'=>'form-control', 'placeholder'=>'50€')))
            ->add('REP', NumberType::class, array('label'=>'Forfait Repas:','attr'=>array('class'=>'form-control', 'placeholder'=>'30€')))
            //->add('visiteur',EntityType::class,array('class' => Visiteur::class, 'disabled' => true))
            //->add('etat')
            ->add('valider',SubmitType::class, array('label'=>'Valider','attr'=>array('class'=>'btn btn-primary btn-block')))   
            ->add('annuler',ResetType::class, array('label'=>'Quitter','attr'=>array('class'=>'btn btn-primary btn-block')))     
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FicheFrais::class,
        ]);
    }
}
