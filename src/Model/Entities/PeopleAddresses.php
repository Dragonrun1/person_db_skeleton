<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeopleAddresses
 *
 * @ORM\Table(name="people_addresses", indexes={@ORM\Index(name="idx_pa_reverse", columns={"address_id", "person_id"}),
 *                                     @ORM\Index(name="idx_pa_type", columns={"type_id"}),
 *                                     @ORM\Index(name="idx_pa_address", columns={"address_id"}),
 *                                     @ORM\Index(name="idx_pa_person", columns={"person_id"})})
 * @ORM\Entity
 */
class PeopleAddresses {
    /**
     * PeopleAddresses constructor.
     *
     * @param People       $person
     * @param Addresses    $address
     * @param AddressTypes $type
     *
     * @throws \Exception
     */
    public function __construct(People $person, Addresses $address, AddressTypes $type) {
//        $this->createdAt = new \DateTimeImmutable();
        $this->address = $address;
        $this->person = $person;
        $this->type = $type;
    }
    /**
     * Get address.
     *
     * @return Addresses
     */
    public function getAddress(): Addresses {
        return $this->address;
    }
    /**
     * Get comment.
     *
     * @return string|null
     */
    public function getComment(): ?string {
        return $this->comment;
    }
    /**
     * Date and time when entity was created.
     *
     * Note:
     * Doctrine often will return date-times as plain string instead of correct
     * object so this method will correct it when called.
     *
     * @return \DateTimeImmutable
     * @throws \Exception
     */
    public function getCreatedAt(): \DateTimeImmutable {
        if (!$this->createdAt instanceof \DateTimeImmutable) {
            $this->createdAt = new \DateTimeImmutable($this->createdAt);
        }
        return $this->createdAt;
    }
    /**
     * Get person.
     *
     * @return People
     */
    public function getPerson(): People {
        return $this->person;
    }
    /**
     * Get type.
     *
     * @return AddressTypes
     */
    public function getType(): AddressTypes {
        return $this->type;
    }
    /**
     * Set address.
     *
     * @param Addresses $address
     *
     * @return PeopleAddresses
     */
    public function setAddress(Addresses $address): PeopleAddresses {
        $this->address = $address;
        return $this;
    }
    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return PeopleAddresses
     */
    public function setComment($comment = null): PeopleAddresses {
        $this->comment = $comment;
        return $this;
    }
    /**
     * Set person.
     *
     * @param People $person
     *
     * @return PeopleAddresses
     */
    public function setPerson(People $person): PeopleAddresses {
        $this->person = $person;
        return $this;
    }
    /**
     * Set type.
     *
     * @param AddressTypes $type
     *
     * @return PeopleAddresses
     */
    public function setType(AddressTypes $type): PeopleAddresses {
        $this->type = $type;
        return $this;
    }
    /**
     * @var Addresses
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Addresses", inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     */
    private $address;
    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="created_at", type="datetime_immutable", nullable=false)
     */
    private $createdAt;
    /**
     * @var People
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="People", inversedBy="addresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;
    /**
     * @var AddressTypes
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="AddressTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;
}
