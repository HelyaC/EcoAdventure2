<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106151113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo_url LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badge_user_badge (badge_id INT NOT NULL, user_badge_id INT NOT NULL, INDEX IDX_EB614847F7A2C2FC (badge_id), INDEX IDX_EB614847172F26FC (user_badge_id), PRIMARY KEY(badge_id, user_badge_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carbon_foot_print (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, foot_print_score DOUBLE PRECISION DEFAULT NULL, calculated DATETIME DEFAULT NULL, INDEX IDX_DE9515339D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_by INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_D70989519D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat_bot_message (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, message LONGTEXT DEFAULT NULL, reponse LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_7639AAC29D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, subject VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, submited_at DATETIME NOT NULL, INDEX IDX_4C62E6389D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE daily_quiz_limit (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, quiz_date DATE DEFAULT NULL, quiz_count INT DEFAULT NULL, INDEX IDX_7E066C839D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE friend (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, friend_id_id INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_55EEAC619D86650F (user_id_id), INDEX IDX_55EEAC61DFD406F3 (friend_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter_subscription (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, email LONGTEXT DEFAULT NULL, subscribed_at DATETIME DEFAULT NULL, INDEX IDX_A82B55AD9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, content LONGTEXT NOT NULL, sent_at DATETIME NOT NULL, `read` TINYINT(1) DEFAULT NULL, INDEX IDX_BF5476CA9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recommendation (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_433224D29D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, eco_score INT DEFAULT NULL, placement INT DEFAULT NULL, newsletter_subscription TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_badge (id INT AUTO_INCREMENT NOT NULL, challenge_description LONGTEXT DEFAULT NULL, points INT DEFAULT NULL, earned_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_badge_user (user_badge_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8EFAFCBC172F26FC (user_badge_id), INDEX IDX_8EFAFCBCA76ED395 (user_id), PRIMARY KEY(user_badge_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_challenge (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, challenge_id_id INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, completed_at DATETIME DEFAULT NULL, INDEX IDX_D7E904B59D86650F (user_id_id), INDEX IDX_D7E904B57B961745 (challenge_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE badge_user_badge ADD CONSTRAINT FK_EB614847F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE badge_user_badge ADD CONSTRAINT FK_EB614847172F26FC FOREIGN KEY (user_badge_id) REFERENCES user_badge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carbon_foot_print ADD CONSTRAINT FK_DE9515339D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D70989519D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE chat_bot_message ADD CONSTRAINT FK_7639AAC29D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE daily_quiz_limit ADD CONSTRAINT FK_7E066C839D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC619D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC61DFD406F3 FOREIGN KEY (friend_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE newsletter_subscription ADD CONSTRAINT FK_A82B55AD9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE recommendation ADD CONSTRAINT FK_433224D29D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_badge_user ADD CONSTRAINT FK_8EFAFCBC172F26FC FOREIGN KEY (user_badge_id) REFERENCES user_badge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_badge_user ADD CONSTRAINT FK_8EFAFCBCA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_challenge ADD CONSTRAINT FK_D7E904B59D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_challenge ADD CONSTRAINT FK_D7E904B57B961745 FOREIGN KEY (challenge_id_id) REFERENCES challenge (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE badge_user_badge DROP FOREIGN KEY FK_EB614847F7A2C2FC');
        $this->addSql('ALTER TABLE badge_user_badge DROP FOREIGN KEY FK_EB614847172F26FC');
        $this->addSql('ALTER TABLE carbon_foot_print DROP FOREIGN KEY FK_DE9515339D86650F');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D70989519D86650F');
        $this->addSql('ALTER TABLE chat_bot_message DROP FOREIGN KEY FK_7639AAC29D86650F');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6389D86650F');
        $this->addSql('ALTER TABLE daily_quiz_limit DROP FOREIGN KEY FK_7E066C839D86650F');
        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC619D86650F');
        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC61DFD406F3');
        $this->addSql('ALTER TABLE newsletter_subscription DROP FOREIGN KEY FK_A82B55AD9D86650F');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA9D86650F');
        $this->addSql('ALTER TABLE recommendation DROP FOREIGN KEY FK_433224D29D86650F');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('ALTER TABLE user_badge_user DROP FOREIGN KEY FK_8EFAFCBC172F26FC');
        $this->addSql('ALTER TABLE user_badge_user DROP FOREIGN KEY FK_8EFAFCBCA76ED395');
        $this->addSql('ALTER TABLE user_challenge DROP FOREIGN KEY FK_D7E904B59D86650F');
        $this->addSql('ALTER TABLE user_challenge DROP FOREIGN KEY FK_D7E904B57B961745');
        $this->addSql('DROP TABLE badge');
        $this->addSql('DROP TABLE badge_user_badge');
        $this->addSql('DROP TABLE carbon_foot_print');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE chat_bot_message');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE daily_quiz_limit');
        $this->addSql('DROP TABLE friend');
        $this->addSql('DROP TABLE newsletter_subscription');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE recommendation');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_badge');
        $this->addSql('DROP TABLE user_badge_user');
        $this->addSql('DROP TABLE user_challenge');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
