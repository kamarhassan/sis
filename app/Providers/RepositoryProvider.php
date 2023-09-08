<?php

namespace App\Providers;

use App\Models\AttendanceInfo;
use App\Repository\User\UserInterface;
use App\Repository\User\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Admin\AdminInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Marks\MarksInterface;
use phpDocumentor\Reflection\Types\This;
use App\Repository\Admin\AdminRepository;
use App\Repository\Cours\CoursRepository;
use App\Repository\Marks\MarksRepository;
use App\Repository\Slider\SliderInterface;
use App\Repository\Reports\ReportInterface;
use App\Repository\Slider\SliderRepository;
use App\Repository\Payment\PaymentInterface;
use App\Repository\Reports\ReportRepository;
use App\Repository\Payment\PaymentRepository;
use App\Repository\Fee_Type\Fee_TypeInterface;
use App\Repository\Students\StudentsInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Repository\Fee_Type\Fee_typeRepository;
use App\Repository\Students\StudentsRepository;
use App\Repository\Categorie\CategorieInterface;
use App\Repository\Cours_fee\CoursfeeRepository;
use App\Repository\Categorie\CategorieRepository;
use App\Repository\Attendance\AttendanceInterface;
use App\Repository\Attendance\AttendanceRepository;
use App\Repository\Certeficate\CertificateInterface;
use App\Repository\Certeficate\CertificateRepository;
use App\Repository\SponsoreShip\SponsoreShipsInterface;
use App\Repository\RegisterCours\RegisterCoursInterface;
use App\Repository\SponsoreShip\SponsoreShipsRepository;
use App\Repository\RegisterCours\RegisterCoursRepository;
use App\Repository\AdminNotification\AdminNotificationInterface;
use App\Repository\AdminNotification\AdminNotificationRepository;
use App\Repository\InstitueInformation\InstitueInformationInterface;
use App\Repository\InstitueInformation\InstitueInformationRepository;

// use App\Repository\Reports\cours_reports\CoursAccountingSummaryInterface;
// use App\Repository\Reports\cours_reports\CoursAccountingSummaryRepository;
// use App\Repository\Reports\unpaid_reports\UnpaidAccountingSummaryInterface;
// use App\Repository\Reports\unpaid_reports\UnpaidAccountingSummaryRepository;

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
       $this->app->bind(ReportInterface::class,ReportRepository::class);
       $this->app->bind(AttendanceInterface::class,AttendanceRepository::class);
       $this->app->bind(CertificateInterface::class,CertificateRepository::class);
       $this->app->bind(InstitueInformationInterface::class,InstitueInformationRepository::class);
       $this->app->bind(CategorieInterface::class,CategorieRepository::class);
       $this->app->bind(SliderInterface::class,SliderRepository::class);
       $this->app->bind(SponsoreShipsInterface::class,SponsoreShipsRepository::class);
       $this->app->bind(MarksInterface::class,MarksRepository::class);
    //    $this->app->bind(CoursAccountingSummaryInterface::class,CoursAccountingSummaryRepository::class);
      
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
