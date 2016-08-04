<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
         $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $user = $em->getRepository('AppBundle:User')->findOneById($user->getId());

        $allUser = $em->getRepository('AppBundle:User')->findAll();
        $tabScore = [];

        foreach ($allUser as $oneUser) {

            $tabScore[] = array(
                'bestScore' => $oneUser->getBestScore(),
                'username' => $oneUser->getUsername(),
            );
        }
        
        return $this->render('default/index.html.twig', array(
            'user' => $user,
            'tabScore' => $tabScore,
        ));
    }
}
