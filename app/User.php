<?php namespace Api;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 * @package Api
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function following()
    {
        return $this->morphToMany('Api\Follow');
    }

    public function feed()
    {
        return Status::select(DB::raw('statuses.*'))
        ->join('friends', function($join)
        {
            $join->on('friends.followed_id', '=', 'statuses.user_id')
                ->where('friends.user_id', '=', Auth::id());
//                ->where('friends.relationship', '<=', 'statuses.view_level');
        });

//        select s.* from statuses s
//            inner join friends f on f.followed_id = s.user_id
//                where f.user_id = 1
//                and f.relationship <= s.view_level
    }

}
