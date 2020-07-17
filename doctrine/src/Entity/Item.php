<?php

namespace src\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Items")
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=254, nullable=true)
     */
    private $item_name;

    /**
     * @ORM\Column(type="string", length=254, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"comment":"0:buyer, 1:seller, 2:admin"})
     */
    private $item_type;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $update_date;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return Item
     */
    public function setId($id): Item
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getitemName()
    {
        return $this->item_name;
    }

    /**
     * @param string $item_name
     *
     * @return Item
     */
    public function setItemName($item_name): Item
    {
        $this->item_name = $item_name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Item
     */
    public function setDescription($description): Item
    {
        $this->description = $description;

        return $this;
    }


    /**
     * @return string
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * @param string $item_type
     *
     * @return Item
     */
    public function setItemType($item_type): Item
    {
        $this->item_type = $item_type;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * @param \DateTimeInterface $dateTime
     *
     * @return Item
     */
    public function setUpdateDate(?\DateTimeInterface $dateTime = null): Item
    {
        $this->update_date = $dateTime;

        return $this;
    }
}

