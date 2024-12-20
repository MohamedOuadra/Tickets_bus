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
        $this->forge->addPrimaryKey('id_bus');
        $this->forge->createTable('buses');
    }

    public function down()
    {
        $this->forge->dropTable('buses');
    }
}
