@extends('layouts.app')

@section('content')

    <section class="section header-profil">

    </section>

    <div class="contain h-profil">
        <div class="columns d-flex align-items-start is-centered">
            <div class="column is-one-quarter d-flex justify-content-center position-relative">
                <img class="img-profil position-absolute"  src="/storage/avatars/{{ $user->avatar }}" alt="">
            </div>

            <div class="column is-half ml-3">
                <div class="level">
                    <div class="level-item">
                        <div>
                            <p class="item-title">Tweets</p>
                            <p class="item-value">{{ $tweets->count() }}</p>
                        </div>
                    </div>
                    <div class="level-item">
                        <div>
                            <p class="item-title">Abonnements</p>
                            <p class="item-value">{{ $followings->count() }}</p>
                        </div>
                    </div>
                    <div class="level-item">
                        <div>
                            <p class="item-title">Abonnées</p>
                            <p class="item-value">{{ $followers->count() }}</p>
                        </div>
                    </div>
                    @if($user->id == Auth::user()->id)
                        <div class="level-item">
                            <a href="/edit/profil" class="button">Editer le profil</a>
                        </div>
                    @endif

                    @if($user->id !== Auth::user()->id && $followers->find(Auth::user()->id) == null)
                        <form action="/profil/follow/{{$user->id}}" method="post">
                            {{csrf_field()}}
                            <div class="level-item">
                                <button class="button">Follow</button>
                            </div>
                        </form>

                    @endif
                   @if($followers->find(Auth::user()->id))
                        <form action="/unfollow/{{$user->id}}" method="post">
                           {{csrf_field()}}
                            <div class="level-item">
                                <button class="button">Unfollow</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="columns align-items-start is-centered py-5">

        <div class="column is-one-quarter">
            <div class="media-content">
                <div class="content profil">
                    <p>
                        <a href=""><strong>{{ $user->name }}</strong></a>
                        <a href="">
                            <small>{{ '@'.$user->username }}</small>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="column is-half ml-3 timeline">
            <section>
                @foreach($tweets as $tweet)
                    <div class="tweet box">
                        <article class="media">
                            <div class="media-left">
                                <img src="/storage/avatars/{{ $user->avatar }}" class="img-profil">
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>{{ $user->name }}</strong>
                                        <small>{{ '@'.$user->username }}</small>
                                        <small>{{ $tweet->created_at->diffForHumans() }}</small>
                                        <br>
                                        {{ $tweet->content }}
                                    </p>
                                </div>
                                <nav class="level is-mobile">
                                    <div class="level-left">
                                        <a class="level-item" aria-label="reply">
            <span class="icon is-small">
              <i class="fas fa-reply" aria-hidden="true"></i>
            </span>
                                        </a>
                                        <a class="level-item" aria-label="retweet">
            <span class="icon is-small">
              <i class="fas fa-retweet" aria-hidden="true"></i>
            </span>
                                        </a>
                                        <a class="level-item" aria-label="like">
            <span class="icon is-small">
              <i class="fas fa-heart" aria-hidden="true"></i>
            </span>
                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </article>
                    </div>
                @endforeach
            </section>
        </div>

    </div>

@endsection