@extends('layouts.main')
@section('title', "Movies")
@section('artikel')
<div class="card">
    <div class="card-header">
        <a href="/pet/form-add" class="btn btn-primary"><i class="bi bi-plus-square-fill"></i> PET</a>
        <input type="text" id="search" placeholder="Search Movies" class="form-control" style="width: 300px; display: inline-block; margin-left: 20px;">
        <button id="search-btn" class="btn btn-primary">Search</button>
    </div>
    <div class="card-body">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Year</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="movie-table-body">
                @foreach ($mv as $idx => $m)
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->gender }}</td>
                    <td>{{ $m->year }}</td>
                    <td>
                        <img src="{{ asset('/storage/'.$m->photo) }}" alt="{{ $m->photo }}" height="80" width="80">
                    </td>
                    <td>
                        <a href="/form-edit/{{ $m->id }}" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="/delete/{{ $m->id }}" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-btn').click(function() {
            let query = $('#search').val();
            $.ajax({
                url: '/api/movieapp/v1/search',
                type: 'GET',
                data: { q: query },
                success: function(response) {
                    if (response.success) {
                        let movies = response.data;
                        let tableBody = $('#movie-table-body');
                        tableBody.empty();
                        $.each(movies, function(index, movie) {
                            let row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + movie.nama + '</td>' +
                                '<td>' + movie.gender + '</td>' +
                                '<td>' + movie.year + '</td>' +
                                '<td><img src="/storage/' + movie.photo + '" alt="' + movie.photo + '" height="80" width="80"></td>' +
                                '<td>' +
                                '<a href="/form-edit/' + movie.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>' +
                                '<a href="/delete/' + movie.id + '" class="btn btn-danger"><i class="bi bi-trash3"></i></a>' +
                                '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    } else {
                        alert(response.data);
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
