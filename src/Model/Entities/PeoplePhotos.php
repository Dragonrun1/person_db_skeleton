<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * PeoplePhotos
 *
 * @ORM\Table(name="people_photos")
 * @ORM\Entity
 */
class PeoplePhotos {
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
