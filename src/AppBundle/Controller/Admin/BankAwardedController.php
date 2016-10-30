<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\BankAwarded;
use AppBundle\Form\BankAwardedType;

/**
 * BankAwarded controller.
 *
 * @Route("/admin/bankawarded")
 */
class BankAwardedController extends Controller
{
    /**
     * Lists all BankAwarded entities.
     *
     * @Route("/", name="admin_bankawarded_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bankAwardeds = $em->getRepository('AppBundle:BankAwarded')->findAll();

        return $this->render('admin/bankawarded/index.html.twig', array(
            'bankAwardeds' => $bankAwardeds,
        ));
    }

    /**
     * Creates a new BankAwarded entity.
     *
     * @Route("/new", name="admin_bankawarded_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bankAwarded = new BankAwarded();
        $form = $this->createForm('AppBundle\Form\BankAwardedType', $bankAwarded);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankAwarded);
            $em->flush();

            return $this->redirectToRoute('admin_bankawarded_show', array('id' => $bankAwarded->getId()));
        }

        return $this->render('admin/bankawarded/new.html.twig', array(
            'bankAwarded' => $bankAwarded,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BankAwarded entity.
     *
     * @Route("/{id}", name="admin_bankawarded_show")
     * @Method("GET")
     */
    public function showAction(BankAwarded $bankAwarded)
    {
        $deleteForm = $this->createDeleteForm($bankAwarded);

        return $this->render('admin/bankawarded/show.html.twig', array(
            'bankAwarded' => $bankAwarded,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BankAwarded entity.
     *
     * @Route("/{id}/edit", name="admin_bankawarded_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BankAwarded $bankAwarded)
    {
        $deleteForm = $this->createDeleteForm($bankAwarded);
        $editForm = $this->createForm('AppBundle\Form\BankAwardedType', $bankAwarded);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bankAwarded);
            $em->flush();

            return $this->redirectToRoute('admin_bankawarded_edit', array('id' => $bankAwarded->getId()));
        }

        return $this->render('admin/bankawarded/edit.html.twig', array(
            'bankAwarded' => $bankAwarded,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BankAwarded entity.
     *
     * @Route("/{id}", name="admin_bankawarded_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BankAwarded $bankAwarded)
    {
        $form = $this->createDeleteForm($bankAwarded);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bankAwarded);
            $em->flush();
        }

        return $this->redirectToRoute('admin_bankawarded_index');
    }

    /**
     * Creates a form to delete a BankAwarded entity.
     *
     * @param BankAwarded $bankAwarded The BankAwarded entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BankAwarded $bankAwarded)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_bankawarded_delete', array('id' => $bankAwarded->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
