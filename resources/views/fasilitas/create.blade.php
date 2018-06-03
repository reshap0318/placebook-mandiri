@extends('blank')

{{-- Menu Breadcrumb --}} 
@section('breadcrumb')
    <a class="btn" href="{{ route('fasilitas.index') }}"><i class="icon-list"></i> Fasilitas </a>
@endsection

{{-- Content Utama --}}
@section('content')
<div class="row">
    <div class="col-md-12"> 
        <div class="card">
            
            {!! Form::open(['route' => 'fasilitas.store', 'method' => 'post', 'enctype'=>'multipart/form-data'] ) !!}
            
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Tambah Fasilitas
            </div>
            
            <div class="card-body">
                
                @include('fasilitas._form')
                
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Simpan</button>
                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
            </div>
            
            {{ Form::close() }}
            
        </div>
    </div>
</div>
@endsection