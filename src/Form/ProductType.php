<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nameProduct')
            ->add('descProduct')
            ->add('priceProduct',NumberType::class,['attr'=>['step'=>'0.1']])
            ->add('keyWord',TextareaType::class,array('mapped' => false))
            ->add('category',null,['placeholder'=>'None','choice_label'=>'nameCateg',
                'choice_attr' => function($choice){
                    return ['data-name'=>$choice->getNameCateg()];
                }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
