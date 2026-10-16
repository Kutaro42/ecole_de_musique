<?php

namespace App\Form;

use App\Entity\RESPONSABLELEGAL;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponsableLegalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',null,['required' => false])
            ->add('prenom',null,['required' => false])
            ->add('tel_portable',null,['required' => false])
            ->add('tel_professionnel',null,['required' => false])
            ->add('email',null,['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RESPONSABLELEGAL::class,
        ]);
    }
}
