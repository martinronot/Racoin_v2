<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use App\Model\Photo;
use App\Model\Annonce;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhotoTest extends TestCase
{
    private Photo $photo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->photo = new Photo();
    }

    public function testTableName(): void
    {
        $this->assertEquals('photo', $this->photo->getTable());
    }

    public function testPrimaryKey(): void
    {
        $this->assertEquals('id_photo', $this->photo->getKeyName());
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->photo->timestamps);
    }

    public function testFillableAttributes(): void
    {
        $expectedFillable = [
            'url',
            'description',
            'id_annonce'
        ];

        $this->assertEquals($expectedFillable, $this->photo->getFillable());
    }

    public function testAnnonceRelation(): void
    {
        $relation = $this->photo->annonce();
        
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('id_annonce', $relation->getForeignKeyName());
    }
}
