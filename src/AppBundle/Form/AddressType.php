<?php

namespace AppBundle\Form;

use AppBundle\Entity\ModeShowAddress;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country')
            ->add('postalCode')
            ->add('municipality')
            ->add('streetType')
            ->add('street')
            ->add('number')
            ->add('floor')
            ->add('stair')
            ->add('door')
            ->add('modeShowAddress', EntityType::class, array(
                'class' => ModeShowAddress::class,
                'expanded' => true,
            ))
            ->add('zone')
            ->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Address'
        ));
    }
}
