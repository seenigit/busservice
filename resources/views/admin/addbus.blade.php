@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="container">
    <h1>Add Bus</h1>
  	<hr>
	<div class="row">      
      
      <div class="col-md-9 personal-info">
          @if ($errors->any())
              <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{!! $error !!}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        @if(Session::has('message'))
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{Session::get('message')}}
            </div>
        @endif
        <form class="form-horizontal" role="form" method="post" action="{{ url("/admin/addbus") }}" id="frm">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="col-lg-3 control-label">Name:</label>
            <div class="col-lg-8">
                <input class="form-control" value="{{ old('name') }}" type="text" name="name" id="name" required>
            </div>
          </div>
          <div class="form-group">
                <label class="col-lg-3 control-label">Bus Types:</label>
                <div class="col-lg-8">
                    <select id="busType" name="busType">
                        @foreach ($busTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Stations:</label>
            <div class="col-lg-8">
                <select id="stations" name="stations[]" multiple="multiple" required>
                    @foreach ($stations as $key => $station)
                        <?php $stOldVal = old('stations', null);
                              $selected = '';
                              if(!empty($stOldVal) && in_array($station->id, $stOldVal))
                                  $selected = 'selected'; ?>
                        <option value="{{ $station->id }}" {{ $selected }}>{{ $station->name }}</option>
                    @endforeach
                </select>
            </div>
          </div>
            <div class="form-group">
                <div id="stationsinfo">
                    @if((old('stations', null) != null))
                        @foreach(old('stations') as $key => $stOldVal)
                            <div class="row" id="station{{$stations[$stOldVal-1]->id}}">
                                <div class="col-sm-4">Station - <b>{{$stations[$stOldVal-1]->name}}</b></div>
                                <div class="col-sm-3">Station Order - <input class="station-order" name="stationOrder[]" value="{{ old('stationOrder')[$key] }}" id="stationOrder[]" type="number" min="0" required></div>
                                <div class="col-sm-5">Arrival Time - <input placeholder="HH:MM" name="arrivalTime[]" value="{{ old('arrivalTime')[$key] }}" id="arrivalTime[]" class="arrival-time" type="text" maxlength="5" required></div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-8">
                    <input class="btn btn-primary" value="Add Bus" type="submit">
                    <span></span>
                </div>
            </div>
        </form>
      </div>
  </div>
 </div></div></div></div></div>
<hr>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            var order = 0;
            <!-- Initialize the plugin: -->
            $('#stations').multiselect({
                onChange: function(option, checked, select) {
                    order++;
                    if (checked === true) {
                        $('#stationsinfo').append('<div class="row" id="station'+$(option).val()+'">' +
                            '                      <div class="col-sm-4">Station - <b>'+$(option).text()+'</b></div>\n' +
                            '                      <div class="col-sm-3">Station Order - <input value="'+order+'" class="station-order" name="stationOrder[]" id="stationOrder[]" type="number" min="0" required></div>\n' +
                            '                      <div class="col-sm-5">Arrival Time - <input placeholder="HH:MM" name="arrivalTime[]" class="arrival-time" id="arrivalTime[]" type="text" maxlength="5" required></div>' +
                            '                      </div>')
                    }
                    else if (checked === false) {
                        $('#station'+$(option).val()).remove();
                    }
                }
            });

            $("#frm").submit(function(){
                let success = true;
                let message = '';
                if($('#name').val() == '') {
                    success = false;
                    message += 'The name field is required\n';
                }
                if($('#stations :selected').text() == ''){
                    success = false;
                    message += 'The stations field is required\n';
                } else {
                    $('[id^=stationOrder]').each(function(index) {
                        if($(this).val() == '') {
                            success = false;
                            message += 'The stationOrder'+index+' field is required\n';
                        }
                    });

                    $('[id^=arrivalTime]').each(function(index) {
                        if($(this).val() == '') {
                            success = false;
                            message += 'The arrivalTime'+index+' field is required\n';
                        } else {
                            var email = new RegExp('^(?:2[0-3]|[01][0-9]):[0-5][0-9]$');
                            if (!email.test($(this).val())) {
                                success = false;
                                message += 'The arrivalTime'+index+' format is wrong. Please specify in hh:mm format. \n';
                            }
                        }
                    });
                }

                if(!success) {
                    alert(message);
                    return false;
                }
            });
        });
    </script>
@endsection




