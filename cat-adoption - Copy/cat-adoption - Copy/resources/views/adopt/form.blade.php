<form method="POST" action="{{ route('applications.store') }}" class="space-y-5">
    @csrf

    <!-- Salary -->
    <div>
        <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Monthly Salary (PHP)</label>
        <input id="salary" type="number" name="salary" required placeholder="Enter your monthly salary"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent">
    </div>

    <!-- Adoption Fee -->
    <div>
        <label for="adoption_fee" class="block text-sm font-medium text-gray-700 mb-1">Adoption Fee (PHP 25)</label>
        <input id="adoption_fee" type="number" name="adoption_fee" required placeholder="Enter PHP 25"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent">
    </div>

    <!-- Submit Button -->
    <div class="pt-2">
        <button type="submit"
            class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
            Apply for Adoption
        </button>
    </div>
</form>
