<?php
namespace Modules\Train;
use Modules\ModuleServiceProvider;
use Modules\Train\Models\TrainModel;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        if(!TrainModel::isEnable()) return [];
        return [
            'train'=>[
                "position"=>41,
                'url'        => route('train.admin.index'),
                'title'      => __('Train'),
                'icon'       => 'ion ion-md-airplane',
                'permission' => 'flight_view',
                'children'   => [
                    'add'=>[
                        'url'        => route('train.admin.index'),
                        'title'      => __('All Trains'),
                        'permission' => 'flight_view',
                    ],
                    'create'=>[
                        'url'        => route('train.admin.create'),
                        'title'      => __('Add new Train'),
                        'permission' => 'flight_create',
                    ],
                    'airline'=>[
                        'url'        => route('train.admin.airline.index'),
                        'title'      => __('Company'),
                    ],
                    'airport'=>[
                        'url'        => route('train.admin.airport.index'),
                        'title'      => __('Stations'),
                    ],
                    'seat_type'=>[
                        'url'        => route('train.admin.seat_type.index'),
                        'title'      => __('Train Seat Type'),
                    ],
                    'attribute'=>[
                        'url'        => route('train.admin.attribute.index'),
                        'title'      => __('Attributes'),
                        'permission' => 'flight_manage_attributes',
                    ],
                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        if(!TrainModel::isEnable()) return [];
        return [
            'flight'=>TrainModel::class
        ];
    }

    public static function getMenuBuilderTypes()
    {
        return [];
    }

    public static function getUserMenu()
    {
        $res = [];
        if (TrainModel::isEnable()) {
            $res['flight'] = [
                'url'        => route('flight.vendor.index'),
                'title'      => __("Manage Train"),
                'icon'       => TrainModel::getServiceIconFeatured(),
                'position'   => 32,
                'permission' => 'flight_view',
                'children'   => [
                    [
                        'url'   => route('flight.vendor.index'),
                        'title' => __("All Trains"),
                    ],
                    [
                        'url'        => route('flight.vendor.create'),
                        'title'      => __("Add Trains"),
                        'permission' => 'flight_create',
                    ],
                ]
            ];
        }
        return $res;
    }

    public static function getTemplateBlocks(){
        if(!TrainModel::isEnable()) return [];
        return [
            'form_search_flight'=>"\\Modules\\Train\\Blocks\\FormSearchTrain",
        ];
    }
}
