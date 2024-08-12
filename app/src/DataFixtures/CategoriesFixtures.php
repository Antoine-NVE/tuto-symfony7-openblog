<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    public  function __construct(private readonly SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        $categories = [
            [
                'name' => 'France',
                'parent' => null
            ],
            [
                'name' => 'Monde',
                'parent' => null
            ],
            [
                'name' => 'Politique',
                'parent' => 'France'
            ],
            [
                'name' => 'Associations',
                'parent' => 'France'
            ],
            [
                'name' => 'Economie',
                'parent' => 'Monde'
            ]
        ];

        foreach ($categories as $category) {
            $newCategory = new Categories();
            $newCategory->setName($category['name']);

            $slug = strtolower($this->slugger->slug($newCategory->getName()));

            $newCategory->setSlug($slug);

            // On crée une référence à cette catégorie
            $this->setReference($category['name'], $newCategory);

            $parent = null;

            // On vérifie si la catégorie a un parent dans le tableau
            if ($category['parent'] !== null) {
                $parent = $this->getReference($category['parent']);
            }
            
            $newCategory->setParent($parent);

            $manager->persist($newCategory);
        }

        $manager->flush();
    }
}
