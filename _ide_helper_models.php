<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\City
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property integer $id
 * @property string $display_name
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $permissions
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $permissions
 * @property string $last_login
 * @property string $first_name
 * @property string $last_name
 * @property string $slug
 * @property integer $city_id
 * @property string $identity_number
 * @property string $cell_phone
 * @property string $profile_image
 * @property string $address
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Persistences\EloquentPersistence[] $persistences
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Activations\EloquentActivation[] $activations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Reminders\EloquentReminder[] $reminders
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cartalyst\Sentinel\Throttling\EloquentThrottle[] $throttle
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCityId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIdentityNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCellPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereProfileImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAddress($value)
 */
	class User extends \Eloquent {}
}

