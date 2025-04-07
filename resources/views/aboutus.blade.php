@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">
    

    <div class="container">
        <h1>About Us</h1>
        <p> we are AR photography</p>
        <div class="team-container">
            <!-- Team Member 1 -->
            <div class="team-card">
                <h3>navi infosys</h3>
                <h4>Founder & Director</h4>
                <p style="text-align:center;">Capturing Moments, Creating Memories.</p>
            </div>

            <!-- Team Member 2 (Highlighted) -->
            <div class="team-card highlighted">
                <h3>navi infosys</h3>
                <h4>Marketer</h4>
                <p style="text-align:center;">Marketing Visual Stories to the World.</p>
            </div>

            <!-- Team Member 3 -->
            <div class="team-card">
                <h3>naviinfo sys</h3>
                <h4>Manager</h4>
                <p style="text-align:center;">Managing Creativity, Delivering Excellence.</p>
            </div>

            <!-- Team Member 4 -->
            <div class="team-card">
                <h3>navi infosys</h3>
                <h4>Partner</h4>
                <p style="text-align:center;">Framing Moments, Building Dreams.</p>
            </div>
        </div>
    </div>
@endsection