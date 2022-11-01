<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221101040320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin_permission (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(20) NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_profile (id INT AUTO_INCREMENT NOT NULL, birth_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, family_name VARCHAR(100) DEFAULT NULL, country VARCHAR(255) NOT NULL, mobile VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_role (id INT AUTO_INCREMENT NOT NULL, uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_role_permission (admin_role_id INT NOT NULL, admin_permission_id INT NOT NULL, INDEX IDX_53AD1461123FA025 (admin_role_id), INDEX IDX_53AD1461201BD3AD (admin_permission_id), PRIMARY KEY(admin_role_id, admin_permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin_role_permission ADD CONSTRAINT FK_53AD1461123FA025 FOREIGN KEY (admin_role_id) REFERENCES admin_role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE admin_role_permission ADD CONSTRAINT FK_53AD1461201BD3AD FOREIGN KEY (admin_permission_id) REFERENCES admin_permission (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE profile');
        $this->addSql('ALTER TABLE `admin` ADD admin_role_id INT DEFAULT NULL, ADD address_id INT DEFAULT NULL, CHANGE last_name password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76123FA025 FOREIGN KEY (admin_role_id) REFERENCES admin_role (id)');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76F5B7AF75 FOREIGN KEY (address_id) REFERENCES admin_profile (id)');
        $this->addSql('CREATE INDEX IDX_880E0D76123FA025 ON `admin` (admin_role_id)');
        $this->addSql('CREATE INDEX IDX_880E0D76F5B7AF75 ON `admin` (address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76F5B7AF75');
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76123FA025');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, birth_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', first_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, family_name VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, country VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE admin_role_permission DROP FOREIGN KEY FK_53AD1461123FA025');
        $this->addSql('ALTER TABLE admin_role_permission DROP FOREIGN KEY FK_53AD1461201BD3AD');
        $this->addSql('DROP TABLE admin_permission');
        $this->addSql('DROP TABLE admin_profile');
        $this->addSql('DROP TABLE admin_role');
        $this->addSql('DROP TABLE admin_role_permission');
        $this->addSql('DROP INDEX IDX_880E0D76123FA025 ON `admin`');
        $this->addSql('DROP INDEX IDX_880E0D76F5B7AF75 ON `admin`');
        $this->addSql('ALTER TABLE `admin` DROP admin_role_id, DROP address_id, CHANGE password last_name VARCHAR(255) NOT NULL');
    }
}
