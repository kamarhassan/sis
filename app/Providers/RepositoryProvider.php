<?php

namespace App\Providers;

use App\Repository\User\UserInterface;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Admin\AdminInterface;
use App\Repository\Cours\CoursInterface;
use phpDocumentor\Reflection\Types\This;
use App\Repository\Admin\AdminRepository;
use App\Repository\Cours\CoursRepository;
use App\Repository\Payment\PaymentInterface;
use App\Repository\Payment\PaymentRepository;
use App\Repository\Fee_Type\Fee_TypeInterface;
use App\Repository\Students\StudentsInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Repository\Fee_Type\Fee_typeRepository;
use App\Repository\Students\StudentsRepository;
use App\Repository\Cours_fee\CoursfeeRepository;
use App\Repository\RegisterCours\RegisterCoursInterface;
use App\Repository\RegisterCours\RegisterCoursRepository;
use App\Repository\AdminNotification\AdminNotificationInterface;
use App\Repository\AdminNotification\AdminNotificationRepository;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(CoursInterface::class,CoursRepository::class);
       $this->app->bind(Fee_TypeInterface::class,Fee_typeRepository::class);
       $this->app->bind(CoursFeeInterface::class,CoursfeeRepository::class);
       $this->app->bind(AdminInterface::class,AdminRepository::class);
       $this->app->bind(StudentsInterface::class,StudentsRepository::class);
       $this->app->bind(RegisterCoursInterface::class,RegisterCoursRepository::class);
       $this->app->bind(AdminNotificationInterface::class,AdminNotificationRepository::class);
       $this->app->bind(UserInterface::class,UserRepository::class);
       $this->app->bind(PaymentInterface::class,PaymentRepository::class);
       
    }
 
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
