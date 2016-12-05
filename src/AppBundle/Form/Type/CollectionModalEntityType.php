<?php

namespace AppBundle\Form\Type;

use AppBundle\Validator\Constraints\NotRepeatedEntities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CollectionModalEntityType
 * @package AdminBundle\Form\Type
 */
class CollectionModalEntityType extends AbstractType
{
    /**
     * @var array
     */
    private $jqueryCollectionOptions = array();

    /**
     * CollectionModalEntityType constructor.
     */
    public function __construct()
    {
        $this->jqueryCollectionOptions = array(
            'allow_up'       => false,
            'allow_down'     => false,
            'add_at_the_end' => true,
            'add' => '<a href="#" class="btn btn-default"><i class="fa fa-plus-circle"></i> Añadir nueva opción</a>',
            'remove' => '<div class="col-sm-2"><a href="#" class="btn btn-default"><i class="fa fa-minus-circle"></i> Eliminar opción</a></div>',
        );
    }

    /**
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, array(
            'jquery_collection_options' => array_merge($this->jqueryCollectionOptions, $options['jquery_collection_options']),
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            'prototype'    => true,
            'required'     => true,
            'constraints'  => array(
                new NotRepeatedEntities()
            ),
            'jquery_collection_options' => array(),
        ));
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return CollectionType::class;
    }
}