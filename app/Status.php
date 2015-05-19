<?php namespace Api;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package Api
 */
class Status extends Model {

    /**
     * @var array
     */
    protected $fillable = [
		'user_id',
		'content',
        'view_level'
	];

    /**
     * View level
     *
     * 0 public
     * 1 friends
     * 2 organization
     * 3 custom (specific people/groups)
     * 4 only me
     *
     *
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Api\User');
    }

}
