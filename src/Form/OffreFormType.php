<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\CodePostal;
use App\Entity\NatureContrat;
use App\Entity\Offre;
use App\Entity\Periode;
use App\Entity\TypeNom;
use App\Entity\Ville;
use ContainerPEmp88U\getVilleTypeService;
use DateTime;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class OffreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $villes = $options['data_class'];

        $builder
            ->add('intitule', TextType::class)
            ->add('employeur', TextType::class)
            ->add('date_de_publication', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('ville', VilleType::class, [
                // if the AddressType "allowed_countries" option is passed,
                // use it to create a filter
                'attr' => $villes ? function ($nom) use ($villes) {
                    return in_array($nom, $villes, true);
                } : null,

            ])
//            ->add('adresse', EntityType::class, [
//                'class' => Adresse::class
//            ])
//            ->add('codePostal', ChoiceType::class, [
//                'class' => CodePostal::class,
//                'placeholder' => 'CP(Choisir votre ville)'
//            ])

            /*->add('ville', ChoiceType::class, [
                'mapped' => false,
                'choices' => [
                    'Angers' => 'nom',
                    'Nantes' => 'nom',
                    'Lille' => 'nom',
                ],
               'choice_attr' => function($choice, $key, $value) {
        // adds a class like attending_yes, attending_no, etc
        return ['class' => Ville::class.strtolower($key)];
    },*/
                /*'choice_label' => function (?Ville $ville) {
                    return $ville ? strtoupper($ville->getNom()) : '';
                },
                'choice_attr' => function (?Ville $ville) {
                    return $ville ? ['class' => 'ville' . strtolower($ville->getNom())] : [];
                }*/
//            ])

//            ->add('nature_contrat', EntityType::class, [
//                'class' => NatureContrat::class
//            ])
            ->add('genre', TextType::class)
//            ->add('numero', TextType::class)
//            ->add('nom', TextType::class)
//            ->add('complement_adresse', TextType::class)
//            ->add('type', EntityType::class, [
//                'class' => TypeNom::class,
//                'choice_label' => 'type'
//            ])
            ->add('rythme', TextType::class)
            ->add('salaire', TextType::class)
//            ->add('periode', EntityType::class, [
//                'class' => Periode::class
//            ])
            ->add('description', TextType::class)//
        ;
        /*$formModifier = function (FormInterface $form, Ville $ville=null)
        {
            $code_postals = (null===$ville) ? [] : $ville->getCodePostals();
            $form->add('codePostal', ChoiceType::class, [
                'class' => CodePostal::class,
                'choices'=> $code_postals
            ]);
        };

        $builder->get('ville')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier){
                $ville =$event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $ville);
            }
        );*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
