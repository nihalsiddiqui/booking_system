
<div class="panel">
    <div class="panel-title"><strong>{{__("Content")}}</strong></div>
    <div class="panel-body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <label>{{__("Name")}}</label>
                    <input type="text" value="{{old("title",$row->title)}}" placeholder="{{__("Name")}}" name="title" class="form-control">
                </div>
                <div class="form-group col-lg-6">
                    <label>{{__("Code")}}</label>
                    <input type="text" value="{{old("code",$row->code)}}" placeholder="{{__("Code")}}" name="code" class="form-control">
                </div>
            </div>
    </div>
</div>
<div class="panel">
    <div class="panel-title"><strong>{{__("Location")}}</strong></div>
    <div class="panel-body">
            <div class="row">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">{{__('From')}}</label>
                        <?php
                        $jsons = !empty($row->airportFrom) ? $row->airportFrom : false;
                        \App\Helpers\AdminForm::select2('airport_from', [
                                'configs' => [
                                        'ajax'        => [
                                                'url' => route('train.admin.airport.getForSelect2'),
                                                'dataType' => 'json'
                                        ],
                                        'allowClear'  => true,
                                        'placeholder' => __('-- Select Location from --')
                                ]
                        ], !empty($jsons->id) ? [
                                $jsons->id,
                                $jsons->name . ' (#' . $jsons->id  . ')'
                        ] : false)
                        ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">{{__('To')}}</label>
                        <?php
                        $jsons = !empty($row->airportTo) ? $row->airportTo : false;
                        \App\Helpers\AdminForm::select2('airport_to', [
                                'configs' => [
                                        'ajax'        => [
                                                'url' => route('train.admin.airport.getForSelect2'),
                                                'dataType' => 'json'
                                        ],
                                        'allowClear'  => true,
                                        'placeholder' => __('-- Select Location to --')
                                ]
                        ], !empty($jsons->id) ? [
                                $jsons->id,
                                $jsons->name . ' (#' . $jsons->id  . ')'
                        ] : false)
                        ?>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group mt-4">
                    <label>{{__("AC Standard")}}</label>
                </div>
            </div>
            <div class=" form-group col-lg-5">
                <label>{{__(" Seat")}}</label>
                <input type="text" name="ac_seat" value="{{old("ac_seat",$row->ac_seat)}}" id="ac_seat" class="form-control" placeholder="AC Seat">
            </div>
            <div class=" form-group col-lg-5">
                <label>{{__(" Berth")}}</label>
                <input type="text" name="ac_berth" value="{{old("ac_berth",$row->ac_berth)}}" id="ac_berth" class="form-control" placeholder="AC Berth">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>{{__("Economy (78)")}}</label>
                </div>
            </div>
            <div class=" form-group col-lg-5">
                <input type="text" name="economy_one_seat" value="{{old("economy_one_seat",$row->economy_one_seat)}}" id="economy_one_seat" class="form-control" placeholder="Economy (78) Seat">
            </div>
            <div class=" form-group col-lg-5">
                <input type="text" name="economy_one_berth" value="{{old("economy_one_berth",$row->economy_one_berth)}}" id="economy_one_berth" class="form-control" placeholder="Economy (78) Berth">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>{{__("Economy (72)")}}</label>
                </div>
            </div>
            <div class=" form-group col-lg-5">
                <input type="text" name="economy_two_seat" value="{{old("economy_two_seat",$row->economy_two_seat)}}" id="economy_two_seat" class="form-control" placeholder="Economy (72) Seat">
            </div>
            <div class=" form-group col-lg-5">
                <input type="text" name="economy_two_berth" value="{{old("economy_two_berth",$row->economy_two_berth)}}" id="economy_two_berth" class="form-control" placeholder="Economy (72) Berth">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">

                    <label>{{__("Brake")}}</label>

                </div>
            </div>
            <div class=" form-group col-lg-5">
                <input type="text" name="brake_seat" value="{{old("brake_seat",$row->brake_seat)}}" id="brake_seat" class="form-control" placeholder="Brake Seat">
            </div>
            <div class=" form-group col-lg-5">
                <input type="text" name="brake_berth" value="{{old("brake_berth",$row->brake_berth)}}" id="brake_berth" class="form-control" placeholder="Brake berth">
            </div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-title"><strong>{{__(" Time")}}</strong></div>
    <div class="panel-body">
            <div class="row">
{{--                <div class="col-lg-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">{{__('Airline')}}</label>--}}
{{--                        <?php--}}
{{--                        $jsons = !empty($row->airline) ? $row->airline : false;--}}
{{--                        \App\Helpers\AdminForm::select2('airline_id', [--}}
{{--                                'configs' => [--}}
{{--                                        'ajax'        => [--}}
{{--                                                'url' => route('flight.admin.airline.getForSelect2'),--}}
{{--                                                'dataType' => 'json'--}}
{{--                                        ],--}}
{{--                                        'allowClear'  => true,--}}
{{--                                        'placeholder' => __('-- Select Airline --')--}}
{{--                                ]--}}
{{--                        ], !empty($jsons->id) ? [--}}
{{--                                $jsons->id,--}}
{{--                                $jsons->name . ' (#' . $jsons->id  . ')'--}}
{{--                        ] : false)--}}
{{--                        ?>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Departure time")}}</label>
                        <input type="text" name="departure_time" class="form-control has-datetimepicker" value="{{old("departure_time",$row->departure_time)}}" placeholder="{{__("Departure time")}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Arrival time")}}</label>
                        <input type="text" name="arrival_time" class="form-control has-datetimepicker" value="{{old("arrival_time",$row->arrival_time)}}" placeholder="{{__("Arrival time")}}">
                    </div>
                </div>
                <div class="col-lg-6 d-none">
                    <div class="form-group">
                        <label class="control-label">{{__("Duration")}}</label>
                        <div class="input-group mb-3">
                            <input type="text" name="duration" class="form-control" value="{{old("duration",$row->duration)}}" placeholder="{{__("Duration")}}"  aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">{{__('hours')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>






