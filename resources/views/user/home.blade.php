@extends('layouts.user')

@section('content')
<div class="main" id="service-page">
	<div class="row">
        <div class="col-md-4">
            <div class="search-bus-box">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/searchbus') }}" id="frm" autocomplete="off">
                {{ csrf_field() }}
                <div class="form-group float-left">
                    <label for="from" class="control-label">Origin</label>
                    <div>
                        <input id="from" type="text" class="form-control js_typeahead" name="from"  value="{{ \Request::get('from') }}" required autofocus>
                    </div>
                </div>
                <div class="float-left"><p>&nbsp;</p></div>
                <div class="form-group float-right">
                    <label for="to" class="control-label">Destination</label>
                    <div>
                        <input id="to" type="text" class="form-control js_typeahead" name="to" value="{{ \Request::get('to') }}" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </div>
            </form>
            </div>
        </div>
        <div class="col-md-8">
            @if(isset($buses) && !$buses->isEmpty())
                @foreach($buses as $bus)
                    <div class="search-container">
                        <div class="bus-image">
                            <img src="{{asset('images/bus-image.jpg')}}" width="200" height="150">
                        </div>
                        <div class="bus-details">
                            <div class="detail-sec">
                                <span><b>Bus Operator : </b>{{ $bus->name }}</span><br/>
                                <span><b>Bus Type : </b>{{ $bus->busType->name }}</span><br/>
                                <span><b>Route / Arrival Time : </b> <br>
                                    @foreach ($bus->stations as $station)
                                        -> {{ $station->name }} / {{ $station->pivot->arrival_time }} <br>
                                    @endforeach
                                </span><br/>
                             </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="search-container"><p>No Buses available for this search</p></div>
            @endif
        </div>
	</div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#frm").submit(function(){
                if($('#from').val() == '') {
                    alert('Please fill the origin');
                    $('#from').focus();
                    return false;
                } else if($('#to').val() == '') {
                    alert('Please fill the destination');
                    $('#to').focus();
                    return false;
                }
                return true;
            });

            var url = "{{ url('/autocomplete') }}";
            $('input.js_typeahead').typeahead({
                minLength: 0,
                items: 500,
                showHintOnFocus:true,
                source:  function (query, process) {
                    var $this = this
                    return $.get(url, { query: query }, function (data) {
                        var options = [];
                        $this["map"] = {};
                        $.each(data,function (i,val){
                            options.push(val.input_text);
                            $this.map[val.input_text] = val.input_value;
                        });

                        return process(options);
                    });
                },
                updater: function (item) {
                    return this.map[item];

                }
            });

        });
    </script>
@endsection