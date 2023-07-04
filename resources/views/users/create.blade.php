<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-12"> {{-- These divs are needed for proper layout --}}
                    <form method="POST" action="/users">
                        @csrf
                        <div class="card"> {{-- The form is placed inside a Bulma Card component --}}
                            <header class="card-header">
                                <p class="card-header-title"> {{-- The Card header content --}}
                                    Create a User
                                </p>
                            </header>

                            <div class="card-content">
                                <div class="content">

                                    <div class="field">
                                        <label class="label" for="name">Name <i style="color: red">*</i></label>
                                        <div class="control">
                                            <input class="input @error('name') is-danger @enderror" type="text"  name="name" id="name" value="{{ old('name') }}">
                                            @error('name')
                                            <p class="help is-danger">{{ $errors->first('name') }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="email">Email <i style="color: red">*</i></label>
                                        <div class="control">
                                            <input class="input @error('email') is-danger @enderror" name="email" id="email" value="{{ old('email') }}">
                                            @error('email')
                                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="password">Password <i style="color: red">*</i></label>
                                        <div class="control">
                                            <input class="input @error('password') is-danger @enderror" name="password" id="password" value="{{ old('password') }}">
                                            @error('password')
                                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="password_confirmation">Password Confirmation <i style="color: red">*</i></label>
                                        <div class="control">
                                            <input class="input @error('password_confirmation') is-danger @enderror" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
                                            @error('password_confirmation')
                                            <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label class="label" for="role">Account Type <i style="color: red">*</i></label>

                                        <div class="control is-danger">
                                            <div class="control">
                                                <label class="radio">
                                                    <input type="radio" name="role" value="admin" @if(old('role') === 'admin') checked @endif>
                                                    Admin
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="role" value="user" @if(old('role') === 'user') checked @endif>
                                                    Normal User
                                                </label>
                                            </div>
                                            @error('role')
                                            <p class="help is-danger">{{ $errors->first('role') }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="field is-grouped" style="margin-top: 20px">
                                        <div class="control">
                                            <button class="button is-link" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
