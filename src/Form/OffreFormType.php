<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\CodePostal;
use App\Entity\NatureContrat;
use App\Entity\Offre;
use App\Entity\Periode;
use App\Entity\Rythme;
use App\Entity\TypeNom;
use App\Entity\Ville;
use DateTime;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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

        $builder
            ->add('intitule', TextType::class)
            ->add('employeur', TextType::class)
            ->add('date_de_publication', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir',
                'mapped' => false
            ])
            ->add('nature_contrat', EntityType::class, [
                'class' => NatureContrat::class,
                'placeholder' => 'Choisir',
                'choice_label' => 'nom'
            ])
            ->add('salaire', TextType::class)
            ->add('periode', EntityType::class, [
                'class' => Periode::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir',
            ])
            ->add('adresse', TextType::class)
            ->add('complement_adresse', TextType::class)
            ->add('codePostal', EntityType::class, [
                'class' => CodePostal::class,
                'choice_label' => 'numero',
                'mapped' => false,
                'placeholder' => 'Choisir',

            ])
            ->add('rythme', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'Temps plein' => 1,
                    'Temps partiel' => 2,
                ],
                'choice_attr' => [
                    'Temps plein' => ['data-color' => 'Green'],
                    'Temps partiel' => ['data-color' => 'Yellow'],

                ],
            ])
            ->add('genre', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'Présentiel' => 'Présentiel',
                    'Télétravail' => 'Télétravail',
                ],
            ])
            ->add('description', TextareaType::class);
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
