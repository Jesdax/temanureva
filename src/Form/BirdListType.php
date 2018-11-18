<?php
/**
 * Created by PhpStorm.
 * User: rozenn
 * Date: 22/08/18
 * Time: 15:33
 */

namespace App\Form;


use App\Entity\Bird;
use Doctrine\ORM\EntityRepository;
use App\Repository\BirdRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BirdListType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            //->add('id', HiddenType::class)
            ->add('family', TextType::class)
            ->add('sort', ChoiceType::class, [
                'choices' => [
                    'A -Z' => Bird::SORTING_A_TO_Z,
                    'Z -A' => Bird::SORTING_Z_TO_A,
                    /*'Nombre d\'observations croissant' => Bird::SORTING_INCREASE_OBSERVATIONS,
                    'Nombre d\'observations décroissant' => Bird::SORTING_DECREASE_OBSERVATIONS*/
                ],
                'label'=> 'Trier par',
                /*'expanded' => true,
                'multiple' => false,*/
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bird::class,
        ]);
    }
}