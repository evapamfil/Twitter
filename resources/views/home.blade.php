@extends('layouts.app')

@section('content')

    <div class="columns align-items-start is-centered py-4">

        <div class="column is-one-quarter box-profil">
            <div class="contain">
                <div class="level-left">
                    <a class="img-profil" href="/profil/{{ Auth::user()->username }}">

                    </a>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <a href="/profil/{{ Auth::user()->username }}"><strong>{{ Auth::user()->name }}</strong></a>
                                <a href="/profil/{{ Auth::user()->username }}">
                                    <small>{{ '@'.Auth::user()->username }}</small>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="level">
                    <div class="level-item">
                        <div>
                            <p class="item-title">Tweets</p>
                            <p class="item-value">{{ Auth::user()->tweets->count() }}</p>
                        </div>
                    </div>
                    <div class="level-item">
                        <div>
                            <p class="item-title">Abonnements</p>
                            <p class="item-value">123</p>
                        </div>
                    </div>
                    <div class="level-item">
                        <div>
                            <p class="item-title">Abonnées</p>
                            <p class="item-value">12</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="column is-half ml-3 timeline">
            <section class="section form-tweet">
                <form class="" action="{{ route('tweet.post') }}" method="post">
                    {{csrf_field()}}

                    <div class="field level-left align-items-start">
                        <div class="media-left">
                            <a class="img-profil"></a>
                        </div>
                        <div class="media-content">
                            <div class="control">
                                <textarea name="tweet" class="textarea" placeholder="Quoi de neuf"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="control level-right">
                        <button class="button"{{-- @click="postTweet()"--}}>Tweeter</button>
                    </div>

                </form>
            </section>

            <section>
                @foreach($tweets as $tweet)

                    <div class="tweet box">

                        <article class="media">
                            <div class="media-left">
                                <a href="/profil/{{$tweet->user->username}}" class="img-profil"></a>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>{{ $tweet->user->name }}</strong>
                                        <small>{{ '@'.$tweet->user->username }}</small>
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


