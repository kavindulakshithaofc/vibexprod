<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPayments extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'subscription_payments';
    protected $fillable = ['membership_subscription_id','start_date','next_pament_date','amount'];


	protected static function booted()
	{
		static::created(function ($member) {
			// update the MembershipSubscription payment status to 'paid' when a new payment is created
			$member->membershipSubscription->update(['payment_status' => 'paid']);
			// update the Members membership status to 'active' when a new payment is created
			$member->member->update(['membership_status' => 'active']);
		});
	}


    public function membershipSubscription()
    {
        return $this->belongsTo(MembershipSubscriptions::class, 'membership_subscription_id');
    }



    public function member()
    {
        return $this->hasOneThrough(
            Members::class,           // Final model we want to access
            MembershipSubscriptions::class, // Intermediate model
            'id',                     // Foreign key on MembershipSubscriptions table
            'id',                     // Foreign key on Members table
            'membership_subscription_id', // Local key on SubscriptionPayments table
            'member_id'               // Local key on MembershipSubscriptions table
        );
    }

    public function subscriptionPayments()
    {
        return $this->hasMany(SubscriptionPayments::class, 'membership_subscription_id');
    }
}
