<?php

namespace EasyPost\Test;

use EasyPost\Batch;
use EasyPost\EasyPost;

EasyPost::setApiKey('cueqNZUb3ldeWTNX7MU3Mel8UXtaAMUi');

class BatchTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test the creation of a batch
     *
     * @return void
     */
    public function testCreate()
    {
        $batch_params_1 = array(
            "street1" => "388 Townsend St",
            "street2" => "Apt 20",
            "city"    => "San Francisco",
            "state"   => "CA",
            "zip"     => "94107"
        );
        $batch = Batch::create($batch_params_1);
        $this->assertInstanceOf('\EasyPost\Batch', $batch);
        $this->assertIsString($batch->id);
        $this->assertStringMatchesFormat("batch_%s", $batch->id);

        return $batch;
    }

    /**
     * Test adding a shipment to a batch
     *
     * @return void
     */
    public function testAddShipment()
    {
        $batch_params_2 = array(
            "street1" => "388 Townsend St",
            "street2" => "Apt 20",
            "city"    => "San Francisco",
            "state"   => "CA",
            "zip"     => "94107"
        );
        $add_shipment = Batch::retrieve($batch->id);
        $batch->add_shipments($batch_params_2);

        return $batch;
    }

    /**
     * Test the retrieval of a batch
     *
     * @param Batch $batch
     * @return void
     * @depends testCreate 
     * @depends testAddShipment
     */
    public function testRetrieve(Batch $batch)
    {
        $retrieved_batch = Batch::retrieve($batch->id);

        $this->assertInstanceOf('\EasyPost\Batch', $retrieved_batch);
        $this->assertEquals($retrieved_batch->id, $batch->id);
        $this->assertEquals($retrieved_batch, $batch);

        return $retrieved_batch;
    }
}
