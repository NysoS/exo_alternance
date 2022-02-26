<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nameProduct',TextType::class,['attr'=>['placeholder'=>'name product'],'constraints' => [new NotBlank(['message'=>'Please enter the name product'])]])
            ->add('descProduct',null,['attr'=>['placeholder'=>'description product']])
            ->add('priceProduct',NumberType::class,['attr'=>['step'=>'0.1','placeholder'=>'price product'],'constraints'=>[
                new NotBlank(['message'=>'Please enter the price']), 
                new Positive(['message'=>'The price can\'t be negative'])
                ]])
            ->add('keyWord',TextareaType::class,array('mapped' => false, 'attr'=>['name'=>'keyWord','placeholder'=>'exp: keyword1;keyword2;...']))
            ->add('category',null,['placeholder'=>'None','choice_label'=>'nameCateg',
                'choice_attr' => function($choice){
                    return ['data-name'=>$choice->getNameCateg()];
                }])
            ->add('imgProduct',FileType::class,[
                'mapped' => false, 
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
