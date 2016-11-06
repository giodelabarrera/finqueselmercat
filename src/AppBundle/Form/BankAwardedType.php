<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BankAwardedType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('numOrder')
            ->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime')
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $form = $event->getForm();
                //dump(FormEvents::PRE_SET_DATA);
                //dump($data);
                //dump($form);
                //die();
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $form = $event->getForm();
                /*dump(FormEvents::POST_SET_DATA);
                dump($data);
                dump($form);
                die();*/
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $form = $event->getForm();
                /*dump(FormEvents::PRE_SUBMIT);
                dump($data);
                dump($form);
                die();*/
            }
        );

        $builder->addEventListener(
            FormEvents::SUBMIT,
            function (FormEvent $event) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $form = $event->getForm();
                /*dump(FormEvents::SUBMIT);
                dump($data);
                dump($form);
                die();*/
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $form = $event->getForm();
                /*dump(FormEvents::POST_SUBMIT);
                dump($data);
                dump($form);
                die();*/
            }
        );



    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BankAwarded'
        ));
    }
}
