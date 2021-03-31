<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330093324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, telephone INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apropos (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, misajour DATE NOT NULL, afficher TINYINT(1) DEFAULT NULL, acceuil TINYINT(1) DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_2440FEAA642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, contact INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catcontrat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, candidat_id INT NOT NULL, titre VARCHAR(255) NOT NULL, evaluation INT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, INDEX IDX_94D4687F8D0EB82 (candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, date_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, candidat_id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, etablissement VARCHAR(255) NOT NULL, INDEX IDX_404021BF8D0EB82 (candidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_472B783A642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, catcontrat_id INT DEFAULT NULL, recruteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, nombreposte INT NOT NULL, experience INT NOT NULL, ville VARCHAR(255) NOT NULL, etude INT NOT NULL, delai DATE NOT NULL, pays VARCHAR(255) NOT NULL, salaire INT DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, update_at DATETIME NOT NULL, INDEX IDX_AF86866FBAE89F6D (catcontrat_id), INDEX IDX_AF86866FBB0859F1 (recruteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_secteur (offre_id INT NOT NULL, secteur_id INT NOT NULL, INDEX IDX_2C9E563F4CC8505A (offre_id), INDEX IDX_2C9E563F9F7E4405 (secteur_id), PRIMARY KEY(offre_id, secteur_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruteur (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, contact INT NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, nomemtreprise VARCHAR(255) NOT NULL, numimatricul VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, siteweb VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description TINYTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, misajour DATE NOT NULL, image VARCHAR(255) NOT NULL, afficher TINYINT(1) DEFAULT NULL, INDEX IDX_E19D9AD2642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apropos ADD CONSTRAINT FK_2440FEAA642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FBAE89F6D FOREIGN KEY (catcontrat_id) REFERENCES catcontrat (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FBB0859F1 FOREIGN KEY (recruteur_id) REFERENCES recruteur (id)');
        $this->addSql('ALTER TABLE offre_secteur ADD CONSTRAINT FK_2C9E563F4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_secteur ADD CONSTRAINT FK_2C9E563F9F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678CBF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apropos DROP FOREIGN KEY FK_2440FEAA642B8210');
        $this->addSql('ALTER TABLE gallery DROP FOREIGN KEY FK_472B783A642B8210');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2642B8210');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F8D0EB82');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF8D0EB82');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FBAE89F6D');
        $this->addSql('ALTER TABLE offre_secteur DROP FOREIGN KEY FK_2C9E563F4CC8505A');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FBB0859F1');
        $this->addSql('ALTER TABLE offre_secteur DROP FOREIGN KEY FK_2C9E563F9F7E4405');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471BF396750');
        $this->addSql('ALTER TABLE recruteur DROP FOREIGN KEY FK_2BD3678CBF396750');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE apropos');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE catcontrat');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_secteur');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE recruteur');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE users');
    }
}
