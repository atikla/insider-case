<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public const TEAM_LOGO_PREFIX = 'https://www.teamtalk.com/content/themes/teamtalk/img/png/team-icon/premier-league';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'strength',
        'logo'
    ];

    /**
     * Interact with the team's logo
     *
     * @return Attribute
     */
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => self::TEAM_LOGO_PREFIX . $value
        );
    }
}
