@extends('layouts.app')

@section('content')
<div class="_container">
    <div class="_columns _is_multiline">
        <div class="_column _is_three_quarters">
            <chat-box></chat-box>
        </div>
        <div class="_column _is_one_fifth">
            <chat-userlists></chat-userlists>
        </div>
    </div>
</div>
@endsection
