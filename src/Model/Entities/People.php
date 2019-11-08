<?php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * People
 *
 * @ORM\Table(name="people", indexes={
 *     @ORM\Index(name="fk_p_photo", columns={"photo_id"}),
 *     @ORM\Index(name="fk_p_gender", columns={"gender_id"})
 * })
 * @ORM\Entity
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
     *     length=50,
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
     *     length=50,
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
