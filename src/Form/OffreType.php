<?php

namespace App\Form;

use App\Entity\Offre;
use App\Entity\Secteur;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use \Symfony\Component\Form\Extension\Core\Type\IntegerType;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[
                'label'=> 'Titre de l\'offre',
                'required'=> true,
                'attr'=> [
                    'minMessage'=>10
                ]

            ])
            ->add('description',CKEditorType::class,[
                'label'=> 'Détailler plus l\'offre',
                'required' => true
            ])
            ->add('nombreposte',IntegerType::class,[
                'label'=> 'Nombre de poste',
            ])
            ->add('experience',IntegerType::class,[
                'label'=> 'anneé d\'experience',
            ])
            ->add('ville')
            ->add('etude')
            ->add('delai',DateType::class,[
                'required' => true,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control js-datepickerr',
                ],
            ])
            ->add('genre',ChoiceType::class,[
                'multiple' => false,
                'required' => true,
                'choices'=>[
                    'Femme'=>'femme',
                    'Homme' => 'homme',
                    'Tous' => 'homme / femme'
                ]
            ])
            ->add('catcontrat',null, [
                'required' => true,
                'attr' => [ 'class' => 'contrat']
            ])
            ->add('secteur', EntityType::class,[
                'class' => Secteur::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'attr' => ['class' => 'secteur']
                ])
            ->add('salaire')
            ->add('pays')
            ->add('imageFile',FileType::class,[
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
