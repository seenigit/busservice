@extends('layouts.master')

@section('content')
<script>
function callDeleteBus(id) {
    if(confirm('Are you sure you want to delete this bus?')){
        $('#frm'+id).submit();
        return false;
    }
}    
</script>
<style>
    table.table-condensed td.col-md-1, table.table-condensed td.col-md-2{
        word-break: break-all;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><div class="float-left">Bus Management</div><div class="float-right"><a href="{{ url('/admin/addbus') }}">
                            Add Bus
                        </a></div></div>

				<div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{Session::get('message')}}
                        </div>
                    @endif
					<table class="table table-condensed">
                                            <thead>
                                              <tr>
                                                <th class="col-md-1">S.No</th>
                                                <th class="col-md-9">Name</th>
                                                <th class="col-md-2">Actions</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach ($buses as $key => $bus)
                                              <tr>
                                                <td class="col-md-1">{{ ++$key }}</td>
                                                <td class="col-md-9">{{ $bus->name }}</td>
                                                <td class="col-md-2">
                                                    &nbsp;<form id="frm{{ $bus->id }}" name="deletefrm{{ $bus->id }}" method="post" action="{{ url("/admin/deletebus") }}" style="float:left">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $bus->id }}">
                                                    </form>
                                                    <a href="javascript:void(0)" onclick="callDeleteBus('{{ $bus->id }}')">delete</a>
                                                </td>
                                              </tr>
                                              @endforeach
                                            </tbody>
                                        </table>
                                    

                                </div>
			</div>
		</div>
	</div>
</div>
@endsection