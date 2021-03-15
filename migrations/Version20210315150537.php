<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315150537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE admin ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE apropos ADD CONSTRAINT FK_2440FEAA642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2440FEAA642B8210 ON apropos (admin_id)');
        $this->addSql('ALTER TABLE apropos ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE avis ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471BF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE candidat ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE catcontrat ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_94D4687F8D0EB82 ON competence (candidat_id)');
        $this->addSql('ALTER TABLE competence ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE contact ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_404021BF8D0EB82 ON formation (candidat_id)');
        $this->addSql('ALTER TABLE formation ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE gallery ADD CONSTRAINT FK_472B783A642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_472B783A642B8210 ON gallery (admin_id)');
        $this->addSql('ALTER TABLE gallery ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FBAE89F6D FOREIGN KEY (catcontrat_id) REFERENCES catcontrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FBB0859F1 FOREIGN KEY (recruteur_id) REFERENCES recruteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AF86866FBAE89F6D ON offre (catcontrat_id)');
        $this->addSql('CREATE INDEX IDX_AF86866FBB0859F1 ON offre (recruteur_id)');
        $this->addSql('ALTER TABLE offre ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE offre_secteur ADD CONSTRAINT FK_2C9E563F4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offre_secteur ADD CONSTRAINT FK_2C9E563F9F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2C9E563F4CC8505A ON offre_secteur (offre_id)');
        $this->addSql('CREATE INDEX IDX_2C9E563F9F7E4405 ON offre_secteur (secteur_id)');
        $this->addSql('ALTER TABLE offre_secteur ADD PRIMARY KEY (offre_id, secteur_id)');
        $this->addSql('ALTER TABLE partenaire ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE recruteur ADD CONSTRAINT FK_2BD3678CBF396750 FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recruteur ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE secteur ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E19D9AD2642B8210 ON service (admin_id)');
        $this->addSql('ALTER TABLE service ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE users ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE admin DROP CONSTRAINT FK_880E0D76BF396750');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE apropos DROP CONSTRAINT FK_2440FEAA642B8210');
        $this->addSql('DROP INDEX IDX_2440FEAA642B8210');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE candidat DROP CONSTRAINT FK_6AB5B471BF396750');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE competence DROP CONSTRAINT FK_94D4687F8D0EB82');
        $this->addSql('DROP INDEX IDX_94D4687F8D0EB82');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE formation DROP CONSTRAINT FK_404021BF8D0EB82');
        $this->addSql('DROP INDEX IDX_404021BF8D0EB82');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE gallery DROP CONSTRAINT FK_472B783A642B8210');
        $this->addSql('DROP INDEX IDX_472B783A642B8210');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE offre DROP CONSTRAINT FK_AF86866FBAE89F6D');
        $this->addSql('ALTER TABLE offre DROP CONSTRAINT FK_AF86866FBB0859F1');
        $this->addSql('DROP INDEX IDX_AF86866FBAE89F6D');
        $this->addSql('DROP INDEX IDX_AF86866FBB0859F1');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE offre_secteur DROP CONSTRAINT FK_2C9E563F4CC8505A');
        $this->addSql('ALTER TABLE offre_secteur DROP CONSTRAINT FK_2C9E563F9F7E4405');
        $this->addSql('DROP INDEX IDX_2C9E563F4CC8505A');
        $this->addSql('DROP INDEX IDX_2C9E563F9F7E4405');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE recruteur DROP CONSTRAINT FK_2BD3678CBF396750');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD2642B8210');
        $this->addSql('DROP INDEX IDX_E19D9AD2642B8210');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('DROP INDEX "primary"');
    }
}
