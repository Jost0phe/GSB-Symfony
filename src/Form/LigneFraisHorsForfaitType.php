<?php

namespace App\Form;

use App\Entity\LigneFraisHorsForfait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class LigneFraisHorsForfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle',TextType::class, array('label'=>'Libelle:','attr'=>array('class'=>'form-control', 'placeholder'=>'Libelle')))
            ->add('date',DateType::class, array('label'=>'dateModif:','attr'=>array('class'=>'form-control', 'placeholder'=>'dateModif')))
            ->add('montant',NumberType::class, array('label'=>'montant:','attr'=>array('class'=>'form-control', 'placeholder'=>'montant')))
            //->add('visiteur',EntityType::class, array('label'=>'visiteur:','attr'=>array('class'=>'form-control', 'placeholder'=>'visiteur')))
            //->add('mois',DateType::class, array('disabled' => true,'data' => new \DateTime()))
            ->add('valider',SubmitType::class, array('label'=>'Valider','attr'=>array('class'=>'btn btn-primary btn-block')))   
            ->add('annuler',ResetType::class, array('label'=>'Quitter','attr'=>array('class'=>'btn btn-primary btn-block')))  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LigneFraisHorsForfait::class,
        ]);
    }
}
