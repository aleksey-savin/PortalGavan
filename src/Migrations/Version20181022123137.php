<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181022123137 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE foreign_company ADD is_deleted BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE app_users ADD is_deleted BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE trade_point ADD is_deleted BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE commission ADD is_deleted BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE services_supplier ADD is_deleted BOOLEAN DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE services_supplier DROP is_deleted');
        $this->addSql('ALTER TABLE app_users DROP is_deleted');
        $this->addSql('ALTER TABLE foreign_company DROP is_deleted');
        $this->addSql('ALTER TABLE trade_point DROP is_deleted');
        $this->addSql('ALTER TABLE commission DROP is_deleted');
    }
}
