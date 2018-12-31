<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181231103907 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tea DROP FOREIGN KEY FK_8E86D7B2A309CD18');
        $this->addSql('CREATE TABLE advertise (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE family_tea');
        $this->addSql('DROP TABLE grocery');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('ALTER TABLE infusion DROP novelty, DROP highlighted');
        $this->addSql('DROP INDEX IDX_8E86D7B2A309CD18 ON tea');
        $this->addSql('ALTER TABLE tea DROP family_tea_id, CHANGE highlighted hightlighted TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE family_tea (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grocery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_DDCA44812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE advertise');
        $this->addSql('ALTER TABLE infusion ADD novelty TINYINT(1) DEFAULT NULL, ADD highlighted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE tea ADD family_tea_id INT NOT NULL, CHANGE hightlighted highlighted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE tea ADD CONSTRAINT FK_8E86D7B2A309CD18 FOREIGN KEY (family_tea_id) REFERENCES family_tea (id)');
        $this->addSql('CREATE INDEX IDX_8E86D7B2A309CD18 ON tea (family_tea_id)');
    }
}
