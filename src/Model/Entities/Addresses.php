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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PersonDBSkeleton\Utils\Uuid4;

/**
 * Addresses
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity(repositoryClass="PersonDBSkeleton\Model\Repositories\AddressesRepository")
 */
class Addresses {
    use EntityCommon;
    use Uuid4;
    /**
     * Addresses constructor.
     *
     * @param string $locality
     * @param string $countryName
     * @param string $postalCode
     *
     * @throws \Exception
     */
    public function __construct(string $locality, string $countryName, string $postalCode) {
        $this->createdAt = new \DateTimeImmutable();
        $this->id = $this->asBase64();
        $this->people = new ArrayCollection();
        $this->locality = $locality;
        $this->countryName = $countryName;
        $this->postalCode = $postalCode;
    }
    /**
     * Add person.
     *
     * @param PeopleAddresses $person
     *
     * @return Addresses
     */
    public function addPerson(PeopleAddresses $person): Addresses {
        $this->people[] = $person;
        return $this;
    }
    /**
     * Delete (remove) person.
     *
     * @param PeopleAddresses $person
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function deletePerson(PeopleAddresses $person): bool {
        return $this->people->removeElement($person);
    }
    /**
     * Get countryName.
     *
     * @return string
     */
    public function getCountryName(): string {
        return $this->countryName;
    }
    /**
     * Get extendedAddress.
     *
     * @return string|null
     */
    public function getExtendedAddress(): ?string {
        return $this->extendedAddress;
    }
    /**
     * Get locality.
     *
     * @return string
     */
    public function getLocality(): string {
        return $this->locality;
    }
    /**
     * Get people.
     *
     * @return Collection
     */
    public function getPeople(): Collection {
        return $this->people;
    }
    /**
     * Get postOfficeBox.
     *
     * @return string|null
     */
    public function getPostOfficeBox(): ?string {
        return $this->postOfficeBox;
    }
    /**
     * Get postalCode.
     *
     * @return string
     */
    public function getPostalCode(): string {
        return $this->postalCode;
    }
    /**
     * Get region.
     *
     * @return string
     */
    public function getRegion(): string {
        return $this->region;
    }
    /**
     * Get streetAddress.
     *
     * @return string|null
     */
    public function getStreetAddress(): ?string {
        return $this->streetAddress;
    }
    /**
     * Set countryName.
     *
     * @param string $countryName
     *
     * @return Addresses
     */
    public function setCountryName($countryName): Addresses {
        $this->countryName = $countryName;
        return $this;
    }
    /**
     * Set extendedAddress.
     *
     * @param string|null $extendedAddress
     *
     * @return Addresses
     */
    public function setExtendedAddress($extendedAddress = null): Addresses {
        $this->extendedAddress = $extendedAddress;
        return $this;
    }
    /**
     * Set locality.
     *
     * @param string $locality
     *
     * @return Addresses
     */
    public function setLocality($locality): Addresses {
        $this->locality = $locality;
        return $this;
    }
    /**
     * Set postOfficeBox.
     *
     * @param string|null $postOfficeBox
     *
     * @return Addresses
     */
    public function setPostOfficeBox($postOfficeBox = null): Addresses {
        $this->postOfficeBox = $postOfficeBox;
        return $this;
    }
    /**
     * Set postalCode.
     *
     * @param string $postalCode
     *
     * @return Addresses
     */
    public function setPostalCode($postalCode): Addresses {
        $this->postalCode = $postalCode;
        return $this;
    }
    /**
     * Set region.
     *
     * @param string $region
     *
     * @return Addresses
     */
    public function setRegion($region): Addresses {
        $this->region = $region;
        return $this;
    }
    /**
     * Set streetAddress.
     *
     * @param string|null $streetAddress
     *
     * @return Addresses
     */
    public function setStreetAddress($streetAddress = null): Addresses {
        $this->streetAddress = $streetAddress;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="country_name", type="string", length=50, nullable=false, options={"comment"="country name"})
     */
    private $countryName;
    /**
     * @var string|null
     *
     * @ORM\Column(name="extended_address",
     *     type="string",
     *     length=50,
     *     nullable=true,
     *     options={"comment"="apartment/suite/room name/number if any"}
     * )
     */
    private $extendedAddress;
    /**
     * @var string
     *
     * @ORM\Column(name="locality",
     *     type="string",
     *     length=50,
     *     nullable=false,
     *     options={"comment"="city/town/village"}
     * )
     */
    private $locality;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleAddresses", mappedBy="address", fetch="EXTRA_LAZY")
     */
    private $people;
    /**
     * @var string|null
     *
     * @ORM\Column(name="post_office_box",
     *     type="string",
     *     length=50,
     *     nullable=true,
     *     options={"comment"="post office box description if any"}
     * )
     */
    private $postOfficeBox;
    /**
     * @var string
     *
     * @ORM\Column(name="postal_code",
     *     type="string",
     *     length=30,
     *     nullable=false,
     *     options={"comment"="postal code, e.g. US ZIP"}
     * )
     */
    private $postalCode;
    /**
     * @var string|null
     *
     * @ORM\Column(name="region",
     *     type="string",
     *     length=50,
     *     nullable=true,
     *     options={"comment"="state/county/province"}
     * )
     */
    private $region;
    /**
     * @var string|null
     *
     * @ORM\Column(name="street_address",
     *     type="string",
     *     length=255,
     *     nullable=true,
     *     options={"comment"="street number + name"}
     * )
     */
    private $streetAddress;
}
