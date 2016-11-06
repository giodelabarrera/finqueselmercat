<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyDataType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surface')
            ->add('hideSurface')
            ->add('hidePrice')
            ->add('constructionYear')
            ->add('numToilet')
            ->add('numBath')
            ->add('numRoom')
            ->add('numOffices')
            ->add('buildingName')
            ->add('observation')
            ->add('modalitySale', ModalitySaleType::class)
            ->add('modalityRental', ModalityRentalType::class)
            ->add('currency')
            ->add('hotWater')
            ->add('heating')
            ->add('energyCertificate')
            ->add('conservation')
            ->add('orientation')
            ->add('parkingType')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PropertyData'
        ));
    }
}
