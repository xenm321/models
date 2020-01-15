<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180802193037 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('INSERT INTO users (username, password, is_active, created) VALUES '
            . '("admin", "$2y$13$3ORdZREPUwerkNGKhme9cO8NexBYZuWZvPtv8zEXQ//Gb8lSWVzXa", 1, NOW())');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
