<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Address;
use AppBundle\Form\AddressType;

/**
 * Address controller.
 *
 * @Route("/admin/address")
 */
class AddressController extends Controller
{
    /**
     * Lists all Address entities.
     *
     * @Route("/", name="admin_address_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $addresses = $em->getRepository('AppBundle:Address')->findAll();

        return $this->render('admin/address/index.html.twig', array(
            'addresses' => $addresses,
        ));
    }

    /**
     * Creates a new Address entity.
     *
     * @Route("/new", name="admin_address_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $address = new Address();
        $form = $this->createForm('AppBundle\Form\AddressType', $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('admin_address_show', array('id' => $address->getId()));
        }

        return $this->render('admin/address/new.html.twig', array(
            'address' => $address,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Address entity.
     *
     * @Route("/{id}", name="admin_address_show")
     * @Method("GET")
     */
    public function showAction(Address $address)
    {
        $deleteForm = $this->createDeleteForm($address);

        return $this->render('admin/address/show.html.twig', array(
            'address' => $address,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Address entity.
     *
     * @Route("/{id}/edit", name="admin_address_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Address $address)
    {
        $deleteForm = $this->createDeleteForm($address);
        $editForm = $this->createForm('AppBundle\Form\AddressType', $address);
        /*dump($request);dump($address);die();
        $editForm->handleRequest($request);*/

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('admin_address_edit', array('id' => $address->getId()));
        }

        return $this->render('admin/address/edit.html.twig', array(
            'address' => $address,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Address entity.
     *
     * @Route("/{id}", name="admin_address_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Address $address)
    {
        $form = $this->createDeleteForm($address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($address);
            $em->flush();
        }

        return $this->redirectToRoute('admin_address_index');
    }

    /**
     * Creates a form to delete a Address entity.
     *
     * @param Address $address The Address entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Address $address)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_address_delete', array('id' => $address->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
