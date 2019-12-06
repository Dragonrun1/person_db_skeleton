<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

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
     * Get comment.
     *
     * @return string|null
     */
    public function getComment(): ?string {
        return $this->comment;
    }
    /**
     * Get email.
     *
     * @return Emails
     */
    public function getEmail(): Emails {
        return $this->email;
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
     * @return EmailTypes
     */
    public function getType(): EmailTypes {
        return $this->type;
    }
    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return PeopleEmails
     */
    public function setComment($comment = null): PeopleEmails {
        $this->comment = $comment;
        return $this;
    }
    /**
     * Set email.
     *
     * @param Emails $email
     *
     * @return PeopleEmails
     */
    public function setEmail(Emails $email): PeopleEmails {
        $this->email = $email;
        return $this;
    }
    /**
     * Set person.
     *
     * @param People $person
     *
     * @return PeopleEmails
     */
    public function setPerson(People $person): PeopleEmails {
        $this->person = $person;
        return $this;
    }
    /**
     * Set type.
     *
     * @param EmailTypes $type
     *
     * @return PeopleEmails
     */
    public function setType(EmailTypes $type): PeopleEmails {
        $this->type = $type;
        return $this;
    }
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
