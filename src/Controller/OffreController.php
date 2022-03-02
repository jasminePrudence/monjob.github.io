<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Candidat;
use App\Entity\CodePostal;
use App\Entity\NatureContrat;
use App\Entity\Offre;
use App\Entity\Periode;
use App\Entity\TypeNom;
use App\Entity\Ville;
use App\Form\OffreFormType;
use App\Form\RegistrationFormType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class OffreController extends AbstractController
{

    /**
     * @Route("/welcome", name="offre_welcome")
     */
    public function welcome(): Response
    {
        return $this->render(
            'offre/welcome.html.twig');
    }

    /**
     * @Route("/form", name="offre_form")
     */
    public function form(Request $request)
    {
        return $this->render('offre/inserer.html.twig');
    }


    /**
     * @Route("/offre/{id}" name="offre_detail")
     */
    /* public function detail($id) {
         $offre = $this->getDoctrine()->getRepository(Offre::class)->find($id);

         return $this->render('offre/index.html.twig',[
             array('offre' => $offre)
 //            "offre" => $offre,
         ]);
     }*/

    /**
     * @Route("/inserer", name="offre_inserer")
     */
    public function inserer(Request                $request,
                            EntityManagerInterface $entityManager
    ): Response
    {
        $offre = new Offre();
        $adresse = new Adresse();
        $type = new TypeNom();
        $code_postal = new CodePostal();
        $ville = new Ville();
        $periode = new Periode();
        $nature_contrat = new NatureContrat();

        $form = $this->createForm(OffreFormType::class, $offre);
        $form->handleRequest($request);

//        if ($request->request->count() > 0) {
        if ($form->isSubmitted() && $form->isValid()) {

            /*$offre->setIntitule($request->request->get('intitule'))
                ->setEmployeur($request->request->get('employeur'))
                ->setDateDePublication(new \DateTime($request->request->get("date_de_publication")))
                ->setGenre($request->request->get('genre'))
                ->setRythme($request->request->get('rythme'))
                ->setSalaire($request->request->get('salaire'))
                ->setDescription($request->request->get('description'));

            $periode->setNom($request->request->get('periode'));

            $nature_contrat->setNom($request->request->get('nature_contrat'));
            $type->setNom($request->request->get('type'));

            $code_postal->setNumero($request->request->get('code_postal'));

            $adresse->setNumero($request->request->get('numero'))
                ->setNom($request->request->get('nom'))
                ->setComplementAdresse($request->request->get('complement_adresse'));

            $ville->setNom($request->request->get('ville'));

            $entityManager->persist($offre);
            $entityManager->persist($adresse);
            $entityManager->persist($code_postal);
            $entityManager->persist($type);
            $entityManager->persist($nature_contrat);
            $entityManager->persist($periode);*/
            $entityManager->persist($offre);
            $entityManager->flush();
            return $this->redirectToRoute('offre_welcome');

        }

        /* $type = $this->getDoctrine()->getRepository(TypeNom::class)->findAll();
         $code_postal = $this->getDoctrine()->getRepository(CodePostal::class)->findAll();
         $ville = $this->getDoctrine()->getRepository(Ville::class)->findAll();
         $nature_contrat = $this->getDoctrine()->getRepository(NatureContrat::class)->findAll();
         $periode = $this->getDoctrine()->getRepository(Periode::class)->findAll();*/

        return $this->render(
            'offre/inserer.html.twig', [
            'offreForm' => $form->createView(),            /*'type' => $type,
            'code_postal' => $code_postal,
            'ville' => $ville,
            'periode' => $periode,
            'nature_contrat' => $nature_contrat*/
        ]);
    }
}

