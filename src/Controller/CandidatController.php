<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Form\CandidatType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\common\persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Config\Framework\RequestConfig;

class CandidatController extends AbstractController
{
    /**
     * @Route("/inscription", name="candidat_inscription")
     */
    public function inscription(
        Request                $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        if ($request->request->count() > 0) {
            $candidat = new Candidat();
            $candidat->setNom($request->request->get('nom'))
                ->setLogin($request->request->get('login'))
                ->setMetier($request->request->get('metier'))
                ->setCodePostal($request->request->get('code_postal'))
                ->setEmail($request->request->get('email'))
                ->setPrenom($request->request->get('prenom'))
                ->setDateDeNaissance(new \DateTime($request->request->get("date_de_naissance")))
                ->setAdresse($request->request->get('adresse'))
                ->setVille($request->request->get('ville'))
                ->setMotDePasse($request->request->get('mot_de_passe'))
                ->setProfil($request->request->get('profil'));
            $entityManager->persist($candidat);
            $entityManager->flush();
        }
        //creation automatique du formulaire
        //$candidat = new Candidat();
        /* $candidatForm = $this->createForm(CandidatType::class, $candidat);
         $candidatForm->handleRequest($request);
         if ($candidatForm->isSubmitted()) {
             $entityManager->persist($candidat);
             $entityManager->flush();
         }*/
        return $this->render('registration/souscription.html.twig');
    }


    /**
     * @Route("/profil", name="candidat_profil")
     */
    public function profil()
    {
        return $this->render('candidat/profil.html.twig');
    }

}