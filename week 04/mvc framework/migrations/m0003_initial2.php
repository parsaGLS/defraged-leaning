<?php

//namespace app\migrations;

class m0003_initial2
{

    public function up()
    {
        $db=\app\core\Application::$app->db;
        $SQL="
        CREATE TABLE tasks(
            id INT AUTO_INCREMENT PRIMARY KEY,
            label VARCHAR(255) NOT NULL,
            description LONGTEXT NOT NULL,
            status TINYINT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);

    }

    public function down()
    {
        $db=\app\core\Application::$app->db;
        $SQL="DROP TABLE tasks;";
        $db->pdo->exec($SQL);
    }
}