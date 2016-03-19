<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Event;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository
{
	public function findAllOrderedById() {
		return $this->getEntityManager()
		->createQuery( 'SELECT n FROM AppBundle:News n
				 ORDER BY n.id DESC' ) 
		->getResult();
	}
	
	public function findRescentEvents($limit) {
		return $this
		 ->createQueryBuilder('e')
            ->select('e')
            ->where('e.date <= :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('e.date', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
			->getResult();
	}
}