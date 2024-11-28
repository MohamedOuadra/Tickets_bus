<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiegeReservationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siege_reservation' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_reservation' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false,
            ],
            'id_siege' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => false,
            ],
            'date_depart' => [
                'type' => 'DATE',
                'null' => false,
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

        $this->forge->addPrimaryKey('id_siege_reservation');
        $this->forge->addForeignKey('id_reservation', 'reservations', 'id_reservation', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_siege', 'sieges', 'id_siege', 'CASCADE', 'CASCADE');
        $this->forge->createTable('siege_reservations');
    }

    public function down()
    {
        $this->forge->dropTable('siege_reservations');
    }
}
