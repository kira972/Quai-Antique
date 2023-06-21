<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620234907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formule_product DROP FOREIGN KEY FK_9171E91D2A68F4D1');
        $this->addSql('ALTER TABLE formule_product DROP FOREIGN KEY FK_9171E91D4584665A');
        $this->addSql('DROP TABLE formule');
        $this->addSql('DROP TABLE formule_product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formule (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE formule_product (formule_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_9171E91D4584665A (product_id), INDEX IDX_9171E91D2A68F4D1 (formule_id), PRIMARY KEY(formule_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formule_product ADD CONSTRAINT FK_9171E91D2A68F4D1 FOREIGN KEY (formule_id) REFERENCES formule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formule_product ADD CONSTRAINT FK_9171E91D4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }
}
