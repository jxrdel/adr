@extends('layout')

@section('main')

	<!-- Modal -->
    <div class="modal fade modal-sm" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="patientModalLabel" style="color:red;margin:auto">Warning <i class="bi bi-exclamation-triangle"></i></h1>
        </div>
        <div class="modal-body">
          {{-- Form to create daily register --}}
            <form method="POST" id="createDailyRegister" action="#">
                @csrf
                @method('PUT')
                <div class="mb-3" style="text-align:center">
				  <p>This batch was created by <strong>{{$batchowner}}</strong>. <br></p>
				  <p>Press 'Continue' to proceed or 'Cancel' to return to the Batches page</p>
                </div>
                <div class="row" style="display: flex">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="margin:auto">Continue</button>
                    </div>

                    <div class="col" style="text-align: end">
                        <a href="{{ route('batches') }}"><button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" style="margin:auto; width:90px">Cancel</button></a>
                    </div>

                </div>
              </form>
        </div>
      </div>
    </div>
    </div>

<div class="text-center mb-5">
    
    <h1 class="fw-bolder"> Admission & Discharge Records</h1>
    <br>
    <h1 class="fw-bolder" style="text-decoration: underline">{{$batchno}}</h1>
    <br>
    <p class="fw-bolder" style="color: {{ $recordcount >= 250 ? 'red' : 'black'}}">{{$recordcount}}/250 Records Entered</p>
	
</div>

<div class="container">
    
    
    @if ($recordcount < 250)
        <a class="btn btn-primary btn-lg px-4 me-sm-3"  href="{{ route('createbatchrecord', ['id' => $batchid]) }}"> <i class="bi bi-plus-lg"></i> Add Record</a>
    @else
    <div style="cursor: not-allowed; width:200px" title="Maximum amount of records have been entered">
        <a class="btn btn-primary btn-lg px-4 me-sm-3 disabled" style="cursor:not-allowed;"  href="{{ route('createbatchrecord', ['id' => $batchid]) }}"> <i class="bi bi-plus-lg"></i> Add Record</a>
    </div>
        
    @endif
    <br>
    <br>
    
<table id="adrecordsTable" class="table table-striped table-bordered hover">
    <thead>
        <tr>
            <th>Registraion Number</th>
            <th>Batch ID</th>
            <th>Hospital</th>
            <th>Create By</th>
            <th>Created Date</th>
            <th>Last Updated</th>
            <th>Last Updated By</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
        <tr>
            <td>{{ $record->adRegistrationNo }}</td>
            <td>{{ $record->btNumber }}</td>
            <td>{{ $record->hsTitle }}</td>
            <td>{{ $record->adCreatedBy }}</td>
            <td>{{ $record->adCreatedDate }}</td>
            <td>{{ $record->adLastUpdatedDate }}</td>
            <td>{{ $record->adLastUpdatedBy }}</td>
            <td><a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="{{ route('editadrecords', ['id' => $record->adID]) }}"><i class="bi bi-pencil-square"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection

@section('scripts')
<!-- import jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@if (Str::lower($_SERVER['AUTH_USER']) !== $batchowner)
<!--Modal JS Script -->
<script type="text/javascript">
    window.onload = () => {
        $('#patientModal').modal('show');
    }
</script>
@endif
    
@endsection