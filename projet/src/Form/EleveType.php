<?php

namespace App\Form;

use App\Entity\ELEVE;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance')
            ->add('adresse_principale')
            ->add('age')
            ->add('cycle_musical')
            ->add('tel_domicile')
            ->add('tel_portable')
            ->add('tel_professionnel')
            ->add('email')
            ->add('eleve_majeur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ELEVE::class,
        ]);
    }
}
