<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181212135729 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coffee (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, country VARCHAR(2) DEFAULT NULL, soil VARCHAR(255) DEFAULT NULL, variety VARCHAR(255) NOT NULL, tasting_note VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, highlighted TINYINT(1) DEFAULT NULL, novelty TINYINT(1) DEFAULT NULL, INDEX IDX_538529B312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infusion (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, ingredients VARCHAR(255) NOT NULL, feature VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E87314535E237E06 (name), INDEX IDX_E873145312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E873145312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('ALTER TABLE tea DROP FOREIGN KEY FK_9B8AF0F712469DE2');
        $this->addSql('ALTER TABLE tea CHANGE hightlighted hightlighted TINYINT(1) DEFAULT NULL, CHANGE novelty novelty TINYINT(1) DEFAULT NULL, CHANGE description ingredients VARCHAR(255) NOT NULL, CHANGE tasting_note feature VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8E86D7B25E237E06 ON tea (name)');
        $this->addSql('ALTER TABLE tea RENAME INDEX idx_9b8af0f712469de2 TO IDX_8E86D7B212469DE2');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_DDCA44812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE coffee');
        $this->addSql('DROP TABLE infusion');
        $this->addSql('DROP INDEX UNIQ_8E86D7B25E237E06 ON tea');
        $this->addSql('ALTER TABLE tea CHANGE hightlighted hightlighted TINYINT(1) NOT NULL, CHANGE novelty novelty TINYINT(1) NOT NULL, CHANGE ingredients description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE feature tasting_note VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE tea RENAME INDEX idx_8e86d7b212469de2 TO IDX_9B8AF0F712469DE2');
    }
}
