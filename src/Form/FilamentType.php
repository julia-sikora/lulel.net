<?php
declare(strict_types=1);
namespace App\Form;

use App\Entity\Filament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FilamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('producer',TextType::class, ['label' => "filament.fields.producer"])
            ->add('name',TextType::class, ['label' => "filament.fields.name"])
            ->add('color',TextType::class, ['label' => "filament.fields.color"])
            ->add('material',TextType::class, ['label' => "filament.fields.material"])
            ->add('temperatureExtruder',TextType::class, ['label' => "filament.fields.temperature_extruder"])
            ->add('temperatureTable',TextType::class, ['label' => "filament.fields.temperature_table"])
            ->add('purchaseDate',DateType::class, ['label' => "filament.fields.purchase_date"])
            ->add('file', FileType::class, [
                'label' => 'filament.fields.file_name',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => 'filament.fields.file_valid'
                    ])
                ],
            ])
            ->add('save', SubmitType::class, ['label' => "filament.fields.save"])
            ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filament::class,
        ]);
    }
}
