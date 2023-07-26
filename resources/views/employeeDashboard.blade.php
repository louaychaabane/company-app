@extends('layouts.main')
@section('content')
    <div class="dashboard-bg">
        <h1>Bienvenue, {{ session('name') }}</h1>
        <div class="dashboard-container">
            <div class="item-container congé-dash">
                <h2>Congés</h2>
                <p>L'employé bénéficie d'une allocation annuelle de congés de 30 jours, qu'il peut utiliser pour prendre des
                    congés payés ou des jours de repos tout au long de l'année.</p>
                <a href="#" id="demandeConge">Demande de congé</a>
                <a href="#" id="historiqueConge">Historique des congés</a>
                {{-- Pop Up --}}
                <div id="popupOverlay">
                    <div id="popupContent">
                        <h6>Demande d'un congé</h6>
                        <form id="congeForm" action="{{ route('insert-conge') }}" method="POST">
                            @csrf
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="startDate" name="start_date">
                            <div id="startDateError" class="error-message"></div>
                            <label for="endDate">End Date:</label>
                            <input type="date" id="endDate" name="end_date">
                            <textarea name="description" id="description" cols="30" rows="5"></textarea>
                            <button type="submit">Submit</button>
                            @error('start_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            @error('end_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            @error('description')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </form>

                    </div>
                    <script src="{{ asset('/js/conge.js') }}"></script>
                </div>
                {{-- Pop Up --}}

                {{-- Pop Up --}}

                <div id="historiquePopupOverlay">
                    <div id="historiquePopupContent">
                        <a href="#" id="closePopup">X</a>
                        <h6>Historique des congés</h6>
                        <table id="congesTable">
                            <thead>
                                <tr>
                                    <th>Num</th>
                                    <th>Date debut</th>
                                    <th>Date fin</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $id = 0;
                                @endphp
                                @foreach ($conges->sortBy('start_date') as $conge)
                                    @if (session('id_employee') === $conge->id_employee)
                                        @php
                                            $id++;
                                        @endphp
                                        <tr style="background-color: {{ $id % 2 === 0 ? 'transparent' : '#E5E5E5' }}">
                                            <td>{{ $id }}</td>
                                            <td>{{ date('d/m/Y', strtotime($conge->start_date)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($conge->end_date)) }}</td>
                                            <td>{{ $conge->description }}</td>
                                            <td>
                                               @if ($conge->status === 'accepted')
                                               <span class="green">
                                                   Accepté
                                                </span>
                                               @elseif($conge->status === 'denied')
                                               <span class="red">
                                                Refusé
                                             </span>
                                               @else
                                               
                                                En cours
                                             
                                               @endif
                                            </td>
                                            <td class="inscrire-btn actions-btn"><button onclick="printRow({{ $id }})">Imprimer</button></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                {{-- Pop Up --}}
                @if ($user->credits > 0)
                    <h3>{{ $user->credits }}</h3>
                @else
                    <h3>0</h3>
                @endif
            </div>
            <div class=" item-container reminder-dash">
                <h2>À venir</h2>
                <table id="reminderTable">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Date debut</th>
                            <th>Temps restant</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $z = 0;
                        @endphp
                        @foreach ($sortedReminders as $reminder)
                            @php
                                $z++;
                            @endphp
                            <tr style="background-color: {{ $z % 2 === 0 ? 'transparent' : '#E5E5E5' }}">
                                <td>{{ ucfirst($reminder['type']) }}</td>
                                <td>{{ date('d/m/Y', strtotime($reminder['start_date'])) }}</td>
                                <td><span class="countdown" data-start-date="{{ $reminder['start_date'] }}"></span></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="item-container formations-dash">
                <h2>Formations disponibles </h2>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Formateur</th>
                            <th>Heures</th>
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
                                @if (session('specialite') === $formation->specialite)
                                    @php
                                        // Check if the employee has already applied for this formation
                                        $appliedFormation = \App\Models\AppliedFormation::where('id_employee', session('id_employee'))
                                            ->where('id_formation', $formation->id)
                                            ->first();
                                    @endphp

                                    @php
                                        $h++;
                                    @endphp

                                    <tr style="background-color: {{ $h % 2 === 0 ? 'transparent' : '#E5E5E5' }}">
                                        <td class="left-align">{{ $formation->title }}</td>
                                        <td>{{ date('d/m/Y', strtotime($formation->start_date)) }}</td>
                                        <td>{{ $formation->trainer }}</td>
                                        <td>{{ $formation->hours }}</td>
                                        <td>
                                            @if (!$appliedFormation)
                                                <form method="POST" action="{{ route('apply-for-formation') }}">
                                                    @csrf
                                                    <input type="hidden" name="formation_id" value="{{ $formation->id }}">
                                                    <div class="inscrire-btn">

                                                        <button type="submit">S'inscrire</button>
                                                    </div>
                                                </form>
                                            @else
                                                Déjà inscrit
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="item-container retraite-dash">
                <div class="title">

                    <h2>Partir en Mission</h2>
                    <a href="" id="demandeMission">
                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                    </a>
                </div>
                <table id="missionsTable">
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Date debut</th>
                            <th>Date fin</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 0;
                        @endphp
                        @if ($missions->isEmpty())
                            <tr>
                                <td id="empty-info" colspan="4">Pas des missions effectué</td>
                            </tr>
                        @else
                            @foreach ($missions->sortBy('start_date') as $mission)
                                @if (session('id_employee') === $mission->id_employee)
                                    @php
                                        $id++;
                                    @endphp
                                    <tr style="background-color: {{ $id % 2 === 0 ? 'transparent' : '#E5E5E5' }}">
                                        <td>{{ $id }}</td>
                                        <td>{{ date('d/m/Y', strtotime($mission->start_date)) }}</td>
                                        <td>{{ date('d/m/Y', strtotime($mission->end_date)) }}</td>
                                        <td>{{ $mission->description }}</td>
                                        {{-- <td><button onclick="printRow({{ $id }})">Imprimer</button></td> --}}
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{-- Pop Up --}}
                <div id="missionPopupOverlay">
                    <div id="missionPopupContent">
                        <h6>Demande de Mission</h6>
                        <form id="missionForm" action="{{ route('insert-mission') }}" method="POST">
                            @csrf
                            <label for="startDate">Start Date:</label>
                            <input type="date" id="missionStartDate" name="start_date">
                            <div id="missionStartDateError" class="error-message"></div>
                            <label for="endDate">End Date:</label>
                            <input type="date" id="missionEndDate" name="end_date">
                            <textarea name="description" id="description" cols="30" rows="5"></textarea>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                    <script src="{{ asset('/js/mission.js') }}"></script>
                </div>
                {{-- Pop Up --}}

            </div>
        </div>


    </div>
    <!-- Add this at the bottom of the employeeDashboard.blade.php file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Update the countdown for each reminder row
            function updateCountdown() {
                $('.countdown').each(function() {
                    let startDate = new Date($(this).data('start-date')).getTime();
                    let now = new Date().getTime();
                    let timeRemaining = startDate - now;

                    // Calculate the days, hours, minutes, and seconds remaining
                    let days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                    // Format numbers to always have two digits
                    days = days.toString().padStart(2, '0');
                    hours = hours.toString().padStart(2, '0');
                    minutes = minutes.toString().padStart(2, '0');
                    seconds = seconds.toString().padStart(2, '0');

                    // Display the countdown in the format: dd:hh:mm:ss
                    $(this).text(`${days}:${hours}:${minutes}:${seconds}`);
                });
            }

            // Update the countdown every second
            setInterval(updateCountdown, 1000);
        });
    </script>


@endsection
