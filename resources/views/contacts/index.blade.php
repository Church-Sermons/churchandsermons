@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">Contacts</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-container">
                                <table class="table is-fullwidth">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->message }}</td>
                                            <td>
                                                <a href="{{ route('organisations.contacts.show', [$contact->org_id, $contact->id])}}" class="button is-primary is-outlined">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
