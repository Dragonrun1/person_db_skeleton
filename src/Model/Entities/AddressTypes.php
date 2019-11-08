<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * AddressTypes
 *
 * @ORM\Table(name="address_types")
 * @ORM\Entity
 */
class AddressTypes {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type = '';
}
