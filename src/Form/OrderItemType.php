<?php

namespace App\Form;

use App\Entity\OrderItem;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                // Show name and price in dropdown
                'choice_label' => function(Product $product) {
                    return $product->getName() . ' (₱' . number_format($product->getPrice(), 2) . ')';
                },
                'placeholder' => 'Select product',
                'attr' => ['class' => 'form-select bg-dark text-light border-light'],
                'choice_attr' => function(Product $product) {
                    // Keep data-price for JS total calculation
                    return ['data-price' => $product->getPrice()];
                },
            ])
            ->add('quantity', IntegerType::class, [
                'attr' => ['min' => 1, 'class' => 'form-control bg-dark text-light border-light'],
                'data' => 1,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderItem::class,
        ]);
    }
}
