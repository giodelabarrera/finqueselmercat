<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\PropertyData;
use AppBundle\Form\PropertyDataType;

/**
 * PropertyData controller.
 *
 * @Route("/admin/property-data")
 */
class PropertyDataController extends Controller
{
    /**
     * Lists all PropertyData entities.
     *
     * @Route("/", name="admin_property_data_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $propertyDatas = $em->getRepository('AppBundle:PropertyData')->findAll();

        return $this->render('admin/propertydata/index.html.twig', array(
            'propertyDatas' => $propertyDatas,
        ));
    }

    /**
     * Creates a new PropertyData entity.
     *
     * @Route("/new", name="admin_property_data_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $propertyDatum = new PropertyData();
        $form = $this->createForm('AppBundle\Form\PropertyDataType', $propertyDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($propertyDatum);
            $em->flush();

            return $this->redirectToRoute('admin_property_data_show', array('id' => $propertyDatum->getId()));
        }

        return $this->render('admin/propertydata/new.html.twig', array(
            'propertyDatum' => $propertyDatum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PropertyData entity.
     *
     * @Route("/{id}", name="admin_property_data_show")
     * @Method("GET")
     */
    public function showAction(PropertyData $propertyDatum)
    {
        $deleteForm = $this->createDeleteForm($propertyDatum);

        return $this->render('admin/propertydata/show.html.twig', array(
            'propertyDatum' => $propertyDatum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PropertyData entity.
     *
     * @Route("/{id}/edit", name="admin_property_data_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PropertyData $propertyDatum)
    {
        $deleteForm = $this->createDeleteForm($propertyDatum);
        $editForm = $this->createForm('AppBundle\Form\PropertyDataType', $propertyDatum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($propertyDatum);
            $em->flush();

            return $this->redirectToRoute('admin_property_data_edit', array('id' => $propertyDatum->getId()));
        }

        return $this->render('admin/propertydata/edit.html.twig', array(
            'propertyDatum' => $propertyDatum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PropertyData entity.
     *
     * @Route("/{id}", name="admin_property_data_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PropertyData $propertyDatum)
    {
        $form = $this->createDeleteForm($propertyDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($propertyDatum);
            $em->flush();
        }

        return $this->redirectToRoute('admin_property_data_index');
    }

    /**
     * Creates a form to delete a PropertyData entity.
     *
     * @param PropertyData $propertyDatum The PropertyData entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PropertyData $propertyDatum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_property_data_delete', array('id' => $propertyDatum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
