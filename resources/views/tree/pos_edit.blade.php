<x-main>
<ul class="list-group">




{{--    @dd($pos)--}}


        <form method="POST" id="editForm" action="/tree/pos/{{ request()->route('id') }}" >
            <div class="modal-body">

                @csrf
                @method('PUT')

                @php $poz=1; @endphp
                @foreach ($pos as $key => $value)

                <div class="form-group">
                    <label for="parent_id_edit">Pozycja {{ $poz }}:</label>
                    <select class="form-control" id="parent_id_edit" name="position[{{ $poz }}]">
                        @foreach ($pos as $key => $value)
                        <option value="{{ $key }}">[{{ $key }}]{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                    @php $poz++; @endphp
                @endforeach



                {{--                    <div class="form-group">--}}
                {{--                        <label for="position_edit">Pozycja:</label>--}}
                {{--                        <select class="form-control" id="position_edit" name="position">--}}
                {{--                            <option value="">-- placeholder --</option>--}}
                {{--                        </select>--}}
                {{--                    </div>--}}


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="history.back()">Wróć</button>
                <button type="submit" class="btn btn-primary">Edytuj</button>
            </div>
        </form>


</ul>


</x-main>
