<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Form\DataTransformer\EntityToIdTransformer;

/**
 * Defines the custom form field type used to manipulate modal entity type
 * See http://symfony.com/doc/current/cookbook/form/create_custom_field_type.html
 *
 * @author Giorgio de la Barrera <giorgio@onetechteam.com>
 */
class ModalEntityType extends AbstractType
{

    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * ModalEntityType constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // @TODO: generar exception si no hay options['class']
        // in vendor/symfony/symfony/src/Symfony/Component/OptionsResolver/OptionsResolver.php 
        // throw new UndefinedOptionsException(sprintf(
        $transformer = new EntityToIdTransformer($this->manager, $options['class']);
        $builder->addModelTransformer($transformer);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['class'] = $options['class'];
        list($bundle, $entityName) = explode(':', $options['class']);
        $view->vars['entity_name'] = $entityName;
        $view->vars['list_route'] = $options['route_prefix'].'_index';
        $view->vars['new_route'] = $options['route_prefix'].'_new';
        $view->vars['show_route'] = $options['route_prefix'].'_show';
        $view->vars['get_params'] = $options['get_params'];
        $view->vars['hide_delete'] = $options['hide_delete'];
        $view->vars['hide_label'] = $options['hide_label'];
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            // 'widget' => 'single_text',
            'class' => '',
            'route_prefix' => '',
            'invalid_message' => 'The selected entity does not exist',
            'get_params' => array(),
            'hide_delete' => false,
            'hide_label' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextType::class;
    }

}
