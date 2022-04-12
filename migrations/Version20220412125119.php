<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220412125119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, chosen_answer INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote_user (vote_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3AF1277872DCDAFC (vote_id), INDEX IDX_3AF12778A76ED395 (user_id), PRIMARY KEY(vote_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote_probe (vote_id INT NOT NULL, probe_id INT NOT NULL, INDEX IDX_86370DE172DCDAFC (vote_id), INDEX IDX_86370DE13D2D0D4A (probe_id), PRIMARY KEY(vote_id, probe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vote_user ADD CONSTRAINT FK_3AF1277872DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vote_user ADD CONSTRAINT FK_3AF12778A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vote_probe ADD CONSTRAINT FK_86370DE172DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vote_probe ADD CONSTRAINT FK_86370DE13D2D0D4A FOREIGN KEY (probe_id) REFERENCES probe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vote_user DROP FOREIGN KEY FK_3AF1277872DCDAFC');
        $this->addSql('ALTER TABLE vote_probe DROP FOREIGN KEY FK_86370DE172DCDAFC');
        $this->addSql('DROP TABLE vote');
        $this->addSql('DROP TABLE vote_user');
        $this->addSql('DROP TABLE vote_probe');
    }
}
