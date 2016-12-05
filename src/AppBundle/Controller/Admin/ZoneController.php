<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Zone;
use AppBundle\Form\ZoneType;

/**
 * Zone controller.
 *
 * @Route("/admin/zone")
 */
class ZoneController extends Controller
{
    /**
     * Lists all Zone entities.
     *
     * @Route("/", name="admin_zone_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $queryBuilder = $em->getRepository('AppBundle:Zone')
            ->createQueryBuilder('z')
            ->orderBy('z.id', 'DESC')
        ;

        $paginator  = $this->get('knp_paginator');
        $zones = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->get('page', 1),
            $this->container->getParameter('knp_paginator.limit_page')
        );

        return $this->render('admin/zone/index.html.twig', array(
            'zones' => $zones,
        ));
    }

    /**
     * Creates a new Zone entity.
     *
     * @Route("/new", name="admin_zone_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $zone = new Zone();
        $form = $this->createForm('AppBundle\Form\ZoneType', $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zone);
            $em->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(array(
                    'status'    => 'OK',
                    'objectId'  => $zone->getId(),
                ));
            }

            $this->addFlash('success', $this->get('translator')->trans('admin.flash.success.entity.created'));

            return $this->redirectToRoute('admin_zone_show', array('id' => $zone->getId()));
        }

        return $this->render('admin/zone/new.html.twig', array(
            'zone' => $zone,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Zone entity.
     *
     * @Route("/{id}", name="admin_zone_show")
     * @Method("GET")
     */
    public function showAction(Zone $zone)
    {
        $deleteForm = $this->createDeleteForm($zone);

        return $this->render('admin/zone/show.html.twig', array(
            'zone' => $zone,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Zone entity.
     *
     * @Route("/{id}/edit", name="admin_zone_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Zone $zone)
    {
        $deleteForm = $this->createDeleteForm($zone);
        $editForm = $this->createForm('AppBundle\Form\ZoneType', $zone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zone);
            $em->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(array(
                    'status'    => 'OK',
                    'objectId'  => $zone->getId(),
                ));
            }

            $this->addFlash('success', $this->get('translator')->trans('admin.flash.success.entity.updated'));

            return $this->redirectToRoute('admin_zone_edit', array('id' => $zone->getId()));
        }

        return $this->render('admin/zone/edit.html.twig', array(
            'zone' => $zone,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Zone entity.
     *
     * @Route("/{id}/delete", name="admin_zone_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction(Request $request, Zone $zone)
    {
        $deleteForm = $this->createDeleteForm($zone);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($zone);
            $em->flush();

            return $this->redirectToRoute('admin_zone_index');
        }

        return $this->render('admin/zone/delete.html.twig', array(
            'zone' => $zone,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a Zone entity.
     *
     * @param Zone $zone The Zone entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Zone $zone)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_zone_delete', array('id' => $zone->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
