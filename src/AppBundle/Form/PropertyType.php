<?php

namespace AppBundle\Form;

use AppBundle\Entity\Address;
use AppBundle\Entity\BankAwarded;
use AppBundle\Entity\Extra;
use AppBundle\Entity\ModeShowAddress;
use AppBundle\Entity\PostalCode;
use AppBundle\Entity\Subtype;
use AppBundle\Entity\Type;
use AppBundle\Form\EventListener\AddBankAwardedFieldSubscriber;
use AppBundle\Form\EventListener\AddStatusReservedTypeFieldSubscriber;
use AppBundle\Form\EventListener\AddSubtypeFieldSubscriber;
use AppBundle\Form\Type\CollectionModalEntityType;
use AppBundle\Form\Type\ModalEntityType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class PropertyType
 * @package AppBundle\Form
 */
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
            ->add('type', null, array(
                'placeholder' => 'Selecciona',
            ))
            ->add('subtype')
            ->add('isNewConstruction')
            ->add('isBankAwarded')
            ->add('bankAwarded')
            ->add('activationDate', 'date')
            ->add('status')
            ->add('address', AddressType::class)
            ->add('surface')
            ->add('hideSurface')
            ->add('sale')
            ->add('modalitySale', ModalitySaleType::class, array(
                'required' => false,
            ))
            ->add('rental')
            ->add('modalityRental', ModalityRentalType::class, array(
                'required' => false,
            ))
            ->add('currency')
            ->add('hidePrice')
            ->add('hotWater')
            ->add('constructionYear')
            ->add('heating')
            ->add('energyCertificate')
            ->add('conservation')
            ->add('numToilet')
            ->add('numBath')
            ->add('numRoom')
            ->add('orientation')
            ->add('observation')
            ->add('extras', null, array(
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.name', 'ASC');
                },
            ))
            ->add('shortDescription')
            ->add('fullDescription')
            ->add('energyCertificateFile', ModalEntityType::class, array(
                'class' => 'AppBundle:MediaFile',
                'route_prefix' => 'admin_media_file',
                'required' => false,
            ))
            ->add('images', CollectionModalEntityType::class, array(
                'entry_type' => ModalEntityType::class,
                'entry_options' => array(
                    'class' => 'AppBundle:MediaFile',
                    'route_prefix' => 'admin_media_file',
                    'hide_delete' => true,
                    'hide_label' => true,
                ),
                'required' => false,
            ))
            ;
        /*$builder
            //->add('createdAt', 'datetime')
            //->add('updatedAt', 'datetime')
        ;*/


        $subtypeModifier = function (FormInterface $form, Type $type = null) {
            $form->add('subtype', null, array(
                'placeholder' => 'Selecciona',
                'query_builder' => function (EntityRepository $er) use ($type) {
                    return $er->createQueryBuilder('s')
                        ->where('s.type = :type')
                        ->setParameter('type', $type);
                },
                'required' => false,
            ));
        };

        $bankAwardedModifier = function (FormInterface $form, $isBankAwarded = false) {
            if ($isBankAwarded === true) {
                $form->add('bankAwarded', null, array(
                    'placeholder' => 'Selecciona',
                    'required' => true,
                    'constraints' => new NotBlank(),
                ));
            } else {
                $form->add('bankAwarded', null, array(
                    'placeholder' => 'Selecciona',
                    'choices' => array(),
                ));
            }
        };

        $municipalityModifier = function (FormInterface $form, PostalCode $postalCode = null) {
            if (!$postalCode) {
                $form->add('municipality', null, array(
                    'placeholder' => 'Selecciona',
                    'choices' => array(),
                    'required' => true,
                    'constraints' => new NotBlank(),
                ));
            } else {
                $form->add('municipality', null, array(
                    'query_builder' => function (EntityRepository $er) use ($postalCode) {
                        return $er->createQueryBuilder('m')
                            ->join('AppBundle:Geolocation', 'g', 'WITH', 'm.id = g.municipality')
                            ->join('g.postalCode', 'pc')
                            ->where('pc.id = :postalCode')
                            ->setParameter('postalCode', $postalCode)
                            ->orderBy('m.name', 'ASC');
                    },
                    'required' => true,
                    'constraints' => new NotBlank(),
                ));
            }
        };

        $zoneModifier = function (FormInterface $form, ModeShowAddress $modeShowAddress = null) {
            if ($modeShowAddress) {
                if ($modeShowAddress->getSlug() == ModeShowAddress::ZONA) {
                    /*$form->add('zone', null, array(
                        'placeholder' => 'Selecciona',
                        'required' => true,
                        'constraints' => new NotBlank(),
                    ));*/
                    $form->add('zone', ModalEntityType::class, array(
                        'class' => 'AppBundle:Zone',
                        'route_prefix' => 'admin_zone',
                        'required' => true,
                        'constraints' => new NotBlank(),
                    ));
                }
            }
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use (
                $subtypeModifier,
                $bankAwardedModifier,
                $municipalityModifier,
                $zoneModifier
            ) {
                $data = $event->getData();
                $form = $event->getForm();

                // subtype
                $subtypeModifier($event->getForm(), $data->getType());
                // bankAwarded
                $bankAwardedModifier($event->getForm(), $data->getIsBankAwarded());

                // address
                $address = $data->getAddress();
                // address municipality
                $postalCode = ($address) ? $address->getPostalCode() : null;
                $municipalityModifier($event->getForm()->get('address'), $postalCode);
                // address zone
                $modeShowAddress = ($address) ? $address->getModeShowAddress() : null;
                $zoneModifier($event->getForm()->get('address'), $modeShowAddress);
            }
        );

        $builder->get('type')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($subtypeModifier) {
                $type = $event->getForm()->getData();
                $subtypeModifier($event->getForm()->getParent(), $type);
            }
        );

        $builder->get('isBankAwarded')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($bankAwardedModifier) {
                $isBankAwarded = $event->getForm()->getData();
                $bankAwardedModifier($event->getForm()->getParent(), $isBankAwarded);
            }
        );

        $builder->get('address')->get('postalCode')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($municipalityModifier) {
                $postalCode = $event->getForm()->getData();
                $municipalityModifier($event->getForm()->getParent(), $postalCode);
            }
        );

        $builder->get('address')->get('modeShowAddress')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($zoneModifier) {
                $modeShowAddress = $event->getForm()->getData();
                $zoneModifier($event->getForm()->getParent(), $modeShowAddress);
            }
        );
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Property',
            'cascade_validation' => true,
        ));
    }
}
