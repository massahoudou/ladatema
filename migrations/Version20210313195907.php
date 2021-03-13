<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210313195907 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE apropos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE avis_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE catcontrat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE competence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contact_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE formation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE gallery_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE offre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partenaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE secteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, telephone INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE apropos (id INT NOT NULL, admin_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description TEXT NOT NULL, misajour DATE NOT NULL, afficher BOOLEAN DEFAULT NULL, acceuil BOOLEAN DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2440FEAA642B8210 ON apropos (admin_id)');
        $this->addSql('CREATE TABLE avis (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE candidat (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, contact INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE catcontrat (id INT NOT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE competence (id INT NOT NULL, candidat_id INT NOT NULL, titre VARCHAR(255) NOT NULL, evaluation INT DEFAULT NULL, contenu TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_94D4687F8D0EB82 ON competence (candidat_id)');
        $this->addSql('CREATE TABLE contact (id INT NOT NULL, nom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message TEXT NOT NULL, date_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE formation (id INT NOT NULL, candidat_id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, etablissement VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_404021BF8D0EB82 ON formation (candidat_id)');
        $this->addSql('CREATE TABLE gallery (id INT NOT NULL, admin_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_472B783A642B8210 ON gallery (admin_id)');
        $this->addSql('CREATE TABLE offre (id INT NOT NULL, catcontrat_id INT DEFAULT NULL, recruteur_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description TEXT NOT NULL, nombreposte INT NOT NULL, experience INT NOT NULL, ville VARCHAR(255) NOT NULL, etude INT NOT NULL, delai DATE NOT NULL, pays VARCHAR(255) NOT NULL, salaire INT DEFAULT NULL, genre VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, update_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AF86866FBAE89F6D ON offre (catcontrat_id)');
        $this->addSql('CREATE INDEX IDX_AF86866FBB0859F1 ON offre (recruteur_id)');
        $this->addSql('CREATE TABLE offre_secteur (offre_id INT NOT NULL, secteur_id INT NOT NULL, PRIMARY KEY(offre_id, secteur_id))');
        $this->addSql('CREATE INDEX IDX_2C9E563F4CC8505A ON offre_secteur (offre_id)');
        $this->addSql('CREATE INDEX IDX_2C9E563F9F7E4405 ON offre_secteur (secteur_id)');
        $this->addSql('CREATE TABLE partenaire (id INT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE recruteur (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, contact INT NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, nomemtreprise VARCHAR(255) NOT NULL, numimatricul VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, siteweb VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE secteur (id INT NOT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, admin_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description TEXT NOT NULL, misajour DATE NOT NULL, image VARCHAR(255) NOT NULL, afficher BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E19D9AD2642B8210 ON service (admin_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE apropos ADD CONSTRAINT FK_2440FEAA642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FBAE89F6D FOREIGN KEY (catcontrat_id) REFERENCES catcontrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FBB0859F1 FOREIGN KEY (recruteur_id) REFERENCES recruteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre_secteur ADD CONSTRAINT FK_2C9E563F4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre_secteur ADD CONSTRAINT FK_2C9E563F9F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678CBF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE apropos DROP CONSTRAINT FK_2440FEAA642B8210');
        $this->addSql('ALTER TABLE gallery DROP CONSTRAINT FK_472B783A642B8210');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD2642B8210');
        $this->addSql('ALTER TABLE competence DROP CONSTRAINT FK_94D4687F8D0EB82');
        $this->addSql('ALTER TABLE formation DROP CONSTRAINT FK_404021BF8D0EB82');
        $this->addSql('ALTER TABLE offre DROP CONSTRAINT FK_AF86866FBAE89F6D');
        $this->addSql('ALTER TABLE offre_secteur DROP CONSTRAINT FK_2C9E563F4CC8505A');
        $this->addSql('ALTER TABLE offre DROP CONSTRAINT FK_AF86866FBB0859F1');
        $this->addSql('ALTER TABLE offre_secteur DROP CONSTRAINT FK_2C9E563F9F7E4405');
        $this->addSql('ALTER TABLE admin DROP CONSTRAINT FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE candidat DROP CONSTRAINT FK_6AB5B471BF396750');
        $this->addSql('ALTER TABLE recruteur DROP CONSTRAINT FK_2BD3678CBF396750');
        $this->addSql('DROP SEQUENCE apropos_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE avis_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE catcontrat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE competence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contact_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE formation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE gallery_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE offre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partenaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE secteur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
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
