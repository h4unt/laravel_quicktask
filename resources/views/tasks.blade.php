<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="container">
        <div class="card">
            <div class="card-header">
                @lang('task.new')
            </div>
            <div class="card-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Task Form -->
            <form action="{{ route('tasks.store') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <!-- Task Name -->
                <div class="form-group">
                    <label for="task" class="col-sm-3">@lang('task.task')</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> @lang('task.add')
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Current Tasks -->
    @if (count($tasks) > 0)
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
            @lang('task.current')
            </div>

            <div class="card-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>@lang('task.task')</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>
                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> @lang('task.delete')
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
@endsection
