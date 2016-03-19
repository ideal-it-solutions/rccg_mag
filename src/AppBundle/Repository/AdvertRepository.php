<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Advert;

/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends EntityRepository
{
	public function findAllOrderedById() {
		return $this->getEntityManager()
		->createQuery( 'SELECT a FROM AppBundle:News a
				 ORDER BY a.id DESC' ) 
		->getResult();
	}
	
	public function findRescentAdverts($limit) {
		return $this
		 ->createQueryBuilder('a')
            ->select('a')
            ->where('a.publishedAt <= :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('a.publishedAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
			->getResult();
	}
}
