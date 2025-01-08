<form action="{{ $action }}" method="POST">
    @csrf
    @method($method)    
    @if ($method == 'DELETE')
        <button 
            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-400"
            type="submit">
            Delete
        </button>
    @else
        <button 
            class="bg-yellow-300 hover:bg-yellow-400 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-300"
            type="submit">
            Edit
        </button>
    @endif
</form>
