<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\ORM\Mapping as ORM;
use PersonDBSkeleton\Utils\Uuid4;

/**
 * AddressTypes
 *
 * @ORM\Table(name="address_types")
 * @ORM\Entity
 */
class AddressTypes {
    use EntityCommon;
    use Uuid4;
    /**
     * AddressTypes constructor.
     *
     * @throws \Exception
     */
    public function __construct() {
        $this->createdAt = new \DateTimeImmutable();
        $this->id = $this->asBase64();
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type = '';
}
