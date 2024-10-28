<?php

namespace App\Providers;

use App\Interfaces\Doctors\Doctor_Dashboard\D_invoicesInterfaces;
use App\Interfaces\GroupInvoices\Group_Invoices_Interface;
use App\Interfaces\Invoices\InvoiceInterface;
use App\Interfaces\Laboratories\LaboratoryInterface;
use App\Interfaces\MedicalDiagnoses\MedicalDiagnosesInterface;
use App\Interfaces\Profiles\DoctorProfileInterface;
use App\Interfaces\Profiles\staffprofileInterface;
use App\Interfaces\Rays\RayInterface;
use App\Interfaces\SingleInvoice\ReceiptInterface;
use App\Interfaces\SingleInvoice\Single_Invoice_Interface;
use App\Interfaces\SingleInvoice\spending_moneyInterface;
use App\Repository\Doctors\Doctor_Dashboard\D_invoicesRepository ;
use App\Repository\GroupInvoices\Group_Invoices_Repository;
use App\Repository\Invoices\InvoiceRepository;
use App\Repository\Laboratories\LaboratoryRepository;
use App\Repository\MedicalDiagnoses\MedicalDiagnosesRepository;
use App\Repository\Profiles\DoctorProfileRepository;
use App\Repository\Profiles\StaffStaffprofileRepository;
use App\Repository\Rays\RayRepsitory;
use App\Repository\SingleInvoice\ReceiptRepository;
use App\Repository\SingleInvoice\Single_Invoice_Repository;
use App\Repository\SingleInvoice\spending_moneyRepository;
use Illuminate\Support\ServiceProvider;

class InvoiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Single_Invoice_Interface::class,Single_Invoice_Repository::class);
        $this->app->bind(ReceiptInterface::class,ReceiptRepository::class);
        $this->app->bind(spending_moneyInterface::class,spending_moneyRepository::class);
        $this->app->bind(Group_Invoices_Interface::class,Group_Invoices_Repository::class);
        $this->app->bind(InvoiceInterface::class,InvoiceRepository::class);
        $this->app->bind(D_invoicesInterfaces::class,D_invoicesRepository::class);
        $this->app->bind(MedicalDiagnosesInterface::class,MedicalDiagnosesRepository::class);
        $this->app->bind(RayInterface::class,RayRepsitory::class);
        $this->app->bind(LaboratoryInterface::class,LaboratoryRepository::class);
        $this->app->bind(staffprofileInterface::class,StaffStaffprofileRepository::class);
        $this->app->bind(DoctorProfileInterface::class,DoctorProfileRepository::class);
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
