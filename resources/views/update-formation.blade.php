<!-- resources/views/update-formation.blade.php -->
@extends('layouts.main')
@section('content')
    <div class="rh-dashboard-bg">
        <h1>Mise à jour formation</h1>
        <div class="rh-dashboard-container">
            <div class="rh-item-container">

                <div class="form-container">
                    <form action="{{ route('save-formation', ['id' => $formation->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Include the form fields here to update the formation details -->
                        <div class="form-group">
                            <label for="title">Titre:</label>
                            <input type="text" id="title" name="title" value="{{ $formation->title }}" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="start_date">Date debut:</label>
                            <input type="date" id="start_date" name="start_date" value="{{ $formation->start_date }}" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="trainer">Formateur:</label>
                            <input type="text" id="trainer" name="trainer" value="{{ $formation->trainer }}" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="specialite">Specialité:</label>
                            <select id="specialite" name="specialite" required class="form-control">
                                <option value="Informatique" {{ $formation->specialite === 'Informatique' ? 'selected' : '' }}>Informatique</option>
                                <option value="Electricité" {{ $formation->specialite === 'Electricité' ? 'selected' : '' }}>Electricité</option>
                                <option value="Chimie" {{ $formation->specialite === 'Chimie' ? 'selected' : '' }}>Chimie</option>
                                <option value="Finance" {{ $formation->specialite === 'Finance' ? 'selected' : '' }}>Finance</option>
                            </select>
                        </div>
                
                        <div class="form-group">
                            <label for="hours">Heures:</label>
                            <input type="number" id="hours" name="hours" value="{{ $formation->hours }}" required class="form-control">
                        </div>
                        <!-- Add other form fields for the remaining formation properties -->
                
                        <button type="submit" class="btn btn-primary">Mettre à jour formation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
