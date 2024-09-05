<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240905140445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Seed data';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('1 + 1 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '3', false),
                ((SELECT id FROM added_question), '2', true),
                ((SELECT id FROM added_question), '0', false);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('2 + 2 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '4', true),
                ((SELECT id FROM added_question), '3 + 1', true),
                ((SELECT id FROM added_question), '10', false);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('3 + 3 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '1 + 5', true),
                ((SELECT id FROM added_question), '1', false),
                ((SELECT id FROM added_question), '6', true),
                ((SELECT id FROM added_question), '2 + 4', true);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('4 + 4 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '8', true),
                ((SELECT id FROM added_question), '4', false),
                ((SELECT id FROM added_question), '0', false),
                ((SELECT id FROM added_question), '0 + 8', true);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('5 + 5 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '6', false),
                ((SELECT id FROM added_question), '18', false),
                ((SELECT id FROM added_question), '10', true),
                ((SELECT id FROM added_question), '9', false),
                ((SELECT id FROM added_question), '0', false);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('6 + 6 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '3', false),
                ((SELECT id FROM added_question), '9', false),
                ((SELECT id FROM added_question), '0', false),
                ((SELECT id FROM added_question), '12', true),
                ((SELECT id FROM added_question), '5 + 7', true);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('7 + 7 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '5', false),
                ((SELECT id FROM added_question), '14', true);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('8 + 8 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '16', true),
                ((SELECT id FROM added_question), '12', false),
                ((SELECT id FROM added_question), '9', false),
                ((SELECT id FROM added_question), '5', false);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('9 + 9 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '18', true),
                ((SELECT id FROM added_question), '9', false),
                ((SELECT id FROM added_question), '17 + 1', true),
                ((SELECT id FROM added_question), '2 + 16', true);
            "
        );

        $this->addSql(
            "WITH added_question AS (
                INSERT INTO questions (text) VALUES ('10 + 10 = ') RETURNING id
            )
            INSERT INTO question_options (question_id, text, is_correct_answer)
            VALUES
                ((SELECT id FROM added_question), '0', false),
                ((SELECT id FROM added_question), '2', false),
                ((SELECT id FROM added_question), '8', false),
                ((SELECT id FROM added_question), '20', true);
            "
        );
    }

    public function down(Schema $schema): void
    {
    }
}
