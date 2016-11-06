<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ModalitySale;
use AppBundle\Form\ModalitySaleType;

/**
 * ModalitySale controller.
 *
 * @Route("/admin/modality-sale")
 */
class ModalitySaleController extends Controller
{
    /**
     * Lists all ModalitySale entities.
     *
     * @Route("/", name="admin_modality_sale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $modalitySales = $em->getRepository('AppBundle:ModalitySale')->findAll();

        return $this->render('admin/modalitysale/index.html.twig', array(
            'modalitySales' => $modalitySales,
        ));
    }

    /**
     * Creates a new ModalitySale entity.
     *
     * @Route("/new", name="admin_modality_sale_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $modalitySale = new ModalitySale();
        $form = $this->createForm('AppBundle\Form\ModalitySaleType', $modalitySale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modalitySale);
            $em->flush();

            return $this->redirectToRoute('admin_modality_sale_show', array('id' => $modalitySale->getId()));
        }

        return $this->render('admin/modalitysale/new.html.twig', array(
            'modalitySale' => $modalitySale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ModalitySale entity.
     *
     * @Route("/{id}", name="admin_modality_sale_show")
     * @Method("GET")
     */
    public function showAction(ModalitySale $modalitySale)
    {
        $deleteForm = $this->createDeleteForm($modalitySale);

        return $this->render('admin/modalitysale/show.html.twig', array(
            'modalitySale' => $modalitySale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ModalitySale entity.
     *
     * @Route("/{id}/edit", name="admin_modality_sale_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ModalitySale $modalitySale)
    {
        $deleteForm = $this->createDeleteForm($modalitySale);
        $editForm = $this->createForm('AppBundle\Form\ModalitySaleType', $modalitySale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modalitySale);
            $em->flush();

            return $this->redirectToRoute('admin_modality_sale_edit', array('id' => $modalitySale->getId()));
        }

        return $this->render('admin/modalitysale/edit.html.twig', array(
            'modalitySale' => $modalitySale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ModalitySale entity.
     *
     * @Route("/{id}", name="admin_modality_sale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ModalitySale $modalitySale)
    {
        $form = $this->createDeleteForm($modalitySale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($modalitySale);
            $em->flush();
        }

        return $this->redirectToRoute('admin_modality_sale_index');
    }

    /**
     * Creates a form to delete a ModalitySale entity.
     *
     * @param ModalitySale $modalitySale The ModalitySale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ModalitySale $modalitySale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_modality_sale_delete', array('id' => $modalitySale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
