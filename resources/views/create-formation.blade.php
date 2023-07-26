
@extends('layouts.main')
@section('content')
    <div class="rh-dashboard-bg">
        <h1>Créer une formation</h1>
        <div class="rh-dashboard-container">
            <div class="rh-item-container">

                <div class="form-container">
                    <form action="{{ route('formations.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                        <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                        <div class="form-group">
                        <label for="trainer">Trainer:</label>
                        <input type="text" id="trainer" name="trainer" required>
                    </div>
                        <div class="form-group">
                        <label for="specialite">Specialité:</label>
                        <select id="specialite" name="specialite" required>
                            <option value="Informatique">Informatique</option>
                            <option value="Electricité">Electricité</option>
                            <option value="Chimie">Chimie</option>
                            <option value="Finance">Finance</option>
                        </select>
                    </div>
                        <div class="form-group">
                        <label for="hours">Hours:</label>
                        <input type="number" id="hours" name="hours" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Créer</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

