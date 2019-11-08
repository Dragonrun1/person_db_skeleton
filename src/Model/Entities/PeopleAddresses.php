<?php
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
