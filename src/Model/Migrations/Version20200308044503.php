<?php
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308044503 extends AbstractVersion {
    public function down(Schema $schema): void {
        /** @noinspection NullPointerExceptionInspection */
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            case 'mysql':
                $this->downMysql();
                break;
            case 'postgresql':
                $this->downPostgresql();
                break;
            case 'sqlite':
                $this->downSqlite();
                break;
            default:
                $this->abortIf(true, 'Unknown or un-implemented platform for this migration');
        }
    }
    public function getDescription(): string {
        return 'Updates addresses table to allow null postal_code for physical addresses which do not use them.';
    }
    public function up(Schema $schema): void {
        /** @noinspection NullPointerExceptionInspection */
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            case 'mysql':
                $this->upMysql();
                break;
            case 'postgresql':
                $this->upPostgresql();
                break;
            case 'sqlite':
                $this->upSqlite();
                break;
            default:
                $this->abortIf(true, 'Unknown or un-implemented platform for this migration');
        }
    }
    private function downMysql(): void {
        $this->addSql(
        /** @lang MariaDB */
            'ALTER TABLE "addresses" CHANGE "postal_code" "postal_code" VARCHAR(30) CHARACTER SET "utf8mb4" NOT NULL COLLATE `utf8mb4_unicode_ci`'
        );
    }
    private function downPostgresql(): void {
        /** @noinspection SqlResolve */
        $this->addSql(/** @lang PostgreSQL */ 'ALTER TABLE "addresses" ALTER "postal_code" SET NOT NULL');
    }
    private function downSqlite(): void {
        $sql = /** @lang SQLite */
            <<<'SQL'
            PRAGMA foreign_keys=OFF;
            BEGIN TRANSACTION;
            CREATE TEMPORARY TABLE "__temp__addresses" AS
                SELECT "id", "country_name", "extended_address", "locality"
                     , "post_office_box", "postal_code", "region", "street_address"
                     , "created_at"
                FROM "addresses";
            DROP TABLE "addresses";
            CREATE TABLE "addresses" (
                "id" CHAR(22) NOT NULL --(DC2Type:uuid64)
                , "country_name" VARCHAR(50) NOT NULL COLLATE "BINARY"
                , "extended_address" VARCHAR(50) DEFAULT NULL COLLATE "BINARY"
                , "locality" VARCHAR(50) NOT NULL COLLATE "BINARY"
                , "post_office_box" VARCHAR(50) DEFAULT NULL COLLATE "BINARY"
                , "region" VARCHAR(50) DEFAULT NULL COLLATE "BINARY"
                , "street_address" VARCHAR(255) DEFAULT NULL COLLATE "BINARY"
                , "created_at" DATETIME NOT NULL --(DC2Type:datetime_immutable)
                , "postal_code" VARCHAR(30) NOT NULL COLLATE "BINARY"
                , PRIMARY KEY("id")
             ) WITHOUT ROWID;
            INSERT INTO "addresses"
                ("id", "country_name", "extended_address", "locality", "post_office_box", "postal_code", "region", "street_address", "created_at")
                SELECT "id", "country_name", "extended_address", "locality", "post_office_box", "postal_code", "region", "street_address", "created_at"
                FROM "__temp__addresses";
            DROP TABLE "__temp__addresses";
            COMMIT;
            PRAGMA foreign_keys=ON;
            SQL;
        $this->addSql($sql);
    }
    private function upMysql(): void {
        $this->addSql(
        /** @lang MariaDB */ 'ALTER TABLE "addresses" CHANGE "postal_code" "postal_code" VARCHAR(30) DEFAULT NULL'
        );
    }
    private function upPostgresql(): void {
        /** @noinspection SqlResolve */
        $this->addSql(/** @lang PostgreSQL */ 'ALTER TABLE "addresses" ALTER "postal_code" DROP NOT NULL');
    }
    private function upSqlite(): void {
        $sql = /** @lang SQLite */
            <<<'SQL'
            PRAGMA foreign_keys=OFF;
            BEGIN TRANSACTION;
            CREATE TEMPORARY TABLE "__temp__addresses" AS
                SELECT "id", "country_name", "extended_address", "locality"
                     , "post_office_box", "postal_code", "region", "street_address"
                     , "created_at"
                FROM "addresses";
            DROP TABLE "addresses";
            CREATE TABLE "addresses" (
                "id" CHAR(22) NOT NULL --(DC2Type:uuid64)
                , "country_name" VARCHAR(50) NOT NULL COLLATE "BINARY"
                , "extended_address" VARCHAR(50) DEFAULT NULL COLLATE "BINARY"
                , "locality" VARCHAR(50) NOT NULL COLLATE "BINARY"
                , "post_office_box" VARCHAR(50) DEFAULT NULL COLLATE "BINARY"
                , "region" VARCHAR(50) DEFAULT NULL COLLATE "BINARY"
                , "street_address" VARCHAR(255) DEFAULT NULL COLLATE "BINARY"
                , "created_at" DATETIME NOT NULL --(DC2Type:datetime_immutable)
                , "postal_code" VARCHAR(30) DEFAULT NULL
                , PRIMARY KEY("id")
             ) WITHOUT ROWID;
            INSERT INTO "addresses"
                ("id", "country_name", "extended_address", "locality", "post_office_box", "postal_code", "region", "street_address", "created_at")
                SELECT "id", "country_name", "extended_address", "locality", "post_office_box", "postal_code", "region", "street_address", "created_at"
                FROM "__temp__addresses";
            DROP TABLE "__temp__addresses";
            COMMIT;
            PRAGMA foreign_keys=ON;
            SQL;
        $this->addSql($sql);
    }
}
