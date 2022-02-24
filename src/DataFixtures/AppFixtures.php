<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categShoes = new Category();
        $categShoes->setNameCateg('Shoes');

        $manager->persist($categShoes);

        $categTShirt = new Category();
        $categTShirt->setNameCateg('T-shirt');
        
        $manager->persist($categTShirt);

        $shoes1 = new Product();
        $shoes1->setNameProduct('Nike');
        $shoes1->setDescProduct('Sneakers homme Air Max Command');
        $shoes1->setPriceProduct(76.99);
        $shoes1->setKeyWord(['nike','shoes','homme','air max','sneakers']);
        $shoes1->setSize(['38','39','41','42']);
        $shoes1->setCategory($categShoes);
        $manager->persist($shoes1);

        $shoes2 = new Product();
        $shoes2->setNameProduct('Converse');
        $shoes2->setDescProduct('Sneakers femme CTAS MADISON');
        $shoes2->setPriceProduct(39.99);
        $shoes2->setKeyWord(['converse','shoes','femme','madison','sneakers','ctas']);
        $shoes2->setSize(['38','39','40','41','42','45']);
        $shoes2->setCategory($categShoes);
        $manager->persist($shoes2);

        $shoes3 = new Product();
        $shoes3->setNameProduct('Nike');
        $shoes3->setDescProduct('Chaussures en toile fille Court Legacy Little Kids Shoe');
        $shoes3->setPriceProduct(30.09);
        $shoes3->setKeyWord(['nike','shoes','kid','court','toille']);
        $shoes3->setSize(['22','23','26','28']);
        $shoes3->setCategory($categShoes);
        $manager->persist($shoes3);

        $ts1 = new Product();
        $ts1->setNameProduct('T-shirt basique');
        $ts1->setDescProduct('Lacoste');
        $ts1->setPriceProduct(34.95);
        $ts1->setKeyWord(['t-shirt','homme','lacoste']);
        $ts1->setSize(['XS','S','M','L']);
        $ts1->setCategory($categTShirt);
        $manager->persist($ts1);

        $ts2 = new Product();
        $ts2->setNameProduct('Polo');
        $ts2->setDescProduct('Lacoste');
        $ts2->setPriceProduct(69.95);
        $ts2->setKeyWord(['polo','homme','lacoste']);
        $ts2->setSize(['L','XL','XXL']);
        $ts2->setCategory($categTShirt);
        $manager->persist($ts2);

        $ts3 = new Product();
        $ts3->setNameProduct('T-SHIRT NSW CLUB - T-shirt basique');
        $ts3->setDescProduct('Nike Sportswear');
        $ts3->setPriceProduct(19.95);
        $ts3->setKeyWord(['t-shirt','homme','nike','sportswear']);
        $ts3->setSize(['XS','S','M','M-T','L','XL','XXL']);
        $ts3->setCategory($categTShirt);
        $manager->persist($ts3);

        $manager->flush();
    }
}
