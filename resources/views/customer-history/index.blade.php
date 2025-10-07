@extends('layouts.layout')
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="head-label text-center">
                    <h5 class="card-title mb-0"><b>Customer History</b></h5>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-datatable text-nowrap p-5 m-5">
                @foreach($customerHistories as $history)
                    <div class="alert {{ \App\Enums\HistoryType::getColorClassByType($history->history_type) }}" style="display: flex; justify-content: space-between;" role="alert">
                        <span class="text-dark">{{ $history->comment }} </span>
                        <div>
                        <span> <small class="text-dark">Date: {{ \Carbon\Carbon::parse($history->created_at)->format('d-m-Y') }} </small> </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection
