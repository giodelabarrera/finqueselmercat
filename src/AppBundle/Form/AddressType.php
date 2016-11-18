<?php

namespace AppBundle\Form;

use AppBundle\Entity\Country;
use AppBundle\Entity\ModeShowAddress;
use AppBundle\Entity\Municipality;
use AppBundle\Entity\PostalCode;
use AppBundle\Form\EventListener\AddMunicipalityFieldSubscriber;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('country', EntityType::class, array(
                'class' => Country::class,
                'required' => true,
            ))
            ->add('postalCode', null, array(
                'placeholder' => 'Selecciona',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('pc')
                        ->join('AppBundle:Geolocation', 'g', 'WITH', 'pc.id = g.postalCode')
                        ->where('g.province = 8')
                        ->orderBy('pc.code', 'ASC');
                },
            ))
            ->add('municipality', null, array(
                'placeholder' => 'Selecciona',
                'choices' => array(),
            ))
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
            ->add('zone', null, array(
                'placeholder' => 'Selecciona',
                'choices' => array(),
            ))
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
