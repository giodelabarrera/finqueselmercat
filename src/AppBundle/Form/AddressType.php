<?php

namespace AppBundle\Form;

use AppBundle\Entity\ModeShowAddress;
use AppBundle\Form\EventListener\AddMunicipalityFieldSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
            ->add('postalCode', TextType::class)
            //->add('municipality')
            ;
        $builder->addEventSubscriber(new AddMunicipalityFieldSubscriber());
        $builder
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
            //->add('createdAt', 'datetime')
            //->add('updatedAt', 'datetime')
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
