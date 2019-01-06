<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181214110219 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, shelf_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_64C19C17C12FBC0 (shelf_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coffee (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, country VARCHAR(2) DEFAULT NULL, soil VARCHAR(255) DEFAULT NULL, variety VARCHAR(255) NOT NULL, tasting_note VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, highlighted TINYINT(1) DEFAULT NULL, novelty TINYINT(1) DEFAULT NULL, INDEX IDX_538529B312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infusion (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, ingredients VARCHAR(255) NOT NULL, feature VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_E87314535E237E06 (name), INDEX IDX_E873145312469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tea (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, ingredients VARCHAR(255) NOT NULL, hightlighted TINYINT(1) DEFAULT NULL, novelty TINYINT(1) DEFAULT NULL, feature VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8E86D7B25E237E06 (name), INDEX IDX_8E86D7B212469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE worker (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shelf (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C17C12FBC0 FOREIGN KEY (shelf_id) REFERENCES shelf (id)');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE infusion ADD CONSTRAINT FK_E873145312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE tea ADD CONSTRAINT FK_8E86D7B212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE coffee DROP FOREIGN KEY FK_538529B312469DE2');
        $this->addSql('ALTER TABLE infusion DROP FOREIGN KEY FK_E873145312469DE2');
        $this->addSql('ALTER TABLE tea DROP FOREIGN KEY FK_8E86D7B212469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C17C12FBC0');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE coffee');
        $this->addSql('DROP TABLE infusion');
        $this->addSql('DROP TABLE tea');
        $this->addSql('DROP TABLE worker');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE shelf');
    }
}
