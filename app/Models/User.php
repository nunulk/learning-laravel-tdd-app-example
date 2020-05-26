<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservationCountThisMonth(): int
    {
        $today = Carbon::today();
        return $this->reservations()
            ->whereRaw("DATE_FORMAT(created_at, '%Y%m') = ?", $today->format('Ym'))
            ->count();
    }

    /**
     * @param Lesson $lesson
     * @return void
     * @throws \Exception
     */
    public function canReserve(Lesson $lesson): void
    {
        if ($lesson->remainingCount() === 0) {
            throw new \Exception('レッスンの予約可能上限に達しています。');
        }
        if ($this->plan === 'gold') {
            return;
        }
        if ($this->reservationCountThisMonth() === 5) {
            throw new \Exception('今月の予約がプランの上限に達しています。');
        }
    }
}
