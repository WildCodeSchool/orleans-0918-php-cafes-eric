<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190108102351 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE subcategory');
        $this->addSql('ALTER TABLE infusion ADD family_tea_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E8731453A309CD18 FOREIGN KEY (family_tea_id) REFERENCES family_tea (id)');
        $this->addSql('CREATE INDEX IDX_E8731453A309CD18 ON infusion (family_tea_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_DDCA44812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE infusion DROP FOREIGN KEY FK_E8731453A309CD18');
        $this->addSql('DROP INDEX IDX_E8731453A309CD18 ON infusion');
        $this->addSql('ALTER TABLE infusion DROP family_tea_id');
    }
}
