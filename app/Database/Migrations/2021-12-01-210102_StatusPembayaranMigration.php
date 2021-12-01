<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusPembayaranMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pemesanan_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['dibayar', 'belum dibayar'],
                'default' => 'belum dibayar',
            ],
            'created_at timestamp DEFAULT CURRENT_TIMESTAMP',
            'updated_at timestamp ON UPDATE CURRENT_TIMESTAMP'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pemesanan_id', 'pemesanan', 'id');
        $this->forge->createTable('status_pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('status_pembayaran');
    }
}
