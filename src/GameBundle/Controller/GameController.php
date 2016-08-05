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
    public function resultRoundAction(Request $request, $idmonu)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $result = $request->request->get('result');
        $lng = $request->request->get('lng');
        $lat = $request->request->get('lat');

        $lieu = $em->getRepository('GameBundle:Lieux')->findOneById($idmonu);

        $reponse = "";

        if($result <= 50) {
            $reponse = "Félicitation vous êtes à ".$result."km du Monument";
            $gain = 10;
            $point = (1 / $result) * 100000;
            $user->setExp($user->getExp() + 10);
            if($user->getExp() >= $user->getRequireExp()){
                $calcul = $user->getExp() - $user->getRequireExp();
                $user->setNiveau($user->getNiveau() + 1);
                $user->setRequireExp($user->getNiveau() * 10);
                $user->setExp($calcul);
            }
        }
        elseif($result <= 100) {
            $reponse = "Vous êtes à ".$result."km du Monument, c'est un peu trop mais bien essayé";
            $gain = 5;
            $point = (1 / $result) * 100000;
            $user->setExp($user->getExp() + 5);
            if($user->getExp() >= $user->getRequireExp()){
                $calcul = $user->getExp() - $user->getRequireExp();
                $user->setNiveau($user->getNiveau() + 1);
                $user->setRequireExp($user->getNiveau() * 10);
                $user->setExp($calcul);
            }
        }
        else {
            $reponse = "Désolé vous êtes à plus de ".$result."km du Monument";
            $gain = 0;
            $point = 0;
            $user->setExp($user->getExp() + 0);
        }
        if($user->getBestScore() <= $point) {
            $user->setBestScore($point);
        }

        $em->persist($user);
        $em->flush();

        return $this->render('default/result.html.twig', array(
            'reponse' => $reponse,
            'lieu' => $lieu,
            'lng' => $lng,
            'lat' => $lat,
            'gain' => $gain,
            'user' => $user,
        ));
    }
}
