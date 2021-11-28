<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IklanMigration extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'kategori_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['aktif', 'nonaktif'],
                'default' => 'aktif',
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp on update current_timestamp',
        ]);
        $this->forge->addForeignKey('user_id', 'user', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'cascade', 'cascade');
        $this->forge->addKey('id');
        $this->forge->createTable('iklan');
    }

    public function down()
    {
        $this->forge->dropTable('iklan');
    }
}
