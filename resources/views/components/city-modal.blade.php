

<div x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

  <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <!-- Background overlay -->
    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- Modal panel -->
    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="inline-block align-bottom bg-slate-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full z-50">
      <div class="bg-slate-800 px-8 pt-6 pb-8">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
            <h3 class="text-lg leading-6 font-bold text-slate-100" id="modal-title">
              Select Your City
            </h3>
            <div class="mt-4">
              <p class="text-sm text-slate-400">
                Please choose your city to see local theatres and showtimes.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-slate-700 px-8 py-6">
        <form method="POST" action="{{ route('city.select') }}">
          @csrf
          <select name="city_id" required class="w-full p-3 border border-slate-600 rounded-xl bg-slate-800 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="">Choose a city...</option>
            @foreach($cities as $city)
              <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
          </select>
          <div class="mt-6 flex justify-end gap-3">
            <button type="button" @click="showModal = false" class="px-6 py-2 bg-slate-600 hover:bg-slate-500 text-white rounded-xl transition-all">
              Cancel
            </button>
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-medium transition-all">
              Continue
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Auto-hide modal after successful selection (POST response)
  if (window.location.search.includes('city_selected=1')) {
    // Modal already handled by session check
    console.log('City selected, modal hidden');
  }
</script>

