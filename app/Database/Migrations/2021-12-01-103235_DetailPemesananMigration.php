<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PemesananMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'pemesanan_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'buku_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'harga' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'sub_total' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'qty' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addForeignKey('pemesanan_id', 'pemesanan', 'id', 'cascade', 'cascade');
        $this->forge->addKey('id');
        $this->forge->createTable('detail_pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('detail_pemesanan');
    }
}
