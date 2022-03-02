<?php

namespace App\Controller;

use App\Entity\TypeNom;
use App\Form\TypeNomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type")
     */
    public function index(Request $request): Response
    {
        $type = new TypeNom();
        $form = $this->createForm(TypeNomType::class, $type);
        $form->handleRequest($request);
        return $this->render('offre/test.html.twig', [
            'testNomForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/test", name="offre_test")
     */
   /* public function test(Request $request)
    {

        $type = new TypeNom();
        $form = $this->createForm(TypeNom::class, $type);
        $form->handleRequest($request);
        return $this->render('offre/test.html.twig', [
            'testNomForm' => $form->createView()

        ]);
    }*/


}
