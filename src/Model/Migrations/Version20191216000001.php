<?php
/** @noinspection PhpUnused */
declare(strict_types=1);

namespace Model\Migrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216000001 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * @throws DBALException
     */
    public function down(Schema $schema): void {
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            case 'mysql':
                $this->downMysql();
                break;
            case 'sqlite':
                $this->downSqlite();
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
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            case 'mysql':
                $this->upMysql();
                break;
            case 'sqlite':
                $this->upSqlite();
                break;
            default:
                $this->abortIf(true, 'Unknown or un-implemented platform for this migration');
        }
    }
    private function downMysql(): void {
        $this->addSql('ALTER TABLE `people_addresses` DROP FOREIGN KEY `FK_EFDEE3F1C54C8C93`');
        $this->addSql('ALTER TABLE `people_addresses` DROP FOREIGN KEY `FK_EFDEE3F1F5B7AF75`');
        $this->addSql('ALTER TABLE `people_addresses` DROP FOREIGN KEY `FK_EFDEE3F1217BBB47`');
        $this->addSql('ALTER TABLE `people_emails` DROP FOREIGN KEY `FK_3A96CAB8C54C8C93`');
        $this->addSql('ALTER TABLE `people_emails` DROP FOREIGN KEY `FK_3A96CAB8A832C1C9`');
        $this->addSql('ALTER TABLE `people_emails` DROP FOREIGN KEY `FK_3A96CAB8217BBB47`');
        $this->addSql('ALTER TABLE `people_phone_numbers` DROP FOREIGN KEY `FK_96FCAF7DC54C8C93`');
        $this->addSql('ALTER TABLE `people_phone_numbers` DROP FOREIGN KEY `FK_96FCAF7D217BBB47`');
        $this->addSql('ALTER TABLE `people_phone_numbers` DROP FOREIGN KEY `FK_96FCAF7D3B7323CB`');
        $this->addSql('ALTER TABLE `people` DROP FOREIGN KEY `FK_28166A26708A0E0`');
        $this->addSql('ALTER TABLE `people` DROP FOREIGN KEY `FK_28166A267E9E4C8C`');
        $this->addSql('ALTER TABLE `people` DROP FOREIGN KEY `FK_28166A2693BDCD30`');
        $this->addSql('DROP TABLE `people_addresses`');
        $this->addSql('DROP TABLE `people_emails`');
        $this->addSql('DROP TABLE `people_phone_numbers`');
        $this->addSql('DROP TABLE `people`');
        $this->addSql('DROP TABLE `people_photos`');
        $this->addSql('DROP TABLE `types`');
        $this->addSql('DROP TABLE `addresses`');
        $this->addSql('DROP TABLE `emails`');
        $this->addSql('DROP TABLE `genders`');
        $this->addSql('DROP TABLE `phone_numbers`');
        $this->addSql('DROP TABLE `pronouns`');
    }
    /**
     *
     */
    private function downSqlite(): void {
        $this->addSql('DROP TABLE `types`');
        $this->addSql('DROP TABLE `addresses`');
        $this->addSql('DROP TABLE `emails`');
        $this->addSql('DROP TABLE `genders`');
        $this->addSql('DROP TABLE `people`');
        $this->addSql('DROP TABLE `people_addresses`');
        $this->addSql('DROP TABLE people_emails');
        $this->addSql('DROP TABLE `people_phone_numbers`');
        $this->addSql('DROP TABLE `people_photos`');
        $this->addSql('DROP TABLE `phone_numbers`');
        $this->addSql('DROP TABLE pronouns');
    }
    /**
     *
     */
    private function upMysql(): void {
        $sql = <<<'SQL'
            CREATE TABLE `types`
            (
                `id`         CHAR(22)     NOT NULL COMMENT '(DC2Type:uuid64)',
                `kind`       VARCHAR(50)  NOT NULL,
                `created_at` DATETIME     NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                `class_name` VARCHAR(255) NOT NULL,
                UNIQUE INDEX `unq_t_class_kind` (`class_name`, `kind`),
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `addresses`
            (
                `id`               CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
                `country_name`     VARCHAR(50) NOT NULL COMMENT 'country name',
                `extended_address` VARCHAR(50)  DEFAULT NULL COMMENT 'apartment/suite/room name/number if any',
                `locality`         VARCHAR(50) NOT NULL COMMENT 'city/town/village',
                `post_office_box`  VARCHAR(50)  DEFAULT NULL COMMENT 'post office box description if any',
                `postal_code`      VARCHAR(30) NOT NULL COMMENT 'postal code, e.g. US ZIP',
                `region`           VARCHAR(50)  DEFAULT NULL COMMENT 'state/county/province',
                `street_address`   VARCHAR(255) DEFAULT NULL COMMENT 'street number + name',
                `created_at`       DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `emails`
            (
                `id`         CHAR(22)     NOT NULL COMMENT '(DC2Type:uuid64)',
                `email`      VARCHAR(255) NOT NULL,
                `created_at` DATETIME     NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `genders`
            (
                `id`              CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
                `gender_identity` VARCHAR(255) DEFAULT NULL,
                `sex`             VARCHAR(10) NOT NULL COMMENT 'biological sex - One of Female, Male, Other, None/Not applicable, Unknown',
                `created_at`      DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                UNIQUE INDEX `unq_g_gender` (`sex`, `gender_identity`),
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `people`
            (
                `id`               CHAR(22)     NOT NULL COMMENT '(DC2Type:uuid64)',
                `gender_id`        CHAR(22)     DEFAULT NULL COMMENT '(DC2Type:uuid64)',
                `photo_id`         CHAR(22)     DEFAULT NULL COMMENT '(DC2Type:uuid64)',
                `pronoun_id`       CHAR(22)     DEFAULT NULL COMMENT '(DC2Type:uuid64)',
                `additional_name`  VARCHAR(255) DEFAULT NULL COMMENT 'other (e.g. middle) name',
                `birthday`         DATETIME     DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
                `family_name`      VARCHAR(100) NOT NULL COMMENT 'family (often last) name',
                `given_name`       VARCHAR(100) NOT NULL COMMENT 'given (often first) name',
                `honorific_prefix` VARCHAR(50)  DEFAULT NULL COMMENT 'e.g. Mrs., Mr. or Dr.',
                `honorific_suffix` VARCHAR(50)  DEFAULT NULL COMMENT 'e.g. Ph.D, Esq.',
                `created_at`       DATETIME     NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                INDEX `idx_p_family_name` (`family_name`),
                INDEX `fk_p_gender` (`gender_id`),
                INDEX `fk_p_pronoun` (`pronoun_id`),
                UNIQUE INDEX `unq_p_photo` (`photo_id`),
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `people_addresses`
            (
                `address_id` CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `person_id`  CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `type_id`    CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `comment`    TEXT DEFAULT NULL,
                `created_at` DATETIME   NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                INDEX `idx_pa_reverse` (`address_id`, `person_id`),
                INDEX `idx_pa_type` (`type_id`),
                INDEX `idx_pa_address` (`address_id`),
                INDEX `idx_pa_person` (`person_id`),
                UNIQUE INDEX `unq_pa_person_type` (`person_id`, `type_id`),
                PRIMARY KEY (`address_id`, `person_id`, `type_id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `people_emails`
            (
                `email_id`   CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `person_id`  CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `type_id`    CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `comment`    TEXT DEFAULT NULL,
                `created_at` DATETIME   NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                INDEX `idx_pe_reverse` (`email_id`, `person_id`),
                INDEX `idx_pe_type` (`type_id`),
                INDEX `idx_pe_email` (`email_id`),
                INDEX `idx_pe_person` (`person_id`),
                UNIQUE INDEX `unq_pe_person_type` (`person_id`, `type_id`),
                PRIMARY KEY (`email_id`, `person_id`, `type_id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `people_phone_numbers`
            (
                `person_id`  CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `phone_id`   CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `type_id`    CHAR(22)   NOT NULL COMMENT '(DC2Type:uuid64)',
                `comment`    TEXT DEFAULT NULL,
                `created_at` DATETIME   NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                INDEX `idx_ppn_reverse` (`phone_id`, `person_id`),
                INDEX `idx_ppn_type` (`type_id`),
                INDEX `idx_ppn_person` (`person_id`),
                INDEX `idx_ppn_phone` (`phone_id`),
                UNIQUE INDEX `unq_ppn_person_type` (`person_id`, `type_id`),
                PRIMARY KEY (`person_id`, `phone_id`, `type_id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `people_photos`
            (
                `id`         CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
                `mime_type`  VARCHAR(50) NOT NULL,
                `photo`      MEDIUMBLOB  NOT NULL,
                `created_at` DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `phone_numbers`
            (
                `id`         CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
                `phone`      VARCHAR(30) NOT NULL,
                `created_at` DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            CREATE TABLE `pronouns`
            (
                `id`         CHAR(22)    NOT NULL COMMENT '(DC2Type:uuid64)',
                `object`     VARCHAR(10) NOT NULL COMMENT 'objective pronoun - One of her, him, them, etc',
                `possessive` VARCHAR(10) NOT NULL COMMENT 'possessive pronoun - One of hers, his, theirs, etc',
                `subject`    VARCHAR(10) NOT NULL COMMENT 'subject pronoun - One of he, she, they, etc',
                `created_at` DATETIME    NOT NULL COMMENT '(DC2Type:datetime_immutable)',
                UNIQUE INDEX `unq_pr_pronouns` (`subject`, `object`, `possessive`),
                PRIMARY KEY (`id`)
            ) DEFAULT CHARACTER SET `utf8mb4`
              COLLATE `utf8mb4_unicode_ci`
              ENGINE = InnoDB;
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people`
                ADD CONSTRAINT `FK_28166A26708A0E0` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people`
                ADD CONSTRAINT `FK_28166A267E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `people_photos` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people`
                ADD CONSTRAINT `FK_28166A2693BDCD30` FOREIGN KEY (`pronoun_id`) REFERENCES `pronouns` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_addresses`
                ADD CONSTRAINT `FK_EFDEE3F1F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_addresses`
                ADD CONSTRAINT `FK_EFDEE3F1217BBB47` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_addresses`
                ADD CONSTRAINT `FK_EFDEE3F1C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_emails`
                ADD CONSTRAINT `FK_3A96CAB8A832C1C9` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_emails`
                ADD CONSTRAINT `FK_3A96CAB8217BBB47` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_emails`
                ADD CONSTRAINT `FK_3A96CAB8C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_phone_numbers`
                ADD CONSTRAINT `FK_96FCAF7D217BBB47` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_phone_numbers`
                ADD CONSTRAINT `FK_96FCAF7D3B7323CB` FOREIGN KEY (`phone_id`) REFERENCES `phone_numbers` (`id`);
            SQL;
        $this->addSql($sql);
        $sql = <<<'SQL'
            ALTER TABLE `people_phone_numbers`
                ADD CONSTRAINT `FK_96FCAF7DC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);
            SQL;
        $this->addSql($sql);
    }
    /**
     *
     */
    private function upSqlite(): void {
        $this->addSql(
            'CREATE TABLE types (id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , kind VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , class_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX unq_t_class_kind ON types (class_name, kind)');
        $this->addSql(
            'CREATE TABLE addresses (id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , country_name VARCHAR(50) NOT NULL --country name
        , extended_address VARCHAR(50) DEFAULT NULL --apartment/suite/room name/number if any
        , locality VARCHAR(50) NOT NULL --city/town/village
        , post_office_box VARCHAR(50) DEFAULT NULL --post office box description if any
        , postal_code VARCHAR(30) NOT NULL --postal code, e.g. US ZIP
        , region VARCHAR(50) DEFAULT NULL --state/county/province
        , street_address VARCHAR(255) DEFAULT NULL --street number + name
        , created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))'
        );
        $this->addSql(
            'CREATE TABLE emails (id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))'
        );
        $this->addSql(
            'CREATE TABLE genders (id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , gender_identity VARCHAR(255) DEFAULT NULL, sex VARCHAR(10) NOT NULL --biological sex - One of Female, Male, Other, None/Not applicable, Unknown
        , created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX unq_g_gender ON genders (sex, gender_identity)');
        $this->addSql(
            'CREATE TABLE people (id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , additional_name VARCHAR(255) DEFAULT NULL --other (e.g. middle) name
        , birthday DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , family_name VARCHAR(100) NOT NULL --family (often last) name
        , given_name VARCHAR(100) NOT NULL --given (often first) name
        , honorific_prefix VARCHAR(50) DEFAULT NULL --e.g. Mrs., Mr. or Dr.
        , honorific_suffix VARCHAR(50) DEFAULT NULL --e.g. Ph.D, Esq.
        , created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , gender_id CHAR(22) DEFAULT NULL --(DC2Type:uuid64)
        , photo_id CHAR(22) DEFAULT NULL --(DC2Type:uuid64)
        , pronoun_id CHAR(22) DEFAULT NULL --(DC2Type:uuid64)
        , PRIMARY KEY(id))'
        );
        $this->addSql('CREATE INDEX idx_p_family_name ON people (family_name)');
        $this->addSql('CREATE INDEX fk_p_gender ON people (gender_id)');
        $this->addSql('CREATE INDEX fk_p_pronoun ON people (pronoun_id)');
        $this->addSql('CREATE UNIQUE INDEX unq_p_photo ON people (photo_id)');
        $this->addSql(
            'CREATE TABLE people_addresses (address_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , person_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , type_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , comment CLOB DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(address_id, person_id, type_id))'
        );
        $this->addSql('CREATE INDEX idx_pa_reverse ON people_addresses (address_id, person_id)');
        $this->addSql('CREATE INDEX idx_pa_type ON people_addresses (type_id)');
        $this->addSql('CREATE INDEX idx_pa_address ON people_addresses (address_id)');
        $this->addSql('CREATE INDEX idx_pa_person ON people_addresses (person_id)');
        $this->addSql('CREATE UNIQUE INDEX unq_pa_person_type ON people_addresses (person_id, type_id)');
        $this->addSql(
            'CREATE TABLE people_emails (email_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , person_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , type_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , comment CLOB DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(email_id, person_id, type_id))'
        );
        $this->addSql('CREATE INDEX idx_pe_reverse ON people_emails (email_id, person_id)');
        $this->addSql('CREATE INDEX idx_pe_type ON people_emails (type_id)');
        $this->addSql('CREATE INDEX idx_pe_email ON people_emails (email_id)');
        $this->addSql('CREATE INDEX idx_pe_person ON people_emails (person_id)');
        $this->addSql('CREATE UNIQUE INDEX unq_pe_person_type ON people_emails (person_id, type_id)');
        $this->addSql(
            'CREATE TABLE people_phone_numbers (person_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , phone_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , type_id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , comment CLOB DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(person_id, phone_id, type_id))'
        );
        $this->addSql('CREATE INDEX idx_ppn_reverse ON people_phone_numbers (phone_id, person_id)');
        $this->addSql('CREATE INDEX idx_ppn_type ON people_phone_numbers (type_id)');
        $this->addSql('CREATE INDEX idx_ppn_person ON people_phone_numbers (person_id)');
        $this->addSql('CREATE INDEX idx_ppn_phone ON people_phone_numbers (phone_id)');
        $this->addSql('CREATE UNIQUE INDEX unq_ppn_person_type ON people_phone_numbers (person_id, type_id)');
        $this->addSql(
            'CREATE TABLE people_photos (id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , mime_type VARCHAR(50) NOT NULL, photo BLOB NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))'
        );
        $this->addSql(
            'CREATE TABLE phone_numbers (id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , phone VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))'
        );
        $this->addSql(
            'CREATE TABLE pronouns (id CHAR(22) NOT NULL --(DC2Type:uuid64)
        , object VARCHAR(10) NOT NULL --objective pronoun - One of her, him, them, etc
        , possessive VARCHAR(10) NOT NULL --possessive pronoun - One of hers, his, theirs, etc
        , subject VARCHAR(10) NOT NULL --subject pronoun - One of he, she, they, etc
        , created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX unq_pr_pronouns ON pronouns (subject, object, possessive)');
        $this->warnIf(true, 'Remember Sqlite does not enforce foreign key constraints');
    }
}
