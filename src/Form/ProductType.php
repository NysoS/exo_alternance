<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nameProduct',TextType::class,['constraints' => [new NotBlank(['message'=>'Please enter the name product'])]])
            ->add('descProduct')
            ->add('priceProduct',NumberType::class,['attr'=>['step'=>'0.1'],'constraints'=>[
                new NotBlank(['message'=>'Please enter the price']), 
                new Positive(['message'=>'The price can\'t be negative'])
                ]])
            ->add('keyWord',TextareaType::class,array('mapped' => false, 'attr'=>['name'=>'keyWord']))
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
