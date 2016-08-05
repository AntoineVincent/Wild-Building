<?php

namespace GameBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GameBundle\Entity\Lieux;
use GameBundle\Form\LieuType;

class DefaultController extends Controller
{
    public function newLieuxAction(Request $request)
    {	
    	$em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $lieux = new Lieux();
        $form = $this->createForm('GameBundle\Form\LieuType', $lieux);
        $form->handleRequest($request);

        

        if ($form->isValid()) {

            $photo = $lieux->getFile();

            $photoName = md5(uniqid()).'.'.$photo->guessExtension();
            $photoDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/lieux';
            $photo->move($photoDir, $photoName);

            $lieux->setFile($photoName);

            $em->persist($lieux);
            $em->flush();
        }

        return $this->render('default/newlieux.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
