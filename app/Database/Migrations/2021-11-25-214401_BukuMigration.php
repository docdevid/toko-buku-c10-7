<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BukuMigration extends Migration
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
            'penerbit_id' => [
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
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'berat' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'dimensi' => [
                'type' => 'VARCHAR',
                'constraint' => '11',
            ],
            'bahasa' => [
                'type' => 'VARCHAR',
                'constraint' => '11',
            ],
            'cover' => [
                'type' => 'VARCHAR',
                'constraint' => '11',
            ],
            'ISBN' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 20,
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp on update current_timestamp',
        ]);
        $this->forge->addForeignKey('penerbit_id', 'penerbit', 'id', 'cascade', 'cascade');
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'cascade', 'cascade');
        $this->forge->addKey('id');
        $this->forge->createTable('buku');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}
