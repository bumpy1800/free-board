@extends('layouts.main')


@section('title')
	sj-inside
@endsection

@section('header')
	@include('layouts.main_header')
@endsection


<?php
/*DB::table('customers')                 //쿼리빌더 이렇게 사용 가능
            ->where('email', 'user@example.com')
            ->update(['confirmed' => true]);*/
?>
