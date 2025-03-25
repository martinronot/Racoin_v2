<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use App\Model\SousCategorie;
use App\Model\Categorie;
use App\Model\Annonce;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SousCategorieTest extends TestCase
{
    private SousCategorie $sousCategorie;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sousCategorie = new SousCategorie();
    }

    public function testTableName(): void
    {
        $this->assertEquals('sous_categorie', $this->sousCategorie->getTable());
    }

    public function testPrimaryKey(): void
    {
        $this->assertEquals('id_sous_categorie', $this->sousCategorie->getKeyName());
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->sousCategorie->timestamps);
    }

    public function testFillableAttributes(): void
    {
        $expectedFillable = [
            'nom',
            'description',
            'id_categorie'
        ];

        $this->assertEquals($expectedFillable, $this->sousCategorie->getFillable());
    }

    public function testCategorieRelation(): void
    {
        $relation = $this->sousCategorie->categorie();
        
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('id_categorie', $relation->getForeignKeyName());
    }

    public function testAnnoncesRelation(): void
    {
        $relation = $this->sousCategorie->annonces();
        
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id_sous_categorie', $relation->getForeignKeyName());
    }
}
