<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108162429 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE subcategory');
        $this->addSql('ALTER TABLE infusion ADD family_infusion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E87314532F90049C FOREIGN KEY (family_infusion_id) REFERENCES infusion (id)');
        $this->addSql('CREATE INDEX IDX_E87314532F90049C ON infusion (family_infusion_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_DDCA44812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE infusion DROP FOREIGN KEY FK_E87314532F90049C');
        $this->addSql('DROP INDEX IDX_E87314532F90049C ON infusion');
        $this->addSql('ALTER TABLE infusion DROP family_infusion_id');
    }
}
