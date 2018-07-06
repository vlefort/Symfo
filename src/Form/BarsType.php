<?php

namespace App\Form;

use App\Entity\Bars;
use App\Entity\Commentary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Alcools', TextType::class, array('label' => 'Alcools servis (seperez les termes avec des virgules)','required' => true,))
            ->add('Diffusions', CheckboxType::class, array('label' => 'Diffusion des matchs','required' => false,))
            ->add('Terasse')
            ->add('Adresse')
            ->add('Photos')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bars::class,
        ]);
    }
}
