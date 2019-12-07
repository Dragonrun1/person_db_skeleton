<?php
declare(strict_types=1);
/**
 * Contains class Uuid64Generator.
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

namespace PersonDBSkeleton\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use PersonDBSkeleton\Utils\Uuid4;

/**
 * Class Uuid64Generator.
 */
class Uuid64Generator extends AbstractIdGenerator {
    use Uuid4;
    /**
     * Generates an identifier for an entity.
     *
     * @param EntityManager $em
     * @param object|null   $entity
     *
     * @return mixed
     * @throws \Exception
     */
    public function generate(EntityManager $em, $entity) {
        return $this->asBase64();
    }
}
