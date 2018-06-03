<div class="form-group">
    <label for="nama">Nama Fasilitas</label>
    {{ Form::text('nama', null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="merek">Merek Fasilitas</label>
    {{ Form::text('merek', null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="model">Model Fasilitas</label>
    {{ Form::text('model', null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    <label for="photo">Foto</label>
    {{ Form::file('photo', ['class' => 'form-control']) }}
</div>