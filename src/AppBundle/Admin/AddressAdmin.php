<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 14/10/16
 * Time: 18:00
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AddressAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('number', 'text')
            ->add('cp', 'text')
            ->add('street', 'text')
            ->add('floor_id', 'text')
            ->add('stair', 'text')
            ->add('door', 'text')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('street');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('street');
    }


}