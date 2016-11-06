<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\StatusNotAvailable;
use AppBundle\Form\StatusNotAvailableType;

/**
 * StatusNotAvailable controller.
 *
 * @Route("/admin/status-not-available")
 */
class StatusNotAvailableController extends Controller
{
    /**
     * Lists all StatusNotAvailable entities.
     *
     * @Route("/", name="admin_status_not_available_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $statusNotAvailables = $em->getRepository('AppBundle:StatusNotAvailable')->findAll();

        return $this->render('admin/statusnotavailable/index.html.twig', array(
            'statusNotAvailables' => $statusNotAvailables,
        ));
    }

    /**
     * Creates a new StatusNotAvailable entity.
     *
     * @Route("/new", name="admin_status_not_available_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $statusNotAvailable = new StatusNotAvailable();
        $form = $this->createForm('AppBundle\Form\StatusNotAvailableType', $statusNotAvailable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statusNotAvailable);
            $em->flush();

            return $this->redirectToRoute('admin_status_not_available_show', array('id' => $statusNotAvailable->getId()));
        }

        return $this->render('admin/statusnotavailable/new.html.twig', array(
            'statusNotAvailable' => $statusNotAvailable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a StatusNotAvailable entity.
     *
     * @Route("/{id}", name="admin_status_not_available_show")
     * @Method("GET")
     */
    public function showAction(StatusNotAvailable $statusNotAvailable)
    {
        $deleteForm = $this->createDeleteForm($statusNotAvailable);

        return $this->render('admin/statusnotavailable/show.html.twig', array(
            'statusNotAvailable' => $statusNotAvailable,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing StatusNotAvailable entity.
     *
     * @Route("/{id}/edit", name="admin_status_not_available_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, StatusNotAvailable $statusNotAvailable)
    {
        $deleteForm = $this->createDeleteForm($statusNotAvailable);
        $editForm = $this->createForm('AppBundle\Form\StatusNotAvailableType', $statusNotAvailable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statusNotAvailable);
            $em->flush();

            return $this->redirectToRoute('admin_status_not_available_edit', array('id' => $statusNotAvailable->getId()));
        }

        return $this->render('admin/statusnotavailable/edit.html.twig', array(
            'statusNotAvailable' => $statusNotAvailable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a StatusNotAvailable entity.
     *
     * @Route("/{id}", name="admin_status_not_available_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, StatusNotAvailable $statusNotAvailable)
    {
        $form = $this->createDeleteForm($statusNotAvailable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statusNotAvailable);
            $em->flush();
        }

        return $this->redirectToRoute('admin_status_not_available_index');
    }

    /**
     * Creates a form to delete a StatusNotAvailable entity.
     *
     * @param StatusNotAvailable $statusNotAvailable The StatusNotAvailable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(StatusNotAvailable $statusNotAvailable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_status_not_available_delete', array('id' => $statusNotAvailable->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
