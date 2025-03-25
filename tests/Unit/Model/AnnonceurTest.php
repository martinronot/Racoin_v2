<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Annonceur;
use App\Model\Annonce;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnnonceurTest extends TestCase
{
    private Annonceur $annonceur;

    protected function setUp(): void
    {
        parent::setUp();
        $this->annonceur = new Annonceur();
    }

    public function testTableName(): void
    {
        $this->assertEquals('annonceur', $this->annonceur->getTable());
    }

    public function testPrimaryKey(): void
    {
        $this->assertEquals('id_annonceur', $this->annonceur->getKeyName());
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->annonceur->timestamps);
    }

    public function testFillableAttributes(): void
    {
        $expectedFillable = [
            'nom',
            'email',
            'telephone',
            'date_inscription'
        ];

        $this->assertEquals($expectedFillable, $this->annonceur->getFillable());
    }

    public function testAnnoncesRelation(): void
    {
        $relation = $this->annonceur->annonces();
        
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id_annonceur', $relation->getForeignKeyName());
    }
}
