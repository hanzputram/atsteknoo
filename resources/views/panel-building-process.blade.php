@extends('layouts.app')

@php
    $pageData = \App\Services\PanelProcessService::getData();
    $pageVisibleStepCount = count(array_filter($pageData['steps'] ?? [], fn($s) => empty($s['is_hidden'])));
@endphp

@section('title', $pageVisibleStepCount . '-Stage Switchboard Panel Building Process | ATS Tekno Surabaya')
@section('meta_description', 'Explore the ' . $pageVisibleStepCount . '-step industrial switchboard manufacturing process by ATS Tekno: from engineering, CNC laser cutting & bending, surface treatment, powder coating, assembly, to FAT testing and delivery.')
@section('canonical', route('panel-building-process'))

@section('content')
    <x-panel-building-process />
@endsection
