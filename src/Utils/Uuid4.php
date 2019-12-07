<?php
declare(strict_types=1);
/**
 * Contains trait Uuid4.
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

namespace PersonDBSkeleton\Utils;

/**
 * Trait Uuid4.
 */
trait Uuid4 {
    /**
     * Custom base 64 encoding of UUID v4 (random).
     *
     * Expected use will be in Doctrine entities instead of using auto-increment IDs.
     *
     * A UUID is 128-bits long in binary so most programming language can only
     * support it in some kind of string or integer array format. Most commonly
     * a binary string is used for compactness where strings can contain (nul)
     * chars. This format is rarely seen except in functions were the UUID is
     * being created as it's hard for programmers to work with since can't be
     * visualized easily. The normal formatted string version with 36
     * characters or as a hexadecimal string with 32 characters are much more
     * commonly used. Both of these formats trade off two times or more memory
     * use to make them easier to work with. Using a base 64 encoding only
     * increases the memory by less than 40 percent. So in summary these are
     * the benefits to using base 64 encoded format:
     *
     *   * Database compatible - Can be directly stored in any of VARCHAR,
     *     CHAR, BINARY, etc field types.
     *   * URL compatible - Doesn't contain any chars that require special
     *     escaping in URLs.
     *   * HTML compatible - Doesn't include any special chars that need to be
     *     escaped when used in html forms or tag property values. HTML 5
     *     relaxed the rule that required the id's property value had to start
     *     with a letter.
     *   * More Human readable - Base 64 being shorter that other formats
     *     generally make it more readable to most people.
     *   * Best memory to speed trade-off - The binary string takes up the
     *     least memory but it needs to be converted to and from other formats
     *     when using it in URLs etc. which can cause un-needed server load
     *     issues. The normal and hexadecimal forms are both longer which adds
     *     to both memory and server load issues.
     *
     * @param string|null $data Should normally be `null` to create a truly
     *                          random v4 UUID.
     *
     * @return string Returns custom base 64 encoded UUID v4 as string.
     * @throws \Exception Throws an Exception if it was not possible to gather
     * sufficient entropy in random_bytes().
     */
    protected function asBase64(?string $data = null): string {
        $data = $this->asBinString($data);
        $result = '';
        // Left pad to even number of 6 bits (132) for split.
        $binary = '0000' . $this->intoBinary($data);
        $sixBits = \str_split($binary, 6);
        foreach ($sixBits as $idx) {
            $result .= self::$base64[$idx];
        }
        return $result;
    }
    /**
     * Converts custom base 64 encoded UUID v4 back to binary string form.
     *
     * @param string $data
     *
     * @return string The returned string is actually a 128-bit binary string
     * as 16 characters (bytes).
     * @throws \InvalidArgumentException
     */
    protected function fromBase64ToBinString(string $data): string {
        // Left pad with 0s and truncate to max length of UUID in base 64.
        $data = \substr(\str_pad($data, 22, '0', \STR_PAD_LEFT), 22);
        $base64 = \array_flip(self::$base64);
        $result = '';
        $binary = '';
        // First convert to binary string.
        foreach (\str_split($data) as $idx) {
            if (\array_key_exists($idx, $base64)) {
                $binary .= $base64[$idx];
            } else {
                $mess = 'Invalid base 64 number given';
                throw new \InvalidArgumentException($mess);
            }
        }
        // Drop 4 left padding 0s to make 128 bits long again;
        $binary = \substr($binary, 4);
        // Finally convert into the binary string.
        foreach (\str_split($binary, 8) as $value) {
            $result .= \chr(\bindec($value));
        }
        return $result;
    }
    /**
     * Converts normal UUID v4 into custom base 64
     *
     * @param string $uuid
     *
     * @return string
     * @throws \Exception
     */
    protected function fromFullToBase64(string $uuid): string {
        $binary = \sodium_hex2bin($uuid, '{-}');
        return $this->asBase64($binary);
    }
    /**
     * Generates a random uuid in full format.
     *
     * Original code for the function was found in answer at
     * https://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid
     * by Arie which is based on a function found at
     * http://php.net/manual/en/function.com-create-guid.php
     * by pavel.volyntsev(at)gmail.
     * I've farther changed it to allow parameter to be optional based on comment
     * by Stephen R in the comment from the first page.
     *
     * Finally made it into a trait to make adding it to classes easier and renamed it as well.
     *
     * @param string|null $data Should normally be `null` to create a truly
     *                          random v4 UUID.
     *
     * @return string
     * @throws \Exception Throws an Exception if it was not possible to gather
     * sufficient entropy in random_bytes().
     */
    protected function uuid(?string $data = null): string {
        $data = $this->asBinString($data);
        return \vsprintf('%s%s-%s-%s-%s-%s%s%s', \str_split(\bin2hex($data), 4));
    }
    /**
     * Helper method for the common parts of creating new UUID in binary form.
     *
     * @param string|null $data Should normally be `null` to create a truly
     *                          random v4 UUID.
     *
     * @return string The returned string is actually a 128-bit binary string
     * as 16 characters (bytes).
     * @throws \Exception Throws an Exception if it was not possible to gather
     * sufficient entropy in random_bytes().
     */
    private function asBinString(?string $data = null): string {
        $data = $data ?? \random_bytes(16);
        // Left pad string to 16 chars using ascii code 0 if short else
        // truncate strings longer then 16 chars.
        $data = \substr(\str_pad($data, 16, \chr(0), \STR_PAD_LEFT), 0, 16);
        $data[6] = \chr(\ord($data[6]) & 0x0f | 0x40); // set version to 0100 (4 - random)
        $data[8] = \chr(\ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return $data;
    }
    /**
     * Converts long binary string (byte stream) into a series of 1s and 0s.
     *
     * Needed to work around 32/64-bit integer size limits found in PHP's
     * built-in functions like `decbin()`.
     *
     * @param string $data Long binary string to be converted.
     *
     * @return string Return to a series of 1s and 0s as a string.
     */
    private function intoBinary(string $data): string {
        $result = '';
        foreach (\str_split($data) as $byte) {
            $result .= \str_pad(\decbin(\ord($byte)), 8, '0', \STR_PAD_LEFT);
        }
        return $result;
    }
    /**
     * @var array $base64
     */
    private static $base64 = [
        '000000' => '0',
        '000001' => '1',
        '000010' => '2',
        '000011' => '3',
        '000100' => '4',
        '000101' => '5',
        '000110' => '6',
        '000111' => '7',
        '001000' => '8',
        '001001' => '9',
        '001010' => 'a',
        '001011' => 'b',
        '001100' => 'c',
        '001101' => 'd',
        '001110' => 'e',
        '001111' => 'f',
        '010000' => 'g',
        '010001' => 'h',
        '010010' => 'i',
        '010011' => 'j',
        '010100' => 'k',
        '010101' => 'l',
        '010110' => 'm',
        '010111' => 'n',
        '011000' => 'o',
        '011001' => 'p',
        '011010' => 'q',
        '011011' => 'r',
        '011100' => 's',
        '011101' => 't',
        '011110' => 'u',
        '011111' => 'v',
        '100000' => 'w',
        '100001' => 'x',
        '100010' => 'y',
        '100011' => 'z',
        '100100' => 'A',
        '100101' => 'B',
        '100110' => 'C',
        '100111' => 'D',
        '101000' => 'E',
        '101001' => 'F',
        '101010' => 'G',
        '101011' => 'H',
        '101100' => 'I',
        '101101' => 'J',
        '101110' => 'K',
        '101111' => 'L',
        '110000' => 'M',
        '110001' => 'N',
        '110010' => 'O',
        '110011' => 'P',
        '110100' => 'Q',
        '110101' => 'R',
        '110110' => 'S',
        '110111' => 'T',
        '111000' => 'U',
        '111001' => 'V',
        '111010' => 'W',
        '111011' => 'X',
        '111100' => 'Y',
        '111101' => 'Z',
        '111110' => '_',
        '111111' => '-',
    ];
}
