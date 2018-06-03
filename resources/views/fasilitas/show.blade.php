@extends('blank')

{{-- Menu Breadcrumb --}}
@section('breadcrumb')
    
    <a class="btn" onclick="event.preventDefault();confirmDeletion('{{ route('fasilitas.destroy', [$detail->id]) }}');"><i class="icon-trash"></i> Hapus</a>
    <a class="btn" href="{{ route('fasilitas.edit', [ $detail->id]) }}"><i class="icon-pencil"></i> Edit</a>
    <a class="btn" href="{{ route('fasilitas.index') }}"><i class="icon-list"></i> List</a>

    <form style="display: none" action="{{ route('fasilitas.destroy', [$detail->id]) }}" method="post" id="form-delete">
        @csrf
        @method('delete')
    </form>
@endsection

{{-- Content Utama --}}
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Informasi fasilitas
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Fasilitas ID</label>
                        <div class="col-md-8">
                            <p class="col-form-label">{{ $detail->id }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Nama Fasilitas</label>
                        <div class="col-md-8">
                            <p class="col-form-label">{{ $detail->nama }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Merek</label>
                        <div class="col-md-8">
                            <p class="col-form-label">{{ $detail->merek }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Model</label>
                        <div class="col-md-8">
                            <p class="col-form-label">{{ $detail->model }}</p>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Waktu Pembuatan</label>
                        <div class="col-md-8">
                            <p class="col-form-label">{{ $detail->created_at }}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Waktu Perubahan</label>
                        <div class="col-md-8">
                            <p class="col-form-label">{{ $detail->updated_at }}</p>
                        </div>
                    </div>    


                </form>
            </div>
        </div>
    </div>
@include('fasilitas.picture')
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Informasi Ruangan Pengguna
            </div>

            <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 20px">NO</th>
                            <th class="text-center">Nama Ruangan</th>
                            <th class="text-center" style="width: 20px">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=0;?>
                        @foreach($tampil as $tampil)
                        <tr>
                            <td style="width: 20px">{{ ++$no }}</td>
                            <td>{{ $tampil->nmgedung }}.{{ $tampil->ltruangan }}.{{ $tampil->nmruangan }}</td>
                            <td style="width: 20px">{{ $tampil->jumlah }}</td>                          
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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