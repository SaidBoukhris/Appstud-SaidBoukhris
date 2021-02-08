<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208142337 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '#7 add image field to All entities';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adverts ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE categories ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD image VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adverts DROP image');
        $this->addSql('ALTER TABLE categories DROP image');
        $this->addSql('ALTER TABLE users DROP image');
    }
}
