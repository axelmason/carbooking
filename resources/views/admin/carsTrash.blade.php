@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <div class="container my-5">
        @if (Session::has('success'))
            <div class="alert alert-success">{!! Session::get('success') !!}</div>
        @endif
        <a href="{{ route('admin.addCarPage') }}" class="btn btn-primary my-2">Добавить автомобиль</a>
        <div class="">
            <a href="{{ route('admin.carsPage') }}" class="btn btn-outline-primary my-2">Все автомобили</a>
            <a href="{{ route('admin.carTrashPage') }}" class="btn btn-primary my-2">Корзина</a>
        </div>
        <h3 class="text-center">Корзина</h3>
        @if ($cars->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" style="vertical-align: middle; font-size: 18px;">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Автомобиль</th>
                    <th scope="col">Количество мест (всего)</th>
                    <th scope="col">Количество мест (свободных)</th>
                    <th scope="col">Дата и время поездки</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->seats->count() }}</td>
                            <td>{{ App\Services\CarService::free_seats($car) }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($car->booking_date)->format('d.m.Y') }}
                                {{ \Carbon\Carbon::parse($car->booking_time)->format('H:i') }}
                            </td>
                            <td class="text-center"><a href="{{ route('admin.restoreCar', $car->id) }}"
                                    class="btn btn-info">Восстановить</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="alert alert-info">Удалённых автомобилей пока нет.</div>
        @endif
    </div>
@endsection
