@extends('layouts.main')
@section('title', 'Form Add Movies')
@section('artikel')
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="/save" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>nama</label>
                    <input type="text" name="nama" class="form-control" required></div>
                    <div class="form-group">
                        <label>gender</label>
                        <select name="gender" class="form-control">
                            <option value="0">--Pilih gender--</option>
                            <option value="Jantan">Jantan</option>
                            <option value="Betina">Betina</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="number" min="1900" max="2100" name="year" class="form-control" required>
                    </div>
                
                    <div class="form-group">
                        <label>photo</label>
                        <input type="file" accept="image/*" name="photo" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
@endsection