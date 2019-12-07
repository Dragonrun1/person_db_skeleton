<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\ORM\Mapping as ORM;
use PersonDBSkeleton\Utils\Uuid4;

/**
 * Genders
 *
 * @ORM\Table(
 *     name="genders",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="unq_g_gender", columns={"sex", "gender_identity"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="PersonDBSkeleton\Model\Repositories\GendersRepository")
 */
class Genders {
    use EntityCommon;
    use Uuid4;
    /**
     * Genders constructor.
     *
     * @throws \Exception
     */
    public function __construct() {
        $this->createdAt = new \DateTimeImmutable();
        $this->id = $this->asBase64();
    }
    /**
     * Get genderIdentity.
     *
     * @return string|null
     */
    public function getGenderIdentity(): ?string {
        return $this->genderIdentity;
    }
    /**
     * Get sex.
     *
     * @return string
     */
    public function getSex(): string {
        return $this->sex;
    }
    /**
     * Set genderIdentity.
     *
     * @param string|null $genderIdentity
     *
     * @return Genders
     */
    public function setGenderIdentity($genderIdentity = null): Genders {
        $this->genderIdentity = $genderIdentity;
        return $this;
    }
    /**
     * Set sex.
     *
     * @param string $sex
     *
     * @return Genders
     */
    public function setSex($sex): Genders {
        $this->sex = $sex;
        return $this;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="gender_identity", type="string", length=255, nullable=true)
     */
    private $genderIdentity;
    /**
     * @var string
     *
     * @ORM\Column(name="sex",
     *     type="string",
     *     length=10,
     *     nullable=false,
     *     options={"comment"="biological sex - One of Female, Male, Other, None/Not applicable, Unknown"}
     * )
     */
    private $sex;
}
