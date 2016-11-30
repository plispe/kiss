<?php

use Phinx\Migration\AbstractMigration;

class CreateChangelogTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $t = $this->table('changelog');

        $t
            ->addColumn('table', 'string')
            ->addColumn('record_id', 'integer')
            ->addColumn('property', 'string')
            ->addColumn('old_value', 'text')
            ->addColumn("new_value", 'text')
            ->addColumn('identity', 'integer');


        $t->create();
    }
}
