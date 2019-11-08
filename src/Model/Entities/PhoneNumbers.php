<?php

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PhoneNumbers
 *
 * @ORM\Table(name="phone_numbers")
 * @ORM\Entity
 */
class PhoneNumbers {
    /**
     * PhoneNumbers constructor.
     */
    public function __construct() {
        $this->people = new ArrayCollection();
    }
    /**
     * Add person.
     *
     * @param PeoplePhoneNumbers $person
     *
     * @return PhoneNumbers
     */
    public function addPerson(PeoplePhoneNumbers $person): PhoneNumbers {
        $this->people[] = $person;
        return $this;
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
     * Get people.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeople(): Collection {
        return $this->people;
    }
    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone(): string {
        return $this->phone;
    }
    /**
     * Remove person.
     *
     * @param PeoplePhoneNumbers $person
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePerson(PeoplePhoneNumbers $person): bool {
        return $this->people->removeElement($person);
    }
    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return PhoneNumbers
     */
    public function setPhone($phone): PhoneNumbers {
        $this->phone = $phone;
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
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeoplePhoneNumbers", mappedBy="phone", fetch="EXTRA_LAZY")
     */
    private $people;
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=false)
     */
    private $phone = '';
}
