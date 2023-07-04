<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <section class="hero  is-small  is-bold" style="background-color: cornflowerblue">
        <div class="hero-body">
            <div class="container">
                <p class="title is-2">Foos</p>
                <p class="subtitle is-3">The latest foos on the HZ</p>
            </div>
        </div>
    </section>
    @include('common.notification')
    @stack('scripts')
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-full">
                    <div class="content">
                        <div class="has-text-right" style="margin-top: -20px; margin-bottom: 26px">
                            <a href=" {{ route('foos.create') }}" class="button" style="background-color: cornflowerblue; color: white">Create a new Foo...</a>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Thud</th>
                                <th>Wombat</th>
                                <th>Kazaam</th>
                            </tr>
                            @foreach($foos as $foo)
                                <tr bgcolor="{{ $foo->wombat === 1 ? '#ADD8E6': '' }}">
                                    <td>{{ $foo->id }}</td>
                                    <td><a href="{{  route('foos.show', [$foo->id]) }}">{{ $foo->name }}</a></td>
                                    <td>{{ $foo->thud }}</td>
                                    <td>{{ $foo->wombat }}</td>
                                    <td>{{ $foo->kazaam() }}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $foos->links() }}

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
