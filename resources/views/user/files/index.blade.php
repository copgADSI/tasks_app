@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Listado de archivos') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col md-4 card m-2 text-center bg-success text-white">
                                <div class="m-auto">
                                    <span>Usuarios registrados  </span>
                                    <i>user</i>
                                    <legend>23123</legend>
                                </div>
                            </div>
                            <div class="col md-4 card m-2 text-center bg-primary text-white">
                                <div class="m-auto">
                                    <span>Archivos subidos</span>
                                    <i>files</i>
                                    <legend>23123</legend>
                                </div>
                            </div>
                            <div class="col md-4 card m-2 text-center bg-success text-white">
                                <div class="m-auto">
                                    <span>Tareas completadas</span>
                                    <i>tasks completed</i>
                                    <legend>0</legend>
                                </div>
                            </div>

                            <div class="col md-4 card m-2 text-center bg-warning text-white">
                                <div class="m-auto">
                                    <span>Tareas pendientes</span>
                                    <i>wa  tasks </i>
                                    <legend>12</legend>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
