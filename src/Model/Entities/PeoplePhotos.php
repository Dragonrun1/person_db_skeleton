<?php

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeoplePhotos
 *
 * @ORM\Table(name="people_photos")
 * @ORM\Entity
 */
class PeoplePhotos {
    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
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
