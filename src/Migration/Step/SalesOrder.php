<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Migration\Step;

use Migration\Exception;
use Migration\MapReader;
use Migration\Config;
use Migration\App\Step\DeltaInterface;

/**
 * Class Map
 */
class SalesOrder extends DatabaseStep implements DeltaInterface
{
    /**
     * @var Integrity\SalesOrder
     */
    protected $integrity;

    /**
     * @var Run\SalesOrder
     */
    protected $run;

    /**
     * @var Volume\SalesOrder
     */
    protected $volume;

    /**
     * @var SalesOrder\InitialData
     */
    protected $initialData;

    /**
     * @param Config $config
     * @param Integrity\SalesOrder $integrity
     * @param Run\SalesOrder $run
     * @param Volume\SalesOrder $volume
     * @param SalesOrder\InitialData $initialData
     */
    public function __construct(
        Config $config,
        Integrity\SalesOrder $integrity,
        Run\SalesOrder $run,
        Volume\SalesOrder $volume,
        SalesOrder\InitialData $initialData
    ) {
        parent::__construct($config);
        $this->integrity = $integrity;
        $this->run = $run;
        $this->volume = $volume;
        $this->initialData = $initialData;
    }

    /**
     * @inheritdoc
     */
    public function integrity()
    {
        return $this->integrity->perform();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->initialData->init();
        return $this->run->perform();
    }

    /**
     * @inheritdoc
     */
    public function volumeCheck()
    {
        return $this->volume->perform();
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return "SalesOrder step";
    }

    /**
     * @inheritdoc
     */
    public function delta()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function setupTriggers()
    {
        return true;
    }
}
