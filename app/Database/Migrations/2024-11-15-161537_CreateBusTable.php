<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bus' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom_bus' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'nombre_sieges' => [
                'type' => 'INT',
            ],
        ]);
        $this->forge->addKey('id_bus', true);
        $this->forge->createTable('buses');
    }

    public function down()
    {
        $this->forge->dropTable('buses');
    }
}
