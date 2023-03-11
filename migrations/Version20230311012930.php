<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230311012930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergie_reservation (allergie_id INT NOT NULL, reservation_id INT NOT NULL, INDEX IDX_658428367C86304A (allergie_id), INDEX IDX_65842836B83297E7 (reservation_id), PRIMARY KEY(allergie_id, reservation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_allergie (user_id INT NOT NULL, allergie_id INT NOT NULL, INDEX IDX_FE557A4AA76ED395 (user_id), INDEX IDX_FE557A4A7C86304A (allergie_id), PRIMARY KEY(user_id, allergie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allergie_reservation ADD CONSTRAINT FK_658428367C86304A FOREIGN KEY (allergie_id) REFERENCES allergie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergie_reservation ADD CONSTRAINT FK_65842836B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergie ADD CONSTRAINT FK_FE557A4AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergie ADD CONSTRAINT FK_FE557A4A7C86304A FOREIGN KEY (allergie_id) REFERENCES allergie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formule ADD menu_id INT NOT NULL');
        $this->addSql('ALTER TABLE formule ADD CONSTRAINT FK_605C9C98CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('CREATE INDEX IDX_605C9C98CCD7E912 ON formule (menu_id)');
        $this->addSql('ALTER TABLE opening_time ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE opening_time ADD CONSTRAINT FK_89115E6EB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_89115E6EB1E7706E ON opening_time (restaurant_id)');
        $this->addSql('ALTER TABLE picture ADD product_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F894584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_16DB4F894584665A ON picture (product_id)');
        $this->addSql('ALTER TABLE product ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('ALTER TABLE reservation ADD user_id INT NOT NULL, ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('CREATE INDEX IDX_42C84955B1E7706E ON reservation (restaurant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergie_reservation DROP FOREIGN KEY FK_658428367C86304A');
        $this->addSql('ALTER TABLE allergie_reservation DROP FOREIGN KEY FK_65842836B83297E7');
        $this->addSql('ALTER TABLE user_allergie DROP FOREIGN KEY FK_FE557A4AA76ED395');
        $this->addSql('ALTER TABLE user_allergie DROP FOREIGN KEY FK_FE557A4A7C86304A');
        $this->addSql('DROP TABLE allergie_reservation');
        $this->addSql('DROP TABLE user_allergie');
        $this->addSql('ALTER TABLE formule DROP FOREIGN KEY FK_605C9C98CCD7E912');
        $this->addSql('DROP INDEX IDX_605C9C98CCD7E912 ON formule');
        $this->addSql('ALTER TABLE formule DROP menu_id');
        $this->addSql('ALTER TABLE opening_time DROP FOREIGN KEY FK_89115E6EB1E7706E');
        $this->addSql('DROP INDEX IDX_89115E6EB1E7706E ON opening_time');
        $this->addSql('ALTER TABLE opening_time DROP restaurant_id');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F894584665A');
        $this->addSql('DROP INDEX UNIQ_16DB4F894584665A ON picture');
        $this->addSql('ALTER TABLE picture DROP product_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('ALTER TABLE product DROP category_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B1E7706E');
        $this->addSql('DROP INDEX IDX_42C84955A76ED395 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955B1E7706E ON reservation');
        $this->addSql('ALTER TABLE reservation DROP user_id, DROP restaurant_id');
    }
}
