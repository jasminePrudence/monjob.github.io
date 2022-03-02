<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\User;
use App\Form\RegistrationFormType;

use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordHasherInterface $userPasswordHasherInterface
     * @param $slugger
     * @return Response
     */


    public function register(Request                     $request,
                             UserPasswordHasherInterface $userPasswordHasherInterface
    ): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');

        }
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
        /** @var UploadedFile $photo */
//            $photo = $form->get('photo')->getData();

        // this condition is needed because the 'brochure' field is not required
        // so the PDF file must be processed only when a file is uploaded
        /*if ($photo) {
            $img = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL

            $image = $slugger->slug($img);
            $name = $image . '-' . uniqid() . '.' . $photo->guessExtension();
            // Move the file to the directory where photo are stored
            try {
                $photo->move(
                    $this->getParameter('photo_directory'),
                    $name
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
                echo 'noooooo';
            }*/

        // updates the 'brochureFilename' property to store the PDF file name
        // instead of its contents
//                $user->setPhoto($name);
    }

}
