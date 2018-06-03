@extends('blank')

{{-- Menu Breadcrumb --}}
@section('breadcrumb')
<a class="btn" href="{{ route('fasilitas.create') }}"><i class="icon-plus"></i> Tambah</a>
@endsection

{{-- Content Utama --}}
@section('content')

<div class="row">
    <div class="col-md-12">
        
        <div class="card">
            
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Daftar Fasilitas
            </div> 
            
            <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 20px">NO</th>
                            <th class="text-center">Nama Fasilitas</th>
                            <th class="text-center">Merek Fasilitas</th>
                            <th class="text-center">Model Fasilitas</th>
                            <th class="text-center" style="width: 200px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=0;?>
                        @foreach($fasilitas as $fasilitas)
                        <tr>
                            <td style="width: 20px">{{ ++$no }}</td>
                            <td>{{ $fasilitas->nama }}</td>
                            <td>{{ $fasilitas->merek }}</td>
                            <td>{{ $fasilitas->model }}</td>
                                                        
                            <td class="text-center" style="width: 40px" >
                                <a href="{{ route('fasilitas.show', [$fasilitas->id]) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-eye"> </i>
                                </a>
                                <a href="{{ route('fasilitas.edit', [$fasilitas->id]) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-pencil"> </i>
                                </a>
                                <button onclick="event.preventDefault();confirmDeletion('{{ route('fasilitas.destroy', [$fasilitas->id]) }}');" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"> </i>
                                </button>
                                
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        
    </div>
</div>

<form style="display: none" action="#" method="post" id="form-delete">
    @csrf
    @method('delete')
</form>


@endsection

@push('javascript')
<script>
    function confirmDeletion(url){
        if(confirm('Anda yakin akan menghapus Fasilitas ini? ')){
            form = document.querySelector('#form-delete');
            form.action = url;
            form.submit();
        }
    }
    
</script>
@endpush

