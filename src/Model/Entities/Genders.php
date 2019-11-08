<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * Genders
 *
 * @ORM\Table(name="genders", uniqueConstraints={@ORM\UniqueConstraint(name="unq_g_gender", columns={"sex", "gender_identity"})})
 * @ORM\Entity
 */
class Genders {
    /**
     * @var string|null
     *
     * @ORM\Column(name="gender_identity", type="string", length=255, nullable=true)
     */
    private $genderIdentity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=10, nullable=false, options={"comment"="biological sex - One of
     *                         Female, Male, Other, None/Not applicable, Unknown"})
     */
    private $sex;
}
