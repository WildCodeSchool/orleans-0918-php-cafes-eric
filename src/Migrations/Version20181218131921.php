<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181218131921 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE grocery');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C17C12FBC0 FOREIGN KEY (shelf_id) REFERENCES shelf (id)');
        $this->addSql('ALTER TABLE category RENAME INDEX fk_category_1_idx TO IDX_64C19C17C12FBC0');
        $this->addSql('ALTER TABLE infusion ADD highlighted TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE tea CHANGE hightlighted highlighted TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE grocery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_DDCA44812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C17C12FBC0');
        $this->addSql('ALTER TABLE category RENAME INDEX idx_64c19c17c12fbc0 TO fk_category_1_idx');
        $this->addSql('ALTER TABLE infusion DROP highlighted');
        $this->addSql('ALTER TABLE tea CHANGE highlighted hightlighted TINYINT(1) DEFAULT NULL');
    }
}
