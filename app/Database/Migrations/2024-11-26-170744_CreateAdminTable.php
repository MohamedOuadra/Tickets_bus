<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email_admin' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'mot_de_passe' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);

        // Définir la clé primaire
        $this->forge->addPrimaryKey('id_admin');

        // Créer la table
        $this->forge->createTable('admin');
    }

    public function down()
    {
        // Supprimer la table
        $this->forge->dropTable('admin');
    }
}
