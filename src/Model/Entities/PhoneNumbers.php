<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PersonDBSkeleton\Utils\Uuid4;

/**
 * PhoneNumbers
 *
 * @ORM\Table(name="phone_numbers")
 * @ORM\Entity(repositoryClass="PersonDBSkeleton\Model\Repositories\PhoneNumbers")
 */
class PhoneNumbers {
    use EntityCommon;
    use Uuid4;
    /**
     * PhoneNumbers constructor.
     *
     * @throws \Exception
     */
    public function __construct() {
        $this->createdAt = new \DateTimeImmutable();
        $this->id = $this->asBase64();
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
     * Delete (remove) person.
     *
     * @param PeoplePhoneNumbers $person
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function deletePerson(PeoplePhoneNumbers $person): bool {
        return $this->people->removeElement($person);
    }
    /**
     * Get people.
     *
     * @return Collection
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
