<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * PeopleEmails
 *
 * @ORM\Table(name="people_emails", indexes={@ORM\Index(name="idx_pe_reverse", columns={"email_id", "person_id"}),
 *                                     @ORM\Index(name="idx_pe_type", columns={"type_id"}),
 *                                     @ORM\Index(name="idx_pe_email", columns={"email_id"}),
 *                                     @ORM\Index(name="idx_pe_person", columns={"person_id"})})
 * @ORM\Entity
 */
class PeopleEmails {
    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;
    /**
     * @var Emails
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Emails", inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     */
    private $email;
    /**
     * @var People
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="People", inversedBy="emails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;
    /**
     * @var EmailTypes
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="EmailTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;
}
