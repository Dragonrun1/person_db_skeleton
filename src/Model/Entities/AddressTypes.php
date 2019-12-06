<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * AddressTypes
 *
 * @ORM\Table(name="address_types")
 * @ORM\Entity
 */
class AddressTypes {
    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }
    /**
     * Get type.
     *
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }
    /**
     * Set type.
     *
     * @param string $type
     *
     * @return AddressTypes
     */
    public function setType($type): AddressTypes {
        $this->type = $type;
        return $this;
    }
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
