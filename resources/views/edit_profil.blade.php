@extends('layouts.app')

@section('content')

    <div class="columns align-items-start is-centered py-4">

        <div class="column is-half ml-3 form-edit">

            <form action="/profil/{{ Auth::user()->id }}/update" method="post">
                {{--{{ method_field('PUT') }}--}}
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="level">
                    <div class="level-item">
                        <a class="img-profil">

                        </a>
                    </div>
                </div>
                <div class="file has-text-centered level">
                    <label class="file-label level-item">
                        <input class="file-input" type="file" name="resume">
                        <span class="file-cta">
                          <span class="file-icon">
                            <i class="fas fa-upload"></i>
                          </span>
                          <span class="file-label">
                            Ajouter une photo de profil
                          </span>
                        </span>
                    </label>
                </div>
                <div class="field">
                    <label class="label">Changer l'email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" placeholder="{{ Auth::user()->email }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Changer le nom</label>
                    <div class="control">
                        <input class="input" type="text" name="name" placeholder="{{ Auth::user()->name }}">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Changer le username</label>
                    <div class="control">
                        <input class="input" type="text" name="username" placeholder="{{ Auth::user()->username }}">
                    </div>
                </div>

                <a href="/profil/{{ Auth::user()->username }}" class="button">Annuler</a>
                <button class="button">Enregistrer</button>
            </form>

        </div>

    </div>


@endsection