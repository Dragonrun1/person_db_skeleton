<?php
declare(strict_types=1);
/**
 * Contains trait EntityCommon.
 *
 * PHP version 7.3
 *
 * LICENSE:
 * This file is part of person_db_skeleton which is a set of skeleton database
 * tables for people and common associated data.
 * Copyright (C) 2019 Michael Cummings
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, version 2 of the License.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see
 * <http://spdx.org/licenses/GPL-2.0.html>.
 *
 * You should be able to find a copy of this license in the LICENSE file.
 *
 * @author    Michael Cummings <mgcummings@yahoo.com>
 * @copyright 2019 Michael Cummings
 * @license   GPL-2.0
 */

namespace PersonDBSkeleton\Model\Entities;

/**
 * Trait of common entity properties, their getters, and generic JSON Serializing.
 *
 * Used in composition pattern vs inherits model with classes.
 */
trait EntityCommon {
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
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }
    /**
     * Simple entity JSON serializer implementation.
     *
     * Should be usable directly by most Doctrine Entity classes without
     * overriding.
     *
     * @return array
     */
    public function jsonSerialize(): array {
        $result = [];
        foreach ($this as $k => $v) {
            if ($v instanceof \DateTimeInterface) {
                $v = $v->format('Y-m-d\TH:i:sO');
            }
            $result[$k] = $v;
        }
        // Filter out any unneeded Doctrine Entity Proxy c**p.
        unset($result['__initializer__'], $result['__cloner__'], $result['__isInitialized__']);
        // Filter sensitive properties.
        /** @noinspection UnsetConstructsCanBeMergedInspection */
        unset($result['password']);
        // Filter out redundant patient.
        //unset($result['patient']);
        return $result;
    }
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="created_at", type="datetime_immutable", nullable=false)
     */
    private $createdAt;
    /**
     * @var string
     *
     * @ORM\Column(type="uuid64", nullable=false, options={"fixed":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="PersonDBSkeleton\Model\Uuid64Generator")
     */
    private $id;
}
