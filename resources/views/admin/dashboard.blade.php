@extends('admin.layout')
@section('title', 'Panel de Administración')
@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4">Resumen general</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalActivities }}</h3>
                    <p>Actividades</p>
                </div>
                <div class="icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalReservations }}</h3>
                    <p>Reservas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $activePromotions }}</h3>
                    <p>Promociones Activas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>{{ $mostPopular ? $mostPopular->title : 'Sin actividades' }}</h4>
                    <p>Actividad más popular</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fire"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
