<?php
declare(strict_types=1);
/**
 *
 * PHP version 7.3
 *
 * LICENSE:
 * This file is part of person_db_skeleton which is a set of skeleton database
 * tables for people and common associated data.
 *
 * Copyright (C) 2019 Michael Cummings. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation and/or
 * other materials provided with the distribution.
 *
 * 3. Neither the name of the copyright holder nor the names of its contributors
 * may be used to endorse or promote products derived from this software without
 * specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * You should have received a copy of the BSD-3 Clause License along with
 * this program. If not, see
 * <https://spdx.org/licenses/BSD-3-Clause.html>.
 *
 * You should be able to find a copy of this license in the LICENSE file.
 *
 * @author    Michael Cummings <mgcummings@yahoo.com>
 * @copyright 2019 Michael Cummings
 * @license   BSD-3-Clause
 */

namespace PersonDBSkeleton\Model\Entities;

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
     * PeoplePhoneNumbers constructor.
     *
     * @param People       $person
     * @param PhoneNumbers $phone
     * @param PhoneTypes   $type
     *
     * @throws \Exception
     */
    public function __construct(People $person, PhoneNumbers $phone, PhoneTypes $type) {
        $this->createdAt = new \DateTimeImmutable();
        $this->person = $person;
        $this->phone = $phone;
        $this->type = $type;
    }
    /**
     * Get comment.
     *
     * @return string|null
     */
    public function getComment(): ?string {
        return $this->comment;
    }
    /**
     * Date and time when entity was created.
     *
     * Note:
     * Doctrine often will return date-times as plain string instead of correct
     * object so this method will correct it when called.
     *
     * @return \DateTimeImmutable
     * @throws \Exception
     */
    public function getCreatedAt(): \DateTimeImmutable {
        if (!$this->createdAt instanceof \DateTimeImmutable) {
            $this->createdAt = new \DateTimeImmutable($this->createdAt);
        }
        return $this->createdAt;
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
     * Get phone.
     *
     * @return PhoneNumbers
     */
    public function getPhone(): PhoneNumbers {
        return $this->phone;
    }
    /**
     * Get type.
     *
     * @return PhoneTypes
     */
    public function getType(): PhoneTypes {
        return $this->type;
    }
    /**
     * @param string|null $value
     *
     * @return self Fluent interface
     */
    public function setComment(?string $value): self {
        $this->comment = $value;
        return $this;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="created_at", type="datetime_immutable", nullable=false)
     */
    private $createdAt;
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
     * @ORM\ManyToOne(targetEntity="PhoneTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;
}
