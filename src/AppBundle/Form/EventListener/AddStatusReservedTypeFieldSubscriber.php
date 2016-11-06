<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 6/11/16
 * Time: 13:54
 */

namespace AppBundle\Form\EventListener;


use AppBundle\Form\StatusReservedType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddStatusReservedTypeFieldSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            //FormEvents::PRE_SUBMIT  => 'onPreSubmit',
        );
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSetData(FormEvent $event)
    {
        $data = $event->getData();  // entity
        $form = $event->getForm();

        $form->add('statusReserved', StatusReservedType::class, array(
            'required' => false,
        ));

        /*dump($data->getStatus());
        die();


        $form->add('statusReserved', StatusReservedType::class, array(
            'required' => false,
        ));
        if ($data->getStatus()) {

        }

        if ($data->getStatus() === true) {

        }*/


    }

    /**
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event)
    {

    }
}