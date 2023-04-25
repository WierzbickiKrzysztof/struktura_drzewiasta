<x-main>
    <h2>Ustaw kolejność</h2>
    <h5>Pozycje nie mogą się powtarzać</h5>
        <form method="POST" id="editForm" action="/tree/pos/{{ request()->route('id') }}" >
            <div class="modal-body">

                @if(Session::has('errorMsg'))
                    <div class="alert alert-danger"> {{ Session::get('errorMsg') }}</div>
                @endif

                @csrf
                @method('PUT')

                @php($poz=1)
                @foreach ($pos as $key => $value)

                <div class="form-group">
                    <label for="position[{{ $poz }}]">Pozycja {{ $poz }}:</label>
                    <select class="form-control" id="position[{{ $poz }}]" name="position[{{ $poz }}]">
                        @foreach ($pos as $key => $value)
                        <option value="{{ $key }}">[{{ $key }}] - {{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                    @php($poz++)
                @endforeach

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="history.back()">Wróć</button>
                <button type="submit" class="btn btn-primary">Zapisz</button>
            </div>
        </form>

</x-main>
