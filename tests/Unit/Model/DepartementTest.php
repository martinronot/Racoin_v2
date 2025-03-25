<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Departement;
use App\Model\Region;
use App\Model\Annonce;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DepartementTest extends TestCase
{
    private Departement $departement;

    protected function setUp(): void
    {
        parent::setUp();
        $this->departement = new Departement();
    }

    public function testTableName(): void
    {
        $this->assertEquals('departement', $this->departement->getTable());
    }

    public function testPrimaryKey(): void
    {
        $this->assertEquals('id_departement', $this->departement->getKeyName());
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->departement->timestamps);
    }

    public function testFillableAttributes(): void
    {
        $expectedFillable = [
            'nom',
            'code',
            'id_region'
        ];

        $this->assertEquals($expectedFillable, $this->departement->getFillable());
    }

    public function testRegionRelation(): void
    {
        $relation = $this->departement->region();
        
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('id_region', $relation->getForeignKeyName());
    }

    public function testAnnoncesRelation(): void
    {
        $relation = $this->departement->annonces();
        
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id_departement', $relation->getForeignKeyName());
    }
}
