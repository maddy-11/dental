<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ChangePassowrd;
use App\Http\Controllers\HomeView;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PendingPaymentController;
use App\Http\Controllers\PrescriptionMedicineController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PaidSalaryController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\InvoiceController;


Route::get('/', [HomeView::class, 'index'])->name('dashboard');
Route::get('login', [LoginBasic::class, 'index'])->name('login');
Route::post('login', [LoginBasic::class, 'login'])->name('admin.login');

Route::post('logout', [LoginBasic::class, 'logout'])->name('admin.logout');


Route::prefix('admin')->group(function () {
	Route::any('{any}', function ($any) {
		return redirect("portal/$any");
	})->where('any', '.*');
});

Route::prefix('portal')
->middleware('auth')
->group(function () {

	// dashboard
	Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
	Route::get('appointments/last-30-days', [Analytics::class, 'getAppointmentsLast30Days'])->name('appointments.last.30_days');

	Route::get('all-users', [HomeView::class, 'all_users'])->middleware('check.admin')->name('users.all');

// account
	Route::get('register', [RegisterBasic::class, 'index'])->middleware('check.admin')->name('register');
	Route::post('register', [RegisterBasic::class, 'register'])->middleware('check.admin')->name('admin.register');
	Route::put('update-user/{id}', [AccountSettingsAccount::class, 'edit'])->name('user.update');
	Route::get('/pages/account-settings-account/{id}', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
	Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index_'])->name('pages-account-settings');
	Route::post('/account/delete/{id}', [AccountSettingsAccount::class, 'destroy'])->name('account.delete');

// patients
	Route::get('patients', [AccountSettingsAccount::class, 'patient_index'])->name('patient.index');
	Route::get('patient/history', [AccountSettingsAccount::class, 'patient_history'])->name('patient.history');
	Route::get('patient/create', [RegisterBasic::class, 'patient_index'])->name('patient.register.index');
	Route::post('patient/register', [RegisterBasic::class, 'patient_register'])->name('patient.register');
	Route::get('patients/edit/{id}', [AccountSettingsAccount::class, 'patient_edit'])->name('patient.edit');
	Route::post('patient/update/{id}', [AccountSettingsAccount::class, 'patient_update'])->name('patient.update');
	Route::get('patients/delete/{id}', [AccountSettingsAccount::class, 'destroy'])->name('patient.delete');

// routes/web.php
	Route::get('/password/update', [ChangePassowrd::class, 'index'])->name('password.edit');
	Route::post('/password/update', [ChangePassowrd::class, 'update'])->name('password.update');
	Route::post('/password/reset/{id}', [ChangePassowrd::class, 'reset'])->middleware('check.admin')->name('password.reset');

// clinic settings
	Route::middleware(['check.admin'])->group(function () {
		Route::get('/settings/basic/edit', [SettingsController::class, 'editBasic'])->name('basics.edit');
		Route::put('/settings/basic/edit', [SettingsController::class, 'updateBasicInfo'])->name('basics.update');

		Route::get('/settings/timing/edit', [SettingsController::class, 'editTimings'])->name('timing.edit');
		Route::put('/settings/timing/edit', [SettingsController::class, 'updateTimings'])->name('timing.update');

		Route::get('/settings/logos/edit', [SettingsController::class, 'editLogos'])->name('logos.edit');
		Route::put('/settings/logos/edit', [SettingsController::class, 'updateLogos'])->name('logos.update');
	});

// services
	Route::middleware(['check.admin'])->group(function () {
		Route::get('/services', [ServiceController::class, 'index'])->name('all_services');
		Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
		Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
		Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
		Route::put('/service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
		Route::get('/service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
	});

// appointments
	Route::get('/appointments', [AppointmentController::class, 'index'])->name('all_appointments');
	Route::get('/patient/appointments/{id}', [AppointmentController::class, 'patient_appointments'])->name('patient.appointments');
	Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointments.create');
	Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointments.store');

	Route::get('/appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('appointments.edit');
	Route::post('/appointment/update/{id}', [AppointmentController::class, 'update'])->name('appointments.update');

	Route::get('/appointments/delete/{id}', [AppointmentController::class, 'destroy'])->name('appointments.delete');
	Route::get('/appointments/{status}/{id}', [AppointmentController::class, 'doc_patient'])->name('appointments.doc_patient');
	Route::get('/appointments/booked-hours', [AppointmentController::class, 'getBookedHours'])->name('appointments.bookedHours');

	// Designation
	Route::resource('designations', DesignationController::class)->middleware('check.admin')->except(['show']);;

	// examination
	Route::get('/examinations', [ExaminationController::class, 'index'])->name('examination.index');
	Route::get('ajax/examinations', [ExaminationController::class, 'ajax_index'])->name('examination.index.ajax');
	Route::get('/examination/{id}', [ExaminationController::class, 'create'])->name('examination.create');
	Route::post('/examination/store', [ExaminationController::class, 'store'])->name('examination.store');

	Route::post('/examination/appointment/complete/{id}', [ExaminationController::class, 'complete'])->name('examination.complete');

	Route::get('/examination/edit/{id}', [ExaminationController::class, 'edit'])->name('examination.edit');
	Route::post('/examination/update/{id}', [ExaminationController::class, 'update'])->name('examination.update');

	Route::get('/examination/delete/{id}', [ExaminationController::class, 'destroy'])->name('examination.delete');

	// Payments
	Route::get('/payments', [InvoiceController::class, 'index'])->name('payments.index');
	Route::get('/payments/invoice/{id}', [InvoiceController::class, 'invoice'])->name('payments.invoice.get');
	Route::get('/payments/invoice/download/{id}', [InvoiceController::class, 'downloadPDF'])->name('payments.invoice.download');
	Route::get('/payments/fetch', [InvoiceController::class, 'fetch'])->name('payments.fetch');
	Route::get('/view-receipt', [InvoiceController::class, 'index'])->name('payments.receipt');
	Route::get('/payments/delete/{id}', [InvoiceController::class, 'destroy'])->name('payments.delete');

	// Payments Details
	Route::get('/payments/details/{id}/{start}/{end}', [PaymentController::class, 'index'])->name('payments.details.index');
	Route::get('/payments/details/delete/{id}', [PaymentController::class, 'destroy'])->name('payments.details.delete');

	// PendingPayments
	Route::get('/pending/payments/all', [PendingPaymentController::class, 'index'])->name('pending_payments.index');
	Route::get('/pending/payments/{id}', [PendingPaymentController::class, 'single_pending_payment'])->name('pending_payments.pending.get');
	Route::post('/pending/payments/pay/{id}', [PendingPaymentController::class, 'pending_pay'])->middleware('check.admin')->name('pending_payments.pay');
	Route::get('/payments/filter/{id}', [PendingPaymentController::class, 'filter_payments'])->name('payments.filter');

	// Route::get('/view-receipt', [PendingPaymentController::class, 'index'])->name('payments.receipt');
	Route::get('/pending/payments/delete/{id}', [PendingPaymentController::class, 'destroy'])->name('pending_payments.delete');


	// Paid Salary
	Route::get('/paid/payments/delete/{id}', [PaidSalaryController::class, 'destroy'])->name('paid_payments.delete');

	// Prescription Medicine
	Route::get('/prescription/medicine', [PrescriptionMedicineController::class, 'prescription_medicine'])->name('prescription.medicine.index');
	Route::get('/prescription/medicine/add', [PrescriptionMedicineController::class, 'prescription_medicine_create'])->name('prescription.medicine.create');
	Route::post('/prescription/medicine/add', [PrescriptionMedicineController::class, 'prescription_medicine_store'])->name('prescription.medicine.store');
	Route::get('/prescription/medicine/edit/{id}', [PrescriptionMedicineController::class, 'prescription_medicine_edit'])->name('prescription.medicine.edit');
	Route::post('/prescription/medicine/update/{id}', [PrescriptionMedicineController::class, 'prescription_medicine_update'])->name('prescription.medicine.update');
	Route::get('/prescription/medicine/delete/{id}', [PrescriptionMedicineController::class, 'destroy'])->name('prescription.medicine.delete');


	// Prescription
	Route::get('/prescriptions/', [PrescriptionController::class, 'index'])->name('prescription.index');
	Route::get('/patient/prescriptions/{id}', [PrescriptionController::class, 'patientPrescriptions'])->name('patient.prescription.index');
	Route::get('/prescription/download/{id}', [PrescriptionController::class, 'downloadPDF'])->name('prescription.download');
	Route::get('/prescription/create/{id}', [PrescriptionController::class, 'create'])->name('prescription.create');
	Route::post('/prescription/store', [PrescriptionController::class, 'store'])->name('prescription.store');
	Route::get('/prescription/edit/{id}', [PrescriptionController::class, 'edit'])->name('prescription.edit');
	Route::post('/prescription/update', [PrescriptionController::class, 'update'])->name('prescription.update');
	Route::get('/prescription/delete/{id}', [PrescriptionController::class, 'destroy'])->name('prescription.delete');

	Route::get('/prescription/{id}', [PrescriptionController::class, 'get_prescription'])->name('prescription.get');
	Route::get('/latest-prescription/', [PrescriptionController::class, 'get_latest_prescription'])->name('prescription.latest.get');

	// artisan optimize:clear
	Route::get('/clear', function () {
		\Artisan::call('optimize:clear');
		return "Cache is cleared!";
	});

	Route::get('/storage-link', function () {
		\Artisan::call('storage:link');
		return "Storage Linked Successfully";
	});
});
Route::post('/contact', [HomeView::class, 'send'])->name('contact.send');
Route::post('/appointment/store-front', [AppointmentController::class, 'store_front'])->name('appointments.store.front');
