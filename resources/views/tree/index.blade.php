@push('scripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endpush

<x-main>
    <div class="mb-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" onclick="fillForm('root', '')">
            Dodaj główny węzeł
        </button>
        <a href="{{ route('tree.indexWS', ['id' => 'desc']) }}">
            <button type="button" class="btn btn-info">
                Sortowanie A-Z
            </button>
        </a>
        <a href="{{ route('tree.indexWS', ['id' => 'asc']) }}">
            <button type="button" class="btn btn-info">
                Sortowanie Z-A
            </button>
        </a>
        <a href="{{ route('tree.index') }}">
            <button type="button" class="btn btn-info">
                Sortowanie według dodania
            </button>
        </a>
    </div>
<ul class="list-group">
    @foreach ($tree as $node)
    <li class="list-group-item bg-dark text-white ">
     <button class='btn btn-link p-0 m-0 show'><span class="material-symbols-outlined">expand_more</span></button><button class='btn btn-link p-0 m-0 hide'><span class="material-symbols-outlined">expand_less</span></button>
        {{ $node->name }}
        <button type="button" class="btn btn-link p-0 m-0" data-bs-toggle="modal" data-bs-target="#addModal" onclick="fillForm('{{ $node->name }}', '{{ $node->id }}')">
            <span class="material-symbols-outlined">add</span>
        </button>
        <button type="button" id="del" class="btn btn-link p-0 m-0" data-bs-toggle="modal" data-bs-target="#delModal"  onclick="checkChildren('{{ $node->name }}', '{{ $node->id }}')">
            <span class="material-symbols-outlined">cancel</span>
        </button>

        <button type="button" id="edit" class="btn btn-link p-0 m-0" data-bs-toggle="modal" data-bs-target="#editModal"  onclick="editForm('{{ $node->name }}', '{{ $node->id }}')">
            <span class="material-symbols-outlined">edit</span>
        </button>
        @if (count($node->children))
        @include('tree.subtree', ['subtree' => $node->children])
        @endif
    </li>
    @endforeach
</ul>


    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Dodaj węzeł</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('tree.store') }}" >
                <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="name">Nazwa:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Rodzic:</label>
                            <input type="hidden" class="form-control" id="parent_id" name="parent_id" required>
                            <input type="text" class="form-control" id="parent_disp" name="parent_disp" disabled>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary">Dodaj</button>
                </div>
                </form>
            </div>
        </div>
    </div>



     <!-- Modal -->
    <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delModalLabel">Usuń węzeł</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="delForm" action="" >
                <div class="modal-body">
                        <p id="delInfo1">Uwaga! Usuwasz węzeł który ma pod sobą <span id="countNodes"></span> węzły/węzłów!.
                        <br>Jeśli potwierdzisz usunięcie wszystkie podrzędne węzły zostaną usunięte.</p>

                        <p id="delInfo2">Ten węzeł nie ma żadnych pod sobą, możesz go bezpiecznie usunąć.</p>

                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="name_node">Nazwa:</label>
                            <input type="text" class="form-control" id="name_node" name="name" disabled>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary">Usuń</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edytuj węzeł</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="editForm" action="" >
                <div class="modal-body">

                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name_edit">Nazwa:</label>
                            <input type="text" class="form-control" id="name_edit" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="parent_id_edit">Parent node:</label>
                            <select class="form-control" id="parent_id_edit" name="parent_id">
                                <option value="">-- placeholder --</option>
                            </select>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary">Edytuj</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</x-main>

