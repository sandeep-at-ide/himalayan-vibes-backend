<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Destination;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Role;
use App\Models\SiteSetting;
use App\Models\User;
use App\Models\Booking;
use App\Models\CustomTripQuery;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Review;
use App\Models\SeoSetting;
use App\Models\TeamMember;
use App\Policies\BlogPolicy;
use App\Policies\ContactMessagePolicy;
use App\Policies\DestinationPolicy;
use App\Policies\PackagePolicy;
use App\Policies\PaymentPolicy;
use App\Policies\RolePolicy;
use App\Policies\SiteSettingPolicy;
use App\Policies\UserPolicy;
use App\Policies\BookingPolicy;
use App\Policies\CustomTripQueryPolicy;
use App\Policies\FaqPolicy;
use App\Policies\PagePolicy;
use App\Policies\ReviewPolicy;
use App\Policies\SeoSettingPolicy;
use App\Policies\TeamMemberPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Blog::class => BlogPolicy::class,
        ContactMessage::class => ContactMessagePolicy::class,
        Destination::class => DestinationPolicy::class,
        Package::class => PackagePolicy::class,
        Payment::class => PaymentPolicy::class,
        Role::class => RolePolicy::class,
        SiteSetting::class => SiteSettingPolicy::class,
        User::class => UserPolicy::class,
        Booking::class => BookingPolicy::class,
        CustomTripQuery::class => CustomTripQueryPolicy::class,
        Faq::class => FaqPolicy::class,
        Page::class => PagePolicy::class,
        Review::class => ReviewPolicy::class,
        SeoSetting::class => SeoSettingPolicy::class,
        TeamMember::class => TeamMemberPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Additional boot logic if necessary
    }
}
