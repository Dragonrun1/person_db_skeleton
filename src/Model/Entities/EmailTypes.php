<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\ORM\Mapping as ORM;
use PersonDBSkeleton\Utils\Uuid4;

/**
 * EmailTypes
 *
 * @ORM\Table(name="email_types")
 * @ORM\Entity
 */
class EmailTypes {
    use EntityCommon;
    use Uuid4;
    /**
     * EmailTypes constructor.
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
     * @return EmailTypes
     */
    public function setType($type): EmailTypes {
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
