<?php

namespace App\Repository;

use App\Entity\Benevole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Benevole>
 */
class BenevoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Benevole::class);
    }

    /**
     * Requête 4 — Traçabilité : nom et prénom des photographes ayant pris des photos
     * d'œuvres réalisées par un artiste donné dans un quartier donné.
     *
     * @return array<int, array{nom: string, prenom: string}>
     */
    public function photographesParArtisteEtQuartier(string $pseudonyme, string $quartier): array
    {
        return $this->createQueryBuilder('b')
            ->distinct()
            ->select('b.nom', 'b.prenom')
            ->join('b.photos', 'p')
            ->join('p.oeuvre', 'o')
            ->join('o.lieu', 'l')
            ->join('o.artistes', 'a')
            ->where('a.pseudonyme = :pseudonyme')
            ->andWhere('l.quartier = :quartier')
            ->setParameter('pseudonyme', $pseudonyme)
            ->setParameter('quartier', $quartier)
            ->getQuery()
            ->getResult();
    }
}
