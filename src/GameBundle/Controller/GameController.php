<?php

namespace GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    public function playAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $count = count($em->getRepository('GameBundle:Lieux')->findAll());

        $random = rand(1, $count);
        $lieu = $em->getRepository('GameBundle:Lieux')->findOneById($random);

        return $this->render('default/play.html.twig', array(
            'lieu' => $lieu,
        ));
    }
    public function resultRoundAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $result = $request->request->get('result');

        $reponse = "";

        if($result <= 100) {
            $reponse = "Félicitation vous êtes à ".$result."km du Monument";
        }
        else {
            $reponse = "Désolé vous êtes à plus de ".$result."km du Monument";
        }

        return $this->render('default/result.html.twig', array(
            'reponse' => $reponse,
        ));
    }
}
