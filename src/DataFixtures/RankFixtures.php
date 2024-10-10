<?php
namespace App\DataFixtures;

use App\Entity\Rank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RankFixtures extends Fixture
{
public function load(ObjectManager $manager): void
{
$rank = new Rank();
$rank->setName('Default');
// Ajoute d'autres propriétés si nécessaire
$manager->persist($rank);

$manager->flush();
}
}