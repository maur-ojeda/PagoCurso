<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104093018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE attachment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE expense_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE income_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE monthly_fee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE special_event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE student_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_student_course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE attachment (id INT NOT NULL, expense_id_id INT DEFAULT NULL, income_id_id INT DEFAULT NULL, monthly_fee_id_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_795FD9BBDC4C396D ON attachment (expense_id_id)');
        $this->addSql('CREATE INDEX IDX_795FD9BBA358D98E ON attachment (income_id_id)');
        $this->addSql('CREATE INDEX IDX_795FD9BBDD0BF106 ON attachment (monthly_fee_id_id)');
        $this->addSql('CREATE TABLE course (id INT NOT NULL, academic_year INT NOT NULL, level VARCHAR(255) NOT NULL, section VARCHAR(3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE expense (id INT NOT NULL, spacial_event_id_id INT NOT NULL, amount INT NOT NULL, expense_date DATE NOT NULL, expense_concept VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D3A8DA686D2DB1C ON expense (spacial_event_id_id)');
        $this->addSql('CREATE TABLE income (id INT NOT NULL, special_event_id_id INT DEFAULT NULL, amount INT NOT NULL, income_date DATE NOT NULL, income_concept VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3FA862D0F5DAFCD3 ON income (special_event_id_id)');
        $this->addSql('CREATE TABLE log (id INT NOT NULL, user_id_id INT NOT NULL, table_name VARCHAR(255) NOT NULL, record_id INT NOT NULL, action VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, timestamp TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F3F68C59D86650F ON log (user_id_id)');
        $this->addSql('CREATE TABLE monthly_fee (id INT NOT NULL, amount INT NOT NULL, status VARCHAR(255) NOT NULL, month INT NOT NULL, year INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE special_event (id INT NOT NULL, event_name VARCHAR(255) NOT NULL, event_date DATE NOT NULL, event_concept VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE student (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, national_id VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, national_id VARCHAR(255) NOT NULL, user_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_student_course (id INT NOT NULL, user_id_id INT NOT NULL, student_id_id INT NOT NULL, course_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F32D68609D86650F ON user_student_course (user_id_id)');
        $this->addSql('CREATE INDEX IDX_F32D6860F773E7CA ON user_student_course (student_id_id)');
        $this->addSql('CREATE INDEX IDX_F32D686096EF99BF ON user_student_course (course_id_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BBDC4C396D FOREIGN KEY (expense_id_id) REFERENCES expense (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BBA358D98E FOREIGN KEY (income_id_id) REFERENCES income (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attachment ADD CONSTRAINT FK_795FD9BBDD0BF106 FOREIGN KEY (monthly_fee_id_id) REFERENCES monthly_fee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA686D2DB1C FOREIGN KEY (spacial_event_id_id) REFERENCES special_event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D0F5DAFCD3 FOREIGN KEY (special_event_id_id) REFERENCES special_event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C59D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_student_course ADD CONSTRAINT FK_F32D68609D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_student_course ADD CONSTRAINT FK_F32D6860F773E7CA FOREIGN KEY (student_id_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_student_course ADD CONSTRAINT FK_F32D686096EF99BF FOREIGN KEY (course_id_id) REFERENCES course (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE attachment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE expense_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE income_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE log_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE monthly_fee_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE special_event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE student_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_student_course_id_seq CASCADE');
        $this->addSql('ALTER TABLE attachment DROP CONSTRAINT FK_795FD9BBDC4C396D');
        $this->addSql('ALTER TABLE attachment DROP CONSTRAINT FK_795FD9BBA358D98E');
        $this->addSql('ALTER TABLE attachment DROP CONSTRAINT FK_795FD9BBDD0BF106');
        $this->addSql('ALTER TABLE expense DROP CONSTRAINT FK_2D3A8DA686D2DB1C');
        $this->addSql('ALTER TABLE income DROP CONSTRAINT FK_3FA862D0F5DAFCD3');
        $this->addSql('ALTER TABLE log DROP CONSTRAINT FK_8F3F68C59D86650F');
        $this->addSql('ALTER TABLE user_student_course DROP CONSTRAINT FK_F32D68609D86650F');
        $this->addSql('ALTER TABLE user_student_course DROP CONSTRAINT FK_F32D6860F773E7CA');
        $this->addSql('ALTER TABLE user_student_course DROP CONSTRAINT FK_F32D686096EF99BF');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE expense');
        $this->addSql('DROP TABLE income');
        $this->addSql('DROP TABLE log');
        $this->addSql('DROP TABLE monthly_fee');
        $this->addSql('DROP TABLE special_event');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_student_course');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
