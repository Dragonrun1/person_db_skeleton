<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\ORM\Mapping as ORM;
use PersonDBSkeleton\Utils\Uuid4;

/**
 * PeoplePhotos
 *
 * @ORM\Table(name="people_photos")
 * @ORM\Entity
 */
class PeoplePhotos {
    use EntityCommon;
    use Uuid4;
    /**
     * PeoplePhotos constructor.
     *
     * @throws \Exception
     */
    public function __construct() {
        $this->createdAt = new \DateTimeImmutable();
        $this->id = $this->asBase64();
    }
    /**
     * Get mimeType.
     *
     * @return string
     */
    public function getMimeType(): string {
        return $this->mimeType;
    }
    /**
     * Get photo.
     *
     * @return string
     */
    public function getPhoto(): string {
        return $this->photo;
    }
    /**
     * Set mimeType.
     *
     * @param string $mimeType
     *
     * @return PeoplePhotos
     */
    public function setMimeType($mimeType): PeoplePhotos {
        $this->mimeType = $mimeType;
        return $this;
    }
    /**
     * Set photo.
     *
     * @param string $photo
     *
     * @return PeoplePhotos
     */
    public function setPhoto($photo): PeoplePhotos {
        $this->photo = $photo;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="mime_type", type="string", length=50, nullable=false)
     */
    private $mimeType = '';
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="blob", length=16777215, nullable=false)
     */
    private $photo;
}
