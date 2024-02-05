<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'location',
        'company',
        'vacancy_type',
        'position',
        'note',
        'start_date',
        'end_date',
        'create_by',
        'qualification',
        'offered_salary',
        'hiring',
        'thumbnail',
        'career_level',
        'language_skills',
        'state',
        'urgent',
    ];
    public function position()
    {
        return $this->belongsTo(Position::class, 'position');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location');
    }

    public function vacancyType()
    {
        return $this->belongsTo(VacancyType::class, 'vacancy_type');
    }
}
