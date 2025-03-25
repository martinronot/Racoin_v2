<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Annonce;
use App\Model\Annonceur;
use App\Model\Photo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnnonceTest extends TestCase
{
    private Annonce $annonce;

    protected function setUp(): void
    {
        parent::setUp();
        $this->annonce = new Annonce();
    }

    public function testTableName(): void
    {
        $this->assertEquals('annonce', $this->annonce->getTable());
    }

    public function testPrimaryKey(): void
    {
        $this->assertEquals('id_annonce', $this->annonce->getKeyName());
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->annonce->timestamps);
    }

    public function testFillableAttributes(): void
    {
        $expectedFillable = [
            'titre',
            'description',
            'prix',
            'date_publication',
            'id_annonceur'
        ];

        $this->assertEquals($expectedFillable, $this->annonce->getFillable());
    }

    public function testAnnonceurRelation(): void
    {
        $relation = $this->annonce->annonceur();
        
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('id_annonceur', $relation->getForeignKeyName());
    }

    public function testPhotosRelation(): void
    {
        $relation = $this->annonce->photos();
        
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id_annonce', $relation->getForeignKeyName());
    }
}
