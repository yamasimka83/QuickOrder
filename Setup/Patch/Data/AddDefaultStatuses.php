<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Lukas\QuickOrder\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class AddDefaultStatuses
 * @package Lukas\QuickOrder\Setup\Patch\Data
 */
class AddDefaultStatuses implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $statuses = [
            ['name' => 'Pending'],
            ['name' => 'Approved'],
            ['name' => 'Decline'],
            ];
        foreach ($statuses as $status) {
            $this->moduleDataSetup->getConnection()
                ->insertForce(
                    $this->moduleDataSetup->getTable('quick_order_statuses'),
                    $status
                );
        }

    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }
}
