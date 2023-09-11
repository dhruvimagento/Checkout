<?php
namespace LD\CustomCheckout\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $installer->getConnection()->addColumn(
            $installer->getTable('quote'),
            'address_type',
            [
                'type' => Table::TYPE_TEXT,
                'nullable' => false,
                'comment' => 'Address Type',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order'),
            'address_type',
            [
                'type' => Table::TYPE_TEXT,
                'nullable' => false,
                'comment' => 'Address Type',
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_grid'),
            'address_type',
            [
                'type' => Table::TYPE_TEXT,
                'nullable' => false,
                'comment' => 'Address Type',
            ]
        );

        $setup->endSetup();
    }
}