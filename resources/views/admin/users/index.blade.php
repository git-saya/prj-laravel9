@extends('admin.layouts.main')

@section('content')
<h1 class="text-2xl font-bold mb-3">Users</h1>
<table class="border-separate border-spacing-2 border border-slate-400">
    <thead>
      <tr>
        <th class="border border-slate-300">No</th>
        <th class="border border-slate-300">Name</th>
        <th class="border border-slate-300">Email</th>
        <th class="border border-slate-300">Roles</th>
        <th class="border border-slate-300">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $key => $user)
        <tr>
            <td class="{{ $classNameColumn }}">{{ ++$i }}</td>
            <td class="{{ $classNameColumn }}">{{ $user->name }}</td>
            <td class="{{ $classNameColumn }}">{{ $user->email }}</td>
            <td class="{{ $classNameColumn }}">
                @if( !empty( $user->getRoleNames() ) )
                    @foreach($user->getRoleNames() as $role)
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">{{ $role }}</span>
                    @endforeach
                @endif
            </td>
            <td class="{{ $classNameColumn }}">
                <a href="{{ route('users.show', $user->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-2 text-sm py-1 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Show</a>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>

  {!! $users->render() !!}
@endsection