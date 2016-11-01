<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('type')
            ->add('subtype')
            ->add('isNewConstruction')
            ->add('isBankAwarded')
            ->add('bankAwarded')
            ->add('activationDate', 'date')
            ->add('status')


            ->add('address', AddressType::class)
            ->add('propertyData')
            ->add('propertyDescription')
            ->add('extras')

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
            'data_class' => 'AppBundle\Entity\Property'
        ));
    }
}
