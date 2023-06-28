<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622135535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBC415685');
        $this->addSql('DROP INDEX UNIQ_D34A04ADBC415685 ON product');
        $this->addSql('ALTER TABLE product CHANGE pictures_id picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04ADEE45BDBF ON product (picture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEE45BDBF');
        $this->addSql('DROP INDEX UNIQ_D34A04ADEE45BDBF ON product');
        $this->addSql('ALTER TABLE product CHANGE picture_id pictures_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBC415685 FOREIGN KEY (pictures_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04ADBC415685 ON product (pictures_id)');
    }
}
