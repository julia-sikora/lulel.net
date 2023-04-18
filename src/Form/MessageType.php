<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Message;
use App\Enum\MessageAspect;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('textMessage', TextareaType::class, [
                'label' => "message.text",
                'attr' => ['class' => "form-control textarea-control input-control ms-3",],
                'label_attr' => ['class' => "label-control label-form"]
            ])
            ->add('messageAspect', EnumType::class, [
                'label_attr' => ['class' => "label-control label-form me-2"],
                'class' => MessageAspect::class,
                'choice_label' => fn(MessageAspect $choice) => $choice->value
            ])
            ->add('save', SubmitType::class, ['label' => "filament.fields.save", 'attr' => ['class' => 'button save save-message']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
