<?php

namespace App\Repository;

use App\Entity\Tag;
use App\Entity\Post;
use App\Model\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Post[] Returns an array of Post objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


    public function findPosts(?Tag $tag = null): array {

        $posts =  $this->createQueryBuilder('p')
                    ->where('p.state LIKE :state')
                    ->setParameter('state', '%STATE_PUBLISHED%')
                    ->orderBy('p.createdAt', 'DESC');


                    if ($tag) {
                       $posts = $posts->join('p.tags', 't')
                        ->andWhere(':tag IN (t)')
                        ->setParameter('tag', $tag);
                    }

        return $posts->getQuery()
        ->getResult();
    }

    public function findBySearch(SearchData $searchData) {

        return $this->createQueryBuilder('p')
                        ->where('p.state LIKE :state')
                        ->setParameter('state', '%STATE_PUBLISHED%')
                        ->andWhere('p.content LIKE :query')
                        ->orWhere('p.title LIKE :query')
                        ->setParameter('query', "%{$searchData->query}%")
                        ->orderBy('p.createdAt', 'DESC')
                        ->getQuery()
                        ->getResult();
    }
}
