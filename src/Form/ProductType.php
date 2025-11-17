<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Product Name',
            ])
            ->add('price', NumberType::class, [
                'label' => 'Price',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a Category',
                'required' => false,
            ])
            ->add('ordering', NumberType::class, [
                'label' => 'Ordering',
                'required' => false,
            ])
            ->add('item', TextType::class, [
                'label' => 'Item Code',
                'required' => false,
            ])
            ->add('stock', NumberType::class, [
                'label' => 'Stock Quantity',
                'required' => false,
            ])
            ->add('reviews', TextType::class, [
                'label' => 'Reviews',
                'required' => false,
            ])
            ->add('image', FileType::class, [
                'label' => 'Product Image (JPEG, PNG, or WebP)',
                'mapped' => false, // We'll handle it manually in controller
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, or WebP).',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
