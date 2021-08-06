@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking Form</div>
                <form action="{{ route('add.order') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Choose Location</label>
                            <select name="location" class="form-select form-control" aria-label="Default select example">
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Choose Staff</label>
                            <select name="staff" class="form-select form-control" aria-label="Default select example">
                                @foreach($staff as $data)
                                    <option value="{{ $data->id }}">{{ $data->first_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Choose Date and Time</label>
                            <input name="datetime" type="datetime-local" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Choose Service</label>
                            <div class="accordion" id="accordionExample">
                                @foreach($categories as $category)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $category->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" aria-expanded="true" aria-controls="collapse{{ $category->id }}">
                                            {{ $category->name }}
                                        </button>
                                        </h2>
                                        <div id="collapse{{ $category->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $category->id }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @foreach($category->services as $service)
                                                <div class="form-check mb-1">
                                                    <input name="service[]" class="form-check-input" type="checkbox" value="{{ $service->id }}" id="flexCheckDefault">
                                                    <span>{{ $service->name }}</span><br>
                                                    <span class="form-check-label text-muted" for="flexCheckDefault">
                                                        {{ $service->duration }} {{ $service->time }}
                                                    </span> |
                                                    <span class="form-check-label text-primary" for="flexCheckDefault">
                                                        <strong>ksh {{ $service->price }}</strong>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary w-100">Choose Servise Barbershop</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
