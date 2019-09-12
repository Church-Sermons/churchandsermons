<?php

namespace App;

use App\Traits\CustomMediaTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Balping\HashSlug\HasHashSlug;
use Laratrust\Laratrust;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    // Laratrust user trait
    use LaratrustUserTrait;

    use Notifiable;

    use HasHashSlug;

    use HasMediaTrait;

    use CustomMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'address',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function organisations()
    {
        return $this->hasMany('App\Organisation');
    }

    // Role assignment
    public function isTribrid($thing, $fk = null)
    {
        $logic = $this->hasRoleAndOwns('author', $thing, [
            'foreignKeyName' => $fk
        ]);

        if ($logic) {
            return true;
        }

        if ($this->hasRole(['administrator', 'superadministrator'])) {
            return true;
        }

        return false;
    }

    // Laravel Media Library
    // media collections
    public function registerMediaCollections()
    {
        $this->sharedMediaCollections('profile_image');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->sharedMediaConversions('profile_image');
    }
}
