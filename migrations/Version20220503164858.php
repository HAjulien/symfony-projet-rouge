<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503164858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, plat_id INT DEFAULT NULL, user_id INT NOT NULL, note DOUBLE PRECISION NOT NULL, texte LONGTEXT DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_67F068BCD73DB560 (plat_id), INDEX IDX_67F068BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contient (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, contient_id INT NOT NULL, nom VARCHAR(70) NOT NULL, description LONGTEXT NOT NULL, note DOUBLE PRECISION DEFAULT NULL, date_creation DATETIME NOT NULL, image VARCHAR(150) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_2038A20712469DE2 (category_id), INDEX IDX_2038A20723AEAE6E (contient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plat_selection_semaine (id INT AUTO_INCREMENT NOT NULL, contient_id INT NOT NULL, selectionne_id INT NOT NULL, jour VARCHAR(30) NOT NULL, quantite_jour INT NOT NULL, INDEX IDX_B4BC1C6823AEAE6E (contient_id), INDEX IDX_B4BC1C68FC738BC4 (selectionne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selectionne (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_40B04857A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCD73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A20712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A20723AEAE6E FOREIGN KEY (contient_id) REFERENCES contient (id)');
        $this->addSql('ALTER TABLE plat_selection_semaine ADD CONSTRAINT FK_B4BC1C6823AEAE6E FOREIGN KEY (contient_id) REFERENCES contient (id)');
        $this->addSql('ALTER TABLE plat_selection_semaine ADD CONSTRAINT FK_B4BC1C68FC738BC4 FOREIGN KEY (selectionne_id) REFERENCES selectionne (id)');
        $this->addSql('ALTER TABLE selectionne ADD CONSTRAINT FK_40B04857A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD pseudo VARCHAR(70) NOT NULL, ADD id_afpa INT NOT NULL, ADD phone INT DEFAULT NULL, ADD point_fidelite INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A20712469DE2');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A20723AEAE6E');
        $this->addSql('ALTER TABLE plat_selection_semaine DROP FOREIGN KEY FK_B4BC1C6823AEAE6E');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCD73DB560');
        $this->addSql('ALTER TABLE plat_selection_semaine DROP FOREIGN KEY FK_B4BC1C68FC738BC4');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE contient');
        $this->addSql('DROP TABLE plat');
        $this->addSql('DROP TABLE plat_selection_semaine');
        $this->addSql('DROP TABLE selectionne');
        $this->addSql('ALTER TABLE user DROP pseudo, DROP id_afpa, DROP phone, DROP point_fidelite');
    }
}
