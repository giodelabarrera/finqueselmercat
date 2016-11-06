<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\PropertyDescription;
use AppBundle\Form\PropertyDescriptionType;

/**
 * PropertyDescription controller.
 *
 * @Route("/admin/property-description")
 */
class PropertyDescriptionController extends Controller
{
    /**
     * Lists all PropertyDescription entities.
     *
     * @Route("/", name="admin_property_description_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $propertyDescriptions = $em->getRepository('AppBundle:PropertyDescription')->findAll();

        return $this->render('admin/propertydescription/index.html.twig', array(
            'propertyDescriptions' => $propertyDescriptions,
        ));
    }

    /**
     * Creates a new PropertyDescription entity.
     *
     * @Route("/new", name="admin_property_description_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $propertyDescription = new PropertyDescription();
        $form = $this->createForm('AppBundle\Form\PropertyDescriptionType', $propertyDescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($propertyDescription);
            $em->flush();

            return $this->redirectToRoute('admin_property_description_show', array('id' => $propertyDescription->getId()));
        }

        return $this->render('admin/propertydescription/new.html.twig', array(
            'propertyDescription' => $propertyDescription,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PropertyDescription entity.
     *
     * @Route("/{id}", name="admin_property_description_show")
     * @Method("GET")
     */
    public function showAction(PropertyDescription $propertyDescription)
    {
        $deleteForm = $this->createDeleteForm($propertyDescription);

        return $this->render('admin/propertydescription/show.html.twig', array(
            'propertyDescription' => $propertyDescription,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PropertyDescription entity.
     *
     * @Route("/{id}/edit", name="admin_property_description_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PropertyDescription $propertyDescription)
    {
        $deleteForm = $this->createDeleteForm($propertyDescription);
        $editForm = $this->createForm('AppBundle\Form\PropertyDescriptionType', $propertyDescription);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($propertyDescription);
            $em->flush();

            return $this->redirectToRoute('admin_property_description_edit', array('id' => $propertyDescription->getId()));
        }

        return $this->render('admin/propertydescription/edit.html.twig', array(
            'propertyDescription' => $propertyDescription,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PropertyDescription entity.
     *
     * @Route("/{id}", name="admin_property_description_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PropertyDescription $propertyDescription)
    {
        $form = $this->createDeleteForm($propertyDescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($propertyDescription);
            $em->flush();
        }

        return $this->redirectToRoute('admin_property_description_index');
    }

    /**
     * Creates a form to delete a PropertyDescription entity.
     *
     * @param PropertyDescription $propertyDescription The PropertyDescription entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PropertyDescription $propertyDescription)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_property_description_delete', array('id' => $propertyDescription->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
