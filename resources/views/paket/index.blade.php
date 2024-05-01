@extends('layout.main')

@section('content')
<!-- Content Header (Page header) -->




<!-- Main content -->
<section class="content">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Paket kuota</h3>

                    <div class="row">
                        <div class="col" style="float: left; margin-left:10px;">
                            <div class="form-group">
                                <label for="from"><b>From</b></label>
                                <input type="date" class="form-control" id="from" name="from" style="width: 130px;">
                            </div>
                        </div>
                        <div class="col" style="float: left; margin-left:10px;">
                            <div class="form-group">
                                <label for="to"><b>To</b></label>
                                <input type="date" class="form-control" id="to" name="to" style="width: 130px;">
                            </div>
                        </div>
                        <div class="col" style="float: left; margin-left:10px;">
                            <div class="form-group">
                                <label for="filter"><b>Filter</b></label>
                                <select class="form-control" id="filter" style="width: 130px;">
                                    <option value="1">All</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="box-tools">
                        <button class="btn btn-info" onclick="location.reload()">Refresh</button>
                        <button class="btn btn-default" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Create</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead style="background-color: green">
                            <tr>
                                <th style="color: white">Paket</th>
                                <th style="color: white">Berat</th>
                                <th style="color: white">Harga</th>
                                <th style="color: white">Cabang</th>
                                <th style="color: white">Created At</th>
                                <th style="color: white">Status</th>
                                <th style="color: white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pakets as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->berat }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->cabang }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <button class="btn btn-{{ $item->status == 'Aktif' ? 'success' : 'danger' }}"
                                        data-toggle="modal" data-target="#aktionModal{{ $item->id }}">
                                        {{ $item->status }}
                                    </button>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                            data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#detailModal{{ $item->id }}">Detail</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- Detail Modal -->
                            <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="detailModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="detailModalLabel">Detail Paket kuota</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{ route('paket.update', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nama">Paket:</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        value="{{ $item->nama }}">
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="berat">Berat:</label>
                                                            <input type="number" class="form-control" id="berat"
                                                                name="berat" value="{{ $item->berat }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="satuan">Satuan:</label>
                                                            <select class="form-control" id="satuan" name="satuan">
                                                                @foreach ($satuans as $st)
                                                                <option value="{{ $st->id }}"
                                                                    {{ $item->satuan_id == $st->id ? 'selected' : '' }}>
                                                                    {{ $st->satuan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga">Harga:</label>
                                                    <input type="number" class="form-control" id="harga" name="harga"
                                                        value="{{ $item->harga }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cabang">Cabang:</label>
                                                    <input type="text" class="form-control" id="cabang" name="cabang"
                                                        value="{{ $item->cabang }}">
                                                </div>
                                                <div class="text-right">
                                                    <a href="#" class="btn btn-light"
                                                        style="border: 1px solid black;">Close</a>
                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Status Modal -->
                            <div class="modal fade" id="aktionModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="aktionModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="aktionModalLabel">Ganti Status</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Ganti Status {{ $item->status }} Ke
                                                {{ $item->status == 'Aktif' ? 'Nonaktif' : 'Aktif' }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('paket.aktion', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status"
                                                    value="{{ $item->status == 'Aktif' ? 'Nonaktif' : 'Aktif' }}">
                                                <button type="submit" class="btn btn-primary">Ganti</button>
                                            </form>
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="createModalLabel">Create Paket kuota</h4>
            </div>
            <div class="modal-body">
                <!-- Add your form for creating Paket kuota here -->
                <!-- For example, you can include a form with input fields -->
                <form action="{{ route('paket.store') }}" method="POST">
                    @csrf
                    <!-- Your form fields go here -->
                    <div class="form-group">
                        <label for="nama">Paket:</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="berat">Berat:</label>
                                <input type="number" class="form-control" name="berat" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="satuan">Satuan:</label>
                                <select class="form-control" name="satuan">
                                    @foreach ($satuans as $st)
                                    <option value="{{ $st->id }}">{{ $st->satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga:</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="cabang">Cabang:</label>
                        <input type="text" class="form-control" name="cabang" required>
                    </div>
                    <a href="#" class="btn btn-light" style="border: 1px solid black;">Close</a>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
