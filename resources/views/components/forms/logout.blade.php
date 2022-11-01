@auth
    <form method="post" action="{{ route('auth.logout') }}">
        @csrf
        @method('DELETE')

        <button type="submit">Выход</button>
    </form>
@endauth