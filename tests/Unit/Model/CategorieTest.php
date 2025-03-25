<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Categorie;
use App\Model\SousCategorie;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategorieTest extends TestCase
{
    private Categorie $categorie;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categorie = new Categorie();
    }

    public function testTableName(): void
    {
        $this->assertEquals('categorie', $this->categorie->getTable());
    }

    public function testPrimaryKey(): void
    {
        $this->assertEquals('id_categorie', $this->categorie->getKeyName());
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->categorie->timestamps);
    }

    public function testFillableAttributes(): void
    {
        $expectedFillable = [
            'nom',
            'description'
        ];

        $this->assertEquals($expectedFillable, $this->categorie->getFillable());
    }

    public function testSousCategoriesRelation(): void
    {
        $relation = $this->categorie->sousCategories();
        
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('id_categorie', $relation->getForeignKeyName());
    }
}
