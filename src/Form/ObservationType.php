<?php

namespace App\Form;

use App\Entity\Observation;
use App\Entity\Bird;
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //test avec autocompletion JS et Ajax
           ->add('bird', HiddenType::class, [
                'label'=>'Nom de l\'espèce ',
                'required' => false,
                'attr' =>[
                    'class' => 'bird_research'
                ]
            ])

            //test avec EntityType
           /*->add('bird', EntityType::class, [
                'label'=>'Nom de l\'espèce ',
                'required' => false,
                'class' => Bird::class,
                'choice_label' => 'vernacular_name',
                'query_builder' => function (BirdRepository $br) {
                    return $br->findByVernacularName($observation->getBird());
                }
            ])*/
            ->add('observation_date', DatetimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date d\'observation *',
                'format' => 'dd/MM/yyyy H:i',
                'html5' => false,
                'attr' => [
                    'class' => 'datepicker'
                ],
                'required' => true

            ])
            ->add('location', TextType::class, [
                'label' => 'Lieu d\'observation *',
                'required' => true,
                // implementation of OpenStreetMap TODO
            ])
            ->add('image', FileType::class, [
                'label' => 'Image de l\'observation',
                'attr' => [
                    'class' => 'file-field input-field'
                ],
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Observation::class,
        ]);
    }
}
