<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZoneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            /*->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime')*/
            ->add('municipality', null, array(
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->join('AppBundle:Geolocation', 'g', 'WITH', 'm.id = g.municipality')
                        ->where('g.province = 8')
                        ->orderBy('m.name', 'ASC');
                },
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Zone'
        ));
    }
}
