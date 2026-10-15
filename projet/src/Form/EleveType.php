<?php

namespace App\Form;

use App\Entity\ELEVE;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\DISCIPLINE;


class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',null,[
                'required' => true,
            ])
            ->add('prenom',null,[
                'required' => true,
            ])
            ->add('date_naissance',null,[
                'required' => true,
            ])
            ->add('adresse_principale',null,[
                'required' => true,
            ])
            ->add('age',null,[
                'required' => true,
            ])
            /*->add('cycle_musical', EntityType::class, [
                'class' => DISCIPLINE::class,
                'choice_label' => 'nom',
                'required' => true,
                'placeholder' => 'Sélectionnez une discipline *',
            ])*/
            
            ->add('tel_domicile',null,[
                'required' => true,
            ])
            ->add('tel_portable',null,[
                'required' => true,
            ])
            ->add('tel_professionnel',null,[
                'required' => true,
            ])
            ->add('email',null,[
                'required' => true,
            ])
            ->add('eleve_majeur',null,[
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ELEVE::class,
        ]);
    }
}
