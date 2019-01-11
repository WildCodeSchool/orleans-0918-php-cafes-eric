<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190109153431 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE family_infusion (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertise (id INT AUTO_INCREMENT NOT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE infusion ADD family_tea_id INT DEFAULT NULL, ADD family_infusion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E8731453A309CD18 FOREIGN KEY (family_tea_id) REFERENCES family_tea (id)');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E87314532F90049C FOREIGN KEY (family_infusion_id) REFERENCES infusion (id)');
        $this->addSql('CREATE INDEX IDX_E8731453A309CD18 ON infusion (family_tea_id)');
        $this->addSql('CREATE INDEX IDX_E87314532F90049C ON infusion (family_infusion_id)');
        $this->addSql('ALTER TABLE worker CHANGE profile_image profile_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE coffee CHANGE coffee_image coffee_image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE family_infusion');
        $this->addSql('DROP TABLE advertise');
        $this->addSql('ALTER TABLE coffee CHANGE coffee_image coffee_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE infusion DROP FOREIGN KEY FK_E8731453A309CD18');
        $this->addSql('ALTER TABLE infusion DROP FOREIGN KEY FK_E87314532F90049C');
        $this->addSql('DROP INDEX IDX_E8731453A309CD18 ON infusion');
        $this->addSql('DROP INDEX IDX_E87314532F90049C ON infusion');
        $this->addSql('ALTER TABLE infusion DROP family_tea_id, DROP family_infusion_id');
        $this->addSql('ALTER TABLE worker CHANGE profile_image profile_image VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
