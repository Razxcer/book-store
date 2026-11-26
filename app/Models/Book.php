<?php

namespace App\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['title', 'description', 'year', 'price', 'discount'])]
class Book extends Model
{
    /** @use HasFactory<BookFactory> */
    use HasFactory;

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'discount' => 'integer',
            'price' => 'decimal:2',
        ];
    }

    protected function finalPrice(): Attribute
    {
        return Attribute::make(
            get: function (): float {
                if ($this->discount <= 0) {
                    return (float) $this->price;
                }
                $discounted = (float) $this->price * (1 - $this->discount / 100);

                return round($discounted, 2);
            }
        );
    }
}
