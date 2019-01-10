<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190110093755 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE infusion (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, family_tea_id INT DEFAULT NULL, family_infusion_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, ingredients VARCHAR(255) NOT NULL, feature VARCHAR(255) DEFAULT NULL, highlighted TINYINT(1) DEFAULT NULL, novelty TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_E87314535E237E06 (name), INDEX IDX_E873145312469DE2 (category_id), INDEX IDX_E8731453A309CD18 (family_tea_id), INDEX IDX_E87314532F90049C (family_infusion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family_infusion (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E873145312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E8731453A309CD18 FOREIGN KEY (family_tea_id) REFERENCES family_tea (id)');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E87314532F90049C FOREIGN KEY (family_infusion_id) REFERENCES infusion (id)');
        $this->addSql('DROP TABLE grocery');
        $this->addSql('DROP TABLE subcategory');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE infusion DROP FOREIGN KEY FK_E87314532F90049C');
        $this->addSql('CREATE TABLE grocery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_DDCA44812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE infusion');
        $this->addSql('DROP TABLE family_infusion');
    }
}
