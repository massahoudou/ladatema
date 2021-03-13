<?php


namespace App\Form;


use App\Data\SearchData;
use App\Entity\Catcontrat;
use App\Entity\Secteur;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends  AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', \Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=> false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Recherche'
                    ]
            ])
            ->add('categorie',EntityType::class,[
                'label' => false,
                'required' => false,
                'class' => Catcontrat::class,
                'expanded' => true,
                'multiple'=> true,
            ])
            ->add('secteur',EntityType::class,[
                'label' => false,
                'required' => false,
                'class' => Secteur::class,
                'expanded' => true,
                'multiple'=> true,
            ])
            ->add('pays',TextType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Pays',
                    'class' => 'rounded-0 ',
                    ]
            ])
            ->add('min',IntegerType::class,[
                'label' => false,
                'required'=> False,
                'attr' => [
                    'placeholder' => 'Min',
                    'class' => 'rounded-0 ',
                    ]
            ])
            ->add('max',IntegerType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Max',
                    'class' => 'rounded-0 ',
                ]
            ])

            ->add('etud',ChoiceType::class,[
                'multiple' => true,
                'required' => false,
                'label' => false,
                'expanded' => true,
                'choices' => [
                    'Bac + 1' => 1,
                    'Bac + 2' => 2,
                    'Bac + 3' => 3,
                    'Bas + 4' => 4,
                    'Bas + 5 et plus ' => 5,
                ],
            ])
            ->add('exp',ChoiceType::class,[
                'multiple' => true,
                'required' => false,
                'label' => false,
                'expanded' => true,
                'choices' => [
                    'Etudiants' => 1,
                    '2 à 5 ans' => 2,
                    '5 à 10 ans' => 5,
                    '10 ans et plus ' => 10,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
      return '';
    }
}