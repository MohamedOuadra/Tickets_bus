<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiegesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siege' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_bus' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'numero_siege' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
                'default'    => null,
            ],
            'updated_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
                'default'    => null,
            ],
        ]);

        $this->forge->addPrimaryKey('id_siege');
        $this->forge->addForeignKey('id_bus', 'buses', 'id_bus', 'CASCADE', 'CASCADE');

        $this->forge->createTable('sieges');
    }

    public function down()
    {
        $this->forge->dropTable('sieges');
    }
}
