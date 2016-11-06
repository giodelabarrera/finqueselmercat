<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\StatusReserved;
use AppBundle\Form\StatusReservedType;

/**
 * StatusReserved controller.
 *
 * @Route("/admin/status-reserved")
 */
class StatusReservedController extends Controller
{
    /**
     * Lists all StatusReserved entities.
     *
     * @Route("/", name="admin_status_reserved_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $statusReserveds = $em->getRepository('AppBundle:StatusReserved')->findAll();

        return $this->render('admin/statusreserved/index.html.twig', array(
            'statusReserveds' => $statusReserveds,
        ));
    }

    /**
     * Creates a new StatusReserved entity.
     *
     * @Route("/new", name="admin_status_reserved_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $statusReserved = new StatusReserved();
        $form = $this->createForm('AppBundle\Form\StatusReservedType', $statusReserved);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statusReserved);
            $em->flush();

            return $this->redirectToRoute('admin_status_reserved_show', array('id' => $statusReserved->getId()));
        }

        return $this->render('admin/statusreserved/new.html.twig', array(
            'statusReserved' => $statusReserved,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a StatusReserved entity.
     *
     * @Route("/{id}", name="admin_status_reserved_show")
     * @Method("GET")
     */
    public function showAction(StatusReserved $statusReserved)
    {
        $deleteForm = $this->createDeleteForm($statusReserved);

        return $this->render('admin/statusreserved/show.html.twig', array(
            'statusReserved' => $statusReserved,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing StatusReserved entity.
     *
     * @Route("/{id}/edit", name="admin_status_reserved_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, StatusReserved $statusReserved)
    {
        $deleteForm = $this->createDeleteForm($statusReserved);
        $editForm = $this->createForm('AppBundle\Form\StatusReservedType', $statusReserved);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statusReserved);
            $em->flush();

            return $this->redirectToRoute('admin_status_reserved_edit', array('id' => $statusReserved->getId()));
        }

        return $this->render('admin/statusreserved/edit.html.twig', array(
            'statusReserved' => $statusReserved,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a StatusReserved entity.
     *
     * @Route("/{id}", name="admin_status_reserved_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, StatusReserved $statusReserved)
    {
        $form = $this->createDeleteForm($statusReserved);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statusReserved);
            $em->flush();
        }

        return $this->redirectToRoute('admin_status_reserved_index');
    }

    /**
     * Creates a form to delete a StatusReserved entity.
     *
     * @param StatusReserved $statusReserved The StatusReserved entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(StatusReserved $statusReserved)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_status_reserved_delete', array('id' => $statusReserved->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
