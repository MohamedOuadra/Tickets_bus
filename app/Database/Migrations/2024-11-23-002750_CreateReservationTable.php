<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_reservation' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
                'auto_increment' => true,
            ],
            'id_siege' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'id_client' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'id_route' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
            ],
            'ticket_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 125,
                'null'       => false,
            ],
            'date_reservation' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Add primary key
        $this->forge->addPrimaryKey('id_reservation');

        // Add foreign keys
        $this->forge->addForeignKey('id_siege', 'sieges', 'id_siege', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_client', 'clients', 'id_client', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_route', 'routes', 'id_route', 'CASCADE', 'CASCADE');

        $this->forge->createTable('reservations');
    }

    public function down()
    {
        $this->forge->dropTable('reservations');
    }
}
