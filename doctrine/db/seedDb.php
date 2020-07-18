<?php

require_once ('C:\wh\katas\kata\doctrine\bootstrap.php');

$faker = Faker\Factory::create();

for ($i = 1000; $i < 1000; $i--){
    $item = new src\Entity\Item();
    $item
        ->setUpdateDate($faker->dateTime)
        ->setDescription($faker->text)
        ->setItemName($faker->name)
        ->setItemType($faker->state);
    $entityManager->flush();
    $entityManager->persist($item);
}
