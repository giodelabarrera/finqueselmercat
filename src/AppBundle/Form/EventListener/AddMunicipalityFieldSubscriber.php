<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 8/11/16
 * Time: 0:37
 */

namespace AppBundle\Form\EventListener;

use AppBundle\Entity\Municipality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddMunicipalityFieldSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'onPreSetData',
            FormEvents::PRE_SUBMIT  => 'onPreSubmit',
        );
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSetData(FormEvent $event)
    {
        $data = $event->getData();  // entity
        $form = $event->getForm();

        if (!$data || null === $data->getId()) {
            $form->add('municipality', EntityType::class, array(
                'class' => Municipality::class,
                'placeholder' => 'Selecciona',
                'choices' => array(),
            ));
        }

        /*if ($data->getIsBankAwarded() === true) {
            $form->add('bankAwarded', EntityType::class, array(
                'class' => BankAwarded::class,
                'placeholder' => '',
                'required' => true,
            ));
        } else {
            $form->add('bankAwarded', EntityType::class, array(
                'class' => BankAwarded::class,
                'placeholder' => '',
                'required' => false,
            ));
        }*/
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();  // array request
        $form = $event->getForm();

        dump($data);
        dump($form);
        die();

        /*if (isset($data['isBankAwarded'])) {
            if ((boolean)$data['isBankAwarded'] === true) {
                $form->add('bankAwarded', EntityType::class, array(
                    'class' => BankAwarded::class,
                    'placeholder' => '',
                    'required' => true,
                ));
            }
        } else {
            unset($data['bankAwarded']);
            $event->setData($data);
        }*/
    }
}