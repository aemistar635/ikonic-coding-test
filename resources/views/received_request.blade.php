@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/helper.js') }}?v={{ time() }}" defer></script>
    <script src="{{ asset('js/main.js') }}?v={{ time() }}" defer></script>

    <div class="container">
        <x-dashboard />
        <div class="row justify-content-center mt-5">
            <div class="col-12">
                <div class="card shadow  text-white bg-dark">
                    <div class="card-header">Coding Challenge - Network connections</div>
                    <div class="card-body">
                        <div class="btn-group w-100 mb-3" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" >
                            <label class="btn btn-outline-primary" for="btnradio1" id="get_suggestions_btn" >
                            <a href="{{route('home',['type'=>'suggestion'])}}"> 
                            Suggestions 
                            </a>   
                        </label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" >
                            <label class="btn btn-outline-primary" for="btnradio2" id="get_sent_requests_btn">
                            <a href="{{route('send_request',['type'=>'sendRequest'])}}"> 
                            Sent Requests 
                            </a>       
                            </label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btnradio3" id="get_received_requests_btn">
                            <a href="{{route('received_request',['type'=>'receivedRequest'])}}"> 
                            Received  Requests
                            </a>     
                            </label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio3" id="get_received_requests_btn">
                            <a href="{{route('connection',['type'=>'connection'])}}"> 
                            Connections
                            </a>     
                            </label>
                        </div>
                        <hr>
                        
                        <!-- Send Requests data showing -->
                        @if(request('type')=='receivedRequest')
                        <div  id="requestData">
                        <span class="fw-bold">Sent Request Blade</span>
                        <div class="my-2 shadow  text-white bg-dark p-1" >
                            @foreach($data['requests'] as $data)
                                <div class="d-flex justify-content-between">
                                    <table class="ms-1">
                                        <tr>
                                            <td class="align-middle">Name::</td>
                                            <td class="align-middle"> {{$data->receiver_name}}</td>
                                            <td class="align-middle">Email::</td>
                                            <td class="align-middle"> {{$data->receiver_email}}</td>
                                        </tr>
                                    </table>
                                    <div>
                                        <button id="create_request_btn_" class="btn btn-primary me-1">
                                        <a href="{{ route('send.acceptrequest',$data->request_id) }}">
                                            Accept
                                        </a>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif
    </div>
<script>

</script>
@endsection
