<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181220122813 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE dc_alert_sequence');
        $this->addSql('DROP TABLE dc_alerts');
        $this->addSql('DROP TABLE dc_profile');
        $this->addSql('DROP TABLE dc_thresholds');
        $this->addSql('ALTER TABLE dc_capacity ADD last_update DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, DROP LastUpdate');
        $this->addSql('ALTER TABLE dc_environment CHANGE envLastUpdate envLastUpdate DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dc_alert_sequence (ID INT AUTO_INCREMENT NOT NULL, dc_capacity VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, dc_env VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, dc_network VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, dc_nodes_status VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, dc_alarms_mute VARCHAR(5) DEFAULT \'0\' COLLATE latin1_swedish_ci, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dc_alerts (ID INT AUTO_INCREMENT NOT NULL, dc_phone VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, dc_email VARCHAR(150) DEFAULT NULL COLLATE latin1_swedish_ci, dc_sms VARCHAR(20) DEFAULT NULL COLLATE latin1_swedish_ci, dc_chat VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dc_profile (ID INT AUTO_INCREMENT NOT NULL, farm_name VARCHAR(100) DEFAULT NULL COLLATE latin1_swedish_ci, farm_user VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, farm_pass VARCHAR(200) DEFAULT NULL COLLATE latin1_swedish_ci, last_checked DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dc_thresholds (ID INT AUTO_INCREMENT NOT NULL, temp_min DOUBLE PRECISION DEFAULT NULL, temp_max DOUBLE PRECISION DEFAULT NULL, temp_lastupdate DATETIME DEFAULT NULL, humidity_min DOUBLE PRECISION DEFAULT NULL, humidity_max DOUBLE PRECISION DEFAULT NULL, humidity_lastupdate DATETIME DEFAULT NULL, farm_node_count INT DEFAULT NULL, grid_node_count INT DEFAULT NULL, grid_run_update DATETIME DEFAULT NULL, lan_min_throughput DOUBLE PRECISION DEFAULT NULL, wan_min_down DOUBLE PRECISION DEFAULT NULL, wan_min_up DOUBLE PRECISION DEFAULT NULL, network_lastupdate DATETIME DEFAULT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dc_capacity ADD LastUpdate DATETIME DEFAULT CURRENT_TIMESTAMP, DROP last_update');
        $this->addSql('ALTER TABLE dc_environment CHANGE envLastUpdate envLastUpdate DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
