<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
<section class="hero  is-bold" style="background-color: cornflowerblue">
    <div class="hero-body">
        <div class="container">
            <p class="title is-2">{{ $foo->name }}</p>
            <p class="subtitle is-3"></p>

        </div>
    </div>
</section>
@include('common.notification')
@stack('scripts')

<section class="section">
    <div class="container">
        <div class="columns">

            <div class="column is-12">

                <div class="content">


                    <p><strong>Id: </strong> {{ $foo->id }}</p>
                    <p><strong>Thud: </strong> {{ $foo->thud }}</p>
                    <p><strong>Wombat: </strong> {{ $foo->wombat }}</p>
                    <p><strong>Kazaam: </strong> {{ $foo->kazaam() }}</p>

                    {{-- Here are the form buttons: save, reset and cancel --}}
                    @if(Auth::user()->id === $foo->user_id || Auth::user()->role === 'admin')
                    <div class="field is-grouped">
                        <div class="control">
                            <a class="button is-primary" href="{{ route('foos.edit', $foo->id) }}">Edit</a>
                        </div>
                        <div class="control">
                            <form method="POST" action="/foos/{{ $foo->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="button is-danger" onclick="return confirm('{{ ('Are you sure you want to delete?') }}')">Delete</button>
                            </form>
                        </div>

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
</x-app-layout>
