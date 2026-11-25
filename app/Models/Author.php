<?php

namespace App\Models;

use Database\Factories\AuthorFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    /** @use HasFactory<AuthorFactory> */
    use HasFactory;

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    protected $fillable = [
        'first_name',
        'second_name',
        'third_name',
        'birth_date',
        'bio',
    ];

    protected function casts(): array
    {
        return [
            'brith_date' => 'date',
        ];
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn(): string => implode(' ', array_filter([
                $this->second_name,
                $this->first_name,
                $this->third_name,
            ])),
        );
    }
}
