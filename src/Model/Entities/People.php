<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * People
 *
 * @ORM\Table(name="people", indexes={
 *     @ORM\Index(name="fk_p_photo", columns={"photo_id"}),
 *     @ORM\Index(name="fk_p_gender", columns={"gender_id"}),
 *     @ORM\Index(name="idx_p_family_name", columns={"family_name"})
 * })
 * @ORM\Entity(repositoryClass="PersonDBSkeleton\Model\Repositories\People")
 */
class People {
    /**
     * Constructor
     */
    public function __construct() {
        $this->emails = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
    }
    /**
     * Add address.
     *
     * @param PeopleAddresses $address
     *
     * @return People
     */
    public function addAddress(PeopleAddresses $address): People {
        $this->addresses[] = $address;
        return $this;
    }
    /**
     * Add email.
     *
     * @param PeopleEmails $email
     *
     * @return People
     */
    public function addEmail(PeopleEmails $email): People {
        $this->emails[] = $email;
        return $this;
    }
    /**
     * Add phoneNumber.
     *
     * @param PeoplePhoneNumbers $phoneNumber
     *
     * @return People
     */
    public function addPhoneNumber(PeoplePhoneNumbers $phoneNumber): People {
        $this->phoneNumbers[] = $phoneNumber;
        return $this;
    }
    /**
     * Get additionalName.
     *
     * @return string|null
     */
    public function getAdditionalName(): ?string {
        return $this->additionalName;
    }
    /**
     * Get addresses.
     *
     * @return Collection
     */
    public function getAddresses(): Collection {
        return $this->addresses;
    }
    /**
     * Get birthday.
     *
     * @return \DateTime|null
     */
    public function getBirthday(): ?DateTime {
        return $this->birthday;
    }
    /**
     * Get emails.
     *
     * @return Collection
     */
    public function getEmails(): Collection {
        return $this->emails;
    }
    /**
     * Get familyName.
     *
     * @return string
     */
    public function getFamilyName(): string {
        return $this->familyName;
    }
    /**
     * Get gender.
     *
     * @return Genders|null
     */
    public function getGender(): ?Genders {
        return $this->gender;
    }
    /**
     * Get givenName.
     *
     * @return string
     */
    public function getGivenName(): string {
        return $this->givenName;
    }
    /**
     * Get honorificPrefix.
     *
     * @return string|null
     */
    public function getHonorificPrefix(): ?string {
        return $this->honorificPrefix;
    }
    /**
     * Get honorificSuffix.
     *
     * @return string|null
     */
    public function getHonorificSuffix(): ?string {
        return $this->honorificSuffix;
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
     * Get phoneNumbers.
     *
     * @return Collection
     */
    public function getPhoneNumbers(): Collection {
        return $this->phoneNumbers;
    }
    /**
     * Get photo.
     *
     * @return PeoplePhotos|null
     */
    public function getPhoto(): ?PeoplePhotos {
        return $this->photo;
    }
    /**
     * Remove address.
     *
     * @param PeopleAddresses $address
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAddress(PeopleAddresses $address): bool {
        return $this->addresses->removeElement($address);
    }
    /**
     * Remove email.
     *
     * @param PeopleEmails $email
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEmail(PeopleEmails $email): bool {
        return $this->emails->removeElement($email);
    }
    /**
     * Remove phoneNumber.
     *
     * @param PeoplePhoneNumbers $phoneNumber
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePhoneNumber(PeoplePhoneNumbers $phoneNumber): bool {
        return $this->phoneNumbers->removeElement($phoneNumber);
    }
    /**
     * Set additionalName.
     *
     * @param string|null $additionalName
     *
     * @return People
     */
    public function setAdditionalName($additionalName = null): People {
        $this->additionalName = $additionalName;
        return $this;
    }
    /**
     * Set birthday.
     *
     * @param \DateTime|null $birthday
     *
     * @return People
     */
    public function setBirthday($birthday = null): People {
        $this->birthday = $birthday;
        return $this;
    }
    /**
     * Set familyName.
     *
     * @param string $familyName
     *
     * @return People
     */
    public function setFamilyName($familyName): People {
        $this->familyName = $familyName;
        return $this;
    }
    /**
     * Set gender.
     *
     * @param Genders|null $gender
     *
     * @return People
     */
    public function setGender(Genders $gender = null): People {
        $this->gender = $gender;
        return $this;
    }
    /**
     * Set givenName.
     *
     * @param string $givenName
     *
     * @return People
     */
    public function setGivenName($givenName): People {
        $this->givenName = $givenName;
        return $this;
    }
    /**
     * Set honorificPrefix.
     *
     * @param string|null $honorificPrefix
     *
     * @return People
     */
    public function setHonorificPrefix($honorificPrefix = null): People {
        $this->honorificPrefix = $honorificPrefix;
        return $this;
    }
    /**
     * Set honorificSuffix.
     *
     * @param string|null $honorificSuffix
     *
     * @return People
     */
    public function setHonorificSuffix($honorificSuffix = null): People {
        $this->honorificSuffix = $honorificSuffix;
        return $this;
    }
    /**
     * Set photo.
     *
     * @param PeoplePhotos|null $photo
     *
     * @return People
     */
    public function setPhoto(PeoplePhotos $photo = null): People {
        $this->photo = $photo;
        return $this;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="additional_name",
     *     type="string",
     *     length=255,
     *     nullable=true,
     *     options={"comment"="other (e.g. middle) name"}
     * )
     */
    private $additionalName;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleAddresses", mappedBy="person", fetch="EXTRA_LAZY")
     */
    private $addresses;
    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleEmails", mappedBy="person", fetch="EXTRA_LAZY")
     */
    private $emails;
    /**
     * @var string
     *
     * @ORM\Column(name="family_name",
     *     type="string",
     *     length=100,
     *     nullable=false,
     *     options={"comment"="family (often last) name"}
     * )
     */
    private $familyName;
    /**
     * @var Genders
     *
     * @ORM\ManyToOne(targetEntity="Genders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gender_id", referencedColumnName="id")
     * })
     */
    private $gender;
    /**
     * @var string
     *
     * @ORM\Column(name="given_name",
     *     type="string",
     *     length=100,
     *     nullable=false,
     *     options={"comment"="given (often first) name"}
     * )
     */
    private $givenName;
    /**
     * @var string|null
     *
     * @ORM\Column(name="honorific_prefix",
     *     type="string",
     *     length=50,
     *     nullable=true,
     *     options={"comment"="e.g. Mrs., Mr. or Dr."}
     * )
     */
    private $honorificPrefix;
    /**
     * @var string|null
     *
     * @ORM\Column(name="honorific_suffix",
     *     type="string",
     *     length=50,
     *     nullable=true,
     *     options={"comment"="e.g. Ph.D, Esq."}
     * )
     */
    private $honorificSuffix;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeoplePhoneNumbers", mappedBy="person", fetch="EXTRA_LAZY")
     */
    private $phoneNumbers;
    /**
     * @var PeoplePhotos
     *
     * @ORM\OneToOne(targetEntity="PeoplePhotos")
     * @ORM\JoinColumn(nullable=true)
     */
    private $photo;
}
