<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBusRouteTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bus_route' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_bus' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'id_route' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],
            'heure_depart' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'heure_arrivee' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'prix' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
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

        $this->forge->addPrimaryKey('id_bus_route');
        $this->forge->addForeignKey('id_bus', 'buses', 'id_bus', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_route', 'routes', 'id_route', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bus_route');
    }

    public function down()
    {
        $this->forge->dropTable('bus_route');
    }
}
