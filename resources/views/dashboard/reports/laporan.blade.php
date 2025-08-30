@extends('dashboard.layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-2 mb-4 border-bottom px-4">
        <p class="h2">Halaman Reports </p>
    </div>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Tipe</th>
                <th scope="col">Judul/No HKI</th>
                <th scope="col">Rumpun</th>
                <th scope="col">Tanggal Terbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($karyailmiahs as $karyailmiah)
                <tr>
                    <td>{{ $karyailmiah->tipe }}</td>
                    <td>{{ $karyailmiah->judul ?? $karyailmiah->no_hki }}</td>
                    <td>{{ $karyailmiah->rumpun->nama ?? '-' }}</td>
                    <td>{{ $karyailmiah->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">Tipe</th>
                <th scope="col">Judul/No HKI</th>
                <th scope="col">Rumpun</th>
                <th scope="col">Tanggal Terbit</th>
            </tr>
        </tfoot>
    </table>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            let column = this;

                            // Create select element
                            let select = document.createElement('select');
                            select.add(new Option(''));
                            column.footer().replaceChildren(select);

                            // Apply listener for user change in value
                            select.addEventListener('change', function() {
                                var val = DataTable.util.escapeRegex(select.value);

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                            // Add list of options
                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.add(new Option(d));
                                });
                        });
                }
            })
        });
    </script>
@endsection
