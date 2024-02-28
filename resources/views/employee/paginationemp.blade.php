<table class="table  table-hover">
    <thead class="bg-secondary">
        <tr>
            <th class="text-light" scope="col">Name</th>
            <th class="text-light" scope="col">Doc</th>
            <th class="text-light" scope="col">Jobrole</th>
            <th class="text-light" scope="col">Dept</th>
            <th class="text-light" scope="col">Email</th>
            <th class="text-light" scope="col">Status</th>
            <th class="text-light" scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee as $emp)
            <tr class="tb">
                <td class="align-middle">{{ $emp->name }}</td>
                <td class="align-middle rounded-circle">
                    @if (pathinfo($emp->document, PATHINFO_EXTENSION) == 'pdf')
                        <a href="{{ asset('assets/documents/' . $emp->document) }}"
                            target="_blank"><iframe
                                src="{{ asset('assets/documents/' . $emp->document) }}"
                                alt="Employee Document" class="img-fluid img-thumbnail "></iframe></a>
                    @else
                        <img src="{{ asset('assets/documents/' . $emp->document) }}"
                            alt="Employee Document" class="img-fluid img-thumbnail rounded-circle">
                    @endif
                </td>
                <td class="align-middle ">{{ $emp->jobrole }}</td>
                <td class="align-middle">{{ $emp->department }}</td>
                <td class="align-middle ">{{ $emp->email }}</td>
                <td class="align-middle">
                    <button class="btn shadow border status-btn
                    @if($emp->status === 'Approval')
                        btn-success text-light fw-normal
                    @elseif($emp->status === 'Decline')
                        btn-danger text-light fw-normal
                    @else
                        btn-light fw-bolder
                    @endif">
                        {{ $emp->status }}
                    </button>

                </td>
                <td class="align-middle">
                    {{-- view modal button --}}
                    <button id="viewbutton" data-viewid="{{ $emp->id }}"
                        data-phone="{{ $emp->phone }}" data-address="{{ $emp->address }}"
                        data-empname="{{ $emp->name }}" data-cnic="{{ $emp->cnic }}"
                        data-dateofbirth="{{ $emp->dateofbirth }}"
                        data-issue="{{ $emp->dateofissue }}" data-expiry="{{ $emp->dateofexpiry }}"
                        data-bs-toggle="modal" data-bs-target="#viewModal"
                        class="fas fa-eye bg-dark   fa-lg rounded text-light  p-2 border-0 shadow ">
                    </button>
                    {{-- delete data  --}}
                    <button id="Deleteemployee" data-eid="{{ $emp->id }}"
                        class="fas fa-trash-alt   fa-lg rounded text-light p-2 border-0 shadow ">
                    </button>
                    {{-- update modal  --}}
                    <a id="updateemployee" data-uid="{{ $emp->id }}"
                        data-upname="{{ $emp->name }}" data-upphone="{{ $emp->phone }}"
                        data-upemail="{{ $emp->email }}" data-upaddress="{{ $emp->address }}"
                        data-updepartment="{{ $emp->department }}"
                        data-upjobrole="{{ $emp->jobrole }}" data-upcnic="{{ $emp->cnic }}"
                        data-updob="{{ $emp->dateofbirth }}" data-updoi="{{ $emp->dateofissue }}"
                        data-updoc="{{ $emp->document }}" data-updoe="{{ $emp->dateofexpiry }}"
                        class="text-decoration-none fas fa-edit fa-lg border-0 p-2 bg-primary fa-lg rounded text-light "
                        href="" data-bs-toggle="modal" data-bs-target="#updateModal">
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="demo">
{!! $employee->links('vendor.pagination.custom') !!}
</div>
