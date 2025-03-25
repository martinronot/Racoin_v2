<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Region;
use App\Model\Departement;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegionTest extends TestCase
{
    private Region $region;

    protected function setUp(): void
    {
        parent::setUp();
        $this->region = new Region();
    }

    public function testTableName(): void
    {
        $this->assertEquals('region', $this->region->getTable());
    }

    public function testPrimaryKey(): void
    {
        $this->assertEquals('id_region', $this->region->getKeyName());
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->region->timestamps);
    }

    public function testFillableAttributes(): void
    {
        $expectedFillable = [
            'nom',
            'code'
        ];

        $this->assertEquals($expectedFillable, $this->region->getFillable());
    }

    public function testDepartementsRelation(): void
    {
        $relation = $this->region->departements();
        
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id_region', $relation->getForeignKeyName());
    }
}
