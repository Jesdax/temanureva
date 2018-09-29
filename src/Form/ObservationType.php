<?php

namespace App\Form;

use App\Form\DataTransformer\BirdToStringTransformer;
use App\Entity\Observation;
use App\Entity\Bird;
use App\Form\BirdAutocompleteSelectorType;
use Doctrine\ORM\EntityRepository;
use App\Repository\BirdRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservationType extends AbstractType
{
    private $transformer;

    public function __construct(BirdToStringTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //test avec autocompletion JS et Ajax
           ->add('bird', BirdAutocompleteSelectorType::class, [
                'label'=>'Nom de l\'espèce ',
                'required' => false,
                'attr' =>[
                    'class' => 'bird_research'
                ]
            ])

            ->add('observation_date', DateTimeType::class, [
                'widget' =>'single_text',
            ])

            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'required' => false,
            ])

            ->add('latitude', TextType::class, [
                'label' => 'Latitude',
                'required' => true,
            ])
            ->add('longitude', TextType::class, [
                'label' => 'Longitude',
                'required' => true,
            ])

            ->add('image', FileType::class, [
                'label' => 'Image de l\'observation',
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observation::class,
            'validation_groups' => [
                'add_observation'
            ],
        ]);

    }
}
