<?php
declare(strict_types=1);

namespace App\Form;

use App\Model\Form\NavbarSearchModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NavbarSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', SearchType::class, ['label' => false, 'attr' => ['class' => 'form-control mb-2 mt-2 me-2']])
            ->add('save', SubmitType::class, ['label' => "search.form.save", 'attr' => ['class' => 'btn btn-outline-success search-button']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NavbarSearchModel::class,
        ]);
    }
}
