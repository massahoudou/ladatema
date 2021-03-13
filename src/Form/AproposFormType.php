<?php

namespace App\Form;

use App\Entity\Apropos;
use Cassandra\Date;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AproposFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('type',ChoiceType::class,[
                'required' => false,
                'choices' => [
                    'Resssource Humaine' => 'rh',
                    'Finance' => 'finance',
                ]
            ])
            ->add('description',TextareaType::class,[
                'required' => true,
            ])
            ->add('afficher',null,[
                'label' => 'Afiicher a l\'accueil'

            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apropos::class,
        ]);
    }
}
