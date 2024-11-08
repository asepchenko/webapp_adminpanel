<?php

use Illuminate\Support\Facades\Route;
//transaksi
use App\Http\Controllers\Transaction\OrderController;
use App\Http\Controllers\Transaction\OrderAgentsController;
use App\Http\Controllers\Transaction\OrderReferencesController;
use App\Http\Controllers\Transaction\OrderUnitsController;
use App\Http\Controllers\Transaction\OrderTrackingController;
use App\Http\Controllers\Transaction\DocumentsController;

//master data
use App\Http\Controllers\Master\AreasController;
use App\Http\Controllers\Master\AreaCitiesController;
use App\Http\Controllers\Master\DriversController;
use App\Http\Controllers\Master\TrucksController;
use App\Http\Controllers\Master\TruckTypesController;
use App\Http\Controllers\Master\TruckingPricesController;
use App\Http\Controllers\Master\ServiceGroupsController;
use App\Http\Controllers\Master\ServicesController;
use App\Http\Controllers\Master\PaymentTypesController;
use App\Http\Controllers\Master\BanksController;
use App\Http\Controllers\Master\ProvincesController;
use App\Http\Controllers\Master\CitiesController;
use App\Http\Controllers\Master\LocationsController;

use App\Http\Controllers\Master\StatusOrdersController;
use App\Http\Controllers\Master\StatusAWBsController;
use App\Http\Controllers\Master\CustomersController;
use App\Http\Controllers\Master\CustomerMousController;
use App\Http\Controllers\Master\CustomerBrandsController;
use App\Http\Controllers\Master\CustomerBranchsController;
use App\Http\Controllers\Master\CustomerPicsController;
use App\Http\Controllers\Master\CustomerMasterPricesController;
use App\Http\Controllers\Master\CustomerTruckingPricesController;
use App\Http\Controllers\Master\AgentsController;
use App\Http\Controllers\Master\AgentPicsController;
use App\Http\Controllers\Master\AgentMasterPricesController;
use App\Http\Controllers\Master\AgentCitiesController;
use App\Http\Controllers\Master\BranchsController;

//setting
use App\Http\Controllers\Setting\UserSettingController;
use App\Http\Controllers\Setting\DepartemensController;
use App\Http\Controllers\Setting\ApprovalController;

//driver
use App\Http\Controllers\Driver\DriverManifestController;
use App\Http\Controllers\Driver\DriverScheduleController;

//report
use App\Http\Controllers\Report\OrderReportController;
use App\Http\Controllers\Report\AgentReportController;

//marketing
use App\Http\Controllers\Marketing\ComproServiceController;
use App\Http\Controllers\Marketing\ComproPostController;
use App\Http\Controllers\Marketing\ComproGalleryController;
use App\Http\Controllers\Marketing\ComproBannerController;
use App\Http\Controllers\Marketing\ComproMainBannerController;
use App\Http\Controllers\Marketing\ComproContactUsController;

//profile
use App\Http\Controllers\ProfileController;

//warehouse
use App\Http\Controllers\Warehouse\DeliveryScheduleController;
use App\Http\Controllers\Warehouse\WarehouseOrderController;
use App\Http\Controllers\Warehouse\ManifestController;
use App\Http\Controllers\Warehouse\ManifestCogsController;
use App\Http\Controllers\Warehouse\TripController;
use App\Http\Controllers\Warehouse\TripCityController;

//approval
use App\Http\Controllers\Approval\ApprovalCustomerMasterPricesController;
use App\Http\Controllers\Approval\ApprovalCustomerTruckingPricesController;
use App\Http\Controllers\Approval\ApprovalInvoicesController;

//akunting
use App\Http\Controllers\Accounting\InvoiceController;
use App\Http\Controllers\Accounting\BillController;
use App\Http\Controllers\Accounting\CashReceiptController;

//dashboard
use App\Http\Controllers\DashboardController;

//notification
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/login');

Route::get('/update-app', function()
{
    $test = exec('composer dump-autoload');
    echo $test;

    //exec('artisan optimize:clear');
    //echo 'php artisan optimize:clear complete';

    //exec('artisan route:list');
});

//custom_auth
Route::group(['middleware' => ['custom_auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');

    //profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profiles');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
        Route::post('/change-profile', [ProfileController::class, 'changeProfile'])->name('profile.changeProfile');
    });

    //transaksi
    Route::prefix('transaction')->group(function () {
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.all');
            Route::get('/datatable', [OrderController::class, 'datatable'])->name('orders.datatable');
            Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
            Route::get('/list', [OrderController::class, 'list'])->name('orders.list');
            Route::get('/{no}', [OrderController::class, 'detail'])->name('orders.detail');
            Route::get('/{no}/track', [OrderController::class, 'track'])->name('orders.track');
            Route::get('/{no}/print-pdf', [OrderController::class, 'printPDF'])->name('orders.printPDF');
            Route::get('/{no}/print-pdf-colly', [OrderController::class, 'printPDFColly'])->name('orders.printPDFColly');
            Route::get('/{no}/print-pdf-list-colly', [OrderController::class, 'printPDFListColly'])->name('orders.printPDFListColly');
            Route::post('/', [OrderController::class, 'store'])->name('orders.store');
            Route::post('/update', [OrderController::class, 'update'])->name('orders.update');
            Route::post('/closing', [OrderController::class, 'closing'])->name('orders.closing');
            Route::post('/delete', [OrderController::class, 'delete'])->name('orders.delete');
        });

        Route::prefix('documents')->group(function () {
            Route::get('/', [DocumentsController::class, 'index'])->name('documents.all');
            Route::get('/datatable', [DocumentsController::class, 'datatable'])->name('documents.datatable');
            Route::post('/accept', [DocumentsController::class, 'accept'])->name('documents.accept');
        });

        Route::prefix('order-references')->group(function () {
            //Route::get('/list/{id}', [CustomerBrandsController::class, 'index'])->name('customer-brands');
            Route::get('/datatable/{id}', [OrderReferencesController::class, 'datatable'])->name('order-references.datatable');
            Route::get('/{id}', [OrderReferencesController::class, 'show'])->name('order-references.show');
            Route::post('/', [OrderReferencesController::class, 'store'])->name('order-references.store');
            Route::post('/update', [OrderReferencesController::class, 'update'])->name('order-references.update');
            Route::post('/delete', [OrderReferencesController::class, 'delete'])->name('order-references.delete');
            Route::post('/import-excel', [OrderReferencesController::class, 'importExcel'])->name('order-references.importExcel');
        });

        Route::prefix('order-agents')->group(function () {
            Route::get('/datatable/{id}', [OrderAgentsController::class, 'datatable'])->name('order-agents.datatable');
            Route::get('/{id}', [OrderAgentsController::class, 'show'])->name('order-agents.show');
            Route::post('/', [OrderAgentsController::class, 'store'])->name('order-agents.store');
            Route::post('/update', [OrderAgentsController::class, 'update'])->name('order-agents.update');
            Route::post('/delete', [OrderAgentsController::class, 'delete'])->name('order-agents.delete');
        });

        Route::prefix('order-units')->group(function () {
            Route::get('/datatable/{id}', [OrderUnitsController::class, 'datatable'])->name('order-units.datatable');
            Route::get('/{id}', [OrderUnitsController::class, 'show'])->name('order-units.show');
            Route::post('/', [OrderUnitsController::class, 'store'])->name('order-units.store');
            Route::post('/update', [OrderUnitsController::class, 'update'])->name('order-units.update');
            Route::post('/delete', [OrderUnitsController::class, 'delete'])->name('order-units.delete');
        });

        Route::prefix('order-trackings')->group(function () {
            Route::get('/show/{id}', [OrderTrackingController::class, 'show'])->name('order-trackings.show');
            Route::post('/', [OrderTrackingController::class, 'store'])->name('order-trackings.store');
            Route::post('/update', [OrderTrackingController::class, 'update'])->name('order-trackings.update');
            Route::post('/delete', [OrderTrackingController::class, 'delete'])->name('order-trackings.delete');
        });
    });

    //master data
    Route::prefix('master')->group(function () {
        Route::prefix('drivers')->group(function () {
            Route::get('/', [DriversController::class, 'index'])->name('drivers');
            //Route::get('/{id}/history', [DriversController::class, 'history'])->name('drivers.history');
            Route::get('/datatable', [DriversController::class, 'datatable'])->name('drivers.datatable');
            Route::get('/{id}', [DriversController::class, 'show'])->name('drivers.show');
            Route::post('/', [DriversController::class, 'store'])->name('drivers.store');
            Route::post('/update', [DriversController::class, 'update'])->name('drivers.update');
            Route::post('/delete', [DriversController::class, 'delete'])->name('drivers.delete');
        });

        Route::prefix('trucks')->group(function () {
            Route::get('/', [TrucksController::class, 'index'])->name('trucks');
            Route::get('/datatable', [TrucksController::class, 'datatable'])->name('trucks.datatable');
            Route::get('/{id}', [TrucksController::class, 'show'])->name('trucks.show');
            Route::post('/', [TrucksController::class, 'store'])->name('trucks.store');
            Route::post('/update', [TrucksController::class, 'update'])->name('trucks.update');
            Route::post('/delete', [TrucksController::class, 'delete'])->name('trucks.delete');
        });

        Route::prefix('truck-types')->group(function () {
            Route::get('/', [TruckTypesController::class, 'index'])->name('truck-types');
            Route::get('/data', [TruckTypesController::class, 'data'])->name('truck-types.data'); //json response
            Route::get('/datatable', [TruckTypesController::class, 'datatable'])->name('truck-types.datatable');
            Route::get('/{id}', [TruckTypesController::class, 'show'])->name('truck-types.show');
            Route::post('/', [TruckTypesController::class, 'store'])->name('truck-types.store');
            Route::post('/update', [TruckTypesController::class, 'update'])->name('truck-types.update');
            Route::post('/delete', [TruckTypesController::class, 'delete'])->name('truck-types.delete');
        });

        Route::prefix('service-groups')->group(function () {
            Route::get('/', [ServiceGroupsController::class, 'index'])->name('service-groups');
            Route::get('/datatable', [ServiceGroupsController::class, 'datatable'])->name('service-groups.datatable');
            Route::get('/{id}', [ServiceGroupsController::class, 'show'])->name('service-groups.show');
            Route::post('/', [ServiceGroupsController::class, 'store'])->name('service-groups.store');
            Route::post('/update', [ServiceGroupsController::class, 'update'])->name('service-groups.update');
            Route::post('/delete', [ServiceGroupsController::class, 'delete'])->name('service-groups.delete');
        });

        Route::prefix('provinces')->group(function () {
            Route::get('/', [ProvincesController::class, 'index'])->name('provinces');
            Route::get('/datatable', [ProvincesController::class, 'datatable'])->name('provinces.datatable');
            Route::get('/{id}', [ProvincesController::class, 'show'])->name('provinces.show');
            Route::post('/', [ProvincesController::class, 'store'])->name('provinces.store');
            Route::post('/update', [ProvincesController::class, 'update'])->name('provinces.update');
            Route::post('/delete', [ProvincesController::class, 'delete'])->name('provinces.delete');
        });

        Route::prefix('cities')->group(function () {
            Route::get('/', [CitiesController::class, 'index'])->name('cities');
            Route::get('/datatable', [CitiesController::class, 'datatable'])->name('cities.datatable');
            Route::get('/{id}', [CitiesController::class, 'show'])->name('cities.show');
            Route::post('/', [CitiesController::class, 'store'])->name('cities.store');
            Route::post('/update', [CitiesController::class, 'update'])->name('cities.update');
            Route::post('/delete', [CitiesController::class, 'delete'])->name('cities.delete');
        });

        Route::prefix('locations')->group(function () {
            Route::get('/', [LocationsController::class, 'index'])->name('locations');
            Route::get('/data/{id}', [LocationsController::class, 'data'])->name('locations.data'); //json response
            Route::get('/datatable', [LocationsController::class, 'datatable'])->name('locations.datatable');
            Route::get('/{id}', [LocationsController::class, 'show'])->name('locations.show');
            Route::post('/', [LocationsController::class, 'store'])->name('locations.store');
            Route::post('/update', [LocationsController::class, 'update'])->name('locations.update');
            Route::post('/delete', [LocationsController::class, 'delete'])->name('locations.delete');
        });

        Route::prefix('trucking-prices')->group(function () {
            Route::get('/', [TruckingPricesController::class, 'index'])->name('trucking-prices');
            Route::get('/data/{id}', [TruckingPricesController::class, 'data'])->name('trucking-prices.data'); //json response
            Route::get('/datatable', [TruckingPricesController::class, 'datatable'])->name('trucking-prices.datatable');
            Route::get('/{id}', [TruckingPricesController::class, 'show'])->name('trucking-prices.show');
            Route::get('/origin/{origin}/destination/{destination}/type/{type}', [TruckingPricesController::class, 'getTruckingPriceRates'])->name('trucking-prices.getTruckingPriceRates');
            Route::post('/', [TruckingPricesController::class, 'store'])->name('trucking-prices.store');
            Route::post('/update', [TruckingPricesController::class, 'update'])->name('trucking-prices.update');
            Route::post('/delete', [TruckingPricesController::class, 'delete'])->name('trucking-prices.delete');
        });

        Route::prefix('areas')->group(function () {
            Route::get('/', [AreasController::class, 'index'])->name('areas');
            Route::get('/data/{id}', [AreasController::class, 'data'])->name('areas.data'); //json response
            Route::get('/datatable', [AreasController::class, 'datatable'])->name('areas.datatable');
            Route::get('/{id}', [AreasController::class, 'show'])->name('areas.show');
            Route::post('/', [AreasController::class, 'store'])->name('areas.store');
            Route::post('/update', [AreasController::class, 'update'])->name('areas.update');
            Route::post('/delete', [AreasController::class, 'delete'])->name('areas.delete');
        });

        Route::prefix('area-cities')->group(function () {
            Route::get('/area/{id}', [AreaCitiesController::class, 'indexByArea'])->name('area-cities.indexByArea');
            Route::post('/', [AreaCitiesController::class, 'store'])->name('area-cities.store');
            Route::post('/delete', [AreaCitiesController::class, 'delete'])->name('area-cities.delete');
        });

        Route::prefix('banks')->group(function () {
            Route::get('/', [BanksController::class, 'index'])->name('banks');
            Route::get('/datatable', [BanksController::class, 'datatable'])->name('banks.datatable');
            Route::get('/{id}', [BanksController::class, 'show'])->name('banks.show');
            Route::post('/', [BanksController::class, 'store'])->name('banks.store');
            Route::post('/update', [BanksController::class, 'update'])->name('banks.update');
            Route::post('/delete', [BanksController::class, 'delete'])->name('banks.delete');
        });

        Route::prefix('services')->group(function () {
            Route::get('/', [ServicesController::class, 'index'])->name('services');
            Route::get('/data', [ServicesController::class, 'data'])->name('services.data'); //json response
            Route::get('/datatable', [ServicesController::class, 'datatable'])->name('services.datatable');
            Route::get('/{id}', [ServicesController::class, 'show'])->name('services.show');
            Route::post('/', [ServicesController::class, 'store'])->name('services.store');
            Route::post('/update', [ServicesController::class, 'update'])->name('services.update');
            Route::post('/delete', [ServicesController::class, 'delete'])->name('services.delete');
        });

        Route::prefix('customers')->group(function () {
            Route::get('/', [CustomersController::class, 'index'])->name('customers');
            Route::get('/create', [CustomersController::class, 'create'])->name('customers.create');
            Route::get('/datatable', [CustomersController::class, 'datatable'])->name('customers.datatable');
            Route::get('/{id}', [CustomersController::class, 'show'])->name('customers.show');
            Route::post('/', [CustomersController::class, 'store'])->name('customers.store');
            Route::post('/update', [CustomersController::class, 'update'])->name('customers.update');
            Route::post('/delete', [CustomersController::class, 'delete'])->name('customers.delete');
        });

        Route::prefix('customer-brands')->group(function () {
            Route::get('/customer/{id}', [CustomerBrandsController::class, 'index'])->name('customer-brands');
            Route::get('/datatable/customer/{id}', [CustomerBrandsController::class, 'datatable'])->name('customer-brands.datatable');
            Route::get('/{id}', [CustomerBrandsController::class, 'show'])->name('customer-brands.show');
            Route::post('/', [CustomerBrandsController::class, 'store'])->name('customer-brands.store');
            Route::post('/update', [CustomerBrandsController::class, 'update'])->name('customer-brands.update');
            Route::post('/delete', [CustomerBrandsController::class, 'delete'])->name('customer-brands.delete');
        });

        Route::prefix('customer-mous')->group(function () {
            Route::get('/customer/{id}', [CustomerMousController::class, 'index'])->name('customer-mous');
            Route::get('/datatable/customer/{id}', [CustomerMousController::class, 'datatable'])->name('customer-mous.datatable');
            Route::get('/{id}', [CustomerMousController::class, 'show'])->name('customer-mous.show');
            Route::post('/', [CustomerMousController::class, 'store'])->name('customer-mous.store');
            Route::post('/update', [CustomerMousController::class, 'update'])->name('customer-mous.update');
            Route::post('/delete', [CustomerMousController::class, 'delete'])->name('customer-mous.delete');
        });

        Route::prefix('customer-branchs')->group(function () {
            Route::get('/customer/{id}', [CustomerBranchsController::class, 'index'])->name('customer-branchs');
            Route::get('/datatable/customer/{id}', [CustomerBranchsController::class, 'datatable'])->name('customer-branchs.datatable');
            Route::get('/{id}', [CustomerBranchsController::class, 'show'])->name('customer-branchs.show');
            Route::post('/', [CustomerBranchsController::class, 'store'])->name('customer-branchs.store');
            Route::post('/update', [CustomerBranchsController::class, 'update'])->name('customer-branchs.update');
            Route::post('/delete', [CustomerBranchsController::class, 'delete'])->name('customer-branchs.delete');
        });

        /*Route::prefix('customer-pics')->group(function () {
            Route::get('/customer/{id}', [CustomerPicsController::class, 'index'])->name('customer-pics');
            Route::get('/datatable/customer/{id}', [CustomerPicsController::class, 'datatable'])->name('customer-pics.datatable');
            Route::get('/{id}', [CustomerPicsController::class, 'show'])->name('customer-pics.show');
            Route::post('/', [CustomerPicsController::class, 'store'])->name('customer-pics.store');
            Route::post('/update', [CustomerPicsController::class, 'update'])->name('customer-pics.update');
            Route::post('/delete', [CustomerPicsController::class, 'delete'])->name('customer-pics.delete');
        });*/

        Route::prefix('customer-pics')->group(function () {
            Route::get('/customer/{id}', [CustomerPicsController::class, 'index'])->name('customer-pics');
            Route::get('/datatable/customer/{id}', [CustomerPicsController::class, 'datatable'])->name('customer-pics.datatable');
            Route::get('/{id}', [CustomerPicsController::class, 'show'])->name('customer-pics.show');
            Route::post('/', [CustomerPicsController::class, 'store'])->name('customer-pics.store');
            Route::post('/update', [CustomerPicsController::class, 'update'])->name('customer-pics.update');
            Route::post('/delete', [CustomerPicsController::class, 'delete'])->name('customer-pics.delete');
        });

        Route::prefix('customer-master-prices')->group(function () {
            Route::get('/customer/{id}', [CustomerMasterPricesController::class, 'index'])->name('customer-master-prices');
            Route::get('/customer/{customer}/origin/{origin}/destination/{destination}/service/{service}', [CustomerMasterPricesController::class, 'getMasterPriceRates'])->name('customer-master-prices.getMasterPriceRates');
            Route::get('/datatable/customer/{id}', [CustomerMasterPricesController::class, 'datatable'])->name('customer-master-prices.datatable');
            Route::get('/{id}', [CustomerMasterPricesController::class, 'show'])->name('customer-master-prices.show');
            Route::post('/', [CustomerMasterPricesController::class, 'store'])->name('customer-master-prices.store');
            Route::post('/update', [CustomerMasterPricesController::class, 'update'])->name('customer-master-prices.update');
            Route::post('/delete', [CustomerMasterPricesController::class, 'delete'])->name('customer-master-prices.delete');
        });

        Route::prefix('customer-trucking-prices')->group(function () {
            Route::get('/customer/{id}', [CustomerTruckingPricesController::class, 'index'])->name('customer-trucking-prices');
            Route::get('/customer/{customer}/origin/{origin}/destination/{destination}/truck/{truck}', [CustomerTruckingPricesController::class, 'getTruckingPriceRates'])->name('customer-trucking-prices.getTruckingPriceRates');
            Route::get('/datatable/customer/{id}', [CustomerTruckingPricesController::class, 'datatable'])->name('customer-trucking-prices.datatable');
            Route::get('/{id}', [CustomerTruckingPricesController::class, 'show'])->name('customer-trucking-prices.show');
            Route::post('/', [CustomerTruckingPricesController::class, 'store'])->name('customer-trucking-prices.store');
            Route::post('/update', [CustomerTruckingPricesController::class, 'update'])->name('customer-trucking-prices.update');
            Route::post('/delete', [CustomerTruckingPricesController::class, 'delete'])->name('customer-trucking-prices.delete');
        });

        Route::prefix('agents')->group(function () {
            Route::get('/', [AgentsController::class, 'index'])->name('agents');
            Route::get('/city/{id}', [AgentsController::class, 'indexByCityID'])->name('agents.indexByCityID');
            Route::get('/city/{id}/address', [AgentsController::class, 'indexByCityAddressID'])->name('agents.indexByCityAddressID');
            Route::get('/create', [AgentsController::class, 'create'])->name('agents.create');
            Route::get('/datatable', [AgentsController::class, 'datatable'])->name('agents.datatable');
            Route::get('/{id}', [AgentsController::class, 'show'])->name('agents.show');
            Route::post('/', [AgentsController::class, 'store'])->name('agents.store');
            Route::post('/update', [AgentsController::class, 'update'])->name('agents.update');
            Route::post('/delete', [AgentsController::class, 'delete'])->name('agents.delete');
        });

        Route::prefix('agent-pics')->group(function () {
            Route::get('/agent/{id}', [AgentPicsController::class, 'index'])->name('agent-pics');
            Route::get('/datatable/agent/{id}', [AgentPicsController::class, 'datatable'])->name('agent-pics.datatable');
            Route::get('/{id}', [AgentPicsController::class, 'show'])->name('agent-pics.show');
            Route::post('/', [AgentPicsController::class, 'store'])->name('agent-pics.store');
            Route::post('/update', [AgentPicsController::class, 'update'])->name('agent-pics.update');
            Route::post('/delete', [AgentPicsController::class, 'delete'])->name('agent-pics.delete');
        });

        Route::prefix('agent-master-prices')->group(function () {
            Route::get('/agent/{id}', [AgentMasterPricesController::class, 'index'])->name('agent-master-prices');
            Route::get('/agent/{agent}/origin/{origin}/destination/{destination}/service/{service}', [AgentMasterPricesController::class, 'getMasterPriceRates'])->name('agent-master-prices.getMasterPriceRates');
            Route::get('/datatable/agent/{id}', [AgentMasterPricesController::class, 'datatable'])->name('agent-master-prices.datatable');
            Route::get('/{id}', [AgentMasterPricesController::class, 'show'])->name('agent-master-prices.show');
            Route::post('/', [AgentMasterPricesController::class, 'store'])->name('agent-master-prices.store');
            Route::post('/update', [AgentMasterPricesController::class, 'update'])->name('agent-master-prices.update');
            Route::post('/delete', [AgentMasterPricesController::class, 'delete'])->name('agent-master-prices.delete');
        });

        Route::prefix('agent-cities')->group(function () {
            Route::get('/agent/{id}', [AgentCitiesController::class, 'index'])->name('agent-cities');
            Route::get('/datatable/agent/{id}', [AgentCitiesController::class, 'datatable'])->name('agent-cities.datatable');
            Route::get('/{id}', [AgentCitiesController::class, 'show'])->name('agent-cities.show');
            Route::post('/', [AgentCitiesController::class, 'store'])->name('agent-cities.store');
            Route::post('/update', [AgentCitiesController::class, 'update'])->name('agent-cities.update');
            Route::post('/delete', [AgentCitiesController::class, 'delete'])->name('agent-cities.delete');
        });

        //ga dipake
        /*
        Route::prefix('status-awbs')->group(function () {
            Route::get('/', [StatusAWBsController::class, 'index'])->name('status-awbs');
            Route::get('/datatable', [StatusAWBsController::class, 'datatable'])->name('status-awbs.datatable');
            Route::get('/{id}', [StatusAWBsController::class, 'show'])->name('status-awbs.show');
            Route::post('/', [StatusAWBsController::class, 'store'])->name('status-awbs.store');
            Route::post('/update', [StatusAWBsController::class, 'update'])->name('status-awbs.update');
            Route::post('/delete', [StatusAWBsController::class, 'delete'])->name('status-awbs.delete');
        });

        Route::prefix('status-orders')->group(function () {
            Route::get('/', [StatusOrdersController::class, 'index'])->name('status-orders');
            Route::get('/datatable', [StatusOrdersController::class, 'datatable'])->name('status-orders.datatable');
            Route::get('/{id}', [StatusOrdersController::class, 'show'])->name('status-orders.show');
            Route::post('/', [StatusOrdersController::class, 'store'])->name('status-orders.store');
            Route::post('/update', [StatusOrdersController::class, 'update'])->name('status-orders.update');
            Route::post('/delete', [StatusOrdersController::class, 'delete'])->name('status-orders.delete');
        });*/

        Route::prefix('payment-types')->group(function () {
            Route::get('/', [PaymentTypesController::class, 'index'])->name('payment-types');
            Route::get('/datatable', [PaymentTypesController::class, 'datatable'])->name('payment-types.datatable');
            Route::get('/{id}', [PaymentTypesController::class, 'show'])->name('payment-types.show');
            Route::post('/', [PaymentTypesController::class, 'store'])->name('payment-types.store');
            Route::post('/update', [PaymentTypesController::class, 'update'])->name('payment-types.update');
            Route::post('/delete', [PaymentTypesController::class, 'delete'])->name('payment-types.delete');
        });

        Route::prefix('branchs')->group(function () {
            Route::get('/', [BranchsController::class, 'index'])->name('branchs');
            Route::get('/city/{id}', [BranchsController::class, 'indexByCityID'])->name('branchs.indexByCityID');
            //Route::get('/create', [BranchsController::class, 'create'])->name('branchs.create');
            Route::get('/datatable', [BranchsController::class, 'datatable'])->name('branchs.datatable');
            Route::get('/{id}', [BranchsController::class, 'show'])->name('branchs.show');
            Route::post('/', [BranchsController::class, 'store'])->name('branchs.store');
            Route::post('/update', [BranchsController::class, 'update'])->name('branchs.update');
            Route::post('/delete', [BranchsController::class, 'delete'])->name('branchs.delete');
        });
    });

    //warehouse
    Route::prefix('warehouse')->group(function () {

        Route::prefix('order')->group(function () {
            Route::get('/', [WarehouseOrderController::class, 'index'])->name('warehouse-order');
            //Route::get('/{no}/manifest', [WarehouseOrderController::class, 'manifest'])->name('warehouse-order.manifest');
        });

        Route::prefix('delivery-schedule')->group(function () {
            Route::get('/', [DeliveryScheduleController::class, 'index'])->name('delivery-schedule');
            Route::get('/{id}/detail', [DeliveryScheduleController::class, 'detail'])->name('delivery-schedule.detail');
        });

        Route::prefix('manifest')->group(function () {
            Route::get('/', [ManifestController::class, 'index'])->name('manifest.all');
            Route::get('/datatable', [ManifestController::class, 'datatable'])->name('manifest.datatable');
            Route::get('/list', [ManifestController::class, 'list'])->name('manifest.list');
            Route::get('/list-stt/{manifest_number}', [ManifestController::class, 'listStt'])->name('manifest.list-stt');
            Route::get('/{no}', [ManifestController::class, 'detail'])->name('manifest.detail');
            Route::get('/{no}/print-pdf', [ManifestController::class, 'printPDF'])->name('manifest.printPDF');
            Route::get('/{no}/print-stt', [ManifestController::class, 'printSTT'])->name('manifest.printSTT');
            Route::post('/', [ManifestController::class, 'store'])->name('manifest.store');
            Route::post('/update', [ManifestController::class, 'update'])->name('manifest.update');
            Route::post('/closing', [ManifestController::class, 'closing'])->name('manifest.closing');
            Route::post('/delete', [ManifestController::class, 'delete'])->name('manifest.delete');
            Route::post('/detail/add', [ManifestController::class, 'addDetail'])->name('manifest.add-detail');
            Route::post('/detail/delete', [ManifestController::class, 'deleteDetail'])->name('manifest.delete-detail');
        });

        Route::prefix('manifest-cogs')->group(function () {
            Route::get('/{id}', [ManifestCogsController::class, 'detail'])->name('manifest-cogs.detail');
            Route::post('/update', [ManifestCogsController::class, 'update'])->name('manifest-cogs.update');
        });

        Route::prefix('trip')->group(function () {
            Route::get('/', [TripController::class, 'index'])->name('trip.all');
            Route::get('/create', [TripController::class, 'create'])->name('trip.create');
            Route::get('/datatable', [TripController::class, 'datatable'])->name('trip.datatable');
            //Route::get('/datatable-cogs/{no}', [TripController::class, 'datatableCogs'])->name('trip.datatableCogs');
            Route::get('/{no}', [TripController::class, 'detail'])->name('trip.detail');
            Route::post('/', [TripController::class, 'store'])->name('trip.store');
            Route::post('/update', [TripController::class, 'update'])->name('trip.update');
            Route::post('/closing', [TripController::class, 'closing'])->name('trip.closing');
            Route::post('/delete', [TripController::class, 'delete'])->name('trip.delete');
        });

        Route::prefix('trip-city')->group(function () {
            Route::get('/{id}', [TripCityController::class, 'detail'])->name('trip-city.detail');
            Route::post('/update', [TripCityController::class, 'update'])->name('trip-city.update');
        });
    });

    //approval
    Route::prefix('approval')->group(function () {

        Route::prefix('customer-master-prices')->group(function () {
            Route::get('/', [ApprovalCustomerMasterPricesController::class, 'index'])->name('approval.customer-master-prices.index');
            Route::get('/datatable', [ApprovalCustomerMasterPricesController::class, 'datatable'])->name('approval.customer-master-prices.datatable');
            Route::post('/approve', [ApprovalCustomerMasterPricesController::class, 'approve'])->name('approval.customer-master-prices.approve');
            Route::post('/mass-approve', [ApprovalCustomerMasterPricesController::class, 'massApprove'])->name('approval.customer-master-prices.massApprove');
        });

        Route::prefix('customer-trucking-prices')->group(function () {
            Route::get('/', [ApprovalCustomerTruckingPricesController::class, 'index'])->name('approval.customer-trucking-prices.index');
            Route::get('/datatable', [ApprovalCustomerTruckingPricesController::class, 'datatable'])->name('approval.customer-trucking-prices.datatable');
            Route::post('/approve', [ApprovalCustomerTruckingPricesController::class, 'approve'])->name('approval.customer-trucking-prices.approve');
            Route::post('/mass-approve', [ApprovalCustomerTruckingPricesController::class, 'massApprove'])->name('approval.customer-trucking-prices.massApprove');
        });

        Route::prefix('invoices')->group(function () {
            Route::get('/', [ApprovalInvoicesController::class, 'index'])->name('approval.invoices.index');
            Route::get('/datatable', [ApprovalInvoicesController::class, 'datatable'])->name('approval.invoices.datatable');
            Route::get('/{id}', [ApprovalInvoicesController::class, 'show'])->name('approval.invoices.show');
            Route::post('/', [ApprovalInvoicesController::class, 'store'])->name('approval.invoices.store');
            Route::post('/update', [ApprovalInvoicesController::class, 'update'])->name('approval.invoices.update');
            Route::post('/delete', [ApprovalInvoicesController::class, 'delete'])->name('approval.invoices.delete');
        });
    });

    //driver
    Route::prefix('driver')->group(function () {

        Route::prefix('manifest')->group(function () {
            Route::get('/', [DriverManifestController::class, 'index'])->name('driver-manifest');
            Route::get('/datatable', [DriverManifestController::class, 'datatable'])->name('driver-manifest.datatable');
            Route::get('/{no}/detail', [DriverManifestController::class, 'detail'])->name('driver-manifest.detail');
            Route::post('/update', [DriverManifestController::class, 'update'])->name('driver-manifest.update');
        });

        Route::prefix('schedule')->group(function () {
            Route::get('/', [DriverScheduleController::class, 'index'])->name('driver-schedule');
            //Route::get('/{id}/detail', [DeliveryScheduleController::class, 'detail'])->name('delivery-schedule.detail');
        });
    });

    //akunting
    Route::prefix('accounting')->group(function () {
        Route::prefix('invoice')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
            Route::get('/datatable', [InvoiceController::class, 'datatable'])->name('invoice.datatable');
            Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
            Route::get('/list', [InvoiceController::class, 'list'])->name('invoice.list');
            Route::get('/invoices-order-list', [InvoiceController::class, 'orderList'])->name('invoice.orderList');
            Route::get('/list-stt/{customer_id}', [InvoiceController::class, 'listStt'])->name('invoice.list-stt');
            Route::get('/{no}', [InvoiceController::class, 'edit'])->name('invoice.edit');
            Route::get('/{no}/print-pdf', [InvoiceController::class, 'printPDF'])->name('invoice.printPDF');
            Route::post('/', [InvoiceController::class, 'store'])->name('invoice.store');
            Route::post('/update', [InvoiceController::class, 'update'])->name('invoice.update');
            Route::post('/closing', [InvoiceController::class, 'closing'])->name('invoice.closing');
            Route::post('/delete', [InvoiceController::class, 'delete'])->name('invoice.delete');
            Route::post('/verify', [InvoiceController::class, 'verify'])->name('invoice.verify');
            Route::post('/accept', [InvoiceController::class, 'accept'])->name('invoice.accept');
            Route::post('/pay', [InvoiceController::class, 'pay'])->name('invoice.pay');
            Route::post('/detail/add', [InvoiceController::class, 'addDetail'])->name('invoice.add-detail');
            Route::post('/detail/delete', [InvoiceController::class, 'deleteDetail'])->name('invoice.delete-detail');
        });

        Route::prefix('bill')->group(function () {
            Route::get('/', [BillController::class, 'index'])->name('bill');
            Route::get('/datatable', [BillController::class, 'datatable'])->name('bill.datatable');
            Route::get('/create', [BillController::class, 'create'])->name('bill.create');
            Route::get('/list-stt/{agent_id}', [BillController::class, 'listStt'])->name('bill.list-stt');
            //Route::get('/bills-order-list', [BillController::class, 'list'])->name('bill.list');
            Route::get('/{id}/detail', [BillController::class, 'detail'])->name('bill.detail');
            Route::post('/', [BillController::class, 'store'])->name('bill.store');
            Route::post('/update', [BillController::class, 'update'])->name('bill.update');
            Route::post('/closing', [BillController::class, 'closing'])->name('bill.closing');
            Route::post('/pay', [BillController::class, 'pay'])->name('bill.pay');
            Route::post('/detail/add', [BillController::class, 'addDetail'])->name('bill.add-detail');
            Route::post('/detail/delete', [BillController::class, 'deleteDetail'])->name('bill.delete-detail');
        });

        Route::prefix('cash-receipt')->group(function () {
            Route::get('/', [CashReceiptController::class, 'index'])->name('cash-receipt');
            Route::get('/{id}/detail', [CashReceiptController::class, 'detail'])->name('cash-receipt.detail');
        });
    });

    //setting
    Route::prefix('setting')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserSettingController::class, 'index'])->name('user-settings');
            Route::get('/create', [UserSettingController::class, 'create'])->name('user-settings.create');
            Route::get('/datatable', [UserSettingController::class, 'datatable'])->name('user-settings.datatable');
            Route::get('/{id}', [UserSettingController::class, 'show'])->name('user-settings.show');
            Route::post('/', [UserSettingController::class, 'store'])->name('user-settings.store');
            Route::post('/update', [UserSettingController::class, 'update'])->name('user-settings.update');
            Route::post('/delete', [UserSettingController::class, 'delete'])->name('user-settings.delete');
        });

        Route::prefix('departemens')->group(function () {
            Route::get('/', [DepartemensController::class, 'index'])->name('departemens');
            Route::get('/datatable', [DepartemensController::class, 'datatable'])->name('departemens.datatable');
            Route::get('/{id}', [DepartemensController::class, 'show'])->name('departemens.show');
            Route::post('/', [DepartemensController::class, 'store'])->name('departemens.store');
            Route::post('/update', [DepartemensController::class, 'update'])->name('departemens.update');
            Route::post('/delete', [DepartemensController::class, 'delete'])->name('departemens.delete');
        });

        Route::prefix('approval')->group(function () {
            Route::get('/', [ApprovalController::class, 'index'])->name('approval-flow');
        });
    });

    //report
    Route::prefix('report')->group(function () {
        Route::prefix('order')->group(function () {
            Route::get('/', [OrderReportController::class, 'index'])->name('order-report');
            Route::get('/view', [OrderReportController::class, 'view'])->name('order-report.view');
        });

        Route::prefix('agent')->group(function () {
            Route::get('/', [AgentReportController::class, 'index'])->name('agent-report');
            Route::get('/view', [AgentReportController::class, 'view'])->name('agent-report.view');
        });
    });

    //marketing
    Route::prefix('marketing')->group(function () {
        Route::prefix('compro-service')->group(function () {
            Route::get('/', [ComproServiceController::class, 'index'])->name('compro-service');
            Route::get('/datatable', [ComproServiceController::class, 'datatable'])->name('compro-service.datatable');
            Route::get('/{id}', [ComproServiceController::class, 'show'])->name('compro-service.show');
            Route::post('/', [ComproServiceController::class, 'store'])->name('compro-service.store');
            Route::post('/update', [ComproServiceController::class, 'update'])->name('compro-service.update');
            Route::post('/delete', [ComproServiceController::class, 'delete'])->name('compro-service.delete');
        });

        Route::prefix('compro-post')->group(function () {
            Route::get('/', [ComproPostController::class, 'index'])->name('compro-post');
            Route::get('/create', [ComproPostController::class, 'create'])->name('compro-post.create');
            Route::get('/datatable', [ComproPostController::class, 'datatable'])->name('compro-post.datatable');
            Route::get('/{id}', [ComproPostController::class, 'show'])->name('compro-post.show');
            Route::post('/', [ComproPostController::class, 'store'])->name('compro-post.store');
            Route::post('/update', [ComproPostController::class, 'update'])->name('compro-post.update');
            Route::post('/delete', [ComproPostController::class, 'delete'])->name('compro-post.delete');
        });

        Route::prefix('compro-gallery')->group(function () {
            Route::get('/', [ComproGalleryController::class, 'index'])->name('compro-gallery');
            Route::get('/datatable', [ComproGalleryController::class, 'datatable'])->name('compro-gallery.datatable');
            Route::get('/{id}', [ComproGalleryController::class, 'show'])->name('compro-gallery.show');
            Route::post('/', [ComproGalleryController::class, 'store'])->name('compro-gallery.store');
            Route::post('/update', [ComproGalleryController::class, 'update'])->name('compro-gallery.update');
            Route::post('/delete', [ComproGalleryController::class, 'delete'])->name('compro-gallery.delete');
        });

        Route::prefix('compro-banner')->group(function () {
            Route::get('/', [ComproBannerController::class, 'index'])->name('compro-banner');
            Route::get('/create', [ComproBannerController::class, 'create'])->name('compro-banner.create');
            Route::get('/datatable', [ComproBannerController::class, 'datatable'])->name('compro-banner.datatable');
            Route::get('/{id}', [ComproBannerController::class, 'show'])->name('compro-banner.show');
            Route::post('/', [ComproBannerController::class, 'store'])->name('compro-banner.store');
            Route::post('/update', [ComproBannerController::class, 'update'])->name('compro-banner.update');
            Route::post('/delete', [ComproBannerController::class, 'delete'])->name('compro-banner.delete');
        });

        Route::prefix('compro-main-banner')->group(function () {
            Route::get('/', [ComproMainBannerController::class, 'index'])->name('compro-main-banner');
            Route::get('/create', [ComproMainBannerController::class, 'create'])->name('compro-main-banner.create');
            Route::get('/datatable', [ComproMainBannerController::class, 'datatable'])->name('compro-main-banner.datatable');
            Route::get('/{id}', [ComproMainBannerController::class, 'show'])->name('compro-main-banner.show');
            Route::post('/', [ComproMainBannerController::class, 'store'])->name('compro-main-banner.store');
            Route::post('/update', [ComproMainBannerController::class, 'update'])->name('compro-main-banner.update');
            Route::post('/delete', [ComproMainBannerController::class, 'delete'])->name('compro-main-banner.delete');
        });

        Route::prefix('compro-contact')->group(function () {
            Route::get('/', [ComproContactUsController::class, 'index'])->name('compro-contact');
            Route::get('/datatable', [ComproContactUsController::class, 'datatable'])->name('compro-contact.datatable');
            Route::post('/delete', [ComproContactUsController::class, 'delete'])->name('compro-contact.delete');
        });
    });
});
require __DIR__.'/auth.php';
