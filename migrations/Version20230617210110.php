<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617210110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formule_product (formule_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_9171E91D2A68F4D1 (formule_id), INDEX IDX_9171E91D4584665A (product_id), PRIMARY KEY(formule_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formule_product ADD CONSTRAINT FK_9171E91D2A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formule_product ADD CONSTRAINT FK_9171E91D4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formule DROP FOREIGN KEY FK_605C9C98CCD7E912');
        $this->addSql('DROP INDEX IDX_605C9C98CCD7E912 ON formule');
        $this->addSql('ALTER TABLE formule DROP menu_id, DROP price, DROP description');
        $this->addSql('ALTER TABLE product ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE reservation CHANGE date date DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formule_product DROP FOREIGN KEY FK_9171E91D2A68F4D1');
        $this->addSql('ALTER TABLE formule_product DROP FOREIGN KEY FK_9171E91D4584665A');
        $this->addSql('DROP TABLE formule_product');
        $this->addSql('ALTER TABLE formule ADD menu_id INT NOT NULL, ADD price DOUBLE PRECISION NOT NULL, ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT FK_605C9C98CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('CREATE INDEX IDX_605C9C98CCD7E912 ON formule (menu_id)');
        $this->addSql('ALTER TABLE product DROP description');
        $this->addSql('ALTER TABLE reservation CHANGE date date DATETIME NOT NULL');
    }
}
