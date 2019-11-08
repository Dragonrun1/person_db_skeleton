<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * PeoplePhoneNumbers
 *
 * @ORM\Table(name="people_phone_numbers", indexes={
 *     @ORM\Index(name="idx_ppn_reverse", columns={"phone_id", "person_id"}),
 *     @ORM\Index(name="fk_ppn_type", columns={"type_id"}),
 *     @ORM\Index(name="idx_ppn_person", columns={"person_id"}),
 *     @ORM\Index(name="idx_ppn_phone", columns={"phone_id"})})
 * @ORM\Entity
 */
class PeoplePhoneNumbers {
    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;
    /**
     * @var People
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="People", inversedBy="phoneNumbers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;
    /**
     * @var PhoneNumbers
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="PhoneNumbers", inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     */
    private $phone;
    /**
     * @var PhoneTypes
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="PhoneTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;
}
