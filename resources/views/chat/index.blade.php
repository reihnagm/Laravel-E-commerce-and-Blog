@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-three-quarters">
                <chat-box></chat-box>
            </div>
            <div class="column is-one-fifth">
                <chat-userlists></chat-userlists>
            </div>
        </div>
    </div>  
@endsection
