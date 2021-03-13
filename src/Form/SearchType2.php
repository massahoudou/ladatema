<?php
namespace  App\Form;


use App\Entity\Catcontrat;
use App\Entity\Secteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class SearchType2 extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder /*->add('secteur',EntityType::class,[
           'label' => false,
           'attr' => [
               'placeholder'=>'Secteur d\' activité',
               'class' => 'rounded-0 secteur'
           ],
           'required' => false,
           'class' => Secteur::class,
           'multiple' => true,
       ])*/
           ->add('q', \Symfony\Component\Form\Extension\Core\Type\TextType::class,[
               'label'=> false,
               'required' => false,
               'attr' => [
                   'placeholder' => 'Mot clef ',
                   'class' => 'rounded-0',
               ]
           ])
           ->add('pays',ChoiceType::class,[
               'label' => false,
               'required' => false,
               'attr' => [
                   'placeholder' => 'Pays',
                   'class' => 'rounded-0 ',
               ],
               'choices' => [
                    'TOGO' => 'togo',
                    'BENIN' => 'benin',
                    'GHANA' => 'ghana',
                    'BURKINA FASO' => 'burikina faso',
                    'Cote d\'ivoire' => 'cote d\'ivoire',
                ],
           ]);

    }
}