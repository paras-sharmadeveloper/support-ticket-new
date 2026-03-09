<x-app-layout>

<div class="flex justify-center mt-10">

<div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

<h2 class="text-xl font-bold mb-6 text-center">

{{ isset($department) ? 'Edit Department' : 'Create Department' }}

</h2>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-3 mb-4 rounded">

{{ session('success') }}

</div>

@endif

<form method="POST"
action="{{ isset($department) ? route('departments.update',$department->id) : route('departments.store') }}">

@csrf

@if(isset($department))
@method('PUT')
@endif

<div class="mb-4">

<label>Department Name</label>

<input type="text"
name="name"
value="{{ old('name',$department->name ?? '') }}"
class="border w-full p-2 rounded">

</div>

<div class="mb-6">

<label>Description</label>

<textarea
name="description"
class="border w-full p-2 rounded">{{ old('description',$department->description ?? '') }}</textarea>

</div>

<button class="bg-blue-600 text-white px-4 py-2 rounded w-full">

{{ isset($department) ? 'Update Department' : 'Create Department' }}

</button>

</form>

</div>

</div>

</x-app-layout>