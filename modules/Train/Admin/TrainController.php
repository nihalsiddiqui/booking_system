<?php

namespace Modules\Train\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\AdminController;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\Core\Models\Attributes;
use Modules\Flight\Models\Flight;
use Modules\Flight\Models\FlightTerm;
use Modules\Location\Models\Location;
use Modules\Location\Models\LocationCategory;
use Modules\Train\Models\TrainModel;
use Modules\Train\Models\TrainTerm;


class TrainController extends AdminController
{

    protected $space;
    protected $train_term;
    protected $attributes;
    protected $location;
    /**
     * @var string
     */
    private $locationCategoryClass;
    /**
     * @var string
     */
    private $train;

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('train.admin.index'));
        $this->train = TrainModel::class;
        $this->train_term = TrainTerm::class;
        $this->attributes = Attributes::class;
        $this->location = Location::class;
        $this->locationCategoryClass = LocationCategory::class;
    }

    public function callAction($method, $parameters)
    {
        if (!TrainModel::isEnable()) {
            return redirect('/');
        }
        return parent::callAction($method, $parameters); // TODO: Change the autogenerated stub
    }

    public function index(Request $request)
    {
        $this->checkPermission('flight_view');
        $query = $this->train::query();
        $query->orderBy('id', 'desc');
        if (!empty($flight_name = $request->input('s'))) {
            $query->where('name', 'LIKE', '%'.$flight_name.'%')->orWhere('code','like', '%'.$flight_name.'%');
            $query->orderBy('name', 'asc');
        }

        if ($this->hasPermission('flight_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'row'                  => new $this->train,
            'rows'                 => $query->with(['airline','airportTo','airportFrom','author'])->paginate(20),
            'flight_manage_others' => $this->hasPermission('flight_manage_others'),
            'breadcrumbs'          => [
                [
                    'name' => __('Trains'),
                    'url'  => route('train.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'           => __("Train Management")
        ];
        return view('Train::admin.index', $data);
    }

    public function recovery(Request $request)
    {
        $this->checkPermission('flight_view');
        $query = $this->train::onlyTrashed();
        $query->orderBy('id', 'desc');
        if (!empty($flight_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%'.$flight_name.'%');
            $query->orderBy('title', 'asc');
        }

        if ($this->hasPermission('flight_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('create_user', $author);
            }
        } else {
            $query->where('create_user', Auth::id());
        }
        $data = [
            'rows'                 => $query->with(['author'])->paginate(20),
            'flight_manage_others' => $this->hasPermission('flight_manage_others'),
            'recovery'             => 1,
            'breadcrumbs'          => [
                [
                    'name' => __('Train'),
                    'url'  => 'admin/module/space'
                ],
                [
                    'name'  => __('Recovery'),
                    'class' => 'active'
                ],
            ],
            'page_title'           => __("Recovery Train Management")
        ];
        return view('Train::admin.flight.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('flight_create');
        $row = new $this->train();
        $row->fill([
            'status' => 'publish'
        ]);
        $data = [
            'row'            => $row,
            'attributes'     => $this->attributes::where('service', 'train')->get(),
            'translation'    => $row,
            'breadcrumbs'    => [
                [
                    'name' => __('Trains'),
                    'url'  => route('train.admin.index')
                ],
                [
                    'name'  => __('Add Train'),
                    'class' => 'active'
                ],
            ],
            'page_title'     => __("Add new Train")
        ];
        return view('Train::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('flight_update');
        $row = $this->train::with(['airline','airportTo','airportFrom'])->find($id);
        if (empty($row)) {
            return redirect(route('train.admin.index'));
        }
        if (!$this->hasPermission('flight_manage_others')) {
            if ($row->create_user != Auth::id()) {
                return redirect(route('train.admin.index'));
            }
        }
        $data = [
            'row'               => $row,
            "selected_terms"    => $row->terms->pluck('term_id'),
            'attributes'        => $this->attributes::where('service', 'train')->get(),
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Trains'),
                    'url'  => route('train.admin.index')
                ],
                [
                    'name'  => __('Edit Train'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Edit: #:name", ['name' => $row->id])
        ];
        return view('Train::admin.detail', $data);
    }

    public function store(Request $request, $id)
    {
        if ($id > 0) {
            $this->checkPermission('flight_update');
            $row = $this->train::find($id);
            if (empty($row)) {
                return redirect(route('train.admin.index'));
            }

            if ($row->create_user != Auth::id() and !$this->hasPermission('flight_manage_others')) {
                return redirect(route('train.admin.index'));
            }
        } else {
            $this->checkPermission('flight_create');
            $row = new $this->train();
            $row->status = "publish";
        }


        $validator = Validator::make($request->all(), [
            'departure_time'=>'required',
            'arrival_time'=>'required',
            'duration'=>'required',
            'airport_from'=>'required',
            'airport_to'=>'required',

            'ac_seat'=>'required',
            'ac_berth'=>'required',
            'economy_one_seat'=>'required',
            'economy_one_berth'=>'required',
            'economy_two_seat'=>'required',
            'economy_two_berth'=>'required',
            'brake_seat'=>'required',
            'brake_berth'=>'required',


//            'company_id'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }
        $dataKeys = [
            'title',
            'code',
            'departure_time',
            'arrival_time',
            'duration',
            'airport_from',
            'airport_to',
            'ac_seat',
            'ac_berth',
            'economy_one_seat',
            'economy_one_berth',
            'economy_two_seat',
            'economy_two_berth',
            'brake_seat',
            'brake_berth',

//            'company_id',
            'status',
        ];
        if ($this->hasPermission('flight_manage_others')) {
            $dataKeys[] = 'create_user';
        }

        $row->fillByAttr($dataKeys, $request->input());
        $res = $row->saveOriginOrTranslation(false, true);
        if ($res) {
            $this->saveTerms($row,$request);
            if ($id > 0) {
                return back()->with('success', __('Train updated'));
            } else {
                return redirect(route('train.admin.edit', $row->id))->with('success', __('Train created'));
            }
        }
    }
    public function saveTerms($row, $request)
    {
        $this->checkPermission('flight_manage_attributes');
        if (empty($request->input('terms'))) {
            $this->train_term::where('target_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                $this->train_term::firstOrCreate([
                    'term_id'   => $term_id,
                    'target_id' => $row->id
                ]);
            }
            $this->train_term::where('target_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function bulkEdit(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }

        switch ($action) {
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->train::where("id", $id);
                    if (!$this->hasPermission('flight_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('flight_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->delete();
                        event(new UpdatedServiceEvent($row));

                    }
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            case "permanently_delete":
                foreach ($ids as $id) {
                    $query = $this->train::where("id", $id);
                    if (!$this->hasPermission('flight_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('flight_delete');
                    }
                    $row = $query->withTrashed()->first();
                    if ($row) {
                        $row->forceDelete();
                    }
                }
                return redirect()->back()->with('success', __('Permanently delete success!'));
                break;
            case "recovery":
                foreach ($ids as $id) {
                    $query = $this->train::withTrashed()->where("id", $id);
                    if (!$this->hasPermission('flight_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('flight_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->restore();
                        event(new UpdatedServiceEvent($row));

                    }
                }
                return redirect()->back()->with('success', __('Recovery success!'));
                break;
            case "clone":
                $this->checkPermission('flight_create');
                foreach ($ids as $id) {
                    (new $this->train())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Clone success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->train::where("id", $id);
                    if (!$this->hasPermission('flight_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('flight_update');
                    }
                    $row = $query->first();
                    $row->status = $action;
                    $row->save();
                    event(new UpdatedServiceEvent($row));
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }


    }

}
