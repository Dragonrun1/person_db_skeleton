<?php
declare(strict_types=1);
/**
 * Contains trait ArrayExceptionCommon.
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

namespace PersonDBSkeleton\Model\Repositories;

/**
 * Trait ArrayExceptionCommon.
 */
trait ArrayExceptionCommon {
    /**
     * @param \Throwable $thrown
     *
     * @return array
     */
    public function exceptionAsArray(\Throwable $thrown): array {
        return [
            'error' => [
                'message' => $thrown->getMessage(),
                'code' => $thrown->getCode(),
                'file' => $thrown->getFile(),
                'line' => $thrown->getLine(),
                'trace' => $thrown->getTrace(),
            ],
        ];
    }
}
