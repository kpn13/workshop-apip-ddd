<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211124152825 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE book (id VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, author VARCHAR(255) NOT NULL, publication_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE stock (id VARCHAR(255) NOT NULL, quantity INT NOT NULL, book_id VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE stock');
    }
}
