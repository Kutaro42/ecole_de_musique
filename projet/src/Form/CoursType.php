<?php

namespace App\Form;

use App\Entity\COURS;
use App\Entity\DISCIPLINE;
use App\Entity\PROFESSEUR;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jour')
            ->add('horaire_debut')
            ->add('horaire_fin')
            // Le menu déroulant qui va chercher les disciplines en BDD
            ->add('discipline', EntityType::class, [
                'class' => DISCIPLINE::class,
                'choice_label' => 'nom', // Propriété de l'entité Discipline à afficher (ex: nom, intitule)
                'label' => 'Sélectionnez une discipline',
                'placeholder' => '--- Choisir parmi les 3 disciplines ---',
                'expanded' => false, // false = menu déroulant select, true = boutons radio
                'multiple' => false, // Choix unique
            ])
            ->add('id_prof', EntityType::class, [
                'class' => PROFESSEUR::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => COURS::class,
        ]);
    }
}
