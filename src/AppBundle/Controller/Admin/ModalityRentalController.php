<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ModalityRental;
use AppBundle\Form\ModalityRentalType;

/**
 * ModalityRental controller.
 *
 * @Route("/admin/modality-rental")
 */
class ModalityRentalController extends Controller
{
    /**
     * Lists all ModalityRental entities.
     *
     * @Route("/", name="admin_modality_rental_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $modalityRentals = $em->getRepository('AppBundle:ModalityRental')->findAll();

        return $this->render('admin/modalityrental/index.html.twig', array(
            'modalityRentals' => $modalityRentals,
        ));
    }

    /**
     * Creates a new ModalityRental entity.
     *
     * @Route("/new", name="admin_modality_rental_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $modalityRental = new ModalityRental();
        $form = $this->createForm('AppBundle\Form\ModalityRentalType', $modalityRental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modalityRental);
            $em->flush();

            return $this->redirectToRoute('admin_modality_rental_show', array('id' => $modalityRental->getId()));
        }

        return $this->render('admin/modalityrental/new.html.twig', array(
            'modalityRental' => $modalityRental,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ModalityRental entity.
     *
     * @Route("/{id}", name="admin_modality_rental_show")
     * @Method("GET")
     */
    public function showAction(ModalityRental $modalityRental)
    {
        $deleteForm = $this->createDeleteForm($modalityRental);

        return $this->render('admin/modalityrental/show.html.twig', array(
            'modalityRental' => $modalityRental,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ModalityRental entity.
     *
     * @Route("/{id}/edit", name="admin_modality_rental_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ModalityRental $modalityRental)
    {
        $deleteForm = $this->createDeleteForm($modalityRental);
        $editForm = $this->createForm('AppBundle\Form\ModalityRentalType', $modalityRental);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modalityRental);
            $em->flush();

            return $this->redirectToRoute('admin_modality_rental_edit', array('id' => $modalityRental->getId()));
        }

        return $this->render('admin/modalityrental/edit.html.twig', array(
            'modalityRental' => $modalityRental,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ModalityRental entity.
     *
     * @Route("/{id}", name="admin_modality_rental_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ModalityRental $modalityRental)
    {
        $form = $this->createDeleteForm($modalityRental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($modalityRental);
            $em->flush();
        }

        return $this->redirectToRoute('admin_modality_rental_index');
    }

    /**
     * Creates a form to delete a ModalityRental entity.
     *
     * @param ModalityRental $modalityRental The ModalityRental entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ModalityRental $modalityRental)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_modality_rental_delete', array('id' => $modalityRental->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
