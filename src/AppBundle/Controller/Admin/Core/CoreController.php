<?php

namespace AppBundle\Controller\Admin\Core;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Core controller.
 *
 * @Route("/admin/core")
 */
class CoreController extends Controller
{
    /**
     * Devuelve una corta descripción del objeto
     *
     * @Route("/get-short-description.{_format}",
     *      name="admin_core_get_short_description",
     *      defaults={"_format"="html"},
     *      requirements={"_format" = "html|json"},
     *      options={"expose" = true},
     * )
     * @Method("GET")
     */
    public function getShortDescriptionAction(Request $request, $_format)
    {
    	// show route
        if (!$request->get('show_route'))
            throw $this->createNotFoundException();

    	// entity class
        if (!$request->get('class'))
            throw $this->createNotFoundException();

        // search entity
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($request->get('class'))->find($request->get('id'));

        if (!$entity && 'html' == $_format) {
            return new Response();
        }

        if ('json' == $_format) {
            return new JsonResponse(array(
                'status' => 'OK',
                'result' => array(
                    'id'       => $entity->getId(),
                    'toString' => $entity->__toString(),
                )
            ));
        }
        elseif ('html' == $_format) {
            return $this->render('admin/core/short_description.html.twig', array(
                'entity' => $entity,
                'show_route' => $request->get('show_route'),
            ));
        } else {
            throw new \RuntimeException('Invalid format');
        }
    }


}