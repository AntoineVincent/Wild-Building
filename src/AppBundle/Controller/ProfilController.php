<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends Controller
{
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $user = $em->getRepository('AppBundle:User')->findOneById($user->getId());

        $exp = $user->getExp();
        $require = $user->getRequireExp();

        $percent = ($exp / $require) * 100;

        return $this->render('default/profil.html.twig', array(
            'user' => $user,
            'percent' => $percent,
        ));
    }

    public function modifAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $user = $em->getRepository('AppBundle:User')->findOneById($user->getId());

        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $prenom = $request->request->get('nom');
        $sexe = $request->request->get('sexe');
        $ville = $request->request->get('ville');
        $age = $request->request->get('age');

        $hidden = $request->request->get('hidden');

        $user = $em->getRepository('AppBundle:User')->findOneById($user->getId());

        if ($hidden == 1){
            if (!empty($prenom)) {
                $user->setNom($prenom);
            }
            if (!empty($sexe)) {
                $user->setSexe($sexe);
            }
            if (!empty($ville)) {
                $user->setVille($ville);
            }
            if (!empty($age)) {
                $user->setAge($age);
            }

            $request->getSession()
            ->getFlashBag()
            ->add('success', 'Profil Modifié avec succès !')
            ;

            $em->persist($user);
            $em->flush();
        }
        return $this->render('default/profilModif.html.twig', array(
            'user' => $user,
        ));  
    }
}
