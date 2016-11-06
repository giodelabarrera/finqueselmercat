<?php

namespace AppBundle\Form;

use AppBundle\Entity\BankAwarded;
use AppBundle\Entity\Extra;
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
        $builder
            ->add('reference')
            ->add('type', EntityType::class, array(
                'class' => Type::class,
                'placeholder' => 'Selecciona',
            ))
            ;
        $builder->addEventSubscriber(new AddSubtypeFieldSubscriber());
        $builder
            ->add('isNewConstruction')
            ->add('isBankAwarded')
            ;
        $builder->addEventSubscriber(new AddBankAwardedFieldSubscriber());
        $builder
            ->add('activationDate', 'date')
            ->add('status')
            ;
        $builder->addEventSubscriber(new AddStatusReservedTypeFieldSubscriber());
        $builder
            //->add('statusReserved', StatusReservedType::class)
            ->add('statusNotAvailable', StatusNotAvailableType::class)
            ;

        /*$builder
            ->add('address', AddressType::class)
            ->add('propertyData', PropertyDataType::class)
            ->add('propertyDescription', PropertyDescriptionType::class)
            ->add('extras', EntityType::class, array(
                'class' => Extra::class,
                'multiple' => true,
                'expanded' => true,
            ))

            //->add('createdAt', 'datetime')
            //->add('updatedAt', 'datetime')
        ;*/



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
