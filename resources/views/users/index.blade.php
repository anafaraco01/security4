<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <section class="hero  is-small  is-bold" style="background-color: cornflowerblue">
        <div class="hero-body">
            <div class="container">
                <p class="title is-2">Users</p>
                <p class="subtitle is-3">The registered users</p>
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
                            <a href=" {{ route('users.create') }}" class="button" style="background-color: cornflowerblue; color: white">Create a new User...</a>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($users as $user)
                                <tr bgcolor="{{ $user->role === 'admin' ? '#ADD8E6': '' }}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td><a class="button is-primary" href=" {{ route('users.edit', $user) }}">Edit</a></td>
                                    <td>
                                        <form method="POST" onclick="return confirm('Are you certain you want to delete the user: {{$user->name}}, with ID: {{$user->id}}?')" action="{{ route('users.destroy', $user) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="form-group">
                                                <button class="button is-danger" type="submit">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
