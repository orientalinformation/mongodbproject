<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property boolean $access_documents
 * @property boolean $customizable_curation
 * @property boolean $number_rss
 * @property boolean $customizing_environment
 * @property boolean $number_libraries
 * @property boolean $follow_discussion_groups
 * @property string $participation_disussions
 * @property string $creating_disussion
 * @property boolean $publicity
 * @property boolean $association_applications
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property User[] $users
 */
class AccountManager extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'access_documents', 'customizable_curation', 'number_rss', 'customizing_environment', 'number_libraries', 'follow_discussion_groups', 'participation_disussions', 'creating_disussion', 'publicity', 'association_applications', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Model\User', 'account_id');
    }
}
