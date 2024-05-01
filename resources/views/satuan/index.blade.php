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
                    <h3 class="box-title">Satuan Unit</h3>

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
                                <th style="color: white">Satuan Unit</th>
                                <th style="color: white">Deskripsi</th>
                                <th style="color: white">Status</th>
                                <th style="color: white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($satuans as $item)
                            <tr>
                                <td>{{ $item->satuan }}</td>
                                <td>{{ $item->deskripsi }}</td>
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
                                            <h4 class="modal-title" id="detailModalLabel">Detail Satuan Unit</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('satuan.update', ['id' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="satuan">Satuan:</label>
                                                    <input type="text" class="form-control" id="satuan" name="satuan"
                                                        value="{{ $item->satuan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi:</label>
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                                        rows="3">{{ $item->deskripsi }}</textarea>
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
                            <!-- Status Change Modal -->
                            <div class="modal fade" id="aktionModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="aktionModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title" id="aktionModalLabel">Melakukan Aktion</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Ganti Satus {{ $item->status }} Ke
                                                {{ $item->status == 'Aktif' ? 'Nonaktif' : 'Aktif' }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('satuan.aktion', $item->id) }}" method="POST" style="display: inline;">
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
                <h4 class="modal-title" id="createModalLabel">Create Satuan Unit</h4>
            </div>
            <div class="modal-body">


                @if ($errors->any())

                <div class="pt-3">
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $item)
                            <li>{{$item}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @endif


                <form action="{{ route('satuan.store') }}" method="POST">
                    @csrf
                    <!-- Your form fields go here -->
                    <div class="form-group">
                        <label for="satuan">Satuan:</label>
                        <input type="text" class="form-control" name="satuan">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea class="form-control" name="deskripsi"></textarea>
                    </div>

                    <a href="#" class="btn btn-light" style="border: 1px solid black;">Close</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
