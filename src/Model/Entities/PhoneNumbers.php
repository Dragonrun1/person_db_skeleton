<?php
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
