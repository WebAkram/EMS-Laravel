<table class="table table-hover">

    <thead class="bg-secondary">
        <tr>
            <th class="text-light" scope="col">Department Name</th>
            <th class="text-light" scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($department as $item)
            <tr class="tb">
                <td class="align-middle fw-bolder p-3">{{ $item->department_name }}
                </td>
                {{-- delete button --}}
                <td class="align-middle mt-3">
                    <button id="Deletedepartment" data-id="{{ $item->id }}"
                        class="fas fa-trash-alt fa-lg rounded text-light border-0  shadow p-2">
                    </button>

                {{-- update button --}}

                    <a id="departmentshowupdate" data-uid="{{ $item->id }}"
                        data-name="{{ $item->department_name }}"
                        class="text-decoration-none fas fa-edit fa-lg bg-primary fa-lg ms-2 rounded text-light p-2"
                        href="" data-bs-toggle="modal" data-bs-target="#updateModal">
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<div class="demo">
    {!! $department->links('vendor.pagination.custom') !!}
</div>

