<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class CodeType extends AbstractType
{
    const MESSAGE = 'Field should not be blank.';

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => self::MESSAGE]),
                ]
            ])
            ->add('length', NumberType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => self::MESSAGE]),
                ]
            ])
            ->add('submit', SubmitType::class)
            ->getForm();
    }
}