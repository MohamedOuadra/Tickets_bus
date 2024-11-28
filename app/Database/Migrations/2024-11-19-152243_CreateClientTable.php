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
                'null'       => false,
            ],
            'prenom_client' => [
                'type'       => 'VARCHAR',
                'constraint' => 25,
                'null'       => false,
            ],
            'email_client' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'telephone_client' => [
                'type'       => 'VARCHAR',
                'constraint' => 13,
                'null'       => false,
            ],
            'mot_de_passe' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
            ],
        ]);

        $this->forge->addPrimaryKey('id_client');
        $this->forge->createTable('clients');
    }

    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
