<?php

namespace App\Form;

use App\Entity\COURS;
use App\Entity\ELEVE;
use App\Entity\FACTURE;
use App\Entity\INSCRIPTION;
use App\Form\EleveType; //formulaire de l'élève
use App\Entity\RESPONSABLELEGAL;
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
            ->add('prix')
            ->add('police_assurance')
            ->add('id_eleve', EleveType::class, [
                'label' => false,   //supprime le titre généré par défaut
            ])
            ->add('id_facture', EntityType::class, [
                'class' => FACTURE::class,
                'choice_label' => 'id',
            ])
            ->add('id_responsable_legal_1', EntityType::class, [
                'class' => RESPONSABLELEGAL::class,
                'choice_label' => 'id', // Idéalement, remplace 'id' par le nom du responsable si le champ existe (ex: 'nom')
                'multiple' => true,      // <-- AJOUT CRUCIAL : Indique que c'est une collection (ManyToMany)
                'expanded' => false,     // false = menu déroulant / true = cases à cocher
                'label' => 'Responsable légal 1',
            ])
            ->add('id_responsable_legal_2', EntityType::class, [
                'class' => RESPONSABLELEGAL::class,
                'choice_label' => 'id',
                'multiple' => true,      // <-- AJOUT CRUCIAL
                'expanded' => false,
                'label' => 'Responsable légal 2',
            ])

            ->add('id_cours', EntityType::class, [
                'class' => COURS::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => INSCRIPTION::class,
        ]);
    }
}
