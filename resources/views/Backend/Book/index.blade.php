@extends('Backend.layout.master')

@section('content-title')
    {{ __('dashboard.book') }}
@endsection

@section('content')

    <div class="row row-sm">
        <table class="table table-bordered table-colored table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div><!-- row -->

@endsection