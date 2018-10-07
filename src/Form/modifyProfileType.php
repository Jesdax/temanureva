<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 30/08/18
 * Time: 23:02
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class modifyProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, ['label' => 'Nom'])
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('username', TextType::class, ['label' => 'Nom d\'utilisateur'])
            ->add('email', EmailType::class, ['label' => 'Saisir de nouveau votre email'])
            ->add('newPassword', RepeatedType::class, [
                'required' => false,
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Nouveau mot de passe'],
                'second_options' => ['label' => 'Confirmer mot de passe'],
            ])
            ->add('password', PasswordType::class, ['label' => 'Mot de passe actuel'])
            ->add('date_of_birth', DateType::class, [
                'label' => 'Date de naissance',
                'attr' => ['class' => 'datepicker'],
                'widget' => 'single_text',
                'format'=> 'dd-MM-yyyy',
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Genre',
                'attr' => ['class' => 'gender'],
                'expanded' => false,
                'multiple' => false,
                'choices' => [
                    'Masculin' => '1',
                    'Féminin' =>  '0',
                ]
            ])
            ->add('newImage', FileType::class, [
                'label' => 'Chargez votre image',
                'required' => false,
                'help' => "L'image doit etre de 300 x 300 px"])
            ->add('submit', SubmitType::class, ['label' => 'Valider modification'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
//            'validation_groups' => array('registration'),
        ]);
    }
}