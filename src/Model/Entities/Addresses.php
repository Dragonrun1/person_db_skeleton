<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Addresses
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity
 */
class Addresses {
    /**
     * Addresses constructor.
     */
    public function __construct() {
        $this->people = new ArrayCollection();
    }
    /**
     * @var string
     *
     * @ORM\Column(name="country_name", type="string", length=50, nullable=false, options={"comment"="country name"})
     */
    private $countryName;
    /**
     * @var string|null
     *
     * @ORM\Column(name="extended_address",
     *     type="string",
     *     length=50,
     *     nullable=true,
     *     options={"comment"="apartment/suite/room name/number if any"}
     * )
     */
    private $extendedAddress;
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
     * @ORM\Column(name="locality",
     *     type="string",
     *     length=50,
     *     nullable=false,
     *     options={"comment"="city/town/village"}
     * )
     */
    private $locality;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleAddresses", mappedBy="address", fetch="EXTRA_LAZY")
     */
    private $people;
    /**
     * @var string|null
     *
     * @ORM\Column(name="post_office_box",
     *     type="string",
     *     length=50,
     *     nullable=true,
     *     options={"comment"="post office box description if any"}
     * )
     */
    private $postOfficeBox;
    /**
     * @var string
     *
     * @ORM\Column(name="postal_code",
     *     type="string",
     *     length=30,
     *     nullable=false,
     *     options={"comment"="postal code, e.g. US ZIP"}
     * )
     */
    private $postalCode;
    /**
     * @var string
     *
     * @ORM\Column(name="region",
     *     type="string",
     *     length=50,
     *     nullable=false,
     *     options={"comment"="state/county/province"}
     * )
     */
    private $region;
    /**
     * @var string|null
     *
     * @ORM\Column(name="street_address",
     *     type="string",
     *     length=255,
     *     nullable=true,
     *     options={"comment"="street number + name"}
     * )
     */
    private $streetAddress;
}
