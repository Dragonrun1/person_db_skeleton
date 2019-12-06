<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

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
     * Add person.
     *
     * @param PeopleAddresses $person
     *
     * @return Addresses
     */
    public function addPerson(PeopleAddresses $person): Addresses {
        $this->people[] = $person;
        return $this;
    }
    /**
     * Get countryName.
     *
     * @return string
     */
    public function getCountryName(): string {
        return $this->countryName;
    }
    /**
     * Get extendedAddress.
     *
     * @return string|null
     */
    public function getExtendedAddress(): ?string {
        return $this->extendedAddress;
    }
    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }
    /**
     * Get locality.
     *
     * @return string
     */
    public function getLocality(): string {
        return $this->locality;
    }
    /**
     * Get people.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeople(): Collection {
        return $this->people;
    }
    /**
     * Get postOfficeBox.
     *
     * @return string|null
     */
    public function getPostOfficeBox(): ?string {
        return $this->postOfficeBox;
    }
    /**
     * Get postalCode.
     *
     * @return string
     */
    public function getPostalCode(): string {
        return $this->postalCode;
    }
    /**
     * Get region.
     *
     * @return string
     */
    public function getRegion(): string {
        return $this->region;
    }
    /**
     * Get streetAddress.
     *
     * @return string|null
     */
    public function getStreetAddress(): ?string {
        return $this->streetAddress;
    }
    /**
     * Remove person.
     *
     * @param PeopleAddresses $person
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePerson(PeopleAddresses $person): bool {
        return $this->people->removeElement($person);
    }
    /**
     * Set countryName.
     *
     * @param string $countryName
     *
     * @return Addresses
     */
    public function setCountryName($countryName): Addresses {
        $this->countryName = $countryName;
        return $this;
    }
    /**
     * Set extendedAddress.
     *
     * @param string|null $extendedAddress
     *
     * @return Addresses
     */
    public function setExtendedAddress($extendedAddress = null): Addresses {
        $this->extendedAddress = $extendedAddress;
        return $this;
    }
    /**
     * Set locality.
     *
     * @param string $locality
     *
     * @return Addresses
     */
    public function setLocality($locality): Addresses {
        $this->locality = $locality;
        return $this;
    }
    /**
     * Set postOfficeBox.
     *
     * @param string|null $postOfficeBox
     *
     * @return Addresses
     */
    public function setPostOfficeBox($postOfficeBox = null): Addresses {
        $this->postOfficeBox = $postOfficeBox;
        return $this;
    }
    /**
     * Set postalCode.
     *
     * @param string $postalCode
     *
     * @return Addresses
     */
    public function setPostalCode($postalCode): Addresses {
        $this->postalCode = $postalCode;
        return $this;
    }
    /**
     * Set region.
     *
     * @param string $region
     *
     * @return Addresses
     */
    public function setRegion($region): Addresses {
        $this->region = $region;
        return $this;
    }
    /**
     * Set streetAddress.
     *
     * @param string|null $streetAddress
     *
     * @return Addresses
     */
    public function setStreetAddress($streetAddress = null): Addresses {
        $this->streetAddress = $streetAddress;
        return $this;
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
