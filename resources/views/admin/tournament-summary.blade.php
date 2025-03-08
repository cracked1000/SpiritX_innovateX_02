@extends('layouts.app')

@section('content')
    <h1>Tournament Summary</h1>
    <p>Total Runs: {{ $summary['total_runs'] }}</p>
    <p>Total Wickets: {{ $summary['total_wickets'] }}</p>
    <p>Highest Scorer: {{ $summary['highest_scorer'] }}</p>
    <p>Highest Wicket Taker: {{ $summary['highest_wicket_taker'] }}</p>
@endsection