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
            ->add('email', EmailType::class, ['label' => "register.form.email" , 'attr' => ['class' => "form-control input-control"], 'label_attr' => ['class' => "label-control label-form"]])
            ->add('nickname', TextType::class, ['label' => "register.form.name" , 'attr' => ['class' => "form-control input-control"], 'label_attr' => ['class' => "label-control label-form"]])
            ->add('password', PasswordType::class, ['label' => "register.form.password" , 'attr' => ['class' => "form-control input-control"], 'label_attr' => ['class' => "label-control label-form"]])
            ->add('repeatPassword', PasswordType::class, ['label' => "register.form.repeat_password" , 'attr' => ['class' => "form-control input-control"], 'label_attr' => ['class' => "label-control label-form"]])
            ->add('appPassword', PasswordType::class, ['label' => "register.form.app_password" , 'attr' => ['class' => "form-control input-control"], 'label_attr' => ['class' => "label-control label-form"]])
            ->add('save', SubmitType::class, ['label' => "register.form.save", 'attr' => ['class' => 'button']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => RegisterModel::class]);
    }
}
