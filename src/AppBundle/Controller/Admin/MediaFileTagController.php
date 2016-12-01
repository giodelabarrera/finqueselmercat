<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\MediaFileTag;
use AppBundle\Form\MediaFileTagType;

/**
 * MediaFileTag controller.
 *
 * @Route("/admin/media-file-tag")
 */
class MediaFileTagController extends Controller
{
    /**
     * Lists all MediaFileTag entities.
     *
     * @Route("/", name="admin_media_file_tag_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mediaFileTags = $em->getRepository('AppBundle:MediaFileTag')->findAll();

        return $this->render('admin/mediafiletag/index.html.twig', array(
            'mediaFileTags' => $mediaFileTags,
        ));
    }

    /**
     * Creates a new MediaFileTag entity.
     *
     * @Route("/new", name="admin_media_file_tag_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mediaFileTag = new MediaFileTag();
        $form = $this->createForm('AppBundle\Form\MediaFileTagType', $mediaFileTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mediaFileTag);
            $em->flush();

            return $this->redirectToRoute('admin_media_file_tag_show', array('id' => $mediaFileTag->getId()));
        }

        return $this->render('admin/mediafiletag/new.html.twig', array(
            'mediaFileTag' => $mediaFileTag,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MediaFileTag entity.
     *
     * @Route("/{id}", name="admin_media_file_tag_show")
     * @Method("GET")
     */
    public function showAction(MediaFileTag $mediaFileTag)
    {
        $deleteForm = $this->createDeleteForm($mediaFileTag);

        return $this->render('admin/mediafiletag/show.html.twig', array(
            'mediaFileTag' => $mediaFileTag,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MediaFileTag entity.
     *
     * @Route("/{id}/edit", name="admin_media_file_tag_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MediaFileTag $mediaFileTag)
    {
        $deleteForm = $this->createDeleteForm($mediaFileTag);
        $editForm = $this->createForm('AppBundle\Form\MediaFileTagType', $mediaFileTag);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mediaFileTag);
            $em->flush();

            return $this->redirectToRoute('admin_media_file_tag_edit', array('id' => $mediaFileTag->getId()));
        }

        return $this->render('admin/mediafiletag/edit.html.twig', array(
            'mediaFileTag' => $mediaFileTag,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MediaFileTag entity.
     *
     * @Route("/{id}", name="admin_media_file_tag_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MediaFileTag $mediaFileTag)
    {
        $form = $this->createDeleteForm($mediaFileTag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mediaFileTag);
            $em->flush();
        }

        return $this->redirectToRoute('admin_media_file_tag_index');
    }

    /**
     * Creates a form to delete a MediaFileTag entity.
     *
     * @param MediaFileTag $mediaFileTag The MediaFileTag entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MediaFileTag $mediaFileTag)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_media_file_tag_delete', array('id' => $mediaFileTag->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
