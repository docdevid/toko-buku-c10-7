<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenerbitMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'penerbit' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'created_at timestamp DEFAULT CURRENT_TIMESTAMP',
            'updated_at timestamp ON UPDATE CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('penerbit');
    }

    public function down()
    {
        $this->forge->dropTable('penerbit');
    }
}
