<?php
/**
 * Created by PhpStorm.
 * User: rozenn
 * Date: 07/09/18
 * Time: 12:22
 */

namespace App\Form;

use App\Entity\Observation;
use App\Form\DataTransformer\BirdToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValideObservationType extends AbstractType
{
    private $transformer;

    public function __construct(BirdToStringTransformer $transformer)
    {
        $this->transformer = $transformer;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bird', BirdAutocompleteSelectorType::class, ['label' => 'Espèce'])
            ->add('valide', SubmitType::class, ['label' => 'Valider'])
            ->add('decline', SubmitType::class, ['label' => 'Refuser']);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observation::class,
            'validation_groups' => array('validation'),
        ]);
    }
}