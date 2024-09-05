<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905135538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `questions` and `question_options` tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE question_options (
                id SERIAL,
                question_id INT DEFAULT NULL,
                text VARCHAR(255) NOT NULL,
                is_correct_answer BOOLEAN NOT NULL,
                PRIMARY KEY(id)
            )',
        );
        $this->addSql('CREATE INDEX question_options_question_id_idx ON question_options (question_id)');
        $this->addSql('
            CREATE TABLE questions (
                id SERIAL,
                text VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)
            )'
        );
        $this->addSql(
            'ALTER TABLE question_options ADD CONSTRAINT question_options_question_id_idx FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE',
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE question_options DROP CONSTRAINT question_options_question_id_idx');
        $this->addSql('DROP TABLE question_options');
        $this->addSql('DROP TABLE questions');
    }
}
