<?php

namespace src\Services;

use Doctrine\ORM\EntityManager;
use src\Entity;

class ItemService
{
    /**
     * @var EntityManager
     */
    private  $entityManager;

    /**
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->entityManager = $manager;
    }

    /**
     * @param object $array
     *
     * @return Entity\Item
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function itemCreate(object $array){

        $item =  new Entity\Item();

        $item
            ->setitemName($array->fname)
            ->setDescription($array->description)
            ->setitemType($array->itype)
            ->setUpdateDate(new \DateTime('now'));

        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return $item;
    }

    /**
     * @return array
     */
    public function getAllItems(){

        $itemsRepo = $this->entityManager->getRepository(Entity\Item::class);

        return $itemsRepo->findAll();
    }
}
