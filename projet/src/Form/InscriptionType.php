<?php

namespace App\Form;

use App\Entity\DISCIPLINE;
use App\Entity\COURS;
use App\Form\CoursType;
use App\Entity\ELEVE;
use App\Entity\FACTURE;
use App\Entity\INSCRIPTION;
use App\Form\EleveType; //formulaire de l'élève
use App\Entity\RESPONSABLELEGAL;
use App\Form\ResponsableLegalType; //formulaire des parents
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('coeff_famillial')
            //->add('prix')
            ->add('police_assurance')
            ->add('id_eleve', EleveType::class, [
                'label' => false,   //supprime le titre généré par défaut
            ])
            /*->add('id_facture', EntityType::class, [
                'class' => FACTURE::class,
                'choice_label' => 'id',
            ])*/
            // Dans InscriptionType.php
            //  CORRECT : On imbrique simplement le formulaire sans lui passer d'options de type EntityType
            //->add('id_cours', CoursType::class)
            ->add('id_discipline', EntityType::class, [
                'class' => DISCIPLINE::class,
                'choice_label' => 'nom', // La propriété à afficher dans le menu (ex: nom, libelle)
                'label' => 'Sélectionnez votre discipline',
                'placeholder' => '--- Choisir parmi les 3 disciplines ---',
                'expanded' => false, // false = menu déroulant <select>
                'multiple' => false, // Choix unique
            ])

           ->add('id_responsable_legal_1', ResponsableLegalType::class, [
                'label' => 'Responsable légal 1',
            ])
            ->add('id_responsable_legal_2', ResponsableLegalType::class, [
                'label' => 'Responsable légal 2',
                'required' => false, // ce responsable est facultatif
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => INSCRIPTION::class,
        ]);
    }
}
