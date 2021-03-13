<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=> 'fasle',
                'attr'=> [
                    'placeholder'=>'Votre Nom'
                ]
            ])
            ->add('telephone',IntegerType::class,[
                'required'=> true,
                'attr'=> [
                    'placeholder'=> 'Votre téléphone'
                ]
            ])
            ->add('email',TextType::class,[
                'required'=> true,
                'attr'=> [
                    'placeholder'=> 'votre adress Mail'
                ]
            ])
            ->add('message',TextareaType::class,[
                'label' => false,
                'attr'=>[
                    'placeholder'=> 'Votre Message',
                    'rows'=> 6,
                    'cols'=>20,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
