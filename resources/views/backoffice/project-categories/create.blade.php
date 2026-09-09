@extends('backoffice.layouts.app')

@section('title', 'Tambah Kategori Project')
@section('breadcrumb')
<a href="{{ route('backoffice.project-categories.index') }}">Kategori Project</a> / <span>Tambah</span>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Tambah Kategori Project</h1>
  </div>
  <a href="{{ route('backoffice.project-categories.index') }}" class="btn btn-secondary">&larr; Kembali</a>
</div>

<div class="panel-card" style="max-width: 600px;">
  <div class="panel-body">
    <form action="{{ route('backoffice.project-categories.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label class="form-label" for="code">Kode Kategori *</label>
        <input type="text" name="code" id="code" class="form-control" required value="{{ old('code') }}" placeholder="Contoh: SUBSTATION">
      </div>

      <div class="form-group">
        <label class="form-label" for="name">Nama Kategori *</label>
        <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}" placeholder="Contoh: Substation & Main Switchboard">
      </div>

      <div class="form-group">
        <label class="form-label" for="description">Deskripsi</label>
        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
      </div>

      <div style="display: flex; gap: 12px; margin-top: 24px;">
        <button type="submit" class="btn btn-primary">Simpan Kategori</button>
        <a href="{{ route('backoffice.project-categories.index') }}" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
