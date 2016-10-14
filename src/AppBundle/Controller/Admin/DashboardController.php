<?php
/**
 * Created by PhpStorm.
 * User: giorgio
 * Date: 12/10/16
 * Time: 23:19
 */

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Dashboard controller.
 *
 * @Route("/admin")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     */
    public function indexAction(Request $request)
    {
        return $this->render('admin/dashboard/index.html.twig', array(
        ));
    }
}