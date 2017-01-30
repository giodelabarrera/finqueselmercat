<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Property;
use AppBundle\Form\PropertyType;

/**
 * Property controller.
 *
 * @Route("/admin/property")
 */
class PropertyController extends Controller
{
    /**
     * Lists all Property entities.
     *
     * @Route("/", name="admin_property_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('AppBundle:Property')
            ->createQueryBuilder('p')
            ->select('p')
            ->join('p.type', 't')->addSelect('t')
            ->orderBy('p.id', 'DESC')
        ;

        $paginator  = $this->get('knp_paginator');
        $properties = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->get('page', 1),
            $this->container->getParameter('knp_paginator.limit_page')
        );

        return $this->render('admin/property/index.html.twig', array(
            'properties' => $properties,
        ));
    }

    /**
     * Creates a new Property entity.
     *
     * @Route("/new", name="admin_property_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $property = new Property();
        $form = $this->createForm('AppBundle\Form\PropertyType', $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush();

            return $this->redirectToRoute('admin_property_show', array('id' => $property->getId()));
        }
        if ($request->request->get('dynamic_form_event') && $request->isXmlHttpRequest())
            $form = $this->createForm('AppBundle\Form\PropertyType', $property);

        return $this->render('admin/property/new.html.twig', array(
            'property' => $property,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Property entity.
     *
     * @Route("/{id}", name="admin_property_show")
     * @Method("GET")
     */
    public function showAction(Property $property)
    {
        $deleteForm = $this->createDeleteForm($property);

        return $this->render('admin/property/show.html.twig', array(
            'property' => $property,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Property entity.
     *
     * @Route("/{id}/edit", name="admin_property_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Property $property)
    {
        $deleteForm = $this->createDeleteForm($property);
        $editForm = $this->createForm('AppBundle\Form\PropertyType', $property);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush();

            return $this->redirectToRoute('admin_property_edit', array('id' => $property->getId()));
        }
        if ($request->request->get('dynamic_form_event') && $request->isXmlHttpRequest())
            $editForm = $this->createForm('AppBundle\Form\PropertyType', $property);

        return $this->render('admin/property/edit.html.twig', array(
            'property' => $property,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Property entity.
     *
     * @Route("/{id}/delete", name="admin_property_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Property $property)
    {
        $deleteForm = $this->createDeleteForm($property);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($property);
            $em->flush();

            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin/property/delete.html.twig', array(
            'property' => $property,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a Property entity.
     *
     * @param Property $property The Property entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Property $property)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_property_delete', array('id' => $property->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
