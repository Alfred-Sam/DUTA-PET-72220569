@extends('layouts.main')
@section('title', 'Form Edit Movies')
@section('artikel')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="/update/{{ $mv->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ $mv->nama }}" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control">
                        <option value="0">--Pilih Gender--</option>
                        <option value="Jantan" {{ ($mv->gender == "Jantan") ? "selected":"" }}>Jantan</option>
                        <option value="Betina" {{ ($mv->gender == "Betina") ? "selected":"" }}>Betina</option>
                    </select>

                </div>
                <div class="form-group">
                    <label>Year</label>
                    <input type="number" min="1900" max="2100" name="year" value="{{ $mv->year }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>photo</label>
                    <input type="file" accept="image/*" name="photo" class="form-control-file">
                </div>

                <div class="form-group">
                    <img src="{{ asset('/storage/'.$mv->photo) }}" alt="{{ $mv->photo }}" height="80" witdh="80">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
    </div>
@endsection