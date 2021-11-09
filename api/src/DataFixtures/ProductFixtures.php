<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getProducts() as $product) {
            $product = (new Product())
            ->setName($product['name'])
            ->setQuantity($product['quantity'])
            ->setUnit($product['unit']);

            $manager->persist($product);
        }

        $manager->flush();
    }

    private function getProducts(): array
    {
        return [
          ['name' => 'Jabłka', 'quantity' => 20, 'unit' => 'kilogramów'],
          ['name' => 'Pomarańcze', 'quantity' => 55, 'unit' => 'funtów'],
          ['name' => 'Brzoskwinie', 'quantity' => 200, 'unit' => 'kilogramów'],
          ['name' => 'Banany', 'quantity' => 1000, 'unit' => 'ton'],
          ['name' => 'Kapusta', 'quantity' => 235, 'unit' => 'kilogramów'],
        ];
    }
}
