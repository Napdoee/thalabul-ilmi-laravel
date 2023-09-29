@extends('templates.default')
@section('title', 'Users')

@section('content')
	@if($errors->any())
		<div class="alert alert-important alert-warning alert-dismissible" role="alert">
			<b>an error occured while create a user</b>
			@foreach($errors->all() as $error)
				<li class="mx-1">{{ $error }}</li>
			@endforeach
			<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
		</div>
	@endif
	 <div class="card">
		<div class="table-responsive">
			<table class="table table-vcenter card-table pt-3">
				<thead>
					<tr>
						<th>Username</th>
						<th>Email (verified ?)</th>
						<th>Roles</th>
						<th width="17%"></th>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $row)
				<tr>
					<td>{{ $row->name }}</td>
					<td><span class="{{ ($row->email_verified_at) ? 'text-success' : 'text-danger' }}">
						{{ $row->email }}
					</span></td>
					<td>{{ strtoupper($row->roles) }}</td>
					<td class="flex justify-center items-center">
						<a class="btn btn-info d-inline-block" href="{{ route('admin.user.edit', $row->id) }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							   <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
							   <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
							   <path d="M16 5l3 3"></path>
							</svg>
						</a>
						<form action="{{ route('admin.user.destroy', $row->id) }}" method="POST" class="d-inline-block">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger" >
								<svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								   <path d="M4 7l16 0"></path>
								   <path d="M10 11l0 6"></path>
								   <path d="M14 11l0 6"></path>
								   <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
								   <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
								</svg>
							</button>
						</form>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	  </div>
	  
	    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
				<form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="modal-body">
						<div class="mb-3">
							<label class="form-label">user Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
							placeholder="user Name" value="{{ old('name') }}">	
							@error('name')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-link link-secondary" data-bs-dismiss="modal">
							Cancel
						</button>
						<button type='submit' class="btn btn-primary ms-auto">
							Add user
						</button>
					</div>
				</form>
            </div>
        </div>
    </div>
@endSection()