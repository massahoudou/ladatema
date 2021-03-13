<?php

namespace App\Form;

use App\Entity\Recruteur;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecruteurFinalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('nom')
            ->add('prenom')
            ->add('contact')
            ->add('ville')
            ->add('adresse')
            ->add('nomemtreprise',null,[
                'attr' => [
                    'placeholder' => 'Nom de l\'entreprise '
                ]])
            ->add('numimatricul',IntegerType::class,[
                'required' => false,
                'attr' => [
                    'placeholder' => 'Numéro d\'Immatriculation'
                ]
            ])
            ->add('description',CKEditorType::class,[
                'attr' => ['placeholder' => 'Description de l\'entrprise ']
            ])
            ->add('siteweb',null,[
                'attr' => [
                    'placeholder' => 'Site-Web'
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recruteur::class,
        ]);
    }
}
