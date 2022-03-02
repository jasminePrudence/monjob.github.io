<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_index")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/tost", name="main_tost")
     */
    public function tost(): Response
    {
        return $this->render('offre/welcome.html.twig');
    }

    /**
     * @Route("/site", name="main_site")
     */
    public function site(Request $request)
    {
        return $this->render('main/site.html.twig');
    }


    /**
     * @Route("/user/{id}", name="main_read")
     */
    public function read($id) {
        $user = $this->getDoctrine()->getRepository(User::class);
        $user = $user->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'Aucun user pour l\'id: ' . $id
            );
        }
        return $this->render(
            '',
            array('user' => $user)
        );
    }

    /**
     * @Route("/user/all", name="main_showAction")
     */
    public function showAction() {
        $user = $this->getDoctrine()->getRepository(User::class);
        $user = $user->findAll();
        dump($user);

        return $this->render(
            '',
            array('user' => $user)
        );
    }

}
