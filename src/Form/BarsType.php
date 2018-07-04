<?php

namespace App\Form;

use App\Entity\Bars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Alcools')
            ->add('Diffusions')
            ->add('Terasse')
            ->add('Adresse')
            ->add('Photos')
            ->add('Commentaires')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bars::class,
        ]);
    }
}
