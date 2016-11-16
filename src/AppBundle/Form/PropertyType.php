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
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PropertyType
 * @package AppBundle\Form
 */
class PropertyType extends AbstractType
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * PropertyType constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->addEventSubscriber(new AddSubtypeFieldSubscriber());
        //$builder->addEventSubscriber(new AddBankAwardedFieldSubscriber());
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
            ->add('modalities', null, array(
                'multiple' => true,
                'expanded' => true,
                'required' => true,
            ))
            ->add('modalitySale', ModalitySaleType::class)
            ->add('modalityRental', ModalityRentalType::class)
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
                    ));
            } else {
                $form->add('bankAwarded', null, array(
                    'placeholder' => 'Selecciona',
                ));
            }
        };

        /*$postalCodeModifier = function (FormInterface $form, PostalCode $postalCode = null) {
            $form->add('postalCode', TextType::class, array(
                'required' => true,
            ));
            if ($postalCode) {
                if ($postalCode->getSlug() == ModeShowAddress::ZONA) {
                    $form->add('zone', null, array(
                        'placeholder' => 'Selecciona',
                        'required' => true,
                    ));
                }
            }
        };*/

        $municipalityModifier = function (FormInterface $form, $postalCodeCode = '') {

            $form->add('municipality', null, array(
                //'placeholder' => 'Selecciona',
                'query_builder' => function (EntityRepository $er) use ($postalCodeCode) {
                    return $er->createQueryBuilder('m')
                        ->join('AppBundle:Geolocation', 'g', 'WITH', 'm.id = g.municipality')
                        ->join('g.postalCode', 'pc')
                        ->where('pc.code = :postalCodeCode')
                        ->setParameter('postalCodeCode', $postalCodeCode)
                        ->orderBy('m.name', 'ASC');
                },
                'required' => true,
            ));

        };

        $modeShowAddressModifier = function (FormInterface $form, ModeShowAddress $modeShowAddress = null) {
            if ($modeShowAddress) {
                if ($modeShowAddress->getSlug() == ModeShowAddress::ZONA) {
                    $form->add('zone', null, array(
                        'placeholder' => 'Selecciona',
                        'required' => true,
                    ));
                }
            }
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($subtypeModifier, $bankAwardedModifier, $municipalityModifier, $modeShowAddressModifier) {
                $data = $event->getData();
                $form = $event->getForm();
                $subtypeModifier($event->getForm(), $data->getType());
                $bankAwardedModifier($event->getForm(), $data->getIsBankAwarded());

                $address = $data->getAddress();
                // municipality
                $postalCodeCode = ($address) ? $address->getPostalCode()->getCode() : '';
                $municipalityModifier($event->getForm()->get('address'), $postalCodeCode);

                //$postalCode = ($address) ? $address->getPostalCode() : null;
                //$postalCodeModifier($event->getForm()->get('address'), $postalCode);
                $modeShowAddress = ($address) ? $address->getModeShowAddress() : null;
                $modeShowAddressModifier($event->getForm()->get('address'), $modeShowAddress);
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
                $postalCodeCode = $event->getForm()->getData();
                $municipalityModifier($event->getForm()->getParent(), $postalCodeCode);
            }
        );

        $builder->get('address')->get('modeShowAddress')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($modeShowAddressModifier) {
                $modeShowAddress = $event->getForm()->getData();
                $modeShowAddressModifier($event->getForm()->getParent(), $modeShowAddress);
            }
        );

        /*
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $data = $event->getForm()->getData();
            dump($data);
            //die();
            //$bankAwardedModifier($event->getForm()->getParent(), $isBankAwarded);
        });
        */

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
