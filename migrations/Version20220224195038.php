<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224195038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE shoes');
        $this->addSql('DROP TABLE tshirt');
        $this->addSql('ALTER TABLE product CHANGE type size VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shoes (size INT NOT NULL, idProduct INT NOT NULL, PRIMARY KEY(idProduct)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tshirt (size VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, idProduct INT NOT NULL, PRIMARY KEY(idProduct)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE shoes ADD CONSTRAINT FK_14CF8197C3F36F5F FOREIGN KEY (idProduct) REFERENCES product (idProduct) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tshirt ADD CONSTRAINT FK_6CF6F579C3F36F5F FOREIGN KEY (idProduct) REFERENCES product (idProduct) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product CHANGE size type VARCHAR(255) NOT NULL');
    }
}
