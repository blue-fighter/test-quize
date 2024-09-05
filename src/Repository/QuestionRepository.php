<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    /**
     * @return array
     */
    public function getAllIds(): array
    {
        $data = $this->createQueryBuilder('q')
            ->select('q.id')
            ->getQuery()
            ->execute();

        return array_map(fn($q) => $q['id'], $data);
    }
}