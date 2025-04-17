<form action="{{ $route }}" method="POST" enctype="multipart/form-data"
    class="bg-white p-6 rounded-lg shadow-md space-y-5">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    {{-- Title --}}
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="4"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $project->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Link --}}
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Link (optional)</label>
        <input type="url" name="link" value="{{ old('link', $project->link ?? '') }}"
            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('link')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image Upload --}}
    <div>
        <label class="block font-semibold text-gray-700 mb-1">Image</label>
        <input type="file" name="image"
            class="block w-full text-sm text-gray-700 border border-gray-300 rounded file:bg-blue-600 file:text-white file:border-0 file:px-4 file:py-2 file:rounded file:cursor-pointer">
        @if (!empty($project->image))
            <img src="{{ asset('storage/' . $project->image) }}" height="100" width="100" alt="Project Image" class="w-32 mt-3 rounded shadow">
        @endif
        @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div class="flex items-center space-x-3">
        <input type="checkbox" name="status" value="1" id="status" class="form-checkbox text-blue-600 rounded m-2"
            {{ old('status', $project->status ?? false) ? 'checked' : '' }}>
        <label for="status" class="text-gray-700">Active</label>
    </div>

    {{-- Submit --}}
    <div>
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 m-3 font-semibold px-6 py-2 rounded shadow transition">
            <i class="fas fa-save mr-2"></i> Save Project
        </button>
    </div>
</form>
