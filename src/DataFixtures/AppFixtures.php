<?php

namespace App\DataFixtures;

use App\Entity\Artiste;
use App\Entity\Lieu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --- Artistes ---
        $banksy = (new Artiste())
            ->setPseudonyme('Banksy')
            ->setBio('Artiste anonyme mondialement célèbre pour ses pochoirs engagés et satiriques.')
            ->setNationalite('Britannique');

        $invader = (new Artiste())
            ->setPseudonyme('Invader')
            ->setNomReel('Franck Slama')
            ->setBio('Artiste urbain français connu pour ses mosaïques en céramique de Space Invaders.')
            ->setNationalite('Française');

        $missTic = (new Artiste())
            ->setPseudonyme('Miss.Tic')
            ->setNomReel('Radhia Novat')
            ->setBio('Poétesse et plasticienne majeure du street art parisien.')
            ->setNationalite('Française');

        $manager->persist($banksy);
        $manager->persist($invader);
        $manager->persist($missTic);

        // --- Lieux ---
        $hangar = (new Lieu())
            ->setNom('Le Hangar à Bananes')
            ->setAdresse('21 Quai des Antilles')
            ->setQuartier('Île de Nantes')
            ->setLatitude('47.2008700')
            ->setLongitude('-1.5731200');

        $pommeraye = (new Lieu())
            ->setNom('Passage Pommeraye')
            ->setAdresse('Rue de la Fosse')
            ->setQuartier('Centre-Ville')
            ->setLatitude('47.2135000')
            ->setLongitude('-1.5582000');

        $lieuUnique = (new Lieu())
            ->setNom('Le Lieu Unique')
            ->setAdresse('Quai Ferdinand-Favre')
            ->setQuartier('Malakoff - Pré Gauchet')
            ->setLatitude('47.2155000')
            ->setLongitude('-1.5458000');

        $manager->persist($hangar);
        $manager->persist($pommeraye);
        $manager->persist($lieuUnique);

        $manager->flush();
    }
}
