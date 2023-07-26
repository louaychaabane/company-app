@extends('layouts.main')

@section('content')
    <div class="rh-dashboard-bg">
        <h1>Espace RH</h1>
        <div class="rh-dashboard-container">
            <div class="rh-item-container formations">
                <h2>Formations disponibles </h2>
                <a href="{{ route('formations.create') }}" class="add-button">
                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                </a>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Formateur</th>
                            <th>Specialité</th>
                            <th>Heures</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $h = 0;
                        @endphp
                        @if ($formations->isEmpty())
                            <tr>
                                <td id="empty-info" colspan="4">Pas des formations pour le moment</td>
                            </tr>
                        @else
                            @foreach ($formations->sortBy('start_date') as $formation)
                                @php
                                    $h++;
                                @endphp

                                <tr style="background-color: {{ $h % 2 === 0 ? 'transparent' : '#E5E5E5' }}">
                                    <td class="left-align">{{ $formation->title }}</td>
                                    <td>{{ date('d/m/Y', strtotime($formation->start_date)) }}</td>
                                    <td>{{ $formation->trainer }}</td>
                                    <td>{{ $formation->specialite }}</td>
                                    <td>{{ $formation->hours }}</td>
                                    <td class="inscrire-btn actions-btn">
                                        <button>

                                            <!-- Update button -->
                                            <a href="{{ route('update-formation', ['id' => $formation->id]) }}">Update</a>
                                        </button>

                                        <!-- Delete button -->
                                        <form action="{{ route('delete-formation', ['id' => $formation->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="rh-item-container conges">
                <h2>Demande des congés</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>ID Employee</th>
                            <th>Date debut</th>
                            <th>Date fin</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 0;
                        @endphp
                        @foreach ($conges->sortBy('start_date') as $conge)
                            @if ($conge->status === 'pending')
                                @php
                                    $id++;
                                @endphp
                                <tr style="background-color: {{ $id % 2 === 0 ? 'transparent' : '#E5E5E5' }}">
                                    <td>{{ $id }}</td>
                                    <td>{{ $conge->id_employee }}</td>
                                    <td>{{ date('d/m/Y', strtotime($conge->start_date)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($conge->end_date)) }}</td>
                                    <td>{{ $conge->description }}</td>
                                    <td class="actions-btn inscrire-btn">
                                        <form action="{{ route('update-conge-status', ['id' => $conge->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="employee_id" value="{{ $conge->id_employee }}">
                                            <button type="submit" name="status" value="accepted">Accept</button>
                                        </form>
                                        <form action="{{ route('update-conge-status', ['id' => $conge->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="employee_id" value="{{ $conge->id_employee }}">
                                            <button type="submit" name="status" value="denied">Deny</button>
                                        </form>
                                    </td>

                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection
