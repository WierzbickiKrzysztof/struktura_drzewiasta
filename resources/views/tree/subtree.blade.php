<ul class="list-group">
    @foreach ($subtree as $node)
        <li class="list-group-item bg-dark text-white">
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


