<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211017193847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_author (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, first_name TINYTEXT NOT NULL, last_name TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_book (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_CECB8691F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_book_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, title TINYTEXT NOT NULL, description LONGTEXT NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_72A0EBB22C2AC5D3 (translatable_id), UNIQUE INDEX app_book_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_book ADD CONSTRAINT FK_CECB8691F675F31B FOREIGN KEY (author_id) REFERENCES app_author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_book_translation ADD CONSTRAINT FK_72A0EBB22C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_book (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_book DROP FOREIGN KEY FK_CECB8691F675F31B');
        $this->addSql('ALTER TABLE app_book_translation DROP FOREIGN KEY FK_72A0EBB22C2AC5D3');
        $this->addSql('DROP TABLE app_author');
        $this->addSql('DROP TABLE app_book');
        $this->addSql('DROP TABLE app_book_translation');
    }
}
