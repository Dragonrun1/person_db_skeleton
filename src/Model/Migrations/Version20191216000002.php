<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Migrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216000002 extends AbstractVersion {
    /**
     * @param Schema $schema
     *
     * @throws DBALException
     */
    public function down(Schema $schema): void {
        /** @noinspection NullPointerExceptionInspection */
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            case 'mysql':
            case 'postgresql':
            case 'sqlite':
                $this->downCommon();
                break;
            default:
                $this->abortIf(true, 'Unknown or un-implemented platform for this migration');
        }
    }
    /**
     * @return string
     */
    public function getDescription(): string {
        return 'Add initial table data for common genders, pronouns, and types';
    }
    /**
     * @param Schema $schema
     *
     * @throws DBALException
     */
    public function up(Schema $schema): void {
        /** @noinspection NullPointerExceptionInspection */
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            case 'mysql':
            case 'postgresql':
            case 'sqlite':
                $this->upCommon();
                break;
            default:
                $this->abortIf(true, 'Unknown or un-implemented platform for this migration');
        }
    }
    private function downCommon(): void {
        // Genders
        $data = [
            [
                'id' => 'XNV_rXUFQvqQfvqJLSHP5w',
            ],
            [
                'id' => 'sFJPpw75SSmFiF1wnfbZVg',
            ],
        ];
        $sql = /** @lang SQL */
            <<<'SQL'
            DELETE FROM "genders" WHERE "id"=:id
            SQL;
        foreach ($data as $row) {
            $this->addSql($sql, $row);
        }
        // Pronouns
        $data = [
            [
                'id' => 'twPhMNLuTkG9HcZm59kyow',
            ],
            [
                'id' => 'B01Ij6SSS8OT5S0hoJdPcw',
            ],
            [
                'id' => 'pjKF25EwT_G2bnof7b5yJQ',
            ],
        ];
        $sql = /** @lang SQL */
            <<<'SQL'
            DELETE FROM  "pronouns" WHERE "id"=:id
            SQL;
        foreach ($data as $row) {
            $this->addSql($sql, $row);
        }
        // Types
        $data = [
            // AddressTypes
            [
                'id' => 'OYMKbQSnSZKS6FnuPBpnGQ',
            ],
            [
                'id' => 'YZjubx18SwOn2ol5Lz1DlQ',
            ],
            [
                'id' => '1gcmE2MkQFyq1Dkc13WXEQ',
            ],
            [
                'id' => '5zylXLX7QEeRlRt_QQbLDQ',
            ],
            // EmailTypes
            [
                'id' => 'rT6qHmTxTjWjaWbALTPr3Q',
            ],
            [
                'id' => 'tdhRWxqnTp2w-epgSF-Glg',
            ],
            // PhoneTypes
            [
                'id' => 'w8mrKr6-SRuwdd5tCmqzdw',
            ],
            [
                'id' => 'WZRMOCTVQGS8apLnELIFeA',
            ],
            [
                'id' => 'OnfCdIeVS5uvoOtg5dvy8Q',
            ],
            [
                'id' => 'tJ0fGZZdSZ6gp_Avw1FifA',
            ],
            [
                'id' => 'h71UD0yuQr2XU8EyaIYQUA',
            ],
            [
                'id' => 'kFZbGO_XSESlVZQUANknZQ',
            ],
            [
                'id' => 'F8inxYKIRX-2Ot6AvDc6aQ',
            ],
        ];
        $sql = /** @lang SQL */
            <<<'SQL'
            DELETE FROM  "types" WHERE "id"=:id
            SQL;
        foreach ($data as $row) {
            $this->addSql($sql, $row);
        }
    }
    private function upCommon(): void {
        // Genders
        $data = [
            [
                'id' => 'XNV_rXUFQvqQfvqJLSHP5w',
                'created_at' => '2019-12-16 00:00:01',
                'sex' => 'female',
            ],
            [
                'id' => 'sFJPpw75SSmFiF1wnfbZVg',
                'created_at' => '2019-12-16 00:00:01',
                'sex' => 'male',
            ],
        ];
        $sql = /** @lang SQL */
            <<<'SQL'
            INSERT INTO "genders"
                ("id", "created_at", "sex")
            VALUES (:id, :created_at, :sex)
            SQL;
        foreach ($data as $row) {
            $this->addSql($sql, $row);
        }
        // Pronouns
        $data = [
            [
                'id' => 'twPhMNLuTkG9HcZm59kyow',
                'created_at' => '2019-12-16 00:00:01',
                'subject' => 'she',
                'object' => 'her',
                'possessive' => 'hers',
            ],
            [
                'id' => 'B01Ij6SSS8OT5S0hoJdPcw',
                'created_at' => '2019-12-16 00:00:01',
                'subject' => 'he',
                'object' => 'him',
                'possessive' => 'his',
            ],
            [
                'id' => 'pjKF25EwT_G2bnof7b5yJQ',
                'created_at' => '2019-12-16 00:00:01',
                'subject' => 'they',
                'object' => 'them',
                'possessive' => 'theirs',
            ],
        ];
        $sql = /** @lang SQL */
            <<<'SQL'
            INSERT INTO "pronouns"
                ("id", "created_at", "subject", "object", "possessive")
            VALUES (:id, :created_at, :subject, :object, :possessive)
            SQL;
        foreach ($data as $row) {
            $this->addSql($sql, $row);
        }
        // Types
        $data = [
            // AddressTypes
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'OYMKbQSnSZKS6FnuPBpnGQ',
                'kind' => 'mailing',
                'class_name' => 'address',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'YZjubx18SwOn2ol5Lz1DlQ',
                'kind' => 'mailing work',
                'class_name' => 'address',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => '1gcmE2MkQFyq1Dkc13WXEQ',
                'kind' => 'physical',
                'class_name' => 'address',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => '5zylXLX7QEeRlRt_QQbLDQ',
                'kind' => 'physical work',
                'class_name' => 'address',
            ],
            // EmailTypes
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'rT6qHmTxTjWjaWbALTPr3Q',
                'kind' => 'personal',
                'class_name' => 'email',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'tdhRWxqnTp2w-epgSF-Glg',
                'kind' => 'work',
                'class_name' => 'email',
            ],
            // PhoneTypes
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'w8mrKr6-SRuwdd5tCmqzdw',
                'kind' => 'cell',
                'class_name' => 'phone',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'WZRMOCTVQGS8apLnELIFeA',
                'kind' => 'cell work',
                'class_name' => 'phone',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'OnfCdIeVS5uvoOtg5dvy8Q',
                'kind' => 'fax',
                'class_name' => 'phone',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'tJ0fGZZdSZ6gp_Avw1FifA',
                'kind' => 'fax work',
                'class_name' => 'phone',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'h71UD0yuQr2XU8EyaIYQUA',
                'kind' => 'home',
                'class_name' => 'phone',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'kFZbGO_XSESlVZQUANknZQ',
                'kind' => 'message',
                'class_name' => 'phone',
            ],
            [
                'created_at' => '2019-12-16 00:00:01',
                'id' => 'F8inxYKIRX-2Ot6AvDc6aQ',
                'kind' => 'work',
                'class_name' => 'phone',
            ],
        ];
        $sql = /** @lang SQL */
            <<<'SQL'
            INSERT INTO "types"
                ("id", "created_at", "kind", "class_name")
                VALUES (:id, :created_at, :kind, :class_name)
            SQL;
        foreach ($data as $row) {
            $this->addSql($sql, $row);
        }
    }
}
