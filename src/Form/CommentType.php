<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'form-label mt-8 text-white'
                ],
                'attr' => [
                    'class' => 'form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none'
                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'form-label mt-8 text-white'
                ],
                'attr' => [
                    'class' => 'form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Commento',
                'label_attr' => [
                    'class' => 'form-label text-white'
                ],
                'attr' => [
                    'class' => 'form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'mt-4 inline-block px-6 py-2.5 bg-[#617389] text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-[#617389]-700 hover:shadow-lg focus:bg-[#617389]-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-[#617389]-800 active:shadow-lg transition duration-150 ease-in-out'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
