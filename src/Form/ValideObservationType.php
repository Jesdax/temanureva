<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 04/09/18
 * Time: 10:01
 */

namespace App\Form;


use App\Entity\Observation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValideObservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bird', TextType::class, ['label' => 'Espèce'])
            ->add('valide', SubmitType::class, ['label' => 'Valider'])
            ->add('decline', SubmitType::class, ['label' => 'Refuser']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observation::class,
        ]);
    }
}