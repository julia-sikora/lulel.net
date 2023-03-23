<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\Form\RegisterModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['label' => "register.form.email"])
            ->add('nickname', TextType::class, ['label' => "register.form.name"])
            ->add('password', PasswordType::class, ['label' => "register.form.password"])
            ->add('appPassword', PasswordType::class, ['label' => "register.form.app_password"])
            ->add('save', SubmitType::class, ['label' => "register.form.save"]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => RegisterModel::class]);
    }
}
