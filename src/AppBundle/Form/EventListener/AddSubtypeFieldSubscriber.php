<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 3/11/16
 * Time: 21:38
 */

namespace AppBundle\Form\EventListener;

use AppBundle\Entity\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

/**
 * Class AddSubtypeFieldSubscriber
 * @package AppBundle\Form\EventListener
 */
class AddSubtypeFieldSubscriber implements EventSubscriberInterface
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
        $data = $event->getData(); // entity
        $form = $event->getForm();

        $this->formModifier($event->getForm(), $data->getType());
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();  // array request
        $form = $event->getForm();

        if (!$data) return;

        $type = (isset($data['type'])) ? $data['type'] : null;  // int

        $this->formModifier($event->getForm(), $type);
    }

    /**
     * @param FormInterface $form
     * @param null $type
     */
    private function formModifier(FormInterface $form, $type = null)
    {
        $form->add('subtype', EntityType::class, array(
            'class'       => 'AppBundle:Subtype',
            'placeholder' => 'Selecciona',
            'query_builder' => function (EntityRepository $er) use ($type) {
                return $er->createQueryBuilder('s')
                    ->where('s.type = :type')
                    ->setParameter('type', $type);
            },
            'required' => false,
        ));
    }
}