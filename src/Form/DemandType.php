<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 26/08/18
 * Time: 12:22
 */

namespace App\Form;

use App\Entity\Demand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nb_certificate', NumberType::class, ['label' => "Numéro d'état"])
            ->add('certificate_date', DateType::class, [
                'label' => "Date d'obtention",
                'attr' => [
                    'class' => 'datepicker'
                ],
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ])
            ->add('certificate', FileType::class, [
                'label' => "Copie de l'attestation",
                'help' => '*Format acceptés: JPG, PNG, PDF'
            ])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer la demande']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demand::class,
        ]);
    }
}