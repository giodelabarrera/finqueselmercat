<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\MediaFile;
use AppBundle\Form\MediaFileType;

/**
 * MediaFile controller.
 *
 * @Route("/admin/media-file")
 */
class MediaFileController extends Controller
{
    /**
     * Lists all MediaFile entities.
     *
     * @Route("/", name="admin_media_file_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('AppBundle:MediaFile')
            ->createQueryBuilder('f')
            ->orderBy('f.id', 'DESC')
            ;

        $paginator  = $this->get('knp_paginator');
        $mediaFiles = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->get('page', 1),
            $this->container->getParameter('knp_paginator.limit_page')
        );

        return $this->render('admin/mediafile/index.html.twig', array(
            'mediaFiles' => $mediaFiles,
        ));
    }

    /**
     * Creates a new MediaFile entity.
     *
     * @Route("/new", name="admin_media_file_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mediaFile = new MediaFile();
        $form = $this->createForm('AppBundle\Form\MediaFileType', $mediaFile, array(
            'validation_groups' => array('Default', 'creation'),
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mediaFile->upload();   // upload file
            $em->persist($mediaFile);
            $em->flush();


            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(array(
                    'status'    => 'OK',
                    'objectId'  => $mediaFile->getId(),
                ));
            }
            $this->addFlash('success', $this->get('translator')->trans('admin.flash.success.entity.created'));

            return $this->redirectToRoute('admin_media_file_show', array('id' => $mediaFile->getId()));
        }

        return $this->render('admin/mediafile/new.html.twig', array(
            'mediaFile' => $mediaFile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MediaFile entity.
     *
     * @Route("/{id}", name="admin_media_file_show")
     * @Method("GET")
     */
    public function showAction(MediaFile $mediaFile)
    {
        $deleteForm = $this->createDeleteForm($mediaFile);

        return $this->render('admin/mediafile/show.html.twig', array(
            'mediaFile' => $mediaFile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MediaFile entity.
     *
     * @Route("/{id}/edit", name="admin_media_file_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MediaFile $mediaFile)
    {
        $deleteForm = $this->createDeleteForm($mediaFile);
        $editForm = $this->createForm('AppBundle\Form\MediaFileType', $mediaFile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mediaFile->upload();   // upload file
            $em->persist($mediaFile);
            $em->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(array(
                    'status'    => 'OK',
                    'objectId'  => $mediaFile->getId(),
                ));
            }

            $this->addFlash('success', $this->get('translator')->trans('admin.flash.success.entity.updated'));

            return $this->redirectToRoute('admin_media_file_edit', array('id' => $mediaFile->getId()));
        }

        return $this->render('admin/mediafile/edit.html.twig', array(
            'mediaFile' => $mediaFile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MediaFile entity.
     *
     * @Route("/{id}/delete", name="admin_media_file_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, MediaFile $mediaFile)
    {
        $deleteForm = $this->createDeleteForm($mediaFile);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mediaFile);
            $em->flush();

            return $this->redirectToRoute('admin_media_file_index');
        }

        return $this->render('admin/mediafile/delete.html.twig', array(
            'mediaFile' => $mediaFile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a MediaFile entity.
     *
     * @param MediaFile $mediaFile The MediaFile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MediaFile $mediaFile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_media_file_delete', array('id' => $mediaFile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
