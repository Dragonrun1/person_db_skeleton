<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace PersonDBSkeleton\Model\Migrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216000001 extends AbstractVersion {
    /**
     * @param Schema $schema
     *
     * @throws DBALException
     */
    public function down(Schema $schema): void {
        /** @noinspection NullPointerExceptionInspection */
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            // Yes they are the same with MySQL in ANSI mode.
            case 'mysql':
            case 'postgresql':
                $this->downDropForeignKeys();
                $this->downDropTables();
                break;
            case 'sqlite':
                $this->downDropTables();
                break;
            default:
                $this->abortIf(true, 'Unknown or un-implemented platform for this migration');
        }
    }
    /**
     * @return string
     */
    public function getDescription(): string {
        return 'Person DB Skeleton Initial Migration';
    }
    /**
     * @return bool
     */
    public function isTransactional(): bool {
        return false;
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
                $this->upMysql();
                $this->upAddForeignKeys();
                break;
            case 'postgresql':
                $this->upPostgresql();
                $this->upAddForeignKeys();
                break;
            case 'sqlite':
                $this->upSqlite();
                break;
            default:
                $this->abortIf(true, 'Unknown or un-implemented platform for this migration');
        }
    }
    private function downDropForeignKeys(): void {
        $sql = /** @lang SQL */
            <<<'SQL'
        ALTER TABLE "people"
            DROP FOREIGN KEY "FK_28166A26708A0E0";
        ALTER TABLE "people"
            DROP FOREIGN KEY "FK_28166A267E9E4C8C";
        ALTER TABLE "people"
            DROP FOREIGN KEY "FK_28166A2693BDCD30";
        ALTER TABLE "people_addresses"
            DROP FOREIGN KEY "FK_EFDEE3F1217BBB47";
        ALTER TABLE "people_addresses"
            DROP FOREIGN KEY "FK_EFDEE3F1C54C8C93";
        ALTER TABLE "people_addresses"
            DROP FOREIGN KEY "FK_EFDEE3F1F5B7AF75";
        ALTER TABLE "people_emails"
            DROP FOREIGN KEY "FK_3A96CAB8217BBB47";
        ALTER TABLE "people_emails"
            DROP FOREIGN KEY "FK_3A96CAB8A832C1C9";
        ALTER TABLE "people_emails"
            DROP FOREIGN KEY "FK_3A96CAB8C54C8C93";
        ALTER TABLE "people_phone_numbers"
            DROP FOREIGN KEY "FK_96FCAF7D217BBB47";
        ALTER TABLE "people_phone_numbers"
            DROP FOREIGN KEY "FK_96FCAF7D3B7323CB";
        ALTER TABLE "people_phone_numbers"
            DROP FOREIGN KEY "FK_96FCAF7DC54C8C93";
        SQL;
        $this->executeSQL($sql);
    }
    private function downDropTables(): void {
        $sql = /** @lang SQL */
            <<<'SQL'
            DROP TABLE "addresses";
            DROP TABLE "emails";
            DROP TABLE "genders";
            DROP TABLE "people";
            DROP TABLE "people_addresses";
            DROP TABLE "people_emails";
            DROP TABLE "people_phone_numbers";
            DROP TABLE "people_photos";
            DROP TABLE "phone_numbers";
            DROP TABLE "pronouns";
            DROP TABLE "types";
            SQL;
        $this->executeSQL($sql);
    }
    private function upAddForeignKeys(): void {
        $sql = /** @lang SQL */
            <<<'SQL'
        ALTER TABLE "people"
            ADD CONSTRAINT "FK_28166A26708A0E0" FOREIGN KEY ("gender_id") REFERENCES "genders" ("id");
        ALTER TABLE "people"
            ADD CONSTRAINT "FK_28166A267E9E4C8C" FOREIGN KEY ("photo_id") REFERENCES "people_photos" ("id");
        ALTER TABLE "people"
            ADD CONSTRAINT "FK_28166A2693BDCD30" FOREIGN KEY ("pronoun_id") REFERENCES "pronouns" ("id");
        ALTER TABLE "people_addresses"
            ADD CONSTRAINT "FK_EFDEE3F1F5B7AF75" FOREIGN KEY ("address_id") REFERENCES "addresses" ("id");
        ALTER TABLE "people_addresses"
            ADD CONSTRAINT "FK_EFDEE3F1217BBB47" FOREIGN KEY ("person_id") REFERENCES "people" ("id");
        ALTER TABLE "people_addresses"
            ADD CONSTRAINT "FK_EFDEE3F1C54C8C93" FOREIGN KEY ("type_id") REFERENCES "types" ("id");
        ALTER TABLE "people_emails"
            ADD CONSTRAINT "FK_3A96CAB8A832C1C9" FOREIGN KEY ("email_id") REFERENCES "emails" ("id");
        ALTER TABLE "people_emails"
            ADD CONSTRAINT "FK_3A96CAB8217BBB47" FOREIGN KEY ("person_id") REFERENCES "people" ("id");
        ALTER TABLE "people_emails"
            ADD CONSTRAINT "FK_3A96CAB8C54C8C93" FOREIGN KEY ("type_id") REFERENCES "types" ("id");
        ALTER TABLE "people_phone_numbers"
            ADD CONSTRAINT "FK_96FCAF7D217BBB47" FOREIGN KEY ("person_id") REFERENCES "people" ("id");
        ALTER TABLE "people_phone_numbers"
            ADD CONSTRAINT "FK_96FCAF7D3B7323CB" FOREIGN KEY ("phone_id") REFERENCES "phone_numbers" ("id");
        ALTER TABLE "people_phone_numbers"
            ADD CONSTRAINT "FK_96FCAF7DC54C8C93" FOREIGN KEY ("type_id") REFERENCES "types" ("id");
        SQL;
        $this->executeSQL($sql);
    }
    /**
     *
     */
    private function upMysql(): void {
        $sql = /** @lang MySQL */
            <<<'SQL'
        CREATE TABLE "types"
        (
            "id"         CHAR(22)     NOT NULL COMMENT '(DC2Type:uuid64)',
            "kind"       VARCHAR(50)  NOT NULL,
            "created_at" DATETIME     NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            "class_name" VARCHAR(255) NOT NULL,
            UNIQUE INDEX "unq_t_class_kind" ("class_name", "kind"),
            PRIMARY KEY ("id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "addresses"
        (
            "id"               CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
            "country_name"     VARCHAR(50) NOT NULL,
            "extended_address" VARCHAR(50)  DEFAULT NULL,
            "locality"         VARCHAR(50) NOT NULL,
            "post_office_box"  VARCHAR(50)  DEFAULT NULL,
            "postal_code"      VARCHAR(30) NOT NULL,
            "region"           VARCHAR(50)  DEFAULT NULL,
            "street_address"   VARCHAR(255) DEFAULT NULL,
            "created_at"       DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            PRIMARY KEY ("id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "emails"
        (
            "id"         CHAR(22)     NOT NULL COMMENT '(DC2Type:uuid64)',
            "email"      VARCHAR(255) NOT NULL,
            "created_at" DATETIME     NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            PRIMARY KEY ("id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "genders"
        (
            "id"              CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
            "gender_identity" VARCHAR(255) DEFAULT NULL,
            "sex"             VARCHAR(10) NOT NULL,
            "created_at"      DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            UNIQUE INDEX "unq_g_gender" ("sex", "gender_identity"),
            PRIMARY KEY ("id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "people"
        (
            "id"               CHAR(22)     NOT NULL COMMENT '(DC2Type:uuid64)',
            "gender_id"        CHAR(22)     DEFAULT NULL COMMENT '(DC2Type:uuid64)',
            "photo_id"         CHAR(22)     DEFAULT NULL COMMENT '(DC2Type:uuid64)',
            "pronoun_id"       CHAR(22)     DEFAULT NULL COMMENT '(DC2Type:uuid64)',
            "additional_name"  VARCHAR(255) DEFAULT NULL,
            "birthday"         DATETIME     DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
            "family_name"      VARCHAR(100) NOT NULL,
            "given_name"       VARCHAR(100) NOT NULL,
            "honorific_prefix" VARCHAR(50)  DEFAULT NULL,
            "honorific_suffix" VARCHAR(50)  DEFAULT NULL,
            "created_at"       DATETIME     NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            INDEX "idx_p_family_name" ("family_name"),
            INDEX "fk_p_gender" ("gender_id"),
            INDEX "fk_p_pronoun" ("pronoun_id"),
            UNIQUE INDEX "unq_p_photo" ("photo_id"),
            PRIMARY KEY ("id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "people_addresses"
        (
            "address_id" CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "person_id"  CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "type_id"    CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "comment"    TEXT DEFAULT NULL,
            "created_at" DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            INDEX "idx_pa_reverse" ("address_id", "person_id"),
            INDEX "idx_pa_type" ("type_id"),
            INDEX "idx_pa_address" ("address_id"),
            INDEX "idx_pa_person" ("person_id"),
            UNIQUE INDEX "unq_pa_person_type" ("person_id", "type_id"),
            PRIMARY KEY ("address_id", "person_id", "type_id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "people_emails"
        (
            "email_id"   CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "person_id"  CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "type_id"    CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "comment"    TEXT DEFAULT NULL,
            "created_at" DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            INDEX "idx_pe_reverse" ("email_id", "person_id"),
            INDEX "idx_pe_type" ("type_id"),
            INDEX "idx_pe_email" ("email_id"),
            INDEX "idx_pe_person" ("person_id"),
            UNIQUE INDEX "unq_pe_person_type" ("person_id", "type_id"),
            PRIMARY KEY ("email_id", "person_id", "type_id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "people_phone_numbers"
        (
            "person_id"  CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "phone_id"   CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "type_id"    CHAR(22) NOT NULL COMMENT '(DC2Type:uuid64)',
            "comment"    TEXT DEFAULT NULL,
            "created_at" DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            INDEX "idx_ppn_reverse" ("phone_id", "person_id"),
            INDEX "idx_ppn_type" ("type_id"),
            INDEX "idx_ppn_person" ("person_id"),
            INDEX "idx_ppn_phone" ("phone_id"),
            UNIQUE INDEX "unq_ppn_person_type" ("person_id", "type_id"),
            PRIMARY KEY ("person_id", "phone_id", "type_id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "people_photos"
        (
            "id"         CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
            "mime_type"  VARCHAR(50) NOT NULL,
            "photo"      MEDIUMBLOB  NOT NULL,
            "created_at" DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            PRIMARY KEY ("id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "phone_numbers"
        (
            "id"         CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
            "phone"      VARCHAR(30) NOT NULL,
            "created_at" DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            PRIMARY KEY ("id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE TABLE "pronouns"
        (
            "id"         CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
            "object"     VARCHAR(10) NOT NULL,
            "possessive" VARCHAR(10) NOT NULL,
            "subject"    VARCHAR(10) NOT NULL,
            "created_at" DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
            PRIMARY KEY ("id")
        ) DEFAULT CHARACTER SET "utf8mb4"
          COLLATE 'utf8mb4_unicode_ci'
          ENGINE = InnoDB;
        CREATE UNIQUE INDEX "unq_pr_pronouns" ON "pronouns" ("subject", "object", "possessive");
        SQL;
        $this->executeSQL($sql);
    }
    /**
     *
     */
    private function upPostgresql(): void {
        $sql = /** @lang PostgreSQL */
            <<<'SQL'
        CREATE TABLE "types"
        (
            "id"         CHAR(22)                       NOT NULL,
            "kind"       VARCHAR(50)                    NOT NULL,
            "created_at" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            "class_name" VARCHAR(255)                   NOT NULL,
            PRIMARY KEY ("id")
        );
        CREATE UNIQUE INDEX "unq_t_class_kind" ON "types" ("class_name", "kind");
        COMMENT ON COLUMN "types"."id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "types"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "addresses"
        (
            "id"               CHAR(22)                       NOT NULL,
            "country_name"     VARCHAR(50)                    NOT NULL,
            "extended_address" VARCHAR(50)  DEFAULT NULL,
            "locality"         VARCHAR(50)                    NOT NULL,
            "post_office_box"  VARCHAR(50)  DEFAULT NULL,
            "postal_code"      VARCHAR(30)                    NOT NULL,
            "region"           VARCHAR(50)  DEFAULT NULL,
            "street_address"   VARCHAR(255) DEFAULT NULL,
            "created_at"       TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("id")
        );
        COMMENT ON COLUMN "addresses"."id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "addresses"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "emails"
        (
            "id"         CHAR(22)                       NOT NULL,
            "email"      VARCHAR(255)                   NOT NULL,
            "created_at" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("id")
        );
        COMMENT ON COLUMN "emails"."id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "emails"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "genders"
        (
            "id"              CHAR(22)                       NOT NULL,
            "gender_identity" VARCHAR(255) DEFAULT NULL,
            "sex"             VARCHAR(10)                    NOT NULL,
            "created_at"      TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("id")
        );
        CREATE UNIQUE INDEX "unq_g_gender" ON "genders" ("sex", "gender_identity");
        COMMENT ON COLUMN "genders"."id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "genders"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "people"
        (
            "id"               CHAR(22)                       NOT NULL,
            "gender_id"        CHAR(22)                       DEFAULT NULL,
            "photo_id"         CHAR(22)                       DEFAULT NULL,
            "pronoun_id"       CHAR(22)                       DEFAULT NULL,
            "additional_name"  VARCHAR(255)                   DEFAULT NULL,
            "birthday"         TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
            "family_name"      VARCHAR(100)                   NOT NULL,
            "given_name"       VARCHAR(100)                   NOT NULL,
            "honorific_prefix" VARCHAR(50)                    DEFAULT NULL,
            "honorific_suffix" VARCHAR(50)                    DEFAULT NULL,
            "created_at"       TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("id")
        );
        CREATE INDEX "idx_p_family_name" ON "people" ("family_name");
        CREATE INDEX "fk_p_gender" ON "people" ("gender_id");
        CREATE INDEX "fk_p_pronoun" ON "people" ("pronoun_id");
        CREATE UNIQUE INDEX "unq_p_photo" ON "people" ("photo_id");
        COMMENT ON COLUMN "people"."id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people"."gender_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people"."photo_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people"."pronoun_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people"."birthday" IS '(DC2Type:datetime_immutable)';
        COMMENT ON COLUMN "people"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "people_addresses"
        (
            "address_id" CHAR(22)                       NOT NULL,
            "person_id"  CHAR(22)                       NOT NULL,
            "type_id"    CHAR(22)                       NOT NULL,
            "comment"    TEXT DEFAULT NULL,
            "created_at" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("address_id", "person_id", "type_id")
        );
        CREATE INDEX "idx_pa_reverse" ON "people_addresses" ("address_id", "person_id");
        CREATE INDEX "idx_pa_type" ON "people_addresses" ("type_id");
        CREATE INDEX "idx_pa_address" ON "people_addresses" ("address_id");
        CREATE INDEX "idx_pa_person" ON "people_addresses" ("person_id");
        CREATE UNIQUE INDEX "unq_pa_person_type" ON "people_addresses" ("person_id", "type_id");
        COMMENT ON COLUMN "people_addresses"."address_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_addresses"."person_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_addresses"."type_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_addresses"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "people_emails"
        (
            "email_id"   CHAR(22)                       NOT NULL,
            "person_id"  CHAR(22)                       NOT NULL,
            "type_id"    CHAR(22)                       NOT NULL,
            "comment"    TEXT DEFAULT NULL,
            "created_at" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("email_id", "person_id", "type_id")
        );
        CREATE INDEX "idx_pe_reverse" ON "people_emails" ("email_id", "person_id");
        CREATE INDEX "idx_pe_type" ON "people_emails" ("type_id");
        CREATE INDEX "idx_pe_email" ON "people_emails" ("email_id");
        CREATE INDEX "idx_pe_person" ON "people_emails" ("person_id");
        CREATE UNIQUE INDEX "unq_pe_person_type" ON "people_emails" ("person_id", "type_id");
        COMMENT ON COLUMN "people_emails"."email_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_emails"."person_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_emails"."type_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_emails"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "people_phone_numbers"
        (
            "person_id"  CHAR(22)                       NOT NULL,
            "phone_id"   CHAR(22)                       NOT NULL,
            "type_id"    CHAR(22)                       NOT NULL,
            "comment"    TEXT DEFAULT NULL,
            "created_at" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("person_id", "phone_id", "type_id")
        );
        CREATE INDEX "idx_ppn_reverse" ON "people_phone_numbers" ("phone_id", "person_id");
        CREATE INDEX "idx_ppn_type" ON "people_phone_numbers" ("type_id");
        CREATE INDEX "idx_ppn_person" ON "people_phone_numbers" ("person_id");
        CREATE INDEX "idx_ppn_phone" ON "people_phone_numbers" ("phone_id");
        CREATE UNIQUE INDEX "unq_ppn_person_type" ON "people_phone_numbers" ("person_id", "type_id");
        COMMENT ON COLUMN "people_phone_numbers"."person_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_phone_numbers"."phone_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_phone_numbers"."type_id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_phone_numbers"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "people_photos"
        (
            "id"         CHAR(22)                       NOT NULL,
            "mime_type"  VARCHAR(50)                    NOT NULL,
            "photo"      BYTEA                          NOT NULL,
            "created_at" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("id")
        );
        COMMENT ON COLUMN "people_photos"."id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "people_photos"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "phone_numbers"
        (
            "id"         CHAR(22)                       NOT NULL,
            "phone"      VARCHAR(30)                    NOT NULL,
            "created_at" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("id")
        );
        COMMENT ON COLUMN "phone_numbers"."id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "phone_numbers"."created_at" IS '(DC2Type:datetime_immutable)';
        CREATE TABLE "pronouns"
        (
            "id"         CHAR(22)                       NOT NULL,
            "object"     VARCHAR(10)                    NOT NULL,
            "possessive" VARCHAR(10)                    NOT NULL,
            "subject"    VARCHAR(10)                    NOT NULL,
            "created_at" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            PRIMARY KEY ("id")
        );
        CREATE UNIQUE INDEX "unq_pr_pronouns" ON "pronouns" ("subject", "object", "possessive");
        COMMENT ON COLUMN "pronouns"."id" IS '(DC2Type:uuid64)';
        COMMENT ON COLUMN "pronouns"."created_at" IS '(DC2Type:datetime_immutable)';
        SQL;
        $this->executeSQL($sql);
    }
    /**
     *
     */
    private function upSqlite(): void {
        $sql = /** @lang SQLite */
            <<<'SQL'
        CREATE TABLE "types"
        (
            "id"         CHAR(22)     NOT NULL --(DC2Type:uuid64)
            ,
            "kind"       VARCHAR(50)  NOT NULL,
            "created_at" DATETIME     NOT NULL --(DC2Type:datetime_immutable)
            ,
            "class_name" VARCHAR(255) NOT NULL,
            PRIMARY KEY ("id")
        );
        CREATE UNIQUE INDEX "unq_t_class_kind" ON "types" ("class_name", "kind");
        CREATE TABLE "addresses"
        (
            "id"               CHAR(22)    NOT NULL --(DC2Type:uuid64)
            ,
            "country_name"     VARCHAR(50) NOT NULL,
            "extended_address" VARCHAR(50)  DEFAULT NULL,
            "locality"         VARCHAR(50) NOT NULL,
            "post_office_box"  VARCHAR(50)  DEFAULT NULL,
            "postal_code"      VARCHAR(30) NOT NULL,
            "region"           VARCHAR(50)  DEFAULT NULL,
            "street_address"   VARCHAR(255) DEFAULT NULL,
            "created_at"       DATETIME    NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("id")
        );
        CREATE TABLE "emails"
        (
            "id"         CHAR(22)     NOT NULL --(DC2Type:uuid64)
            ,
            "email"      VARCHAR(255) NOT NULL,
            "created_at" DATETIME     NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("id")
        );
        CREATE TABLE "genders"
        (
            "id"              CHAR(22)    NOT NULL --(DC2Type:uuid64)
            ,
            "gender_identity" VARCHAR(255) DEFAULT NULL,
            "sex"             VARCHAR(10) NOT NULL,
            "created_at"      DATETIME    NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("id")
        );
        CREATE UNIQUE INDEX "unq_g_gender" ON "genders" ("sex", "gender_identity");
        CREATE TABLE "people"
        (
            "id"               CHAR(22)     NOT NULL     --(DC2Type:uuid64)
            ,
            "additional_name"  VARCHAR(255) DEFAULT NULL,
            "birthday"         DATETIME     DEFAULT NULL --(DC2Type:datetime_immutable)
            ,
            "family_name"      VARCHAR(100) NOT NULL,
            "given_name"       VARCHAR(100) NOT NULL,
            "honorific_prefix" VARCHAR(50)  DEFAULT NULL,
            "honorific_suffix" VARCHAR(50)  DEFAULT NULL,
            "created_at"       DATETIME     NOT NULL     --(DC2Type:datetime_immutable)
            ,
            "gender_id"        CHAR(22)     DEFAULT NULL --(DC2Type:uuid64)
            ,
            "photo_id"         CHAR(22)     DEFAULT NULL --(DC2Type:uuid64)
            ,
            "pronoun_id"       CHAR(22)     DEFAULT NULL --(DC2Type:uuid64)
            ,
            PRIMARY KEY ("id")
        );
        CREATE INDEX "idx_p_family_name" ON "people" ("family_name");
        CREATE INDEX "fk_p_gender" ON "people" ("gender_id");
        CREATE INDEX "fk_p_pronoun" ON "people" ("pronoun_id");
        CREATE UNIQUE INDEX "unq_p_photo" ON "people" ("photo_id");
        CREATE TABLE "people_addresses"
        (
            "address_id" CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "person_id"  CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "type_id"    CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "comment"    CLOB DEFAULT NULL,
            "created_at" DATETIME NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("address_id", "person_id", "type_id")
        );
        CREATE INDEX "idx_pa_reverse" ON "people_addresses" ("address_id", "person_id");
        CREATE INDEX "idx_pa_type" ON "people_addresses" ("type_id");
        CREATE INDEX "idx_pa_address" ON "people_addresses" ("address_id");
        CREATE INDEX "idx_pa_person" ON "people_addresses" ("person_id");
        CREATE UNIQUE INDEX "unq_pa_person_type" ON "people_addresses" ("person_id", "type_id");
        CREATE TABLE "people_emails"
        (
            "email_id"   CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "person_id"  CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "type_id"    CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "comment"    CLOB DEFAULT NULL,
            "created_at" DATETIME NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("email_id", "person_id", "type_id")
        );
        CREATE INDEX "idx_pe_reverse" ON "people_emails" ("email_id", "person_id");
        CREATE INDEX "idx_pe_type" ON "people_emails" ("type_id");
        CREATE INDEX "idx_pe_email" ON "people_emails" ("email_id");
        CREATE INDEX "idx_pe_person" ON "people_emails" ("person_id");
        CREATE UNIQUE INDEX "unq_pe_person_type" ON "people_emails" ("person_id", "type_id");
        CREATE TABLE "people_phone_numbers"
        (
            "person_id"  CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "phone_id"   CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "type_id"    CHAR(22) NOT NULL --(DC2Type:uuid64)
            ,
            "comment"    CLOB DEFAULT NULL,
            "created_at" DATETIME NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("person_id", "phone_id", "type_id")
        );
        CREATE INDEX "idx_ppn_reverse" ON "people_phone_numbers" ("phone_id", "person_id");
        CREATE INDEX "idx_ppn_type" ON "people_phone_numbers" ("type_id");
        CREATE INDEX "idx_ppn_person" ON "people_phone_numbers" ("person_id");
        CREATE INDEX "idx_ppn_phone" ON "people_phone_numbers" ("phone_id");
        CREATE UNIQUE INDEX "unq_ppn_person_type" ON "people_phone_numbers" ("person_id", "type_id");
        CREATE TABLE "people_photos"
        (
            "id"         CHAR(22)    NOT NULL --(DC2Type:uuid64)
            ,
            "mime_type"  VARCHAR(50) NOT NULL,
            "photo"      BLOB        NOT NULL,
            "created_at" DATETIME    NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("id")
        );
        CREATE TABLE "phone_numbers"
        (
            "id"         CHAR(22)    NOT NULL --(DC2Type:uuid64)
            ,
            "phone"      VARCHAR(30) NOT NULL,
            "created_at" DATETIME    NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("id")
        );
        CREATE TABLE "pronouns"
        (
            "id"         CHAR(22)    NOT NULL --(DC2Type:uuid64)
            ,
            "object"     VARCHAR(10) NOT NULL,
            "possessive" VARCHAR(10) NOT NULL,
            "subject"    VARCHAR(10) NOT NULL,
            "created_at" DATETIME    NOT NULL --(DC2Type:datetime_immutable)
            ,
            PRIMARY KEY ("id")
        );
        CREATE UNIQUE INDEX "unq_pr_pronouns" ON "pronouns" ("subject", "object", "possessive");
        SQL;
        $this->executeSQL($sql);
        $this->warnIf(true, 'Remember Sqlite does not enforce foreign key constraints');
    }
}
