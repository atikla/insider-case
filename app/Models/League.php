<?php

namespace App\Models;

use App\Contracts\Constants;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $status
 */
class League extends Model
{
    use HasFactory;

    public const NOT_STARTED = 'NOT_STARTED';
    public const STARTED = 'STARTED';
    public const ENDED = 'ENDED';

    public const LEAGUE_STATUS = [
        self::NOT_STARTED,
        self::STARTED,
        self::ENDED
    ];

    public const STATUS_CSS_CLASSES = [
        self::NOT_STARTED => Constants::INFO_CLASS,
        self::STARTED => Constants::SUCCESS_CLASS,
        self::ENDED => Constants::DANGER_CLASS
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status'
    ];

    /**
     * Interact with the team's logo
     *
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucwords($value)
        );
    }

    /**
     * @return string
     */
    public function getStatusCssClassAttribute(): string
    {
        if (array_key_exists(key: $this->status, array: self::STATUS_CSS_CLASSES)) {
            return self::STATUS_CSS_CLASSES[$this->status];
        }

        return Constants::SECONDARY_CLASS;
    }

    /**
     * @return BelongsToMany
     */
    public function teams(): BelongsToMany
    {
        return $this
            ->belongsToMany(related: Team::class)
            ->using(class: LeagueTeamStanding::class);
    }

    /**
     * @return HasMany
     */
    public function standing(): HasMany
    {
        return $this->hasMany(LeagueTeamStanding::class);
    }

    /**
     * @return HasMany
     */
    public function LeagueMatches(): HasMany
    {
        return $this->hasMany(related: LeagueMatch::class);
    }
}
