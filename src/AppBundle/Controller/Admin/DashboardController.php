<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 30/10/16
 * Time: 14:48
 */

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DashboardController
 * @package AppBundle\Controller\Admin
 *
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/", name="admin_dashboard")
     * @Method("GET")
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        return $this->redirectToRoute('admin_property_index');

        /*return $this->render('admin/dashboard/index.html.twig', array(
            //'bankAwardeds' => $bankAwardeds,
        ));*/
    }
}