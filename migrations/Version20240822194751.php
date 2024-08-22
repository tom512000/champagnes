<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240822194751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE capsule CHANGE producteur producteur VARCHAR(255) NOT NULL, CHANGE embleme embleme VARCHAR(255) NOT NULL, CHANGE couleur couleur VARCHAR(255) NOT NULL, CHANGE matiere matiere VARCHAR(255) NOT NULL, CHANGE inscription inscription VARCHAR(255) NOT NULL, CHANGE decoration decoration VARCHAR(255) NOT NULL, CHANGE lieu lieu VARCHAR(255) NOT NULL, CHANGE prix prix DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE capsule CHANGE producteur producteur VARCHAR(255) DEFAULT NULL, CHANGE embleme embleme VARCHAR(255) DEFAULT NULL, CHANGE couleur couleur VARCHAR(255) DEFAULT NULL, CHANGE matiere matiere VARCHAR(255) DEFAULT NULL, CHANGE inscription inscription VARCHAR(255) DEFAULT NULL, CHANGE decoration decoration VARCHAR(255) DEFAULT NULL, CHANGE lieu lieu VARCHAR(255) DEFAULT NULL, CHANGE prix prix DOUBLE PRECISION DEFAULT NULL');
    }
}
