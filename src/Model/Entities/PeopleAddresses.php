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
 * Many to many join table for people and addresses.
 *
 * @ORM\Table(name="people_addresses", indexes={@ORM\Index(name="idx_pa_reverse", columns={"address_id", "person_id"}),
 *                                     @ORM\Index(name="idx_pa_type", columns={"type_id"}),
 *                                     @ORM\Index(name="idx_pa_address", columns={"address_id"}),
 *                                     @ORM\Index(name="idx_pa_person", columns={"person_id"})})
 * @ORM\Entity
 */
class PeopleAddresses {
    /**
     * PeopleAddresses constructor.
     *
     * @param People       $person
     * @param Addresses    $address
     * @param AddressTypes $type
     *
     * @throws \Exception
     */
    public function __construct(People $person, Addresses $address, AddressTypes $type) {
        $this->createdAt = new \DateTimeImmutable();
        $this->person = $person;
        $this->type = $type;
        $this->address = $address;
    }
    /**
     * Get address.
     *
     * @return Addresses
     */
    public function getAddress(): Addresses {
        return $this->address;
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
     * Get type.
     *
     * @return AddressTypes
     */
    public function getType(): AddressTypes {
        return $this->type;
    }
    /**
     * Set address.
     *
     * @param Addresses $address
     *
     * @return PeopleAddresses
     */
    public function setAddress(Addresses $address): PeopleAddresses {
        $this->address = $address;
        return $this;
    }
    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return PeopleAddresses
     */
    public function setComment($comment = null): PeopleAddresses {
        $this->comment = $comment;
        return $this;
    }
    /**
     * Set person.
     *
     * @param People $person
     *
     * @return PeopleAddresses
     */
    public function setPerson(People $person): PeopleAddresses {
        $this->person = $person;
        return $this;
    }
    /**
     * Set type.
     *
     * @param AddressTypes $type
     *
     * @return PeopleAddresses
     */
    public function setType(AddressTypes $type): PeopleAddresses {
        $this->type = $type;
        return $this;
    }
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
