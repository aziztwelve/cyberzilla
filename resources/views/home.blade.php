@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                            <router-link to="/user">
                                <button type="button" class="btn btn-secondary">User</button>
                            </router-link>
                        </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                            <router-link to="/todos">
                                <button type="button" class="btn btn-secondary">To Do</button>
                            </router-link>
                        </div>
                        <br><br>

                        <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
