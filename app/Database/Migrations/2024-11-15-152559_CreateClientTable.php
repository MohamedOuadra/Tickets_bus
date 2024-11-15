<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_client' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom_client' => [
                'type'       => 'VARCHAR',
                'constraint' => 25,
            ],
            'prenom_client' => [
                'type'       => 'VARCHAR',
                'constraint' => 25,
            ],
            'email_client' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'telephone_client' => [
                'type'       => 'VARCHAR',
                'constraint' => 13,
            ],
            'mot_de_passe' => [
                'type'       => 'VARCHAR',
                'constraint' => 25,
            ],
        ]);
        $this->forge->addKey('id_client', true);
        $this->forge->createTable('clients');
    }

    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
