<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726194151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE industry (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CDFA6CA05E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sector (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4BA3D9E85E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setup (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_251D56305E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_389B7835E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticker (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, updated DATE NOT NULL, UNIQUE INDEX UNIQ_7EC3089677153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticker_average (id INT AUTO_INCREMENT NOT NULL, ticker_id INT NOT NULL, day_gap SMALLINT DEFAULT NULL, avg_volume NUMERIC(11, 2) DEFAULT NULL, avg_gap NUMERIC(11, 2) DEFAULT NULL, avg_eod NUMERIC(11, 2) DEFAULT NULL, avg_otoh NUMERIC(11, 2) DEFAULT NULL, avg_otoh_greater0 NUMERIC(11, 2) DEFAULT NULL, avg_otol NUMERIC(11, 2) DEFAULT NULL, avg_otol_lower0 NUMERIC(11, 2) DEFAULT NULL, avg_range NUMERIC(11, 2) DEFAULT NULL, eod_greater0 NUMERIC(11, 2) DEFAULT NULL, eod_less0 NUMERIC(11, 2) DEFAULT NULL, eod_count INT DEFAULT NULL, updated DATE NOT NULL, INDEX IDX_DC950FA1556B180E (ticker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticker_open_to_hi (id INT AUTO_INCREMENT NOT NULL, ticker_id INT NOT NULL, updated DATETIME NOT NULL, day SMALLINT DEFAULT NULL, less_than10 INT DEFAULT NULL, count10 INT DEFAULT NULL, count20 INT DEFAULT NULL, count30 INT DEFAULT NULL, count40 INT DEFAULT NULL, count50 INT DEFAULT NULL, count60 INT DEFAULT NULL, count70 INT DEFAULT NULL, count80 INT DEFAULT NULL, count90 INT DEFAULT NULL, greater_than100 INT DEFAULT NULL, INDEX IDX_658C102B556B180E (ticker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticker_performance (id INT AUTO_INCREMENT NOT NULL, ticker_id INT NOT NULL, sector_id INT DEFAULT NULL, industry_id INT DEFAULT NULL, date DATE NOT NULL, open NUMERIC(11, 2) NOT NULL, hi NUMERIC(11, 2) NOT NULL, low NUMERIC(11, 2) NOT NULL, close NUMERIC(11, 2) NOT NULL, volume INT NOT NULL, gap NUMERIC(11, 2) NOT NULL, end_of_day NUMERIC(11, 2) NOT NULL, open_to_high NUMERIC(11, 2) NOT NULL, open_to_low NUMERIC(11, 2) NOT NULL, range_in_price NUMERIC(11, 2) NOT NULL, atr NUMERIC(11, 2) NOT NULL, share_float INT NOT NULL, short_float NUMERIC(11, 2) NOT NULL, insiders_own NUMERIC(11, 2) NOT NULL, institution_own NUMERIC(11, 2) NOT NULL, dilution VARCHAR(255) NOT NULL, market_cap INT NOT NULL, news LONGTEXT DEFAULT NULL, etb SMALLINT DEFAULT NULL, ssr SMALLINT DEFAULT NULL, float_rotation NUMERIC(11, 2) NOT NULL, day_gap SMALLINT DEFAULT NULL, INDEX IDX_4EA24F23556B180E (ticker_id), INDEX IDX_4EA24F23DE95C867 (sector_id), INDEX IDX_4EA24F232B19A734 (industry_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticker_setup_performance (id INT AUTO_INCREMENT NOT NULL, ticker_performance_id INT NOT NULL, setup_id INT NOT NULL, datetime DATETIME NOT NULL, bounce_at_the_open SMALLINT DEFAULT NULL, tanked_at_the_open SMALLINT DEFAULT NULL, choopy_at_the_open SMALLINT DEFAULT NULL, vwap_rejection SMALLINT DEFAULT NULL, vwap_rejection_time DATETIME NOT NULL, price_hi NUMERIC(11, 2) NOT NULL, hi_time DATETIME NOT NULL, price_low NUMERIC(11, 2) NOT NULL, low_time DATETIME NOT NULL, hod_before_zb NUMERIC(11, 2) NOT NULL, zb SMALLINT DEFAULT NULL, zb_time DATETIME NOT NULL, zb_hi NUMERIC(11, 2) NOT NULL, zb_hi_to_hod NUMERIC(11, 2) NOT NULL, adf SMALLINT DEFAULT NULL, channel_t SMALLINT DEFAULT NULL, eod_breakdown SMALLINT DEFAULT NULL, eod_squeeze SMALLINT DEFAULT NULL, squeeze_time DATETIME NOT NULL, above_vwap330 SMALLINT DEFAULT NULL, chart_link VARCHAR(512) DEFAULT NULL, INDEX IDX_561B5AEF1373ACC9 (ticker_performance_id), INDEX IDX_561B5AEFCDCDB68E (setup_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticker_setup_perfomance_tag (ticker_setup_performance_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_15D04AC7ECE2EC9 (ticker_setup_performance_id), INDEX IDX_15D04AC7BAD26311 (tag_id), PRIMARY KEY(ticker_setup_performance_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE waring_flag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, warning_type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_17C1ADD75E237E06 (name), UNIQUE INDEX UNIQ_17C1ADD7CA458B9A (warning_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ticker_average ADD CONSTRAINT FK_DC950FA1556B180E FOREIGN KEY (ticker_id) REFERENCES ticker (id)');
        $this->addSql('ALTER TABLE ticker_open_to_hi ADD CONSTRAINT FK_658C102B556B180E FOREIGN KEY (ticker_id) REFERENCES ticker (id)');
        $this->addSql('ALTER TABLE ticker_performance ADD CONSTRAINT FK_4EA24F23556B180E FOREIGN KEY (ticker_id) REFERENCES ticker (id)');
        $this->addSql('ALTER TABLE ticker_performance ADD CONSTRAINT FK_4EA24F23DE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id)');
        $this->addSql('ALTER TABLE ticker_performance ADD CONSTRAINT FK_4EA24F232B19A734 FOREIGN KEY (industry_id) REFERENCES industry (id)');
        $this->addSql('ALTER TABLE ticker_setup_performance ADD CONSTRAINT FK_561B5AEF1373ACC9 FOREIGN KEY (ticker_performance_id) REFERENCES ticker_performance (id)');
        $this->addSql('ALTER TABLE ticker_setup_performance ADD CONSTRAINT FK_561B5AEFCDCDB68E FOREIGN KEY (setup_id) REFERENCES setup (id)');
        $this->addSql('ALTER TABLE ticker_setup_perfomance_tag ADD CONSTRAINT FK_15D04AC7ECE2EC9 FOREIGN KEY (ticker_setup_performance_id) REFERENCES ticker_setup_performance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticker_setup_perfomance_tag ADD CONSTRAINT FK_15D04AC7BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE daily_prediction ADD CONSTRAINT FK_CBDA92AB1373ACC9 FOREIGN KEY (ticker_performance_id) REFERENCES ticker_performance (id)');
        $this->addSql('ALTER TABLE daily_prediction ADD CONSTRAINT FK_CBDA92ABCDCDB68E FOREIGN KEY (setup_id) REFERENCES setup (id)');
        $this->addSql('ALTER TABLE daily_prediction_tag ADD CONSTRAINT FK_5D7E6A4E961DA428 FOREIGN KEY (daily_prediction_id) REFERENCES daily_prediction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE daily_prediction_tag ADD CONSTRAINT FK_5D7E6A4EBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticker_performance DROP FOREIGN KEY FK_4EA24F232B19A734');
        $this->addSql('ALTER TABLE ticker_performance DROP FOREIGN KEY FK_4EA24F23DE95C867');
        $this->addSql('ALTER TABLE daily_prediction DROP FOREIGN KEY FK_CBDA92ABCDCDB68E');
        $this->addSql('ALTER TABLE ticker_setup_performance DROP FOREIGN KEY FK_561B5AEFCDCDB68E');
        $this->addSql('ALTER TABLE daily_prediction_tag DROP FOREIGN KEY FK_5D7E6A4EBAD26311');
        $this->addSql('ALTER TABLE ticker_setup_perfomance_tag DROP FOREIGN KEY FK_15D04AC7BAD26311');
        $this->addSql('ALTER TABLE ticker_average DROP FOREIGN KEY FK_DC950FA1556B180E');
        $this->addSql('ALTER TABLE ticker_open_to_hi DROP FOREIGN KEY FK_658C102B556B180E');
        $this->addSql('ALTER TABLE ticker_performance DROP FOREIGN KEY FK_4EA24F23556B180E');
        $this->addSql('ALTER TABLE daily_prediction DROP FOREIGN KEY FK_CBDA92AB1373ACC9');
        $this->addSql('ALTER TABLE ticker_setup_performance DROP FOREIGN KEY FK_561B5AEF1373ACC9');
        $this->addSql('ALTER TABLE ticker_setup_perfomance_tag DROP FOREIGN KEY FK_15D04AC7ECE2EC9');
        $this->addSql('DROP TABLE industry');
        $this->addSql('DROP TABLE sector');
        $this->addSql('DROP TABLE setup');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE ticker');
        $this->addSql('DROP TABLE ticker_average');
        $this->addSql('DROP TABLE ticker_open_to_hi');
        $this->addSql('DROP TABLE ticker_performance');
        $this->addSql('DROP TABLE ticker_setup_performance');
        $this->addSql('DROP TABLE ticker_setup_perfomance_tag');
        $this->addSql('DROP TABLE waring_flag');
        $this->addSql('ALTER TABLE daily_prediction_tag DROP FOREIGN KEY FK_5D7E6A4E961DA428');
    }
}
